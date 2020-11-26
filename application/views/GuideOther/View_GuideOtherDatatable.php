<div class="col-lg-12">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col">ลำดับ</th>
				<th scope="col">ชื่อมัคคุเทศก์</th>
				<th scope="col">เบอร์โทรศัพท์</th>
				<th scope="col" class="text-center">ดูข้อมูล</th>
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
						<td><?=($Value['guide_phone'] == '') ? '-' : $Value['guide_phone']?></td>
						<td class="text-center">
							<a class="labelHead" href="Booking_DeteilGuide/<?=$Value['guide_id']; ?>" target="_blank" ><img class="img-responsive ImageEdit" src="<?=base_url().'application/assets/images/icon/find.png';?>"></a>
						</td>
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
			<ul class="xCNPagenationguideother pagination justify-content-end">
				<!--ปุ่มย้อนกลับ-->
				<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'disabled'; }else{ $DisabledLeft = '-';} ?>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPageguideother('Fisrt')"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPageguideother('previous')"><span aria-hidden="true">&lsaquo;</span></a>
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
					<li class="page-item <?=$Active;?> " onclick="ClickPageguideother('<?=$i?>')"><a class="page-link"><?=$i?></a></li>
				<?php } ?>

				<!--ปุ่มไปต่อ-->
				<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'disabled'; }else{ $DisabledRight = '-'; } ?>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPageguideother('next')"><span aria-hidden="true">&rsaquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPageguideother('Last')"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
		</nav>
	</div>
<?php } ?>

<script>

	//กด next page 
	function ClickPageguideother(Page){
		var PageCurrent = '';
		switch (Page) {
			case 'Fisrt': //กดหน้าแรก
				PageCurrent 	= 1;
			break;
			case 'next': //กดปุ่ม Next
				PageOld 		= $('.xCNPagenationguideother .active').text(); 
				PageNew 		= parseInt(PageOld, 10) + 1; 
				PageCurrent 	= PageNew
			break;
			case 'previous': //กดปุ่ม Previous
				PageOld 		= $('.xCNPagenationguideother .active').text(); 
				PageNew 		= parseInt(PageOld, 10) - 1; 
				PageCurrent 	= PageNew
			break;
			case 'Last': //กดหน้าสุดท้าย
				PageCurrent 	= '<?=$result['EndPage']?>';
			break;
			default:
				PageCurrent = Page
		}

		LoadTable_guideother(PageCurrent);
	}
</script>
