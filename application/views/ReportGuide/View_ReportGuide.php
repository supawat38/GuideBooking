<div class="row" id="ContentReportGuide">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >รายงานมัคคุเทศก์ยอดนิยม</label>
					</div>
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" style="text-align: right; display: block;" onclick="Print_reportGuide()">พิมพ์รายงาน</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_reportGuide" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า reportGuide-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดหน้าตาราง
	LoadTable_reportGuide(1);
	function LoadTable_reportGuide(numberpage){
		$.ajax({
			type	: "POST",
			url		: "Loadtable_reportGuide",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ftco-loader').removeClass('show');
				$('#odvContent_reportGuide').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	function Print_reportGuide(){
		var $this 			= $(this);
		var originalContent = $('body').html();
		var printArea 		= $('#ContentReportGuide').html();
		$('body').html(printArea);
		window.print();
		$('body').html(originalContent);
	}
</script>
