<?php
/**
 * @File:     mysql.pdo.class.php
 * @Author:   LiaoJiangYi
 * @Wechat:   jyliao_vip
 * @QQ:       527532113
 * @license:  http://www.jyliao.com/
 * @property \PDO $pdo
 * @property \PDOStatement $results
 */
final class mysqlpdo
{
    public $pdo = null;
    public $results = null;
    private $dbHost;
    private $dbPort;
    private $dbPassword;
    private $dbUser;
    private $dbDbName;
    private $dbCharset = 'utf8';

    public function __construct($config = array())
    {
        $this->dbHost = $config['host'];
        $this->dbPort = $config['port'];
        $this->dbUser = $config['user'];
        $this->dbPassword = $config['pwd'];
        $this->dbDbName = $config['name'];
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $this->dbHost . ';port=' . $this->dbPort . ';dbname=' . $this->dbDbName . ';charset=' . $this->dbCharset,
                $this->dbUser,
                $this->dbPassword
            );
        } catch (PDOException $error) {
            $this->error($error->getMessage());
        }
    }

    public function GetOne($sql = '', $accType = PDO::FETCH_ASSOC)
    {
        return $this->get_one($sql, $accType);
    }

    public function get_one($sql, $accType = PDO::FETCH_ASSOC)
    {
        $ok = $this->process($sql);
        if ($ok) {
            $this->results->setFetchMode($accType);
            $data = $this->results->fetch();
            return $data;
        } else {
            return false;
        }
    }

    public function get_all($sql)
    {
        $ok = $this->process($sql);
        if ($ok) {
            $this->results->setFetchMode(PDO::FETCH_ASSOC);
            $data = $this->results->fetchAll();
            return $data;
        } else {
            return array();
        }
    }

    public function db_get($column, $table, $query_select)
    {
        if (isset($column) && isset($table) && isset($query_select)) {
            if ($getuser = $this->get_one("select " . $column . " from " . $table . " where " . $query_select . "")) {
                return $getuser[$column];
            }
        }
    }

    public function db_query($table, $query_select)
    {
        if (isset($table) && isset($query_select)) {
            $getUser = $this->query("select * from " . $table . " where " . $query_select . "");
            if ($getUser) {
                return $this->get_num_rows($getUser);
            }
        }
    }

    public function db_Update($table, $query_select, $where)
    {
        if (isset($table) && isset($query_select)) {
            $this->query("update " . $table . " Set " . $query_select . " where " . $where . "");
        }
    }

    public function fetch_array($query = null)
    {
        return $this->results->fetch(PDO::FETCH_ASSOC);
    }

    public function get_num_rows()
    {
        $this->results->rowCount();
    }

    public function insert($tablename, $array)
    {
        return $this->query("INSERT INTO `$tablename`(`" . implode('`,`', array_keys($array)) . "`) VALUES('" . implode("','", $array) . "')");
    }

    public function update($tablename, $array, $where = '')
    {
        $this->check_fields($tablename, $array);
        if ($where) {
            $sql = '';
            foreach ($array as $k => $v) {
                $sql .= ", `$k`='$v'";
            }
            $sql = substr($sql, 1);
            $sql = "UPDATE `$tablename` SET $sql WHERE $where";
        } else {
            $sql = "REPLACE INTO `$tablename`(`" . implode('`,`', array_keys($array)) . "`) VALUES('" . implode("','", $array) . "')";
        }
        return $this->query($sql);
    }

    public function check_fields($tablename, $array)
    {
        $fields = $this->get_fields($tablename);
        foreach ($array as $k => $v) {
            if (!in_array($k, $fields)) {
                $this->error("MySQL Query Error Unknown column '$k' in field list");
                return false;
            }
        }
    }

    public function get_fields($table)
    {
        $fields = array();
        $result = $this->get_all("SHOW COLUMNS FROM `$table`");
        foreach ($result as $r) {
            $fields[] = $r['Field'];
        }
        return $fields;
    }

    public function get_nums($sql)
    {
        $this->query($sql);
        return $this->results->rowCount();
    }
    public function insert_id(){
        return $this->pdo->lastInsertId();
    }
    public function begin()
    {
        $this->pdo->beginTransaction();
    }

    public function rollback()
    {
        $this->pdo->rollBack();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function query($sql)
    {
        return $this->process($sql);
    }
    public function close()
    {
        return $pdo = null;
    }
    private function process($sql, $array = array())
    {
        try {
            $this->results = $this->pdo->prepare($sql);
            return $this->results->execute($array);
        } catch (PDOException $error) {
            $this->error($error->getMessage());
        }
    }

    private function error($msg)
    {
        echo $msg, " \n";
        echo "Error number: ", $this->pdo->errorCode(), " \n";
        echo "Date: ", date('Y-m-d H:i:s'), " \n";
        echo "File: http://", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'], " \n";
        foreach ($this->pdo->errorInfo() as $v) if ($v) echo $v, "\n";
        exit;
    }

}