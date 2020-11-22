<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListBookingAndPayment" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ตรวจสอบการจอง และการชำระเงิน</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddBookingAndPayment" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_BookingAndPayment()">ตรวจสอบการจอง และการชำระเงิน</label> <label class="labelHead label_BookingAndPaymentHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_BookingAndPayment" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า information-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดหน้าตาราง
	LoadTable_BookingAndPayment(1);
	function LoadTable_BookingAndPayment(numberpage){
		$('.ButtonControlPageListBookingAndPayment').show();
		$('.ButtonControlPageAddBookingAndPayment').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_BookingAndPayment",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_BookingAndPayment').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ตรวจสอบข้อมูล
	function Page_BookingAndPayment(typepage,id){
		$('.ButtonControlPageListBookingAndPayment').hide();
		$('.ButtonControlPageAddBookingAndPayment').show();

		$('.label_BookingAndPaymentHead').text(' / ตรวจสอบ');
		
		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_BookingAndPayment",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_BookingAndPayment').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}


	//ย้อนกลับ
	function Back_BookingAndPayment(){
		LoadTable_BookingAndPayment(1);
	}

</script>
