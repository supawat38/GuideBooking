<style>
 	.bootstrap-vertical-tab {
		border: 1px solid #eee;
		display: flex;
		flex-direction: row;
	}
	.bootstrap-vertical-tab .nav {
		flex-direction: column;
		margin-right: 20px;
		border-right: 1px solid #eee;
	}
	.bootstrap-vertical-tab .nav-link {
		border-top: 1px solid #eee;
		color: #4d4d4d;
	}
	.bootstrap-vertical-tab .nav-link.active {
		border-right: 1px solid white;
		color: blue;
	}
	.bootstrap-vertical-tab .nav-item:first-child .nav-link {
		border-top: none;
	}
	.bootstrap-vertical-tab .tab-content {
		margin-top: 10px;
	}

	.nav li{
		width: 200px;
	}
</style>

<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="margin:50px 0px;">
				<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11);">
					<label class="labelHead" style="margin:0px 0px 20px 0px;"><b>จัดการข้อมูล</b></label>
					<div class="bootstrap-vertical-tab col-lg-12">
							
						<!--Tab ให้คลิก-->
						<ul class="nav row" role="tablist">
							<?php if($this->session->userdata('session_reftype') == 1){ //ผู้ดูแลระบบ ?>
								<li class="nav-item" >
									<a class="nav-link FontMenu active" id="AdminInformation-tab" data-toggle="tab" href="#AdminInformation" role="tab" aria-controls="AdminInformation" aria-selected="true">ข้อมูลส่วนตัว</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="AdminCustomer-tab" data-toggle="tab" href="#AdminCustomer" role="tab" aria-controls="AdminCustomer" aria-selected="false">ข้อมูลลูกค้า</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="AdminGuide-tab" data-toggle="tab" href="#AdminGuide" role="tab" aria-controls="AdminGuide" aria-selected="false">ข้อมูลมัคคุเทศก์ (แบ่ง %)</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="AdminRankGuide-tab" data-toggle="tab" href="#AdminRankGuide" role="tab" aria-controls="AdminRankGuide" aria-selected="false">จัดอันดับมัคคุเทศก์</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="AdminPayment-tab" data-toggle="tab" href="#AdminPayment" role="tab" aria-controls="AdminPayment" aria-selected="false">การจองและชำระเงิน</a>
								</li>
								<li class="nav-item">
									<a class="nav-link FontMenu" id="AdminPackage-tab" data-toggle="tab" href="#AdminPackage" role="tab" aria-controls="AdminPackage" aria-selected="false">แพ็กเกจ</a>
								</li>
							<?php }else if($this->session->userdata('session_reftype') == 3){ //มัคคุเทศก์ ?>
								<li class="nav-item" >
									<a class="nav-link FontMenu active" id="GuideInformation-tab" data-toggle="tab" href="#GuideInformation" role="tab" aria-controls="GuideInformation" aria-selected="true">ข้อมูลส่วนตัว</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="GuideOther-tab" data-toggle="tab" href="#GuideOther" role="tab" aria-controls="GuideOther" aria-selected="false">ข้อมูลมัคคุเทศก์ท่านอื่น</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="GuideRate-tab" data-toggle="tab" href="#GuideRate" role="tab" aria-controls="GuideRate" aria-selected="false">กำหนดราคา</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="GuideBooking-tab" data-toggle="tab" href="#GuideBooking" role="tab" aria-controls="GuideBooking" aria-selected="false">ข้อมูลการจอง</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="GuidePackage-tab" data-toggle="tab" href="#GuidePackage" role="tab" aria-controls="GuidePackage" aria-selected="false">แพ็กเกจ</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="GuideCalenda-tabr " data-toggle="tab" href="#GuideCalendar" role="tab" aria-controls="GuideCalendar" aria-selected="false">ตารางงาน</a>
								</li>
							<?php }else{ //เจ้าของระบบ ?>
								<li class="nav-item" >
									<a class="nav-link FontMenu active" id="OwnerManageAdmin-tab" data-toggle="tab" href="#OwnerManageAdmin" role="tab" aria-controls="OwnerManageAdmin" aria-selected="true">ข้อมูลผู้ดูแลระบบ</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="OwnerReport1-tab" data-toggle="tab" href="#OwnerReport1" role="tab" aria-controls="OwnerReport1" aria-selected="false">รายงานมัคคุเทศก์ยอดนิยม</a>
								</li>
								<li class="nav-item" >
									<a class="nav-link FontMenu" id="OwnerReport2-tab" data-toggle="tab" href="#OwnerReport2" role="tab" aria-controls="OwnerReport2" aria-selected="false">รายงานรายได้</a>
								</li>
							<?php } ?>
						</ul>


						<!--เนื้อหา-->
						<div class="tab-content" style="width: 100%;">
								
							<?php if($this->session->userdata('session_reftype') == 1){ //ผู้ดูแลระบบ ?>
								<div class="tab-pane fade show active" id="AdminInformation" role="tabpanel" aria-labelledby="AdminInformation-tab"><?php $this->load->view("/Information/View_Information.php"); ?></div>
								<div class="tab-pane fade" id="AdminCustomer" role="tabpanel" aria-labelledby="AdminCustomer-tab"><?php $this->load->view("/GuideManageCustomer/View_ManageCustomer.php"); ?></div>
								<div class="tab-pane fade" id="AdminGuide" role="tabpanel" aria-labelledby="AdminGuide-tab"><?php $this->load->view("/PercentGuide/View_PercentGuide.php"); ?></div>
								<div class="tab-pane fade" id="AdminRankGuide" role="tabpanel" aria-labelledby="AdminRankGuide-tab">-</div>
								<div class="tab-pane fade" id="AdminPayment" role="tabpanel" aria-labelledby="AdminPayment-tab"><?php $this->load->view("/CheckBookingPayment/View_CheckBookingPayment.php"); ?></div>
								<div class="tab-pane fade" id="AdminPackage" role="tabpanel" aria-labelledby="AdminPackage-tab"><?php $this->load->view("/Package/View_package.php"); ?></div>
							<?php }else if($this->session->userdata('session_reftype') == 3){ //มัคคุเทศก์ ?>
								<div class="tab-pane fade show active" id="GuideInformation" role="tabpanel" aria-labelledby="GuideInformation-tab"><?php $this->load->view("/Information/View_Information.php"); ?></div>
								<div class="tab-pane fade" id="GuideOther" role="tabpanel" aria-labelledby="GuideOther-tab"><?php $this->load->view("/GuideOther/View_GuideOther.php"); ?></div>
								<div class="tab-pane fade" id="GuideRate" role="tabpanel" aria-labelledby="GuideRate-tab"><?php $this->load->view("/Guiderate/View_Guiderate.php"); ?></div>
								<div class="tab-pane fade" id="GuideBooking" role="tabpanel" aria-labelledby="GuideBooking-tab">-</div>
								<div class="tab-pane fade" id="GuidePackage" role="tabpanel" aria-labelledby="GuidePackage-tab"><?php $this->load->view("/Package/View_package.php"); ?></div>
								<div class="tab-pane fade" id="GuideCalendar" role="tabpanel" aria-labelledby="GuideCalendar-tab"><?php $this->load->view("/Calendar/View_Calendar.php"); ?></div>
							<?php }else{ //เจ้าของระบบ ?>
								<div class="tab-pane fade show active" id="OwnerManageAdmin" role="tabpanel" aria-labelledby="OwnerManageAdmin-tab"><?php $this->load->view("/ManageAdmin/View_Admin.php"); ?></div>
								<div class="tab-pane fade" id="OwnerReport1" role="tabpanel" aria-labelledby="OwnerReport1-tab">รายงานมัคคุเทศก์ยอดนิยม</div>
								<div class="tab-pane fade" id="OwnerReport2" role="tabpanel" aria-labelledby="OwnerReport2-tab">รายงานรายได้</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include __DIR__ . '/../footer.php';?>

