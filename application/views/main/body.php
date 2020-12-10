<style>
	.select2-container--default .select2-selection--single{
		border: 0px solid #aaa;
	}
</style>

<!--การจอง-->
<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="margin-top: 50px; margin-bottom: 25px;">
				<div class="ftco-search d-flex justify-content-center">
					<div class="row">
						<div class="col-md-12 tab-wrap">
							<div class="tab-content" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
									<form action="ResearchGuide" class="search-property-1 FormSearch" method="post">
										<div class="row no-gutters">
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label class="label_formsearch">จังหวัด</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select class="jSelectedsingle form-control" name="provincebooking">
																<?php if($dataprovince['rtCode'] != 800){ ?>
																	<?php foreach($dataprovince['Items'] AS $Key => $Value){ ?>
																		<option value="<?= $Value['province_id'] ?>"><?= $Value['province_name'] ?></option>
																	<?php } ?>
																<?php }else{ ?>
																	<option value="0">ไม่พบข้อมูล</option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label class="label_formsearch">จำนวนคน</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select class="jSelectedsingle form-control" name="personbookig">
																<option value="1-5"> 1 - 5 คน </option>
																<option value="5-10"> 5 - 10 คน </option>
																<option value="10-15"> 10 - 15 คน </option>
																<option value="15++"> มากกว่า 15 คน </option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="#" class="label_formsearch">วันที่การจอง</label>
													<div class="form-field" style="margin-top: 7px;">
														<input type="text" class="form-control checkin_date" name="datestartbooking" value="<?=date('d/m/Y');?>">
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="#" class="label_formsearch">ถึงวันที่</label>
													<div class="form-field" style="margin-top: 7px;">
														<input type="text" class="form-control checkout_date" name="datestopbooking" value="<?=date('d/m/Y');?>">
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<input type="submit" value="ค้นหามัคคุเทศก์" class="align-self-stretch form-control btn btn-primary label_formsearch">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--ส่วนของจุดเด่นเว็บเรา-->
<section class="ftco-section services-section" style="padding:3em 0 0em 0 !important;">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
				<div class="w-100">
					<h2 class="mb-4 textMain_Show">Friend Travel</h2>
					<p class="labelHead">เว็บจองมัคคุเทศก์ ที่มีมัคคุเทศก์ให้เลือกมากมายหลายสไตล์ ล้วนมีประสบการณ์ และระบบการจองง่าย เพียง 3 Step เข้าถึงระบบการชำระเงิน พร้อมมีผู้ดูแลระบบคอยดูแลท่านตลอด 24 ชั่วโมง หากติดปัญหาติดต่อ 02-944-4xxx(คุณกี้)</p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-4 d-block img" style="background-image: url(application/assets/images/services-1.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><div class="BookingWait" style="background-image: url(application/assets/images/icon/IMG_Customer.png);"></div></div>
							<div class="media-body">
								<h3 class="heading mb-3 labelHead" style="color: #FFF; font-weight: bold;">มัคคุเทศก์</h3>
								<p class="labelHead" style="color: #FFF; font-weight: bold;">มีมัคคุเทศก์ในระบบให้เลือกหลากหลายคน ล้วนมากประสบการณ์</p>
							</div>
						</div>      
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-2 d-block img" style="background-image: url(application/assets/images/services-2.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><div class="BookingWait" style="background-image: url(application/assets/images/icon/IMG_Comment.png);"></div></div>
							<div class="media-body">
								<h3 class="heading mb-3 labelHead" style="color: #FFF; font-weight: bold;">แสดงความคิดเห็น</h3>
								<p class="labelHead" style="color: #FFF; font-weight: bold;">จะดูคะแนน หรือ รีวิวมัคคุเทศก์ตามความพึงพอใจในแบบของคุณ โดยไม่เปิดเผยตัวตน</p>
							</div>
						</div>    
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-3 d-block img" style="background-image: url(application/assets/images/services-3.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><div class="BookingWait" style="background-image: url(application/assets/images/icon/IMG_Booking.png);"></div></div>
							<div class="media-body">
								<h3 class="heading mb-3 labelHead" style="color: #FFF; font-weight: bold;">การจอง</h3>
								<p class="labelHead" style="color: #FFF; font-weight: bold;">ระบบจองใช้งานง่าย เพียง 3 Step จะจัดสรรหามัคคุเทศก์ที่ไลฟ์สไตล์เหมือนนที่คุณต้องการ</p>
							</div>
						</div>      
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-4 d-block img" style="background-image: url(application/assets/images/services-4.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><div class="BookingWait" style="background-image: url(application/assets/images/icon/IMG_Pay.png);"></div></div>
							<div class="media-body">
								<h3 class="heading mb-3 labelHead" style="color: #FFF; font-weight: bold;">การชำระเงิน</h3>
								<p class="labelHead" style="color: #FFF; font-weight: bold;">มีพนักงานคอยตรวจสอบการชำระเงินของคุณ พร้อมทั้งเตรียมแก้ไขปัญหาตลอด 24 ชั่วโมง</p>
							</div>
						</div>      
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--แพ็กเกจ-->
<section class="ftco-section" style="padding:3em 0 7em 0 !important;">
	<div class="container">
		<div><hr></div>
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate" style="margin-top: 50px;">
				<h2 class="mb-4 textMain_Show">แพ็กเกจแนะนำ</h2>
			</div>
		</div>
		<div class="ContentPackage"></div>
	</div>
</section>

<!--ความคิดเห็นจากลูกค้า-->
<section class="ftco-section testimony-section bg-bottom" style="background-image: url(application/assets/images/bg_1.jpg);">
	<div class="overlays" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #207ce5 0%, #13d42a 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#207ce5', endColorstr='#13d42a', GradientType=1 ); opacity: .6;"></div>
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
				<h2 class="mb-4 textMain_Show">ความคิดเห็นจากลูกค้า</h2>
			</div>
		</div>
		<div class="ContentReviewGuide"></div> 
	</div>
</section>

<!--มัคคุเทศก์ยอดนิยม-->
<section class="ftco-section img ftco-select-destination">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4 textMain_Show">มัคคุเทศก์ยอดนิยม</h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php 
					if(empty($guidepoppular['Items'])){
						$ClassCSS 			= "carousel-destination owl-carousel ftco-animate";
						$ClassSubCss    	= "";
					}else{
						if(count($guidepoppular['Items']) >= 4){
							$ClassCSS 		= "carousel-destination owl-carousel ftco-animate";
							$ClassSubCss    = "";
						}else{
							$ClassCSS 		= "row";
							$ClassSubCss 	= "col-lg-4 col-md-4";
						}
					}
				?>
				<div class="<?=$ClassCSS?>">
					<?php if(empty($guidepoppular['Items'])){ ?>
						<div class="img" style="
							background-image: url(application/assets/images/comingsoon.png); width: 100%;
							height: 220px;
							background-position: top;
							background-size: contain;
							background-repeat: repeat-x;"></div>
					<?php }else{ ?>
						<?php foreach($guidepoppular['Items'] AS $Key => $Value){ ?>
							<div class="item <?=$ClassSubCss?>">
								<div class="project-destination">
									<?php 
										$PathImage = $Value['guide_image'];
										if($PathImage == '' || $PathImage == null){
											$PathShowImage 		= base_url('/application/assets/images/guide/') . 'NoImage.png';
										}else{
											$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
										}
										$Image = "background-image: url($PathShowImage);"; 
									?>
									<a href="#" class="img" style="<?=$Image?>">
										<div class="text">
											<h3 class="labelHead">คุณ<?= $Value['firstname']?> <?= $Value['lastname']?></h3>
											<span class="labelHead"><?=$Value['COUNTCOMMENT']?> คะแนน</span>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!--โหลดไฟล์ script หน้า body-->
<?php include __DIR__ . '/../footer.php';?>

<script>
	$(document).ready(function() {
		//ช่องจังหวัด + ช่องจำนวนคน
		$(".jSelectedsingle").select2();
		$(".jSelectedsingle").select2({ width: 'resolve' , dropdownCssClass: "FontSelect2"});  

	});

	//โหลดหน้าตารางส่วนของ package
	LoadTable_package(1);
	function LoadTable_package(numberpage){
		$.ajax({
			type	: "POST",
			url		: "Loadtable_package_mainpage",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('.ContentPackage').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//โหลดหน้าตารางส่วนของ review Guide
	LoadTable_reviewGuide(1);
	function LoadTable_reviewGuide(numberpage){
		$.ajax({
			type	: "POST",
			url		: "Loadtable_reviewguide",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('.ContentReviewGuide').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
</script>

