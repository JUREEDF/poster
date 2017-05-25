FastClick.attach(document.body);//点击屏幕阻止页面跳动
$(function(){
	document.body.addEventListener('touchmove',function(e){
		e.preventDefault();
	},false);
	var ua = navigator.userAgent, wx = /MicroMessenger/i.test(ua), ios = /ip(?=od|ad|hone)/i.test(ua);
	
	//变量
	var initFlag = true;
    var portrait = false;
	//判断横屏
	function orien() {
        if(window.orientation== 90 || window.orientation == -90) {
            if(initFlag) {
                initFlag = false;
                portrait = true;
            }
            $("#landscape").show();
        } else {
            $("#landscape").hide();
            if(portrait) {
                location.reload();
            } else {
                if(initFlag) {
                    initFlag = false;
                    //开始执行游戏
					init();
					
                }
            }
        }
    }
    orien();
    $(window).on("orientationchange", orien);
    
    function init(){
    	var img_count = 0;
	    var imgData = [];
	    var imglist = [];
	    imgData.push('img/loading/loading_bg.jpg');
	    imgData.push('img/loading/loading_bar.png');
	   
	    for(var i=0;i<imgData.length;i++ ){
	        imglist[i] = new Image();
	        imglist[i].src =imgData[i];
	    }
	    var count = imglist.length;
	    for(var i in imglist){
	        imgLoad(imglist[i], function() {
	            img_count++;
	            if(img_count == count){
	                loading();
	            }
	        });
	    }
    }
    function imgLoad(img, callback) {
        var timer = setInterval(function() {
            if (img.complete) {
                callback();
                clearInterval(timer);
            }
        }, 50);
	}
    function loading(){
    	var img_count = 0;
	    var imgData = [];
	    var imglist = [];
//	    page1
	    imgData.push('img/page1/page1_bg.jpg');
	    for(var i=1;i<5;i++){
	    	imgData.push('img/page1/word_0'+i+'.png');
	    }
	    imgData.push('img/page1/foot1.png');
	    imgData.push('img/page1/foot2.png');
	    imgData.push('img/page1/love.png');
	    
//	    page2
	    imgData.push('img/page2/page2_bg.jpg');
	    imgData.push('img/page2/btn.png');
	    imgData.push('img/page2/create_btn.png');
	    imgData.push('img/page2/statement.png');
	    imgData.push('img/page2/statement_btn.png');
	    for(var i=1;i<6;i++){
	    	imgData.push('img/page2/word_0'+i+'.png');
	    }
	    
//		Page3
	    imgData.push('img/page3/page3_bg.jpg');
	    imgData.push('img/page3/page3_word.png');
		for(var i=1;i<5; i++){
	    	imgData.push('img/page3/img'+i+'.png');
	    }
		
//		page4
	    imgData.push('img/page4/page4_bg.jpg');
	    imgData.push('img/page4/make1.png');
	    imgData.push('img/page4/make2.png');
	    imgData.push('img/page4/make3.png');
	    imgData.push('img/page4/make4.png');
	    imgData.push('img/page4/make1_btn.png');
	    imgData.push('img/page4/make2_btn.png');
	    imgData.push('img/page4/make3_btn.png');
	    
//	    page5
	    imgData.push('img/page5/page5_bg.jpg');
	    imgData.push('img/page5/back.png');
	    imgData.push('img/page5/bulid.png');
	    imgData.push('img/page5/keep.png');
	    imgData.push('img/page5/make.png');
	    imgData.push('img/page5/share.png');
	    imgData.push('img/page5/code.jpg');
	    imgData.push('img/page5/enter_bg.png');
	    
	    imgData.push('img/page5/back_btn.png');
	    imgData.push('img/page5/bulid_btn.png');
	    imgData.push('img/page5/keep_btn.png');
	    imgData.push('img/page5/make_btn.png');
	    imgData.push('img/page5/share_btn.png');
	    
	    for(var i=0;i<imgData.length;i++ ){
	        imglist[i] = new Image();
	        imglist[i].src =imgData[i];
	    }
	    var count = imglist.length;
	    for(var i in imglist){
	        imgLoad(imglist[i], function() {	        	
	        	img_count++;	        	
	        	var loaderStep = Math.floor(img_count/count*100);
				$('.progress').text(loaderStep+'%');
	            if(img_count == count){
          			setTimeout(page1,1000);
	            }
	        });
	    }
    }	
    
    function page1(){
    	$('.music').fadeIn();
    	$('#page1').fadeIn();
		sound.play();
		if(!ios){
			$(document).on('touchstart',function(){
			
				sound.play();
			});
		}
//		文字一行行显示
		$('.page1_1').animate({'top':'2rem','opacity':1},600,function(){
			$('.page1_2').animate({'top':'2.54rem','opacity':1},600,function(){
				$('.page1_3').animate({'top':'3.08rem','opacity':1},600,function(){
					$('.page1_4').animate({'top':'3.62rem','opacity':1},600,function(){
						$('.love').addClass('love_run');
						$('.foot').fadeIn();
						$('.foot1').addClass('foot1_run');
						$('.foot2').addClass('foot2_run');
						$(document).on('tap',function(){
							page2();
							$(document).off('tap');
						});
					})
				})
			})
		})
    }
    function page2(){
    	$('#page2').fadeIn();
    	
    	$('.word_01').animate({'width':'3.83rem','opacity':1},800,function(){
    		$('.word_02').animate({'width':'3.83rem','opacity':1},800,function(){
    			$('.word_03').animate({'width':'3.83rem','opacity':1},800,function(){
    				$('.word_04').animate({'width':'3.83rem','opacity':1},800,function(){
    					$('.word_05').animate({'width':'3.83rem','opacity':1},800,function(){
    						$('.create_btn').fadeIn();
    						$('.btn').addClass('btn_run');
    						$('.create_btn').on('tap',function(){
					    		page3();
					    	})
    					})
    				})
    			})
    		})
    	});
    	
    	$('.statement_btn').on('mouseenter',function(){
    		$('.statement').removeClass('hide');
    	});
    	$('.statement_btn').on('mouseleave',function(){
    		$('.statement').addClass('hide');
    	});
    	
    	
    }
    
    function page3(){
    	$('#page3').fadeIn();
    	
    	$('#page3 img').on('tap',function(){
    		page4($(this).index());
    	})
    }
    
    
    function page4(num){
    	$('#page4').fadeIn(300);
    	if(num==0){
			$('.index_1').removeClass('hide');
    	}else if(num==1){
    		$('.index_2').removeClass('hide');
    	}else if(num==2){
    		$('.index_3').removeClass('hide');
    	}else if(num==3){
    		$('.index_4').removeClass('hide');
    	}
    	
    	$('.make1_btn').on("tap",function(){
    		//测试----------------------------
			page5();
    	})
    	$('.make2_btn').on("tap",function(){
    		
    	})
    	$('.make3_btn').on("tap",function(){
    		
    	})
    	$('.make4_btn').on("tap",function(){
    		
    	})
    }
    
    function page5(){
    	$('#page5').fadeIn(300);
   		$('#content').fadeIn();
//  	输入是生成海报按钮消失

//  	$('#content').focus(function(){
//  		$('.make').addClass('hide');
//  	})
//  	$('#content').blur(function(){
//  		$('.make').removeClass('hide');
//  	})
//  	
    	
    	
    	$('.make').on("touchstart",function(){
    		$('.make img').eq(1).addClass('hide');
    	});
    	$('.make').on("touchend",function(){
    		$('.make img').eq(1).removeClass('hide');
    		$('.make').fadeOut();
    		$('.back,.keep,.share,.make,.bulid').fadeIn();
    		setTimeout(function(){
    			$('#content').attr('disabled','disabled');
    		},300)
    		
//  		$('#content').attr('disabled','disabled');
//  		$('#content').blur();
    	});
    	
    	$('.back').on("touchstart",function(){
    		$('.back img').eq(1).addClass('hide');
    	});
    	$('.back').on("touchend",function(){
    		$('.back img').eq(1).removeClass('hide');
    		$('#page5').fadeOut();
    		page4();
    	});
    	
    	$('.keep').on("touchstart",function(){
    		$('.keep img').eq(1).addClass('hide');
    	});
    	$('.keep').on("touchend",function(){
    		$('.keep img').eq(1).removeClass('hide');
    		
    		//保存海报
    	});
    	
    	$('.bulid').on("touchstart",function(){
    		$('.bulid img').eq(1).addClass('hide');
    	});
    	$('.bulid').on("touchend",function(){
    		$('.bulid img').eq(1).removeClass('hide');
    		
    		//生成猫口令
    	});
    	
    	$('.share').on("touchstart",function(){
    		$('.share img').eq(1).addClass('hide');
    	});
    	$('.share').on("touchend",function(){
    		$('.share img').eq(1).removeClass('hide');
    		
    		//分享海报
    	});
    	
    }
	
	
//	音乐播放
    var music_flag=true;
    $(".music").on("tap",function (e) {
        if(music_flag){
            $(".music img").eq(1).removeClass('hide');
            music_flag=false;
            $('#sound')[0].pause();
        }else{
            $(".music img").eq(1).addClass('hide');
            music_flag=true;
            $('#sound')[0].play();
        }
    });
	
})