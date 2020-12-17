<div class="col-lg-12">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" style="width:7%">ลำดับ</th>
				<th scope="col">ชื่อ - นามสกุลมัคคุเทศก์</th>
				<th scope="col">รหัสการชำระเงิน - รหัสการจอง</th>
				<th scope="col">ราคา</th>
				<th scope="col">ส่วนแบ่ง</th>
				<th scope="col" class="text-right">ยอดรายรับ</th>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($result['Items'])){ ?>
				<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
			<?php }else{ ?>
				<?php foreach($result['Items'] AS $Key => $Value){ ?>
					<tr>
						<th><?=$Key + 1?></th>
						<td><?=($Value['firstname'] == '') ? '-' : $Value['firstname'] . ' ' . $Value['lastname']?></td>
						<td><?=$Value['payment_id']?> - <?=$Value['booking_id']?></td>
						<td><?=number_format($Value['grandtotal'],2)?> บาท</td>
						<td><?=($Value['guide_gp'] == '') ? '0' : $Value['guide_gp']?>%</td>
						<!-- สูตรหารายได้ รายได้ =  ราคาจองไกด์ - ((ราคาจองไกด์ × gp) / 100) -->
						<?php $Payment = $Value['amount'] - (( $Value['amount'] * $Value['guide_gp'] ) / 100); ?>
						<td class="text-right" style="font-weight:bold;"><?=number_format($Payment,2)?> บาท</td>
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
