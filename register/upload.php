<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<title>Comcamp #27: File Upload System</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-TileColor" content="#32004b">
	<meta name="msapplication-TileImage" content="http://27.comcamp.in.th/assets/img/icon/mstile-144x144.png">
	<meta name="msapplication-config" content="http://27.comcamp.in.th/assets/img/icon/browserconfig.xml">
	<meta property="og:title" content="Comcamp #27"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="http://www.comcamp.in.th/27/assets/img/Comcamp_opengraph.png"/>
	<meta property="og:url" content="http://www.comcamp.in.th"/>
	<meta property="og:site_name" content="Comcamp #27 : ค่ายคอมแคมป์ครั้งที่ 27"/>
	<meta property="og:description" content="สุดยอดค่ายที่จะทำให้น้องๆ ได้รู้ว่าวิศวกรรมคอมพิวเตอร์นั้นเป็นอย่างไร โดยพี่ๆ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี"/>
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="/assets/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/assets/css/dropzone.css"/>
	<link rel="stylesheet" href="/assets/css/selectize.css"/>
	<link rel="stylesheet" href="/assets/css/selectize.bootstrap3.css"/>
	<link rel="stylesheet" href="/assets/css/main.css"/>
	<style type="text/css">
		#login{
					transition:All 0.35s ease-in-out;
			-webkit-transition:All 0.35s ease-in-out;
			   -moz-transition:All 0.35s ease-in-out;
				 -o-transition:All 0.35s ease-in-out;
		}
		#merge_document_uploader_wrapper { margin-bottom: 3rem; }

		#merge_document_uploader { border: 2px dashed #0087F7; border-radius: 5px; background: white; }
		#merge_document_uploader .dz-message { font-weight: 400; }
		#merge_document_uploader .dz-message .note { font-size: 0.8em; font-weight: 200; display: block; margin-top: 1.4rem; }
		/*
		 * The MIT License
		 * Copyright (c) 2012 Matias Meno <m@tias.me>
		 */
		.dropzone, .dropzone * {
		  box-sizing: border-box; }

		.dropzone {
		  position: relative; }
		  .dropzone .dz-preview {
			position: relative;
			display: inline-block;
			width: 120px;
			margin: 0.5em; }
			.dropzone .dz-preview .dz-progress {
			  /*display: block;*/
			  display: none;
			  height: 15px;
			  border: 1px solid #aaa; }
			  .dropzone .dz-preview .dz-progress .dz-upload {
				display: block;
				height: 100%;
				width: 0;
				background: green; }
			.dropzone .dz-preview .dz-error-message {
			  color: red;
			  display: none; }
			.dropzone .dz-preview.dz-error .dz-error-message, .dropzone .dz-preview.dz-error .dz-error-mark {
			  display: block; }
			.dropzone .dz-preview.dz-success .dz-success-mark {
			  display: block; }
			.dropzone .dz-preview .dz-error-mark, .dropzone .dz-preview .dz-success-mark {
			  position: absolute;
			  display: none;
			  left: 30px;
			  top: 30px;
			  width: 54px;
			  height: 58px;
			  left: 50%;
			  margin-left: -27px; }
	</style>
</head>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script type="text/javascript" src="assets/js/standalone/selectize.min.js"></script>
	<script type="text/javascript" src="assets/js/plupload.full.min.js"></script>
	<script src="assets/js/jquery.plupload.queue/jquery.plupload.queue.min.js" type="text/javascript"></script>
	<script src="http://rawgithub.com/moxiecode/plupload/master/js/plupload.full.min.js" type="text/javascript"></script>
	<script src="http://rawgithub.com/moxiecode/plupload/master/js/jquery.plupload.queue/jquery.plupload.queue.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/assets/js/dropzone.js"></script>
<script>
var fb_id, api_token, file_id, file_type, serverDateTime;
serverDateTime = new Date();

$.getJSON("/api/index.php/get/misc/doc", function(data){
	console.log(data);
	$.each( data.result, function( key, val ) {
		$("#upload_list").append( "<option value='" + key + "' ng-model='upload_list'>" + val + "</option>" );
	});
});

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response, cnt) {
	if(typeof cnt != "number")
		cnt = 1;

	console.log('statusChangeCallback');
	$("#login-problem").fadeOut();
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		console.log("Token", response.authResponse.accessToken);
		fbToken = response.authResponse.accessToken;
		$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
			'code': response.authResponse.accessToken,
			'state':"<?php echo $_SESSION['state']; ?>"
		}, function(result){
			if(result.status == "success"){
				$("#login").fadeOut();
-				$("#preload").fadeIn();
				api_token = result.token;
				getRegistered(api_token);
			} else if(typeof result.reason == "string" && result.reason.length > 0){
				if(cnt > 4){
					$("#login-problem").removeClass('bg-warning').addClass('bg-danger');
					if($("#login-problem img").length == 0)
						$("#login-problem").append("<br /><img src=\"/assets/images/tumblr_mbcmdl61wk1rx8lgjo1_500.gif\" class=\"img-responsive\" />");
				}
				$("#login-problem pre").text('reason ['+serverDateTime.toString()+'] => ' + result.reason);
				$("#login-problem").fadeIn();
				window.setTimeout(function(){ statusChangeCallback(response, cnt+1); }, 5000);
			}
		}, 'json');

		connectAPI();

	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
	} else {
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
	}
}

function getRegistered(api_token){
	console.log("api_token sent to getRegistered: " + api_token);
	$.post("/api/index.php/user/full",{
		'code': api_token
	}, function(result){
		console.log("Full: ", result);
		console.log("Registered: " + result.registered);
		if(result.registered==false){
			alert('กรุณาสมัครค่ายผ่านระบบรับสมัครก่อน จึงสามารถใช้ระบบอัพโหลดได้');
			window.location = window.location.origin;
		}
		var sent_doc = result.userdata.sent_doc;
		console.log(sent_doc);


		$("#regis_1").empty();
		$("#regis_2").empty();
		$("#doc_1").empty();
		$("#doc_7").empty();
		$("#doc_parent").empty();
		$("#id_card").empty();
		$("#parent_id_card").empty();
		$("#pic_official").empty();
		$("#pic_freestyle").empty();

		if(sent_doc["registration_paper#1"].status=="pass"){
			$("#regis_1").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#regis_1").addClass("success");
			$("#upload_list option[value='"+sent_doc['registration_paper#1'].file_type+"']").remove();
		}
		if(sent_doc["registration_paper#2"].status=="pass"){
			$("#regis_2").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#regis_2").addClass("success");
			$("#upload_list option[value='"+sent_doc['registration_paper#2'].file_type+"']").remove();
		}
		if(sent_doc["grade_certificate"].status=="pass"){
			$("#doc_1").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#doc_1").addClass("success");
			$("#upload_list option[value='"+sent_doc['grade_certificate'].file_type+"']").remove();
		}
		if(sent_doc["student_certificate"].status=="pass"){
			$("#doc_7").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#doc_7").addClass("success");
			$("#upload_list option[value='"+sent_doc['student_certificate'].file_type+"']").remove();
		}
		if(sent_doc["parent_agree"].status=="pass"){
			$("#doc_parent").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#doc_parent").addClass("success");
			$("#upload_list option[value='"+sent_doc['parent_agree'].file_type+"']").remove();
		}
		if(sent_doc["idcard"].status=="pass"){
			$("#id_card").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#id_card").addClass("success");
			$("#upload_list option[value='"+sent_doc['idcard'].file_type+"']").remove();
		}
		if(sent_doc["parent_idcard"].status=="pass"){
			$("#parent_id_card").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#parent_id_card").addClass("success");
			$("#upload_list option[value='"+sent_doc['parent_idcard'].file_type+"']").remove();
		}
		if(sent_doc["photograph_official"].status=="pass"){
			$("#pic_official").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#pic_official").addClass("success");
			$("#upload_list option[value='"+sent_doc['photograph_official'].file_type+"']").remove();
		}
		if(sent_doc["photograph_freestyle"].status=="pass"){
			$("#pic_freestyle").append("<i class=\"glyphicon glyphicon-ok\"></i> เรียบร้อย");
			$("#pic_freestyle").addClass("success");
			$("#upload_list option[value='"+sent_doc['photograph_freestyle'].file_type+"']").remove();
		}


		if(sent_doc["registration_paper#1"].status=="checking"){
			$("#regis_1").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#regis_1").addClass("info");
		}
		if(sent_doc["registration_paper#2"].status=="checking"){
			$("#regis_2").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#regis_2").addClass("info");
		}
		if(sent_doc["grade_certificate"].status=="checking"){
			$("#doc_1").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#doc_1").addClass("info");
		}
		if(sent_doc["student_certificate"].status=="checking"){
			$("#doc_7").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#doc_7").addClass("info");
		}
		if(sent_doc["parent_agree"].status=="checking"){
			$("#doc_parent").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#doc_parent").addClass("info");
		}
		if(sent_doc["idcard"].status=="checking"){
			$("#id_card").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#id_card").addClass("info");
		}
		if(sent_doc["parent_idcard"].status=="checking"){
			$("#parent_id_card").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#parent_id_card").addClass("info");
		}
		if(sent_doc["photograph_official"].status=="checking"){
			$("#pic_official").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#pic_official").addClass("info");
		}
		if(sent_doc["photograph_freestyle"].status=="checking"){
			$("#pic_freestyle").append("<i class=\"glyphicon glyphicon-time\"></i> กำลังตรวจสอบ");
			$("#pic_freestyle").addClass("info");
		}




		if(sent_doc["registration_paper#1"].status=="fail"){
			$("#regis_1").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#regis_1").addClass("danger");
		}
		if(sent_doc["registration_paper#2"].status=="fail"){
			$("#regis_2").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#regis_2").addClass("danger");
		}
		if(sent_doc["grade_certificate"].status=="fail"){
			$("#doc_1").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#doc_1").addClass("danger");
		}
		if(sent_doc["student_certificate"].status=="fail"){
			$("#doc_7").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#doc_7").addClass("danger");
		}
		if(sent_doc["parent_agree"].status=="fail"){
			$("#doc_parent").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#doc_parent").addClass("danger");
		}
		if(sent_doc["idcard"].status=="fail"){
			$("#id_card").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#id_card").addClass("danger");
		}
		if(sent_doc["parent_idcard"].status=="fail"){
			$("#parent_id_card").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#parent_id_card").addClass("danger");
		}
		if(sent_doc["photograph_official"].status=="fail"){
			$("#pic_official").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#pic_official").addClass("danger");
		}
		if(sent_doc["photograph_freestyle"].status=="fail"){
			$("#pic_freestyle").append("เอกสารไม่ผ่านการพิจารณา กรุณาอัพโหลดใหม่");
			$("#pic_freestyle").addClass("danger");
		}


		if(sent_doc["registration_paper#1"].status=="not_sent"){
			$("#regis_1").append("รอการอัพโหลด");
		}
		if(sent_doc["registration_paper#2"].status=="not_sent"){
			$("#regis_2").append("รอการอัพโหลด");
		}
		if(sent_doc["grade_certificate"].status=="not_sent"){
			$("#doc_1").append("รอการอัพโหลด");
		}
		if(sent_doc["student_certificate"].status=="not_sent"){
			$("#doc_7").append("รอการอัพโหลด");
		}
		if(sent_doc["parent_agree"].status=="not_sent"){
			$("#doc_parent").append("รอการอัพโหลด");
		}
		if(sent_doc["idcard"].status=="not_sent"){
			$("#id_card").append("รอการอัพโหลด");
		}
		if(sent_doc["parent_idcard"].status=="not_sent"){
			$("#parent_id_card").append("รอการอัพโหลด");
		}
		if(sent_doc["photograph_official"].status=="not_sent"){
			$("#pic_official").append("รอการอัพโหลด");
		}
		if(sent_doc["photograph_freestyle"].status=="not_sent"){
			$("#pic_freestyle").append("รอการอัพโหลด");
		}

		$("#preload").hide();
		$("#login").hide();
		$("#upload_page").show();
	}, 'json');
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

window.fbAsyncInit = function() {
	FB.init({
		appId      : '478731965498089',
		cookie     : true,  // enable cookies to allow the server to access
		// the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.1' // use version 2.1
	});
	FB.Event.subscribe('auth.login', function () {
		window.location.reload();
	});

	// Now that we've initialized the JavaScript SDK, we call
	// FB.getLoginStatus().  This function gets the state of the
	// person visiting this page and can return one of three states to
	// the callback you provide.  They can be:
	//
	// 1. Logged into your app ('connected')
	// 2. Logged into Facebook, but not your app ('not_authorized')
	// 3. Not logged into Facebook and can't tell if they are logged into
	//    your app or not.
	//
	// These three cases are handled in the callback function.

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1733339923558373&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function connectAPI() {
	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me', function(response) {
		console.log('Response => ', response);
		if(typeof response.birthday == "string" && Date.parse(response.birthday) !== NaN){
			var d = new Date(response.birthday);
			/*console.log(d, ' -> ', [(d.getMonth()+1).padLeft(),
			d.getDate().padLeft(),
			d.getFullYear()].join('/'));*/

			var ageDifMs = serverDateTime.getTime() - d.getTime();
			var ageDate = new Date(ageDifMs); // miliseconds from epoch
			$("#age").val(Math.abs(ageDate.getUTCFullYear() - 1970));

			$( "#birthdate" ).datepicker("setDate", d);
		}
		if(typeof response.email == "string"){
			$("#email").val(response.email);
		}
		/*if(typeof response.first_name == "string"){
		$("#email").val(response.first_name);
	}
	if(typeof response.last_name == "string"){
	$("#email").val(response.last_name);
}
if(typeof response.first_name == "string"){
$("#email").val(response.first_name);
}*/




/*  document.getElementById('info').innerHTML =
'<p><img id="avatar" src="http://graph.facebook.com/' + response.id + '/picture?type=square">'+
' ' + response.name + '</p><hr>';
fb_id = response.id;
*/
console.log('fb_id: ' + response.id);
fb_id = response.id;
});

$(".complete").click( function(){
	getRegistered(api_token);
});
}

</script>
<div class="container">
	<div class="row">
		<div style="text-align:center; margin: 45px auto 30px auto;">
			<span style="font-size:72px; margin:15px auto; color:#FFF;" class="comcamp-icon-ComcampFullLogo"></span>
			<h4 style="color: #FFF;">ระบบอัพโหลดเอกสาร ค่ายคอมแคมป์ครั้งที่ 27</h4>
		</div>
	</div>
	<!-- login -->
	<div class="row" id="login">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body" style="text-align:center;">
					<h3>กรุณาล็อกอินเข้าสู่ระบบก่อนใช้งาน</h3>
					<hr>
					<div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="">เข้าสู่ระบบ</div>
					<h6>* ระบบอัพโหลดสำหรับน้องๆที่สมัครเข้าค่ายผ่านระบบรับสมัครออนไลน์เท่านั้น</h6>
					<div class="bg-warning" id="login-problem" style="display: none;">
						<span>เอ๊ะโอ... มีปัญหาระหว่างเข้าระบบนิดหน่อย กำลังแก้ไขให้นะ รอแป๊บนึง <br />
						ปล.ถ้าเจอบ่อยๆ แจ้งปัญหาที่เพจของโครงการพร้อมข้อมูลด้านล่างนี้นะครับ</span>
						<pre class="bg-info"></pre>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- preload -->
	<div class="row" id="preload" style="display:none;">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body" style="text-align:center;">
					<center><h2><i class="glyphicon glyphicon-cog glyphicon-refresh-animate"></i></h2><h4>Please wait...</h4></center>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- page 1 -->
	<div id="upload_page" ng-show="page==1" ng-init="page=1" style="display:none;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label"><i class="glyphicon glyphicon-upload"></i> เลือกไฟล์ที่จะอัพโหลด</label>
								<div class="col-sm-6">
									<select class="form-control" name="upload_list" id="upload_list">
									</select>
								</div>
								<div class="col-sm-2">
									<button class="btn btn-primary" id="select_button" ng-click="page=2">เลือก</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<br>
						<table class="table">
							<tr class="active">
								<th>รายการเอกสาร</th>
								<th>สถานะ</th>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-file"></i> ใบสมัคร (ส่วนที่ 1)</td>
								<td id="regis_1"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-file"></i> ใบสมัคร (ส่วนที่ 2)</td>
								<td id="regis_2"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-credit-card"></i> สำเนาบัตรประจำตัวประชาชน/บัตรนักเรียน</td>
								<td id="id_card"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-file"></i> ปพ.7</td>
								<td id="doc_7"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-file"></i> ปพ.1</td>
								<td id="doc_1"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-credit-card"></i> สำเนาบัตรประจำตัวประชาชนผู้ปกครอง</td>
								<td id="parent_id_card"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-file"></i> ใบขออนุญาตผู้ปกครอง</td>
								<td id="doc_parent"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-camera"></i> ภาพถ่ายหน้าตรง 3x4 cm</td>
								<td id="pic_official"></td>
							</tr>
							<tr>
								<td><i class="glyphicon glyphicon-camera"></i> ภาพถ่ายอิสระ</td>
								<td id="pic_freestyle"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- page 2 -->
	<div class="row" ng-show="page==2">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><i class="glyphicon glyphicon-file"></i> อัพโหลด: <b><span class="upload_type"></span></b></h4>
					<hr>
					<!-- Added for pdf merging -->
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#merge_document">
						รวมรูปเอกสารที่สแกนมาให้เป็นไฟล์ pdf คลิกที่นี่
					</button>
					<div id="uploader">
						<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
					</div>
					<h6>หากพบปัญหาไม่สามารถกดปุ่ม Add Files ได้ ให้ใช้วิธีการลากไฟล์เข้ามายังกล่องอัพโหลดนะครับ</h6>
					<h6>สามารถอัพโหลดได้ 1 ไฟล์ต่อ 1 เอกสารเท่านั้น หากสแกนมาเป็นไฟล์รูป (jpg,png) หลายๆไฟล์ พี่แนะนำให้เอาเข้า Microsoft Word เพื่อแปลงเป็น pdf ก่อนนะครับ ^_^ หรือคลิกปุ่มด้านบนเพื่อร่วมในหน้าเว็บเลยก็ได้ หรือถ้าไม่สะดวกสามารถส่งมาทาง webmaster@comcamp.in.th แทนก็ได้จ้า</h6>
					<hr>
					<center>
						<button class="btn btn-lg btn-primary disabled" id="upload_complete"  ng-click="page=3">ขั้นตอนถัดไป</button>
						<button class="btn btn-lg btn-warning reset" ng-click="page=1">ย้อนกลับ</button>
					</center>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- page 3 -->
	<div class="row" ng-show="page==3">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4>Preview: <b><span class="upload_type"></span></b></h4>
					<hr>
					<div class="row" style="margin: 15px 0;">
						<div class="col-md-12" style="overflow:scroll; text-align:center; ">
							<span class="preview" id="preview"></span>
							<!-- <canvas id="temp-canvas"></canvas> -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-warning">
								กรุณาตรวจสอบเอกสารว่าถูกต้องหรือไม่ ก่อนยืนยันเอกสารโดยคลิกที่ปุ่มด้านล่าง
								<!-- <h6>หมายเหตุ: หากอัพโหลดเอกสารเป็นไฟล์ pdf จะไม่สามารถแสดง preview ได้ครับ</h6> -->
							</div>
							<hr>
							<center>
								<button class="btn btn-lg btn-primary" id="confirm_doc" ng-click="page=4">ยืนยันข้อมูล</button>
								<button class="btn btn-lg btn-warning reset" ng-click="page=1">ย้อนกลับ</button>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- page 4 -->
	<div class="row" ng-show="page==4" id="page_4" style="display:none;">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4 id="upload_result"></h4>
					<hr>
					<span id="upload_result_success" style="display:none;">
						น้องได้ทำการอัพโหลดไฟล์สำหรับ <b><span class="upload_type"></span></b> เรียบร้อยแล้ว!
					</span>
					<span id="upload_result_fail" style="display:none;">
						น้องได้ทำการอัพโหลดไฟล์ผิดพลาด อาจเกิดจากนามสกุลของไฟล์ไม่ตรงตามที่กำหนด หรือสาเหตุอื่นๆ หากไม่สามารถหาทางแก้ไขได้ สามารถขอความช่วยเหลือทาง <a href="http://www.facebook.com/KMUTTcomcamp" target="_blank">Facebook Fanpage</a> ได้ตลอดเวลาครับ :)
					</span>
					<hr>
					<center>
						<button class="btn btn-lg btn-success reset complete" ng-click="page=1">เสร็จสิ้น</button><!-- .refresh -->
					</center>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->

	<!-- merge_document modal - Added for pdf merging -->

	<!-- Modal -->
	<div class="modal fade" id="merge_document" tabindex="-1" role="dialog" aria-labelledby="merge_document_label" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="merge_document_label">รวมเอกสาร</h4>
				</div>
				<div class="modal-body">
					<div class="row" id="merge_document_preload">
						<div class="col-md-8 col-md-offset-2">
							<div class="panel panel-default">
								<div class="panel-body center-block text-center">
									<h2>
										<i class="glyphicon glyphicon-cog glyphicon-refresh-animate"></i>
									</h2>
									<h4>รอแปป...</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="merge_document_uploader_wrapper">
						<form action="http://www.torrentplease.com/dropzone.php" id="merge_document_uploader" class="dropzone">
							<div class="dz-message">โยนไฟล์มาที่กล่องนี้หรือคลิกเพื่อเลือกไฟล์</div>
						</form>
					</div>
					<div class="row">
						<button type="button" class="btn btn-primary col-md-10 col-md-offset-1" id="merge_document_generate" disabled="disabled">สร้างไฟล์</button>
					</div>
					 <div id="merge_document_preview_wrapper" class="row embed-responsive embed-responsive-16by9" style="padding-bottom: 1px;"> <!--<div class="row">-->
						<iframe id="merge_document_preview" class="embed-responsive-item preview-pane" width="100%" height="650" style="height: 1px;"></iframe>
						<!-- <div id="merge_document_preview"></div> -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" disabled="disabled" id="merge_document_save">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->
</div>
<script type="text/javascript" src="/assets/js/pdf.js"></script>
<script type="text/javascript" src="/assets/js/jspdf.min.js"></script>
<script type="text/javascript" src="/assets/js/jspdf.plugin.addimage.js"></script>
<script type="text/javascript">
// Disable workers to avoid yet another cross-origin issue (workers need the URL of
// the script to be loaded, and dynamically loading a cross-origin script does
// not work)
PDFJS.disableWorker = true;
// Convert divs to queue widgets when the DOM is ready
$(document).ready( function() {
	// Disable workers to avoid yet another cross-origin issue (workers need the URL of
	// the script to be loaded, and dynamically loading a cross-origin script does
	// not work)
	PDFJS.disableWorker = true;
	//get datetime from server to check real-time used
	$.get('/api/index.php/get/time', function(dateString){
		if(Date.parse(dateString) !== NaN)
		serverDateTime = new Date(dateString);
	});

	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '/api/index.php/doc/upload/',
		chunk_size : '20mb',
		unique_names : true,
		multi_selection: false,

		// Resize images on client-side if we can
		// resize : {width : 320, height : 240, quality : 90},

		filters : {
			max_file_size : '20mb',

			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Document files", extensions : "docx,pdf"},
				{title : "Zip files", extensions : "zip"}
			]
		},
		// Resize images on clientside if we can
		resize : {width : 2000, height : 1000, quality : 90},

		// Flash settings
		flash_swf_url : '/plupload/js/Moxie.swf',

		// Silverlight settings
		silverlight_xap_url : '/plupload/js/Moxie.xap',

		// PreInit events, bound before any internal events
		preinit : {
			Init: function(up, info) {
				log('[Init]', 'Info:', info, 'Features:', up.features);
			},

			UploadFile: function(up, file) {
				log('[UploadFile]', file);

				// You can override settings before the file is uploaded
				// up.setOption('url', 'upload.php?id=' + file.id);
				up.setOption('multipart_params', {id : fb_id, token : api_token});
			}
		},

		// Post init events, bound after the internal events
		init : {
			PostInit: function() {
				// Called after initialization is finished and internal event handlers bound
				log('[PostInit]');
				var uploadfilesElement = document.getElementById('uploadfiles');
				if(uploadfilesElement){
					document.getElementById('uploadfiles').onclick = function() {
						uploader.start();
						return false;
					};
				}
			},

			Browse: function(up) {
				// Called when file picker is clicked
				log('[Browse]');
			},

			Refresh: function(up) {
				// Called when the position or dimensions of the picker change
				log('[Refresh]');
			},

			StateChanged: function(up) {
				// Called when the state of the queue is changed
				log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
			},

			QueueChanged: function(up) {
				// Called when queue is changed by adding or removing files
				log('[QueueChanged]');
			},

			OptionChanged: function(up, name, value, oldValue) {
				// Called when one of the configuration options is changed
				log('[OptionChanged]', 'Option Name: ', name, 'Value: ', value, 'Old Value: ', oldValue);
			},

			BeforeUpload: function(up, file) {
				// Called right before the upload for a given file starts, can be used to cancel it if required
				log('[BeforeUpload]', 'File: ', file);
			},

			UploadProgress: function(up, file) {
				// Called while file is being uploaded
				log('[UploadProgress]', 'File:', file, "Total:", up.total);
			},

			FileFiltered: function(up, file) {
				// Called when file successfully files all the filters
				log('[FileFiltered]', 'File:', file);
			},

			FilesAdded: function(up, files) {
				// Called when files are added to queue
				log('[FilesAdded]');

				var maxfiles = 1;
				if(up.files.length > maxfiles ){
					up.splice(maxfiles);
					alert('เอกสารหนึ่งฉบับสามารถอัพโหลดได้เพียงไฟล์เดียวเท่านั้นครับ');
					return;
				}
				if (up.files.length === maxfiles) {

				}

				$("#preview").empty();

				plupload.each(files, function(file) {
					if(file.type == "application/pdf"){

						var reader =  new window.FileReader()
						reader.readAsDataURL(file.getNative());

						reader.onload = function () {
							var base64data = reader.result;
							//base64data = base64data.substring(base64data.indexOf(",") + 1);
							PDFJS.getDocument(base64data).then(function(pdf) {
								// you can now use *pdf* here
								console.log("PDF Loaded : ", pdf);
								pdf.getPage(1).then(function(page){
									console.log("Page#1 Loaded : ", page);
									var scale = 1.5;
									var viewport = page.getViewport(scale);

									//
									// Prepare canvas using PDF page dimensions
									//
									var canvas = document.createElement('canvas');
									var context = canvas.getContext('2d');
									canvas.height = viewport.height;
									canvas.width = viewport.width;

									//
									// Render PDF page into canvas context
									//
									page.render({canvasContext: context, viewport: viewport}).then(function(){
										context.font="20px THSarabunNew";
										// Create gradient
										var gradient=context.createLinearGradient(0,0,canvas.width,0);
										gradient.addColorStop("0","#40003c");
										gradient.addColorStop("0.5","#751230");
										gradient.addColorStop("1.0","#b01730");
										// Fill with gradient
										context.fillStyle=gradient;
										context.textAlign="right";
										context.fillText("ตัวอย่างเอกสารหน้า 1 จากทั้งหมด "+pdf.numPages+" หน้า", canvas.width, 90);

										var imgWidth = $("[ng-show]").filter(":visible").width();
										$("<img>")
											.attr("src", canvas.toDataURL())
											.width(imgWidth * 0.5)
											.height((canvas.height/canvas.width) * (imgWidth * 0.5))
											.appendTo("#preview");
										//$("[ng-show='page==3']").removeClass('ng-hide');
									});
								});
							});
						}
					}else{
						var img = new mOxie.Image();
						img.onload = function() {
							this.embed($('#preview').get(0), {
								width: 248,
								height: 350
							});
						};

						img.onembedded = img.onerror = function() {
							this.destroy();
						};

						img.load(file.getSource());
					}
					console.log('file', file);
					//application/pdf
				});
			},

			FilesRemoved: function(up, files) {
				// Called when files are removed from queue
				log('[FilesRemoved]');

				plupload.each(files, function(file) {
					log('  File:', file);
				});
			},

			FileUploaded: function(up, file, info) {
				// Called when file has finished uploading
				var data = jQuery.parseJSON(info.response);
				console.log(data);
				if(data.status=="success"){
					$("#upload_complete").removeClass("disabled");
					file_id = data.id;
				} else {
					alert('File Error!');
				}

			},

			ChunkUploaded: function(up, file, info) {
				// Called when file chunk has finished uploading
				log('[ChunkUploaded] File:', file, "Info:", info);
			},

			UploadComplete: function(up, files) {
				// Called when all files are either uploaded or failed
				log('[UploadComplete]');
			},

			Destroy: function(up) {
				// Called when uploader is destroyed
				log('[Destroy] ');
			},

			Error: function(up, args) {
				// Called when error occurs
				log('[Error] ', args);
			}
		}
	});


	function log() { }

	var uploader = $('#uploader').pluploadQueue();

	uploader.bind('UploadComplete', function() {
		if (uploader.total.uploaded == uploader.files.length) {
			$(".plupload_buttons").css("display", "inline");
			$(".plupload_upload_status").css("display", "inline");
		}
	});

	$("button#select_button").click(function(){
		var select = $( "#upload_list option:selected" ).text();
		file_type = $( "#upload_list option:selected" ).val();
		$(".upload_type").empty();
		$(".upload_type").append(select);
		var uploader = $("#uploader").pluploadQueue();
		$("#upload_result_success, #upload_result_fail, #page_4").hide();
		$
	});

	$(".reset").click( function(){
		uploader.splice();
		$("#upload_complete").addClass("disabled");
	});

	$("#confirm_doc").click(function(){
		$("#preload").show();
		console.log("file_id: " + file_id);
		$.post("/api/index.php/doc/confirm",
		{"id":fb_id, "token": api_token, "file_id": file_id, "file_type": file_type},
		function(data){
			console.log("confirm docs: " + data ,"file_type: " + file_type);
			if(data.status=="success"){
				$("#preload").hide();
				$("#page_4").show();
				$("#upload_result").empty();
				$("#upload_result").append("อัพโหลดไฟล์เรียบร้อยแล้ว!");
				$("#upload_result_success").show();
			} else {
				$("#preload").hide();
				$("#page_4").show();
				$("#upload_result").empty();
				$("#upload_result").append("เกิดข้อผิดพลาด กรุณาลองอัพโหลดใหม่อีกครั้ง");
				$("#upload_result_fail").show();
			}
		}, "json");
	});

	$(".refresh").click( function(){
		window.location = window.location.origin;
	});
	/* Added for pdf merging */
	if (typeof window.FileReader !== 'function'){
		$('[data-target="#merge_document"]').hide();
	}else{
		var mergeDocumentFileList = [];
		window.mergeDocumentDropzone = new Dropzone("#merge_document_uploader", {
			autoProcessQueue : false,
			addRemoveLinks : true,
			init : function(){
				$("#merge_document_uploader").sortable({
					items:'.dz-preview',
					cursor: 'move',
					opacity: 0.5,
					containment: '#merge_document_uploader',
					distance: 20,
					tolerance: 'pointer',
					stop: function() {
						var data = "";
						/*$('#merge_document_uploader .dz-preview .dz-filename span').each(function(){
							console.log(this, '=>');
						}); */
					}
				});
			}

		});
		$("#merge_document_preload").fadeOut();
		/*$('#merge_document').on('show.bs.modal', function(event){

		});*/
		window.mergeDocumentDropzone.on("addedfile", function(file){
			mergeDocumentFileList.push(file);
			$("#merge_document_generate").attr("disabled", mergeDocumentFileList.length <= 0);
			console.log("Add =>", file);
		});
		window.mergeDocumentDropzone.on("removedfile", function(file){
			var index = mergeDocumentFileList.indexOf(file);
			if(index != -1){
				mergeDocumentFileList.splice(index, 1);
				$("#merge_document_generate").attr("disabled", mergeDocumentFileList.length <= 0);
			}
			console.log("Remove =>", file);
		});

		$("#merge_document_generate").click(function(){
			var sortedItem = [], htmlList = [], canvas = {}, ctx = {}, fr = {}, img = {}, fileGenerated = 0;

			$('#merge_document_uploader .dz-preview').each(function(){
				htmlList.push(this);
			});

			$.each(mergeDocumentFileList, function(index, file){
				index = htmlList.indexOf(file.previewElement);
				if(index != -1 && typeof file.width !== "undefined"){
					sortedItem.splice(index, 0, file);
				}
			});
			console.log("sortedItem => ", sortedItem);

			$.each(sortedItem, function(index, file){
				canvas[index] = document.createElement("canvas");
				ctx[index] = canvas[index].getContext('2d');
				fr[index] = new FileReader();
				fr[index].onload = function(){
					img[index] = new Image();
					img[index].onload = function(){
						if(img[index].width > img[index].height){
							canvas[index].width = img[index].height;
							canvas[index].height = img[index].width;
							ctx[index].clearRect(0,0,canvas[index].width,canvas[index].height);
							ctx[index].save();
							ctx[index].translate(canvas[index].width/2,canvas[index].height/2);
							ctx[index].rotate((-90)*Math.PI/180);
							ctx[index].drawImage(img[index],-(img[index].width/2),-(img[index].height/2));
							ctx[index].restore();
						}else{
							canvas[index].width = img[index].width;
							canvas[index].height = img[index].height;
							ctx[index].drawImage(img[index],0,0);
						}
						//$("#merge_document_preview").append(canvas[index]);
						fileGenerated++;
						if(fileGenerated == sortedItem.length){
							window.mergeDocumentDoc = new jsPDF();
							console.log(window.mergeDocumentDoc);
							var A4Size = {width: 210-10, height: 297-10, pxToMM: 0.2645833};
							$.each(canvas, function(index, file){
								var w, h, x, y, imgString, caseNo;
								/*window.mergeDocumentDoc.setFontSize(40);
								window.mergeDocumentDoc.text(30, 20, 'Hello world!');*/
								if(canvas[index].width*A4Size.pxToMM <= A4Size.width && canvas[index].height*A4Size.pxToMM <= A4Size.height){
									caseNo = 1;
									w = canvas[index].width*A4Size.pxToMM;
									h = canvas[index].height*A4Size.pxToMM;
									x = (A4Size.width - w)/2;
									y = (A4Size.height - h)/2;
									if(x < 10/2)
										x = 10/2;
									if(y < 10/2)
										y = 10/2;
								}else if(canvas[index].width >= canvas[index].height){
									caseNo = 2;
									w = A4Size.width;
									h = (canvas[index].height/canvas[index].width)*A4Size.width/**A4Size.pxToMM*/;
									x = (A4Size.width - w)/2;
									y = (A4Size.height - h)/2;
									if(x < 10/2)
										x = 10/2;
									if(y < 10/2)
										y = 10/2;
								}else{
									caseNo = 3;
									h = A4Size.height;
									w = (canvas[index].width/canvas[index].height)*A4Size.height/**A4Size.pxToMM*/;
									x = (A4Size.width - w)/2;
									y = (A4Size.height - h)/2;
									if(x < 10/2)
										x = 10/2;
									if(y < 10/2)
										y = 10/2;
								}
								imgString = canvas[index].toDataURL('image/jpeg');
								console.log(index, ' := ', caseNo, ' -> ', sortedItem.length,  Math.abs(Math.ceil(x)), Math.abs(Math.ceil(y)), Math.abs(Math.ceil(w)), Math.abs(Math.ceil(h)));
								window.mergeDocumentDoc.addImage(imgString, 'JPEG', Math.abs(Math.ceil(x)), Math.abs(Math.ceil(y)), Math.abs(Math.ceil(w)), Math.abs(Math.ceil(h)));
								//window.mergeDocumentDoc.addImage(imgString, 'JPEG', 10*pxToMM, 10*pxToMM, A4Size.width, A4Size.height);
								if(index != (sortedItem.length - 1)){
									window.mergeDocumentDoc.addPage('a4', 'p');
								}else{
									console.log("Success");
									$("#merge_document_preview_wrapper, #merge_document_preview").css({
										"padding-bottom": '',
										"height": ''
									});
									window.mergeDocumentBlob = window.mergeDocumentDoc.output('blob');
									$("#merge_document_preview").attr("src", URL.createObjectURL(window.mergeDocumentBlob));
									$("#merge_document_save").attr("disabled", typeof window.mergeDocumentBlob == "undefined");
								}

							});
						}
					}
					img[index].src = fr[index].result;
				};
				fr[index].readAsDataURL(file);
			});
		});

		$("#merge_document_save").click(function(e){
			e.preventDefault();
			if(typeof window.mergeDocumentBlob != "undefined"){
				if(uploader.files.length > 0)
					uploader.splice()
				uploader.addFile(window.mergeDocumentBlob, 'mergedFile.pdf');
				window.mergeDocumentDropzone.removeAllFiles();
				window.mergeDocumentBlob = undefined;
				$("#merge_document_preview_wrapper, #merge_document_preview").css({
					"padding-bottom": '1px',
					"height": '1px'
				});
				$("#merge_document").modal('hide');
			}
		});
	}
	/* /Added for pdf merging */
});
</script>
</body>
</html>
