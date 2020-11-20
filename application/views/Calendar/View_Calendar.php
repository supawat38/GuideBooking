<div id="GuideCalendarContent"></div>

<script>
	//โหลดหน้าจอตารางงานมัคคุเทศก์
	$('document').ready(function(){
		LoadGuideCalendar();
	});

	function LoadGuideCalendar(){
		$.ajax({
			type	: "POST",
			url		: "LoadCalendar",
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#GuideCalendarContent').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
    
	// สร้างตารางเวลาของ Guide แต่ละคน
	function AddGuideCalendar(){
		$.ajax({
			type	: "POST",
			url		: "AddCalendar",
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#GuideCalendarContent').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
</script>
