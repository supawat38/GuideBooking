
<div class="container">
	<div class="row">

		<!--สรุปการจอง-->
		<div class="col-lg-12" style="margin:70px 0px 10px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-12">
					<?php 
						$PathShowImage 		= base_url('/application/assets/images/QR.jpg');
					?>
					<img class="img-responsive" style="display: block; margin: 0px auto;" src="<?=$PathShowImage?>">
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-5" id="divPayment">
					<div class="row">
						<div class="form-group col-lg-12">
							<label >อัพโหลดรูปภาพสลิปเป็นหลักฐาน</label>
							<div class="custom-file">
								<input type="file" onchange="UplodeSlip(this)" id="UploadSlip" accept="image/x-png,image/gif,image/jpeg">
								<label class="custom-file-label" for="UploadSlip" value=''></label>
								<input type="hidden" name="UploadSlipName" id="UploadSlipName" value=''>
							</div>
						</div>
					</div>
					<div class="form-group col-lg-12" style="padding:0px;">
						<label>ชำระจากธนาคาร</label>	
						<select class="jSelectedSingle form-control" name="Bankpayment" id="Bankpayment">
							<option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
							<option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
							<option value="ธนาคารกรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
							<option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
							<option value="ธนาคารเกียรตินาคินภัทร">ธนาคารเกียรตินาคินภัทร</option>
							<option value="ธนาคารซีไอเอ็มบี">ธนาคารซีไอเอ็มบี</option>
							<option value="ธนาคารทหารไทย">ธนาคารทหารไทย</option>
							<option value="ธนาคารทิสโก้">ธนาคารทิสโก้</option>
							<option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
							<option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
							<option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>
						</select>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-6">
							<button type="button" class="align-self-stretch btn btn-primary BTNSelectBooking" style="width: 100%; margin-bottom:10px;" onclick='PaymentBooking();';>แจ้งชำระเงิน</button>
						</div>
						<div class="col-lg-6">
							<button type="button" class="align-self-stretch btn btn-primary BTNSelectBooking" style="width: 100%; margin-bottom:10px;" onclick='LaterBooking();';>ชำระเงินภายหลัง</button>
						</div>
					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function() {
		//ธนาคาร
		$(".jSelectedSingle").select2();
		$(".jSelectedSingle").select2({ width: '100%' , dropdownCssClass: "FontSelect2"});  
	});

	//อัพโหลดไฟล์สลิป
	function UplodeSlip(poFile){
		myfile	= $('#UploadSlip').val();
		var ext = myfile.split('.').pop();
		if(ext=="jpeg" || ext=="png" || ext=="jpg"){
			var objectData = $('#UploadSlip').prop('files')[0];
			var objectFile = new FormData();
			objectFile.append('file',objectData);
			objectFile.append('bookingID','<?=$booking_id?>');
			objectFile.append('unit',ext);
			
			$.ajax({
				type 		: "POST",
				url 		: "Booking_UploadSlip",
				cache 		: false,
				contentType	: false,
				processData	: false,
				data 		: objectFile,
				datatype	: "JSON",
				success: function (Result){
					var fileName = Result.split("\\").pop();
					$('#UploadSlip').siblings(".custom-file-label").addClass("selected").html(fileName);
					$('#UploadSlipName').val(fileName);
				},
				error: function (data){
					console.log(data);
				}
			});
		} else{
			Swal.fire({
				title: "ผิดพลาด",
				text: "รูปแบบไฟล์ไม่ถูกต้อง",
				icon: "error",
				showCancelButton: false,
				confirmButtonColor: '#ff6868',
				confirmButtonText: 'ตกลง',
			}).then(function (result) {
				
			});
		}
	}

	//แจ้งชำระเงิน
	function PaymentBooking(){
		if($('#UploadSlipName').val() == ''){
			$('#UploadSlip').focus();
			return;
		}

		$.ajax({
			type 			: "POST",
			url 			: "Booking_ConfirmPayment",
			data 			: { 
				'pathSlip' 		: $('#UploadSlipName').val(),
				'bankFrom' 		: $('#Bankpayment').val(),
				'booking_id' 	: '<?=$booking_id?>',
				'grandtotal'	: '<?=$grandtotal?>'
			 },
			success			: function(Result){
				Swal.fire({
					title: "การจองสำเร็จ",
					text: "รอการตรวจสอบความถูกต้อง ขอบคุณที่ใช้บริการ",
					icon: "success",
					showCancelButton: false,
					confirmButtonColor: '#bfe6a9',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					window.location.href = "main";
				});
			},
			error: function (data){
				console.log(data);
			}
		});
	}

	//ภายหลัง
	function LaterBooking(){
		Swal.fire({
			title: "การจองสำเร็จ",
			html: "กรุณาชำระเงินภายใน 1 วัน หากไม่ชำระเงิน<br />การจองของคุณจะถูกยกเลิกจากระบบ",
			icon: "success",
			showCancelButton: false,
			confirmButtonColor: '#bfe6a9',
			confirmButtonText: 'ตกลง',
		}).then(function (result) {
			window.location.href = "main";
		});
	}
</script>
