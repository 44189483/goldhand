var app = 'gold-hand';

$(function() {
	var orientationText = '<div class="orientationText" style="position:fixed;top:0;padding-top:20px;background:#000;z-index:1000000;width:100%;color:#FFFFFF;font-size:2em;text-align:center;height:100%;lin-height:100%;vertical-align: middle;"><div class=""><img src="img/rotate.png" width="148"></div>请调整到合适屏幕阅读<div>'
	if (window.orientation === 180 || window.orientation === 0) {
		$(".orientationText").remove();
	}
	if (window.orientation === 90 || window.orientation === -90) {
		$("body").append(orientationText);
	}
	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function() {
		if (window.orientation === 180 || window.orientation === 0) {
			$(".orientationText").remove();
		}
		if (window.orientation === 90 || window.orientation === -90) {
			$("body").append(orientationText);
		}
	}, false);



	//背景滚动

    var windowH=window.screen.availHeight;
    var windowW=window.screen.availWidth;
    var offsetL=$('.rollBg').offset().left;
	var offsetT=$('.rollBg').offset().top;

	//	$('.rollBg').stop().animate({
	//		'transform':' translate3d(0,-3920px,0)',
	//		'-webkit-transform':'translate3d(0,-3920px,0)',
	//	}, 5000, function () {
	//      $(this).css({ 'transform':'none',
	//		'-webkit-transform':'none'
	//		}).find(".rollBg").appendTo(this);
	//  });

	//------------------------------按住手指触动动画start-------------------------------------
	var count;
	var n;
	var last;
	var touchEvents = {
		touchstart: "touchstart",
		touchmove: "touchmove",
		touchend: "touchend",
	//       判断是否pc设备，若是pc，需要更改touch事件为鼠标事件，否则默认触摸事件
	//      initTouchEvents: function () {
	//          if (isPC()) {
	//              this.touchstart = "mousedown";
	//              this.touchmove = "mousemove";
	//              this.touchend = "mouseup";
	//          }
	//      }
	};
	
	//手指触动开始
   var startX = 0, startY = 0;
	$('.handimg').bind(touchEvents.touchstart, function(event) {
		event.preventDefault();
		countNum($('.time-num'),$('.timeDis'));
		$('.handover').stop().animate({
			'height': 244
		}, 1000);
		 var touch = event.originalEvent.targetTouches[0]; //获取第一个触点
        var x = Number(touch.pageX); //页面触点X坐标
        var y = Number(touch.pageY); //页面触点Y坐标
        //记录触点初始位置
        startX = x;
        startY = y;
 
		$(".status").html('');
		$(".timeDis").html('');

	});
	$('.handimg').bind(touchEvents.touchmove, function(event) {
		event.preventDefault();
		var touch = event.originalEvent.targetTouches[0]; //获取第一个触点
        var x = Number(touch.pageX); //页面触点X坐标
        var y = Number(touch.pageY); //页面触点Y坐标
        if(x-startX>100||y-startY>100){
        	$('.handover').stop(true);
			$('.handover').animate({
				'height': 0
			}, 200);
			clearInterval(count);
			$('.handimg').hide();
			if(n<1000){
				$('.lessTouch').fadeIn();
			}
			if(n==1000){
				$('.bestTouch').fadeIn();
			}
			if(n>1000){
				$('.moreTouch').fadeIn();
			}
			$('.time-title').text('本次计时（秒）');
			$('.roundTime-rotate').removeClass('rotateAnimation').stop().addClass('rotateOut').stop(false, true).fadeOut();
			$('.roundTime-tip').fadeOut();
			$('.time').fadeIn(1000);
        }else{
        	
        }
		

	});
	//手指触动结束
	$('.handimg').bind(touchEvents.touchend, function(event) {
		event.preventDefault();
		$('.touch-tipText').hide();
		$('.handover').stop(true);
		$('.handover').animate({
			'height': 0
		}, 200);
		clearInterval(count);
		$('.handimg').hide();
		if(n<1000){
			$('.lessTouch').fadeIn();
			$(".status").html('less');
			//AJAX无刷新
	        $.post("../"+app+"/ajax.php?type=getPid&hadprize=1", function(data){
			   $(".seePrize").html(data);
			});
		}
		if(n==1000){

			$('.bestTouch').fadeIn();
			$(".status").html('better');

			//AJAX无刷新
			$.post("http://rjh.aidimedia.cn/gold-hand/ajax.php?type=getPid", function(data){
				$(".seePrize").html(data);
			});

			WeixinJSBridge.call('showOptionMenu');

		}
		if(n>1000){

			$('.moreTouch').fadeIn();

			$(".status").html('more');
			//AJAX无刷新
	        $.post("../"+app+"/ajax.php?type=getPid&hadprize=1", function(data){
			   $(".seePrize").html(data);
			});

		}
		$('.time-title').text('本次计时（秒）');
		$('.roundTime-rotate').removeClass('rotateAnimation').stop().addClass('rotateOut').stop(false, true).fadeOut();
		$('.roundTime-tip').fadeOut();
		$('.time').fadeIn(1000);
	});
	//重新开始游戏
	$('.again').click(function(){
		clearInterval(count);
		$('.time').fadeIn(600);
		$('.touch-tipText').show();
		$('.time-title').text('计时（秒）');
		$('.time-num').text('0.00');
		$('.handimg').fadeIn(600);
		$('.lessTouch').hide();
		$('.bestTouch').hide();
		$('.moreTouch').hide();
		$('.roundTime-rotate').addClass('rotateAnimation').removeClass('rotateOut').hide();
		$('.roundTime-tip').hide();
		$(".status").html('');
		$(".timeDis").html('');
	})
	//计时
	function countNum(param,param1) {
		var param = param;
		var s = 0; //秒
		var m = 0; //第一位小数
		var mi = 0; //第二位小数
		n = 0; //计数
		last=0;
		count = setInterval(function() {
			n += 1;
			if (n < 10) {
				s = '0';
				m = '.0';
				mi = n;
				
				last='9.9'+(10-mi)+'s';
				
			} else if (n >= 10 && n < 100) {
				s = '0';
				m = '.' + Math.floor(n / 10);
				mi = Math.floor(n % 10);
				
				if(mi==0){
					last='9.'+(10-Math.floor(n / 10))+(0-mi)+'s';
				}else{
					last='9.'+(9-Math.floor(n / 10))+(10-mi)+'s';
				}
				
				
			} else if (n >= 100 && n < 1000) {
				s = '0' + Math.floor(n / 100);
				m = '.' + Math.floor(n / 10) % 10;
				mi = Math.floor(n % 10);
				
				if(mi==0){
					if(m==0){
						last=10-Math.floor(n / 100)+'.'+(0- Math.floor(n / 10) % 10)+(0-mi)+'s';
					}else{
						last=9-Math.floor(n / 100)+'.'+(10- Math.floor(n / 10) % 10)+(0-mi)+'s';
					}
				}else{
					last=9-Math.floor(n / 100)+'.'+(9- Math.floor(n / 10) % 10)+(10-mi)+'s';
				}
				
				
				if(n>=200){
					$('.time').fadeOut();
					$('.roundTime-rotate').fadeIn();
					$('.roundTime-tip').fadeIn();
				}
				
			} else if (n >= 100 && n < 6000) {
				s = Math.floor(n / 100);
				m = '.' + Math.floor(n / 10) % 10;
				mi =Math.floor(n % 10);
				
				last=Math.floor(n / 100)-10+'.'+Math.floor(n / 10) % 10+Math.floor(n % 10)+'s';
				
			} else if (n >= 6000) {
				s = '失败';
				m = '';
				mi = '';
				clearInterval(count);
				param1.parent().text('挑战失败');
			}
			param.text(s + m + mi);//时间赋值
			param1.text(last);//和金手指相差的秒数

		}, 10);
		
	}
	//--------------------------按住手指触动动画end---------------------------------------
	
	
	//----------------弹出层start------------------
		$('.acceptPrize').click(function(){
			$('.popUp').fadeIn();
			
		})
		$('.btn-ok').click(function(){
			$('.popUp').fadeOut();
			$('.prize-img img').addClass('prize-img-gray');
			$('.accepted-img').show();
			$('.after-accept').show();
			$('.before-accept').hide();

			//AJAX无刷新
	        $.post("../"+app+"/ajax.php?type=award", function(data){
			});

		});
		$('.btn-cancle').click(function(){
			$('.popUp').fadeOut();
		})
	
	//----------------弹出层end------------------
	
});

//分享提示层
$(document).ready(function(){    
    if ($(".btn_again").length>0) {
        $(".btn_again").click(function(){
            $(".alertpage").show();
        })
    };

    //关闭提示层
    if($(".alertpage").length>0){
        $(".alertpage").click(function(){
            $(this).hide();
        });
    }        

})

function checkform(form){
	String.prototype.Trim = function(){
		return this.replace(/(^\s*)|(\s*$)/g, "");
	}
	if(form.userName.value.Trim()==""){
		alert("姓名必须填写!");
		form.userName.focus();
		return false;
	}
	if(form.userCompany.value.Trim()==""){
		alert("公司必须填写!");
		form.userCompany.focus();
		return false;
	}
	if(form.userPhone.value.Trim()==""){
		alert("电话必须填写!");
		form.userPhone.focus();
		return false;
	}
	var reg = /^1\d{10}$/;
    if (!reg.test(form.userPhone.value.Trim())) {
        alert("电话格式不正确!");
		form.userPhone.focus();
		return false;
    }
	form.submit();
}

function share(){

	var lasttime,status,shareTitle;
	var hadshare = false;

	var imgUrl = "http://rjh.aidimedia.cn/gold-hand/templates/img/share.jpg";  
	var lineLink = "http://rjh.aidimedia.cn/gold-hand/";

	lasttime = $(".timeDis").html();
    status = $(".status").html();

    if(status == 'less'){
    	shareTitle = '当时，我的手指距离成功只有'+lasttime+'的时间！胜败虽乃兵家常事，但英雄我必须重新来过！';
    }else{
    	shareTitle = '金手指';
    }

	// 朋友
	wx.onMenuShareAppMessage({

	        title: '金手指', // 分享标题
	        desc: shareTitle, // 分享描述
	        link: lineLink, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        type: '', // 分享类型,music、video或link，不填默认为link
	        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
	        trigger: function () {
	            $(".alertpage").css("display","none");
			},
	        success: function () { 

	            $.post("http://rjh.aidimedia.cn/gold-hand/ajax.php?type=shared");

	            hadshare = true;

	            //WeixinJSBridge.call('hideOptionMenu');
	        
	        },
	        cancel: function () { 
	            // 取消分享后执行的回调函数
	            //WeixinJSBridge.call('hideOptionMenu');
	        }
	});       
	// 朋友圈
	wx.onMenuShareTimeline({
	        title: shareTitle, // 分享标题
	        link: lineLink, // 分享链接
	        imgUrl: imgUrl, // 分享图标
	        trigger: function () {
	            $(".alertpage").css("display","none");
			},
	        success: function () { 

	            $.post("http://rjh.aidimedia.cn/gold-hand/ajax.php?type=shared");

	            hadshare = true;

	            //WeixinJSBridge.call('hideOptionMenu');
	                
	        },
	        cancel: function () { 
	            // 用户取消分享后执行的回调函数
	            //WeixinJSBridge.call('hideOptionMenu');
	        }           
	});

	return hadshare;

}