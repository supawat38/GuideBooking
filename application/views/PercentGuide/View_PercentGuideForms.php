<?php
	if($typepage == 'pageedit'){
		$ID 				= $Result['Items'][0]['guide_id'];
		$FirstName 			= $Result['Items'][0]['firstname'];
		$LastName 			= $Result['Items'][0]['lastname'];
		$Birthdate			= date('d/m/Y',strtotime($Result['Items'][0]['guide_bd'])); 
		$Gender				= $Result['Items'][0]['gender'];
		$Address			= $Result['Items'][0]['address'];
		$Credit 			= $Result['Items'][0]['guide_credit'];
		$License 			= $Result['Items'][0]['guide_license'];
		$Province 			= $Result['Items'][0]['ProvinceGuide'];	
		$Postcode 			= $Result['Items'][0]['postcode'];
		$PathImage 			= $Result['Items'][0]['guide_image'];
		$Email 				= $Result['Items'][0]['guide_email'];
		$Phone 				= $Result['Items'][0]['guide_phone'];
		$Profile 			= $Result['Items'][0]['intro_profile'];
		$TextQuestion		= $Result['Items'][0]['guide_qustions'];
		$Status     		= $Result['Items'][0]['guide_status'];
		$guide_gp			= $Result['Items'][0]['guide_gp'];
		$TextButton 		= 'แก้ไขข้อมูล';

		$TextArea	= '';
		for($i=0; $i<count($Result['Items']); $i++){
			$TextArea .= $Result['Items'][$i]['province_id'] . ',';

			//ถ้าวนลูปจนถึงตัวสุดท้ายเเล้ว ให้ ลบ , ตัวสุดท้ายออก
			if($i == count($Result['Items'])-1){
				$TextArea = substr($TextArea,0,-1);
			}
		}
	}
?>

<!--ฟอร์มแก้ไข-->
<div class="col-lg-12"><hr></div>
<form id="formPercentGuide" class="form-signin" method="post" action="javascript:void(0)">
	<div class="col-lg-12" id="divPercentGuide" >
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
				<div class="form-row">

					<input type="hidden" id="hiddenTypePage" name="hiddenTypePage" value="<?=$typepage?>">
					<input type="hidden" id="hiddenGuideID" name="hiddenGuideID" value="<?=$ID?>">

					<div class="form-group col-md-12" style="    border: 1px solid #e3e3e3; padding: 21px; background: #f8f8f8;">
						<label><span style="color:red;">*</span> แบ่งสัดส่วน % (ห้ามกรอกตัวเลขเกิน 100)</label>
						<input type="text" maxlength="3" class="form-control xCNInputNumericWithoutDecimal" id="regisGuidePercent" name="regisGuidePercent" placeholder="0" value="<?=$guide_gp?>">
					</div>

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
						<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="EventSaveOrEdit_percentGuide()"><?=$TextButton?></button>
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

		//ห้ามกรอกเกิน 100
		$('#regisGuidePercent').keypress(function() {
			var nValue = $(this).val();
			if(nValue > 100){
				$(this).val(100);
			}
		});

		//ห้ามกรอกเกิน 100
		$('#regisGuidePercent').blur(function() {
			var nValue = $(this).val();
			if(nValue > 100){
				$(this).val(100);
			}
		});
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

	//เพิ่มข้อมูล
	function EventSaveOrEdit_percentGuide(){
		//เช็คว่ากรอกข้อมูลครบหรือยัง

		//ไม่ได้กรอกเรทราคา
		if($('#rateprice').val() == ''){
			$('#rateprice').focus();
			return;
		}

		$.ajax({
			type 			: "POST",
			url 			: "EventInsOrEdit_percentguide",
			data 			: $('#formPercentGuide').serialize(),
			success			: function (Result){
				if('<?=$typepage?>' == 'pageinsert'){ 
					var TitleSwal = 'เพิ่มข้อมูลสำเร็จ';
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
					Back_percentguide();
				});
				
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
