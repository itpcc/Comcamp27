<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<title>Comcamp #27: Registration System</title>
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
	<link rel="stylesheet" href="/assets/css/main.css"/>
	<style type="text/css">
		#image_profile_wait{
			width: 150px;
			height: 150px;
			padding: 5px;
			position: relative;
		}
		.spinner {
		  width: 140px;
		  height: 140px;
		  border-radius: 50%;
		  box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.1), 2px 1px 0px white;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  margin-top: -25px;
		  margin-left: -25px;
		  -moz-animation: spin 0.7s linear infinite;
		  -webkit-animation: spin 0.7s linear infinite;
		  animation: spin 0.7s linear infinite;
		}
		@-moz-keyframes spin {
		  100% {
			-moz-transform: rotate(360deg);
			transform: rotate(360deg);
		  }
		}
		@-webkit-keyframes spin {
		  100% {
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		  }
		}
		@keyframes spin {
		  100% {
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		  }
		}
	</style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
var fb_id, api_token, file_id, file_type, serverDateTime, doc_1, doc_2;
var page = 1;
serverDateTime = new Date();

function LoadImage(src, element, callback) {
	var img = new Image();

	img.onload = function() {
		element.src = img.src;
		callback();
	};

	img.src = src;
} 

$(document).ready(function(){

	$("#next_page").click( function(){
		console.log('page: ' + page);
		page = page + 1;
		getList(api_token, page);
		if(page>1){
			$("#back_page").fadeIn();
		} else {
			$("#back_page").fadeOut();
		}

		if(page<28){
			$("#next_page").fadeIn();
		} else {
			$("#next_page").fadeOut();
		}
		$("#page_now").html('หน้า ' + page +'/28');
	});

	$("#back_page").click( function(){
		page = page - 1;
		getList(api_token, page);
		if(page>1){
			$("#back_page").fadeIn();
		} else {
			$("#back_page").fadeOut();
		}
		if(page<28){
			$("#next_page").fadeIn();
		} else {
			$("#next_page").fadeOut();
		}
		console.log('page: ' + page);
		$("#page_now").html('หน้า ' + page + '/28');
	});

	$("#data").on('click', ".get_full[data-id]", function(){
		var id = $(this).data("id");
		console.log(this, '->', id);
		$("#image_profile img, #image_profile_404, #image_profile_pdf").hide();
		$("#image_profile_wait").show();

		$.post("/api/index.php/user/full/" + $(this).data("id"), {
			'code': api_token
		}, function(result){
			console.log(result);
			var userdata = result.userdata;
			var gender;
			if(userdata.gender==1){
				gender = "ชาย";
			} else {
				gender = "หญิง";
			}


			$('#name').html(userdata.fname_th + ' ' + userdata.lname_th + ' (' + userdata.fname_en + ' ' + userdata.lname_en + ')');
			$('#nickname').html(userdata.nname_th + ' (' + userdata.nname_en + 	')');
			$('#email').html(userdata.email);
			$('#gender').html(gender);
			$('#grade').html(userdata.grade);
			$('#class').html(userdata.class_step + ' ('+userdata.class_type+')');
			$('#school').html(userdata.school["school"] + ' <b>จังหวัด</b> '+userdata.school.province);
			$('#province').html(userdata.home_village["province"]);
			$('#religion').html(userdata.religion);
			$("#home_address").html(
				'<dl class="dl-horizontal">'+
					'<dt style="width: 70px;">ที่อยู่ </dt><dd style="margin-left: 80px;">'+userdata.home_address+'</dd>'+
					'<dt style="width: 70px;">ตำบล </dt><dd style="margin-left: 80px;">'+userdata.home_village.district+'</dd>'+
					'<dt style="width: 70px;">อำเภอ </dt><dd style="margin-left: 80px;">'+userdata.home_village.amphur+'</dd>'+
					'<dt style="width: 70px;">จังหวัด </dt><dd style="margin-left: 80px;">'+userdata.home_village.province+'</dd>'+
					'<dt style="width: 70px;">รหัส ปณ. </dt><dd style="margin-left: 80px;">'+userdata.home_village.zipcode+'</dd>'+
				'</dl>'
			);

			if(userdata.congenital_disease){
				$('#congenital_disease').html(userdata.congenital_disease);
			} else {
				$('#congenital_disease').html('-');
			}

			if(userdata.food){
				$('#food').html(userdata.food);
			} else {
				$('#food').html('-');
			}

			$('#tel').html(userdata.mobile_phone);
			$('#parent_tel').html(userdata.parent_phone+' <b>'+userdata.parent_name+'</b>');
			$('#travel').html(userdata.travel);
			$('#reward').html((userdata.computer_reward.length > 0)?userdata.computer_reward:' - ');
			
			//if student has an image for show
			var imageExist = $(".registree_row[data-id="+id+"] a[data-file]");
			if(imageExist.length > 0){
				if( imageExist.data("extension") == "pdf" ){
					$("#image_profile_pdf").attr("src", "/api/user/get_document/" + imageExist.data("file") + "/full");
					$("#image_profile").attr("href", "/api/user/get_document/" + imageExist.data("file") + "/full");
					$("#image_profile_wait, #image_profile_404, #image_profile img").hide();
					$("#image_profile_pdf").fadeIn();
				}else{
					LoadImage("/api/user/get_document/" + imageExist.data("file") + "/preview", $("#image_profile img")[0], function(){
						$("#image_profile").attr("href", "/api/user/get_document/" + imageExist.data("file") + "/full");
						$("#image_profile_wait, #image_profile_404, #image_profile_pdf").hide();
						$("#image_profile img").fadeIn();
					});
				}
			}else if(typeof userdata.fb_id !== "undefined"){
				
				LoadImage("http://graph.facebook.com/"+userdata.fb_id+"/picture?type=normal", $("#image_profile img")[0], function(){
					$("#image_profile").attr("href", "#");
					$("#image_profile_wait, #image_profile_404, #image_profile_pdf").hide();
					$("#image_profile img").fadeIn();
				});
			}else if(typeof userdata.fbid !== "undefined"){
				LoadImage("http://graph.facebook.com/"+userdata.fbid+"/picture?type=normal", $("#image_profile img")[0], function(){
					$("#image_profile").attr("href", "#");
					$("#image_profile_wait, #image_profile_404, #image_profile_pdf").hide();
					$("#image_profile img").fadeIn();
				});
			}else{
				$("#image_profile").attr("href", "#");
				$("#image_profile img").attr("src", "http://placehold.it/150x150");
				$("#image_profile_404").show();
				$("#image_profile img, #image_profile_wait, #image_profile_pdf").hide();
			}

			$('#full_modal').modal('show');
		}, 'json');
	});
});

function getList(api_token, page) {

	console.log('token to getlist ' + api_token + ', page: ' + page) ;
	$.post("/api/index.php/user/fetch_list/" + page + "/20/0", {
		'code': api_token,
		'state':"<?php echo $_SESSION['state']; ?>"
	}, function(result){
		console.log(result);
		$("#preload").fadeIn();
		$("#data").empty();
		$("#data").fadeOut();
		$("#data").append('<tr><th class="col-md-1">ลำดับ</th><th>รหัสการสมัคร</th><th>ชื่อ-นามสกุล (คลิกดูข้อมูล)</th><th>ชื่อเล่น</th><th class="col-md-4">เอกสารที่อัพโหลด</th></tr>')
		$("#data_page").fadeIn();
		if(result.status == "success"){
			$("#preload").fadeOut();
			$("#data").fadeIn();
			var data = result.data;
			var id,first_name,last_name,nick_name,regis_id,sent_doc,doc_1,doc_2;
			console.log(data);
			$.each( data, function(i) {
				doc_1 = null;
				doc_2 = null;
				id = data[i].id;
				console.log(id);
				first_name = data[i].first_name;
				last_name = data[i].last_name;
				nick_name = data[i].nick_name;
				regis_id = data[i].regis_key;
				sent_doc = data[i].sent_doc;

				$("#data").append('<tr class="registree_row" data-id="'+id+'"><td>' + id + "</td><td>" + regis_id + '</td><td><a href="javascript: void(0);" class="get_full" data-id="'+id+'">' + first_name + " " + last_name + "</a></td><td>" + nick_name + "</td><td><span id='" + id + "'></span> </td></tr>");
					if(sent_doc["registration_paper#1"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/1", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									console.log('id: ' + data[i].id + ', doc_1: ' + doc_1);
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>ใบสมัครส่วนที่ 1</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["registration_paper#2"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/2", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>ใบสมัครส่วนที่ 2</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["idcard"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/3", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>สำเนาบัตรน้อง</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["grade_certificate"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/5", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>ปพ.1</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["student_certificate"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/4", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>ปพ.7</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["parent_agree"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/7", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>ใบขออนุญาต</a></h6>");
								}
							}
						}, 'json');
					}


					if(sent_doc["parent_idcard"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/6", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									console.log('id: ' + data[i].id + ', doc_1: ' + doc_1);
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank'>สำเนาบัตร ผปค.</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["photograph_official"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/8", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									//console.log('id: ' + data[i].id + ', doc_1: ' + doc_1);
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank' data-doc=\"8\" data-file=\""+file_id+"\" data-extension=\""+revision[0].extension+"\">รูปหน้าตรง</a></h6>");
								}
							}
						}, 'json');
					}

					if(sent_doc["photograph_freestyle"]){
						$.post("/api/index.php/user/fetch_attachment/" + data[i].id + "/9", {
								'code': api_token,
								'state':"<?php echo $_SESSION['state']; ?>"
						}, function(result){
							if(result.status=="success"){
								var revision = result.revision;
								if(revision&&revision[0].file_id){
									var file_id = revision[0].file_id;
									link = "/api/user/get_document/" + file_id + "/full";
									//console.log('id: ' + data[i].id + ', doc_1: ' + doc_1);
									$("#" + data[i].id).append("<h6><a href='" + link + "' target='_blank' data-doc=\"9\" data-file=\""+file_id+"\" data-extension=\""+revision[0].extension+"\">รูปอิสระ</a></h6>");
								}
							}
						}, 'json');
					}


			});
		}
	}, 'json');
}


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
		$.post("/api/index.php/admin/token", {
			'code': fbToken,
			'state':"<?php echo $_SESSION['state']; ?>"
		}, function(result){
			console.log(result);
			if(result.status == "success"){
				$("#login").fadeOut();
				$("#preload").fadeIn();
				api_token = result.token;
				getList(api_token, page);

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
		console.log('fb_id: ' + response.id);
		fb_id = response.id;
		$("#fbid").append('ถ้าล็อกอินแล้วยังเข้าไม่ได้ เอารหัสนี้ -> ' + fb_id + ' <- ไปบอกวินด้วยจ้า');
	});
}

</script>
<div class="container">
	<div class="row">
		<div style="text-align:center; color:#FFF !important; margin: 45px auto 30px auto;">
			<span style="font-size:72px; color:#FFF !important; margin:15px auto;" class="comcamp-icon-ComcampFullLogo"></span>
			<h4>ระบบทะเบียน ค่ายคอมแคมป์ครั้งที่ 27</h4>
		</div>
	</div>
	<!-- login -->
	<div class="row" id="login">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body" style="text-align:center;">
					<h3>กรุณาล็อกอินเข้าสู่ระบบก่อนใช้งาน</h3>
					<br>
					<div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="">เข้าสู่ระบบ</div>
					<br><br>
					<span id="fbid"></span>
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


	<div id="data_page" style="display:none;">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-body">
						น้องที่อัพเอกสารอย่างอื่นแต่ไม่ได้อัพใบคำถาม / อัพใบคำถามมาไม่ครบ บางคนคือน้องเค้าส่งมาทางเมลแทนนะ
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-bordered" style="background:#FFF;" id="data">
					<tr>
						<th class="col-md-1">ลำดับที่</th>
						<th>รหัสการสมัคร</th>
						<th>ชื่อ-นามสกุล</th>
						<th>ชื่อเล่น</th>
						<th class="col-md-4">เอกสาร</th>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<nav>
					<ul class="pagination">
						<li>
							<a href="#" id="back_page" style="display:none;" aria-label="Previous">
								<span aria-hidden="true"><</span>
							</a>
						</li>
						<li>
							<a id="page_now">หน้า 1/28</a>
						</li>
						<li>
							<a href="#" id="next_page" aria-label="Next">
								<span aria-hidden="true">></span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<!-- end -->

	<div id="full_modal" class="modal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">ข้อมูลเพิ่มเติม</h4>
	  </div>
	  <div class="modal-body">
		<table class="table">
			<tr>
				<td rowspan="5">
					<div id="image_profile_wait">
						<div class="spinner"></div>
					</div>
					<p class="bg-danger" id="image_profile_404">ไม่มีรูปในสารบบ</p>
					<iframe src="/date.php" width="150" height="150" id="image_profile_pdf"></iframe>
					<a href="#" id="image_profile" target="_blank">
						<img src="http://placehold.it/150x150" width="150" height="150" />
					</a>
				</td>
				<td>
					ชื่อ-นามสกุล
				</td>
				<td id="name">

				</td>
			</tr>
			<tr>
				<td>
					ชื่อเล่น
				</td>
				<td id="nickname">

				</td>
			</tr>
			<tr>
				<td>
					E-mail
				</td>
				<td id="email">

				</td>
			</tr>
			<tr>
				<td>
					เพศ
				</td>
				<td id="gender">

				</td>
			</tr>
			<tr>
				<td>
					ระดับชั้น
				</td>
				<td id="class">

				</td>
			</tr>
			<tr>
				<td>
					เกรด
				</td>
				<td id="grade" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					โรงเรียน
				</td>
				<td id="school" colspan="2">

				</td>        		
			</tr>
			<tr>
				<td>
					ที่อยู่
				</td>
				<td id="home_address" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					ศาสนา
				</td>
				<td id="religion" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					โรคประจำตัว
				</td>
				<td id="congenital_disease" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					อาหารที่แพ้
				</td>
				<td id="food" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					<strong>รางวัล/ผลงาน</strong>
				</td>
				<td id="reward" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					เบอร์โทรศัพท์
				</td>
				<td id="tel" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					เบอร์โทรศัพท์ผู้ปกครอง
				</td>
				<td id="parent_tel" colspan="2">

				</td>
			</tr>
			<tr>
				<td>
					การเดินทาง
				</td>
				<td id="travel" colspan="2">

				</td>
			</tr>
		</table>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">[x] Close</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</div>
</body>
</html>
