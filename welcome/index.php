<!DOCTYPE html>
<html ng-app>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta property="og:site_name" content="Comcamp #27 : ค่ายคอมแคมป์ครั้งที่ 27"/>
	<meta property="og:description" content="สุดยอดค่ายที่จะทำให้น้องๆ ได้รู้ว่าวิศวกรรมคอมพิวเตอร์นั้นเป็นอย่างไร โดยพี่ๆ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี"/>
	<title>Comcamp #27: Registration</title>
	<link rel="shortcut icon" href="assets/img/icon/favicon.ico">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/js/bootstrap.min.js" rel="stylesheet" />
	<link rel="stylesheet" href="assets/fonts/thsarabunnew.css" />
	<link rel="stylesheet" href="assets/css/comcamp-font.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<style type="text/css">
	body {
		overflow: hidden;
	}

	.logo {
		-webkit-transition: 0.2s all ease-in-out !important;
		transition: 0.2s all ease-in-out !important;
	}
	.row {
		-webkit-transition: 1s all ease-in-out !important;
		transition: 1s all ease-in-out !important;
	}
	.block {
		background: rgba(0,0,0,0.7) !important;
		border-bottom: 13px solid #602162;
		-webkit-transition: 1s all ease-in-out !important;
		transition: 1s all ease-in-out !important;
		-webkit-box-shadow:rgba(0, 0, 0, 0.819608) 0px 10px 65px -5px;
		-moz-box-shadow:rgba(0, 0, 0, 0.819608) 0px 10px 65px -5px;
		box-shadow:rgba(0, 0, 0, 0.819608) 0px 10px 65px -5px;
	}

	.btn-primary {
		background: #602162 !important;
		border-color: #602162 !important;
		-webkit-transition: .25s all ease-in-out !important;
		transition: .25s all ease-in-out !important;
	}

	.btn-primary:hover {
		background: #7e2c81 !important;
		border-color: #7e2c81 !important;
	}

	.sec_1 {
		border-bottom: 13px solid #9CDF2C !important;
	}

	.sec_2 {
		border-bottom: 13px solid #d23532 !important;
	}

	.sec_3 {
		border-bottom: 13px solid #892DB3 !important;
	}

	.sec_4 {
		border-bottom: 13px solid #F3D944 !important;
	}

	.sec_5 {
		border-bottom: 13px solid #3CD6F4 !important;
	}

	.borderless td, .borderless th {
		border: none !important;
	}


	.data {
		border-bottom: dashed 1px #FFF;
		padding-bottom: 3px;
	}

	.data:hover {
		cursor: pointer;
	}

	#birth input{
		background: none;
		border: 0;
		color: white;
		border-bottom: white dashed 1px;
		font-size: 1em;
		padding: 0;
		padding-top: 0;
	}
	#birth .input-group-addon{
		color: white;
		background: none;
		border: 0;
		border-bottom: white dashed 1px;
	}

	</style>
</head>
<body>
	<center>
		<div class="vertical-align" >
			<div class="row animated fadeInUp">
				<div class="block">
					<section id="input_sec"	style="margin:auto; z-index: 999;">
						<img src="http://27.comcamp.in.th/assets/img/comcamp_logo.png" style="width: 440px; margin: 8px;" class="animated fadeInUp logo">
						<h2>ยินดีต้อนรับสู่ Comcamp 27<sup>th</sup></h2>
						<h5>ลงทะเบียนโดยกรอก<b>ชื่อ หรือเบอร์โทรศัพท์ (เฉพาะตัวเลข) หรืออีเมล </b>ได้เลยจ้า</h5>
						<form>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4 col-sm-offset-4">
										<input type="text" autocomplete="off" data-toggle="tooltip" data-placement="top" title="" style="line-height:28px; margin:15px auto;" class="form-control" id="input" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<button id="submit" data-loading-text="Loading..." class="btn btn-primary btn-lg disabled">ลงทะเบียน</button>
							</div>

						</form>
						<h6 id="alert" style="color:red; display:none;">ไม่พบข้อมูลจ้า ลองใหม่อีกครั้งนะ</h6>

					</section>

					<section id="result_sec" style="display:none; margin:auto; z-index: 999;">
						<div class="row">
							<div class="col-md-12">
								<h1 style="Font-size:36pt;">ยินดีต้อนรับจ้า น้อง<span id="nickname"></span>!</h1>
								<h4>รบกวนตรวจสอบข้อมูลอีกครั้งนะ ถ้าผิดตรงไหน คลิกที่ข้อมูลแล้วแก้ไขได้เลย</h4>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 text-center">
								<div class="alert alert-danger" role="alert" id="error-list" style="display: none; padding-bottom:0px !important;">
									<dl class="dl-horizontal"></dl>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center">
								<table class="table borderless" style="font-size: 16px; text-align:left;">
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">ชื่อ-นามสกุล</td>
										<td class="col-md-6"><span id="student_name" class="data"></span></td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">วันเดือนปีเกิด</td>
										<td class="col-md-6">
											<div class="input-group date col-md-4" id="birth">
													<input type="text" class="form-control">
													<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
											</div>
										</td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">ผู้ปกครอง</td>
										<td class="col-md-6">
											<span id="parent_name" class="data"></span>
											 (<span id="parent_relation" class="data"></span>)
											 โทร <span id="parent_phone" class="data"></span>
										</td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;"><span style="color:#F3D944;">* การเดินทางกลับ</span></td>
										<td class="col-md-6"><span id="travel" class="data" style="color:#F3D944;"></span></td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">ศาสนา</td>
										<td class="col-md-6"><span id="religion" class="data"></span></td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">โรคประจำตัว</td>
										<td class="col-md-6"><span id="disease" class="data"></span></td>
									</tr>
									<tr>
										<td class="col-md-6 text-right" style="font-weight:bold;">อาหารที่แพ้/ไม่ทาน</td>
										<td class="col-md-6"><span id="food" class="data"></span></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-lg btn-primary" id="confirm_data"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> ยืนยันข้อมูลถูกต้อง</button>
							</div>
						</div>

					</section>
					<section id="finish" style="display:none;">
						<h1>ลงทะเบียนเสร็จเรียบร้อยแล้ว!</h1>
						<h3>รับป้ายชื่อจากพี่ๆแล้วไปถ่ายรูปได้เลยย :)</h3>
						<br>
						<button class="btn btn-lg btn-primary" id="back">กลับหน้าแรก</button>
					</section>
				</div>
			</div>
		</div>
	</center>
	<script src="assets/js/angular.min.js"></script>
	<!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script> -->
	<script src="assets/js/jquery-1.11.2.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap-editable.js"></script>
	<script src="assets/js/bootstrap-datepicker.min.js"></script>
	<script>
		var id, programmingChange = false, travel_selected=false;

		function userdata(input){
			console.log(input);
			$.post("api/user", { q: input },
			function(result){
				programmingChange = true;
				$("#input_sec").hide();
				$("#result_sec").show();
				$("#result_sec").addClass("fadeIn");
				console.log(result);
				if(result.users){
					var userdata = result.users;
					console.log(userdata);
					var section = userdata["section"];

					$(".block").addClass("sec_"+userdata["section"]);

					var id = userdata["id"],
						registered = userdata["registered"],
						name = userdata["name"],
						surname = userdata["sirname"],
						food = userdata["food"],
						diase = userdata["diase"],
						parent_name = userdata["parent_name"],
						parent_relation = userdata["parent_relation"],
						parent_phone = userdata["parent_phone"],
						religion_id = userdata["religion"],
						nickname = userdata["nickname"],
						travel_id = userdata["travel"],
						regis_no = id;
					$("#regis_no").html(regis_no);
					$("#nickname").html(nickname);
					/*Set new value for x-editable*/
					$('#student_name').editable('setValue', name+' '+surname);
					$('#birth').datepicker('setDate', new Date(userdata['birth']));
					$("#parent_name").editable('setValue', parent_name);
					$("#parent_relation").editable('setValue', parent_relation);
					$("#parent_phone").editable('setValue', parent_phone);
					$("#travel").editable('setValue', travel_id);
					$("#religion").editable('setValue', religion_id);
					$("#disease").editable('setValue', diase);
					$("#food").editable('setValue', food);


					var picture = userdata["picture"];
					$("#picture").empty();
					if(picture){
						$("#picture").append('<img src='+picture+' style="max-height:160px; max-width: 160px;" class="img-thumbnail">');
					}
				}
				programmingChange = false;
			}, "json");
		}

		function update(type,val){
			$.post("api/edit", { 'id': id, 'key': type, 'value': val },
				function(result){
					console.log("update: " + type + " => " + val);
					console.log(jQuery.type(val));
					console.log(result);
					if(type=='travel'){
						travel_selected = true;
					}
					if(result.status == 'failed'){
						alert('เกิดปัญหาระหว่างแก้ไขข้อมูล '+type+" : "+val+'\n'+result.input+' : '+result.reason);
					}
				}, "json");
		}

		$(document).ready(function(){
			$("#input").focus();

			$("#input").keyup(function(){
				if($("#input").val()){
					$("#submit").removeClass("disabled");
				} else {
					$("#submit").addClass("disabled");
				}
			})

			$("#submit").click(function(){
				$.post("api/search", { q: $("#input").val() },
				function(result){
					console.log(result);
					if(result.status=="success"){
						id = result.users[0]["id"];
						console.log("id =>" + id);
						$("#input_sec").addClass("fadeOut");
						userdata(id);
						var i = 2;
						$("#confirm_data").addClass("disabled");
						timer = setInterval(function(){
							i = i-1;
							if(i>0){
								$("#confirm_data").addClass("disabled");
							} else {
								$("#confirm_data").removeClass("disabled");
								clearInterval(timer);
							}
						}, 1000);
					} else {
						$("#input").addClass("animated shake");
						$("#alert").show();
					}
				}, "json");
			})


			$("#confirm_data").click( function(e){
				e.preventDefault();
				var errors = $("#student_name, #parent_name, #parent_relation, #parent_phone, #religion, #travel").editable('validate');
				var birthDate = $("#birth").datepicker('getDate');
				if(birthDate == null){
					errors.birth = "กรุณากรอกวันเกิดด้วยครับ";
				}else if(birthDate.getYear() > (2005 - 1900) || birthDate.getYear() < (1995 - 1900)){
					errors.birth = "กรุณากรอกวันเกิดที่ถูกต้องด้วยครับ";
				}
				console.log(travel_selected);
				if(travel_selected==false){
					errors.travel = "กรุณาเลือกวิธีการเดินทางกลับด้วยครับ";
				}
				//$("#parent_relation").parent().parent().children('td:eq(0)').text();
				if(!jQuery.isEmptyObject(errors)){
					$("#error-list .dl-horizontal").empty();
					jQuery.each(errors, function(field, errorDetail){
						if(field == 'parent_name') field = 'ชื่อผู้ปกครอง';
						else if(field == 'parent_phone') field = 'เบอร์โทรผู้ปกครอง';
						else if(field == 'parent_relation') field = 'ความสัมพันธ์กับผู้ปกครอง';
						else field = $("#"+field).parent().parent().children('td:eq(0)').text();
						$("#error-list .dl-horizontal").append('<dt>'+field+'</dt><dd>'+errorDetail+'</dd>');
					});
					$("#error-list").fadeIn();
				}else{
					$("#error-list").hide();
					$.post("/api/submit/" + id, { }, function(result){
						console.log('id: ' + id + ' has been registered!');
						console.log(result);
						$("#result_sec").hide();
						$("#finish").show();
						var i = 5;
						var string = "กลับหน้าแรกอัตโนมัติใน 5 วินาที";
						$("#back").html(string);
						timer = setInterval(function(){
							i = i-1;
							if(i>0){
								string = "กลับหน้าแรกอัตโนมัติใน " + i + " วินาที";
							} else {
								$("#back").click();
								clearInterval(timer);
							}
							$("#back").html(string);
						}, 1000);
					}, "json");
				}
			});

			$("#back").click( function(){
				clearInterval(timer);
				$("#finish").hide();
				$("#input_sec").show();
				$("#input").val('');
				$("#input").focus();
				$("#input").removeClass("animated shake");
				$("#alert").hide();
				$(".block").removeClass("sec_1 sec_2 sec_3 sec_4 sec_5");
			});

			/*$('.data').tooltip({
				placement: 'right',
				title: 'คลิกเพื่อแก้ไขข้อมูล'
			});*/

			/*x-editable setting*/
			$('#student_name').editable({
				placement: 'right',
				validate: function(value) {
					if($.trim(value) == '') {
						return 'กรุณากรอกช่องนี้ด้วย';
					}else if(value.indexOf(' ') < 0){
						return 'กรุณากรอกนามสกุลด้วย';
					}
				},
				success: function(response, newValue) {
					var name = newValue.split(" ");
					update('name',name[0]);
					update('sirname',name[1]);
				}
			});
			$('#birth').datepicker({
				format: "yyyy-mm-dd"
			}).on('changeDate', function(e){
				if(!programmingChange){
					update('birth', $('#birth input:eq(0)').val());
					console.log(e);
				}
			});
			$('#parent_name').editable({
				placement: 'right',
				validate: function(value) {
					if($.trim(value) == '') {
						return 'กรุณากรอกช่องนี้ด้วย';
					}else if(value.indexOf(' ') < 0){
						return 'กรุณากรอกนามสกุลด้วย';
					}
				},
				success: function(response, newValue) {
					update('parent_name',newValue);
				}
			});
			$('#parent_relation').editable({
				placement: 'right',
				validate: function(value) {
					if($.trim(value) == '') {
						return 'กรุณากรอกช่องนี้ด้วย';
					}
				},
				success: function(response, newValue) {
					update('parent_relation',newValue);
				}
			});
			$('#parent_phone').editable({
				placement: 'right',
				validate: function(value) {
					var trimmedValue = $.trim(value)
					if(trimmedValue == '') {
						return 'กรุณากรอกช่องนี้ด้วย';
					}else if(trimmedValue.replace(/\D/g,'').length < 9){
						return 'กรุณากรอกหมายเลขโทรศัพท์ให้ครบด้วยครับ';
					}
				},
				success: function(response, newValue) {
					update('parent_phone',newValue);
				}
			});
			$('#travel').editable({
				type: 'select',
				url: './api/travel.php',
				source: './api/travel.php',
				placement: 'right',
				pk: '1',
				validate: function(value) {
					if($.trim(value) == '') {
						return 'กรุณาเลือกช่องนี้ด้วย';
					}
				},
				success: function(response, newValue) {
					if(newValue=="อนุเสาวรีย์ชัยสมรภูมิ"){
						travel_id = 1;
					} else if(newValue=="สถานีขนส่งหมอชิตใหม่ (หมอชิต 2)"){
						travel_id = 2;
					} else if(newValue=="สถานีรถไฟหัวลำโพง"){
						travel_id = 3;
					} else if(newValue=="สถานีขนส่งเอกมัย"){
						travel_id = 4;
					} else if(isNaN(parseInt(newValue))){
						travel_id = 5;
					}else{
						travel_id = parseInt(newValue);
					}
					update('travel',travel_id);
				}
			});
			$('#religion').editable({
				type: 'select',
				source: [
					{value: 1, text: "พุทธ"},
					{value: 2, text: "คริสต์"},
					{value: 3, text: "อิสลาม"},
					{value: 9, text: "ไม่นับถือศาสนาใด"}
				],
				validate: function(value){
					if($.trim(value) == '' || isNaN(parseInt(value))) {
						return 'กรุณาเลือกช่องนี้ด้วย';
					}
				},
				placement: 'right',
				success: function(response, newValue) {
					update('religion',newValue);
				}
			});
			$('#disease').editable({
				placement: 'right',
				success: function(response, newValue) {
					update('diase',newValue);
				}
			});
			$('#food').editable({
				placement: 'right',
				success: function(response, newValue) {
					update('food',newValue);
				}
			});

		});

	</script>
</body>
</html>
