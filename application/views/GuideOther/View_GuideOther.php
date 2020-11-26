<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListguideother" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ข้อมูลมัคคุเทศก์ท่านอื่น</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_guideother" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า guide-->
<?php include_once __DIR__ . '/../script.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_guideother(1);
	function LoadTable_guideother(numberpage){
		$.ajax({
			type	: "POST",
			url		: "Loadtable_guideother",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_guideother').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
</script>
