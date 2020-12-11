<div class="col-md-12 col-12" style="margin-top: 20px;">
	<?php if(empty($result['Items'])){ ?>
		<div><p class="labelContent" style="text-align: center; margin: 50px 0px;"> - ไม่พบข้อมูล - </p></div>
	<?php }else{ ?>
		<div class="row">
			<?php foreach($result['Items'] AS $Key => $Value){ ?>
				<?php 	

					//รหัสไกด์ , จังหวัด , เรทราคา , วันที่เริ่ม , วันที่สิ้นสุด
					$Data = array(
						'GuideID' 		=> $Value['guide_id'],
						'ProvinceID' 	=> $provice,
						'RateID'		=> $personbookig,
						'DateStart' 	=> $datestartbooking,
						'DateStop' 		=> $datestopbooking
					);
					$PackData = json_encode($Data);

					//รูปภาพ
					if($Value['guide_image'] == '' || $Value['guide_image'] == null){
						$PathShowImage 		= 'application/assets/images/guide/'.'NoImage.png';
					}else{
						$PathShowImage 		= 'application/assets/images/guide/'.$Value['guide_image'];
					} 
				?>
				<div class="col-md-12 testimony-wrap py-12" style="padding: 15px; margin-bottom: 20px;">
					<div class="row">
						<div class="col-lg-3">
							<div class="user-img" style="background-image: url(<?=$PathShowImage?>); width: 200px; height: 200px; display: block; margin: 0px auto;"></div>
						</div>
						<div class="col-lg-7">
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
							<label class="labelHead">คุณ<?=$Value['firstname']?> <?=($Value['lastname'] == '') ? '' : $Value['lastname']; ?> <?=($Value['gender'] == '1') ? '(ผู้ชาย)' : '(ผู้หญิง)'; ?></label>
							<p class="labelHead" style="margin: 0px 0px 5px 0px;">เกี่ยวกับ : <?=($Value['intro_profile'] == '') ? '-' : $Value['intro_profile']; ?> </p>
							<p class="labelHead" style="margin: 0px 0px 5px 0px;">เงื่อนไข : <?=($Value['note'] == '') ? '-' : $Value['note']; ?> </p>

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
						<div class="col-lg-2" style="border-left: 1px solid #dee2e6;">
							<p class="labelHead" style="font-weight: bold; color: #ec6941; font-size: 25px !important; text-align: left;">THB : <?=number_format($Value['amount'],2)?></p>
							<button type="button" class="align-self-stretch btn btn-primary BTNSelectBooking" style="width: 100%;" onclick='BookingGuide(<?=$PackData?>)';>เลือก</button>
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
					<li class='<?=$DisabledLeft?>'><a onclick="ClickPage_researchguide('previous')">&lt;</a></li>

					<!--ปุ่มจำนวนหน้า-->
					<?php for($i=max($result['CurrentPage']-2, 1); $i<=max(0, min($result['EndPage'],$result['CurrentPage']+2)); $i++){?>
						<?php 
							if($result['CurrentPage'] == $i){ 
								$Active 		= 'active'; 
							}else{ 
								$Active 		= '';
							}
						?>
						<li class="<?=$Active;?>" onclick="ClickPage_researchguide('<?=$i?>')"><span><?=$i?></span></li>
					<?php } ?>

					<!--ปุ่มไปต่อ-->
					<?php if($result['CurrentPage'] >= $result['EndPage']){ $DisabledRight = 'CenterDisabledBTN'; }else{ $DisabledRight = '-'; } ?>
					<li class='<?=$DisabledRight?>'><a onclick="ClickPage_researchguide('next')">&gt;</a></li>
				</ul>
			</div>
		</nav>
	</div>
<?php } ?>

<script>	

	//กด next page 
	function ClickPage_researchguide(Page){
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

		var TypeClick = $('#hiddenClickTab').val();
		LoadtableGuide(PageCurrent,TypeClick);
	}

	//กดเลือก Booking
	function BookingGuide(parameter){
		
		//เช็คก่อนว่า login แล้วหรือยัง
		var checklogin = '<?=$this->session->userdata('session_username')?>';
		if(checklogin == null || checklogin == ''){
			$('#ModalLoginBeforeBooking').modal('show');

			//เข้าสู่ระบบ
			$('.FontLoginBeforeBookingClick').click(function(){
				if($('#LoginIDBeforeBooking').val() == ''){
					$('#LoginIDBeforeBooking').focus();
					return;
				}

				if($('#LoginPasswordBeforeBooking').val() == ''){
					$('#LoginPasswordBeforeBooking').focus();
					return;
				}

				$.ajax({
					type 			: "POST",
					url 			: "login",
					data 			: { 'username' : $('#LoginIDBeforeBooking').val() , 'password' : $('#LoginPasswordBeforeBooking').val() },
					success			: function(Result){
						if(Result == 'notfound'){
							$('#LoginIDBeforeBooking').val('');
							$('#LoginPasswordBeforeBooking').val('');
							$('.showerror').show();
						}else{
							if(Result == 2){ //ถ้าเป็นลูกค้า
								$('#ModalLoginBeforeBooking').modal('hide');

								setTimeout(function(){ 
									//login แล้ว
									LoadViewBooking(parameter);
								}, 1000);
							}else{
								window.location.href = "Backend";
							}
						}
					},
					error: function (data){
						console.log(data);
					}
				});
			});
		}else{
			//login แล้ว
			LoadViewBooking(parameter);
		}
	}

	//โหลดหน้าจอบุ๊คกิ๊ง
	function LoadViewBooking(parameter){
		$.ajax({
			type 			: "POST",
			url 			: "Booking_Guide",
			data 			: { 
				'GuideID' 		: parameter.GuideID ,
				'ProvinceID' 	: parameter.ProvinceID , 
				'RateID' 		: parameter.RateID , 
				'DateStart' 	: parameter.DateStart , 
				'DateStop' 		: parameter.DateStop
			},
			success			: function(Result){
				$('#ContentReseachGuideBooking').html(Result);
			},
			error: function (data){
				console.log(data);
			}
		});
	}

</script>
