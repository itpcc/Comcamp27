<?php
	session_start();
	if(empty($_SESSION['state'])){
		$_SESSION['state'] = md5(uniqid(rand(), true));
		$_SESSION['nonce'] = md5(uniqid(rand(), TRUE)); // New code to generate auth_nonce
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>
<body>
<script>

	function testCall(fbToken){
		$.post(/*"/pilot/mute/example/connect-with-js.php"*/"/api/index.php/user/token", {
			'code': fbToken,
			'state':"<?php echo $_SESSION['state']; ?>"
		}, function(data){
			console.log(data);
			$("#ajax-result").html("<dl></dl>");
			$.each(data, function(i, val){
				$("#ajax-result dl").append('<dt style="font-weight: bolder;">'+i+"</dt><dd>"+val+"</dd>");
			});
			$("input[name=code]").val(data.token);
			/*setTimeout(20, function(){
				$("#getPdfForm").submit();
				alert($("input[name=code]").val());
			});*/

		}, 'json');
	}
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
			testCall(response.authResponse.accessToken);
			$.get("/api/index.php/user/", function(data){
				console.log("IP => ", data);
			});
			testAPI();
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
		window.location = "http://www.comcamp.in.th/pilot/facebook-login.php";
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
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=478731965498089&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function(response) {
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML =
				'<h2>Client result : </h2>'+
				response.id+' ' + response.name;
		});
	}
</script>
<!--
	Below we include the Login Button social plugin. This button uses
	the JavaScript SDK to present a graphical Login button that triggers
	the FB.login() function when clicked.
-->
<div id="fb-root"></div>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
<span id="ajax-result">Loading...</span>
<form action="http://register.comcamp.in.th/api/index.php/user/getpdf" method="post" target="pdfFrame" id="getPdfForm">
   <input type="text" name="code" value="bar" />
   <input type="submit">
</form>
<iframe src="http://register.comcamp.in.th/" id="pdfFrame" name="pdfFrame" style="width: 100%; min-height: 300px;"></iframe>
</body>
</html>