<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container ContentCustomerBookingAll">
		<div class="col-lg-12" style="margin:70px 0px 10px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-12">
					<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">ข้อมูลการจองของคุณ</p>
				</div>
				<div class="col-lg-12">
					<div id="ContentCustomerBooking"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--โหลดไฟล์ script-->
<?php include __DIR__ . '/../footer.php';?>

<script>

	//ข้อมูลการจองทั้งหมดของคุณ
	LoadtableCustomerBooking(1)
	function LoadtableCustomerBooking(numberpage){
		$.ajax({
			type	: "POST",
			url		: "LoadtableCustomerBooking",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ContentCustomerBooking').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	};
</script>
