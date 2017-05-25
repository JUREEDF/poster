<?php
include_once('./admin/include/init.php');
//$_SESSION['user_id']=1;
include_once("./api/oauth.php");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="">
    <title>定制亲子间的精彩瞬间</title>
    <link rel="stylesheet" href="css/main.css?201705081947"/>
</head>
	<body>
		<div style="width:0px;height:0px;overflow:hidden">
		    <img src="img/share2.jpg?201705081947">
		</div>
		<div id="loading">
			<div class="loading_center">
				<div class="loading_bar">
					<li><img src="img/loading/images/loading_01.png?201705081947"></li>
					<li><img src="img/loading/images/loading_02.png?201705081947"></li>
					<li><img src="img/loading/images/loading_03.png?201705081947"></li>
					<li><img src="img/loading/images/loading_04.png?201705081947"></li>
					<li><img src="img/loading/images/loading_05.png?201705081947"></li>
					<li><img src="img/loading/images/loading_06.png?201705081947"></li>
					<li><img src="img/loading/images/loading_07.png?201705081947"></li>
					<li><img src="img/loading/images/loading_08.png?201705081947"></li>
					<li><img src="img/loading/images/loading_09.png?201705081947"></li>
					<li><img src="img/loading/images/loading_10.png?201705081947"></li>
					<li><img src="img/loading/images/loading_11.png?201705081947"></li>
					<li><img src="img/loading/images/loading_12.png?201705081947"></li>
					<li><img src="img/loading/images/loading_13.png?201705081947"></li>
					<li><img src="img/loading/images/loading_14.png?201705081947"></li>
					<li><img src="img/loading/images/loading_15.png?201705081947"></li>
					<li><img src="img/loading/images/loading_16.png?201705081947"></li>
					<li><img src="img/loading/images/loading_17.png?201705081947"></li>
					<li><img src="img/loading/images/loading_18.png?201705081947"></li>
				</div>
				<div class="progress">0%</div>
			</div>
		</div>
		<div class="music">
			<img src="img/publish/music.png?201705081947">
			<img src="img/publish/music_close.png?201705081947" class="hide">
		</div>
	
        <div id="page1">
            <img src="img/page1/images/word_01.png?201705081947" class="page1_1">
            <img src="img/page1/images/word_02.png?201705081947" class="page1_2">
            <img src="img/page1/images/word_03.png?201705081947" class="page1_3">
            <img src="img/page1/images/word_04.png?201705081947" class="page1_4">
            <img src="img/page1/images/word_05.png?201705081947" class="page1_5">
            <img src="img/page1/images/word_06.png?201705081947" class="page1_6">
            <img src="img/page1/images/word_07.png?201705081947" class="page1_7">
            <img src="img/page1/images/word_08.png?201705081947" class="page1_8">
            <img src="img/page1/images/word_09.png?201705081947" class="page1_9">
        </div>
		<div id="page2">
			<div class="create_btn">
				<img src="img/page2/create.png?201705081947" class="create_1">
				<img src="img/page2/create_btn.png?201705081947" class="create_2">
				<img src="img/page2/btn.png?201705081947" class="btn">
			</div>
			<div class="page2_mask"></div>
			<img src="img/page2/statement.png?201705081947" class="statement hide">
			
			<div class="statement_btn">
				<img src="img/page2/statement_btn.png?201705081947">
				<img src="img/page2/statement_not.png?201705081947">
			</div>
			
			<img src="img/page2/word_01.png?201705081947" class="word word_01">
			<img src="img/page2/word_02.png?201705081947" class="word word_02">
			<img src="img/page2/word_03.png?201705081947" class="word word_03">
			<img src="img/page2/word_04.png?201705081947" class="word word_04">
			<img src="img/page2/word_05.png?201705081947" class="word word_05">
		</div>
		
		<div id="page3">
			<img src="img/page3/img1.png?201705081947" class="img img1">
			<img src="img/page3/img2.png?201705081947" class="img img2">
			<img src="img/page3/img3.png?201705081947" class="img img3">
			<img src="img/page3/img4.png?201705081947" class="img img4">
			<img src="img/page3/page3_word_1.png?201705081947" class="page3_word_1">
			<img src="img/page3/page3_word_2.png?201705081947" class="page3_word_2">
		</div>
		
		<div id="page4">
			<div class="index_1 hide">
				<img src="img/page4/make1.png?201705081947" class="make1">
				<img src="img/page4/make1_btn.png?201705081947" class="make1_btn">
                <input class="file" type="file"  name="upfile" value="" accept="image/*" />
			</div>
			<div class="index_2 hide">
				<img src="img/page4/make2.png?201705081947" class="make2">
				<img src="img/page4/make2_btn.png?201705081947" class="make2_btn">
                <input class="file" type="file"  name="upfile" value="" accept="image/*" />
			</div>
			<div class="index_3 hide">
				<img src="img/page4/make3.png?201705081947" class="make3">
				<img src="img/page4/make3_btn.png?201705081947" class="make3_btn">
                <input class="file" type="file" name="upfile" value="" accept="image/*" />
			</div>
			<div class="index_4 hide">
				<img src="img/page4/make4.png?201705081947" class="make4">
				<img src="img/page4/make2_btn.png?201705081947" class="make4_btn">
			
					<input class="file" type="file"  name="upfile" value="" accept="image/*" />
				
			</div>
		</div>
		
		<div id="page5">
						
			<div class="c1 hide">
				<img src="img/page5/images/c1.png?201705081947">
			</div>
			
			<div class="c2 hide">
				<img src="img/page5/images/c2.png?201705081947">
			</div>
			
			<div class="c3 hide">
				<img src="img/page5/images/c3.png?201705081947">
			</div>
			
			<div class="c4 hide">
				<img src="img/page5/images/c4.png?201705081947">
			</div>
			
			<img src="" id="newImg"/>
            <canvas id="canvas_img"></canvas>
            
            <canvas id="canvas_end" class="hide"></canvas>
            <img src="" id="endImg" class="hide"/>

			<div id="poster_bg">
            	<img src="img/page5/images/c1bg.png?201705081947">
            </div>
            
            <div class="c3_top hide">
            	<img src="img/page5/images/c3_top.png?201705081947">
            </div>
            
            <!--生成提示-->
		    <div class="produce hide">
		        <div class="produce_mask"></div>
		        <p class="produce_tips">正在上传...</p>
		    </div>
            
            <div id="holding"></div>
            
            <div class="shang">
            	<img src="img/page5/shang_btn.png?201705081947">
				<img src="img/page5/shang.png?201705081947">
            </div>
			<div class="make">
				<img src="img/page5/make_btn.png?201705081947">
				<img src="img/page5/make.png?201705081947">
			</div>
			<div class="back">
				<img src="img/page5/back_btn.png?201705081947">
				<img src="img/page5/back.png?201705081947">
			</div>
			<div class="keep">
				<img src="img/page5/keep_btn.png?201705081947">
				<img src="img/page5/keep.png?201705081947">
			</div>
			<div class="bulid">
				<img src="img/page5/bulid_btn.png?201705081947">
				<img src="img/page5/bulid.png?201705081947">
			</div>
			<div class="share">
				<img src="img/page5/share_btn.png?201705081947">
				<img src="img/page5/share.png?201705081947">
			</div>
			<div class="drag">
				<img src="img/page5/drag.png?201705081947">
			</div>
			<div class="code hide">
				<img src="img/page5/code.jpg?201705081947">
			</div>
			
			<div class="loog_press hide">
				<img src="img/page5/loog_press.png?201705081947">
			</div>
			<div class="back_page5 hide">
				<img src="img/page5/back_page5.png?201705081947">
			</div>
		</div>
		
		<div class="share_page hide">
			<img src="img/publish/share_point.png?201705081947">
		</div>
		<div class="command_page hide">
			<img src="img/publish/command.png?201705081947">
			<div class="command_word" id="command_word"></div>
		</div>
		
		
		<div id="landscape"></div>
		<audio id="sound" loop="loop" src="media/sound.mp3?201705081947" style="opacity: 0;width:0;height: 0;visibility: hidden;"></audio>
	</body>

	<script>
		var sound=document.getElementById('sound');
		document.addEventListener("WeixinJSBridgeReady", function() {
			sound.load();			
		}, false);
		
		var version = "?201705081947"; //版本号
		var url = 'http://poster.c.cescvip.com/'; //此处放正式地址
		var prefix = ''; //此处放cdn
	</script>
	
	<script src="js/fastclick.js"></script>
	<script src="js/zepto.js"></script>
    <script src="js/alloy_paper.js"></script>
    <script src="js/alloy_finger.js"></script>
    <script src="js/main.js?201705101507"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script src="js/share.js?201705081947"></script>
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?691f31afaa4be11027e0db01be25aba6";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
    
</html>