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
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="main">Freind<span>Travel</span></a>	
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<?php if($this->session->userdata('session_username') == null){ //ไม่มีการเข้าสู่ระบบ ?>
						<li class="nav-item <?=($pageName == 'main') ? 'active' : '' ?>" ><a href="main" class="nav-link FontMenu">หน้าหลัก</a></li>
						<li class="nav-item"><a href="#" class="nav-link FontMenu" data-toggle="modal" data-target="#ModalLogin">เข้าสู่ระบบ</a></li>
						<li class="nav-item <?=($pageName == 'register') ? 'active' : '' ?>"><a href="register" class="nav-link FontMenu">สมัครสมาชิก</a></li>
					<?php }else{ //มีการเข้าสู่ระบบ ?>
		
						<!--การมองเห็นเมนูของแต่ละ user -->
						<!--FontEnd-->
						<?php if($this->session->userdata('session_reftype') == 2){ //ผู้ใช้งานทั่วไป ?>
							<li class="nav-item <?=($pageName == 'main') ? 'active' : '' ?>" ><a href="main" class="nav-link FontMenu">หน้าหลัก</a></li>
							<li class="nav-item  <?=($pageName == 'UpdateInformation') ? 'active' : '' ?>" ><a href="UpdateInformation" class="nav-link FontMenu">ข้อมูลส่วนตัว</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลมัคคุเทศก์</a></li>
							<li class="nav-item" ><a href="#" class="nav-link FontMenu">ข้อมูลการจอง</a></li>
						<!--BackEnd-->
						<?php }else{ //ผู้ดูแลระบบ + มัคคุเทศก์ + เจ้าของ ?>
							<li class="nav-item  <?=($pageName == 'Backend') ? 'active' : '' ?>" ><a href="Backend" class="nav-link FontMenu">จัดการข้อมูล</a></li>
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
					$ImageHeder = "background-image: url('application/assets/images/bg_4.jpg'); height: 500px;";
					$TitleMenu  = "ลงทะเบียนสมาชิก";
				break;
				case "UpdateInformation":
					$ImageHeder = "background-image: url('application/assets/images/bg_2.jpg'); height: 500px;";
					$TitleMenu  = "แก้ไขข้อมูลส่วนตัว";
				break;
				case "package":
					$ImageHeder = "background-image: url('application/assets/images/bg_2.jpg'); height: 500px;";
					$TitleMenu  = "แพ็กเกจท่องเที่ยว";
				break;
				case "Backend":
					$ImageHeder = "background-color: #7c9295ad; height: 80px;";
					$TitleMenu  = "";
				break;
				case "ResearchGuide":
					$ImageHeder = "background-image: url('application/assets/images/bg_2.jpg'); height: 500px;";
					$TitleMenu  = "ค้นหามัคคุเทศก์";
				break;
				default:
					$ImageHeder	= "";
					$TitleMenu  = "";
			} 
		?>
		<div class="hero-wrap SubMenu" style="<?=$ImageHeder?>box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);">
			
			<div class="container">
				<div class="row no-gutters slider-text" data-scrollax-parent="true">
					<div class="col-md-7" style="margin-top: 20%;">
						<h1 class="mb-4 TextFontTitleSlide"><?=$TitleMenu?></h1>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
