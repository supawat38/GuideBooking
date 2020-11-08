<div class="col-md-12 col-12" style="margin-top: 20px;">
	<?php if(empty($result['Items'])){ ?>
		<div class="img" style="
					background-image: url(application/assets/images/comingsoon.png); width: 100%;
					height: 220px;
					background-position: top;
					background-size: contain;
					background-repeat: repeat-x;"></div>
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
							<span class="price labelHead">คุณ<?=$Value['firstname']?> <?= ($Value['guide_phone'] == '') ? '' : '('.$Value['guide_phone'].')'?></span>
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
	<div class="col-md-12 text-center">
		<nav>
			<div class="block-27">
				<ul class="xCNPagenation">
					<!--ปุ่มย้อนกลับ-->
					<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'CenterDisabledBTN'; }else{ $DisabledLeft = '-';} ?>
					<li class='<?=$DisabledLeft?>'><a onclick="ClickPage_package('previous')">&lt;</a></li>

					<!--ปุ่มจำนวนหน้า-->
					<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
						<?php 
							if($result['CurrentPage'] == $i){ 
								$Active 		= 'active'; 
							}else{ 
								$Active 		= '';
							}
						?>
						<li class="<?=$Active;?>" onclick="ClickPage_package('<?=$i?>')"><span><?=$i?></span></li>
					<?php } ?>

					<!--ปุ่มไปต่อ-->
					<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'CenterDisabledBTN'; }else{ $DisabledRight = '-'; } ?>
					<li class='<?=$DisabledRight?>'><a onclick="ClickPage_package('next')">&gt;</a></li>
				</ul>
			</div>
		</nav>
	</div>
<?php } ?>

<script>

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

</script>
