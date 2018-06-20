function GetQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if (r != null)
		return unescape(r[2]);
	return null;
}
var userCode = GetQueryString("uc");
var codeF = GetQueryString("code");

var h = window.innerHeight;
$('body').height(h);
$('.swiper-slide').height(h);

var boxHeight = $('.jobIntroduction').height();//盒子高
var contentHeight = $('.jobIntro_content').innerHeight();//内容高
var hBegin = $('.jobIntroduction').offset().top; //起点偏移量
var hBottom = contentHeight - hBegin - boxHeight; //终点偏移量
console.log(hBegin);
console.log(hBottom);

var canPrev = false;
var canNext = false;
var	mySwiper = new Swiper('.swiper-container', {
	direction : 'vertical',
	loop : false,
	parallax : true,
	effect : 'fade',
	longSwipesMs : 5000,
	on : {
		init : function() {
			swiperAnimateCache(this);
			swiperAnimate(this);
		},

		slideChangeTransitionEnd : function() {
			swiperAnimate(this);
			if(window.parent.nextPageControlView != undefined){					
				// 下一页
				if(this.activeIndex > this.previousIndex){
					window.parent.nextPageControlView();
				}
			}
			if(window.parent.prevPageControlView != undefined){					
				// 上一页
				if(this.activeIndex < this.previousIndex){
					window.parent.prevPageControlView();
				}
			}

			if(this.activeIndex == 2){
				canPrev = false;
				canNext = false;
				if (boxHeight < contentHeight) {
					$('.four').addClass('swiper-no-swiping');
					$('.jobIntroduction').scrollTop(1);
				}
			}
			if (this.activeIndex == 3) {
				function stopScrolling(event){
					event.preventDefault();
				}
				document.addEventListener('touchmove',stopScrolling,false);
				$('.jobIntroduction').scroll(function () {
					var h = $('.jobIntro_content').offset().top; //内容偏移量
					console.log(h);
					if (h >= hBegin) {
						canPrev = true;
					}	
					if (h + hBottom <= 1) {
						canNext = true;
					}
				})	
			}
			if(this.activeIndex == 4){
				canPrev = false; 	
				canNext = false;
				if (boxHeight < contentHeight) {
					$('.four').addClass('swiper-no-swiping');
					$('.jobIntroduction').scrollTop(hBottom+hBegin-2);
				}
			}
		}
	}
})



	var startx, starty;
	//获得角度
	function getAngle(angx, angy) {
		return Math.atan2(angy, angx) * 180 / Math.PI;
	};
	//根据起点终点返回方向 1向上 2向下 3向左 4向右 0未滑动
	function getDirection(startx, starty, endx, endy) {
		var angx = endx - startx;
		var angy = endy - starty;
		var result = 0;
		//如果滑动距离太短//
		if (Math.abs(angx) < 2 && Math.abs(angy) < 2) {
			return result;
		}
		var angle = getAngle(angx, angy);
		if (angle >= -135 && angle <= -45) {
			result = 1;
		} else if (angle > 45 && angle < 135) {
			result = 2;
		} else if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {
			result = 3;
		} else if (angle >= -45 && angle <= 45) {
			result = 4;
		}
		return result;
	}
	//手指接触屏幕
	document.addEventListener("touchstart", function (e) {
		startx = e.touches[0].pageX;
		starty = e.touches[0].pageY;
	}, false);

	//手指离开屏幕

	document.addEventListener("touchend", function (e) {
		var endx, endy;
		endx = e.changedTouches[0].pageX;
		endy = e.changedTouches[0].pageY;
		var direction = getDirection(startx, starty, endx, endy);
		switch (direction) {
			case 0:
				console.log("未滑动")
				break;
			case 1:
				console.log("向上")
				if (canNext == true) {
					mySwiper.slideNext();
					console.log("向上1")
				}
				break;
			case 2:
				console.log("向下");
				if (canPrev == true) {
					mySwiper.slidePrev();
					console.log("向下1")
				}
				break;
			case 3:
				console.log("向左")
				break;
			case 4:
				console.log("向右")
				break;
			default:
		}
	}, false);

if (codeF) {
    $.ajax({
        url: "http://192.168.1.153:8887/api/query/param",
        type: "POST",
        dataType: "json",
        async: false,
        data: JSON.stringify({ code: codeF }),
        success: function (data) {
            var jsonData = JSON.parse(data["plaintext"]);
            var result = jsonData.item.result;
            var params = JSON.parse(jsonData.item.params);
            var codeW = jsonData.item.userCode;
            var resultInfo = jsonData.item.resultInfo;
            $('#code').qrcode({
                 rander:"table",
                 text: "https://apix.funinhr.com/hr/employee.html?userCode=" + codeW
             });
             /*var canvas = document.getElementsByTagName('canvas')[0];
             var image = new Image();
             image.src = canvas.toDataURL("image/jpeg");
             document.getElementById('image').src=image.src;*/
             if (result === 1001) {
                $('#enterpriseNameId').text(params.company_name);
                $('#remarkId').html(params.company_remark);
                var positionArr = params.company_position;
                var positionList = '';
                $(positionArr).each(function(i,v){
                    var positionSingle = '<li class="positionLi" name="'+v.name+'" duty="'+v.duty+'" requirement="'+v.requirement+'" salary="'+v.salary+'">'+ v.name +'</li>'
                    positionList += positionSingle;
                })
                $('.position ul').html(positionList);
                $('.position ul li:eq(0)').addClass('positionActive');
                $('#jobNameId').text(positionArr[0].name);
                $('#jobDuty').html(positionArr[0].duty);
                $('#jobRequirement').html(positionArr[0].requirement);
                $('#jobSalaryId').html("薪资待遇:" + positionArr[0].salary);
                $('.edit').hide();
            }
        }
    });
    $('.positionList').on('click','.positionLi',function(){
        $(this).addClass('positionActive');
        $(this).siblings().removeClass('positionActive');
        $('#jobNameId').text($(this).attr('name'));
        $('#jobDuty').html($(this).attr('duty'));
        $('#jobRequirement').html($(this).attr('requirement'));
        $('#jobSalaryId').html("薪资待遇:" + $(this).attr('salary'));
    })


	var url = window.location.href;
	var dataUrl = {
		url : url,
		code : codeF
	}

	var nativeShare = new NativeShare({
		syncDescToTag : false,
		syncIconToTag : false,
		syncTitleToTag : false,
	});

/*	$.ajax({
		type : "post",
		url : "https://apix.funinhr.com/api/get/wxconfig",
		dataType : "json",
		async : false,
		data : JSON.stringify(dataUrl),
		success : function(data) {
			var data = JSON.parse(data.plaintext);
			var dataItem = JSON.parse(data.item.params);
			sessionStorage.setItem('secondShareTitle', dataItem.shareTitle);
			sessionStorage.setItem('secondShareIntro', dataItem.shareIntro);

			var link = window.location.href;
			var shareData = {
				title : dataItem.shareTitle,
				desc : dataItem.shareIntro,
				link : link,
				icon : "http://cdn.funinhr.com/online/image/job/1-120-120.png"
			};
			nativeShare.setShareData(shareData);

			wx.config({
				debug : false,
				appId : data.appid,
				timestamp : data.timestamp,
				nonceStr : data.nonceStr,
				signature : data.signature,
				jsApiList : [ 'checkJsApi', 'onMenuShareTimeline',
						'onMenuShareAppMessage', 'onMenuShareQQ',
						'onMenuShareWeibo', 'onMenuShareQZone' ]
			});
		},
		error : function(xhr, status, error) {
			return false;
		}
	})*/
/*	wx.ready(function() {
		var link = window.location.href;
		var protocol = window.location.protocol;
		var host = window.location.host;
		var secondShareTitle = sessionStorage.getItem('secondShareTitle');
		var secondShareIntro = sessionStorage.getItem('secondShareIntro');
		wx.onMenuShareTimeline({
			title : secondShareTitle,
			link : link,
			imgUrl : "http://cdn.funinhr.com/online/image/job/1-120-120.png",
			success : function() {
				return false;
			}
		});
		wx.onMenuShareAppMessage({
			title : secondShareTitle,
			desc : secondShareIntro,
			link : link,
			imgUrl : "http://cdn.funinhr.com/online/image/job/1-120-120.png",
			type : 'link',
			dataUrl : '',
			success : function() {
				return false;
			}
		});
		wx.onMenuShareQQ({
			title : secondShareTitle,
			desc : secondShareIntro,
			link : link,
			imgUrl : "http://cdn.funinhr.com/online/image/job/1-120-120.png",
			success : function() {
				return false;
			}
		});

		wx.onMenuShareWeibo({
			title : secondShareTitle,
			desc : secondShareIntro,
			link : link,
			imgUrl : "http://cdn.funinhr.com/online/image/job/1-120-120.png",
			success : function() {
				return false;
			}
		});

		// 分享到QQ空间
		wx.onMenuShareQZone({
			title : secondShareTitle,
			desc : secondShareIntro,
			link : link,
			imgUrl : "http://cdn.funinhr.com/online/image/job/1-120-120.png",
			success : function() {
				return false;
			}
		});

	});*/

} else {
	var dataJson = {
		userCode : userCode
	}
	/*
	 * $.ajax({ type: 'post', url:
	 * 'https://apix.funinhr.com/api/get/common/enterprise', async: false,
	 * dataType: 'json', data: JSON.stringify(dataJson), success: function
	 * (data) { var enterprise = JSON.parse(data.plaintext); var enterpriseName =
	 * enterprise.enterpriseName; $('.share_title').attr('placeholder',
	 * enterpriseName) } })
	 */

}

function edit(a) {
	$('.arrow').css({
		"animation-play-state" : "paused"
	});
	$(a).attr('contenteditable', true);
	$(a).css({
		"border" : "1px solid #ccc"
	});
}

function save(el, b) {
	$(el).css({
		"border" : "none"
	});
	$(el).attr('contenteditable', false);
	$('.arrow').css({
		"animation-play-state" : "running"
	});
	var c = $(el).val();
	var d = $.trim(c);
	sessionStorage.setItem(b, d);
}

function unbindEvent() {
	$('body').bind('touchstart', function(event) {
		event.stopPropagation();
	});
	$('body').bind('touchmove', function(event) {
		event.stopPropagation();
	});
	$('body').bind('touchend', function(event) {
		event.stopPropagation();
	});
}

function isExist(a, b) {
	if (sessionStorage.getItem(a)) {
		$(b).val("");
		$(b).val(sessionStorage.getItem(a));
	}
}
isExist('company_name1', '.page1-Text>input');
isExist('company_intro1', '.company_Profile');
isExist('job_title1', '.jobIntroduction>.job_title');
isExist('job_duty1', '.jobDuty>textarea');
isExist('job_require1', '.jobRequire>textarea');
isExist('pay1', '.salary');

$('.edit1').click(function() {
	edit('.page1-Text>input');
	unbindEvent();
})

$('.save1').click(function() {
	save('.page1-Text>input', 'company_name1');
	save('.company_Profile', 'company_intro1');
	save('.job_title', 'job_title1');
	save('.jobDuty>textarea', 'job_duty1');
	save('.jobRequire>textarea', 'job_require1');
	save('.salary', 'pay1');
	window.location.reload();
})

$('.edit2').click(function() {
	edit('.company_Profile');
	unbindEvent();
})
$('.save2').click(function() {
	save('.page1-Text>input', 'company_name1');
	save('.company_Profile', 'company_intro1');
	save('.job_title', 'job_title1');
	save('.jobDuty>textarea', 'job_duty1');
	save('.jobRequire>textarea', 'job_require1');
	save('.salary', 'pay1');
	window.location.reload();
	// window.location.href ="m1.html"
})

$('.edit3').click(function() {
	edit('.jobIntroduction>.job_title');
	edit('.jobDuty>textarea');
	edit('.jobRequire>textarea');
	edit('.salary');
	unbindEvent();
})

$('.save3').click(function() {
	save('.page1-Text>input', 'company_name1');
	save('.company_Profile', 'company_intro1');
	save('.job_title', 'job_title1');
	save('.jobDuty>textarea', 'job_duty1');
	save('.jobRequire>textarea', 'job_require1');
	save('.salary', 'pay1');
	window.location.reload();
})

$('.submit').click(function() {
	var shareTitle = $('.page1-Text>input').val();
	var enterpriseName = $('.share_title').attr('placeholder') + '-正在招聘'
	var one = enterpriseName.indexOf('-正在招聘');
	enterpriseName = enterpriseName.substr(0, one) + '-正在招聘';
	$('.share_title').attr('placeholder', enterpriseName);
	$('.share_box').show();
})
$('.cancel').click(function() {
	$('.share_box').hide();
})

$('.confirm').click(
	function() {
		save('.page1-Text>input', 'company_name1');
		save('.company_Profile', 'company_intro1');
		save('.job_title', 'job_title1');
		save('.jobDuty>textarea', 'job_duty1');
		save('.jobRequire>textarea', 'job_require1');
		save('.salary', 'pay1');
		var company_name = sessionStorage.getItem("company_name1"), company_intro = sessionStorage
				.getItem("company_intro1"), job_title = sessionStorage
				.getItem("job_title1"), job_duty = sessionStorage
				.getItem("job_duty1"), job_require = sessionStorage
				.getItem("job_require1"), pay = sessionStorage
				.getItem("pay1");
		var share_title = $('.share_title').val();
		var share_intro = $('.share_intro').val();
		var share_placeholder = $('.share_title').attr('placeholder');
		var shareTitle;
		var shareIntro;
		if (share_title) {
			shareTitle = share_title;
		} else {
			var enterpriseName = $('.share_title').attr(
					'placeholder')
			shareTitle = enterpriseName;
		}
		if (share_intro) {
			shareIntro = share_intro;
		} else {
			shareIntro = '快到碗里来';
		}
	
		dataJson = {
			userCode : userCode,
			params : {
				company_name : company_name,
				company_intro : company_intro,
				job_title : job_title,
				job_duty : job_duty,
				job_title : job_title,
				job_require : job_require,
				pay : pay,
				shareTitle : shareTitle,
				shareIntro : shareIntro
			}
		}
	
		$.ajax({
			url : "https://apix.funinhr.com/api/insert/params",
			type : "POST",
			dataType : "json",
			data : JSON.stringify(dataJson),
			success : function(data) {
				var jsonData = JSON.parse(data["plaintext"]);
				var result = jsonData.item.result;
				var code = jsonData.item.code;
				var enterpriseName = jsonData.item.enterpriseName;
				// 返回状态信息
				var resultInfo = jsonData.item.resultInfo;
				var recruitConfig = JSON.stringify({
					"inviteTitle" : shareTitle,
					"inviteDescription" : shareIntro,
					"inviteUrl" : "https://apix.funinhr.com/templates/position/detail/m1/m1.html?code="+ code,
					"inviteIcon" : "http://cdn.funinhr.com/online/image/job/1-120-120.png"
				})
				if (result === 1001) {
					sumToJava(recruitConfig);
				}
			}
		});
})

function sumToJava(recruitConfig) {
	window.control.onSumResult(recruitConfig);
}

function slideToPageByPageIndex(index){
	mySwiper.slideTo(index);
}

function selectDisplayPosition(obj){
	if(window.parent.selectDisplayPositionInfo != undefined){
		window.parent.selectDisplayPositionInfo(obj.id);
	}
}

function saveDataAndCreate(userCode){
	var children = $("#checkedPositionUlId").children();
	var positionArr = new Array();
	$.each(children, function (index, e){
		if(window.parent.getSelectedPositionJdObj != undefined){
			window.parent.getSelectedPositionJdObj(e.id);
			var obj = JSON.parse(sessionStorage.getItem("selectedPositionJd"));
			var positionObj = {
				"name" : obj.name,
				"duty" : obj.duty,
				"requirement" : obj.requirement,
				"salary" : obj.salary,
			};
			positionArr[index] = positionObj
		}
	})
	dataJson = {
		userCode : userCode,
		params : {
			company_name : $("#enterpriseNameId").text(),
			company_remark : $("#remarkId").text(),
			company_position : positionArr
		}
	}
	$.ajax({
		url : "http://192.168.1.153:8887/api/insert/params",
		type : "POST",
		dataType : "json",
		data : JSON.stringify(dataJson),
		success : function(data) {
			var jsonData = JSON.parse(data["plaintext"]);
			var result = jsonData.item.result;
			var code = jsonData.item.code;
			if (result === 1001) {
				$(window.parent.document).find('#positionShareCodeDiv').qrcode({
					text : "http://cdn.funinhr.com/test/position/detail/m1/m1.html?code=" + code
				});
			}
		}
	});
	
}

