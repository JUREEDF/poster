FastClick.attach(document.body);//点击屏幕阻止页面跳动
$(function(){
	$("body").on("touchmove",function(e){
        e.preventDefault();
    });
	
	var ua = navigator.userAgent, wx = /MicroMessenger/i.test(ua), ios = /ip(?=od|ad|hone)/i.test(ua);
	
	
	
	//变量
	var initFlag = true;
    var portrait = false;
    var depict; //描述文字
    var scene;
    var Poster_id;
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
	    
	    for(var i=1;i<10;i++){
	    	imgData.push('img/loading/images/loading_0'+i+'.png');
	    }
	    for(var i=0;i<9;i++){
	    	imgData.push('img/loading/images/loading_1'+i+'.png');
	    }
	   
	    for(var i=0;i<imgData.length;i++ ){
	        imglist[i] = new Image();
	        imglist[i].src =imgData[i]+version;
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

	    for(var i=1;i<10;i++){
	    	imgData.push('img/page1/images/word_0'+i+'.png');
	    }
	    
	    
//	    page2
	    imgData.push('img/page2/page2_bg.jpg');
	    imgData.push('img/page2/btn.png');
	    imgData.push('img/page2/create.png');
	    imgData.push('img/page2/create_btn.png');
	    imgData.push('img/page2/statement.png');
	    imgData.push('img/page2/statement_btn.png');
	    imgData.push('img/page2/statement_not.png');
	    imgData.push('img/page2/music.png');
	    for(var i=1;i<6;i++){
	    	imgData.push('img/page2/word_0'+i+'.png');
	    }
	    
//		Page3
	    imgData.push('img/page3/page3_bg.jpg');
	    imgData.push('img/page3/page3_word_1.png');
	    imgData.push('img/page3/page3_word_2.png');
	    
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
	    imgData.push('img/page5/back.png');
	    imgData.push('img/page5/bulid.png');
	    imgData.push('img/page5/keep.png');
	    imgData.push('img/page5/make.png');
	    imgData.push('img/page5/share.png');
	    imgData.push('img/page5/back_page5.png');
	    imgData.push('img/page5/drag.png');
	    imgData.push('img/page5/shang.png');
	    imgData.push('img/page5/loog_press.png');
	    imgData.push('img/page5/shang_btn.png');
	    imgData.push('img/page5/back_btn.png');
	    imgData.push('img/page5/bulid_btn.png');
	    imgData.push('img/page5/keep_btn.png');
	    imgData.push('img/page5/make_btn.png');
	    imgData.push('img/page5/share_btn.png');
	    imgData.push('img/page5/images/c3_top.png');
	    imgData.push('img/page5/code.jpg');
	    imgData.push('img/page5/page5_bg1.jpg');
	    for(var i=1;i<5;i++){
	    	imgData.push('img/page5/images/c'+i+'.png');
	    	imgData.push('img/page5/images/c'+i+'bg.png');
	    }
	    
//	    publish
	    imgData.push('img/publish/command.png');
	    imgData.push('img/publish/music.png');
	    imgData.push('img/publish/music_close.png');
	    imgData.push('img/publish/share_point.png');
	    
	    
	    for(var i=0;i<imgData.length;i++ ){
	        imglist[i] = new Image();
	        imglist[i].src =imgData[i]+version;
	    }
	    var count = imglist.length;
	    for(var i in imglist){
	        imgLoad(imglist[i], function() {	        	
	        	img_count++;	        	
	        	var loaderStep = Math.floor(img_count/count*100);
				$('.progress').text(loaderStep+'%');
				
				switch (loaderStep)
				{
					case 1:
						$('.loading_bar img').eq(0).fadeIn(0);
					break;
					case 7:
						$('.loading_bar img').eq(1).fadeIn(0);
					break;
					case 11:
						$('.loading_bar img').eq(2).fadeIn(0);
					break;
					case 16:
						$('.loading_bar img').eq(3).fadeIn(0);
					break;
					case 22:
						$('.loading_bar img').eq(4).fadeIn(0);
					break;
					case 27:
						$('.loading_bar img').eq(5).fadeIn(0);
					break;
					case 33:
						$('.loading_bar img').eq(6).fadeIn(0);
					break;
					case 39:
						$('.loading_bar img').eq(7).fadeIn(0);
					break;
					case 47:
						$('.loading_bar img').eq(8).fadeIn(0);
					break;
					case 50:
						$('.loading_bar img').eq(9).fadeIn(0);
					break;
					case 55:
						$('.loading_bar img').eq(10).fadeIn(0);
					break;
					case 60:
						$('.loading_bar img').eq(11).fadeIn(0);
					break;
					case 66:
						$('.loading_bar img').eq(12).fadeIn(0);
					break;
					case 72:
						$('.loading_bar img').eq(13).fadeIn(0);
					break;
					case 80:
						$('.loading_bar img').eq(14).fadeIn(0);
					break;
					case 86:
						$('.loading_bar img').eq(15).fadeIn(0);
					break;
					case 92:
						$('.loading_bar img').eq(16).fadeIn(0);
					break;
					case 100:
						$('.loading_bar img').eq(17).fadeIn(0);
					break;
					
				}
				
	            if(img_count == count){
          			setTimeout(page1,1000);
	            }
	        });
	    }
    }

    function page1(){
    	
    	$('#loading').remove();
    	$('.music').fadeIn();
    	$('#page1').fadeIn();
		sound.play();
		$('.music').addClass('music_run');
		if(!(ios&&wx)){
			$(document).one('touchstart',function(){
			
				$(".music img").eq(1).addClass('hide');
	            $('.music').addClass('music_run');
	            music_flag=true;
	            sound.play();
			});
		}
//		文字一行行显示

		setTimeout(function(){
			$('.page1_1').animate({'top':'2rem','opacity':1},600,function(){
				$('.page1_2').animate({'top':'2.54rem','opacity':1},600,function(){
					$('.page1_3').animate({'top':'3.08rem','opacity':1},600,function(){
						$('.page1_4').animate({'top':'3.62rem','opacity':1},600,function(){
	                        $('.page1_5').animate({'top':'4rem','opacity':1},600,function() {
	                            $('.page1_6').animate({'top':'4.54rem','opacity':1},600,function() {
	                                $('.page1_7').animate({'top':'5.08rem','opacity':1},600,function() {
	                                    $('.page1_8').animate({'top':'5.62rem','opacity':1},600,function() {
	                                        $('.page1_9').animate({'top':'6.16rem','opacity':1},600,function() {
	                               
	                                            $(document).on('touchend',function(){
	                                            	$(document).off('touchend');
	                                                page2();
	                                                
	                                            });
	                                        })
	                                    })
	                                })
	                            })
	                        })
	
						})
					})
				})
			})
		},600);
		
    }
    function page2(){
    	$('#page2').fadeIn(500);
        $('#page1').fadeOut(500);

		setTimeout(function(){
			$('.word_01').fadeIn(800,function(){
				$('.word_02').fadeIn(800,function(){
					$('.word_03').fadeIn(800,function(){
						$('.word_04').fadeIn(800,function(){
							$('.word_05').fadeIn(800,function(){
								$('.create_btn').fadeIn();
	    						$('.btn').addClass('btn_run');
	    						
	    						$('.create_btn').on('touchstart',function(){
	    							$('.create_2').addClass('hide');
	    								
						    	})
	    						$('.create_btn').on('touchend',function(){
	    							$('.create_2').removeClass('hide');
						    		page3();
						    	})
							})
						})
					})
				})
			})
		},600)
		


    	$('.statement_btn').on('touchstart',function(){
    		
    		$('.statement_btn img').eq(1).addClass('hide');
    		
    		if($('.statement').hasClass('hide')){
    			$('.statement').removeClass('hide');
    			$('.page2_mask').fadeIn();
    		}else{
    			$('.statement').addClass('hide');
    			$('.page2_mask').fadeOut();
    		}
    		
    		return false;
    	});
    	$('.statement_btn').on('touchend',function(){
    		$('.statement_btn img').eq(1).removeClass('hide');
//  		$('.page2_mask').fadeOut();
    	});
    	$('#page2').on('touchstart',function(){
    		$('.statement').addClass('hide');
    		$('.page2_mask').fadeOut();
    	});
    }

    function page3(){
 
    	$('#page3').fadeIn(500);
        $('#page2').fadeOut(500);
    	$('.img').on('touchend',function(){
    		page4($(this).index());
    	})
    }

    var src;
    function page4(num){
    	$('#holding').fadeIn();
    	$('#page4').fadeIn(300);
        $('#page3').fadeOut(300);
        
    	if(num==0){
    		scene=0;
    		$('.c1').removeClass('hide');
    		$('.c2').addClass('hide');
    		$('.c4').addClass('hide');
    		$('.c3').addClass('hide');
    		
			$('.index_1').removeClass('hide');
            src="img/page5/1.png";
            $(".file").css({
            	'width': '1.8rem',
				'height': '1.7rem',
				'top': '2.3rem',
				'left': '50%',
				'marginLeft':'-0.9rem'
            });
            
            $('#newImg').css({
				'width':'4.4rem',
				'height':'2.2rem',
				'top':'2.75rem',
				'left':'50%',
				'marginLeft':'-2.2rem'
			})
            
            $('#canvas_img').css({
            	'width':'4.4rem',
				'height':'2.2rem',
				'top':'2.75rem',
				'left':'50%',
				'marginLeft':'-2.2rem'
            })
            
            $('#poster_bg img').attr('src','img/page5/images/c1bg.png?201705081947');
    	}else if(num==1){
    		$('.c2').removeClass('hide');
    		$('.c1').addClass('hide');
    		$('.c4').addClass('hide');
    		$('.c3').addClass('hide');
    		scene=1;
    		$('.index_2').removeClass('hide');
            src="img/page5/2.png";
            $(".file").css({
            	'width': '1.37rem',
				'height': '1.60rem',
				'top': '1.98rem',
				'left': '50%',
				'marginLeft':'-0.67rem'
            })
            
            $('#newImg').css({
				'width':'5.4rem',
				'height':'2.7rem',
				'top':'2.35rem',
				'left':'50%',
				'marginLeft':'-2.7rem'
			})
            
            $('#canvas_img').css({
            	'width':'5.4rem',
				'height':'2.7rem',
				'top':'2.35rem',
				'left':'50%',
				'marginLeft':'-2.7rem'
            })
            
            
            $('#poster_bg img').attr('src','img/page5/images/c2bg.png?201705081947');
    	}else if(num==2){
    		$('.c3').removeClass('hide');
    		$('.c2').addClass('hide');
    		$('.c4').addClass('hide');
    		$('.c1').addClass('hide');
    		scene=2;
    		$('.index_3').removeClass('hide');
			$('#newImg').fadeOut();
    		$('#canvas_img').fadeOut();
    		$('#canvas_shoe').show();
    		
            src="img/page5/3.png";
            $(".file").css({
            	'width': '2rem',
				'height': '2rem',
				'top': '3.3rem',
				'left': '50%',
				'marginLeft':'-1.4rem'
            })
            
             $('#newImg').css({
				'width':'4.8rem',
				'height':'2.4rem',
				'top':'3.75rem',
				'left':'50%',
				'marginLeft':'-2.5rem'
			})
            
            $('#canvas_img').css({
            	'width':'4.8rem',
				'height':'2.4rem',
				'top':'3.75rem',
				'left':'50%',
				'marginLeft':'-2.5rem'
            })
           
            
            $('#poster_bg img').attr('src','img/page5/images/c3bg.png?201705081947');
    	}else if(num==3){
    		$('.c4').removeClass('hide');
    		$('.c2').addClass('hide');
    		$('.c3').addClass('hide');
    		$('.c1').addClass('hide');
    		scene=3;
    		$('.index_4').removeClass('hide');
            src="img/page5/4.png";
            $(".file").css({
            	'width': '1.37rem',
				'height': '1.60rem',
				'top': '1.98rem',
				'left': '50%',
				'marginLeft':'-0.67rem'
            })
            
            $('#newImg').css({
				'width':'4.6rem',
				'height':'2.3rem',
				'top':'2.5rem',
				'left':'50%',
				'marginLeft':'-2.3rem'
			})
           
            $('#canvas_img').css({
            	'width':'4.6rem',
				'height':'2.3rem',
				'top':'2.5rem',
				'left':'50%',
				'marginLeft':'-2.3rem'
            })
            
            $('#poster_bg img').attr('src','img/page5/images/c4bg.png?201705081947');
    	}
    }

    var new_img_src;
	var new_img=new Image();
	
	var new_img_shoe;
	var showImg=new Image();
	
	var code=new Image();
	code.src='img/page5/code.jpg?201705081947';
	
	
	var c1=new Image();
	c1.src='img/page5/images/c1.png?201705081947';
	var c2=new Image();
	c2.src='img/page5/images/c2.png?201705081947';
	var c3=new Image();
	c3.src='img/page5/images/c3.png?201705081947';
	
	var c3_top=new Image();
	c3_top.src='img/page5/images/c3_top.png?201705081947';
	
	var c4=new Image();
	c4.src='img/page5/images/c4.png?201705081947';
	
	var endimg;
    function page5(){
    	$('#page5').fadeIn(500);
        $('#page4').fadeOut(500);
    }
    // 1 2 3 4 图片 最后生成的canvas
    var canvas_end=document.getElementById("canvas_end");;
    var ctx2=canvas_end.getContext("2d");
    
     // 1 2 3 4 图片 开始上传生成的canvas
    var mycanvas = document.getElementById("canvas_img");
    var ctx1 = mycanvas.getContext("2d");

    
    $(function(){
        var bgimg;
        
        $(".file").on("change",function(){
        	$('.produce').removeClass('hide');
        	
        	$('.index_1,.index_2,.index_3,.index_4').addClass('hide');
        	$("#canvas_img").show(); 
        	
            $('#newImg').hide();
            $('.shang').fadeIn();
            $('.make').fadeIn();
            $('.drag').fadeIn();
            $('.back,.keep,.share,.bulid').fadeOut();
            
            if(scene==2){
            	$('.c3_top').removeClass('hide');
            }else{
            	$('.c3_top').addClass('hide');
            }
            
            $('#showImg').hide();
    		
            var imgurl='';
            
            var _that=this
            
            var reader = new FileReader(); 
			reader.readAsDataURL(_that.files[0]); 
			reader.onload = function(e){ 
				
			imgurl=this.result
			
			$.ajax({
    			type:'POST',
				url: './api/api.php?status=posterInsert',
				data:{'image':imgurl},
				dataType: 'json',
				success: function (res) {
					if (res.code == 6) {
						console.log('成功');
					}
					Poster_id=res.data.poster_id;
				}
			});	
				
           	var choseImg;   
            choseImg = new Image();

            choseImg.src = imgurl;

            choseImg.onload = function () {
            	$('.produce').addClass('hide');
            	
                page5();
                ;(function (AlloyPaper) {
                	
                    var Stage = AlloyPaper.Stage, Bitmap = AlloyPaper.Bitmap,Loader=AlloyPaper.Loader;
                    var stage = new Stage("#canvas_img");
                    stage.autoUpdate=false;
                    
                	var bmp = new Bitmap(choseImg);
                    bmp.originX = 0.5;
                    bmp.originY = 0.5;
		            bmp.x = stage.width / 2;
		            bmp.y = stage.height / 2;
                 
                    stage.add(bmp);

                    stage.update();

                    var initScale = 1;
                    new AlloyFinger('#holding', {
		                multipointStart: function () {
		                    initScale = bmp.scaleX;
		                    
		                },
		                rotate: function (evt) {
		                    bmp.rotation += evt.angle;
							stage.update();
		                },
		                pinch: function (evt) {
		                	bmp.scaleX = initScale * evt.scale;
		                    bmp.scaleY = initScale * evt.scale;
		                    
							stage.update();
		                },
		                pressMove: function (evt) {
		                    bmp.x += evt.deltaX;
		                    bmp.y += evt.deltaY;
		                    evt.preventDefault();
							stage.update();
		                }
		            });
                })(AlloyPaper)

            }
			} 
        })
    });
    
    function selectText(element){
    	var doc=document,
    	text=doc.getElementById(element),
    	range,
    	selection;
    	if(doc.body.createTextRange){
    		range=document.body.createTextRange();
    		range.moveToElementText(text);
    		range.select();
    	}else if(window.getSelection){
    		selection=window.getSelection();
    		range=document.createRange();
    		range.selectNodeContents(text);
    		selection.removeAllRanges();
    		selection.addRange(range);
    	}
    }
    
    $('.shang').on("touchstart",function(){
    		$('.shang img').eq(1).addClass('hide');
    	})
    	$('.shang').on("touchend",function(){
    		$('.shang img').eq(1).removeClass('hide');
    		$(".file").val('');
    		$('#page5').fadeOut();
    		
    		console.log(scene);
    		page4()
    		if(scene==0){
    			$('.index_1').removeClass('hide');
    		}else if(scene==1){
    			$('.index_2').removeClass('hide');
    		}else if(scene==2){
    			$('.index_3').removeClass('hide');
    		}else if(scene==3){
    			$('.index_4').removeClass('hide');
    		}
    	})
    	
    	
    	$('.make').on("touchstart",function(){
    		$('.make img').eq(1).addClass('hide');
    		
    	});
    	$('.make').on("touchend",function(){
    		
				$('#holding').fadeOut();
				new_img_src = mycanvas.toDataURL("image/jpg");
				new_img.src=new_img_src;
				
	            $('#newImg').show();
	            $('#newImg').attr('src', new_img_src);	
				$('.code').fadeIn();
	            $("#canvas_img").hide();
	    		$('.make img').eq(1).removeClass('hide');
	    		$('.shang').hide();
	    		$('.make').hide();
	    		$('.drag').hide();
	    		$('.back,.keep,.share,.bulid').fadeIn();
	    		setTimeout(function(){
	    			$('#content').attr('disabled','disabled');
	    		},300)
	    		
				
				//保存海报
				endimg = new Image();
				endimg.src='';
				if(scene==0){
					endimg.src ='img/page5/images/c1bg.png?201705081947';
				}else if(scene==1){
					endimg.src = 'img/page5/images/c2bg.png?201705081947';
				}else if(scene==2){
					endimg.src = 'img/page5/images/c3bg.png?201705081947';
				}else if(scene==3){
					endimg.src = 'img/page5/images/c4bg.png?201705081947';
				}
				$('#canvas_shoe').hide();
				

				endimg.onload = function () {
		            canvas_end.width = endimg.width;
		            canvas_end.height = endimg.height;
	        	};
//				
			
    	});
    	
    	//上一步
    	$('.back').on("touchstart",function(){
    		$('.back img').eq(1).addClass('hide');
    	});
    	$('.back').on("touchend",function(){
    		page3();
    		$('.back img').eq(1).removeClass('hide');
    		$('#page5').hide();
    		$('.code').hide();
    		$('#content').removeAttr('disabled');
    		$('#content').val('');
    		
    		$(".file").val('');
    		$('content').val('');
    		
    		$('#newImg').attr('src','');
    		$('#endImg').attr('src','');
    		
    		$('#poster_bg').fadeIn();
    		
    		$('.c1').addClass('hide');
    		$('.c2').addClass('hide');
    		$('.c4').addClass('hide');
    		$('.shoe_bottom').addClass('hide');
    	});
    	
    	var end_img_src
    	//保存海报
    	$('.keep').on("touchstart",function(){
    		$('.keep img').eq(1).addClass('hide');
    	});
    	$('.keep').on("touchend",function(){

    		$('.code').hide();
    		$('.keep img').eq(1).removeClass('hide');
    		
    		$('#poster_bg').fadeOut();
    		
    		$('.back,.keep,.share,.bulid').hide();
    		
			if(scene==0){
				$('.c1').addClass('hide');
				ctx2.drawImage(c1,170,244);
				ctx2.drawImage(new_img ,50,244,440,220);
				ctx2.drawImage(endimg,0,0);
				ctx2.drawImage(code, 392, 628,110,110);
				end_img_src = canvas_end.toDataURL("image/jpg");
	            $('#endImg').show();
	            $('#endImg').attr('src', end_img_src);
			}else if(scene==1){
				$('.c2').addClass('hide');
				ctx2.drawImage(c2,185,215);
				ctx2.drawImage(new_img ,0 ,203,540 ,270);
				ctx2.drawImage(endimg, 0, 0);
				ctx2.drawImage(code, 392, 628,110,110);
				end_img_src = canvas_end.toDataURL("image/jpg");
	            $('#endImg').show();
	            $('#endImg').attr('src', end_img_src);
			}else if(scene==2){
				$('.c3').addClass('hide');
				$('.c3_top').addClass('hide');

				ctx2.drawImage(c3 ,114,351);
				ctx2.drawImage(new_img ,20,344,480,240);
				ctx2.drawImage(endimg,0,0);
				ctx2.drawImage(c3_top ,114,351);
				ctx2.drawImage(code, 392, 628,110,110);

				end_img_src = canvas_end.toDataURL("image/jpg");
	            $('#endImg').show();
	            $('#endImg').attr('src', end_img_src);

			}else if(scene==3){
				$('.c4').addClass('hide');
				ctx2.drawImage(c4,185,215);
				ctx2.drawImage(new_img, 41,218,460,230);
				ctx2.drawImage(endimg, 0, 0);
				ctx2.drawImage(code, 392, 628,110,110);
				end_img_src = canvas_end.toDataURL("image/jpg");
	            $('#endImg').show();
	            $('#endImg').attr('src', end_img_src);
			}
			
			$.ajax({
    			type:'POST',
				url: './api/api.php?status=imageInsert',
				data:{'image':end_img_src,'poster_id':Poster_id},
				dataType: 'json',
				success: function (res) {
					if (res.code == 6) {
						console.log('成功');
					}
				}
			});	
			
    		$('.loog_press').removeClass('hide');
    		
    		$('#showImg').hide();
    		$('#canvas_shoe').hide();
    		
            
            $('.loog_press').removeClass('hide');
    		$('.back_page5').removeClass('hide');
    		
    		$('.back_page5').on("touchend",function(){
    			$('.loog_press').addClass('hide');
    			$('.back_page5').addClass('hide');
    			
    			$('.back,.keep,.share,.bulid').fadeIn();
    			
    			$('.c3_top').addClass('hide');
    		});
    	});
    
    	var num = GetRandomNum(1,2);  
    	$('.bulid').on("touchstart",function(){
    		$('.bulid img').eq(1).addClass('hide');
    	});
    	$('.bulid').on("touchend",function(){
    		
    		
    		$('.bulid img').eq(1).removeClass('hide');
    		
    		$('.command_page').fadeIn();
    		
    		$('.command_page').on('touchend',function(){
                $('.command_page').fadeOut();
                $('.command_page').off('touchend');
                $('.command_word').off('touchend');
            });
            
            $('.command_word').on('touchend',function(){
            	return false;
            })
            
            if(ios){
            	$('.command_word').on('touchstart',function(){
	            	setTimeout(function(){
	            		selectText('command_word');
	            	}, 800)
	            })
            }
			
			var http_word;
			if(scene==0){
//				
				if(num==1){
					http_word='【天猫520亲子节小怪兽定制款让你的宝宝自作主张】，使用￥英氏520亲子节定制￥抢先预览（长按复制整段文案，打开手机淘宝即可进入活动内容）';
				}else{
					http_word='￥天猫520亲子节安奈儿童装小怪兽定制一份属于孩子的成长记忆￥';
				}
				
			}else if(scene==1){
				http_word='复制整段信息，打开天猫APP，即可查看此商品:【【5月30日发货】天猫520亲子节巴拉巴拉让宝宝自己设计限量定制款】(未安装App点这里：http://zmnxbc.com/s/Pe7Yj?tm=2d8572 )喵口令';
			}else if(scene==2){
				http_word='【天猫520亲子节 CROCS童鞋小怪兽定制款让孩子的想象成为现实】，点击链接再选择浏览器打开http://c.b0yp.com/h.TIhsky?cv=0YnAZGLMi0U&sm=05d319，或复制这条信息￥0YnAZGLMi0U￥后打开手机淘宝';
			}else if(scene==3){
				
				if(num==1){
					http_word='【天猫520亲子节小怪兽定制款让你的宝宝自作主张】，使用￥英氏520亲子节定制￥抢先预览（长按复制整段文案，打开手机淘宝即可进入活动内容）';
				}else{
					http_word='复制整段信息，打开天猫APP，即可查看此商品:【【天猫520亲子节小怪兽定制款  安踏儿童让孩子的梦想成真】】(未安装App点这里：http://zmnxbc.com/s/Ujxgj?tm=bb3697 )喵口令';
				}
			}

    		$('.command_word').html(http_word);
	    	
    	});
    	
    	$('.share').on("touchstart",function(){
    		$('.share img').eq(1).addClass('hide');
    	});
    	$('.share').on("touchend",function(){
    		$('.share img').eq(1).removeClass('hide');
    		
    		
    		$('.share_page').fadeIn();
    		setTimeout(function(){
    			$('.share_page').fadeOut();
    		},2000)
    		//分享海报
    	});
    
    
    
    //随机数
    function GetRandomNum(Min,Max){   
		var Range = Max - Min;   
		var Rand = Math.random();   
		return(Min + Math.round(Rand * Range));   
	}   

//	音乐播放
    var music_flag=true;
    $(".music").on("touchstart",function (e) {
        if(music_flag){
            $(".music img").eq(1).removeClass('hide');
            $('.music').removeClass('music_run');
            music_flag=false;
            sound.pause();
        }else{
            $(".music img").eq(1).addClass('hide');
            $('.music').addClass('music_run');
            music_flag=true;
            sound.play();
        }
    });
	
});