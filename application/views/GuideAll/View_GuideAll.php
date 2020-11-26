<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<div class="col-lg-12" style="margin:70px 0px 10px 0px;">
			<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
				<div class="col-lg-12">
					<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">มัคคุเทศก์</p>
				</div>
				<div class="col-lg-12">
					<div id="ContentGulideAll"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--โหลดไฟล์ script หน้า customer-->
<?php include __DIR__ . '/../footer.php';?>

<!--Validate ทำให้ input กรอกได้เเต่ตัวเลข , ตัวอักษร-->
<script src="<?= base_url('application/assets/js/FormValidate.js')?>"></script>

<script>

	//ข้อมูลของไกด์ทั้งหมด
	LoadtableGuideAll(1)
	function LoadtableGuideAll(numberpage){
		$.ajax({
			type	: "POST",
			url		: "LoadtableGuideAll",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ContentGulideAll').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	};
</script>
