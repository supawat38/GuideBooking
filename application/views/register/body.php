<style>	
	/*CSS สำหรับ ปุ่มนักท่องเที่ยว + มัคคุเทศน์ */ 
	.BTNRegis{
		width	:250px; 
		font-family: THSarabunNew;
		font-size:  25px !important;
		border-radius: 0px;
	}

	.BTNRegisActive{
		opacity: 1;
	}

	.BTNRegisDefaule{
		opacity: 0.5;
	}

	/*CSS สำหรับ การเลือกรูปภาพ */ 
	.xCNImgCenter{
		border-radius: 50%;
		width: 300px;
		height: 300px;
		text-align: center;
		display: block;
		margin: 0px auto;
		border: 1px solid #e0e0e0;
	}

	.xCNChooseImage{
		margin: 45px auto;
		display: block;
		padding: 8px 80px !important;
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS สำหรับ กดปุ่มลงทะเบียน */ 
	.BTNConfirmRegis{
		width	:250px; 
		font-family: THSarabunNew;
		font-size:  25px !important;
		border-radius: 0px;
	}

	/*CSS ส่วนของ From ลูกค้าทั่วไป */
	#divRegisCustomer label{
		font-family: THSarabunNew;
		font-size:  25px !important;
		color : black;
	}

	#divRegisCustomer input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	#divRegisCustomer input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS ส่วนของ From มัคคุเทศน์ */
	#divRegisGuide label{
		font-family: THSarabunNew;
		font-size:  25px !important;
		color : black;
	}

	#divRegisGuide input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	#divRegisGuide input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS ส่วนของ From ผู้ดูแลระบบ */
	#divRegisAdmin label{
		font-family: THSarabunNew;
		font-size:  25px !important;
		color : black;
	}

	#divRegisAdmin input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	#divRegisAdmin input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS สำหรับ selected*/ 
	.FontSelect2{
		font-family: THSarabunNew;
		font-size:  22px !important;
	}

	.select2-selection__rendered {
		font-family: THSarabunNew;
		font-size:  22px !important;
	}

	.select2-selection__rendered {
		line-height: 40px !important;
	}

	.select2-container .select2-selection--single {
		height: 40px !important;
	}

	.select2-selection__arrow{
		top : 5px !important;
	}

	.select2-container--default .select2-selection--single{
		border: 1px solid #ced4da;
	}

	.select2-container--default .select2-selection--multiple{
		border: 1px solid #ced4da !important;
	}

	/*CSS สำหรับ หน้าจอแจ้งเตือน */ 
	.swal2-title{
		font-family: THSarabunNew;
		font-size:  30px !important;
	}

	.swal2-html-container{
		font-family: THSarabunNew;
		font-size:  30px !important;
	}

	.swal2-confirm{
		font-family: THSarabunNew;
		font-size:  25px !important;
		padding : 0px 50px;
	}
	

</style>

<!-- เอาไว้เก็บข้อมูล -->
<?php 
if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ 
	$UserType = $this->session->userdata("session_reftype");
	if($UserType == 1){ //ข้อมูลของผู้ดูแลระบบ 
		$ID 		= $dataUser['Items'][0]['admin_id'];
		$FirstName 	= $dataUser['Items'][0]['firstname'];
		$LastName 	= $dataUser['Items'][0]['lastname'];
		$PathImage 	= $dataUser['Items'][0]['admin_image'];
		$Email 		= $dataUser['Items'][0]['admin_email'];
		$Phone 		= $dataUser['Items'][0]['admin_phone'];
		$Status 	= $dataUser['Items'][0]['admin_status'];
		$Username   = $dataUser['Items'][0]['username'];
		$Password   = $dataUser['Items'][0]['password'];
	}else if($UserType == 2){ //ข้อมูลของลูกค้า 
		$ID 		= $dataUser['Items'][0]['cus_id'];
		$FirstName 	= $dataUser['Items'][0]['firstname'];
		$LastName 	= $dataUser['Items'][0]['lastname'];
		$Birthdate	= date('d/m/Y',strtotime($dataUser['Items'][0]['cus_bd']));
		$Gender		= $dataUser['Items'][0]['gender'];
		$Address	= $dataUser['Items'][0]['address'];
		$PathImage 	= $dataUser['Items'][0]['cus_image'];
		$Email 		= $dataUser['Items'][0]['cus_email'];
		$Phone 		= $dataUser['Items'][0]['cus_phone'];
		$Qustions 	= $dataUser['Items'][0]['cus_qustions'];
		$Status     = $dataUser['Items'][0]['cus_status'];
		$Username   = $dataUser['Items'][0]['username'];
		$Password   = $dataUser['Items'][0]['password'];
	}else if($UserType == 3){ //ข้อมูลของมัคคุเทศก์ 
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
		$Status     = $dataUser['Items'][0]['guide_status'];
		$Username   = $dataUser['Items'][0]['username'];
		$Password   = $dataUser['Items'][0]['password'];
	}
}else{
	$UserType 	= '';
	$ID 		= '';
	$FirstName 	= '';
	$LastName 	= '';
	$Birthdate  = date('d/m/Y');
	$Gender		= 1;
	$Address	= '';	
	$Credit		= '';
	$License	= '';
	$Province 	= '';
	$Postcode	= '';
	$Qustions	= '';
	$PathImage 	= '';
	$Email 		= '';
	$Phone 		= '';
	$Profile 	= '';
	$Status 	= 1;
	$Username   = '';
	$Password   = '';
}
?>

<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<form id="formRegis" class="form-signin" method="post" action="javascript:void(0)">

			<!-- กดปุ่มมัคคุเทศน์ เก็บ type ไว้ 1:ผู้ดูแลระบบ , 2:ลงทะเบียนผู้ใช้ทั่วไป , 3:ลงทะเบียนมัคคุเทศน์ -->
			<?php if($this->session->userdata('session_username') == null){
				$TypeRegis = 2;
			}else{
				if($UserType == 1){ //ผู้ดูแลระบบ 
					$TypeRegis = 1;
				}else if($UserType == 2){ //ลูกค้า
					$TypeRegis = 2;
				}else if($UserType == 3){ //มัคคุเทศก์ 
					$TypeRegis = 3;
				}
			} ?>
			<input type="hidden" id="ohdTypeRegis" name="ohdTypeRegis" value="<?=$TypeRegis?>">

			<div class="row">
				<div class="col-lg-12" style="margin:70px;">
					<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
						
						<!--ปุ่มกด-->
						<div class="col-lg-12 p-12">
							<?php if($this->session->userdata('session_username') == null){ //ถ้ายังไม่เคยเข้าสู่ระบบ ?>
								<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisCustomer BTNRegisActive">นักท่องเที่ยว</button>
								<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisGuide BTNRegisDefaule">มัคคุเทศน์</button>
							<?php }else if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ ?>
								<?php if($UserType == 1){ //ผู้ดูแลระบบ ?>
									<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisActive">แก้ไขข้อมูลส่วนตัว ผู้ดูแลระบบ</button>
								<?php }else if($UserType == 2){ //ลูกค้า ?>
									<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisActive">แก้ไขข้อมูลส่วนตัว นักท่องเที่ยว</button>
								<?php }else if($UserType == 3){ //มัคคุเทศก์ ?>
									<button type="button" class="align-self-stretch btn btn-primary BTNRegis BTNRegisActive">แก้ไขข้อมูลส่วนตัว มัคคุเทศน์</button>
								<?php } ?>
							<?php } ?>
						</div>

						<!--เส้นขีดเส้นใต้-->
						<div class="col-lg-12"><hr></div>
						
						<?php 
							if($this->session->userdata('session_username') != null){ //มีคนเข้าสู่ระบบ 
								if($UserType == 1){ //ผู้ดูแลระบบ 
									$DisplayAdmin 		= 'block';
									$DisplayCustomer	= 'none';
									$DisplayGuide		= 'none';
								}else if($UserType == 2){ //ลูกค้า
									$DisplayAdmin 		= 'none';
									$DisplayCustomer	= 'block';
									$DisplayGuide		= 'none';
								}else if($UserType == 3){ //มัคคุเทศก์
									$DisplayAdmin 		= 'none';
									$DisplayCustomer	= 'none';
									$DisplayGuide		= 'block';
								}
								$TextButton = 'แก้ไขข้อมูล';
							}else{
								$TextButton 		= 'ลงทะเบียน';
								$DisplayAdmin 		= 'none';
								$DisplayCustomer	= 'block';
								$DisplayGuide		= 'none';
							}
						?>

						<!--ฟอร์มลงทะเบียนผู้ใช้งาน-->
						<div class="col-lg-12" id="divRegisCustomer" style="margin-top:20px; display:<?=$DisplayCustomer?>;">
							<div class="row">
								<div class="col-lg-4 col-md-4">
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
												<?php if ($Gender == 1) {echo "checked='checked'";} ?> >
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
											<label><span style="color:red;">*</span> ชื่อเข้าใช้งาน</label>
											<input type="text" maxlength="50" class="form-control" id="regisCustomerLoginID" name="regisCustomerLoginID" placeholder="ชื่อเข้าใช้งาน" value='<?=$Username?>'>
										</div>
										<div class="form-group col-md-12">
											<label><span style="color:red;">*</span> รหัสผ่าน</label>
											<input type="password" maxlength="50" class="form-control" id="regisCustomerPassword" name="regisCustomerPassword" placeholder="รหัสผ่าน" value='<?=$Password?>'>
										</div>
										<div class="form-group col-md-12">
											<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="RegisCustomerOrGuideOrAdmin()">ลงทะเบียน</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--ฟอร์มลงทะเบียนมัคคุเทศน์-->
						<div class="col-lg-12" id="divRegisGuide" style="margin-top:20px; display:<?=$DisplayGuide?>;">
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
											<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="RegisCustomerOrGuideOrAdmin()">ลงทะเบียน</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--ฟอร์มลงทะเบียนผู้ดูแลระบบ จะเห็นก็ต่อเมื่อมีการเข้าสู่ระบบเท่านั้น-->
						<div class="col-lg-12" id="divRegisAdmin" style="margin-top:20px; display:<?=$DisplayAdmin?>;">
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
										<div class="form-group col-md-12">
											<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="RegisCustomerOrGuideOrAdmin()"><?=$TextButton?></button>
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
	});

	//กดปุ่มผู้ใช้งาน
	$('.BTNRegisCustomer').click(function(){
		$(this).removeClass('BTNRegisDefaule');
		$(this).addClass('BTNRegisActive');
		$('.BTNRegisGuide').addClass('BTNRegisDefaule');

		$('#divRegisGuide').hide();
		$('#divRegisCustomer').show();

		//กดปุ่มนักท่องเที่ยว เก็บ type ไว้
		$('#ohdTypeRegis').val(1);
	});

	//กดปุ่มมัคคุเทศน์
	$('.BTNRegisGuide').click(function(){
		$(this).removeClass('BTNRegisDefaule');
		$(this).addClass('BTNRegisActive');
		$('.BTNRegisCustomer').addClass('BTNRegisDefaule');

		$('#divRegisGuide').show();
		$('#divRegisCustomer').hide();

		//กดปุ่มมัคคุเทศน์ เก็บ type ไว้
		$('#ohdTypeRegis').val(2);
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

	//อัพโหลดรูปภาพ - มัคคุเทศน์
	function UploadImageGuide(){
		$('#inputfileuploadImageGuide').click(); 
	}

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

	//ลงทะเบียนผู้ใช้ทั่วไป
	function RegisCustomerOrGuideOrAdmin(){

		//เช็คว่ากรอกข้อมูลครบหรือยัง
		var TypeRegis = $('#ohdTypeRegis').val();
		if(TypeRegis == 1){ //ลงทะเบียน - แก้ไขข้อมูลผู้ดูแลระบบ

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
		}else if(TypeRegis == 2){ //ลงทะเบียน - แก้ไขข้อมูลผู้ใช้ทั่วไป

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
		}else if(TypeRegis == 3){ //ลงทะเบียน - แก้ไขข้อมูลมัคคุเทศน์
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
		}

		$.ajax({
			type 			: "POST",
			url 			: "InsertAndEditRegister",
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
					var UserType = '<?=$UserType?>';
					if(UserType == ''){ //ไม่เข้าสู่ระบบ
						var TitleSwal = 'ลงทะเบียนสำเร็จ';
					}else if(UserType != ''){ //เข้าสู่ระบบ
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
