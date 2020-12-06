<div class="row" id="ContentReportIncome">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >รายงานรายได้</label>
					</div>
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" style="text-align: right; display: block;" onclick="Print_reportIncome()">พิมพ์รายงาน</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_reportIncome" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า reportIncome-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดหน้าตาราง
	LoadTable_reportIncome(1);
	function LoadTable_reportIncome(numberpage){
		$.ajax({
			type	: "POST",
			url		: "Loadtable_reportIncome",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ftco-loader').removeClass('show');
				$('#odvContent_reportIncome').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	function Print_reportIncome(){
		var $this 			= $(this);
		var originalContent = $('body').html();
		var printArea 		= $('#ContentReportIncome').html();
		$('body').html(printArea);
		window.print();
		$('body').html(originalContent);
	}
</script>
