<div class="col-lg-12" style="overflow-x:auto; max-width: 900px;">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" style="width:7%; white-space: nowrap;">ลำดับ</th>
				<th scope="col" style="white-space: nowrap;">ชื่อ - นามสกุลมัคคุเทศก์</th>
				<th scope="col" style="white-space: nowrap;">รหัสการชำระเงิน - รหัสการจอง</th>
				<th scope="col" style="white-space: nowrap;">ราคา</th>
				<th scope="col" style="white-space: nowrap;">หักส่วนแบ่ง</th>
				<th scope="col" style="white-space: nowrap;">รายรับเจ้าของ</th>
				<th scope="col" style="white-space: nowrap;" class="text-right">รายรับมัคคุเทศก์</th>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($result['Items'])){ ?>
				<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
			<?php }else{ ?>
				<?php foreach($result['Items'] AS $Key => $Value){ ?>
					<tr>
						<th><?=$Key + 1?></th>
						<td style="white-space: nowrap;"><?=($Value['firstname'] == '') ? '-' : $Value['firstname'] . ' ' . $Value['lastname']?></td>
						<td style="white-space: nowrap;"><?=$Value['payment_id']?> - <?=$Value['booking_id']?></td>
						<td style="white-space: nowrap;"><?=number_format($Value['grandtotal'],2)?> บาท</td>
						<td style="white-space: nowrap;"><?=($Value['guide_gp'] == '') ? '0' : $Value['guide_gp']?>%</td>

						<!-- สูตรหารายได้ รายได้ =  ราคาจองไกด์ - ((ราคาจองไกด์ × gp) / 100) -->
						<?php $Payment = $Value['amount'] - (( $Value['amount'] * $Value['guide_gp'] ) / 100); ?>
						<td style="white-space: nowrap;" class="text-right"><?=number_format($Value['grandtotal'] - $Payment,2)?> บาท</td>
						<td style="white-space: nowrap;" class="text-right" style="font-weight:bold;"><?=number_format($Payment,2)?> บาท</td>
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php if(!empty($result['Items'])){ ?>
	<div class="col-md-6">
		<label class="labelContent">พบข้อมูลทั้งหมด <?=$result['CountItemAll']?> รายการ </label>
	</div>
<?php } ?>
