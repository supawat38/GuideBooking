<!-- เอาไว้เก็บข้อมูล -->
<?php 
if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ 
	$UserType = $this->session->userdata("session_reftype");
	if($UserType == 3){ //ข้อมูลมัคคุเทศก์
		$ID 		= $dataUser['Items'][0]['guide_id'];
		$FirstName 	= $dataUser['Items'][0]['firstname'];
		$LastName 	= $dataUser['Items'][0]['lastname'];
		$Birthdate	= date('d/m/Y',strtotime($dataUser['Items'][0]['guide_bd'])); 
		$Gender		= $dataUser['Items'][0]['gender'];
		$Address	= $dataUser['Items'][0]['address'];
		$Credit 	= $dataUser['Items'][0]['guide_credit'];
		$License 	= $dataUser['Items'][0]['guide_license'];
		$Province 	= $dataUser['Items'][0]['ProvinceGuide'];		
		$Postcode 	= $dataUser['Items'][0]['postcode'];
		$PathImage 	= $dataUser['Items'][0]['guide_image'];
		$Email 		= $dataUser['Items'][0]['guide_email'];
		$Phone 		= $dataUser['Items'][0]['guide_phone'];
		$Profile 	= $dataUser['Items'][0]['intro_profile'];
		$TextQuestion	= $dataUser['Items'][0]['guide_qustions'];
		$Status     	= $dataUser['Items'][0]['guide_status'];
		$Username   	= $dataUser['Items'][0]['username'];
		$Password   	= $dataUser['Items'][0]['password'];

		$TextArea	= '';
		for($i=0; $i<count($dataUser['Items']); $i++){
			$TextArea .= $dataUser['Items'][$i]['province_id'] . ',';

			//ถ้าวนลูปจนถึงตัวสุดท้ายเเล้ว ให้ ลบ , ตัวสุดท้ายออก
			if($i == count($dataUser['Items'])-1){
				$TextArea = substr($TextArea,0,-1);
			}
		}
	}
}
?>



<form id="formRegis" class="form-signin" method="post" action="javascript:void(0)">

	<!-- กดปุ่มมัคคุเทศก์ เก็บ type ไว้ 1:ผู้ดูแลระบบ , 2:ลงทะเบียนผู้ใช้ทั่วไป , 3:ลงทะเบียนมัคคุเทศก์ -->
	<input type="hidden" id="ohdTypeRegis" name="ohdTypeRegis" value="3">

	<div class="row">
		<div class="col-lg-12" style="margin:10px 0px;">
			<div class="row">
				
				<!--ปุ่มกด-->
				<div class="col-lg-6 p-6">
					<label class="labelHead" >แก้ไขข้อมูลส่วนตัว มัคคุเทศก์</label>
				</div>

				<div class="col-lg-6 col-6">
					<a class="labelHead" href="Booking_DeteilGuide/<?=$ID?>" target="_blank">
						<label class="labelHead textActiveMenuBar" style="text-align: right; display: block;">ดูคะแนน และรีวิว</label>
					</a>
				</div>

				<!--เส้นขีดเส้นใต้-->
				<div class="col-lg-12"><hr></div>

				<!--ฟอร์มลงทะเบียนมัคคุเทศก์-->
				<div class="col-lg-12" id="divRegisGuide" style="margin-top:0px;">
					<div class="row">
						<div class="col-lg-4 col-md-12">
							<?php 
								if($PathImage == '' || $PathImage == null){
									$PathShowImage 		= base_url('/application/assets/images/guide/') . '/NoImage.png';
									$PathDatabaseImage 	= '';
								}else{
									$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
									$PathDatabaseImage 	= $PathImage;
								} ?>

							<img id="ImgInsertGuide" class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
							<input type="hidden" id="hiddenImgInsertGuide" name="hiddenImgInsertGuide" value="<?=$PathDatabaseImage?>">
							<button type="button" class="btn btn-outline-secondary xCNChooseImage" onclick="UploadImageGuide()">เลือกรูปภาพ</button>
							<input type="file" id="inputfileuploadImageGuide" style="display:none;"  name="inputfileuploadImageGuide" accept="image/*" onchange="ImageUplodeResize(this,'images/Guide','ImgInsertGuide')">
						</div>
						<div class="col-lg-8 col-md-8">
							<input type="hidden" id="hiddenGuideID" name="hiddenGuideID" value="<?=$ID?>">
							<input type="hidden" id="hiddenGuidePassword" name="hiddenGuidePassword" value="<?=$Password?>">

							<div class="form-row">
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> ชื่อ</label>
									<input type="text" maxlength="50" class="form-control" id="regisGuideFirstname" name="regisGuideFirstname" placeholder="ชื่อ" value="<?=$FirstName?>">
								</div>
								<div class="form-group col-md-12">
									<label>นามสกุล</label>
									<input type="text" maxlength="50" class="form-control" id="regisGuideLastname" name="regisGuideLastname" placeholder="นามสกุล" value="<?=$LastName?>">
								</div>
								<div class="form-group col-md-12">
									<label style="margin-right:10px;">เพศ</label>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="regisGuideGenter" id="radioMaleGuide" value="1" 
										<?php if ($Gender == 1) {echo "checked='checked'";} ?> >
										<label class="form-check-label" for="radioMaleGuide">
											ชาย
										</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="regisGuideGenter" id="radioFemaleGuide" value="2"
										<?php if ($Gender == 2) {echo "checked='checked'";} ?> >
										<label class="form-check-label" for="radioFemaleGuide">
											หญิง
										</label>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label>วันเกิด</label>
									<input type="text" class="form-control birthdaypicker" id="regisGuideBirthday" name="regisGuideBirthday" value="<?=$Birthdate?>" placeholder="<?=date('d/m/Y');?>">
								</div>
								<div class="form-group col-md-12">
									<label>อีเมลล์</label>
									<input type="text" maxlength="50" class="form-control" id="regisGuideEmail" name="regisGuideEmail"  placeholder="อีเมลล์" value='<?=$Email?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> รหัสประจำตัวบัตรประชาชน</label>
									<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideCredit" name="regisGuideCredit"  placeholder="รหัสประจำตัวบัตรประชาชน" value='<?=$Credit?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> เลขที่ใบอนุญาต</label>
									<input type="text" maxlength="50" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideLicense" name="regisGuideLicense"  placeholder="เลขที่ใบอนุญาต" value='<?=$License?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> เบอร์โทร</label>
									<input type="text" maxlength="20" class="form-control xCNInputNumericWithoutDecimal" id="regisGuideTelephone" name="regisGuideTelephone" placeholder="เบอร์โทร" value='<?=$Phone?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> จังหวัด</label>	
									<select class="jSelectedsingle form-control" name="regisGuideProvince">
										<?php if($dataprovince['rtCode'] != 800){ ?>
											<?php foreach($dataprovince['Items'] AS $Key => $Value){ ?>
												<option <?php if($Province == $Value['province_id']) {echo "selected='selected'";} ?>  value="<?= $Value['province_id'] ?>"><?= $Value['province_name'] ?></option>
											<?php } ?>
										<?php }else{ ?>
											<option value="0">ไม่พบข้อมูล</option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label>รหัสไปรษณีย์</label>
									<input type="text" maxlength="6" class="form-control xCNInputNumericWithoutDecimal" id="regisGuidePostCode" name="regisGuidePostCode" placeholder="รหัสไปรษณีย์" value='<?=$Postcode?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> จังหวัดให้บริการ (สามารถเลือกได้มากกว่า 1 ข้อ)</label>	
									<select class="jSelectedmultiple jProvince form-control" name="regisGuideArea[]" id="regisGuideArea" multiple="multiple">
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
									<label>สิ่งที่คุณสนใจ (สามารถเลือกได้มากกว่า 1 ข้อ)</label>	
									<select class="jSelectedmultiple jQuestion form-control" name="regisGuideQuestion[]" multiple="multiple">
										<option value="ภูเขา">ภูเขา</option>
										<option value="ทะเล">ทะเล</option>
										<option value="แม่น้ำ">แม่น้ำ</option>
										<option value="วัด">วัด</option>
										<option value="ช็อปปิ้ง">ช็อปปิ้ง</option>
										<option value="ห้างสรรพสินค้า">ห้างสรรพสินค้า</option>
										<option value="ทะเลหมอก">ทะเลหมอก</option>
										<option value="อันดามัน">อันดามัน</option>
										<option value="ปืนเขา">ปืนเขา</option>
										<option value="น้ำตก">น้ำตก</option>
										<option value="ธรรมชาติ">ธรรมชาติ</option>
										<option value="ประวัติศาสตร์">ประวัติศาสตร์</option>
										<option value="ศิลปะวิทยาการ">ศิลปะวิทยาการ</option>
										<option value="เชิงนิเวศ">เชิงนิเวศ</option>
										<option value="ธรรมชาติ">ธรรมชาติ</option>
										<option value="วัฒนธรรม">วัฒนธรรม</option>
										<option value="น้ำพุร้อน">น้ำพุร้อน</option>
										<option value="ถ้ำ">ถ้ำ</option>
										<option value="เกาะ">เกาะ</option>
										<option value="แก่ง">แก่ง</option>
										<option value="สวนสัตว์">สวนสัตว์</option>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label>ที่อยู่</label>	
									<textarea maxlength="255" id="regisGuideAddress" name="regisGuideAddress" cols="30" rows="3" class="form-control" placeholder="ที่อยู่"><?=$Address?></textarea>
								</div>
								<div class="form-group col-md-12">
									<label>คำอธิบายเพิ่มเติมเกี่ยวกับตัวเอง</label>	
									<textarea maxlength="255" id="regisGuideAbout" name="regisGuideAbout" cols="30" rows="3" class="form-control" placeholder="คำอธิบายเพิ่มเติมเกี่ยวกับตัวเอง"><?=$Profile?></textarea>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> ชื่อเข้าใช้งาน</label>
									<input type="text" maxlength="50" class="form-control" id="regisGuideLoginID" name="regisGuideLoginID" placeholder="ชื่อเข้าใช้งาน" value='<?=$Username?>'>
								</div>
								<div class="form-group col-md-12">
									<label><span style="color:red;">*</span> รหัสผ่าน</label>
									<input type="password" maxlength="50" class="form-control" id="regisGuidePassword" name="regisGuidePassword" placeholder="รหัสผ่าน" value='<?=$Password?>'>
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

		//split จังหวัดที่ให้บริการ
		var TextArea 		= '<?=$TextArea?>';
		if(TextArea != '' || TextArea != null){
			var arrayTextArea 	= TextArea.split(",");
			$(".jProvince").val(arrayTextArea).change();
		}

		//split คำถาม
		var TextQuestion 		= '<?=$TextQuestion?>';
		if(TextQuestion != '' || TextQuestion != null){
			var arrayTextQuestion 	= TextQuestion.split(",");
			$(".jQuestion").val(arrayTextQuestion).change();
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
						//window.location.href = "main";
					});
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
