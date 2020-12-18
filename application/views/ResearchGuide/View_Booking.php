
<div class="container">
	<div class="row">	

		<!--สรุปการจอง-->
		<div class="col-lg-12" style="margin:70px 0px 10px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-10">
					<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">สรุปการจอง</p>
					<label class="labelHead" >จังหวัด </label>
					<label class="labelHead" style="font-weight: bold; color: #ec6941; font-size: 25px !important;"><?=$provincename[0]['province_name']; ?> </label>
					<label class="labelHead" ><?=$personbookig ?> คน</label>
					<label class="labelHead" >วันที่ <?=$datestartbooking ?> ถึง <?=$datestopbooking ?></label><br>
					<label class="labelHead" >ราคา : </label>
					<label class="labelHead" style="font-weight: bold; color: #ec6941; font-size: 25px !important;"><?=number_format($DetailRate[0]['amount'],2) ?> </label>

					<?php 
					//หาว่าวันที่ห่างกันกี่วัน
					$DateBookingStart = date_create(str_replace('/', '-', $datestartbooking));
					$DateBookingStop  = date_create(str_replace('/', '-', $datestopbooking));
					$DateDiff		  =	date_diff($DateBookingStart,$DateBookingStop);
					if($DateDiff->format("%a") == 0){
						$DateDiff = 1;
					}else{
						$DateDiff = $DateDiff->format("%a") + 1;
					} 
					//ราคารวมคูณจำนวนวัน
					$PriceTotal = number_format($DateDiff * $DetailRate[0]['amount'],2);
					?>
					
					<label class="labelHead"> บาท / วัน </label><br>
					<label class="labelHead"> รวมทั้งสิ้น : </label>
					<label class="labelHead" style="font-weight: bold; color: #ec6941; font-size: 25px !important;"><?=$PriceTotal?></label>
					<label class="labelHead"> บาท </label><br>
					<label class="labelHead" >เงื่อนไข : <?=($DetailRate[0]['note'] == '') ? '-' : $DetailRate[0]['note'] ?></label>
				</div>
				<div class="col-lg-2" style="border-left: 1px solid #dee2e6;">
					<div class="row">
						<div class="col-lg-12">
							<button type="button" class="align-self-stretch btn btn-primary BTNSelectBooking" style="width: 100%; margin-bottom:10px;" onclick='ConfirmBooking();';>ยืนยันการจอง</button>
						</div>
						<div class="col-lg-12">
							<button type="button" class="align-self-stretch btn btn-primary BTNSelectBooking" style="width: 100%; margin-bottom:10px;" onclick='BackBooking();';>ย้อนกลับ</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--ข้อมูลลูกค้า-->
		<div class="col-lg-12" style="margin:20px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-4">
					<?php 
					$PathImage = $Customer[0]['cus_image'];
					if($PathImage == '' || $PathImage == null){
						$PathShowImage 		= base_url('/application/assets/images/customer/') . '/NoImage.png';
						$PathDatabaseImage 	= '';
					}else{
						$PathShowImage 		= base_url('/application/assets/images/customer/') . $PathImage;
						$PathDatabaseImage 	= $PathImage;
					} ?>
					<img class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
				</div>
				<div class="col-lg-8">
					<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">ข้อมูลลูกค้า</p>
					<label class="labelHead" >คุณ<?=$Customer[0]['firstname']; ?> <?=$Customer[0]['lastname']; ?> </label><br>
					<label class="labelHead" >เพศ : <?=($Customer[0]['gender'] == '1' ) ? 'ชาย' : 'หญิง'; ?></label><br>
					<label class="labelHead" >เบอร์โทรศัพท์ที่สามารถติดต่อได้ : <?=$Customer[0]['cus_phone'] ?></label><br>
					<label class="labelHead" >ที่อยู่ที่สามารถติดต่อ : <?=($Customer[0]['address'] == '') ? 'ไม่ได้ระบุ' : $Customer[0]['address'] ?></label>
				</div>
			</div>
		</div>

		<!--ข้อมูลไกด์-->
		<div class="col-lg-12" style="margin:20px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-4">
					<?php 
					$PathImage = $Guide[0]['guide_image'];
					if($PathImage == '' || $PathImage == null){
						$PathShowImage 		= base_url('/application/assets/images/guide/') . '/NoImage.png';
						$PathDatabaseImage 	= '';
					}else{
						$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
						$PathDatabaseImage 	= $PathImage;
					} ?>
					<img class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
				</div>
				<div class="col-lg-6">
					<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">ข้อมูลมัคคุเทศก์</p>
					<label class="labelHead" >คุณ<?=$Guide[0]['firstname']; ?> <?=$Guide[0]['lastname']; ?> </label><br>
					<label class="labelHead" >เพศ : <?=($Guide[0]['gender'] == '1' ) ? 'ชาย' : 'หญิง'; ?></label><br>
					<label class="labelHead" >หมายเลขมัคคุเทศก์ : <?=($Guide[0]['guide_credit'] == '') ? 'ไม่ได้ระบุ' : $Guide[0]['guide_credit'] ?></label><br>
					<label class="labelHead" >เกี่ยวกับมัคคุเทศก์ : <?=($Guide[0]['intro_profile'] == '') ? 'ไม่ได้ระบุ' : $Guide[0]['intro_profile'] ?></label><br>
					<label class="labelHead" >ที่อยู่ : <?=($Guide[0]['address'] == '') ? 'ไม่ได้ระบุ' : $Guide[0]['address'] ?></label>
				</div>
				<div class="col-lg-2">
					<a class="labelHead" href="Booking_DeteilGuide/<?=$Guide[0]['guide_id']; ?>" target="_blank" style="display: block; margin: 0px auto; text-align: right; color: #f98b2d;" >ดูข้อมูลเพิ่มเติม</a>
				</div>
			</div>
		</div>

	</div>
</div>


<script>
	$('.TextFontTitleSlide').text('ตรวจสอบข้อมูลการจอง');

	//ยกเลิก Booking
	function BackBooking(){
		window.location.href = "main";
	}

	//ยืนยัน Booking
	function ConfirmBooking(){
		$.ajax({
			type 			: "POST",
			url 			: "Booking_Confirm",
			data 			: { 
				'provincebooking' 	: '<?=$provincebooking?>',
				'personbookig'		: '<?=$personbookig?>',
				'datestartbooking'	: '<?=$datestartbooking?>',
				'datestopbooking'	: '<?=$datestopbooking?>',
				'GuideID'			: '<?=$GuideID?>'
			},
			success			: function(Result){
				$('#ContentReseachGuideBooking').html(Result);
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
