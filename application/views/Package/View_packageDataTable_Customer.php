<div class="col-md-12 col-12" style="margin-top: 20px;">
	<?php if(empty($result['Items'])){ ?>
		<div><p class="labelContent" style="text-align: center; margin: 50px 0px;"> - ไม่พบข้อมูล - </p></div>
	<?php }else{ ?>
		<div class="row">
			<?php foreach($result['Items'] AS $Key => $Value){ ?>
				<?php 
					if($Value['package_image'] == '' || $Value['package_image'] == null){
						$PathShowImage 		= 'application/assets/images/package/'.'/NoImage.jpg';
					}else{
						$PathShowImage 		= 'application/assets/images/package/'.$Value['package_image'];
					} 
				?>
				<div class="col-md-4">
					<div class="project-wrap">
						<div class="img" style="background-image: url(<?=$PathShowImage?>);">
							<?php 
								$StatusUse = $Value['package_status']; 
								if($StatusUse == 0){
									$TextStatusUse = '- ไม่ใช้งาน';
								}else{
									$TextStatusUse = '- ใช้งาน';
								}
							?>
							<span class="price labelHead">คุณ<?=$Value['firstname']?> <?= ($Value['guide_phone'] == '') ? '' : '('.$Value['guide_phone'].')'?> <?=$TextStatusUse?></span>
						</div>
						<div class="text p-4">
							<?php 
								header('content-type text/html charset=utf-8');
								$namepackage 		= $Value['package_con'];
								$namepackage_length = strlen($namepackage);
								if($namepackage_length >= '100'){
									$TextShow = iconv_substr($Value['package_con'],0,70,'utf-8').'...';
								}else{
									if($namepackage == '' || $namepackage == null){
										$TextShow = 'ไม่มีเงื่อนไข';
									}else{
										$TextShow = $Value['package_con'];
									}
								}
							?>
							<h3 class="labelHead" style="font-weight: bold;"><?=$Value['package_name']?></h3>
							<p class="labelHead CNBlockPackage"><?=$TextShow?></p>
							<div style="text-align: right;">
								<label class="textDowloadFile edit_package" onClick="Page_package('pageedit','<?=$Value['package_id']?>');">แก้ไข</label>
								<label class="textDowloadFile delete_package" onClick="Delete_package('<?=$Value['package_id']?>');">ลบ</label>
								
								<!--ถ้าไม่มีไฟล์จะดาวน์โหลดไม่ได้-->
								<?php if($Value['package_file'] == '' || $Value['package_file'] == null){ ?>
									<label class="textDowloadFileDisabled">ดาวน์โหลด</label>
								<?php }else{ ?>
									<a href="<?=base_url('application/assets/File/package/'.$Value['package_file'])?>"><label class="textDowloadFile">ดาวน์โหลด</label></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
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
					<a class="page-link" aria-label="Previous" onclick="ClickPage_package('Fisrt')"><span aria-hidden="true">&laquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledLeft;?>">
					<a class="page-link" aria-label="Previous" onclick="ClickPage_package('previous')"><span aria-hidden="true">&lsaquo;</span></a>
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
					<li class="page-item <?=$Active;?> " onclick="ClickPage_package('<?=$i?>')"><a class="page-link"><?=$i?></a></li>
				<?php } ?>

				<!--ปุ่มไปต่อ-->
				<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'disabled'; }else{ $DisabledRight = '-'; } ?>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPage_package('next')"><span aria-hidden="true">&rsaquo;</span></a>
				</li>
				<li class="page-item <?=$DisabledRight?>">
					<a class="page-link" aria-label="Next" onclick="ClickPage_package('Last')"><span aria-hidden="true">&raquo;</span></a>
				</li>
			</ul>
		</nav>
	</div>
<?php } ?>

<script>

	//เช็คสิทธิการมองเห็น
	var UserType 	= '<?=$this->session->userdata("session_reftype")?>';
	if(UserType == 2){ //ลูกค้า
		$('.xButtonInsert').hide();  //ซ่อนปุ่มเพิ่มข้อมูล
		$('.edit_package').hide();	 //ซ่อนปุ่มแก้ไขข้อมูล
		$('.delete_package').hide(); //ซ่อนปุ่มลบข้อมูล
	}else{ //ผู้ดูแลระบบ + มัคคุเทศก์ + เจ้าของ สามารถทำได้ทุกอย่าง

	}

	//กด next page 
	function ClickPage_package(Page){
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

		LoadTable_package(PageCurrent);
	}

	//ลบข้อมูล
	function Delete_package(ID){
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
					url 			: "EventDelete_package",
					data 			: { 'ID' : ID },
					success			: function (Result){
						LoadTable_package(1);
					},
					error: function (data){
						console.log(data);
					}
				});
			} 
		});
	}

</script>
