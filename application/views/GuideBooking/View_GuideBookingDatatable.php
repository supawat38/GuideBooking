<div class="col-lg-12">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col">ลำดับ</th>
				<th scope="col">ชื่อลูกค้า</th>
				<th scope="col">เบอร์ติดต่อ</th>
				<th scope="col">จังหวัด</th>
				<th scope="col">วันที่จอง - ถึงวันที่</th>
				<th scope="col">สถานะชำระเงิน</th>
				<th class="text-center">รายละเอียด</th>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($result['Items'])){ ?>
				<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
			<?php }else{ ?>
				<?php foreach($result['Items'] AS $Key => $Value){ ?>
					<tr>
						<th><?=$Key + 1?></th>
						<td><?=($Value['firstname'] == '') ? '-' : $Value['firstname']?></td>
						<td><?=($Value['cus_phone'] == '') ? '-' : $Value['cus_phone']?></td>
						<td><?=($Value['province_name'] == '') ? '-' : $Value['province_name']?></td>
						<?php $StartDate 	= $Value['travel_date']; ?>
						<?php $QtyDate 		= $Value['qty_date'] - 1; ?>
						<td><?= date('d/m/Y',strtotime($StartDate))?> - <?=date("d/m/Y", strtotime($StartDate . "+$QtyDate days" ));?></td>
						<?php 
							$CurrentDate		= date('d-m-Y');
							$BookingDateEnd 	= date("d-m-Y", strtotime($StartDate . "+$QtyDate days" ));

							if($Value['status_booking'] == 0){
								//เอกสารยกเลิก
								$IconClassStatus 	= 'IconStatus_close';
								$TextClassStatus 	= 'TextStatus_close';
								$TextStatus 		= 'ยกเลิก';
							}else{
								if($Value['status_payment'] == 1){
									$IconClassStatus 	= 'IconStatus_open';
									$TextClassStatus 	= 'TextStatus_open';
									$TextStatus 		= 'ชำระเงินแล้ว';
								}else{
									if(strtotime($CurrentDate) > strtotime($BookingDateEnd)){
										$IconClassStatus 	= 'IconStatus_close';
										$TextClassStatus 	= 'TextStatus_close';
										$TextStatus 		= 'ยกเลิก';
									}else{
										$IconClassStatus 	= 'IconStatus_close';
										$TextClassStatus 	= 'TextStatus_close';
										$TextStatus 		= 'ยังไม่ชำระเงิน';
									}
								}
							}
						?>
						<td><div class="<?=$IconClassStatus?>"></div><span class="<?=$TextClassStatus?>"><?=$TextStatus?></span></td>
						<td><img class="img-responsive ImageEdit" src="<?=base_url().'application/assets/images/icon/find.png';?>" 
									onClick="Page_guidebooking('pageedit','<?=$Value['booking_id']?>');"></td>
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
			<ul class="xCNPagenationguidebooking pagination justify-content-end">
				<!--ปุ่มย้อนกลับ-->
				<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'disabled'; }else{ $DisabledLeft = '-';} ?>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPageguidebooking('Fisrt')"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPageguidebooking('previous')"><span aria-hidden="true">&lsaquo;</span></a>
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
					<li class="page-item <?=$Active;?> " onclick="ClickPageguidebooking('<?=$i?>')"><a class="page-link"><?=$i?></a></li>
				<?php } ?>

				<!--ปุ่มไปต่อ-->
				<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'disabled'; }else{ $DisabledRight = '-'; } ?>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPageguidebooking('next')"><span aria-hidden="true">&rsaquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPageguidebooking('Last')"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
		</nav>
	</div>
<?php } ?>

<script>

	//กด next page 
	function ClickPageguidebooking(Page){
		var PageCurrent = '';
		switch (Page) {
			case 'Fisrt': //กดหน้าแรก
				PageCurrent 	= 1;
			break;
			case 'next': //กดปุ่ม Next
				PageOld 		= $('.xCNPagenationguidebooking .active').text(); 
				PageNew 		= parseInt(PageOld, 10) + 1; 
				PageCurrent 	= PageNew
			break;
			case 'previous': //กดปุ่ม Previous
				PageOld 		= $('.xCNPagenationguidebooking .active').text(); 
				PageNew 		= parseInt(PageOld, 10) - 1; 
				PageCurrent 	= PageNew
			break;
			case 'Last': //กดหน้าสุดท้าย
				PageCurrent 	= '<?=$result['EndPage']?>';
			break;
			default:
				PageCurrent = Page
		}

		LoadTable_guidebooking(PageCurrent);
	}

</script>
