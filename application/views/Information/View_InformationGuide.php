<!-- เอาไว้เก็บข้อมูล -->
<?php 
if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ 
	$UserType = $this->session->userdata("session_reftype");
	if($UserType == 3){ //ข้อมูลมัคคุเทศก์
		$ID 		= $dataUser['Items'][0]['guide_id'];
		$FirstName 	= $dataUser['Items'][0]['firstname'];
		$LastName 	= $dataUser['Items'][0]['lastname'];
		$Birthdate	= $dataUser['Items'][0]['guide_bd'];
		$Gender		= $dataUser['Items'][0]['gender'];
		$Address	= $dataUser['Items'][0]['address'];
		$Credit 	= $dataUser['Items'][0]['guide_credit'];
		$License 	= $dataUser['Items'][0]['guide_license'];
		$Province 	= $dataUser['Items'][0]['province_id'];
		$Postcode 	= $dataUser['Items'][0]['postcode'];
		$PathImage 	= $dataUser['Items'][0]['guide_image'];
		$Email 		= $dataUser['Items'][0]['guide_email'];
		$Phone 		= $dataUser['Items'][0]['guide_phone'];
		$Profile 	= $dataUser['Items'][0]['intro_profile'];
		$Qustions	= '';
		$Status     = $dataUser['Items'][0]['guide_status'];
		$Username   = $dataUser['Items'][0]['username'];
		$Password   = $dataUser['Items'][0]['password'];
	}
}
?>

<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<form id="formRegis" class="form-signin" method="post" action="javascript:void(0)">

			<!-- กดปุ่มมัคคุเทศก์ เก็บ type ไว้ 1:ผู้ดูแลระบบ , 2:ลงทะเบียนผู้ใช้ทั่วไป , 3:ลงทะเบียนมัคคุเทศก์ -->
			<input type="hidden" id="ohdTypeRegis" name="ohdTypeRegis" value="3">

			<div class="row">
				<div class="col-lg-12" style="margin:70px;">
					<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
						
						<!--ปุ่มกด-->
						<div class="col-lg-12 p-12">
							<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisActive">แก้ไขข้อมูลส่วนตัว มัคคุเทศก์</button>
						</div>

						<!--เส้นขีดเส้นใต้-->
						<div class="col-lg-12"><hr></div>

						<!--ฟอร์มลงทะเบียนมัคคุเทศก์-->
						<div class="col-lg-12" id="divRegisGuide" style="margin-top:20px;">
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<?php $PathShowImage = './application/assets/images/guide/NoImage.png'; ?>
									<img id="ImgInsertGuide" class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
									<input type="hidden" id="hiddenImgInsertGuide" name="hiddenImgInsertGuide" value="">
									<button type="button" class="btn btn-outline-secondary xCNChooseImage" onclick="UploadImageGuide()">เลือกรูปภาพ</button>
									<input type="file" id="inputfileuploadImageGuide" style="display:none;"  name="inputfileuploadImageGuide" accept="image/*" onchange="ImageUplodeResize(this,'images/Guide','ImgInsertGuide')">
								</div>
								<div class="col-lg-8 col-md-8">
									<div class="form-row">
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> ชื่อ</label>
											<input type="text" maxlength="50" class="form-control" id="regisGuideFirstname" name="regisGuideFirstname" placeholder="ชื่อ">
										</div>
										<div class="form-group col-md-12">
											<label>นามสกุล</label>
											<input type="text" maxlength="50" class="form-control" id="regisGuideLastname" name="regisGuideLastname" placeholder="นามสกุล">
										</div>
										<div class="form-group col-md-12">
											<label style="margin-right:10px;">เพศ</label>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="regisGuideGenter" id="radioMaleGuide" value="1" checked>
												<label class="form-check-label" for="radioMaleGuide">
													ชาย
												</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="regisGuideGenter" id="radioFemaleGuide" value="2">
												<label class="form-check-label" for="radioFemaleGuide">
													หญิง
												</label>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>วันเกิด</label>
											<input type="text" class="form-control birthdaypicker" id="regisGuideBirthday" name="regisGuideBirthday" value="<?=date('d/m/Y');?>" placeholder="<?=date('d/m/Y');?>">
										</div>
										<div class="form-group col-md-12">
											<label>อีเมลล์</label>
											<input type="text" maxlength="50" class="form-control" id="regisGuideEmail" name="regisGuideEmail"  placeholder="อีเมลล์">
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> รหัสประจำตัวบัตรประชาชน</label>
											<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideCredit" name="regisGuideCredit"  placeholder="รหัสประจำตัวบัตรประชาชน">
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> เลขที่ใบอนุญาต</label>
											<input type="text" maxlength="50" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideLicense" name="regisGuideLicense"  placeholder="เลขที่ใบอนุญาต">
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> เบอร์โทร</label>
											<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideTelephone" name="regisGuideTelephone" placeholder="เบอร์โทร">
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> จังหวัด</label>	
											<select class="jSelectedsingle form-control" name="regisGuideProvince">
												<?php if($dataprovince['rtCode'] != 800){ ?>
													<?php foreach($dataprovince['Items'] AS $Key => $Value){ ?>
														<option value="<?= $Value['province_id'] ?>"><?= $Value['province_name'] ?></option>
													<?php } ?>
												<?php }else{ ?>
													<option value="0">ไม่พบข้อมูล</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> จังหวัดให้บริการ (สามารถเลือกได้มากกว่า 1 ข้อ)</label>	
											<select class="jSelectedmultiple form-control" name="regisGuideArea[]" id="regisGuideArea" multiple="multiple">
												<?php if($dataprovince['rtCode'] != 800){ ?>
													<?php foreach($dataprovince['Items'] AS $Key => $Value){ ?>
														<option value="<?= $Value['province_id'] ?>"><?= $Value['province_name'] ?></option>
													<?php } ?>
												<?php }else{ ?>
													<option value="0">ไม่พบข้อมูล</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>รหัสไปรษณีย์</label>
											<input type="text" maxlength="6" class="form-control xCNInputNumericWithoutDecimal" id="regisGuidePostCode" name="regisGuidePostCode" placeholder="รหัสไปรษณีย์">
										</div>
										<div class="form-group col-md-12">
											<label>ที่อยู่</label>	
											<textarea maxlength="255" id="regisGuideAddress" name="regisGuideAddress" cols="30" rows="3" class="form-control" placeholder="ที่อยู่"></textarea>
										</div>
										<div class="form-group col-md-12">
											<label>คำอธิบายเพิ่มเติมเกี่ยวกับตัวเอง</label>	
											<textarea maxlength="255" id="regisGuideAbout" name="regisGuideAbout" cols="30" rows="3" class="form-control" placeholder="คำอธิบายเพิ่มเติมเกี่ยวกับตัวเอง"></textarea>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> ชื่อเข้าใช้งาน</label>
											<input type="text" maxlength="50" class="form-control" id="regisGuideLoginID" name="regisGuideLoginID" placeholder="ชื่อเข้าใช้งาน">
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> รหัสผ่าน</label>
											<input type="password" maxlength="50" class="form-control" id="regisGuidePassword" name="regisGuidePassword" placeholder="รหัสผ่าน">
										</div>
										<div class="form-group col-md-12">
											<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="UpdateInformationGuide()">แก้ไขข้อมูล</button>
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

<!--โหลดไฟล์ footer พวก script-->
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

	//อัพโหลดรูปภาพ - มัคคุเทศก์
	function UploadImageGuide(){
		$('#inputfileuploadImageGuide').click(); 
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
	function UpdateInformationGuide(){

		//ไม่ได้กรอกชื่อ
		if($('#regisGuideFirstname').val() == ''){
			$('#regisGuideFirstname').focus();
			return;
		}

		//ไม่ได้กรอกรหัสประจำตัวบัตรประชาชน
		if($('#regisGuideCredit').val() == ''){
			$('#regisGuideCredit').focus();
			return;
		}

		//ไม่ได้กรอกเลขที่ใบอนุญาต
		if($('#regisGuideLicense').val() == ''){
			$('#regisGuideLicense').focus();
			return;
		}

		//ไม่ได้กรอกเบอร์โทร
		if($('#regisGuideTelephone').val() == ''){
			$('#regisGuideTelephone').focus();
			return;
		}

		//ไม่ได้กรอกจังหวัดให้บริการ
		if($('#regisGuideArea').val() == ''){
			$('.jSelectedmultiple').select2('open');
			return;
		}

		//ไม่ได้กรอกชื่อผู้ใช้เข้าสู่ระบบ
		if($('#regisGuideLoginID').val() == ''){
			$('#regisGuideLoginID').focus();
			return;
		}

		//ไม่ได้กรอกรหัสผ่าน
		if($('#regisGuidePassword').val() == ''){
			$('#regisGuidePassword').focus();
			return;
		}else{
			//ค่าที่กรอก password น้อยกว่า 6 ตัว
			if($('#regisGuidePassword').val().length  < 6){
				Swal.fire({
					title: "รหัสผ่านไม่ถูกต้อง",
					text: "รหัสผ่านต้องมีความยาวมากกว่าหรือเท่ากับ 6 หลัก",
					icon: "error",
					showCancelButton: false,
					confirmButtonColor: '#ff6868',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					$('#regisGuidePassword').val('');
					$('#regisGuidePassword').focus();
				});
				return;
			}
		}

		$.ajax({
			type 			: "POST",
			url 			: "UpdateInformationGuide",
			data 			: $('#formRegis').serialize(),
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
