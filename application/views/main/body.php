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

<!--ส่วนของตารางการจอง-->
<section class="ftco-section services-section">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
				<div class="w-100">
					<h2 class="mb-4 textMain_Show">ส่วนของตารางการจอง</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-1 d-block img" style="background-image: url(images/services-1.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Wait</h3>
								<p></p>
							</div>
						</div>      
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-2 d-block img" style="background-image: url(images/services-2.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Wait</h3>
								<p></p>
							</div>
						</div>    
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-3 d-block img" style="background-image: url(images/services-3.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Wait</h3>
								<p></p>
							</div>
						</div>      
					</div>
					<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
						<div class="services services-1 color-4 d-block img" style="background-image: url(images/services-4.jpg);">
							<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Wait</h3>
								<p></p>
							</div>
						</div>      
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--มัคคุเทศก์ยอดนิยม-->
<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
				<h2 class="mb-4 textMain_Show">มัคคุเทศก์ยอดนิยม</h2>
			</div>
		</div>
		<div class="ContentReviewGuide"></div> 
	</div>
</section>

<!--แพ็กเกจ-->
<section class="ftco-section" style="margin-top: 50px;">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4 textMain_Show">แพ็กเกจแนะนำ</h2>
			</div>
		</div>
		<div class="ContentPackage"></div>
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

