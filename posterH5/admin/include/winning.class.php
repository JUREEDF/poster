<?php
/**
 * 抽奖小程序
 * @File:    winning.class.php
 * @Author:  LiaoJiangYi
 * @Website: www.jyliao.com
 * @Wechat:  jyliao_vip
 * @Date:    2015/12/8 11:35
 * @property \mysqlpdo $_db
 * @property \Redis $_redis
 */
class winning
{
    const SESSION_TTL = 1800;
    //如果IP在多少秒内重复 多少次抽奖则加入黑名单
    // IP_BACKLIST_TIME 为0时关闭此功能
    const IP_BACKLIST_TIME = 3;
    const IP_BACKLIST_TIMES = 2;
    //是否限制IP重复中奖
    const IP_REPEAT_WINNING = true;
    //是否开启错误日志
    const LOG = true;
    const LOG_FILE = './winning.log';
    private $_db;
    private $_ip;
    private $_redis;
    public function __construct(\mysqlpdo &$db)
    {
        $this->_db = $db;
        $this->_ip = GetIP();
    }
    public function getGameUser($id)
    {
        return $this->_db->get_one('SELECT * FROM `user` WHERE `id`='.intval($id));
    }
    //更新中奖用户数据
    public function updateUserInfo($user_id,$crypt,array $info)
    {
        $winList = $this->_db->get_all('SELECT `id`,`prize_key`,`addtime`,`info_addtime` FROM `winnings` WHERE `game_user_id`='.$user_id);
        $winResult = array();
        foreach($winList as $val)
        {
            $c = $this->_getCrypt($this->_ip.'_'.$val['prize_key'].'_'.$val['addtime']);
            if($c==$crypt)
            {
                $winResult = $val;
                break;
            }
        }
        if(empty($winResult))
        {
            return array(
                'code' => 3,
                'msg' => '您未中奖'
            );
        }
        if($winResult['info_addtime']>0)
        {
            return array(
                'code' => 3,
                'msg' => '您已提交过信息!'
            );
        }
        $result = $this->_db->update('winnings',$info,'id='.$winResult['id']);
        if(!$result)
        {
            $this->_log('updateUserInfo update table winnings error | UserId:'.$user_id.' Data:'.serialize($info));
            return array(
                'code' => 3,
                'msg' => '您未中奖!'
            );
        }
        return array('status' => 1);
    }
    //抽奖
    public function winPrize($user_id)
    {
        $game_user = $this->getGameUser($user_id);
        if(empty($user_id))
        {
            return array(
                'code' => 3,
                'msg' => '游戏数据不存在'
            );
        }
        $status_winning=$this->_db->get_one('SELECT * FROM `winnings` WHERE `game_user_id`='.$game_user['id']);
        if($status_winning){
            return array(
                'code' => 3,
                'msg' => '未中奖3'
            );
        }
        //判断是否在黑名单内
        if($this->checkBackList())
        {
            return array(
                'code' => 3,
                'msg' => '未中奖4'
            );
        }
        $prize_list = $this->_db->get_all('SELECT * FROM `prizes`');
        $prize = array();
        $time = time();
        foreach($prize_list as $val)
        {
            //更新抽奖状态
            $val = $this->resetPrize($val);
            //设置当前中奖
            if($val['today_total']>$val['today_total_send'])
            {
                $prize[] = $val;
            }
        }
        $prize = $prize[array_rand($prize)];
        //print_r($prize);die;
        //数据不存在 或者 未设置中奖率
        if(empty($prize['today_probability']))
        {
            return array(
                'code' => 3,
                'msg' => '未中奖5'
            );
        }
        //正式抽奖
        if($prize['today_probability']==10000)
        {
            return $this->_setWinPrize($prize['id'],$game_user['id']);
        }
        $prize = $prize_list[mt_rand(0,count($prize_list))];
        //foreach($prize_list as $prize)
        //{
            if($prize['today_total']>$prize['today_total_send'])
            {
                $rand = mt_rand(0,9999);
                $rand_list = array();
                for($i=0;$i<$prize['today_probability'];$i++)
                {
                    $rand_list[] = mt_rand(0,9999);
                }
                if(in_array($rand,$rand_list))
                {
                    $ret = $this->_setWinPrize($prize['id'],$game_user['id']);
                    if($ret['code']==4)
                    {
                        return $ret;
                    }
                }
            }
        //}
        return array(
            'code' => 3,
            'msg' => '未中奖!6'
        );
    }
    public function resetPrize(array $prize)
    {
        $time = time();
        $prize2 = $prize;
        if($time>$prize['today'])
        {
            $this->_db->begin();
            $r = $this->_db->insert('prize_logs',array(
                'prize_id' => $prize['id'],
                'today' => $prize['today'],
                'today_total' => $prize['today_total'],
                'today_total_send' => $prize['today_total_send'],
                'today_probability' => $prize['today_probability'],
                'addtime' => $time,
            ));
            $prize['today_total_send'] = 0;
            $prize['today'] = strtotime('today')+86400-1;
            $r2 = $this->_db->update('prizes',array(
                'today_total_send' => $prize['today_total_send'],
                'today' => $prize['today']
            ),'id='.$prize['id']);
            if(!$r || !$r2)
            {
                $this->_db->rollback();
                return $prize2;
            }
            $this->_db->commit();
        }
        return $prize;
    }
    //设置中奖返回数据
    private function _setWinPrize($prize_id,$user_id)
    {
        $prize = $this->_db->get_one('SELECT * FROM `prizes` WHERE `id`='.$prize_id);
        if($prize['today_total_send'] >= $prize['today_total'] ||
            $prize['total_send'] >= $prize['total'])
        {
            //奖品抽光了
            return array(
                'code' => 3,
                'msg' => '未中奖7'
            );
        }
        $time = time();
        if($prize['is_repeat']==1)
        {
            $wp = $this->_db->get_one('SELECT * FROM `prize_lists` WHERE `prize_id`='.$prize['id']);
        } else {
            $wp = $this->_db->get_one('SELECT * FROM `prize_lists` WHERE `is_use`=0 AND `prize_id`='.$prize['id']);
        }
        if(empty($wp))
        {
            $this->_log('winning not prize_lists UserId:'.$user_id.' Prize:'.serialize($prize));
            //奖品不存在
            return array(
                'code' => 3,
                'msg' => '未中奖!8'
            );
        }
        //已中奖 保存记录
        $this->_db->begin();
        $result = $this->_db->insert('winnings',array(
            'game_user_id' => $user_id,
            'prize_id' => $prize['id'],
            'prize_list_id' => $wp['id'],
            'ip' => $this->_ip,
            'addtime' => $time,
        ));
        if(!$result)
        {
            $this->_db->rollback();
            $this->_log('winning insert table winnings error | UserId:'.$user_id.' Prize:'.serialize($prize));
            return array(
                'code' => 3,
                'msg' => '未中奖!9'
            );
        }
        /*$resultUser = $this->_db->update('game_users',array('is_win'=>1),'id='.$user_id);
        if(!$resultUser)
        {
            $this->_db->query('ROLLBACK');
            $this->_log('winning update table game_users error | UserId:'.$user_id.' Prize:'.serialize($prize));
            return array(
                'code' => 0,
                'msg' => '未中奖!_4'
            );
        }*/
        $resultPrize = $this->_db->update('prizes',array(
            'today_total_send' => $prize['today_total_send']+1,
            'total_send' => $prize['total_send']+1
        ),'id='.$prize['id']);
        if(!$resultPrize)
        {
            $this->_db->rollback();
            $this->_log('winning update table prizes error | UserId:'.$user_id.' Prize:'.serialize($prize));
            return array(
                'code' => 3,
                'msg' => '未中奖!10'
            );
        }
        if($prize['is_repeat']!=1)
        {
            $resultPL = $this->_db->update('prize_lists',array('is_use' => 1),'id='.$wp['id']);
            if(!$resultPL)
            {
                $this->_db->rollback();
                $this->_log('winning update table prize_lists error | UserId:'.$user_id.' Prize:'.serialize($prize));
                return array(
                    'code' => 3,
                    'msg' => '未中奖!11'
                );
            }
        }
        $key_url = "";
        if($prize['id'] != 4){
            //正式领券地址

            /*if($prize['id'] == 5){
                $code = $this->_db->get_one("select `code`,`id` from yibai_ticket where status=0");
                $return_up_code = $this->_db->update('yibai_ticket',array('status' => 1),'id='.$code['id']);
                if(!$return_up_code)
                {
                    $this->_db->rollback();
                    $this->_log('winning update table yibai_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                    return array(
                        'code' => 3,
                        'msg' => '未中奖!'
                    );
                }
                $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=2&redeemCode=".$code['id'];
            }
            if($prize['id'] == 6){
                $code = $this->_db->get_one("select `code`,`id` from wushi_ticket where status=0");
                $return_up_code = $this->_db->update('wushi_ticket',array('status' => 1),'id='.$code['id']);
                if(!$return_up_code)
                {
                    $this->_db->rollback();
                    $this->_log('winning update table wushi_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                    return array(
                        'code' => 3,
                        'msg' => '未中奖!'
                    );
                }
                $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=3&redeemCode=".$code['id'];
            }
            if($prize['id'] == 7){
                $code = $this->_db->get_one("select `code`,`id` from ershi_ticket where status=0");
                $return_up_code = $this->_db->update('ershi_ticket',array('status' => 1),'id='.$code['id']);
                if(!$return_up_code)
                {
                    $this->_db->rollback();
                    $this->_log('winning update table ershi_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                    return array(
                        'code' => 3,
                        'msg' => '未中奖!'
                    );
                }
                $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=4&redeemCode=".$code['id'];
            }
            if($prize['id'] == 8){
                $code = $this->_db->get_one("select `code`,`id` from shi_ticket where status=0");
                $return_up_code = $this->_db->update('shi_ticket',array('status' => 1),'id='.$code['id']);
                if(!$return_up_code)
                {
                    $this->_db->rollback();
                    $this->_log('winning update table shi_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                    return array(
                        'code' => 3,
                        'msg' => '未中奖!'
                    );
                }
                $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=5&redeemCode=".$code['id'];
            }
            if($prize['id'] == 9){
                $code = $this->_db->get_one("select `code`,`id` from wu_ticket where status=0");
                $return_up_code = $this->_db->update('wu_ticket',array('status' => 1),'id='.$code['id']);
                if(!$return_up_code)
                {
                    $this->_db->rollback();
                    $this->_log('winning update table wu_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                    return array(
                        'code' => 3,
                        'msg' => '未中奖!'
                    );
                }
                $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=6&redeemCode=".$code['id'];
            }*/

            //测试领券地址
            $code = $this->_db->get_one("select `code`,`id` from ceshi_ticket where status=0");
            $return_up_code = $this->_db->update('ceshi_ticket',array('status' => 1),'id='.$code['id']);
            if(!$return_up_code)
            {
                $this->_db->rollback();
                $this->_log('winning update table ceshi_ticket error | UserId:'.$user_id.' Prize:'.serialize($prize));
                return array(
                    'code' => 3,
                    'msg' => '未中奖!12'
                );
            }
            $key_url = "http://q.leygoo.cn/index.php?r=exchangeCoupons/exchange&activity_id=1&redeemCode=".$code['code'];
        }
        $this->_db->commit();
        $crypt = $this->_getCrypt($this->_ip.'_'.$wp['key'].'_'.$time);
        return array(
            'code' => 4,
            'title' => $prize['title'],
            'type' => $prize['type_id'],
            'prize_id' => $prize['id'],
            'key_url' => $key_url,
            'crypt' => $crypt
        );
    }
    //判断IP是否有效
    private function checkBackList()
    {
        $sname = '_IP_'.md5($this->_ip);
        if(self::IP_BACKLIST_TIME>0)
        {
            $stname = $sname.'_TIMES';
            $sbname = $sname.'_BACK';
            if($this->hasSession($sbname))return true;
            $ip_backlist = $this->_db->get_one('SELECT * FROM `ip_backlists` WHERE `ip`="'.$this->_ip.'"');
            if($ip_backlist)
            {
                $this->setSession($sbname,1);
                return true;
            }
            if(!$this->hasSession($sname))
            {
                $this->setSession($sname,time());
                $this->setSession($stname,1);
            } else {
                $stname_value = intval($this->getSession($stname));
                $this->setSession($stname,$stname_value+1);
            }
            $stname_value = intval($this->getSession($stname));
            $sname_value = $this->getSession($sname);
            $is_time = ((time()-$sname_value) <= self::IP_BACKLIST_TIME) ? true : false;
            if($is_time && self::IP_BACKLIST_TIMES<=$stname_value)
            {
                $this->_db->insert('ip_backlists',array(
                    'ip' => $this->_ip
                ));
                $this->removeSession(array($sname,$stname));
                $this->setSession($sbname,1);
                return true;
            }
            if($is_time)
            {
                $this->setSession($sname,time());
                $this->setSession($stname,1);
            }
        }
        //ip不可重复中奖
        $rwname = $sname.'_REPEAT_WIN';
        if(self::IP_REPEAT_WINNING)
        {
            if($this->hasSession($rwname))return true;
            $winIp = $this->_db->get_one('SELECT `id` FROM `winnings` WHERE `prize_id`=4 AND `ip`="'.$this->_ip.'"');
            if(!empty($winIp))
            {
                $this->setSession($rwname,1);
                return true;
            }
        }
        return false;
    }
    public function setSessionToRedis(\Redis &$redis)
    {
        $this->_redis = $redis;
    }
    public function setSession($key,$value)
    {
        if(!$this->_redis)
        {
            return $_SESSION[$key] = $value;
        }
        $key = REDIS_PRE.$key;
        return $this->_redis->set($key,$value,self::SESSION_TTL);
    }
    public function hasSession($key)
    {
        if(!$this->_redis)
        {
            if(isset($_SESSION[$key]))return true;
            else return false;
        }
        $key = REDIS_PRE.$key;
        return $this->_redis->exists($key);
    }
    public function getSession($key)
    {
        if(!$this->_redis)
        {
            return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        }
        $key = REDIS_PRE.$key;
        return $this->_redis->get($key);
    }
    public function removeSession($key)
    {
        if(!$this->_redis)
        {
            unset($_SESSION[$key]);
            return true;
        }
        $key = REDIS_PRE.$key;
        return $this->_redis->del($key);
    }
    private function _getCrypt($str)
    {
        return md5(base64_encode(sha1($str)));
    }
    private function _log($message)
    {
        file_put_contents(self::LOG_FILE,date('Y-m-d H:i:s').'  '.$message."\n",FILE_APPEND);
    }
}