<div class="contentInformation"></div>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../script.php';?>

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
