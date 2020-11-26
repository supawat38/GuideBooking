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
			data    :{"ActionMode" : 1},
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

	// บันทึกเวลาของ Guide แต่ละคน
	function SaveGuideCalendar(){
		
	    var CalendarSet=[]; 
		$('select[name="CalendarSet[]"] option:selected').each(function() {
			CalendarSet.push($(this).val());
		});
        
		var CalendarDate = [];
		$('input[name="CalendarDate[]"]').each(function() {
			CalendarDate.push($(this).val());
		});
        

		$.ajax({
			type	: "POST",
			url		: "SaveCalendar",
			data    :{
						"ActionMode" : 1,
						"CalendarSet" : CalendarSet , 
						"CalendarDate" : CalendarDate,
						"GuideId" : 1 
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				alert(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

</script>
