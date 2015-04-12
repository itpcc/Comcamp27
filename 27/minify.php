<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1); /* Force PHP show all error */
	$cachePath = sys_get_temp_dir().'/minify-'.filemtime(__FILE__).'.php.cache';  /* set temporary file name depended file modification date of this file */
	if(
		!is_file($cachePath) OR /* Cache file isn't exist */
		(filemtime($cachePath) < (time() - (6*60*60))) /* Cache file exist but it was older than 6 hours */
		OR (isset($_GET['nocache']) && $_GET['nocache'] == 'najaeiei') /* Force to re-generate file by whatever reason */
	){
		$result_html = '';
		include_once __DIR__.'/min/html-minify.php';  /* Added for bandwidth performance */
		ob_start('html_minify_buffer'); /* Let Output Buffer do an minify */
	}else{	/* If cache file is ready to used. */
		readfile($cachePath);	/* Output cached data */
		exit;	/* Stop unnecessery jobs. \('-')/ */
	}
?><!DOCTYPE html>
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
		<!-- for bandwidth performance to meet with Google's criteria. I've use Google minify for group CSS library to one file instead (Comment won't shown in production site) -->
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/fonts/thsarabunnew.css" />
		<link rel="stylesheet" href="assets/css/comcamp-font.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/ripples.min.css" />
		<link rel="stylesheet" href="assets/css/material-wfont.min.css" />
		<link rel="stylesheet" href="assets/css/animate.css"> -->
		<link rel="stylesheet" type="text/css" href="/min/?g=csslib" />
		<link rel="stylesheet" href="assets/css/main.css?version=<?php echo is_file(__DIR__.'/assets/css/main.css')?filemtime(__DIR__.'/assets/css/main.css'):(time()/21600); ?>"/>
		<script type="text/javascript" src="assets/js/pace.min.js"></script>
	</head>
	<body>
	<div id="header" style="text-align:center;">
		<div class="layer-star" data-stellar-ratio="1.8"></div>
		<div class="layer-1"></div>
		<div class="layer-2"></div>
		<div class="vertical-align" style="z-index:100;">
			<img src="assets/img/comcamp_logo.png" alt="ComCamp#27">
		</div>
	</div>

		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" style="background-color:rgba(0, 0, 0, 0.3);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<span style="color: white;" class="comcamp-icon-ComcampFullLogo"></span>
						<span style="color: white;" class="comcamp-icon-ComcampMiniLogo"></span>
					</a>
				</div>

				<div class="collapse navbar-collapse" id="navbar">
					<ul class="nav navbar-nav">
						<li><a href="#description">รายละเอียด</a></li>
						<li><a href="#subject">วิชาเรียน</a></li>
						<li><a href="#timeline">กำหนดการ</a></li>
						<li><a href="#faq">ถาม-ตอบ</a></li>
						<li><a href="#contact">ติดต่อสอบถาม</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div data-spy="scroll" data-target="#navbar">
			<section id="description">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h1 style="text-align:center;">Comcamp 27<sup>th</sup></h1>
								<h3 style="text-align:center; line-height:180%;">โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์เบื้องต้น ครั้งที่ 27</h3>
								<hr>
								<p>
									น้องๆอยากทราบไหมว่า พวกพี่ๆวิศวคอมพิวเตอร์เนี่ย วันๆเขาทำอะไรกันบ้าง? เรียนอะไร? ยากง่ายแค่ไหน?
								</p>
								<p>
									ถ้าน้องๆเป็นคนหนึ่งที่มีคำถามแบบนี้อยู่ในใจ ขอแนะนำให้น้องๆเข้ามาสัมผัสประสบการณ์การเรียนวิศวกรรมคอมพิวเตอร์ของจริง ลงมือปฏิบัติจริง ได้ในค่ายคอมแคมป์ ครั้งที่ 27 ที่จะช่วยให้น้องๆได้ไขข้อสงสัย และเข้าใจในภาควิชาวิศวกรรมคอมพิวเตอร์มากขึ้น
								</p>
								<p>
									นอกจากนี้ ค่ายคอมแคมป์ยังมีกิจกรรมสนุกๆอีกมากมาย ที่จะสร้างประสบการณ์ดีๆ พร้อมมิตรภาพจากเพื่อนๆและพี่ๆ ที่สำคัญ
									<span class="pink huge"><b>ฟรีตลอดค่าย!</b></span> อีกด้วย ขอเพียงน้องๆเป็น<b>นักเรียนระดับชั้นมัธยมปลาย สายวิทย์</b> เท่านั้น น้องๆก็สามารถสมัครเข้าร่วมค่ายคอมแคมป์ได้แล้ว! สุดยอดไปเลย >0&lt; รีบสมัครกันมาเยอะๆเลยน้า~
								</p>
							</div>
					</div>
					<div class="row">
						<br>
						<div class="col-md-12" style="text-align:center;">
							<a href="http://register.comcamp.in.th" class="btn btn-lg btn-primary" id="regis-button" >สมัครเข้าค่ายคอมแคมป์</a>
						</div>
					</div>
				</div>
			</section>
			<section id="sponsor">
				<div class="container white">
					<div class="row">
						<div class="col-md-12" style="text-align:center;">
							<h1>ผู้สนับสนุนโครงการ</h1>
							<hr>
							<div class="row sponsor-row"><!-- CPE & KMUTT logo -->
								<a href="http://cpe.kmutt.ac.th" target="_blank" class="icon-cpe comcamp-icon-cpe" style="margin: 0 -30px 30px 0;">
								</a>
								<a href="http://www.kmutt.ac.th" target="_blank" class="icon-kmutt comcamp-icon-KMUTTFormal">
								</a>
							</div><!-- /CPE & KMUTT logo -->
							<div class="row sponsor-row"><!-- Main supporter -->
								<a href="http://www.camphub.in.th/" target="_blank" class="icon-camphub">Camphub.in.th</a>
								<a href="http://www.leadinnovation.co.th/" target="_blank" class="icon-lead-innovation">บริษัท ลีด อินโนเวชั่น จำกัด</a>
							</div><!-- Main supporter -->

						</div>
					</div>
				</div>
			</section>
			<section id="subject">
				<div id="image-1">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1>มีอะไรใน Comcamp 27<sup>th</sup></h1>
								<hr>
							</div>
						</div>
						<br>
						<div class="row hidden-xs hidden-sm">
							<div class="col-md-3 subject-badge">
								<img src="assets/img/img-lg/SUB_C.png" srcset="assets/img/img-xs/SUB_C.png 384w, assets/img/img-sm/SUB_C.png 768w, assets/img/img-md/SUB_C.png 992w, assets/img/original/SUB_C.png 1200w" style="width: 85%;" alt="C Programming">
								<h3>C Programming</h3>
								<p>แปลงความคิดให้กลายเป็นโค้ด เพื่อสร้างสรรค์โปรแกรมของน้องๆเอง</p>
							</div>
							<div class="col-md-3 subject-badge">
								<img src="assets/img/img-lg/SUB_Robot.png" srcset="assets/img/img-xs/SUB_Robot.png 384w, assets/img/img-sm/SUB_Robot.png 768w, assets/img/img-md/SUB_Robot.png 992w, assets/img/original/SUB_Robot.png 1200w" style="width: 85%;" alt="Robot">
								<h3>Robot</h3>
								<p>นำความซับซ้อนทางกลไก ผสมผสานกับการเขียนโปรแกรม เพื่อสร้างความเป็นไปได้ที่ไม่สิ้นสุด</p>
							</div>
							<div class="col-md-3 subject-badge">
								<img src="assets/img/img-lg/SUB_WEB.png" srcset="assets/img/img-xs/SUB_WEB.png 384w, assets/img/img-sm/SUB_WEB.png 768w, assets/img/img-md/SUB_WEB.png 992w, assets/img/original/SUB_WEB.png 1200w" style="width: 85%;" alt="Web Development">
								<h3>Web Development</h3>
								<p>เรียนรู้เทรนด์ใหม่ๆ ในการทำเว็บไซต์ ตั้งแต่นับหนึ่งจนถึงขั้นตอนของการหารายได้</p>
							</div>
							<div class="col-md-3 subject-badge">
								<img src="assets/img/img-lg/SUB_LINUX.png" srcset="assets/img/img-xs/SUB_LINUX.png 384w, assets/img/img-sm/SUB_LINUX.png 768w, assets/img/img-md/SUB_LINUX.png 992w, assets/img/original/SUB_LINUX.png 1200w" style="width: 85%;" alt="Linux">
								<h3>Basic Linux</h3>
								<p>ทำความรู้จักกับลินุกซ์ ระบบปฏิบัติการที่ไร้ขีดจำกัด</p>
							</div>
						</div>
						<div class="row visible-xs-block visible-sm-block">
							<div class="row">
								<div class="col-xs-5 subject-badge-xs">
									<img src="assets/img/img-lg/SUB_C.png" srcset="assets/img/img-xs/SUB_C.png 384w, assets/img/img-sm/SUB_C.png 768w, assets/img/img-md/SUB_C.png 992w, assets/img/original/SUB_C.png 1200w" alt="C Programming">
								</div>
								<div class="col-xs-7">
									<h4>C Programming</h4>
									<p>แปลงความคิดให้กลายเป็นโค้ด เพื่อสร้างสรรค์โปรแกรมของน้องๆเอง</p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-5 subject-badge-xs">
									<img src="assets/img/img-lg/SUB_Robot.png" srcset="assets/img/img-xs/SUB_Robot.png 384w, assets/img/img-sm/SUB_Robot.png 768w, assets/img/img-md/SUB_Robot.png 992w, assets/img/original/SUB_Robot.png 1200w" alt="Robot">
								</div>
								<div class="col-xs-7">
									<h4>Robot</h4>
									<p>นำความซับซ้อนทางกลไก ผสมผสานกับการเขียนโปรแกรม เพื่อสร้างความเป็นไปได้ที่ไม่สิ้นสุด</p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-5 subject-badge-xs">
									<img src="assets/img/img-lg/SUB_WEB.png" srcset="assets/img/img-xs/SUB_WEB.png 384w, assets/img/img-sm/SUB_WEB.png 768w, assets/img/img-md/SUB_WEB.png 992w, assets/img/original/SUB_WEB.png 1200w" alt="Web Development">
								</div>
								<div class="col-xs-7">
									<h4>Web Development</h4>
									<p>เรียนรู้เทรนด์ใหม่ๆ ในการทำเว็บไซต์ ตั้งแต่นับหนึ่งจนถึงขั้นตอนของการหารายได้</p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-5 subject-badge-xs">
									<img src="assets/img/img-lg/SUB_LINUX.png" srcset="assets/img/img-xs/SUB_LINUX.png 384w, assets/img/img-sm/SUB_LINUX.png 768w, assets/img/img-md/SUB_LINUX.png 992w, assets/img/original/SUB_LINUX.png 1200w" alt="Linux">
								</div>
								<div class="col-xs-7">
									<h4>Basic Linux</h4>
									<p>ทำความรู้จักกับลินุกซ์ ระบบปฏิบัติการที่ไร้ขีดจำกัด</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<br><br>
								<h4>
									นอกจากนี้ ค่ายคอมแคมป์ยังมีกิจกรรมสันทนาการให้น้องๆ สนุกสนานตลอดค่ายอีกด้วย!
								</h4>
							</div>
						</div>
						<div class="row">
							<br>
							<div class="col-md-12" style="text-align:center;">
								<a href="http://register.comcamp.in.th" class="btn btn-lg btn-primary" id="regis-button-bottom" >สมัครเข้าค่ายคอมแคมป์</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="timeline">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2" style="text-align:center;">
							<h1><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> กำหนดการ</h1>
							<br>
							<table class="table">
								<tr><th>วันที่</th><th>กิจกรรม</th></tr>
								<tr>
									<td>09/02/2015</td><td>เปิดรับสมัครเข้าร่วมโครงการ</td>
								</tr>
								<tr>
									<td>06/03/2015</td><td>วันสุดท้ายในการสมัครเข้าร่วมโครงการ</td>
								</tr>
								<tr>
									<td>16/03/2015</td>
									<td>ประกาศรายชื่อผู้มีสิทธิ์เข้าร่วมโครงการ</td>
								</tr>
								<tr>
									<td>12/04/2015 - 16/04/2015</td><td>ระยะเวลาดำเนินค่าย <span class="pink"><b>Comcamp 27<sup>th</sup></b></span></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</section>
			<section id="faq">
				<div class="container white">
					<div class="row">
						<div class="col-md-12">
							<h1><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> ถาม-ตอบ</h1><hr>
							<p class="question">Q: พี่คะ หนูไม่เป็น/ไม่ชำนาญด้านทักษะคอมพิวเตอร์เลย จะสมัครได้มั้ยคะ?</p>
							<p>A: ได้ค่ะ เพราะค่ายคอมแคมป์เป็นโครงการที่มีวัตถุประสงค์เพื่อแนะนำการเรียนการสอนและการปฏิบัติเชิงคอมพิวเตอร์อยู่แล้ว ขอแค่น้องมีความสนใจด้านคอมพิวเตอร์และมีคุณสมบัติตามที่ระบุไว้ในใบสมัครก็สามารถสมัครเข้าร่วมโครงการได้ค่ะ</p>
							<hr>
							<p class="question">Q: ต้องพักค้างคืนที่ค่ายหรือเปล่าคะ?</p>
							<p>A: ใช่ค่ะ เพื่อให้น้องๆสะดวกต่อการเข้าร่วมกิจกรรม พี่ๆจึงจัดให้น้องๆได้เข้าพักในหอพักนักศึกษาซึ่งสะดวกสบายและง่ายต่อการทำกิจกรรมของน้องๆ และที่สำคัญ พี่ๆจะดูแลน้องได้ตลอด 24 ชั่วโมงตลอดโครงการ น้องๆสบายใจได้ค่ะ :)</p>
							<hr>
							<p class="question">
								Q: ผมอยู่ต่างจังหวัด ต้องเดินทางมาเอง มีคำแนะนำมั้ยครับ?
							</p>
							<p>A:
								หากน้องเดินทางเข้าร่วมโครงการฯ จากต่างจังหวัด สามารถระบุจุดนัดพบตามที่ระบุไว้ในใบสมัครฯไว้ ในวันที่น้องเดินทางมาเข้าร่วมโครงการ(วันที่ 12 เมษายน 2558) จะมีพี่ๆ ของโครงการฯ ไปดูแลและอำนวยความสะดวกในการเดินทาง <a href="how-to" target="_blank">รายละเอียดเพิ่มเติม..</a>
							</p>
							</div>
					</div>
					<div class="row">
						<br>
						<div class="col-md-12" style="text-align:center;">
							<a href="http://register.comcamp.in.th" class="btn btn-lg btn-primary" id="regis-button-another-one" >สมัครเข้าค่ายคอมแคมป์</a>
						</div>
					</div>
				</div>
			</section>
			<section id="contact">
				<div class="container black">
					<div class="row">
						<div class="col-md-12">
							<h1>ติดต่อสอบถาม</h1>
							<br>
							</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h3><a href="https://goo.gl/maps/AYuy1" style="text-decoration: none; color: inherit;"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> ภาควิชาวิศวกรรมคอมพิวเตอร์</a></h3>
							<h4>คณะวิศวกรรมศาสตร์<br>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</h4>
							<address>ชั้น10 อาคารวิศววัฒนะ 126 ถ.ประชาอุทิศ<br>แขวงบางมด เขตทุ่งครุ กรุงเทพฯ 10140</address>
							<br>
						</div>
						<div class="col-md-4">
							<h3><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> โทรศัพท์</h3>
							<h4>พี่มิ้นท์ <span class="contact-sprite phone-mint">พี่มิ้นท์</span> </h4>
							<h4>พี่อัยย์ <span class="contact-sprite phone-ai">พี่อัยย์</span> </h4>
							<h4>พี่นัท <span class="contact-sprite phone-nut">พี่นัท</span> </h4>
							<h4>พี่ตั้ม <span class="contact-sprite phone-tum">พี่ตั้ม</span> </h4>
							<h4>พี่มุก (สปอนเซอร์) <span class="contact-sprite phone-mook">พี่มุก</span> </h4>
							<h3><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> อีเมล</h3>
							<h4><span class="contact-sprite mail-web">เว็บมาสเตอร์</span> </h4>
							<br>
						</div>
						<div class="col-md-3">
							<iframe width="200" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FKMUTTComCamp&amp;width&amp;height=290&amp;colorscheme=dark&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=1733339923558373" style="border:none; overflow:hidden; height:290px; width: 100%;"></iframe> <!-- allowTransparency="true" scrolling="no" frameborder="0" was removed because of W3C vadilator's errors  -->
						</div>
					</div>
				</div>
				<div class="container very-black">
					© 2015 Comcamp 27<sup>th</sup> All Rights Reserved. Web designed and developed by <a href="http://itpcc.net/" target="_blank">ITPCC</a> and <a href="http://www.winwanwon.in.th" target="_blank">@winwanwon</a>. <a href="http://validator.w3.org/check?uri=http%3A%2F%2F27.comcamp.in.th%2F;ss=1;outline=1;group=1" target="_blank"><img src="/assets/img/w3c-validation.png" alt="HTML5 Validation by W3C" width="45" height="16" style="vertical-align: middle;" /></a><br />
					This page was generated on <time style="white-space: nowrap"><?php echo date('Y-m-d H:i:s'); ?></time>
				</div>
			</section>
		</div>
		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-59202452-1', 'auto');
			ga('send', 'pageview');

		</script>
		<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/ripples.min.js"></script>
		<script src="assets/js/material.min.js"></script>
		<script src="assets/js/jquery.stellar.js"></script>
		<script src="assets/js/jquery.smooth-scroll.min.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>
