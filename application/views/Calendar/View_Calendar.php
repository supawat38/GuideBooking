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
</script>
