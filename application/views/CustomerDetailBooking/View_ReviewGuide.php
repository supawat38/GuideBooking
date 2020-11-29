<style>
	.nameguide{
		text-align: center;
		margin: 0px;
		display: block;
		font-weight: bold;
		margin-top: 10px;
	}

	.StarReview{
		font: normal normal normal 30px/1 FontAwesome !important;
		cursor: pointer;
	}
</style>

<?php	
	$ID 				= $result[0]['guide_id'];
	$FirstName 			= $result[0]['firstname'];
	$LastName 			= $result[0]['lastname'];
	$Birthdate			= date('d/m/Y',strtotime($result[0]['guide_bd'])); 
	$Gender				= ($result[0]['gender'] == 1 ) ? 'ชาย' : 'หญิง';
	$Address			= $result[0]['address'];
	$Credit 			= $result[0]['guide_credit'];
	$License 			= $result[0]['guide_license'];
	$PathImage 			= $result[0]['guide_image'];
	$Email 				= $result[0]['guide_email'];
	$Phone 				= $result[0]['guide_phone'];
	$Profile 			= $result[0]['intro_profile'];
	$Status     		= $result[0]['guide_status'];
?>

<div class="col-lg-12 col-md-12">
	<?php 
		if($PathImage == '' || $PathImage == null){
			$PathShowImage 		= base_url('/application/assets/images/guide/') . '/NoImage.png';
			$PathDatabaseImage 	= '';
		}else{
			$PathShowImage 		= base_url('/application/assets/images/guide/') . $PathImage;
			$PathDatabaseImage 	= $PathImage;
		} 
	?>
	<img class="img-responsive xCNImgCenter" style="width:200px; height:200px;" src="<?=$PathShowImage?>">
</div>
<div class="col-lg-12 col-md-12">
	<div class="form-group">
		<label class="labelHead nameguide"><?=$FirstName?> <?=$LastName?> </label>
	</div>
	<div class="form-group">
		<p class="star" style="text-align: center;">
			<span class="fa fa-star-o StarReview VoteStar Star1" data-id="1"></span>
			<span class="fa fa-star-o StarReview VoteStar Star2" data-id="2"></span>
			<span class="fa fa-star-o StarReview VoteStar Star3" data-id="3"></span>
			<span class="fa fa-star-o StarReview VoteStar Star4" data-id="4"></span>
			<span class="fa fa-star-o StarReview VoteStar Star5" data-id="5"></span>
		</p>
		<input type="hidden" id="reviewpoint" name="reviewpoint" value="0">
	</div>
	<div class="form-group">
		<label class="labelHead">แสดงความคิดเห็น</label>	
		<textarea id="reviewGuideText" maxlength="100" name="reviewGuideText" cols="30" rows="3" class="form-control" placeholder="แสดงความคิดเห็น"></textarea>
	</div>
</div>

<script>

	//กดที่ดาว
	$('.VoteStar').click(function() {
		//ทุกครั้งที่กดดาวต้องลบของเก่าออก
		$('.VoteStar').addClass('fa-star-o');
		$('.VoteStar').removeClass('fa-star');

		//ถ้ากด 1 ดาว จะไป hi-light ให้เป็น 2 ดาว โดยการวนลูป
		var NumberStar = $(this).data('id') + 1;
		for(i=0; i<NumberStar; i++){
			$('.Star'+i).removeClass('fa-star-o');
			$('.Star'+i).addClass('fa-star');
		}

		//เก็บค่าไว้ว่าโหวดกี่คะแนน
		$('#reviewpoint').val(NumberStar - 1);
	});
	
	
	//แสดงความคิดเห็น
	$('.ConfirmReviewGuide').one('click', function(event) {
		$('.ConfirmReviewGuide').off('click');
		$('#ModalReviewGuide').modal('hide');
		$.ajax({
			type	: "POST",
			url		: "ReviewGuide",
			data 	: {
						'GuideID'			: '<?=$ID?>',
						'reviewGuideText'	: $('#reviewGuideText').val(),
						'reviewpoint' 		: $('#reviewpoint').val()
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				Swal.fire({
					title: "",
					text: "ขอบคุณสำหรับการแสดงความคิดเห็น",
					icon: "success",
					showCancelButton: false,
					confirmButtonColor: '#bfe6a9',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					
				});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	});

</script>
