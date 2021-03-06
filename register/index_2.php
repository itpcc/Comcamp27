<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
/*$to_time = strtotime("2015-03-09 14:00:00");
$from_time = time();
if(*$from_time < $to_time  !isset($_GET['checkpap'])){
	include './maintenance.php';
	exit;
}*/

if(empty($_SESSION['state'])){
	$_SESSION['state'] = md5(uniqid(rand(), true));
	$_SESSION['nonce'] = md5(uniqid(rand(), TRUE)); // New code to generate auth_nonce
}
$html = '';
$siteKey = '6Lf-ggETAAAAAH2JT2Z0t5klW22lThtlRxVENIKL';
$secretKey = '6Lf-ggETAAAAAOtS9SBQI_t8Xp-T9coCJLRclL0g';
?>
<!DOCTYPE html>
<html ng-app>
	<head>
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
		<title>Comcamp #27</title>
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
		<link rel="stylesheet" href="assets/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="assets/css/selectize.css"/>
		<link rel="stylesheet" href="assets/css/selectize.bootstrap3.css"/>
		<link rel="stylesheet" href="assets/css/main.css"/>
		<style type="text/css">
			.selectize-control::before {
				-moz-transition: opacity 0.2s;
				-webkit-transition: opacity 0.2s;
				transition: opacity 0.2s;
				content: ' ';
				z-index: 2;
				position: absolute;
				display: block;
				top: 12px;
				right: 34px;
				width: 16px;
				height: 16px;
				background: url(/assets/images/spinner.gif);
				background-size: 16px 16px;
				opacity: 0;
			}
			.selectize-control.loading::before {
				opacity: 0.4;
			}

			.fade-link {
				color: #2980b9;
				text-decoration: none !important;
				-webkit-transition: all 0.2s linear;
				transition: all 0.2s linear;
			}

			.fade-link:hover {
				color: #3498db;
			}

			#upload {
				margin-top: 8px;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script type="text/javascript" src="assets/js/standalone/selectize.min.js"></script>
		<script type="text/javascript" src="assets/js/plupload.full.min.js"></script>
		<script src="assets/js/jquery.plupload.queue/jquery.plupload.queue.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/js/simpleStorage.js"></script><!-- Added for storage -->
	</head>
	<body>
		<script>
			var fb_id, fb_token, api_token, response, $schoolSearchSelectize, canDraft;
			var serverDateTime = new Date();
			/*** Added for storage ***/
			var normalInput = [
				'fname_th',
				'lname_th',
				'nname_th',
				'fname_en',
				'lname_en',
				'nname_en',
				'age',
				'congenital_disease',
				'food',
				'grade',
				'home_address',
				'postal',
				'mobile_phone',
				'email',
				'parent_name',
				'parent_relation',
				'parent_address',
				'parent_postal',
				'parent_phone',
				'interest_faculty_1',
				'interest_faculty_2',
				'interest_faculty_3',
			];
			var checkboxInput = [
				'interest',
				'skill'
			];
			var selectInput = [
				'gender',
				'religion',
				'shirt_size',
				'class_step',
				'class_type'
			];
			var radioInput = [
				{ attr: "ng-model", value: "camp"},
				{ attr: "ng-model", value: "reward"},
				{ attr: "name", value: "travel"},
			];
			var storagePrefix = "cc27_";
			var provinceCallbackReal = function(){
				console.log("Waiting for real one!");
				window.setTimeout(provinceCallbackReal, 2000);
			}, parentProvinceCallbackReal = function(){
				console.log("Waiting for real parent one!");
				window.setTimeout(parentProvinceCallbackReal, 2000);
			}, schoolProvinceCallbackReal = function(){
				console.log("Waiting for real school one!");
				window.setTimeout(schoolProvinceCallbackReal, 2000);
			};

			function chooseSelectize(selector, id){
				if(selector[0].selectize.getValue() != id){
					window.setTimeout(function(){ selector[0].selectize.setValue(id); }, 500);
				}/*else{
					window.setTimeout(function(){ chooseSelectize(selector, id); }, 100);
				}*/
			}
			/*** /Added for storage ***/

			// This is called with the results from from FB.getLoginStatus().
			function statusChangeCallback(response) {
				console.log('statusChangeCallback');
				console.log(response);
				// The response object is returned with a status field that lets the
				// app know the current login status of the person.
				// Full docs on the response object can be found in the documentation
				// for FB.getLoginStatus().
				if (response.status === 'connected') {
					// Logged into your app and Facebook.
					console.log("Token", response.authResponse.accessToken);
					fbToken = response.authResponse.accessToken;
					$(".fb-login").empty();
					$(".fb-login").append('<center><h2><i class="glyphicon glyphicon-cog glyphicon-refresh-animate"></i></h2><h4>Please wait...</h4><h6>หากค้างอยู่หน้านี้นานๆ ระบบอาจมีปัญหานะครับ หากเร่งด่วนติดต่อพี่ๆทาง Facebook Fanpage ได้เลยครับ / ส่งใบสมัครรบกวนส่งทางอีเมล webmaster@comcamp.in.th แทนก่อนนะครับ</h6></center>');
					$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
						'code': response.authResponse.accessToken,
						'state':"<?php echo $_SESSION['state']; ?>"
					}, function(result){
						if(result.status == "success"){
							api_token = result.token;
							console.log('Result => ', result);
							getRegistered(api_token);
							$("#info-head, #searchSchoolButton").show();
							$("#getPdfForm [name=code]").val(result.token);
						}
					}, 'json');

					connectAPI();

				} else if (response.status === 'not_authorized') {
					// The person is logged into Facebook, but not your app.
					document.getElementById('status').innerHTML = 'Please log ' +
					'into this app.';
				} else {
					// The person is not logged into Facebook, so we're not sure if
					// they are logged into this app or not.
					document.getElementById('status').innerHTML = 'Please log ' +
					'into Facebook.';
				}
			}

			function getRegistered(api_token){
				console.log("api_token sent to getRegistered: " + api_token);
				$.post("/api/index.php/user/lite",{
					'code': api_token
				}, function(result){
					$(".fb-login").empty();
					console.log("Registered: " + result.registered);
					if(result.registered==false){
						$("#info").append('<p id="status">สถานะ: <span class="label label-default">ยังไม่ได้ลงทะเบียน</span></p>');
						$("#regis-form").show();
						/*** Added for storage ***/
						if(canDraft){ //restore old value to normal and checkbox
							provinceCallbackReal(); parentProvinceCallbackReal(); schoolProvinceCallbackReal();
							$.each(normalInput, function(i, ID){
								var element = $("#"+ID), resultVal = simpleStorage.get(storagePrefix+ID);

								if(element.length > 0){
									if(typeof resultVal == "string" && resultVal.length > 0){
										element.val(resultVal);
									}
								}
								$(document.body).on('blur change', element ,function(){
									var inputValue = element.val();
									//console.log(storagePrefix+ID, "trigged =>", inputValue, " -> ", element);
									if(inputValue.length > 0){
										simpleStorage.set(storagePrefix+ID, inputValue);
									}
								});
							});

							$.each(checkboxInput, function(i, ID){
								var element = $("input[name='"+ID+"']"), resultVal = simpleStorage.get(storagePrefix+ID), allValue = {};
								if(element.length > 0){
									if(typeof resultVal == "string" && resultVal.length > 0){
										try{
											allValue = JSON.parse(resultVal);
										}catch(e){
											simpleStorage.deleteKey(storagePrefix+ID);
										}
									}else if(typeof resultVal == "object" && resultVal != null){
										allValue = resultVal;
									}
									if(!jQuery.isEmptyObject(allValue)){
										jQuery.each(allValue, function(i, val){
											$("input[name='"+ID+"'][value='"+i+"']").attr('checked', val?true:false);
										});
									}

									$(document.body).on('change', element ,function(){
										var inputValue = {};
										element.each(function(){
											inputValue[$(this).val()] = (this.checked)?true:false;
										});
										if(!jQuery.isEmptyObject(inputValue)){
											simpleStorage.set(storagePrefix+ID, inputValue);
										}
									});
								}
							});

							$.each(radioInput, function(i, ID){
								var element = $("input["+ID.attr+"='"+ID.value+"']"), resultVal = simpleStorage.get(storagePrefix+ID.attr+'_'+ID.value), allValue = {};
								//console.log(element.selector+' -> ', element);
								if(element.length > 0){
									if(typeof resultVal == "string" && resultVal.length > 0){
										console.log(element.selector+' ---Checked---> ', resultVal);
										$("input["+ID.attr+"='"+ID.value+"'][value='"+resultVal+"']").attr('checked', true);
									}

									$(document.body).on('change', element ,function(){
										element.each(function(){
											if(this.checked){
												simpleStorage.set(storagePrefix+ID.attr+'_'+ID.value, this.value);
											}
										});

									});
								}
							});

							$.each(selectInput, function(i, ID){
								var element = $("#"+ID), resultVal = simpleStorage.get(storagePrefix+ID), allValue = {};
								if(element.length > 0){
									if(typeof resultVal == "string" && resultVal.length > 0){
										$("#"+ID+" option[value='"+resultVal+"']").attr('selected', true);
									}

									$(document.body).on('change', element ,function(){
										var inputValue = element.val();
										if(typeof inputValue == "string" && inputValue.length > 0){
											simpleStorage.set(storagePrefix+ID, inputValue);
										}
									});
								}
							});

							//ng-model
						}
						/*** /Added for storage ***/
					} else {
						$("#info").append('<p id="status">สถานะ: <span class="label label-success">ลงทะเบียนแล้ว</span></p>');
						$("#registered").show();
					}
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
					window.location = window.location.origin;
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

			/*** Added for storage ***/
			// Load the SDK asynchronously
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			/*** /Added for storage ***/

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




					document.getElementById('info').innerHTML =
					'<p><img id="avatar" src="http://graph.facebook.com/' + response.id + '/picture?type=square">'+
					' ' + response.name + '</p><hr>';
					fb_id = response.id;
					console.log('fb_id: ' + response.id);
				});
			}

			function postWall(){
				FB.api(
					"/me/feed",
					"POST",
					{
						"message": "ค่ายคอมแคมป์ ครั้งที่ 27 สุดยอดค่ายที่น้องๆ ม.ปลาย จะได้มาสัมผัสประสบการณ์การเรียนวิศวคอมของจริง! เปิดรับสมัครแล้ววันนี้ #comcamp27",
						"link": "http://www.comcamp.in.th",
					},
					function (response) {
						if (response && !response.error) {
							/* handle the result */
						}
					}
				);
			}

			function userAdd(fbToken){

				var interest_array = [];
				$("input[name='interest']:checked").each(function ()
				{
					interest_array.push($(this).val());
				});

				var skill_array = [];
				$("input[name='skill']:checked").each(function ()
				{
					skill_array.push($(this).val());
				});

				var camp = [];
				if($("#camp_1").val()!=""){
					var camp_data = {
						"camp_name" : $("#camp_1").val(),
						"camp_by"   : $("#camp_university_1").val()
					}
					camp.push(camp_data);
				};

				if($("#camp_2").val()!=""){
					var camp_data = {
						"camp_name" : $("#camp_2").val(),
						"camp_by"   : $("#camp_university_2").val()
					}
					camp.push(camp_data);
				};

				if($("#camp_3").val()!=""){
					var camp_data = {
						"camp_name" : $("#camp_3").val(),
						"camp_by"   : $("#camp_university_3").val()
					}
					camp.push(camp_data);
				};

				var userdata = {
					"fb_id"					: fb_id,
					"fname_th" 			: $("#fname_th").val(),
					"lname_th"			: $("#lname_th").val(),
					"nname_th"			: $("#nname_th").val(),
					"fname_en"  		: $("#fname_en").val(),
					"lname_en"  		: $("#lname_en").val(),
					"nname_en" 			: $("#nname_en").val(),
					"birthdate"     : $("#birthdate").val(),
					"age"           : $("#age").val(),
					"gender"        : $("#gender").val(), //ชาย 2 หญิง
					"religion"      : $("#religion").val(),
					"shirt_size"    : $("#shirt_size").val(),
					"congenital_disease" : $("#congenital_disease").val(),
					"food"          : $("#food").val(),
					"class_step"    : $("#class_step").val(),
					"class_type"    : $("#class_type").val(),
					"grade"         : $("#grade").val(),
					"school"        : $("#school").val(),
					"school_province": $("#province").val(),
					"home_address"  : $("#home_address").val(),
					"home_village"  : $("#district").val(),
					"home_postal"   : $("#postal").val(),
					"mobile_phone"  : $("#mobile_phone").val(),
					"email"         : $("#email").val(),
					"parent_name"   : $("#parent_name").val(),
					"parent_relation"   : $("#parent_relation").val(),
					"parent_address"    : $("#parent_address").val(),
					"parent_village"    : $("#parent_district").val(),
					"parent_postal"     : $("#parent_postal").val(),
					"parent_phone"      : $("#parent_phone").val(),
					"computer_reward"   : $("#computer_reward").val(),
					"travel"            : $('input[name=travel]:checked', '#form').val(),
					"interest_universities" : [
						{
							"university"    : $("#interest_university_1").val(),
							"faculty"       : $("#interest_faculty_1").val()
						},{
							"university"    : $("#interest_university_2").val(),
							"faculty"       : $("#interest_faculty_2").val()
						},{
							"university"    : $("#interest_university_3").val(),
							"faculty"       : $("#interest_faculty_3").val()
						}
					],
					//optional
					"camp" : camp,
					"practice" : {
						"interest" : interest_array,
						"skill" : skill_array
					}
				}

				$("#back").hide();
				$("#ajax-result").empty();
				$("#ajax-result").append('<center><h2><i class="glyphicon glyphicon-cog glyphicon-refresh-animate"></i></h2><h4>Sending data to server... Please wait</h4></center>');
				console.log("Sent => ",  userdata);
				console.log("Token: " + fbToken);
				$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
					'code': fbToken,
					'state': "<?php echo $_SESSION['state']; ?>"
				}, function(data){
					console.log(data);
					$.post("/api/index.php/user/add", {
							"token": data.token,
							"userdata": JSON.stringify(userdata),
							"g-recaptcha-response" : response
						}, function(result){
							$("#ajax-result").empty();
							var data = JSON.parse(result);
							if(data.status=="fail"){
								grecaptcha.reset();
								detail = data.detail;
								console.log(detail);
								$("#ajax-result").append('<div class="alert alert-warning" role="alert"><b>เกิดความผิดพลาด ทำให้ส่งแบบฟอร์มไม่ได้ </b><br>อาจเกิดจากน้องกรอกข้อมูลไม่ถูกต้องตามลักษณะ (ข้อมูลบางช่องไม่อนุญาตให้ใช้อักขระพิเศษ) หรืออาจกรอกข้อมูลไม่ครบ ลองกลับไปตรวจสอบข้อมูลดูอีกครั้งนะครับ<br><h6>สาเหตุ: </h6><div id="ajax-reason"></div>');
								for (i in detail){
										$("#ajax-reason").append(i + ': ' + detail[i] +'<br>');
								}
								$("#ajax-reason").append('<h6>หากน้องๆพบปัญหาในการส่งแบบฟอร์ม สามารถสอบถามได้ทาง <a href="https://www.facebook.com/messages/145236308962439" target="_blank">Facebook Page ของโครงการ</a> โดยแนบสาเหตุด้านบนมาด้วยนะครับ</h6>')
								$("#back").show();
							} else {
								$("#ajax-result").append('<div class="alert alert-success" role="alert"><b>ยินดีด้วย! </b>น้องสมัครเข้าค่ายคอมแคมป์สำเร็จแล้ว<br>'
								+ 'รหัสการสมัครของน้องคือ: ' + data.registration_code + '</div>');
								$(".getpdf").show();
								$("#status").empty();
								$("#status").append('สถานะ: <span class="label label-success">ลงทะเบียนแล้ว</span>');
								api_token = data.token;
								$("input[name=code]").val(api_token);
								postWall();
							}
						}
					);
				}, 'json');
			}

			$(document).ready(function() {
				$.ajaxSetup({
					cache:false
				});
				canDraft = simpleStorage.canUse();

				$.get('/api/index.php/get/time', function(dateString){
					if(Date.parse(dateString) !== NaN)
						serverDateTime = new Date(dateString);
				});

				/********  Convert to selectize *********/
				$.post( "/api/index.php/get/address/province", function( data ) {
					var items = [];
					$.each( data.result, function( key, val ) {
						$("#school_province, #parent_province, #province, #school_search_province").append( "<option value='" + key + "'>" + val + "</option>" );
					});

					/*** Added for storage ***/
					if(canDraft){
						$("#school_province, #parent_province, #province, #school_search_province").each(function(){
							var resultVal = simpleStorage.get(storagePrefix+this.id);
							if(typeof resultVal == "string" && resultVal.length > 0){
								$(this).find("option[value='"+resultVal+"']").attr("selected", true);
							}

							$(this).change(function(){
								var inputValue = $(this).val();
								if(inputValue.length > 0)
									simpleStorage.set(storagePrefix+this.id, inputValue);
							});
						});
					}
					/*** /Added for storage ***/

					var xhr;
					var provinceSelectize = {}; var $provinceSelectize = $('#province').selectize({
						//onInitialize: provinceCallback,
						onChange: function(province_id) {
							if(typeof province_id == "number")
								province_id = province_id.toString();

							amphurSelectize.disable(); 		amphurSelectize.clear();	amphurSelectize.clearOptions();
							districtSelectize.disable(); 	districtSelectize.clear();	districtSelectize.clearOptions();
							$("#postal").val('');			$("#postal").attr("readonly", true);

							if (!province_id.length || province_id == "0") return;
							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'province', province_id);
							/*** /Added for storage ***/

							amphurSelectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: '/api/index.php/get/address/amphur/' + province_id,
									dataType: 'json',
									success: function(data){
										//console.log("amphur =>", data);
										/*** Added for storage ***/
										var draftAmphurValueFound = false;
										if(canDraft && typeof amphurSelectize.isDraftSave == "undefined"){
											var draftAmphurValue = simpleStorage.get(storagePrefix+'amphur');
										}else{
											window.isChooseAmphur = amphurSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
										var items = [];
										$.each( data.result, function( key, val ) {
											items.push({
												"id" : key,
												"value" : val
											});
											/*** Added for storage ***/
											if(canDraft && typeof amphurSelectize.isDraftSave == "undefined" && typeof draftAmphurValue != "undefined" && key == draftAmphurValue && !draftAmphurValueFound){
												draftAmphurValueFound = true;
											}
											/*** /Added for storage ***/
										});
										amphurSelectize.enable();
										callback(items);
										/*** Added for storage ***/
										if(draftAmphurValueFound && typeof window.isChooseAmphur == "undefined"){
											chooseSelectize($("#amphur"), draftAmphurValue);
											provinceSelectize.isCallAmphur = window.isChooseAmphur = amphurSelectize.isDraftSave = true;
										}else{
											window.isChooseAmphur = amphurSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
									},
									error: function() {
										callback();
									}
								});
							});
						}
					});

					var amphurSelectize = {}, $amphurSelectize = $('#amphur').selectize({
						valueField: 'id',
						labelField: 'value',
						searchField: ['value'],
						onChange: function(amphur_id) {
							if(typeof amphur_id == "number")
								amphur_id = amphur_id.toString();

							if (!amphur_id.length) return;

							districtSelectize.disable(); 	districtSelectize.clear();	districtSelectize.clearOptions();
							$("#postal").val('');			$("#postal").attr("readonly", true);

							districtSelectize.clearOptions();
							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'amphur', amphur_id);
							/*** /Added for storage ***/

							districtSelectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: '/api/index.php/get/address/district/' + amphur_id,
									dataType: 'json',
									success: function(data){
										/*** Added for storage ***/
										if(canDraft && typeof districtSelectize.isDraftSave == "undefined"){
											var draftDistrictValue = simpleStorage.get(storagePrefix+'district'), draftDistrictValueFound = false;
										}
										/*** /Added for storage ***/
										var items = [];
										$.each( data.result, function( key, val ) {
											items.push({
												"id" : key,
												"value" : val
											});
											/*** Added for storage ***/
											if(canDraft && typeof districtSelectize.isDraftSave == "undefined" && typeof draftDistrictValue == "string" && key == draftDistrictValue && !draftDistrictValueFound){
												draftDistrictValueFound = true;
											}
											/*** /Added for storage ***/
										});
										districtSelectize.enable();
										callback(items);
										/*** Added for storage ***/
										console.log('draftDistrictValue, draftDistrictValueFound =>', draftDistrictValue, draftDistrictValueFound, items);
										if(draftDistrictValueFound){
											districtSelectize.setValue(draftDistrictValue);
											districtSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
									},
									error: function() {
										callback();
									}
								});
							});
						}
					});

					var districtSelectize = {}, $districtSelectize = $('#district').selectize({
						valueField: 'id',
						labelField: 'value',
						searchField: ['value'],
						onChange: function(district_id) {
							if(typeof district_id == "number")
								district_id = district_id.toString();

							if (!district_id.length) return;
							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'district', district_id);
							/*** /Added for storage ***/
							$.getJSON("/api/index.php/get/district/"+district_id, function(data){
								if(data.status == "success" && typeof data.result.zipcode == "string"){
									$("#postal").val(data.result.zipcode);
									$("#postal").attr("readonly", true);
								}else{
									$("#postal").attr("readonly", false);
								}
							});
						}
					});

					provinceSelectize	= $provinceSelectize[0].selectize;
					amphurSelectize		= $amphurSelectize[0].selectize;
					districtSelectize	= $districtSelectize[0].selectize;
					amphurSelectize.disable();
					districtSelectize.disable();

					var parentProvinceSelectize = {}; var $parentProvinceSelectize = $('#parent_province').selectize({
						/*** /Added for storage ***/
						//onInitialize: parentProvinceCallback,
						onChange: function(province_id) {
							if(typeof province_id == "number")
								province_id = province_id.toString();

							parentAmphurSelectize.disable(); 		parentAmphurSelectize.clear();	parentAmphurSelectize.clearOptions();
							parentDistrictSelectize.disable(); 	parentDistrictSelectize.clear();	parentDistrictSelectize.clearOptions();
							$("#parent_postal").val('');			$("#parent_postal").attr("readonly", true);

							if (!province_id.length || province_id == "0") return;
							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'parent_province', province_id);
							/*** /Added for storage ***/

							parentAmphurSelectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: '/api/index.php/get/address/amphur/' + province_id,
									dataType: 'json',
									success: function(data){
										//console.log("parent_amphur =>", data);
										/*** Added for storage ***/
										if(canDraft && typeof parentAmphurSelectize.isDraftSave == "undefined"){
											var draftAmphurValue = simpleStorage.get(storagePrefix+'parent_amphur'), draftAmphurValueFound = false;
										}
										/*** /Added for storage ***/
										var items = [];
										$.each( data.result, function( key, val ) {
											items.push({
												"id" : key,
												"value" : val
											});
											/*** Added for storage ***/
											if(canDraft && typeof parentAmphurSelectize.isDraftSave == "undefined" && typeof draftAmphurValue == "string" && key == draftAmphurValue && !draftAmphurValueFound){
												draftAmphurValueFound = true;
											}
											/*** /Added for storage ***/
										});
										parentAmphurSelectize.enable();
										callback(items);
										/*** Added for storage ***/
										if(draftAmphurValueFound){
											parentAmphurSelectize.setValue(draftAmphurValue);
											parentAmphurSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
									},
									error: function() {
										callback();
									}
								});
							});
						}
					});

					var parentAmphurSelectize = {}, $parentAmphurSelectize = $('#parent_amphur').selectize({
						valueField: 'id',
						labelField: 'value',
						searchField: ['value'],
						onChange: function(parent_amphur_id) {
							if(typeof parent_amphur_id == "number")
								parent_amphur_id = parent_amphur_id.toString();

							if (!parent_amphur_id.length) return;

							parentDistrictSelectize.disable(); 	parentDistrictSelectize.clear();	parentDistrictSelectize.clearOptions();
							$("#parent_postal").val('');			$("#parent_postal").attr("readonly", true);

							parentDistrictSelectize.clearOptions();
							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'parent_amphur', parent_amphur_id);
							/*** /Added for storage ***/
							parentDistrictSelectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: '/api/index.php/get/address/district/' + parent_amphur_id,
									dataType: 'json',
									success: function(data){
										/*** Added for storage ***/
										if(canDraft && typeof parentDistrictSelectize.isDraftSave == "undefined"){
											var draftDistrictValue = simpleStorage.get(storagePrefix+'parent_district'), draftDistrictValueFound = false;
										}
										/*** /Added for storage ***/
										var items = [];
										$.each( data.result, function( key, val ) {
											items.push({
												"id" : key,
												"value" : val
											});
											/*** Added for storage ***/
											if(canDraft && typeof parentDistrictSelectize.isDraftSave == "undefined" && typeof draftDistrictValue == "string" && key == draftDistrictValue && !draftDistrictValueFound){
												draftDistrictValueFound = true;
											}
											/*** /Added for storage ***/
										});
										parentDistrictSelectize.enable();
										callback(items);
										/*** Added for storage ***/
										if(draftDistrictValueFound){
											chooseSelectize($("#parent_district"), draftDistrictValue)
											parentDistrictSelectize.setValue(draftDistrictValue);
											parentDistrictSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
									},
									error: function() {
										callback();
									}
								});
							});
						}
					});

					var parentDistrictSelectize = {}, $parentDistrictSelectize = $('#parent_district').selectize({
						valueField: 'id',
						labelField: 'value',
						searchField: ['value'],
						onChange: function(district_id) {
							if(typeof district_id == "number")
								district_id = district_id.toString();

							if (!district_id.length) return;

							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'parent_district', district_id);
							/*** /Added for storage ***/

							$.getJSON("/api/index.php/get/district/"+district_id, function(data){
								if(data.status == "success" && typeof data.result.zipcode == "string"){
									$("#parent_postal").val(data.result.zipcode);
									$("#parent_postal").attr("readonly", true);
								}else{
									$("#parent_postal").attr("readonly", false);
								}
							});
						}
					});

					parentProvinceSelectize	= $parentProvinceSelectize[0].selectize;
					parentAmphurSelectize	= $parentAmphurSelectize[0].selectize;
					parentDistrictSelectize	= $parentDistrictSelectize[0].selectize;
					parentAmphurSelectize.disable();
					parentDistrictSelectize.disable();


					var schoolProvinceSelectize, $schoolProvinceSelectize = $('#school_province').selectize({
						onChange: function(province_id) {
							if(typeof province_id == "number")
								province_id = province_id.toString();

							if (!province_id.length) return;

							/*** Added for storage ***/
							simpleStorage.set(storagePrefix+'school_province', province_id);
							/*** /Added for storage ***/

							schoolSelectize.disable(); 	schoolSelectize.clear();	schoolSelectize.clearOptions();

							schoolSelectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: '/api/index.php/get/education/school/' + province_id,
									dataType: 'json',
									success: function(data){
										/*** Added for storage ***/
										var draftSchoolValueFound = false;
										if(canDraft && typeof schoolSelectize.isDraftSave == "undefined"){
											var draftSchoolValue = simpleStorage.get(storagePrefix+'school');
										}
										/*** /Added for storage ***/
										var items = [];
										$.each( data.result, function( key, val ) {
											items.push({
												"id" : key,
												"value" : val
											});
											/*** Added for storage ***/
											if(canDraft && typeof schoolSelectize.isDraftSave == "undefined" && typeof draftSchoolValue == "string" && key == draftSchoolValue && !draftSchoolValueFound){
												draftSchoolValueFound = true;
											}
											/*** /Added for storage ***/
										});
										schoolSelectize.enable();
										callback(items);
										/*** Added for storage ***/
										if(draftSchoolValueFound && !window.isChooseSchool){
											chooseSelectize($("#school"), draftSchoolValue);
											schoolProvinceSelectize.isCallSchool = window.isChooseSchool = schoolSelectize.isDraftSave = true;
										}
										/*** /Added for storage ***/
									},
									error: function() {
										callback();
									}
								});
							});
						}
					});

					var schoolSelectize, $schoolSelectize = $('#school').selectize({
						valueField: 'id',
						labelField: 'value',
						searchField: ['value'],
						/*** Added for storage ***/
						onChange: function(school_id) {
							if(typeof school_id == "number")
								school_id = school_id.toString();

							if (!school_id.length) return;
							simpleStorage.set(storagePrefix+'school', school_id);
						}
						/*** /Added for storage ***/
					});

					schoolProvinceSelectize	= $schoolProvinceSelectize[0].selectize;
					schoolSelectize 		= $schoolSelectize[0].selectize;
					schoolSelectize.disable();

					/*** Added for storage ***/
					provinceCallbackReal = function(){
						console.log('provinceSelectize => initializing...');
						if(canDraft && typeof provinceSelectize.isDraftSave != "boolean"){
							var resultVal = parseInt(simpleStorage.get(storagePrefix+'province'));
							if(typeof resultVal == "number" && resultVal != 0 && !isNaN(resultVal)){
								console.log('provinceSelectize => selected', resultVal, provinceSelectize.isCallAmphur);
								provinceSelectize.setValue(resultVal);
								if($('#province')[0].selectize.getValue() != resultVal.toString() /*|| typeof provinceSelectize.isCallAmphur != "boolean"*/){
									window.setTimeout(provinceCallbackReal, 200);
								}else{
									provinceSelectize.isDraftSave = true;
								}
							}else{
								console.log('provinceSelectize => unselected', resultVal, provinceSelectize.isCallAmphur);
							}
						}
					};

					parentProvinceCallbackReal = function(){
						console.log('parentProvinceSelectize => initialize');
						if(canDraft && typeof parentProvinceSelectize.isDraftSave == "undefined"){
							var resultVal = parseInt(simpleStorage.get(storagePrefix+'parent_province'));
							if(typeof resultVal == "number" && resultVal != 0 && !isNaN(resultVal)){
								console.log('parentProvinceSelectize => selected', resultVal, parentProvinceSelectize);
								parentProvinceSelectize.setValue(resultVal);
								parentProvinceSelectize.isDraftSave = true;
							}else{
								console.log('parentProvinceSelectize => selected', resultVal, parentProvinceSelectize);
							}
						}
					};

					schoolProvinceCallbackReal = function(){
						console.log('schoolProvinceSelectize => initializing...');
						if(canDraft && typeof schoolProvinceSelectize.isDraftSave != "boolean"){
							var resultVal = parseInt(simpleStorage.get(storagePrefix+'school_province'));
							if(typeof resultVal == "number" && resultVal != 0 && !isNaN(resultVal)){
								console.log('schoolProvinceSelectize => selected', resultVal, schoolProvinceSelectize.isCallSchool);
								schoolProvinceSelectize.setValue(resultVal);
								if($('#school_province')[0].selectize.getValue() != resultVal.toString() || typeof schoolProvinceSelectize.isCallSchool != "boolean"){
									window.setTimeout(schoolProvinceCallbackReal, 200);
								}else{
									schoolProvinceSelectize.isDraftSave = true;
								}
							}else{
								console.log('schoolProvinceSelectize => unselected', resultVal, schoolProvinceSelectize.isCallSchool);
							}
						}
					};
					/*** /Added for storage ***/

					/*** School Searching ***/
					$schoolSearchSelectize = $('#school_search').selectize({
						valueField: 'id',
						labelField: 'name',
						searchField: ['name'],
						onChange: function(){
							$("#schoolSearchError").hide();
						},
						load: function(query, callback) {
							var province_id = $("#school_search_province").val().toString();
							if (!query.length || query.length <= 3 || !province_id.length || province_id == "0")
								return callback();
							$.ajax({
								url: '/api/index.php/school/search/' + province_id,
								type: 'POST',
								data: {'code' : api_token, 'q' : query},
								dataType: 'JSON',
								error: function() {
									callback();
								},
								success: function(res) {
									/*console.log(res.result.slice(0, 10));*/
									if(res.status == "success")
										callback(res.result);
									else
										callback();
								}
							});
						}
					});

					$("body").on("submit", "#school-search-form", function(e){
						e.preventDefault();
						/*** Show Loading indicator ***/
						//console.log($schoolSearchSelectize);
						var schoolID = $schoolSearchSelectize[0].selectize.getValue();
						console.log('schoolID =>', schoolID);
						if(typeof schoolID == "string" && schoolID.length && parseInt(schoolID) != NaN){
							$.ajax({
								url: '/api/index.php/school/add/'+schoolID,
								data: { "code": api_token },
								type: 'POST',
								dataType: 'JSON',
								error: function(){
									$("#schoolSearchErrorReason").html("มีปัญหาระหว่างติดต่อกับ server");
									$("#schoolSearchSuccess").hide();
									$("#schoolSearchError").fadeIn();
								},
								success: function(data){
									if(data.status == "success"){
										console.log("OK =>", $("#schoolSearchSuccess").css('display', "block"));
										//alert("OK!");
										$("#schoolSearchErrorReason").html("");
										$("#schoolSearchSuccess").css('display', "block");
										$("#schoolSearchError").hide();
										$("#school-search-form input[type=submit]").attr("disabled", true).hide();
										$schoolSearchSelectize[0].selectize.clearOptions();
										$("#searchSchoolButton").hide();
										setTimeout(function(){
											$("#searchSchoolModal").modal('hide');
										}, 3000);

									}else{
										$("#schoolSearchErrorReason").html(data.reason);
										$("#schoolSearchSuccess").hide();
										$("#schoolSearchError").fadeIn();
									}
								}
							});
						}else{
							$("#schoolSearchErrorReason").html("ระบุชื่อสถานศึกษาไม่ถูกต้อง");
							$("#schoolSearchSuccess").hide();
							$("#schoolSearchError").fadeIn();
						}
					});

				}, "json");

				/******** /Convert to selectize *********/

				$.getJSON("/api/index.php/get/education/university/1",function(data){
					var items = [];
					$.each( data.result, function( key, val ) {
						$("#interest_university_1").append( "<option value='" + key + "'>" + val + "</option>" );
						$("#interest_university_2").append( "<option value='" + key + "'>" + val + "</option>" );
						$("#interest_university_3").append( "<option value='" + key + "'>" + val + "</option>" );
					});
					/*** Added for storage ***/
					if(canDraft){
						$("select[id^=interest_university]").each(function(){
							var resultVal = simpleStorage.get(storagePrefix+this.id);
							if(typeof resultVal == "string" && resultVal.length > 0){
								$(this).find("option[value='"+resultVal+"']").attr("selected", true);
							}

							$(this).change(function(){
								var inputValue = $(this).val();
								if(inputValue.length > 0)
									simpleStorage.set(storagePrefix+this.id, inputValue);
							});
						});
					}
					/*** /Added for storage ***/
				});

				$("button[ng-click='page=3']").click(function(){
					$(".previewResult").each(function(){
						var name = $(this).data("inputName");
						var result = $("#"+name).val();
						if(result && result.length){
							$(this).text(result);
						}
					});
				});

				$("#send").click( function(){
					response = grecaptcha.getResponse();
					userAdd(fbToken);
					simpleStorage.flush();
				});

				$(".getpdf-button").click( function(){
					$("input[name=code]").val(api_token);
					$("#getPdfForm").submit();
				});


				$(".gototop").click( function(){
					$('body,html').animate({
						scrollTop: 0
					}, 800);
				});

				$.getJSON("/api/index.php/get/misc/doc",function(data){
					$.each( data.result, function( key, val ) {
						$("#upload_list").append( "<option value='" + key + "'>" + val + "</option>" );
					});
					/*** Added for storage ***/
					if(canDraft){
						$("#upload_list").each(function(){
							var resultVal = simpleStorage.get(storagePrefix+this.id);
							if(typeof resultVal == "string" && resultVal.length > 0){
								$(this).find("option[value='"+resultVal+"']").attr("selected", true);
							}

							$(this).change(function(){
								var inputValue = $(this).val();
								if(inputValue.length > 0)
									simpleStorage.set(storagePrefix+this.id, inputValue);
							});
						});
					}
					/*** /Added for storage ***/
				});

			});
		</script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback" async defer></script>
		<script type="text/javascript">
			var onloadCallback = function(){
				console.log('reCAPTCHA Ready.');
			}
		</script>
		<div class="container" style="text-align:center;">
			<div class="row" style="margin: 45px auto 30px auto;">
				<div class="col-md-12">
					<span style="font-size:72px; color:#FFF;" class="comcamp-icon-ComcampFullLogo"></span>
					<h4 style="color: #EEE;">ระบบรับสมัคร ค่ายคอมแคมป์ครั้งที่ 27</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-body">

							<div id="fb-root"></div>
							<div class="fb-login">
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
										<img src="assets/images/register_step.png" style="width: 100%; margin:auto;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
											<br>
											<p>หากน้องๆต้องการสมัครเข้าค่ายผ่านระบบรับสมัครบนเว็บไซต์ สามารถใช้บัญชี Facebook เพื่อล็อกอินเข้าระบบรับสมัครได้ทันที</p>
										<hr>
										<div class="fb-login-button" scope="public_profile,email,publish_actions" onlogin="checkLoginState();" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true">เข้าสู่ระบบ</div>
									</div>
								</div>
								<br>
							</div>

							<div id="regis-form" style="display:none; text-align:left;">
								<div class="page-header" style="text-align:center;">
									<h4>ใบสมัคร โครงการอบรมเชิงปฏิบัติการคอมพิวเตอร์เบื้องต้น ครั้งที่ 27</h4>
								</div>
								<br>
								<form class="form-horizontal" id="form">
									<span class="page1" ng-show="page==1" ng-init="page=1">
										<div class="form-group">
											<label class="col-sm-4 control-label">ชื่อจริง (ไทย) <h6>ไม่ต้องใส่คำนำหน้าชื่อ</h6></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="fname_th" ng-model="fname_th">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">นามสกุล (ไทย)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="lname_th" ng-model="lname_th">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ชื่อเล่น (ไทย)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="nname_th" ng-model="nname_th">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ชื่อจริง (อังกฤษ)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="fname_en">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">นามสกุล (อังกฤษ)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="lname_en">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ชื่อเล่น (อังกฤษ)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="nname_en">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">วันเกิด</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="birthdate" ng-model="birthdate">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">อายุ</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="age">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">เพศ</label>
											<div class="col-sm-6">
												<select class="form-control" id="gender">
													<option value="1">ชาย</option>
													<option value="2">หญิง</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ศาสนา</label>
											<div class="col-sm-6">
												<select class="form-control" id="religion">
													<option value="1">พุทธ</option>
													<option value="2">คริสต์</option>
													<option value="3">อิสลาม</option>
													<option value="4">ฮินดู</option>
													<option value="5">ยิว (ยูดาห์)</option>
													<option value="6">นิกายเชน</option>
													<option value="7">ซิกซ์</option>
													<option value="8">ลัทธิจูเช</option>
													<option value="9">ไม่นับถือศาสนาใด</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ไซส์เสื้อ</label>
											<div class="col-sm-6">
												<select class="form-control" id="shirt_size">
													<option value="1">S</option>
													<option value="2">M</option>
													<option value="3">L</option>
													<option value="4">XL</option>
													<option value="5">XXL</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">โรคประจำตัว <h6>ถ้าไม่มีให้ใส่ -</h6></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="congenital_disease" ng-model="congenital_disease">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">อาหาร/สิ่งที่แพ้ <h6>ถ้าไม่มีให้ใส่ -</h6></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="food" ng-model="food">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ระดับการศึกษา</label>
											<div class="col-sm-6">
												<select class="form-control" id="class_step">
													<option value="4">มัธยมศึกษาปีที่ 4</option>
													<option value="5">มัธยมศึกษาปีที่ 5</option>
													<option value="6">มัธยมศึกษาปีที่ 6</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">แผนการเรียน</label>
											<div class="col-sm-6">
												<select class="form-control" id="class_type">
													<option value="1">วิทยาศาสตร์-คณิตศาสตร์</option>
													<option value="3">ส่งเสริมความเป็นเลิศด้านคณิตศาสตร์</option>
													<option value="4">ส่งเสริมความเป็นเลิศด้านวิทยาศาสตร์</option>
													<option value="5">วิทยาศาสตร์-คอมพิวเตอร์</option>
													<option value="6">วิทยาศาสตร์ประยุกต์</option>
													<option value="7">วิทยาศาสตร์บริหาร</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">เกรดเฉลี่ยสะสม</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="grade">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ที่อยู่</label>
											<div class="col-sm-6">
												<textarea rows="3" class="form-control" id="home_address"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">จังหวัด</label>
											<div class="col-sm-6">
												<select class="form-control" id="province" placeholder="-- กรุณาเลือกจังหวัด --">
													<option value="0"> กรุณาเลือก</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">อำเภอ/เขต</label>
											<div class="col-sm-6">
												<select class="form-control" id="amphur" placeholder="-- กรุณาเลือกอำเภอ --">
													<!-- <option value="0"> กรุณาเลือกจังหวัด </option> -->
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ตำบล/แขวง</label>
											<div class="col-sm-6">
												<select class="form-control" id="district" placeholder="-- กรุณาเลือกตำบล --">
													<!-- <option value="0"> กรุณาเลือกอำเภอ </option> -->
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">รหัสไปรษณีย์</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="postal" readonly="readonly">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">จังหวัดของโรงเรียน</label>
											<div class="col-sm-6">
												<select class="form-control" id="school_province">
													<option value="0">-- กรุณาเลือกจังหวัด --</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">โรงเรียน</label>
											<div class="col-sm-6">
												<select class="form-control" id="school" placeholder="-- กรุณาเลือกโรงเรียน --">
												</select>
												<a id="searchSchoolButton" href="#" data-toggle="modal" data-target="#searchSchoolModal" style="display: none;">
													ไม่พบโรงเรียน คลิกที่นี่..
												</a>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">โทรศัพท์มือถือ <h6>กรอกเฉพาะตัวเลข</h6></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="mobile_phone" ng-model="mobile_phone">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">E-mail address</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="email" ng-model="email">
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-6 col-sm-offset-4">
												<button class="btn btn-primary btn-lg gototop" ng-click="page=2">ไปหน้าถัดไป</button>
											</div>
										</div>
									</span>

									<span class="page2" ng-show="page==2">
										<div class="form-group">
											<label class="col-sm-4 control-label">ชื่อ-นามสกุล ผู้ปกครอง (ภาษาไทย)</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="parent_name" ng-model="parent_name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">เกี่ยวข้องเป็น</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="parent_relation">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ที่อยู่ผู้ปกครอง</label>
											<div class="col-sm-6">
												<textarea rows="2" type="text" class="form-control" id="parent_address"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">จังหวัด</label>
											<div class="col-sm-6">
												<select class="form-control" id="parent_province">
													<option value="0">-- กรุณาเลือก --</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">อำเภอ/เขต</label>
											<div class="col-sm-6">
												<select class="form-control" id="parent_amphur" placeholder="-- กรุณาเลือกอำเภอ --">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ตำบล/แขวง</label>
											<div class="col-sm-6">
												<select class="form-control" id="parent_district" placeholder="-- กรุณาเลือกตำบล/แขวง --">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">รหัสไปรษณีย์</label>
											<div class="col-sm-6">
												<input class="form-control" id="parent_postal" readonly="readonly" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">เบอร์โทรศัพท์ที่สามารถติดต่อได้ในกรณีฉุกเฉิน <h6>กรอกเฉพาะตัวเลข</h6></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="parent_phone" ng-model="parent_phone">
											</div>
										</div>
										<hr>
										<h5>คณะและมหาวิทยาลัยที่น้องสนใจเข้าศึกษาต่อ (ไม่มีผลต่อการพิจารณาเข้าร่วมโครงการ)</h5>
										<br>
										<div class="form-group">
											<label class="col-sm-4 control-label">มหาวิทยาลัยที่ต้องการศึกษาต่อ อันดับที่ 1</label>
											<div class="col-sm-6">
												<select class="form-control" id="interest_university_1">

												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">คณะ/ภาควิชาที่ต้องการศึกษาต่อ อันดับที่ 1</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="interest_faculty_1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">มหาวิทยาลัยที่ต้องการศึกษาต่อ อันดับที่ 2</label>
											<div class="col-sm-6">
												<select class="form-control" id="interest_university_2"></select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">คณะ/ภาควิชาที่ต้องการศึกษาต่อ อันดับที่ 2</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="interest_faculty_2">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">มหาวิทยาลัยที่ต้องการศึกษาต่อ อันดับที่ 3</label>
											<div class="col-sm-6">
												<select class="form-control" id="interest_university_3"></select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">คณะ/ภาควิชาที่ต้องการศึกษาต่อ อันดับที่ 3</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="interest_faculty_3">
											</div>
										</div>
										<hr>
										<div class="form-group">
											<label class="col-sm-4 control-label">น้องเคยผ่านการเข้าร่วมกิจกรรมค่ายของมหาวิทยาลัยหรือไม่</label>
											<div class="col-sm-6">
												<label class="radio-inline">
													<input type="radio" ng-model="camp" value="1"> เคย
												</label>
												<label class="radio-inline">
													<input type="radio" ng-model="camp" value="0"> ไม่เคย
												</label>
											</div>
										</div>
										<span ng-show="camp==1">
											<div class="form-group">
												<label class="col-sm-4 control-label">ค่าย</label>
												<div class="col-sm-4">
													<input class="form-control" id="camp_1" placeholder="ชื่อค่าย"/>
												</div>
												<label class="col-sm-1 control-label">โดย  </label>
												<div class="col-sm-3">
													<input class="form-control" id="camp_university_1" placeholder="มหาวิทยาลัย"/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">ค่าย <h6>เว้นได้</h6></label>
												<div class="col-sm-4">
													<input class="form-control" id="camp_2" placeholder="ชื่อค่าย"/>
												</div>
												<label class="col-sm-1 control-label">โดย  </label>
												<div class="col-sm-3">
													<input class="form-control" id="camp_university_2" placeholder="มหาวิทยาลัย"/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">ค่าย <h6>เว้นได้</h6></label>
												<div class="col-sm-4">
													<input class="form-control" id="camp_3" placeholder="ชื่อค่าย"/>
												</div>
												<label class="col-sm-1 control-label">โดย  </label>
												<div class="col-sm-3">
													<input class="form-control" id="camp_university_3" placeholder="มหาวิทยาลัย"/>
												</div>
											</div>
										</span>
										<hr>
										<div class="form-group">
											<label class="col-sm-4 control-label">น้องเคยมีผลงานด้านคอมพิวเตอร์หรือไม่</label>
											<div class="col-sm-6">
												<label class="radio-inline">
													<input type="radio" ng-model="reward" value="1"> เคย
												</label>
												<label class="radio-inline">
													<input type="radio" ng-model="reward" value="0"> ไม่เคย
												</label>
											</div>
										</div>
										<span ng-show="reward==1">
											<div class="form-group">
												<label class="col-sm-4 control-label">ผลงาน <h6>ไม่ต้องเว้นบรรทัด</h6></label>
												<div class="col-sm-6">
													<textarea rows="2" type="text" class="form-control" id="computer_reward"></textarea>
												</div>
											</div>
										</span>
										<hr>
										<div class="form-group">
											<label class="col-sm-4 control-label">ความสนใจเกี่ยวกับคอมพิวเตอร์</label>
											<div class="col-sm-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="programming">
														C Programming
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="website">
														Website Creating/Administrating
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="animation">
														Animation
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="graphic">
														Computer Graphic
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="hardware">
														Computer Hardware
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="circuit">
														Digital Circuit
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="network">
														Computer Network
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="interest" id="interest" value="robot">
														Robot
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">ทักษะเกี่ยวกับคอมพิวเตอร์</label>
											<div class="col-sm-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="programming">
														C Programming
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="website">
														Website Creating/Administrating
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="animation">
														Animation
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="graphic">
														Computer Graphic
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="hardware">
														Computer Hardware
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="circuit">
														Digital Circuit
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="network">
														Computer Network
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="skill" id="skill" value="robot">
														Robot
													</label>
												</div>
											</div>
										</div>
										<hr>
										<div class="form-group">
											<label class="col-sm-4 control-label">การเดินทาง (เลือกสถานที่ที่น้องๆต้องการให้พี่ไปรับ)</label>
											<div class="col-sm-6">
												<div class="radio">
													<label>
														<input type="radio" name="travel" id="travel" value="1">
														อนุเสาวรีย์ชัยสมรภูมิ
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="travel" id="travel" value="2">
														สถานีขนส่งหมอชิตใหม่ (หมอชิต 2)
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="travel" id="travel" value="3">
														สถานีรถไฟหัวลำโพง
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="travel" id="travel" value="4">
														สถานีขนส่งเอกมัย
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="travel" id="travel" value="5">
														เดินทางด้วยตนเอง
													</label>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<h6>* น้องจำเป็นต้องกรอกข้อมูลให้ครบทุกช่อง ยกเว้นช่องที่ระบุว่าเว้นไว้ได้</h6>
												<h6>กรุณากรอกข้อมูลทั้งหมดตามความเป็นจริง หากตรวจสอบแล้วพบว่าผู้สมัครกรอกข้อมูลไม่ครบหรือให้ข้อมูลที่เป็นเท็จ ทางภาควิชาขออนุญาตตัดสิทธิ์ในการเข้าร่วมโครงการทันที</h6>
											</div>
										</div>
										<br><br>
										<div class="row">
											<div class="col-sm-6 col-sm-offset-4">
												<button class="btn btn-primary btn-lg gototop" ng-click="page=1">ย้อนกลับหน้าแรก</button>
												<button class="btn btn-success btn-lg gototop" ng-click="page=3">ยืนยันข้อมูล</button>
											</div>
										</div>
									</span>

									<span class="page3" ng-show="page==3">

											<div style="text-align:center;">
												<p><b>กรุณาตรวจสอบข้อมูลอีกครั้งก่อนส่งแบบฟอร์ม</b></p>
											</div>
										<div class="row">
											<div class="col-sm-8 col-sm-offset-2">

												<table class="table">
													<tr>
														<td>ชื่อ-นามสกุล</td>
														<td>
															<span class="previewResult" data-input-name="fname_th"></span> <span class="previewResult" data-input-name="lname_th"></span><br />
															<span class="previewResult" data-input-name="fname_en"></span> <span class="previewResult" data-input-name="lname_en"></span>
														</td>
													</tr>
													<tr>
														<td>ชื่อเล่น</td>
														<td>
															<span class="previewResult" data-input-name="nname_th"></span><br /><span class="previewResult" data-input-name="nname_en"></span>
														</td>
													</tr>
													<tr>
														<td>วันเกิด</td>
														<td>
															<span class="previewResult" data-input-name="birthdate"></span>
														</td>
													</tr>
													<tr>
														<td>โรคประจำตัว</td>
														<td>
															<span class="previewResult" data-input-name="congenital_disease"></span>
														</td>
													</tr>
													<tr>
														<td>อาหารที่แพ้</td>
														<td><span class="previewResult" data-input-name="food"></span></td>
													</tr>
													<tr>
														<td>เบอร์โทรศัพท์</td>
														<td><span class="previewResult" data-input-name="mobile_phone"></span></td>
													</tr>
													<tr>
														<td>อีเมล</td>
														<td><span class="previewResult" data-input-name="email"></span></td>
													</tr>
													<tr>
														<td>ชื่อ-นามสกุล ผู้ปกครอง</td>
														<td><span class="previewResult" data-input-name="parent_name"></span></td>
													</tr>
													<tr>
														<td>เบอร์โทรศัพท์ผู้ปกครอง</td>
														<td><span class="previewResult" data-input-name="parent_phone"></span></td>
													</tr>
												</table>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-4"></div>
											<div class="col-sm-6">
												<b>ติ้กช่องด้านล่างเพื่อยืนยันตัวตนด้วยครับ</b><br>
												<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>" style="width:100%;"></div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-6 col-sm-offset-4">
												<button class="btn btn-primary btn-lg gototop" ng-click="page=1">ย้อนกลับหน้าแรก</button>
												<button class="btn btn-success btn-lg" id="send" ng-click="page=4">ส่งแบบฟอร์ม</button>
											</div>
										</div>
									</span>

									<span class="page4" ng-show="page==4">
										<div class="row">
											<div class="col-sm-8 col-sm-offset-2">
												<div id="ajax-result">

												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-block btn-lg btn-primary gototop" id="back" ng-click="page=1" style="display:none;">กลับไปแก้ไขฟอร์ม</button>
												<span class="getpdf" style="display:none;">
													<div class="row">
														<div class="col-md-12" style="text-align:left;">
																<h3>ต้องทำอะไรต่อ​?</h3>
																<p>1. ดาวน์โหลดและพิมพ์ใบสมัครที่ออกโดยระบบอัตโนมัติ โดยคลิกที่ปุ่มด้านล่าง</p>
																<p>2. กรอกข้อมูลเพิ่มเติมและตอบคำถามในใบสมัครให้เรียบร้อย</p>
																<p>3. ส่งใบสมัครๆของน้องๆได้ตามวิธีที่น้องๆสะดวก
																<ul>
																	<li>ทางไปรษณีย์</li>
																	<li>สแกนใบสมัคร จากนั้นอัพโหลดขี้นสู่ระบบอัพโหลด</li>
																	<li>สแกนใบสมัคร จากนั้นส่ง E-mail มายัง webmaster@comcamp.in.th</li>
																	<li>ส่งด้วยตนเองที่ภาควิชาวิศวกรรมคอมพิวเตอร์ อาคารวิศววัฒนะ (ตึกแดง) ชั้น 10 คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</li>
																</ul>
																</p>
																<hr>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<button class="btn btn-block btn-lg btn-success getpdf-button"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> พิมพ์ใบสมัคร</button>
															<a href="/upload.php" target="_blank" style="text-decoration: none !important;"><button class="btn btn-block btn-lg btn-info" id="upload" >ระบบอัพโหลดออนไลน์</button></a>
															<hr>
														</div>
													</div>
												</span>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="getpdf" style="display:none; text-align:center;">
													<br><p>น้องๆสามารถล็อกอินเข้ามายังระบบรับสมัครเพื่อพิมพ์ใบสมัครใหม่ได้เรื่อยๆนะครับ :)</p>
													<p><b>อย่าลืม!</b> ติดตามข่าวสารค่ายคอมแคมป์ ได้ที่เพจ <a href="https://www.facebook.com/KMUTTcomcamp" target="_blank">Comcamp KMUTT</a> นะครับน้องๆ</p>
												</div>
											</div>
										</div>
									</span>
								</form>
								<br>
							</div>

							<div id="registered" style="display:none;" ng-hide="upload==1">
								<div class="page-header">
									<h3>ลงทะเบียนเรียบร้อยแล้ว</h3>
								</div>
								<div class="row">
									<div class="col-md-8 col-md-offset-2" style="text-align:left;">
											<h3>ต้องทำอะไรต่อ​?</h3>
											<p>1. ดาวน์โหลดและพิมพ์ใบสมัครที่ออกโดยระบบอัตโนมัติ โดยคลิกที่ปุ่มด้านล่าง</p>
											<p>2. กรอกข้อมูลเพิ่มเติมและตอบคำถามในใบสมัครให้เรียบร้อย</p>
											<p>3. ส่งใบสมัครๆของน้องๆได้ตามวิธีที่น้องๆสะดวก
											<ul>
												<li>ทางไปรษณีย์</li>
												<li>สแกนใบสมัคร จากนั้นอัพโหลดขี้นสู่ระบบอัพโหลด</li>
												<li>สแกนใบสมัคร จากนั้นส่ง E-mail มายัง webmaster@comcamp.in.th</li>
												<li>ส่งด้วยตนเองที่ภาควิชาวิศวกรรมคอมพิวเตอร์ อาคารวิศววัฒนะ (ตึกแดง) ชั้น 10 คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</li>
											</ul>
											</p>
											<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
										<button class="btn btn-block btn-lg btn-success getpdf-button"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> พิมพ์ใบสมัคร</button>
										<a href="/upload.php" target="_blank" style="text-decoration: none !important;"><button class="btn btn-block btn-lg btn-info" id="upload" >ระบบอัพโหลดออนไลน์</button></a>
										<hr>
									</div>
								</div>
								<div class="row">
									<p><b>อย่าลืม!</b> ติดตามข่าวสารค่ายคอมแคมป์ ได้ที่เพจ <a href="https://www.facebook.com/KMUTTcomcamp" target="_blank">Comcamp KMUTT</a> นะครับน้องๆ</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" id="info-head" style="text-align:left; display:none;">
							ข้อมูลส่วนตัว
							<div class="fb-login-button" style="float:right;" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="1" data-size="small" data-show-faces="false" data-auto-logout-link="true"></div>
						</div>
						<div class="panel-body" id="info" style="text-align:left;">
							<h5>หรือหากน้องๆไม่สะดวกในการสมัครผ่านเว็บไซต์ น้องๆสามารถดาวน์โหลดใบสมัครในรูปแบบ pdf ได้เช่นกัน</h5>
							<hr>
							<a href="comcamp-regis.pdf" class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> ดาวน์โหลดใบสมัคร (pdf)</a>
						</div>

					</div> <!-- https://www.facebook.com/messages/145236308962439 -->
					<div class="panel panel-default">
						<div class="panel-heading" style="text-align:left;">
							ข่าวสาร
						</div>
						<div class="panel-body" style="text-align:left;">
							<p style="text-align:center;">
								<a class="fade-link" href="https://www.facebook.com/messages/145236308962439" target="_blank">
								<span style="font-size: 72px; margin-bottom: 15px;" class="glyphicon glyphicon-comment" aria-hidden="true"></span><br>
								 พบปัญหาหรือมีข้อสงสัยเพิ่มเติม ติดต่อพี่ๆได้ทาง Facebook Page เลยครับ </a></p>
							<p>
								<div id="searchSchoolModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="searchSchoolLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<form class="form-horizontal" id="school-search-form">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="searchSchoolLabel">เพิ่มรายชื่อโรงเรียน</h4>
												</div>
												<div class="modal-body">
													<div class="alert alert-success" role="alert" id="schoolSearchSuccess" style="display: none;">
														เย้! อัพเดตรายชื่อโรงเรียนให้แล้วครับ :)
													</div>
													<div class="alert alert-danger" role="alert" id="schoolSearchError" style="display: none;">
														ไม่นะ! พี่อัพเดตรายชื่อโรงเรียนไม่ได้ เนื่องจาก<span id="schoolSearchErrorReason"></span>
													</div>
														<div class="form-group">
															<label class="col-sm-4 control-label">จังหวัด</label>
															<div class="col-sm-6">
																<select class="form-control" id="school_search_province">
																	<option value="0"> กรุณาเลือก</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label">โรงเรียน</label>
															<div class="col-sm-6">
																<select class="form-control" id="school_search" placeholder="-- กรุณาเลือกโรงเรียน --">
																</select>
															</div>
														</div>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn btn-primary" value="ส่งค่า" />
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>

		<form action="/api/index.php/user/getpdf" method="post" target="pdfFrame" id="getPdfForm" style="display:none;">
			<input type="text" name="code" value="bar" />
			<input type="submit">
		</form>
		<iframe src="/" id="pdfFrame" name="pdfFrame" style="display:none;"></iframe>

		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-59202452-2', 'auto');
			ga('send', 'pageview');

		</script>
		<script>
			$(function() {
				$( "#birthdate" ).datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "1995:2015",
					dateFormat: "dd/mm/yy",
					/*dafaultDate: "01/01/1995",*/
					onSelect: function(dateText){
						var ageDifMs = serverDateTime.getTime() - ($( "#birthdate" ).datepicker('getDate')).getTime();
						var ageDate = new Date(ageDifMs); // miliseconds from epoch
						$("#age").val(Math.abs(ageDate.getUTCFullYear() - 1970));
					}
				});
			});
		</script>
	</body>
</html>
