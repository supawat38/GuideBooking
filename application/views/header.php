<!DOCTYPE html>
<html lang="en">
<head>
	<title>Guide Booking</title>
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
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="main">Guide<span>Booking</span></a>	
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<?php if($this->session->userdata('session_username') == null){ //ไม่มีการเข้าสู่ระบบ ?>
						<li class="nav-item <?=($pageName == 'main') ? 'active' : '' ?>" ><a href="main" class="nav-link FontMenu">หน้าหลัก</a></li>
						<li class="nav-item"><a href="#" class="nav-link FontMenu" data-toggle="modal" data-target="#ModalLogin">เข้าสู่ระบบ</a></li>
						<li class="nav-item <?=($pageName == 'register') ? 'active' : '' ?>"><a href="register" class="nav-link FontMenu">สมัครสมาชิก</a></li>
					<?php }else{ //มีการเข้าสู่ระบบ ?>
						<li class="nav-item <?=($pageName == 'main') ? 'active' : '' ?>" ><a href="main" class="nav-link FontMenu">หน้าหลัก</a></li>
						
						<!--การมองเห็นเมนูของแต่ละ user -->
						<?php if($this->session->userdata('session_reftype') == 1){ //ผู้ดูแลระบบ ?>
							<li class="nav-item  <?=($pageName == 'UpdateInformation') ? 'active' : '' ?>" ><a href="UpdateInformation" class="nav-link FontMenu">ข้อมูลส่วนตัว</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลมัคคุเทศก์</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลผู้ใช้งาน</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลการจอง</a></li>
							<li class="nav-item  <?=($pageName == 'package') ? 'active' : '' ?> "><a href="package" class="nav-link FontMenu">แพ็กเกจ</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">การชำระเงิน</a></li>
						<?php }else if($this->session->userdata('session_reftype') == 2){ //ผู้ใช้งานทั่วไป ?>
							<li class="nav-item  <?=($pageName == 'UpdateInformation') ? 'active' : '' ?>" ><a href="UpdateInformation" class="nav-link FontMenu">ข้อมูลส่วนตัว</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลมัคคุเทศก์</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลการจอง</a></li>
							<li class="nav-item  <?=($pageName == 'package') ? 'active' : '' ?> "><a href="package" class="nav-link FontMenu">แพ็กเกจ</a></li>
						<?php }else if($this->session->userdata('session_reftype') == 3){ //มัคคุเทศก์ ?>
							<li class="nav-item  <?=($pageName == 'UpdateInformation') ? 'active' : '' ?>" ><a href="UpdateInformation" class="nav-link FontMenu">ข้อมูลส่วนตัว</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลมัคคุเทศก์</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลการจอง</a></li>
							<li class="nav-item  <?=($pageName == 'package') ? 'active' : '' ?>" ><a href="package" class="nav-link FontMenu">แพ็กเกจ</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ตารางงาน</a></li>
						<?php }else{ //เจ้าของระบบ ?>
							<li class="nav-item  <?=($pageName == 'ManageAdmin') ? 'active' : '' ?>" ><a href="ManageAdmin" class="nav-link FontMenu">ข้อมูลผู้ดูแลระบบ</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">รายงานมัคคุเทศก์ยอดนิยม</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">รายงานรายได้</a></li>
						<?php } ?>

						<li class="nav-item <?=($pageName == 'logout') ? 'active' : '' ?>"><a href="logout" class="nav-link FontMenu">ออกจากระบบ</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<!--ภาพหน้าปก-->
	<?php if($pageName == 'main'){ ?>
		<div class="hero-wrap js-fullheight" style="background-image: url('application/assets/images/bg_5.jpg');">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
					<div class="col-md-12 ftco-animate">
						<?php if($this->session->userdata('session_username') == null){ 
							$TextNameUser = 'ระบบจองมัคคุเทศก์';
						}else{ 
							if($this->session->userdata('session_name') == '' || $this->session->userdata('session_name') == null){
								$TextNameUser = 'ยินดีต้อนรับ';
							}else{
								$TextNameUser = 'ยินดีต้อนรับคุณ'.$this->session->userdata('session_name');
							}
						} ?>
						<h1 class="mb-4 TextFontTitleSlide"><?=$TextNameUser?></h1>
						<p class="caps TextFontDetailSlide">มีให้เลือกหลายจังหวัด จองมัคคุเทศก์ที่ถูกใจ ในราคาพิเศษ</p>
					</div>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<?php
			//จัดการภาพหน้าปก และข้อความเมนู
			switch ($pageName) {
				case "register":
					$ImageHeder = 'application/assets/images/bg_4.jpg';
					$TitleMenu  = "ลงทะเบียนสมาชิก";
				break;
				case "UpdateInformation":
					$ImageHeder = 'application/assets/images/bg_2.jpg';
					$TitleMenu  = "แก้ไขข้อมูลส่วนตัว";
				break;
				case "ManageAdmin":
					$ImageHeder = 'application/assets/images/bg_2.jpg';
					$TitleMenu  = "ข้อมูลผู้ดูแลระบบ";
				break;
				case "package":
					$ImageHeder = 'application/assets/images/bg_2.jpg';
					$TitleMenu  = "แพ็กเกจท่องเที่ยว";
				break;
				default:
					$ImageHeder	= "";
					$TitleMenu  = "";
			} 
		?>
		<div class="hero-wrap SubMenu" style="background-image: url('<?=$ImageHeder?>'); height: 500px;">
			<div class="overlay" style="height: 500px;"></div>
			<div class="container">
				<div class="row no-gutters slider-text" data-scrollax-parent="true">
					<div class="col-md-7" style="margin-top: 20%;">
						<h1 class="mb-4 TextFontTitleSlide"><?=$TitleMenu?></h1>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
