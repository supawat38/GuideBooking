<div class="col-lg-12">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" style="width:7%">ลำดับ</th>
				<th scope="col">ชื่อ - นามสกุลมัคคุเทศก์</th>
				<th scope="col">ความคิดเห็น</th>
				<th scope="col" class="text-right">คะแนนทั้งหมด</th>
			</tr>
		</thead>
		<tbody>
			<?php if(empty($result['Items'])){ ?>
				<tr><td colspan="99" style="text-align: center;"> - ไม่พบข้อมูล - </td></tr>
			<?php }else{ ?>
				<?php $GuideID = ''; ?>
				<?php $Number = 1; ?>
				<?php foreach($result['Items'] AS $Key => $Value){ ?>
					<?php if($Value['guideCode'] == $GuideID){ ?>
						<tr>
							<th></th>
							<td></td>
							<td><?=$Value['review_text']?></td>
							<td class="text-right"><?=$Value['review_point']?></td>
						</tr>	
					<?php }else{ ?>
						<tr>
							<th><?=$Number?></th>
							<td><?=($Value['firstname'] == '') ? '-' : $Value['firstname'] . ' ' . $Value['lastname']?></td>
							<td></td>
							<td class="text-right" style="font-weight:bold;"><?=($Value['COUNTCOMMENT'] == '') ? '0' : $Value['COUNTCOMMENT']?> คะแนน</td>
						</tr>
						<?php if($Value['review_point'] != '' || $Value['review_point'] != null){ ?>
							<tr>
								<th></th>
								<td></td>
								<td><?=$Value['review_text']?></td>
								<td class="text-right"><?=$Value['review_point']?></td>
							</tr>	
						<?php } ?>
						<?php $GuideID = $Value['guideCode']; ?>
						<?php $Number++; ?>
					<?php } ?>
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
