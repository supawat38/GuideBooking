<!-- เอาไว้เก็บข้อมูล -->
<?php 
if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ 
	$UserType = $this->session->userdata("session_reftype");
	if($UserType == 2){ //ข้อมูลลูกค้า
		$ID 		= $dataUser['Items'][0]['cus_id'];
		$FirstName 	= $dataUser['Items'][0]['firstname'];
		$LastName 	= $dataUser['Items'][0]['lastname'];
		$Birthdate	= date('d/m/Y',strtotime($dataUser['Items'][0]['cus_bd']));
		$Gender		= $dataUser['Items'][0]['gender'];
		$Address	= $dataUser['Items'][0]['address'];
		$Credit		= '';
		$License	= '';
		$Province	= '';
		$Postcode 	= '';
		$PathImage 	= $dataUser['Items'][0]['cus_image'];
		$Email 		= $dataUser['Items'][0]['cus_email'];
		$Phone 		= $dataUser['Items'][0]['cus_phone'];
		$Profile	= '';
		$Qustions 	= $dataUser['Items'][0]['cus_qustions'];
		$Status     = $dataUser['Items'][0]['cus_status'];
		$Username   = $dataUser['Items'][0]['username'];
		$Password   = $dataUser['Items'][0]['password'];
	}
}
?>

<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<form id="formRegis" class="form-signin" method="post" action="javascript:void(0)">

			<!-- กดปุ่มมัคคุเทศก์ เก็บ type ไว้ 1:ผู้ดูแลระบบ , 2:ลงทะเบียนผู้ใช้ทั่วไป , 3:ลงทะเบียนมัคคุเทศก์ -->
			<input type="hidden" id="ohdTypeRegis" name="ohdTypeRegis" value="2">

			<div class="row">
				<div class="col-lg-12" style="margin:70px 0px;">
					<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
						
						<!--ปุ่มกด-->
						<div class="col-lg-12 p-12">
							<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisActive">แก้ไขข้อมูลส่วนตัว นักท่องเที่ยว</button>
						</div>

						<!--เส้นขีดเส้นใต้-->
						<div class="col-lg-12"><hr></div>

						<!--ฟอร์มลงทะเบียนผู้ใช้งาน-->
						<div class="col-lg-12" id="divRegisCustomer" style="margin-top:20px;">
							<div class="row">
								<div class="col-lg-4 col-md-12">
									<?php 
										if($PathImage == '' || $PathImage == null){
											$PathShowImage 		= base_url('/application/assets/images/customer/') . '/NoImage.png';
											$PathDatabaseImage 	= '';
										}else{
											$PathShowImage 		= base_url('/application/assets/images/customer/') . $PathImage;
											$PathDatabaseImage 	= $PathImage;
										} ?>

									<img id="ImgInsertCustomer" class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
									<input type="hidden" id="hiddenImgInsertCustomer" name="hiddenImgInsertCustomer" value="<?=$PathDatabaseImage?>">
									<button type="button" class="btn btn-outline-secondary xCNChooseImage" onclick="UploadImageCustomer()">เลือกรูปภาพ</button>
									<input type="file" id="inputfileuploadImageCustomer" style="display:none;"  name="inputfileuploadImageCustomer" accept="image/*" onchange="ImageUplodeResize(this,'images/customer','ImgInsertCustomer')">
								</div>
								<div class="col-lg-8 col-md-8">
									<div class="form-row">
										<input type="hidden" id="hiddenCustomerID" name="hiddenCustomerID" value="<?=$ID?>">
										<input type="hidden" id="hiddenCustomerPassword" name="hiddenCustomerPassword" value="<?=$Password?>">

										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> ชื่อ</label>
											<input type="text" maxlength="50" class="form-control" id="regisCustomerFirstname" name="regisCustomerFirstname" placeholder="ชื่อ" value='<?=$FirstName?>'>
										</div>
										<div class="form-group col-md-12">
											<label>นามสกุล</label>
											<input type="text" maxlength="50" class="form-control" id="regisCustomerLastname" name="regisCustomerLastname" placeholder="นามสกุล" value='<?=$LastName?>'>
										</div>
										<div class="form-group col-md-12">
											<label style="margin-right:10px;">เพศ</label>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="regisCustomerGenter" id="radioMaleCustomer" value="1" 
												<?php if ($Gender == 1) {echo "checked='checked'";} ?>>
												<label class="form-check-label" for="radioMaleCustomer">
													ชาย
												</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="regisCustomerGenter" id="radioFemaleCustomer" value="2"
												<?php if ($Gender == 2) {echo "checked='checked'";} ?>>
												<label class="form-check-label" for="radioFemaleCustomer">
													หญิง
												</label>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>วันเกิด</label>
											<input type="text" class="form-control birthdaypicker" id="regisCustomerBirthday" name="regisCustomerBirthday" value="<?=$Birthdate?>" placeholder="<?=date('d/m/Y');?>">
										</div>
										<div class="form-group col-md-12">
											<label>อีเมลล์</label>
											<input type="text" maxlength="100" class="form-control" id="regisCustomerEmail" name="regisCustomerEmail"  placeholder="อีเมลล์" value='<?=$Email?>'>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> เบอร์โทร</label>
											<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisCustomerTelephone" name="regisCustomerTelephone" placeholder="เบอร์โทร" value='<?=$Phone?>'>
										</div>
										<div class="form-group col-md-12">
											<label>ที่อยู่</label>	
											<textarea id="regisCustomerAddress" maxlength="255" name="regisCustomerAddress" cols="30" rows="3" class="form-control" placeholder="ที่อยู่"><?=$Address?></textarea>
										</div>
										<div class="form-group col-md-12">
											<label>สิ่งที่คุณสนใจ (สามารถเลือกได้มากกว่า 1 ข้อ)</label>	
											<select class="jSelectedmultiple form-control" name="regisCustomerQuestion[]" multiple="multiple">
											<option value="ภูเขา">ภูเขา</option>
												<option value="ทะเล">ทะเล</option>
												<option value="แม่น้ำ">แม่น้ำ</option>
												<option value="วัด">วัด</option>
												<option value="อุทยาน">อุทยาน</option>
												<option value="ทะเลหมอก">ทะเลหมอก</option>
												<option value="ปืนเขา">ปืนเขา</option>
												<option value="น้ำตก">น้ำตก</option>
												<option value="เขื่อน">เขื่อน</option>
												<option value="ดอย">ดอย</option>
												<option value="ประวัติศาสตร์">ประวัติศาสตร์</option>
												<option value="ศิลปะ">ศิลปะ</option>
												<option value="วัฒนธรรม">วัฒนธรรม</option>
												<option value="ทุ่งดอกไม้">ทุ่งดอกไม้</option>
												<option value="ดำน้ำ">ดำน้ำ</option>
												<option value="ไร่">ไร่</option>
												<option value="ชุมชน">ชุมชน</option>
												<option value="คาเฟ่">คาเฟ่</option>
												<option value="ของกิน">ของกิน</option>
												<option value="สวนสัตว์">สวนสัตว์</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> ชื่อเข้าใช้งาน</label>
											<input type="text" maxlength="50" class="form-control" id="regisCustomerLoginID" name="regisCustomerLoginID" placeholder="ชื่อเข้าใช้งาน" value='<?=$Username?>'>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> รหัสผ่าน</label>
											<input type="password" maxlength="50" class="form-control" id="regisCustomerPassword" name="regisCustomerPassword" placeholder="รหัสผ่าน" value='<?=$Password?>'>
										</div>
										<div class="form-group col-md-12">
											<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="UpdateInformationCustomer()">แก้ไขข้อมูล</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<!--โหลดไฟล์ script หน้า customer-->
<?php include __DIR__ . '/../footer.php';?>

<!--Validate ทำให้ input กรอกได้เเต่ตัวเลข , ตัวอักษร-->
<script src="<?= base_url('application/assets/js/FormValidate.js')?>"></script>

<script>
	$(document).ready(function() {
		//ช่องความสนใจ
		$(".jSelectedmultiple").select2();
		$(".jSelectedmultiple").select2({ width: '100%' , dropdownCssClass: "FontSelect2"});  

		//ช่องจังหวัด
		$(".jSelectedsingle").select2();
		$(".jSelectedsingle").select2({ width: '100%' , dropdownCssClass: "FontSelect2"});  

		//split คำถาม
		var Qustions 		= '<?=$Qustions?>';
		if(Qustions != '' || Qustions != null){
			var arrayQustions 	= Qustions.split(",");
			$(".jSelectedmultiple").val(arrayQustions).change();
		}
	});

	//วันเกิด ให้ใช้ library
	$('.birthdaypicker').datepicker({
		'format'				: 'd/m/yyyy',
		'autoclose'				: true,
		todayHighlight			: true,
		enableOnReadonly		: false,
		disableTouchKeyboard 	: true,
		autoclose				: true
	});

	//อัพโหลดรูปภาพ - ผู้ใช้ทั่วไป
	function UploadImageCustomer(){
		$('#inputfileuploadImageCustomer').click(); 
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

	//ลงทะเบียนผู้ใช้ทั่วไป
	function UpdateInformationCustomer(){

		//เช็คว่ากรอกข้อมูลครบหรือยัง
		//ไม่ได้กรอกชื่อผู้ใช้
		if($('#regisCustomerFirstname').val() == ''){
			$('#regisCustomerFirstname').focus();
			return;
		}

		//ไม่ได้กรอกเบอร์โทรศัพท์
		if($('#regisCustomerTelephone').val() == ''){
			$('#regisCustomerTelephone').focus();
			return;
		}

		//ไม่ได้กรอกชื่อผู้ใช้เข้าสู่ระบบ
		if($('#regisCustomerLoginID').val() == ''){
			$('#regisCustomerLoginID').focus();
			return;
		}

		//ไม่ได้กรอกรหัสผ่าน
		if($('#regisCustomerPassword').val() == ''){
			$('#regisCustomerPassword').focus();
			return;
		}else{
			//ค่าที่กรอก password น้อยกว่า 6 ตัว
			if($('#regisCustomerPassword').val().length  < 6){
				Swal.fire({
					title: "รหัสผ่านไม่ถูกต้อง",
					text: "รหัสผ่านต้องมีความยาวมากกว่าหรือเท่ากับ 6 หลัก",
					icon: "error",
					showCancelButton: false,
					confirmButtonColor: '#ff6868',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					$('#regisCustomerPassword').val('');
					$('#regisCustomerPassword').focus();
				});
				return;
			}
		}
		

		$.ajax({
			type 			: "POST",
			url 			: "UpdateInformationCustomer",
			data 			: $('#formRegis').serialize(),
			success			: function (Result){
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
					//ผ่าน
					Swal.fire({
						title: 'แก้ไขข้อมูลสำเร็จ',
						text: "",
						icon: "success",
						showCancelButton: false,
						confirmButtonColor: '#bfe6a9',
						confirmButtonText: 'ตกลง',
					}).then(function (result) {
						window.location.href = "main";
					});
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
