<?php
//Dont' forget to fill this code in check result page -- CSRF protection
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('BASEPATH', realpath(__DIR__.'/../'));
require './api/confignaja.inc.php';
if(!isset($_SESSION['token_CSRF']))
$_SESSION['token_CSRF'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html ng-app>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta name="msapplication-TileColor" content="#32004b">
	<meta name="msapplication-TileImage" content="http://27.comcamp.in.th/assets/img/icon/mstile-144x144.png">
	<meta name="msapplication-config" content="http://27.comcamp.in.th/assets/img/icon/browserconfig.xml">
	<meta property="og:title" content="Comcamp #27"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="http://www.comcamp.in.th/27/assets/img/Comcamp_opengraph.png"/>
	<meta property="og:url" content="http://result.comcamp.in.th"/>
	<meta property="og:site_name" content="Comcamp #27 : ค่ายคอมแคมป์ครั้งที่ 27"/>
	<meta property="og:description" content="สุดยอดค่ายที่จะทำให้น้องๆ ได้รู้ว่าวิศวกรรมคอมพิวเตอร์นั้นเป็นอย่างไร โดยพี่ๆ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี"/>
	<title>Comcamp #27: Result Announcement</title>
	<link rel="apple-touch-icon" sizes="57x57" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="http://27.comcamp.in.th/assets/img/icon/apple-touch-icon-180x180.png">
	<link rel="shortcut icon" href="http://27.comcamp.in.th/assets/img/icon/favicon.ico">
	<link rel="icon" type="image/png" href="http://27.comcamp.in.th/assets/img/icon/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="http://27.comcamp.in.th/assets/img/icon/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="http://27.comcamp.in.th/assets/img/icon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="http://27.comcamp.in.th/assets/img/icon/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="http://27.comcamp.in.th/assets/img/icon/favicon-32x32.png" sizes="32x32">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/fonts/thsarabunnew.css" />
	<link rel="stylesheet" href="assets/css/comcamp-font.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/jquery.fullPage.css">
	<link rel="stylesheet" href="assets/css/bootstrap-social.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<style type="text/css">

		.sepia-image{
			filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter     id=\'old-timey\'><feColorMatrix type=\'matrix\' values=\'0.14 0.45 0.05 0 0 0.12 0.39 0.04 0 0 0.08 0.28 0.03 0 0 0 0 0 1 0\'/></filter></svg>#old-timey");
			-webkit-filter: grayscale(0.8);
			-webkit-filter: grayscale(80%);
			-moz-filter: grayscale(80%);
			-ms-filter: grayscale(80%);
			-o-filter: grayscale(80%);
			filter: grayscale(80%);
			transition:All 1s ease-in-out;
			-webkit-transition:All 1s ease-i-outn;
			-moz-transition:All 1s ease-in-out;
			-o-transition:All 1s ease-in-out;
		}
		#countdown_1, #countdown_2{
			transition:All 0.25s ease-in;
			-webkit-transition:All 0.25s ease-in;
			-moz-transition:All 0.25s ease-in;
			-o-transition:All 0.25s ease-in;
			opacity: 1;
			position: absolute;
			left: 0;
			top: 0;
			padding: inherit;
			text-align: center;
			background: rgba(0,0,0,0.5);
			width: inherit;
			height: inherit;
		}
		@media (max-width: 600px){
			#final_result{
				padding-top: calc(20% - 48px);
				margin-bottom: 48px;
  				padding-bottom: 0;
			}
			.jumbotron h1{
				font-size: 2em;
				font-weight: bolder;
			}
			.jumbotron p{
				font-size: 0.875em;
			}
			.list-group-item{
				padding-top: 0;
				padding-bottom: 5px;
				padding-left: 5px;
				padding-right: 5px;
			}
			.list-group-item:first-child{
				padding-top: 5px;
			}
			.jumbotron p.list-group-item-text{
				margin-bottom: 2px;
			}

		}
		#alert{
			padding: 20px;
			margin: 20px 0;
			border: 1px solid #eee;
			border-left-width: 5px;
			border-radius: 3px;
			border-left-color: #FF0000;
		}
	</style>
</head>
<body>
	<center>
		<div class="vertical-align" style="z-index: 999;">
			<section id="input_sec"	style="margin:auto; z-index: 999;">
				<img src="http://27.comcamp.in.th/assets/img/comcamp_logo.png" class="animated fadeInUp logo">
				<div class="col-md-6 col-md-offset-3">
					<div class="block animated zoomIn">
						<h5>กรอก<b>เบอร์โทรศัพท์ (เฉพาะตัวเลข) </b>และติ้กช่องข้างล่าง เพื่อดูผลได้เลยครับ :D</h5>
						<form>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
										<input type="text" data-toggle="tooltip" data-placement="top" title="กรอกเบอร์โทรศัพท์เท่านั้น" style="line-height:28px; margin:15px auto;" class="form-control" id="input" placeholder="เบอร์โทรศัพท์">
									</div>
								</div>
								<div class="row">
									<center>
										<div class="g-recaptcha" data-sitekey="6LcSwQMTAAAAAG50cOkbxCynteS4YnEheirUVzC0" class="center-block" align="center" id="g-recaptcha-wrapper"></div>
									</center>
								</div>
							</div>
							<div class="form-group">
								<button id="submit" data-loading-text="Loading..." class="btn btn-primary btn-lg disabled" disabled="disabled">มาลุ้นกันเลย!</button>
							</div>

						</form>
						<h6 id="alert" style="color:red; display:none;">ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้ กรุณาลองใหม่อีกครั้งภายหลังนะครับ</h6>
					</div>
				</div>
			</section>
		</div>

		<section id="countdown_sec" style="display:none; z-index: 888;">
			<div class="vertical-align">
				<span id="countdown" data-shownum="1" style="position: relative; background: none;">
					<span id="countdown_dummy" style="opacity: 0; text-align: center;">นับถอยหลัง</span>
					<span id="countdown_1" style="opacity: 1;">นับถอยหลัง</span>
					<span id="countdown_2" style="opacity: 0;">นับถอยหลัง</span>
				</span>
			</div>
		</section>

		<section id="result_sec" style="display:none; z-index: 777;">
			<div id="fullpage">
				<div class="section joke_wrapper" id="joke_template" style="display: none;">
					<div class="content">
						<span class="joke_text">ทดสอบ</span>
					</div>
					<div class="down">
						<h6>SCROLL DOWN</h6>
						<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
					</div>
				</div>
				<div class="section" id="final_result_wrapper">
					<div class="content container">
						<div class="jumbotron" id="final_result" style="background: none;">
							<div class="row" style="padding-bottom: 0px !important; margin-bottom: -50px;">
								<div id="final_result_pass">
									<h1>ยินดีด้วยครับน้อง<span class="data-fill-nickname">{name}</span>!</h1>
									<p>
										ขอต้อนรับน้องเข้ามาเป็นส่วนหนึ่งในค่าย Comcamp27<br>
										เตรียมรับโทรศัพท์ไว้ให้ดี จะมีพี่ๆโทรไปยืนยันกับน้องอีกทีนึงนะ<br>
									</p>
									<div class="hidden-xs hidden-sm" id="congreat-youtube-player"></div>
									<iframe class="hidden-md hidden-lg" width="354" height="200" src="https://www.youtube.com/embed/t_gUBY3K-JE" frameborder="0" allowfullscreen></iframe>
										 <!-- Use Youtube API instead. see Javascript code below -->
									<p>
										<a href="https://www.facebook.com/KMUTTcomcamp?fref=nf" target="_blank" class="btn btn-social btn-facebook">
											<i class="fa fa-facebook-square"></i> Comcamp <span class="hidden-xs hidden-sm">KMUTT Facebook Page</span>
										</a>
										<a href="mailto: regis@comcamp.in.th?subject=สอบถามการเข้าค่าย" class="btn btn-default">
												อีเมลฝ่ายทะเบียน <span class="hidden-xs hidden-sm">regis@comcamp.in.th</span>
										</a>
									</p>
								</div>

								</div>
								<div id="final_result_fail">
									<h1>แป่ววว ขอแสดงความเสียใจด้วยนะคะ T^T</h1>
									<p>
										ไม่เป็นไรน้าาา โอกาสหน้ายังมี อย่าลืมติดตามข่าวสารได้ทาง <a href="https://www.facebook.com/KMUTTcomcamp?fref=nf" style="margin: 10px;" target="_blank" class="btn btn-social btn-facebook">
											<i class="fa fa-facebook-square"></i>	Comcamp KMUTT Facebook Page <span class="hidden-xs hidden-sm">KMUTT Facebook Page</span>
										</a><br>
										ไว้เจอกันใหม่ปีหน้าเนอะ
										<br><br>
											<!-- a href="https://www.facebook.com/KMUTTcomcamp?fref=nf" target="_blank" class="btn btn-social btn-facebook">
												<i class="fa fa-facebook-square"></i>	Comcamp KMUTT Facebook Page
											</a>
											<a href="mailto: regis@comcamp.in.th?subject=สอบถามการเข้าค่าย" class="btn btn-default">
												อีเมลฝ่ายทะเบียน
											</a>
											<a href="telto: +66814679766" class="btn btn-info">
												พี่มิ้นท์ 081-4679766
											</a -->
									</p>
								</div>
							</div>
							<div class="row" style="margin">
								<div class="col-md-3 col-md-offset-9">
									<button class="btn btn-lg btn-primary" style="z-index:1000 !important;" id="back_to_main">กลับหน้าหลัก</button>
								</div>
							</div>
						</div>
					</div>
					<div class="down" style="display:inline-block; float:none !important;">
					</div>
				</div>
			</div>

		</section>
	</center>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
	<!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script> -->
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.fullPage.min.js?ver=hardcode"></script>
	<script src="/assets/js/grayscale.js"></script>
	<script>
		var isRecaptchaReady = false, recaptchaKey, isGenerateRecaptcha = false;
		var youtubePlayer, isCongreat = false;
		var submitToAppspot = function(response){
			$.post(/*'http://localhost:8080/'*/'https://kmutt-exam-1.appspot.com/index.php', {
				'g-recaptcha-response': response
			}, function(result){
				console.log(result);
			}, 'json');
		};
		var verifyRecaptchaCallback = function(response){
			if(typeof response.length === "number" && response.length > 0){
				isRecaptchaReady = true;
				recaptchaKey = response;
				submitToAppspot(response);
				if($("#input").val())
					$("#submit").attr("disabled", false).removeClass('disabled');
			}
		};
		var onloadCallback = function() {
			grecaptcha.render('g-recaptcha-wrapper', {
				'sitekey' : '6LcSwQMTAAAAAG50cOkbxCynteS4YnEheirUVzC0',
				'callback' : verifyRecaptchaCallback,
				'theme' : 'dark'
			});
			isGenerateRecaptcha = true;

			$(document).ready(function(){
				var fullpageOption = {
					scrollOverflow: true,
					onLeave: function(index, nextIndex, direction){
						var cntAllSlide = $("#fullpage .section").length;
						console.log('From ->', index, 'to ->', nextIndex, 'All ->', cntAllSlide);
						if(cntAllSlide > 4 && nextIndex >= cntAllSlide && index == cntAllSlide-1 && isCongreat && youtubePlayer && typeof youtubePlayer == "object" && typeof youtubePlayer.playVideo !== "undefined"){
							youtubePlayer.setVolume(30);
							youtubePlayer.playVideo();
							isCongreat = false;
						}else if(youtubePlayer && typeof youtubePlayer == "object" && typeof youtubePlayer.stopVideo !== "undefined"){
							youtubePlayer.stopVideo();
							//youtubePlayer.seekTo(0, true);
						}
					}
				};
				$("#input").focus();
				$('#fullpage').fullpage(fullpageOption);

				$("#input").keyup( function(){
					var input = $("#input").val();
					if (input.match(/[^a-zA-Z0-9-_.@]/g)) {
				    	$(this).val(input.replace(/[^a-zA-Z0-9-_.@]/g, ''));
					}
					if(input && isRecaptchaReady){
						$("#submit").attr("disabled", false).removeClass('disabled');
					} else {
						$("#submit").attr("disabled", true).addClass('disabled');
					}
				});

				$("#g-recaptcha-wrapper").on('change', "#g-recaptcha-response", function(){

				});

				$("#submit").click( function(){
					var $btn = $(this).button('loading');
					var input = $("#input").val();
					var joke = ['test','test','test','test'];
					$("body").removeClass("sepia-image");
					$("#fullpage").css("opacity", 0); //Temporary hide
					$(".form-inline").removeClass("animated shake");
					$("#alert").hide();
					isCongreat = false;
					if(input && isRecaptchaReady){
						$.post("http://result.comcamp.in.th/api/joke/", {

						}, function(result){
							$("#fullpage .section:not(#final_result_wrapper, #joke_template)").remove();
							$.fn.fullpage.destroy('all');
							$.each(result.text, function(i, txt){
								var jokeElement = $("#joke_template").clone(), afterText;
								jokeElement.attr("id", "joke_"+(i+1));
								jokeElement.find(".joke_text").html(txt);
								jokeElement.css("display", "");
								$("#final_result_wrapper").before(jokeElement);
								afterText = $("#joke_"+(i+1)+" .joke_text").html();
								//console.log("afterText => ", afterText, "typeof => ", typeof afterText);
								if(typeof afterText !== "string" || afterText.length <= 0)
									$("#joke_"+(i+1)+" .joke_text").html(txt); // -*-c
							});
							$.fn.fullpage.reBuild();
							$('#fullpage').fullpage(fullpageOption);
							$("#fullpage").css("opacity", 1); //Remove Temporary hide
							$.post("http://result.comcamp.in.th/api/result/?v=2", { <?php //ส่งคำขอตรวจสอบว่าน้องมีอยู่ในสารบบหรือไม่ ?>
								'q': input,
								'g-recaptcha-response': recaptchaKey
							}, function(result){
								//console.log(result);
								$("body").css("overflow", 'visible');
								$(".form-inline").removeClass("animated shake");
								$("#input").tooltip('hide');
								if(result.status=="success"){ <?php //ถ้าสถานะบอกว่าพบและค้นหาสำเร็จ ?>
									if(
										result.result == true <?php //น้องติดค่าย ?> &&
										typeof result.userdata !== "undefined" <?php //มีข้อมูลของน้องส่งออกมา (จริงๆ คือ ถ้าข้อมูลของน้องถูกนิยามไว้) ?>
									){
										isCongreat = true;
										$.each(result.userdata, function(key, dataVal){ <?php //ให้วนไปตามข้อมูลแต่ละตัว เพื่อแทนค่าลงในตัวแปร {blablabla} ?>
											var strKey = '{'+key+'}', txt; <?php //strKey คือคำที่จะใช้แทนค่า ({name}, {nickname}, etc.) โดยใช้ชื่อตาม key  ?>
											var strKeyRegex = new RegExp(strKey, "g");<?php //strKeyRegex คือ Object สำหรับค้นหาโดยให้แทนที่ทุกคำของ strKey เช่น "{name} นะจ้ะ{name}" ถ้าใช้แบบปกติจะแทนได้ "วิน นะจ้ะ{name}" จึงต้องใช้ Regular expression เข้าช่วย ?>
											//console.log("#fullpage .joke_wrapper .joke_text:contains('"+strKey+"'')");
											var foundElement = $("#fullpage .joke_wrapper .joke_text:contains('"+strKey+"')"); <?php //หา element ที่มีตัวแปรตาม strKey ปรากฎอยู่ ทั้งนี้เพื่อลดการทำงานที่ไม่จำเป็น ?>
											console.log("FOUND => ", foundElement, strKeyRegex);
											if(foundElement.length > 0){ <?php //ถ้ามีคำให้ต้องแทน ?>
												foundElement.each(function(){ <?php //ให้วนไปในทุก Element ที่พบคำดังกล่าว ?>
													$(this).text(<?php //แทนคำใน Element นั้น ?>
														$(this).text().replace(strKeyRegex, dataVal)<?php //ด้วยชื่อหรือข้อมูลที่ส่งมาจาก server ?>
													);
												});
											}
											$(".data-fill-"+key).text(dataVal);
										});<?php //ตามนั้นย์ ?>
										$("#final_result_pass").show();
										$("#final_result_fail").hide();
									}else if(result.result==false){ <?php //น้องไม่ติดค่าย ?>
										isCongreat = false;
										$(".joke_wrapper").hide();
										$("#final_result_pass").hide();
										$("#final_result_fail").show();
										setTimeout(function(){ $("body").addClass("sepia-image"); }, 9000);
									}
									$("#input_sec").addClass("animated zoomOut");
									$("#input_sec").delay(800).hide(1,function(){
										$("#countdown_dummy, #countdown_"+$("#countdown").data("shownum")).text("นับถอยหลัง");
										$("#countdown_sec").addClass("animated fadeIn").removeClass("fadeOut zoomOut");
										$("#countdown_sec").show(1, function(){
											var countDown = 5;
											var countDownInterval = setInterval(function(){
												if(countDown==0){ //It's the final countdown~
													$("#countdown_sec").addClass("animated fadeOut");
													clearInterval(countDownInterval);
													$("#countdown_sec").delay(1600).hide(1 ,function(){
														$("#result_sec").addClass("animated zoomIn").removeClass("fadeOut zoomOut");
														$("#result_sec").show(1);

													});
												}else if(/*countDown <= 5 && */countDown > 0){
													if($("#countdown").data("shownum") == 1){
														$("#countdown_1").animate({ opacity: 0}, 250);
														$("#countdown_2").html(countDown);
														$("#countdown_2").animate({ opacity: 1}, 250);
														$("#countdown").data("shownum", 2);
													}else{
														$("#countdown_2").animate({ opacity: 0}, 250);
														$("#countdown_1").html(countDown);
														$("#countdown_1").animate({ opacity: 1}, 250);
														$("#countdown").data("shownum", 1);
													}
													setTimeout(function(){ $("#countdown_dummy").html(countDown); }, 250*2);
													countDown = countDown-1;
												}
											}, 1000);

										});
									});
									console.log(result);
								}else{
									var errorReason = 'เกิดข้อผิดพล่ดรหะหว่างติดต่อกับ server';
									if(typeof result.reason_code !== "undefined"){
										if(result.reason_code == 101)      errorReason = "ไม่มีข้อมูลส่งไปยัง server";
										else if(result.reason_code == 201) errorReason = "รหัสยืนยัน reCaptcha ผิดรูปแบบ";
										else if(result.reason_code == 202) errorReason = "reCaptcha แปรผลไม่ได้";
										else if(result.reason_code == 203) errorReason = "ถอดรหัสข้อมูล reCaptcha ไม่ได้";
										else if(result.reason_code == 204) errorReason = "ติดต่อ server Google เพื่อแปรผล reCaptcha ไม่ได้";
										else if(result.reason_code == 301) errorReason = "ไม่สามารถดึงข้อมูลจากฐานข้อมูลได้";
										else if(result.reason_code == 302) errorReason = "รูปแบบข้อความที่ส่งมาไม่ถูกต้อง";
										else if(result.reason_code == 102) errorReason = "ไม่ส่งรหัส reCaptcha มา";
										else if(typeof result.reason == "string") errorReason = "เกิดข้อผิดพลาด : "+ result.reason;
									}else if(typeof result.reason == "string"){
										errorReason = "เกิดข้อผิดพลาด : "+ result.reason;
									}
									errorReason += ' กรุณาลองใหม่อีกครั้งภายหลังนะครับ';
									$("#alert").html(errorReason).show();
									$(".form-inline").addClass("animated shake");
									$("#input").tooltip('show');
								}
								$btn.button('reset');

							}, 'json');
						}, 'json');
					}else{
						$(".form-inline").addClass("animated shake");
						$("#input").tooltip('show');
						$btn.button('reset');
					}
				});

				$("#back_to_main").click(function(e){
					e.preventDefault();
					$("#fullpage").css("opacity", 1); //Cancel Temporary hide
					$("body").removeClass("sepia-image");
					$(".form-inline").removeClass("animated shake");
					$("#input").tooltip('hide');
					$("#submit").attr('disabled', true).addClass('disabled');

					if(!$("#countdown_sec").hasClass("zoomOut"))
						$("#countdown_sec").addClass("animated zoomOut").removeClass("zoomIn");
					if(!$("#result_sec").hasClass("zoomOut"))
						$("#result_sec").addClass("animated zoomOut").removeClass("zoomIn");

					$("#input_sec").css("display", '');
					if(!$("#input_sec").hasClass("animated"))
						$("#input_sec").addClass("animated");
					$("#input_sec").removeClass("zoomOut").addClass("zoomIn");

					setTimeout(function(){
						if(!$("#countdown_sec").hasClass("zoomIn"))
							$("#countdown_sec, #result_sec").hide();
					}, 0.75*1000);
					$("#input").val('');
					if(isGenerateRecaptcha){
						grecaptcha.reset();
						isRecaptchaReady = false;
						recaptchaKey = '';
					}else{
						onloadCallback();
					}
					if(youtubePlayer && typeof youtubePlayer == "object" && typeof youtubePlayer.stopVideo !== "undefined"){
						//youtubePlayer.seekTo(0, true);
						youtubePlayer.stopVideo();
					}
				});
			});
		};

		$(document).ready(function(){
			setTimeout(function(){
				if(!isGenerateRecaptcha){
					console.log("Manual generate Google Recaptcha")
					onloadCallback();
				}
			}, 1000);
			// 2. This code loads the IFrame Player API code asynchronously.
      		var youtubeScriptTag = document.createElement('script');

      		youtubeScriptTag.src = "https://www.youtube.com/iframe_api";
      		var firstScriptTag = document.getElementsByTagName('script')[0];
      		firstScriptTag.parentNode.insertBefore(youtubeScriptTag, firstScriptTag);

      		var deviceRatio = ($(document).width())/($(document).height());
      		$(window).resize(function(){
      			var currDeviceRatio = ($(document).width())/($(document).height());
      			if(currDeviceRatio != deviceRatio && youtubePlayer && typeof youtubePlayer.stopVideo !== "undefined"){
      				//youtubePlayer.setSize(parseInt($(document).width() * 0.75), parseInt($(document).height() * 0.5));
      			}
      		});
		});

		function onYoutubePlayerReady(event){
			event.target.stopVideo();
		}
		function onYoutubePlayerStateChange(event){
			console.log("State Change -> ", event);
			if (event.data == YT.PlayerState.PLAYING && !isCongreat) {
				youtubePlayer.stopVideo();
      	}
		}

		function onYouTubeIframeAPIReady() {
			var width_youtube = parseInt($(document).height() * 0.4 *1.77);
			var maxwidth = parseInt($(document).width());
			if(width_youtube>maxwidth){
				width_youtube = parseInt($(document).width() * 0.75);
			}
			youtubePlayer = new YT.Player('congreat-youtube-player', {
				height: parseInt($(document).height() * 0.4),
				width: parseInt(width_youtube),
				videoId: 't_gUBY3K-JE',
				events: {
					'onReady': onYoutubePlayerReady,
					'onStateChange': onYoutubePlayerStateChange
				}
			});
		}

	</script>
	</body>
	</html>
