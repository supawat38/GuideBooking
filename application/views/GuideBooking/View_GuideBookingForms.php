<?php
	if($typepage == 'pageedit'){

		//Booking
		$BookingID			= $Result['Items'][0]['booking_id']; 
		$CusID				= $Result['Items'][0]['cus_id'];
		$GuideID			= $Result['Items'][0]['guide_id']; 
		$DateBooking		= date('d/m/Y',strtotime($Result['Items'][0]['booking_date'])); 
		$ProviceID			= $Result['Items'][0]['province_id']; 
		$ProviceName		= $Result['Items'][0]['province_name']; 
		$TravelDate			= date('d/m/Y',strtotime($Result['Items'][0]['travel_date'])); 
		$CountDate			= $Result['Items'][0]['qty_date']; 
		$CusEmail			= $Result['Items'][0]['cus_email']; 
		$CusPhone			= $Result['Items'][0]['cus_phone']; 
		$Amount				= $Result['Items'][0]['amount']; 
		$Grand				= $Result['Items'][0]['grandtotal']; 
		$status_booking		= $Result['Items'][0]['status_booking']; 
		$status_payment		= $Result['Items'][0]['status_payment']; 
		$refpayment_id		= $Result['Items'][0]['refpayment_id']; 
		$status_paytoguide	= $Result['Items'][0]['status_paytoguide']; 
		$cus_firstname		= $Result['Items'][0]['cus_firstname']; 
		$cus_phone			= $Result['Items'][0]['cus_phone']; 
		$guide_firstname	= $Result['Items'][0]['guide_firstname']; 
		$guide_phone		= $Result['Items'][0]['guide_phone']; 
		$admin_firstname	= $Result['Items'][0]['admin_firstname']; 

		//Payment
		$payment_id			= $Result['Items'][0]['payment_id']; 
		$refbooking_id		= $Result['Items'][0]['refbooking_id'];
		$payment_date		= date('d/m/Y',strtotime($Result['Items'][0]['payment_date'])); 
		$payment_time		= $Result['Items'][0]['payment_time'];
		$payment_type		= $Result['Items'][0]['payment_type'];
		$payment_slip		= $Result['Items'][0]['payment_slip'];
		$payment_frombank	= $Result['Items'][0]['payment_frombank'];
		$payment_tobank		= $Result['Items'][0]['payment_tobank'];
		$payment_account	= $Result['Items'][0]['payment_account'];
		$payment_rcv		= $Result['Items'][0]['payment_rcv']; 
		$status_approve		= $Result['Items'][0]['status_approve'];
		$approved_by		= $Result['Items'][0]['approved_by']; 
		$approved_date		= date('d/m/Y',strtotime($Result['Items'][0]['approved_date'])); 

		//จำนวนคน
		$person				= $Result['Items'][0]['person'];  
	}
?>

<!--ฟอร์มแก้ไขหรือตรวจสอบ-->
<div class="col-lg-12"><hr></div>
<form id="formBookingAndPayment" class="form-signin" method="post" action="javascript:void(0)">
	<div class="col-lg-12" id="divEditBookingAndPayment" >
		<div class="row">
			<div class="col-lg-5 col-md-5">
				<div class="form-row">
					<?php 
						if($payment_id == '' || $payment_id == null){
							$PathShowImage 		= base_url('/application/assets/images/slip/') . '/nopay.jpg';
						}else{
							$PathShowImage 		= base_url('/application/assets/images/slip/') . $payment_slip;
						} ?>
					<img id="ImgSlip" class="img-responsive" style="width: 100%;" src="<?=$PathShowImage?>">
				</div>
			</div>
			<div class="col-lg-7 col-md-7">
				<div class="form-row">

					<input type="hidden" id="hiddenTypePage" name="hiddenTypePage" value="<?=$typepage?>">
					<input type="hidden" id="hiddenBookingID" name="hiddenBookingID" value="<?=$BookingID?>">


					<div class="form-group col-md-12">
						<label style="font-weight: bold;">รายละเอียดการจอง</label><br>
						<div><hr style="margin: 0px 0px 10px 0px"></div>
						<label>วันที่ทำรายการ <?=$DateBooking?> </label><br>
						<label>จังหวัด<?=$ProviceName?> ราคา <?=number_format($Grand,2)?> บาท ( <?=number_format($Amount,2)?> บาท / วัน )</label><br>
						<label>วันที่เดินทาง <?=$TravelDate?> จำนวน <?=$CountDate?> วัน</label><br>
						<label>จำนวนคน <?=($person == '') ? '[มีการเปลี่ยนแปลงราคาเดิม กรุณาตรวจสอบความถูกต้อง]' : $person . ' คน' ?></label><br>
						<label>ชื่อลูกค้า : <?=$cus_firstname?> (<?=$cus_phone?>)</label>
						<label>ชื่อมัคคุเทศก์คุณ : <?=$guide_firstname?> (<?=$guide_phone?>)</label>
					</div>

					<div class="form-group col-md-12">
						<label style="font-weight: bold;">รายละเอียดการชำระเงิน</label><br>
						<div><hr style="margin: 0px 0px 10px 0px"></div>
						<?php 
						if($status_payment == 0){
							if($payment_id == '' || $payment_id == null){
								$TextStatusPayment  	= ' ยังไม่ได้ชำระเงิน';
								$DateTimePayment		= '-';
								$BankFrom				= '-';
								$pay_Rcv				= 0;
								$admin_firstname        = '-';
								$CSScolor				= "style='color:red; margin-left:5px;'";
							}else{
								$TextStatusPayment  	= ' ชำระเงินแล้วรออนุมัติ';
								$DateTimePayment		= $payment_date . ' ' .  $payment_time;
								$BankFrom				= $payment_frombank;
								$pay_Rcv				= 0;
								$admin_firstname        = '-';
								$CSScolor				= "style='color:#ec6941; margin-left:5px;'";
							}
						}else{
							$TextStatusPayment  	= ' ชำระเงินสมบูรณ์';
							$DateTimePayment		= $payment_date . ' ' . $payment_time;
							$BankFrom				= $payment_frombank;
							$pay_Rcv				= $payment_rcv;
							$admin_firstname        = $admin_firstname;
							$CSScolor				= "style='color:#5ebc16; margin-left:5px;'";
						} ?>
						<label>สถานะการชำระเงิน : </label><label <?=$CSScolor?>><?=$TextStatusPayment ?></label><br>
						<label>วันที่ และเวลาชำระเงิน : <?=$DateTimePayment?> </label><br>
						<label>ชำระเงินจากธนาคาร : <?=$BankFrom?></label><br>
						<label>อนุมัติโดย : <?=$admin_firstname?></label><br>
						<label>จำนวนเงินที่โอนเข้ามา : <?=$pay_Rcv?> บาท</label><br>
						
					</div>

				</div>
			</div>
		</div>
	</div>
</form>
