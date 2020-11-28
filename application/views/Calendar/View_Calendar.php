<div id="GuideCalendarContent"></div>

<script>
	//โหลดหน้าจอตารางงานมัคคุเทศก์
	$('document').ready(function(){
		LoadGuideCalendar();	 
	});

    // ดึงตารางงานของมัคคุเทศก์
	function LoadGuideCalendar(){
		
		var calendarYearSearch = $("#calendarYearSearch").children("option:selected").val();
		var calendarMonthSearch = $("#calendarMonthSearch").children("option:selected").val();

		$.ajax({
			type	: "POST",
			url		: "LoadCalendar",
			data    : {
				        "calendarYearSearch" :  calendarYearSearch,
			            "calendarMonthSearch" : calendarMonthSearch
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ftco-loader').removeClass('show');
				$('#GuideCalendarContent').html(Result);
				$('#calendarYearSearch option[value='+calendarYearSearch+']').attr('selected','selected');
				$('#calendarMonthSearch option[value='+calendarMonthSearch+']').attr('selected','selected');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}
    
	// สร้างตารางเวลาของ Guide แต่ละคน
	function AddGuideCalendar(){
		
		var AddYear = $("#AddEditYear").children("option:selected").val();
		var AddMonth = $("#AddEditMonth").children("option:selected").val();

		$.ajax({
			type	: "POST",
			url		: "AddCalendar",
			data    :{
						"ActionMode" : 1,
						"AddYear":AddYear,
						"AddMonth":AddMonth
					 },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#GuideCalendarContent').html(Result);
				setTimeout(function(){
					$('#AddEditYear option[value='+AddYear+']').attr('selected','selected');
				    $('#AddEditMonth option[value='+AddMonth+']').attr('selected','selected');
				 }, 300);
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	// ตรวจสอบการสร้าง calendar
	function CheckAddGuideCalendar(){

		//alert('check add calendar');
		
		var AddYear = $("#AddEditYear").children("option:selected").val();
		var AddMonth = $("#AddEditMonth").children("option:selected").val();

		if(AddYear == ''){
           alert('กรุณาเลือกปีที่ต้องการสร้างตารางงาน');
		}else if(AddMonth == ''){
		   alert('กรุณาเลือกเดือนที่ต้องการสร้างตารางงาน');
		}else{
				$.ajax({
					type	: "POST",
					url		: "CheckAddCalendar",
					data    :{"AddYear":AddYear,"AddMonth":AddMonth},
					cache	: false,
					timeout	: 0,
					success	: function (Result) {
						if(Result > 0){
							alert('ตารางเวลานี้มีอยู่แล้วในระบบ ไม่สามารถสร้างซ้ำได้ กรุณาเลือกรายใหม่');
							$('#AddEditYear option[value=""]').attr('selected','selected');
							$('#AddEditMonth option[value=""]').attr('selected','selected');
							setTimeout(function(){
								AddGuideCalendar()
							}, 300);

						}else{
							AddGuideCalendar();
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert(jqXHR, textStatus, errorThrown);
					}
			    });
		}
		
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
        
        var ActionMode = $("#ActionMode").val();

		$.ajax({
			type	: "POST",
			url		: "SaveCalendar",
			data    :{
						"ActionMode"   : ActionMode,
						"CalendarSet"  : CalendarSet , 
						"CalendarDate" : CalendarDate
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				console.log(Result);

				if(ActionMode == '1'){ 
					var TitleSwal = 'สร้างตารางงานสำเร็จ';
				}else if(ActionMode == '2'){ 
					var TitleSwal = 'แก้ไขข้อมูลสำเร็จ';
				}

				Swal.fire({
					title: TitleSwal,
					text: "",
					icon: "success",
					showCancelButton: false,
					confirmButtonColor: '#bfe6a9',
					confirmButtonText: 'ตกลง',
				}).then(function (result) {
					LoadGuideCalendar();
				});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	// แก้ไขตารางเวลาของ Guide แต่ละคน
	function EditGuideCalendar(calenYear,calenMonth){

		$.ajax({
			type	: "POST",
			url		: "EditCalendar",
			data    :{
						"ActionMode" : 2,
						"EditcalenYear" : calenYear , 
						"EditcalenMonth" : calenMonth
					  },
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

	// ลบตารางเวลาของ Guide 
	function DeleteGuideCalendar(calenYear,calenMonth){
		if(confirm('คุณต้องการลบตารางงานที่เลือกใช่หรือไม่ ?')){
				$.ajax({
					type	: "POST",
					url		: "DeleteCalendar",
					data    :{
								"calenYear" : calenYear , 
								"calenMonth" : calenMonth
							},
					cache	: false,
					timeout	: 0,
					success	: function (Result) {
						alert('ลบข้อมูลตารางงานสำเร็จ');
						LoadGuideCalendar();

					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert(jqXHR, textStatus, errorThrown);
					}
				});
		}
	}

</script>
