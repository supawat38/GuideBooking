
<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Freind Travel</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/animate.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/owl.carousel.min.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/owl.theme.default.min.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/magnific-popup.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/bootstrap-datepicker.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/jquery.timepicker.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/flaticon.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/style.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/common.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/select2.css')?>">
		<link rel="stylesheet" href="<?=base_url('application/assets/css/fullcalendar.min.css')?>">
	</head>

	<body>
		<div class="container">
			<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12" style="margin:50px 0px 20px 0px;">
							<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
								
								<!--ข้อมูลรายละเอียด-->
								<div class="col-lg-12">
									<div class="row">
										<!--หัวข้อ-->
										<div class="col-lg-12">
											<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">รายละเอียดมัคคุเทศก์</p>
										</div>

										<!--รูปภาพ-->
										<div class="col-lg-4" style="margin-top:10px;">
											<?php 
											$PathImage = $DetailGuide[0]['guide_image'];
											if($PathImage == '' || $PathImage == null){
												$PathShowImage 		= base_url('/application/assets/images/guide/') . '/NoImage.png';
												$PathDatabaseImage 	= '';
											}else{
												$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
												$PathDatabaseImage 	= $PathImage;
											} ?>
											<img class="img-responsive xCNImgCenter" src="<?=$PathShowImage?>">
										</div>
										
										<!--รายละเอียด-->
										<div class="col-lg-8">
											<label class="labelHead" >คุณ<?=$DetailGuide[0]['firstname']; ?> <?=$DetailGuide[0]['lastname']; ?> </label>
											<label class="labelHead" >เพศ<?=($DetailGuide[0]['gender'] == '1' ) ? 'ชาย' : 'หญิง'; ?></label><br>
											<label class="labelHead" >เบอร์โทรศัพท์ : <?=$DetailGuide[0]['guide_phone'] ?></label><br>
											<label class="labelHead" >วันเกิด : <?=date('d/m/Y',strtotime($DetailGuide[0]['guide_bd']))?></label><br>
											<label class="labelHead" >อีเมลล์ : <?=($DetailGuide[0]['guide_email'] == '' ) ? 'ไม่ได้ระบุ' : $DetailGuide[0]['guide_email']?></label><br>
											<label class="labelHead" >จังหวัด : <?=$DetailGuide[0]['province_name'] ?></label><br> 
											<label class="labelHead" >หมายเลขมัคคุเทศก์ : <?=($DetailGuide[0]['guide_credit'] == '') ? 'ไม่ได้ระบุ' : $DetailGuide[0]['guide_credit'] ?></label><br>
											<label class="labelHead" >เกี่ยวกับมัคคุเทศก์ : <?=($DetailGuide[0]['intro_profile'] == '') ? 'ไม่ได้ระบุ' : $DetailGuide[0]['intro_profile'] ?></label><br>
											<label class="labelHead" >ที่อยู่ : <?=($DetailGuide[0]['address'] == '') ? 'ไม่ได้ระบุ' : $DetailGuide[0]['address'] ?></label><br>
											<label class="labelHead" >จังหวัดที่ให้บริการ : </label>
											<?php 
											if(!empty($DetailArea)){
												$TextArea = '';
												for($i=0; $i<count($DetailArea); $i++){
													$TextArea .= $DetailArea[$i]['province_name'] . ',';

													//ถ้าวนลูปจนถึงตัวสุดท้ายเเล้ว ให้ ลบ , ตัวสุดท้ายออก
													if($i == count($DetailArea)-1){
														$TextArea = substr($TextArea,0,-1);
													}
												}
											}else{
												$TextArea = '';
											} ?>
											<label class="labelHead"><?=$TextArea?></label><br> 
											<label class="labelHead" >สิ่งที่มัคคุเทศก์ถนัด : </label>
											<?php
												//สิ่งที่สนใจ
												$guide_qustions = $DetailGuide[0]['guide_qustions'];
												if($guide_qustions != '' || $guide_qustions != null){
													$arrayQustions 	= explode(",",$guide_qustions);
													for($i=0; $i<count($arrayQustions); $i++){
														echo '<div class="GuideTag"><label class="labelHead GuideTaglabel">#'.$arrayQustions[$i].'</label></div>';
													}
												}
											?> 
											<br> 

										</div>
									</div>
								</div>

								<!--เรทราคา-->
								<div class="col-lg-12" style="margin-top:10px;">
									<div class="row">
										<!--หัวข้อ-->
										<div class="col-lg-12">
											<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">เรทราคา</p>
										</div>

										<!--ตารางข้อมูล-->
										<div class="col-lg-12">
											<table class="table table-hover" style="margin-top: 0px;">
												<thead>
													<tr>
														<th scope="col" style="width:10%;">ลำดับ</th>
														<th scope="col">เรทราคา</th>
														<th scope="col" style="width:20%;">จำนวนคน</th>
														<th scope="col" style="width:20%;">เงื่อนไข</th>
													</tr>
												</thead>
												<tbody>
													<?php if(empty($DetailRate)){ ?>
														<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
													<?php }else{ ?>
														<?php foreach($DetailRate AS $Key => $Value){ ?>
															<tr>
																<th><?=$Key + 1?></th>
																<td><?=($Value['amount'] == '') ? '0' : number_format($Value['amount'],2)?></td>
																<td><?=($Value['person'] == '') ? '-' : $Value['person']?> คน</td>
																<td><?=($Value['note'] == '') ? '-' : $Value['note']?></td>
															</tr>
														<?php } ?>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--แพ็คเกจ-->
								<div class="col-lg-12">
									<div class="row">
										<!--หัวข้อ-->
										<div class="col-lg-12">
											<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">แพ็คเกจ</p>
										</div>

										<!--ตารางข้อมูล-->
										<div class="col-lg-12">
											<table class="table table-hover" style="margin-top: 0px;">
												<thead>
													<tr>
														<th scope="col" style="width:10%;">ลำดับ</th>
														<th scope="col">ชื่อแพ็กเกจ</th>
														<th scope="col" style="width:20%;">เงื่อนไข</th>
														<th scope="col" style="width:20%;">ดาวน์โหลด</th>
													</tr>
												</thead>
												<tbody>
													<?php if(empty($DetailPackage)){ ?>
														<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
													<?php }else{ ?>
														<?php foreach($DetailPackage AS $Key => $Value){ ?>
															<tr>
																<th><?=$Key + 1?></th>
																<td><?=($Value['package_name'] == '') ? '-' : $Value['package_name']?></td>
																<td><?=($Value['package_con'] == '') ? '-' : $Value['package_con']?></td>
																<td>
																	<!--ถ้าไม่มีไฟล์จะดาวน์โหลดไม่ได้-->
																	<?php if($Value['package_file'] == '' || $Value['package_file'] == null){ ?>
																		<label class="textDowloadFileDisabled" style="text-align: left;">ดาวน์โหลด</label>
																	<?php }else{ ?>
																		<a href="<?=base_url('application/assets/File/package/'.$Value['package_file'])?>">
																			<label class="textDowloadFile" style="text-align: center; ">ดาวน์โหลด</label>
																		</a>
																	<?php } ?>
																</td>
															</tr>
														<?php } ?>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--รีวิว-->
								<div class="col-lg-12">
									<div class="row">
										<!--หัวข้อ-->
										<div class="col-lg-12">
											<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">ความคิดเห็นจากลูกค้า</p>
										</div>

										<!--ตารางข้อมูล-->
										<div class="col-lg-12">
											<table class="table table-hover" style="margin-top: 0px;">
												<thead>
													<tr>
														<th scope="col" style="width:10%;">ลำดับ</th>
														<th scope="col">ข้อความ</th>
													</tr>
												</thead>
												<tbody>
													<?php if(empty($DetailReview)){ ?>
														<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
													<?php }else{ ?>
														<?php foreach($DetailReview AS $Key => $Value){ ?>
															<tr>
																<th><?=$Key + 1?></th>
																<td><?=($Value['review_text'] == '') ? '-' : $Value['review_text']?></td>
															</tr>
														<?php } ?>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</body>
</html>
