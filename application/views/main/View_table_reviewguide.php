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
				<div class="col-md-4">
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">

								<p class="star">
									<?php   
										//สร้าง array เก็บดาวเป็นค่าว่างทั้งหมด 5 ตัว
										$ArrayStar = ['fa-star-o','fa-star-o','fa-star-o','fa-star-o','fa-star-o'];

										//วนลูป array ถ้าได้ 3 คะแนน array ตัวที่ 1 - 3 ก็ให้เปลี่ยนชื่อใหม่
										for($i=0; $i<(int)$Value['POINT']; $i++){
											$ArrayStar[$i] = 'fa-star';
										} 
									?>
									<span class="fa <?=$ArrayStar[0]?>"></span>
									<span class="fa <?=$ArrayStar[1]?>"></span>
									<span class="fa <?=$ArrayStar[2]?>"></span>
									<span class="fa <?=$ArrayStar[3]?>"></span>
									<span class="fa <?=$ArrayStar[4]?>"></span>
								</p>
								<div style="max-height: 100px; min-height: 100px;"><p class="mb-4 labelHead"><?=$Value['review_text']?></p></div>
								<div class="d-flex align-items-center">
									<?php 
										$PathImage = $Value['guide_image'];
										if($PathImage == '' || $PathImage == null){
											$PathShowImage 		= base_url('/application/assets/images/guide/') . '/NoImage.png';
											$PathDatabaseImage 	= '';
										}else{
											$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
											$PathDatabaseImage 	= $PathImage;
										} 
									?>
									<div class="user-img" style="background-image: url('<?=$PathShowImage?>')"></div>
									<div class="pl-3">
										<p class="labelHead"><?=$Value['firstname']?> <?=$Value['lastname']?></p>
										<span class="position"><?=date('d/m/Y',strtotime($Value['review_date']))?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>

<?php if(!empty($result['Items'])){ ?>
	<div class="col-md-12 text-center" style="margin-top: 40px;">
		<nav>
			<div class="block-27">
				<ul class="xCNPagenationReviewGuide">
					<!--ปุ่มย้อนกลับ-->
					<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'CenterDisabledBTN'; }else{ $DisabledLeft = '-';} ?>
					<li class='<?=$DisabledLeft?>'><a onclick="ClickPage_package('previous')" style="color: #FFF;">&lt;</a></li>

					<!--ปุ่มจำนวนหน้า-->
					<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
						<?php 
							if($result['CurrentPage'] == $i){ 
								$Active 		= 'active'; 
							}else{ 
								$Active 		= '';
							}
						?>
						<li class="<?=$Active;?>" onclick="ClickPage_package('<?=$i?>')"><span style="color: #FFF;"><?=$i?></span></li>
					<?php } ?>

					<!--ปุ่มไปต่อ-->
					<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'CenterDisabledBTN'; }else{ $DisabledRight = '-'; } ?>
					<li class='<?=$DisabledRight?>'><a onclick="ClickPage_package('next')" style="color: #FFF;">&gt;</a></li>
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
				PageOld 		= $('.xCNPagenationReviewGuide .active').text(); 
				PageNew 		= parseInt(PageOld, 10) + 1; 
				PageCurrent 	= PageNew
			break;
			case 'previous': //กดปุ่ม Previous
				PageOld 		= $('.xCNPagenationReviewGuide .active').text(); 
				PageNew 		= parseInt(PageOld, 10) - 1; 
				PageCurrent 	= PageNew
			break;
			case 'Last': //กดหน้าสุดท้าย
				PageCurrent 	= '<?=$result['EndPage']?>';
			break;
			default:
				PageCurrent = Page
		}

		LoadTable_reviewGuide(PageCurrent);
	}

</script>
