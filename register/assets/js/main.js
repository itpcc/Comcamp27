
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
		$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
			'code': response.authResponse.accessToken,
			'state':"<?php echo $_SESSION['state']; ?>"
		}, function(data){
			console.log(data);
			$("#regis-form").show();
			$("#info-head").show();
			$(".fb-login").hide();
		});

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
		window.location = "http://register.comcamp.in.th";
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
		console.log('Successful login for: ' + response.name);
		document.getElementById('info').innerHTML =
		'<p><img src="http://graph.facebook.com/' + response.id + '/picture?type=square">'+
		' ' + response.name + '</p>' +
		'<hr>สถานะ: <span class="label label-default">ยังไม่ได้ลงทะเบียน</span>';
		fb_id = response.id;
	});
}

function userAdd(fbToken){

	var interest_array = [];
	$("input[name='interest']:checked").each(function ()
	{
		interest_array.push(parseInt($(this).val()));
	});

	var skill_array = [];
	$("input[name='skill']:checked").each(function ()
	{
		skill_array.push(parseInt($(this).val()));
	});

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
		"camp" : [
			{
				"camp_name" : $("#camp_1").val(),
				"camp_by"   : $("#camp_university_1").val()
			},{
				"camp_name" : $("#camp_2").val(),
				"camp_by"   : $("#camp_university_2").val()
			},{
				"camp_name" : $("#camp_3").val(),
				"camp_by"   : $("#camp_university_3").val()
			}
		],
		"practice" : {
			"interest" : interest_array,
			"skill" : skill_array
		}
	}


		var userdata = {
			"fb_id"         : fb_id,
			"fname_th"      : "ราชศักดิ์",
			"lname_th"      : "รักษ์กำเนิด",
			"nname_th"      : "บิ๊ก",
			"fname_en"      : "rachasak",
			"lname_en"      : "Ragkamnerd",
			"nname_en"      : "Big",
			"birthdate"     : "08/11/1995" ,
			"age"           : 18,
			"gender"        : 1, //ชาย 2 หญิง
			"religion"      : 1,
			"shirt_size"    : 2,
			"congenital_disease"    : "G6PD",
			"food"          : "อาหารทะเล",
			"class_step"    : 4,
			"class_type"    : 1,
			"grade"         : 3.57,
			"school"        : 1080210781,
			"school_province": 63,
			"home_address"  : "92/1 หมู่ 7 ถนนอะไรไม่รู้ ซอยอิอิกำ",
			"home_village"  : 800909,
			"home_postal"   : 80110,
			"mobile_phone"  : "0863219383",
			"email"         : "id513128@gmail.com",
			"parent_name"   : "นายผู้ปกครอง ขอบิ๊ก",
			"parent_relation"   : "พี่ชาย",
			"parent_address"    : "92/1 หมู่ 7 ถนนอะไรไม่รู้ ซอยอิอิกำ",
			"parent_village"    : 800909,
			"parent_postal"     : 80110,
			"parent_phone"      : "0867394827",
			"computer_reward"   : "การแข่งขันการสร้าง Webpage ประเภท CMS ระดับชั้น ม.1-6 งาน ศิลปหัตถกรรมนักเรียนภาคใต้ ครั้งที่ 61 จังหวัดชุมพร",
			"travel"            : 5,
			"interest_universities" : [
				{
					"university"    : "เทคโนโลยีพระจอมเกล้าธนบุรี",
					"faculty"       : "ภาควิชาวิศวกรรมคอมพิวเตอร์"
				},{
					"university"    : "เทคโนโลยีพระจอมเกล้าธนบุรี",
					"faculty"       : "ภาควิชาวิศวกรรมคอมพิวเตอร์"
				},{
					"university"    : "เทคโนโลยีพระจอมเกล้าธนบุรี",
					"faculty"       : "ภาควิชาวิศวกรรมคอมพิวเตอร์"
				}
			],
			//optional
			"camp" : [
				{
					"camp_name" : "Comcamp#26",
					"camp_by"   : "ภาควิชาวิศวกรรมคอมพิวเตอร์ เทคโนโลยีพระจอมเกล้าธนบุรี"
				}
			],
			"practice" : {
				"interest" : [
					"programming",
					"website"
				],
				"skill" : [
					"hardware",
					"robot",
					"website"
				]
			}
		};

	$("#back").hide();
	console.log(userdata);
	console.log("Token: " + fbToken);
	$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
		'code': fbToken,
		'state': "<?php echo $_SESSION['state']; ?>"
	}, function(data){
		console.log(data);
		$.post("/api/index.php/user/add", {
			"token": data.token,
			"userdata": JSON.stringify(userdata)
		}, function(result){
			$("#ajax-result").append('<dt style="font-weight: bolder;">ผล</dt><dd>'+result+"</dd>");
			var data = JSON.parse(result);
			if(data.status=="fail"){
					$("#back").show();
			}
		}
	);
	}, 'json');
}

$(document).ready(function() {
	$.ajaxSetup({
		cache:false
	});

	$.post( "/api/index.php/get/address/province", function( data ) {
		var items = [];
		$.each( data.result, function( key, val ) {
			$("#province").append( "<option value='" + key + "'>" + val + "</option>" );
			$("#parent_province").append( "<option value='" + key + "'>" + val + "</option>" );
		});
	}, "json");

	$("#province").change( function(){
		province_id = $("#province").val();
		amphur_api = "/api/index.php/get/address/amphur/" + province_id;
		$("#amphur").empty();
		$.getJSON(amphur_api,function(data){
			var items = [];
			$.each( data.result, function( key, val ) {
				$("#amphur").append( "<option value='" + key + "'>" + val + "</option>" );
			});
			amphur_id = $("#amphur").val();
			district_api = "/api/index.php/get/address/district/" + amphur_id;
			$("#district").empty();
			$.getJSON(district_api,function(data){
				var items = [];
				$.each( data.result, function( key, val ) {
					$("#district").append( "<option value='" + key + "'>" + val + "</option>" );
				});
			});
			district_id = $("#district").val();
			postal_api = "/api/index.php/get/district/" +  district_id;
			$.getJSON(postal_api,function(data){
				$("#postal").val(data.result.zipcode);
			});
		});
	});

	$("#amphur").change( function(){
		amphur_id = $("#amphur").val();
		district_api = "/api/index.php/get/address/district/" + amphur_id;
		$("#district").empty();
		$.getJSON(district_api,function(data){
			var items = [];
			$.each( data.result, function( key, val ) {
				$("#district").append( "<option value='" + key + "'>" + val + "</option>" );
			});
		});
	});

	$("#district").change( function(){
		district_id = $("#district").val();
		postal_api = "/api/index.php/get/district/" +  district_id;
		$("#postal").empty();
		$.getJSON(postal_api,function(data){
			$("#postal").val(data.result.zipcode);
		});
	});

	$("#province").change( function(){
		province_id = $("#province").val();
		school_api = "/api/index.php/get/education/school/" + province_id;
		$("#school").empty();
		$.getJSON(school_api,function(data){
			var items = [];
			$.each( data.result, function( key, val ) {
				$("#school").append( "<option value='" + key + "'>" + val + "</option>" );
			});
		});
	});

	$("#parent_province").change( function(){
		province_id = $("#parent_province").val();
		amphur_api = "/api/index.php/get/address/amphur/" + province_id;
		$("#parent_amphur").empty();
		$.getJSON(amphur_api,function(data){
			var items = [];
			$.each( data.result, function( key, val ) {
				$("#parent_amphur").append( "<option value='" + key + "'>" + val + "</option>" );
			});
			amphur_id = $("#parent_amphur").val();
			district_api = "/api/index.php/get/address/district/" + amphur_id;
			$("#parent_district").empty();
			$.getJSON(district_api,function(data){
				var items = [];
				$.each( data.result, function( key, val ) {
					$("#parent_district").append( "<option value='" + key + "'>" + val + "</option>" );
				});
			});
			district_id = $("#parent_district").val();
			postal_api = "/api/index.php/get/district/" +  district_id;
			$.getJSON(postal_api,function(data){
				$("#parent_postal").val(data.result.zipcode);
			});
		});
	});

	$("#parent_amphur").change( function(){
		amphur_id = $("#parent_amphur").val();
		district_api = "/api/index.php/get/address/district/" + amphur_id;
		$("#parent_district").empty();
		$.getJSON(district_api,function(data){
			var items = [];
			$.each( data.result, function( key, val ) {
				$("#parent_district").append( "<option value='" + key + "'>" + val + "</option>" );
			});
		});
	});

	$("#parent_district").change( function(){
		district_id = $("#parent_district").val();
		postal_api = "/api/index.php/get/district/" +  district_id;
		$("#parent_postal").empty();
		$.getJSON(postal_api,function(data){
			$("#parent_postal").val(data.result.zipcode);
		});
	});

	$.getJSON("/api/index.php/get/education/university/1",function(data){
		var items = [];
		$.each( data.result, function( key, val ) {
			$("#interest_university_1").append( "<option value='" + key + "'>" + val + "</option>" );
			$("#interest_university_2").append( "<option value='" + key + "'>" + val + "</option>" );
			$("#interest_university_3").append( "<option value='" + key + "'>" + val + "</option>" );
		});
	});

	$("#send").click( function(){
		userAdd(fbToken);
		/*
		$.post("/api/index.php/user/add",
		,function(data){

	}, "json");

	*/
});
});
