<div class="col-lg-12" style="overflow-x:auto; max-width: 900px;">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" style="width:8%;">ลำดับ</th>
				<th scope="col">จังหวัด</th>
				<th scope="col">ชื่อลูกค้า (เบอร์)</th>
				<th scope="col">ชื่อมัคคุเทศก์ (เบอร์)</th>
				<th scope="col">วันที่จอง - ถึงวันที่</th>
				<th scope="col" style="white-space: nowrap;">สถานะการชำระเงิน</th>
				<th class="text-center" style="white-space: nowrap;">ตรวจสอบ</th>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($result['Items'])){ ?>
				<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
			<?php }else{ ?>
				<?php foreach($result['Items'] AS $Key => $Value){ ?>
					<tr>
						<th><?=$Key + 1?></th>
						<td><?=$Value['province_name']?></td>
						<td style="white-space: nowrap;"><?=($Value['cus_firstname'] == '') ? '-' : $Value['cus_firstname']?> (<?=($Value['cus_phone'] == '') ? '-' : $Value['cus_phone']?>)</td>
						<td style="white-space: nowrap;"><?=($Value['guide_firstname'] == '') ? '-' : $Value['guide_firstname']?> (<?=($Value['guide_phone'] == '') ? '-' : $Value['guide_phone']?>)</td>
						<?php $StartDate = $Value['travel_date']; ?>
						<?php $QtyDate = $Value['qty_date'] - 1; ?>
						<td style="white-space: nowrap;"><?= date('d/m/Y',strtotime($StartDate))?> - <?=date("d/m/Y", strtotime($StartDate . "+$QtyDate days" ));?></td>
						<?php 

							if($Value['status_booking'] == 0){
								//เอกสารยกเลิก
								$IconClassStatus 	= 'IconStatus_close';
								$TextClassStatus 	= 'TextStatus_close';
								$TextStatus 		= 'ยกเลิก';
							}else{
								if($Value['status_payment'] == 0){
									if($Value['payment_id'] == '' || $Value['payment_id'] == null){
										$IconClassStatus 	= 'IconStatus_close';
										$TextClassStatus 	= 'TextStatus_close';
										$TextStatus 		= 'ยังไม่ได้ชำระเงิน';
									}else{
										$IconClassStatus 	= 'IconStatus_wait';
										$TextClassStatus 	= 'TextStatus_wait';
										$TextStatus 		= 'ชำระแล้วรอตรวจสอบ';
									}
								}else{
									$IconClassStatus 	= 'IconStatus_open';
									$TextClassStatus 	= 'TextStatus_open';
									$TextStatus 		= 'ตรวจสอบแล้ว';
								}
							}
						?>
						<td style="white-space: nowrap;"><div class="<?=$IconClassStatus?>"></div><span class="<?=$TextClassStatus?>"><?=$TextStatus?></span></td>
						<td style="white-space: nowrap;"><img class="img-responsive ImageEdit" src="<?=base_url().'application/assets/images/icon/find.png';?>" 
									onClick="Page_BookingAndPayment('pageedit','<?=$Value['booking_id']?>');"></td>
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php if(!empty($result['Items'])){ ?>
	<div class="col-md-6">
		<label class="labelContent">พบข้อมูลทั้งหมด <?=$result['CountItemAll']?> รายการ แสดงหน้า <?=$result['CurrentPage']?> / <?=$result['EndPage']?></label>
	</div>
	<div class="col-md-6">
		<nav>
			<ul class="xCNPagenationBookingAndPayment pagination justify-content-end">
				<!--ปุ่มย้อนกลับ-->
				<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'disabled'; }else{ $DisabledLeft = '-';} ?>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPage_BookingAndPayment('Fisrt')"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPage_BookingAndPayment('previous')"><span aria-hidden="true">&lsaquo;</span></a>
				</li>

				<!--ปุ่มจำนวนหน้า-->
				<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
					<?php 
						if($result['CurrentPage'] == $i){ 
							$Active 		= 'active'; 
							$DisPageNumber  = 'disabled';
						}else{ 
							$Active 		= '';
							$DisPageNumber  = '';
						}
					?>
					<li class="page-item <?=$Active;?> " onclick="ClickPage_BookingAndPayment('<?=$i?>')"><a class="page-link"><?=$i?></a></li>
				<?php } ?>

				<!--ปุ่มไปต่อ-->
				<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'disabled'; }else{ $DisabledRight = '-'; } ?>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPage_BookingAndPayment('next')"><span aria-hidden="true">&rsaquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPage_BookingAndPayment('Last')"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
		</nav>
	</div>
<?php } ?>

<script>

	//กด next page 
	function ClickPage_BookingAndPayment(Page){
		var PageCurrent = '';
		switch (Page) {
			case 'Fisrt': //กดหน้าแรก
				PageCurrent 	= 1;
			break;
			case 'next': //กดปุ่ม Next
				PageOld 		= $('.xCNPagenationBookingAndPayment .active').text(); 
				PageNew 		= parseInt(PageOld, 10) + 1; 
				PageCurrent 	= PageNew
			break;
			case 'previous': //กดปุ่ม Previous
				PageOld 		= $('.xCNPagenationBookingAndPayment .active').text(); 
				PageNew 		= parseInt(PageOld, 10) - 1; 
				PageCurrent 	= PageNew
			break;
			case 'Last': //กดหน้าสุดท้าย
				PageCurrent 	= '<?=$result['EndPage']?>';
			break;
			default:
				PageCurrent = Page
		}

		LoadTable_BookingAndPayment(PageCurrent);
	}
</script>
