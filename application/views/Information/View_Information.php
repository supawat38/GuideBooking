<div class="contentInformation"></div>

<!--โหลดไฟล์ script หน้า information-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดข้อมูล
	LoadcontentInformation();
	function LoadcontentInformation(){
		$.ajax({
			type	: "POST",
			url		: "UpdateInformation",
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('.contentInformation').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
</script>
