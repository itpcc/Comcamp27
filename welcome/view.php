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
	<title>Comcamp #27: Registration</title>
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
	<link rel="stylesheet" href="assets/fonts/thsarabunnew.css" />
	<link rel="stylesheet" href="assets/css/comcamp-font.css" type="text/css" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<style>
		.row {
			margin: 15px 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 text-center">
				<h3>
					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รายชื่อน้องลงทะเบียน
				</h3>
			</div>
			<div class="col-md-1" id="countdown"></div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-md-offset-1 text-center">
				<a href="./api/data/" class="btn btn-primary">Excel</a>
			</div>
			<div class="col-xs-8 text-center">
				<form class="form-inline">
					<div class="form-group">
						<div class="col-xs-7">
							<input type="text" class="form-control" id="search-input" placeholder="Search...">
						</div>
						<div class="col-xs-3 col-xs-offset-1">
							<select name="section">
								<option value="0" selected>เลือกทั้งหมด</option>
								<option value="1">ผีทาโกรัส</option>
								<option value="2">ผีอีเหล็ด</option>
								<option value="3">ผีน๊อคคีโอ</option>
								<option value="4">ผีเดเตอร์</option>
								<option value="5">ผีพุ่งใต้</option>
							</select>
						</div>
					</div>
						<button type="submit" class="btn btn-primary" id="search-submit">ค้นหา</button>
				</form>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-striped" id="users-data-table">
					<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th class="col-md-5">ชื่อ-นามสกุล</th>
							<th class="col-md-3">เบอร์โทรศัพท์</th>
							<th class="col-md-3">เวลาที่ลงทะเบียน</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Test Subject</td>
							<td>0900000000</td>
							<td>Test Subject</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">รายละเอียดข้อมูลน้อง</h4>
				</div>
				<div class="modal-body">
					<dl class="dl-horizontal" id="user-data-list">
					</dl>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				</div>
			</div>
		</div>
	</div>


	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/pnotify.custom.min.js"></script>
	<script type="text/javascript">
		var intervalObj, countdownTime = 0, idShown = [], noticeTimestamp = Date.now() / 1000 | 0;
		$(document).ready(function(){
			intervalObj = setInterval(intervalFnc, 1000);
			$("#search-submit").click(function(e){
				e.preventDefault();
				loadData();
				clearInterval(intervalObj);
				intervalObj = setInterval(intervalFnc, 1000);
				countdownTime = 5;
			});
			setInterval(function(){
				$.getJSON('./api/notification/'+noticeTimestamp, function(data){
					if(typeof data.users !== 'undefined' && data.users.length > 0){
						$.each(data.users, function(i, user){
							if(idShown.indexOf(user.id) >= 0){
								data.users.splice(i, 1);
							}
						});
						if(data.users.length > 0){
							var html = data.users[0].nickname;
							if(data.users.length > 1)
								html += ' และอีก '+data.users.length+' คน';
							html += ' ลงทะเบียนเข้ามาใหม่แล้ว';
							PNotify.desktop.permission();
							(new PNotify({
								title: 'น้องลงทะเบียนเพิ่ม',
								text: html,
								desktop: {
									desktop: true,
									icon: './api/assets/comcamp.png'
								}
							}));
							$.each(data.users, function(i, user){
								idShown.push(user.id);
							});
						}
					}
					noticeTimestamp = data.timestamp;
					
				});
			}, 2000);
			$("#users-data-table").on('click', '.user-data-row[data-userid]', function(){
				var userId = $(this).data('userid');
				$.post('./api/user/', {"q": userId}, function(data){
					if(typeof data.users !== 'undefined'){
						$("#user-data-list").html('');
						$.each(data.users, function(index, value){
							$("#user-data-list").append('<dt>'+index+'</dt><dd>'+value+'</dd>');
						});
						$('#myModal').modal('show');
					}else{
						new PNotify({
							title: 'ไม่เจอฮะ',
							text: 'ไม่พบข้อมูลน้องรหัส '+userId,
							type: 'error'
						});
					}
				}, 'json');
			});
		});
		function intervalFnc(){
			$("#countdown").html(countdownTime);
			if(countdownTime <= 0){
				loadData();
				countdownTime = 5; //5 secs
			}else{
				countdownTime--;
			}
		}

		function loadData(){
			var param = {}, url = './api/fetch/';
			if($("[name=section]").val() > 0){
				param.section = $("[name=section]").val();
			}

			if($("#search-input").val().length > 3){
				param.q = $("#search-input").val();
				url = './api/search/';
			}

			$.post(url, param, function(data){
				$("#users-data-table tbody").html('');
				if(typeof data.users !== 'undefined'){					
					$.each(data.users, function(i, row){
						$("tbody").append(
							'<tr data-userid="'+row.id+'" class="user-data-row">'+
								"<td>"+row.id+"</td>"+
								"<td>"+row.name+' '+row.sirname+' ( '+row.nickname+")</td>"+
								"<td>"+row.tel+"</td>"+
								"<td>"+(row.registered > 0?row.registered:'ยังไม่ลงทะเบียน')+"</td>"+
							"</tr>");
					});
				}else{
					$("tbody").append('<tr><td colspan="4">ไม่พบข้อมูล</td></tr>');
				}
			}, 'json'); 
		}
	</script>
</body>
</html>
