<?php
	if($typepage == 'pageinsert'){
		$ID 				= '';
		$FirstName 			= '';
		$LastName 			= '';
		$PathImage 			= '';
		$Email 				= '';
		$Phone 				= '';
		$Status 			= '1';
		$Username   		= '';
		$Password   		= '';
		$TextButton 		= 'ลงทะเบียน';
	}else if($typepage == 'pageedit'){
		$ID 				= $Result['Items'][0]['admin_id'];
		$FirstName 			= $Result['Items'][0]['firstname'];
		$LastName 			= $Result['Items'][0]['lastname'];
		$PathImage 			= $Result['Items'][0]['admin_image'];
		$Email 				= $Result['Items'][0]['admin_email'];
		$Phone 				= $Result['Items'][0]['admin_phone'];
		$Status 			= $Result['Items'][0]['admin_status'];
		$Username   		= $Result['Items'][0]['username'];
		$Password   		= $Result['Items'][0]['password'];
		$TextButton 		= 'แก้ไขข้อมูล';
	}
?>


<!--ฟอร์มลงทะเบียนผู้ดูแลระบบ + แก้ไข-->
<div class="col-lg-12"><hr></div>
<form id="formAdmin" class="form-signin" method="post" action="javascript:void(0)">
	<div class="col-lg-12" id="divRegisAdmin" style="margin-top:20px;">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<?php 
					if($PathImage == '' || $PathImage == null){
						$PathShowImage 		= base_url('/application/assets/images/admin/') . '/NoImage.png';
						$PathDatabaseImage 	= '';
					}else{
						$PathShowImage 		= base_url('/application/assets/images/admin/') . $PathImage;
						$PathDatabaseImage 	= $PathImage;
					} ?>
				<img id="ImgInsertAdmin" class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
				<input type="hidden" id="hiddenImgInsertAdmin" name="hiddenImgInsertAdmin" value="<?=$PathDatabaseImage?>">
				<button type="button" class="btn btn-outline-secondary xCNChooseImage" onclick="UploadImageAdmin()">เลือกรูปภาพ</button>
				<input type="file" id="inputfileuploadImageAdmin" style="display:none;"  name="inputfileuploadImageAdmin" accept="image/*" onchange="ImageUplodeResize(this,'images/admin','ImgInsertAdmin')">
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="form-row">

					<input type="hidden" id="hiddenTypePage" name="hiddenTypePage" value="<?=$typepage?>">
					<input type="hidden" id="hiddenAdminID" name="hiddenAdminID" value="<?=$ID?>">
					<input type="hidden" id="hiddenAdminPassword" name="hiddenAdminPassword" value="<?=$Password?>">

					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> ชื่อ</label>
						<input type="text" maxlength="50" class="form-control" id="regisAdminFirstname" name="regisAdminFirstname" placeholder="ชื่อ" value='<?=$FirstName?>' >
					</div>
					<div class="form-group col-md-12">
						<label>นามสกุล</label>
						<input type="text" maxlength="50" class="form-control" id="regisAdminLastname" name="regisAdminLastname" placeholder="นามสกุล" value='<?=$LastName?>'>
					</div>
					<div class="form-group col-md-12">
						<label>อีเมลล์</label>
						<input type="text" maxlength="50" class="form-control" id="regisAdminEmail" name="regisAdminEmail"  placeholder="อีเมลล์" value='<?=$Email?>'>
					</div>
					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> เบอร์โทร</label>
						<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisAdminTelephone" name="regisAdminTelephone" placeholder="เบอร์โทร" value='<?=$Phone?>'>
					</div>
					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> ชื่อเข้าใช้งาน</label>
						<input type="text" maxlength="50" class="form-control" id="regisAdminLoginID" name="regisAdminLoginID" placeholder="ชื่อเข้าใช้งาน" value="<?=$Username?>">
					</div>
					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> รหัสผ่าน</label>
						<input type="password" maxlength="50" class="form-control" id="regisAdminPassword" name="regisAdminPassword" placeholder="รหัสผ่าน" value="<?=$Password?>">
					</div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input" name="regisAdminStatusUse" id="regisAdminStatusUse" style="width: 15px; height: 15px; top: 2px;" 	<?php if ($Status == 1) {echo "checked='checked'";} ?> >
						<label class="form-check-label" style="margin-left: 10px; margin-bottom: 10px; font-size: 22px !important;">สถานะใช้งาน</label>
					</div>
					<div class="form-group col-md-12">
						<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="EventSaveOrEdit_Admin()"><?=$TextButton?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<!--Validate ทำให้ input กรอกได้เเต่ตัวเลข , ตัวอักษร-->
<script src="<?= base_url('application/assets/js/FormValidate.js')?>"></script>

<script>
	//อัพโหลดรูปภาพ - ผู้ดูแลระบบ
	function UploadImageAdmin(){
		$('#inputfileuploadImageAdmin').click(); 
	}
	
	//อัพโหลดรูปภาพ
	function ImageUplodeResize(Img,Path,IDelem){
		var oImgData = Img.files[0];
		var oImgFrom = new FormData();
		oImgFrom.append('file',oImgData);
		oImgFrom.append('path', Path);
		
		$.ajax({
			type 			: "POST",
			url 			: "ImageUpload",
			cache 			: false,
			contentType		: false,
			processData		: false,
			data 			: oImgFrom,
			datatype		: "JSON",
			success			: function (Result){
				if(Result!=""){
					var aResult 	= JSON.parse(Result);
					var ImageName 	= aResult.tImgName;
					var FullPath   = '<?=base_url('application/assets/')?>' + Path + '/' + ImageName;
					$('#' + IDelem).attr('src',FullPath);
					$('#hidden' + IDelem).val(ImageName);
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	}

	//ลงทะเบียนผู้ดูแลระบบ
	function EventSaveOrEdit_Admin(){
		//เช็คว่ากรอกข้อมูลครบหรือยัง

		//ไม่ได้กรอกชื่อผู้ใช้
		if($('#regisAdminFirstname').val() == ''){
			$('#regisAdminFirstname').focus();
			return;
		}

		//ไม่ได้กรอกเบอร์โทรศัพท์
		if($('#regisAdminTelephone').val() == ''){
			$('#regisAdminTelephone').focus();
			return;
		}

		//ไม่ได้กรอกเบอร์โทรศัพท์
		if($('#regisAdminTelephone').val() == ''){
			$('#regisAdminTelephone').focus();
			return;
		}

		//ไม่ได้กรอกชื่อผู้ใช้เข้าสู่ระบบ
		if($('#regisAdminLoginID').val() == ''){
			$('#regisAdminLoginID').focus();
			return;
		}

		//ไม่ได้กรอกรหัสผ่าน
		if($('#regisAdminPassword').val() == ''){
			$('#regisAdminPassword').focus();
			return;
		}else{
			//ค่าที่กรอก password น้อยกว่า 6 ตัว
			if($('#regisAdminPassword').val().length  < 6){
				Swal.fire({
					title: "รหัสผ่านไม่ถูกต้อง",
					text: "รหัสผ่านต้องมีความยาวมากกว่าหรือเท่ากับ 6 หลัก",
					icon: "error",
					showCancelButton: false,
					confirmButtonColor: '#ff6868',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					$('#regisAdminPassword').val('');
					$('#regisAdminPassword').focus();
				});
				return;
			}
		}
		
		$.ajax({
			type 			: "POST",
			url 			: "EventInsOrEdit_Admin",
			data 			: $('#formAdmin').serialize(),
			success			: function (Result){
				console.log(Result);
				if(Result == 'duplicate'){
					//ชื่อเข้าใช้งานซ้ำ
					Swal.fire({
						title: "ชื่อเข้าใช้งานซ้ำ",
						text: "ชื่อเข้าใช้งานซ้ำกรุณาลองใหม่อีกครั้ง",
						icon: "error",
						showCancelButton: false,
						confirmButtonColor: '#ff6868',
						confirmButtonText: 'ตกลง',
					}).then(function (result) {
						
					});
				}else{
					if('<?=$typepage?>' == 'pageinsert'){ 
						var TitleSwal = 'ลงทะเบียนสำเร็จ';
					}else if('<?=$typepage?>' == 'pageedit'){ 
						var TitleSwal = 'แก้ไขข้อมูลสำเร็จ';
					}

					//ผ่าน
					Swal.fire({
						title: TitleSwal,
						text: "",
						icon: "success",
						showCancelButton: false,
						confirmButtonColor: '#bfe6a9',
						confirmButtonText: 'ตกลง',
					}).then(function (result) {
						Back_Admin();
					});
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
