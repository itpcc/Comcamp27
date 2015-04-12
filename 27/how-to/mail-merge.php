<?php
	$title = 'การออกเอกสารเพื่อใช้ในการขอประชาสัมพันธ์';
	$description = 'การออกเอกสารเพื่อใช้ในการขอประชาสัมพันธ์นั้น เนื่องจากเอกสารที่จะขอไปมีจำนวนมาก อาจบั่นทอนและทำให้เสียสุขภาพจิตได้เพราะมีจำนวนมาก เพื่อเป็นการอำนวยความสะดวก ฝ่ายเอกสารจึงจัดทำระบบจดหมายเวียนขึ้น ซึ่งมีขั้นตอนการใช้งานดังต่อไปนี้ค่ะ';
	include './template/section-header.php';
?>
<div class="container">
	<div class="section">
		<div class="row">
			<div class="col s12">
				ComCamp 27<sup>th</sup>'s Document
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="row center">
					<h3><i class="mdi-content-markunread brown-text"></i></h3>
					<h4><?php echo $title; ?></h4>
				</div>
				<p class="left-align light"><?php echo $description; ?></p>
				<pclass="left-align light"><a class="waves-effect waves-light btn" href="./doc/ใบขอรับการสนับสนุนจากผู้อุปถัมภ์ (ใช้กับไฟล์ sponsor_list.xlsx).docx"><i class="mdi-maps-rate-review left"></i>ไฟล์ Docx (ไฟล์เอกสารหลัก)</a> <a class="waves-effect waves-light btn" href="./doc/sponsor_list.xlsx"><i class="mdi-image-grid-on left"></i>ไฟล์ Xlsx (ไฟล์รายชื่อ)</a></p>
				
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-1.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										ให้เปิดไฟล์ sponsor_list.xlsx จะพบกับตารางรายชื่อตัวอย่าง ท่านสามารถแก้ไขชื่อผู้รับและหน่วยงานที่รับ หากไม่พอให้พิมพ์ต่อไปในแถวอื่นด้านล่าง ระบบจะค้นหาให้โดยอัตโนมัติ ทั้งนี้ อย่าลืมคัดลอกเลขที่เอกสาร (MOE_CODE) ด้วย ไม่เช่นนั้นท่านจะต้องกรอกเองภายหลัง (หากจะส่งไปที่หน่วยงานโดยตรง <strong>แม้เราจะไม่แนะนำให้ทำเช่นนั้น เพราะโดยปกติการออกเอกสารต้องระบุถึงผู้รับที่เป็นรายบุคคลไม่ว่าจะระบุโดยชื่อบุคคลหรือตำแหน่ง</strong> ท่านสามารถเว้นว่างไว้ ในการออกเอกสารที่ไฟล์ word จะลบบรรทัดชื่อให้โดยอัตโนมัติ)
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-2.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										เมื่อแก้ไขเอกสาร excel เสร็จแล้ว ให้เปิดไฟล์ <strong>ใบขอรับการสนับสนุนจากผู้อุปถัมภ์ (ใช้กับไฟล์ sponsor_list.xlsx)</strong> จะขึ้นหน้าจอขอสิทธิ์ในการเข้าถึงข้อมูล ให้กดตกลงดังภาพ
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-3.png" alt="" class="responsive-img materialboxed">
									<img src="./img/mail-merge/howto-4.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										หากระบบตรวจหาไฟล์รายชื่อไม่เจอ จะขึ้นกล่องถามหาที่ตั้งไฟล์ ให้ท่านเลือกไฟล์ sponsor_list.xlsx ในตำแหน่งที่ท่านเก็บไฟล์ไว้
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-5.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										เมื่อผ่านขั้นตอนข้างต้น ระบบจะถามหาแผ่นงานที่ท่านต้องการนำข้อมูลมาใช้ ให้ท่านเลือก (จะคลุมสีฟ้าที่ชื่อแผ่นงานให้) และติ๊กเลือกให้แถวแรกเป็นชื่อแถวด้วย
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-6.png" alt="" class="responsive-img materialboxed">
									<img src="./img/mail-merge/howto-6-5.png" alt="" class="responsive-img materialboxed">
									<img src="./img/mail-merge/howto-7.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										ระบบจะแสดงตัวอย่างหน้าเอกสารที่จะใช้งานจริงให้ ทั้งนี้ ท่านสามารถเลื่อนไปดูหน้าอื่นๆ ได้ที่ส่วนงาน <strong>Mailing</strong> หรือ <strong>จดหมาย</strong> ดังภาพ <strong>ไม่ควรแก้ไขข้อมูลใดๆ ในหน้านี้ทันที เพราะผลที่ได้จะกระทบถึงเอกสารทุกแผ่นในไฟล์นี้</strong>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-8.png" alt="" class="responsive-img materialboxed">
									<img src="./img/mail-merge/howto-9-5.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										หากท่านพึงพอใจแล้ว สามารถสั่งออกมาเป็นเอกสารย่อยๆ ได้ โดยกด <strong>Finish&amp;merge</strong> แล้วเลือก <strong>Edit Individual Documents... (จะออกมาเป็นไฟล์เอกสารอีกชุด ซึ่งแยกแผ่นตามรายชื่อไฟล์สำเร็จแล้ว)</strong> หรือ <strong>Print Documents... (สั่งพิมพ์เอกสารทันที)</strong><br />
										ระบบจะแสดงถามจำนวน/ระยะเอกสาร ให้ท่านเลือกตามที่ท่านต้องการ แล้วกด OK
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s5">
									<img src="./img/mail-merge/howto-9-5.png" alt="" class="responsive-img materialboxed">
								</div>
								<div class="col s7">
									<span class="black-text">
										เพียงเท่านี้ท่านก็จะได้เอกสารฯ ส่งไปหน่วยงานต่างๆ ได้อย่างสะดวก และง่ายดาย...
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<footer class="page-footer">
	<div class="container">
		<div class="row">
			<div class="col l6 s12 offset-6">
				<h5 class="white-text">ติดต่อสอบถามข้อมูลเพิ่มเติม</h5>
				<p class="grey-text text-lighten-4">
					นายฐิติภูมิ จิตอามาตย์ (เอิกเกริก) 086-242-5285<br />
					นายปองพล คำปัน (บุ้ง)<br />
					นายราชศักดิ์ รักษ์กำเนิด (บิ๊ก) 086-321-9383
				</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
		© 2015 ฝ่ายเอกสาร
		</div>
	</div>
</footer>

<?php include './template/section-footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
			$('.materialboxed').materialbox();
	});
</script>
</body>
</html>
