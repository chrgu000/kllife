<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<!-- iPhone 手机上设置手机号码不被显示为拨号链接 -->
	<meta name="format-detection" content="telephone=no" />
	<meta content="telephone=no, address=no" name="format-detection" />
	<!--  IOS私有属性，可以添加到主屏幕 -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!--  IOS私有属性，网站开启对 web app 程序的支持 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>每刻美</title>
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/datepicker.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/dingzhi.css">
	<script src="http://kllife.com/source/Static/phone/common/js/jquery-1.11.3.min.js"></script>
	<script src="http://kllife.com/source/Static/phone/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
      <script src="http://kllife.com/source/Static/phone/js/html5shiv.js"></script>
      <script src="http://kllife.com/source/Static/phone/js/respond.js"></script>
    <![endif]-->
	<style>
		#header{background:#fff;}
		.nav-left a{background:url(http://kllife.com/source/Static/qlpphone/common/images/book-logo.png);background-size: 100% 90%;background-repeat: no-repeat;}
		.main a,.lose-sure{background: #ff1c77;}
		#footer{position: fixed;bottom:0px;width:100%;}
	</style>
</head>
<body class="page-body">
	<!-- 头部 -->
	<header id="header">
		<nav id="nav">
			<div class="nav-left">
				<a href="<?php echo U('index/welcome');?>"></a>
			</div>
		</nav>
	</header>
	
	<!-- 主体 -->
	<section id="section">
		<!-- 大图 -->
		<div class="swiper-container"></div>
		<div class="main">
			<div class="xinxi">
				<h4>玩你想玩，玩你精彩</h4>
				<input type="text" id="name" placeholder="姓名">
				<input type="text" id="mudidi" placeholder="目的地">
				<!--<input type="text" id="riqi" placeholder="出团日期">-->
				<!--<input type="text" id="tianshu" placeholder="天数">-->
				<input type="text" id="renshu" placeholder="参团人数">
				<input type="text" id="shouji" placeholder="手机">
				<!-- <input type="text" id="yanzhengma" placeholder="验证码"> -->
				<!-- <button disabled="disabled" onclick="sendMessage()" id="send_verify_code">获取验证码</button> -->
				<textarea name="comment" id="comment" placeholder="备注内容"></textarea>
				<a class="begin" href="javascript:;">开始我的定制</a>
			</div>
		</div>
	</section>	

	<!-- 底部 -->
	<footer id="footer">
		<a href="tel:4000805860" style="color: #fff; display: block; padding-top: 20px; margin-bottom: 5px;">点击拨打联系电话 400-836-0002</a>
		<p>Copyright 2017 xinlvpai.com</p>
		<p>每刻美经营许可证号：ZJ30301 浙ICP备17010959号 </p>
	</footer>
	<!-- 遮罩层 -->
	<div class="mark"></div>
	<!-- 提交成功 -->
	<div class="success">
		<h2>提交成功</h2>
		<img src="http://kllife.com/source/Static/phone/images/dzzt/icon_success.png" alt="提交成功">
		<p>领袖的旅行顾问将尽快与您取得联系,</p>
		<p>您也可直接拨打 400-080-5860 查询预订进展</p>
		<a class="success-sure" href="javascript:;">确定</a>
	</div>
	<!-- 提交失败-->
	<div class="lose">
		<h2>提交失败</h2>
		<p>请保证您的信息正确且完整!</p>
		<a class="lose-sure" href="javascript:;">确定</a>
	</div>




	<script>
		
			var isMobile = /^(?:13\d|15\d|18\d|17\d|14\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
			//获取验证码
			var InterValObj; //timer变量，控制时间
			var count = 60; //间隔函数，1秒执行
			var curCount;//当前剩余秒数
			$('#shouji').on('input propertychange',function(){
				//手机号的判断
				if( isNaN($.trim($("#shouji").val())) || $.trim($("#shouji").val()).length != 11 || !isMobile.test($("#shouji").val())) {
					$('#send_verify_code').css('background','#ccc');
				}else {
					$('#send_verify_code').css('background','#f90');
					$('#send_verify_code').attr('disabled',false);
				};
			})
			
			function sendMessage() {
				curCount = count;
			　　//设置button效果，开始计时
				$("#send_verify_code").attr("disabled", "true");
				$("#send_verify_code").text("请在" + curCount + "秒内输入");
				$('#send_verify_code').css('background','#ccc');
				InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
			　　  //向后台发送处理数据
				$.ajax({
		　　		type: "POST", //用POST方式传输
		　　		dataType: "", //数据格式:JSON
		　　		url: '', //目标地址
		　　 		data:'',
		　　		success: function (msg){
					}
				});
			};
			//timer处理函数
			function SetRemainTime() {
				if (curCount == 0) {                
					window.clearInterval(InterValObj);//停止计时器
					$("#send_verify_code").removeAttr("disabled");//启用按钮
					$('#send_verify_code').css('background','#f90');
					$("#send_verify_code").text("重新发送");
				}
				else {
					curCount--;
					$("#send_verify_code").attr("disabled", "disabled");
					$('#send_verify_code').css('background','#ccc');
					$("#send_verify_code").text("请在" + curCount + "秒内输入");
				};
			};
			//提交按钮
			$('.begin').click(function(){
				//提交失败
				if($.trim($('#name').val()) == '' || $.trim($('#mudidi').val()) == '' || $.trim($('#tianshu').val()) == '' || $.trim($('#tianshu').val()) < 1 || $.trim($('#riqi').val()) == '' || $.trim($('#shouji').val()) == '' || $.trim($('#renshu').val())== '' || $.trim($('#renshu').val()) < 1 || (!isMobile.test($.trim($('#shouji').val())))){
					$('.lose').fadeIn(1000);
					$('.mark').fadeIn(1000);
					$('.lose-sure').click(function(){
						$('.lose').fadeOut(1000);
						$('.mark').fadeOut(1000);
					});
				}else {
					//提交成功
					//提交数据
					var jsonData = {
						'linkman': $('#name').val(),
						'tel': $('#shouji').val(),
//						'days': $('#tianshu').val(),
//						'start_date': $('#riqi').val(),
						'member_count': $('#renshu').val(),
						'destination': $('#mudidi').val(),
						'other_request': $('#comment').val()
					};
		    		$.ajax({
						url: "<?php echo U('line/book');?>",
			            type: "post",
			            dataType: 'json',
			            data: jsonData,
			            success: function (data) {
							if (data.result.errno == 0){
								//提交成功
								$('.success').fadeIn(1000);
								$('.mark').fadeIn(1000);
								$('.success-sure').click(function(){
									$('.success').fadeOut(1000);
									$('.mark').fadeOut(1000);
								})
							} else {
								alert(data.result.message);
							}
			            }
			            
		    		});
				}
			});
		
		
	</script>

</body>
</html>