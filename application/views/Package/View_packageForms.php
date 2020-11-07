<?php
	if($typepage == 'pageinsert'){
		$package_id 		= '';
		$guide_id 			= '';
		$package_file	 	= '';
		$package_name 		= '';
		$package_con 		= '';
		$package_image 		= '';
		$package_status 	= 1;
		$TextButton 		= 'สร้างแพ็กเกจ';
	}else if($typepage == 'pageedit'){
		$package_id 		= $Result['Items'][0]['package_id'];
		$guide_id 			= $Result['Items'][0]['guide_id'];
		$package_file	 	= $Result['Items'][0]['package_file'];
		$package_name 		= $Result['Items'][0]['package_name'];
		$package_con 		= $Result['Items'][0]['package_con'];
		$package_image 		= $Result['Items'][0]['package_image'];
		$package_status 	= $Result['Items'][0]['package_status'];
		$TextButton 		= 'แก้ไขข้อมูล';
	}
?>

<!--ฟอร์มแพ็กเกจ-->
<div class="col-lg-12"><hr></div>
<form id="formpackage" class="form-signin" method="post" action="javascript:void(0)">
	<div class="col-lg-12" id="divRegispackage" style="margin-top:20px;">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<?php 
					if($package_image == '' || $package_image == null){
						$PathShowImage 		= base_url('/application/assets/images/package/') . '/NoImage.jpg';
						$PathDatabaseImage 	= '';
					}else{
						$PathShowImage 		= base_url('/application/assets/images/package/') . $package_image;
						$PathDatabaseImage 	= $package_image;
					} ?>
				<img id="ImgInsertPackage" class="img-responsive xCNImgCenterBox" src="<?=$PathShowImage?>">
				<input type="hidden" id="hiddenImgInsertPackage" name="hiddenImgInsertPackage" value="<?=$PathDatabaseImage?>">
				<button type="button" class="btn btn-outline-secondary xCNChooseImage" onclick="UploadImagePackage()">เลือกรูปภาพ</button>
				<input type="file" id="inputfileuploadImagePackage" style="display:none;"  name="inputfileuploadImagePackage" accept="image/*" onchange="ImageUplodeResize(this,'images/package','ImgInsertPackage')">
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="form-row">

					<input type="hidden" id="hiddenTypePage" name="hiddenTypePage" value="<?=$typepage?>">
					<input type="hidden" id="hiddenPackageID" name="hiddenPackageID" value="<?=$package_id?>">

					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> ชื่อแพ็กเกจ</label>
						<input type="text" maxlength="100" class="form-control" id="regisPackageName" name="regisPackageName" placeholder="ชื่อแพ็กเกจ" value='<?=$package_name?>' >
					</div>
					<div class="form-group col-md-12" style="margin-bottom:30px;">
						<label>ไฟล์เอกสาร</label>
						<div class="custom-file">
							<input type="file" onchange="UplodeFilePackage(this)" id="regisPackageFile" accept="application/pdf,application/msword,
  							application/vnd.openxmlformats-officedocument.wordprocessingml.document">
							<label class="custom-file-label" for="regisPackageFile">เลือกไฟล์ (รองรับนามสกุล PDT และ Microsoft Word)</label>
							<input type="hidden" name="regisPackageFileName" id="regisPackageFileName">
						</div>
					</div>
					<div class="form-group col-md-12">
						<label>เงื่อนไข</label>	
						<textarea id="regisPackageCon" maxlength="100" name="regisPackageCon" cols="30" rows="3" class="form-control" placeholder="เงื่อนไข"><?=$package_con?></textarea>
					</div>
					<div class="form-check" style="margin-left: 5px;">
						<input type="checkbox" class="form-check-input" name="regisPackageStatusUse" id="regisPackageStatusUse" style="width: 15px; height: 15px; top: 2px;" 	<?php if ($package_status == 1) {echo "checked='checked'";} ?> >
						<label class="form-check-label" style="margin-left: 10px; margin-bottom: 10px; font-size: 22px !important;">สถานะใช้งาน</label>
					</div>
					<div class="form-group col-md-12">
						<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="EventSaveOrEdit_Package()"><?=$TextButton?></button>
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
	function UploadImagePackage(){
		$('#inputfileuploadImagePackage').click(); 
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

	//อัพโหลดไฟล์
	function UplodeFilePackage(poFile){
		myfile	= $('#regisPackageFile').val();
		var ext = myfile.split('.').pop();
		if(ext=="pdf" || ext=="docx" || ext=="doc"){
			var objectData = $('#regisPackageFile').prop('files')[0];
			var objectFile = new FormData();
			objectFile.append('file',objectData);
			
			$.ajax({
				type 		: "POST",
				url 		: "FileUpload",
				cache 		: false,
				contentType	: false,
				processData	: false,
				data 		: objectFile,
				datatype	: "JSON",
				success: function (Result){
					var fileName = $('#regisPackageFile').val().split("\\").pop();
					$('#regisPackageFile').siblings(".custom-file-label").addClass("selected").html(fileName);
					$('#regisPackageFileName').val(fileName);
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

	//สร้างแพ็กเกจ
	function EventSaveOrEdit_Package(){
		//เช็คว่ากรอกข้อมูลครบหรือยัง

		//ไม่ได้กรอกชื่อ
		if($('#regisPackageName').val() == ''){
			$('#regisPackageName').focus();
			return;
		}

		$.ajax({
			type 			: "POST",
			url 			: "EventInsOrEdit_package",
			data 			: $('#formpackage').serialize(),
			success			: function (Result){
				if('<?=$typepage?>' == 'pageinsert'){ 
					var TitleSwal = 'สร้างแพ็กเกจสำเร็จ';
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
					LoadTable_package();
				});
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
