<div class="col-md-12 col-12" style="margin-top: 20px;">
	<?php if(empty($result['Items'])){ ?>
		<div><p class="labelContent" style="text-align: center; margin: 50px 0px;"> - ไม่พบข้อมูล - </p></div>
	<?php }else{ ?>
		<div class="row">
			<?php foreach($result['Items'] AS $Key => $Value){ ?>
				<?php 
					$StartDate 			= $Value['travel_date'];
					$QtyDate 			= $Value['qty_date'] - 1;

					$BookingDateStart 	= date('d/m/Y',strtotime($StartDate));
					$BookingDateEnd 	= date("d/m/Y", strtotime($StartDate . "+$QtyDate days" ));
					$CurrentDate		= date('d/m/Y');
					if($CurrentDate > $BookingDateEnd){
						$TextStatus 		= 'ทริปของคุณสิ้นสุดเเล้ว'."<br>".'ขอบคุณที่ใช้บริการ';
						$StyleStatus    	= "color: #3f3f3f; text-align: center; font-weight: bold;";
						$PathShowImage 		= 'application/assets/images/icon/successBooking.png';
					}else{
						$TextStatus 		= 'ทริปของคุณ'."<br>".'กำลังจะมาถึง';
						$StyleStatus    	= "color: #3f3f3f; text-align: center; font-weight: bold;";
						$PathShowImage 		= 'application/assets/images/icon/waitBooking.png';
					}
				?>
				<div class="col-md-12 testimony-wrap py-12" style="padding: 15px; margin-bottom: 20px;">
					<div class="row">
						<div class="col-lg-3">
							<div class="services services-1 color-1  d-block img" style="background-image: url('application/assets/images/bg_3.jpg'); margin: 10px; padding: 10px 30px 5px 30px;">
								<div class="icon d-flex align-items-center justify-content-center">
									<div class='BookingWait' style="background-image: url(<?=$PathShowImage?>);"></div>
								</div>
								<div class="media-body" style="margin-left: -10px; margin-right: -10px;">
									<p class="labelHead" style="<?=$StyleStatus?>"><?=$BookingDateStart ?>  - <?=$BookingDateEnd?></p>
									<p class="labelHead" style="<?=$StyleStatus?>"><?=$TextStatus?></p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-12">
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">รหัสการจอง : <?=$Value['booking_id']?> จังหวัด<?=$Value['province_name']?></p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">ราคาสำหรับการจองครั้งนี้ : <?=number_format($Value['grandtotal'],2)?></p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">มัคคุเทศก์ชื่อ : <?=$Value['guide_firstname']?> <?=$Value['guide_lastname']?></p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">เบอร์ติดต่อ : <?=$Value['guide_phone']?> </p>
									<?php 
										if($Value['status_payment'] == 0){
											if($Value['payment_id'] == '' || $Value['payment_id'] == null){
												$TextStatusPayment 		= 'ยังไม่ได้ชำระเงิน';
											}else{
												$TextStatusPayment 		= 'ชำระแล้วรออนุมัติ';
											}
										}else{
											$TextStatusPayment 		= 'ชำระเงินแล้ว';
										}
									?>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">สถานะการชำระเงิน : <b><?=$TextStatusPayment?></b></p>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<a class="labelHead" href="Booking_DeteilGuide/<?=$Value['guide_id']; ?>" target="_blank" style="display: block; margin: 0px auto; text-align: right; color: #f98b2d;" >รีวิวมัคคุเทศก์</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>

<?php if(!empty($result['Items'])){ ?>
	<div class="col-md-12 text-center" style="margin-top:50px;">
		<nav>
			<div class="block-27">
				<ul class="xCNPagenation">
					<!--ปุ่มย้อนกลับ-->
					<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'CenterDisabledBTN'; }else{ $DisabledLeft = '-';} ?>
					<li class='<?=$DisabledLeft?>'><a onclick="ClickPage_guideAll('previous')">&lt;</a></li>

					<!--ปุ่มจำนวนหน้า-->
					<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
						<?php 
							if($result['CurrentPage'] == $i){ 
								$Active 		= 'active'; 
							}else{ 
								$Active 		= '';
							}
						?>
						<li class="<?=$Active;?>" onclick="ClickPage_guideAll('<?=$i?>')"><span><?=$i?></span></li>
					<?php } ?>

					<!--ปุ่มไปต่อ-->
					<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'CenterDisabledBTN'; }else{ $DisabledRight = '-'; } ?>
					<li class='<?=$DisabledRight?>'><a onclick="ClickPage_guideAll('next')">&gt;</a></li>
				</ul>
			</div>
		</nav>
	</div>
<?php } ?>

<script>	

	//กด next page 
	function ClickPage_guideAll(Page){
		var PageCurrent = '';
		switch (Page) {
			case 'next': //กดปุ่ม Next
				PageOld 		= $('.xCNPagenation .active').text(); 
				PageNew 		= parseInt(PageOld, 10) + 1; 
				PageCurrent 	= PageNew
			break;
			case 'previous': //กดปุ่ม Previous
				PageOld 		= $('.xCNPagenation .active').text(); 
				PageNew 		= parseInt(PageOld, 10) - 1; 
				PageCurrent 	= PageNew
			break;
			default:
				PageCurrent = Page
		}

		LoadtableGuideAll(PageCurrent);
	}

</script>
