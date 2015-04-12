<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="./assets/img/favicon.ico"/>
		<title>.:ComCamp #27:.</title>
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
		<meta name="msapplication-TileColor" content="#32004b">
		<meta name="msapplication-TileImage" content="http://27.comcamp.in.th/assets/img/icon/mstile-144x144.png">
		<meta name="msapplication-config" content="http://27.comcamp.in.th/assets/img/icon/browserconfig.xml">
		<meta property="og:title" content="Comcamp #27"/>
		<meta property="og:image" content="http://27.comcamp.in.th/assets/img/Comcamp_opengraph.png"/>
		<meta property="og:url" content="http://www.comcamp.in.th"/>
		<meta property="og:site_name" content="Comcamp #27 : ค่ายคอมแคมป์ครั้งที่ 27"/>
		<meta property="og:description"content="สุดยอดค่ายที่จะทำให้น้องๆ ได้รู้ว่าวิศวกรรมคอมพิวเตอร์นั้นเป็นอย่างไร โดยพี่ๆ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
		<style type="text/css">
			.archive-logo{
				/*filter: url("data:image/svg+xml;utf8,<svg height='0' xmlns='http://www.w3.org/2000/svg'><filter id='invent'><feColorMatrix type='matrix' values='-1 0 0 0 1 0 -1 0 0 1 0 0 -1 0 1 0 0 0 1 0'/></filter></svg>");
				-webkit-filter: invert(100%);
				filter: invert(100%);*/
			}
		</style>
		<script>
			var end = new Date('04/12/2015 00:00 AM');
			var _second = 1000;
			var _minute = _second * 60;
			var _hour = _minute * 60;
			var _day = _hour * 24;
			var timer;

			function showRemaining() {
					var now = new Date();
					var distance = end - now;
					if (distance < 0) {

							clearInterval(timer);
							// document.getElementById('countdown').innerHTML = 'EXPIRED!';

							return;
					}
					var days = Math.floor(distance / _day);
					var hours = Math.floor((distance % _day) / _hour);
					var minutes = Math.floor((distance % _hour) / _minute);
					var seconds = Math.floor((distance % _minute) / _second);

					document.getElementById('day').innerHTML = days +'<br><div class="sub">days</div>';
					document.getElementById('hr').innerHTML = hours + '<br><div class="sub">hours</div>';
					document.getElementById('mins').innerHTML = minutes + '<br><div class="sub">mins</div>';
					document.getElementById('sec').innerHTML = seconds + '<br><div class="sub">secs</div>';
			}

			timer = setInterval(showRemaining, 1000);
		</script>
	</head>

	<body>
		<div class="count">
			<div class="message"><strong>Comcamp #27</strong> is making up ;)</div>
			<div class="submessage">Be here soon!</div>
			<div id="day"></div>
			<div id="hr"></div>
			<div id="mins"></div>
			<div id="sec"></div>
			<center>
				<a class="oldCamp" href="//26.comcamp.in.th/"><img src="./assets/img/1422042771_globe-01.svg"width="32" height="32" class="active-web-logo"> Comcamp #26</a>
				<a class="oldCamp" href="//25.comcamp.in.th/"><img src="./assets/img/1422042771_globe-01.svg"width="32" height="32" class="active-web-logo"> Comcamp #25</a>
				<a class="oldCamp" href="//24.comcamp.in.th"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #24</a>
				<a class="oldCamp" href="//23.comcamp.in.th"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #23</a>
				<a class="oldCamp" href="//22.comcamp.in.th"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #22</a>
				<a class="oldCamp" href="//21.comcamp.in.th"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #21</a>
				<a class="oldCamp" href="http://comcamp.cpe21.com/"><img src="./assets/img/1422042771_globe-01.svg"width="32" height="32" class="active-web-logo"> Comcamp #20</a>
				<a class="oldCamp" href="https://web.archive.org/web/20080216215755/http://comcamp.cpe20.com/comhtml"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #19</a>
				<a class="oldCamp" href="https://web.archive.org/web/20060613073756/http://202.44.9.126/~comcamp18/"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #18</a>
				<a class="oldCamp" href="https://web.archive.org/web/20020603135706/http://www.comcamp.net/comcamp14/index.html"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #14</a>
				<a class="oldCamp" href="https://web.archive.org/web/20020607125354/http://tum.comcamp.net/comcamp13/"><img src="./assets/img/Internet_Archive_logo_and_wordmark.svg"width="32" height="32" class="archive-logo"> Comcamp #13</a>
			</center>
			</div>
		</div>
	</body>
</html>