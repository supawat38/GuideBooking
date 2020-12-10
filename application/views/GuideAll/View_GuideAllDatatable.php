<div class="col-md-12 col-12" style="margin-top: 20px;">
	<?php if(empty($result['Items'])){ ?>
		<div><p class="labelContent" style="text-align: center; margin: 50px 0px;"> - ไม่พบข้อมูล - </p></div>
	<?php }else{ ?>
		<div class="row">
			<?php foreach($result['Items'] AS $Key => $Value){ ?>
				<?php 
					//รูปภาพ
					if($Value['guide_image'] == '' || $Value['guide_image'] == null){
						$PathShowImage 		= 'application/assets/images/guide/'.'/NoImage.png';
					}else{
						$PathShowImage 		= 'application/assets/images/guide/'.$Value['guide_image'];
					} 
				?>
				<div class="col-md-12 testimony-wrap py-12" style="padding: 15px; margin-bottom: 20px;">
					<div class="row">
						<div class="col-lg-3">
							<div class="user-img" style="background-image: url(<?=$PathShowImage?>); width: 200px; height: 200px; display: block; margin: 0px auto;"></div>
						</div>
						<div class="col-lg-9">
							<div class="row">
								<div class="col-lg-8"><label class="labelHead">คุณ<?=$Value['firstname']?> <?=($Value['lastname'] == '') ? '' : $Value['lastname']; ?> <?=($Value['gender'] == '1') ? '(ผู้ชาย)' : '(ผู้หญิง)'; ?> เบอร์ติดต่อ : <?=$Value['guide_phone']?> </label></div>
								<div class="col-lg-4"><a class="labelHead" href="Booking_DeteilGuide/<?=$Value['guide_id']; ?>" target="_blank" style="display: block; margin: 0px auto; text-align: right; color: #f98b2d;" >ดูข้อมูลเพิ่มเติม</a></div>
								<div class="col-lg-12">
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">วันเกิด : <?=date('d/m/Y',strtotime($Value['guide_bd']))?></p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">จังหวัด : <?=($Value['province_name'] == '') ? '-' : $Value['province_name']; ?> </p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">อีเมลล์ : <?=($Value['guide_email'] == '') ? '-' : $Value['guide_email']; ?> </p>
									<p class="labelHead" style="margin: 0px 0px 5px 0px;">เกี่ยวกับ : <?=($Value['intro_profile'] == '') ? '-' : $Value['intro_profile']; ?> </p>
									<?php
										//สิ่งที่สนใจ
										$guide_qustions = $Value['guide_qustions'];
										if($guide_qustions != '' || $guide_qustions != null){
											$arrayQustions 	= explode(",",$guide_qustions);
											for($i=0; $i<count($arrayQustions); $i++){
												echo '<div class="GuideTag"><label class="labelHead GuideTaglabel">#'.$arrayQustions[$i].'</label></div>';
											}
										}
									?> 
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
	<div class="col-md-12 text-center" style="margin-top:50px;">
		<nav>
			<div class="block-27">
				<ul class="xCNPagenation">
					<!--ปุ่มย้อนกลับ-->
					<?php if($result['CurrentPage'] == 1){ $DisabledLeft = 'CenterDisabledBTN'; }else{ $DisabledLeft = '-';} ?>
					<li class='<?=$DisabledLeft?>'><a onclick="ClickPage_guideAll('previous')">&lt;</a></li>

					<!--ปุ่มจำนวนหน้า-->
					<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
						<?php 
							if($result['CurrentPage'] == $i){ 
								$Active 		= 'active'; 
							}else{ 
								$Active 		= '';
							}
						?>
						<li class="<?=$Active;?>" onclick="ClickPage_guideAll('<?=$i?>')"><span><?=$i?></span></li>
					<?php } ?>

					<!--ปุ่มไปต่อ-->
					<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'CenterDisabledBTN'; }else{ $DisabledRight = '-'; } ?>
					<li class='<?=$DisabledRight?>'><a onclick="ClickPage_guideAll('next')">&gt;</a></li>
				</ul>
			</div>
		</nav>
	</div>
<?php } ?>

<script>	

	//กด next page 
	function ClickPage_guideAll(Page){
		var PageCurrent = '';
		switch (Page) {
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
			default:
				PageCurrent = Page
		}

		LoadtableGuideAll(PageCurrent);
	}

</script>
