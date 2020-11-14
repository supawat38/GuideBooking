<div class="col-lg-12">
	<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col">ลำดับ</th>
				<th scope="col">ชื่อมัคคุเทศก์</th>
				<th scope="col">เรทราคา</th>
				<th scope="col">เงื่อนไข</th>
				<th scope="col">สถานะใช้งาน</th>
				<th class="text-center">แก้ไข</th>
				<th class="text-center">ลบ</th>
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
						<td><?=($Value['amount'] == '') ? '0' : number_format($Value['amount'],2)?></td>
						<td><?=($Value['note'] == '') ? '-' : $Value['note']?></td>
						<?php 
							if($Value['status_delete'] == 0){
								$IconClassStatus 	= 'IconStatus_open';
								$TextClassStatus 	= 'TextStatus_open';
								$TextStatus 		= 'ใช้งาน';
							}else{
								$IconClassStatus 	= 'IconStatus_close';
								$TextClassStatus 	= 'TextStatus_close';
								$TextStatus 		= 'ไม่ใช้งาน';
							}
						?>
						<td><div class="<?=$IconClassStatus?>"></div><span class="<?=$TextClassStatus?>"><?=$TextStatus?></span></td>
						<td><img class="img-responsive ImageEdit" src="<?=base_url().'application/assets/images/icon/edit.png';?>" 
									onClick="Page_rate('pageedit','<?=$Value['rate_id']?>');"></td>
						<td><img class="img-responsive ImageDelete" src="<?=base_url().'application/assets/images/icon/delete.png';?>" 
									onClick="Delete_rate('<?=$Value['rate_id']?>');"></td>
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
			<ul class="xCNPagenation pagination justify-content-end">
				<!--ปุ่มย้อนกลับ-->
				<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'disabled'; }else{ $DisabledLeft = '-';} ?>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPagerate('Fisrt')"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPagerate('previous')"><span aria-hidden="true">&lsaquo;</span></a>
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
					<li class="page-item <?=$Active;?> " onclick="ClickPagerate('<?=$i?>')"><a class="page-link"><?=$i?></a></li>
				<?php } ?>

				<!--ปุ่มไปต่อ-->
				<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'disabled'; }else{ $DisabledRight = '-'; } ?>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPagerate('next')"><span aria-hidden="true">&rsaquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPagerate('Last')"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
		</nav>
	</div>
<?php } ?>

<script>

	//กด next page 
	function ClickPagerate(Page){
		var PageCurrent = '';
		switch (Page) {
			case 'Fisrt': //กดหน้าแรก
				PageCurrent 	= 1;
			break;
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
			case 'Last': //กดหน้าสุดท้าย
				PageCurrent 	= '<?=$result['EndPage']?>';
			break;
			default:
				PageCurrent = Page
		}

		LoadTable_rate(PageCurrent);
	}

	//ลบข้อมูล
	function Delete_rate(ID){
		Swal.fire({
			title: "ลบข้อมูล ? ",
			text: "กดยืนยันเพื่อลบข้อมูล",
			showCancelButton: false,
			confirmButtonColor: '#ff6868',
			confirmButtonText: 'ยืนยัน',
		}).then(function (result) {
			if (result.isConfirmed) {
				$.ajax({
					type 			: "POST",
					url 			: "EventDelete_rate",
					data 			: { 'ID' : ID },
					success			: function (Result){
						LoadTable_rate(1);
					},
					error: function (data){
						console.log(data);
					}
				});
			} 
		});
	}

</script>
