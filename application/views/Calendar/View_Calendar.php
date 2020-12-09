<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageCalender" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ตารางงาน</label>
					</div>
					<div class="col-lg-6 col-6">
						<button class="xButtonInsert pull-right" onClick="AddGuideCalendar('pageinsert')">+</button>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddCalender" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="LoadGuideCalendar()">ตารางงาน</label> <label class="labelHead label_CalenderHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="GuideCalendarContent" class="row"></div>
			</div>
		</div>
	</div>
</div>


<script>
	
    //โหลดหน้าตาราง
	LoadGuideCalendar();
	function LoadGuideCalendar(){

		$('.ButtonControlPageCalender').show();
		$('.ButtonControlPageAddCalender').hide();
		var calendarYearSearch 	= $("#calendarYearSearch").children("option:selected").val();
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
	function AddGuideCalendar(typepage){
		
		$('.ButtonControlPageCalender').hide();
		$('.ButtonControlPageAddCalender').show();

		if(typepage == 'pageinsert'){
			$('.label_CalenderHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_CalenderHead').text(' / แก้ไขข้อมูล');
		}

		var AddYear 	= $("#AddEditYear").children("option:selected").val();
		var AddMonth 	= $("#AddEditMonth").children("option:selected").val();
		$.ajax({
			type	: "POST",
			url		: "AddCalendar",
			data    :{
						"ActionMode" 	: 1,
						"AddYear"		: AddYear,
						"AddMonth"		: AddMonth
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

		var AddYear 	= $("#AddEditYear").children("option:selected").val();
		var AddMonth 	= $("#AddEditMonth").children("option:selected").val();

		if(AddYear == ''){
		   Swal.fire({
				title: 'กรุณาตรวจสอบความถูกต้อง',
				text: "กรุณาเลือกปีที่ต้องการสร้างตารางงาน",
				icon: "error",
				showCancelButton: false,
				confirmButtonColor: '#ff6868',
				confirmButtonText: 'ตกลง',
			}).then(function (result) {});
		}else if(AddMonth == ''){
		   Swal.fire({
				title: 'กรุณาตรวจสอบความถูกต้อง',
				text: "กรุณาเลือกเดือนที่ต้องการสร้างตารางงาน",
				icon: "error",
				showCancelButton: false,
				confirmButtonColor: '#ff6868',
				confirmButtonText: 'ตกลง',
			}).then(function (result) {});
		}else{
			$.ajax({
				type	: "POST",
				url		: "CheckAddCalendar",
				data    :{"AddYear":AddYear,"AddMonth":AddMonth},
				cache	: false,
				timeout	: 0,
				success	: function (Result) {
					if(Result > 0){
						Swal.fire({
							title: 'ตารางเวลานี้มีอยู่แล้วในระบบ',
							text: "ไม่สามารถสร้างซ้ำได้ กรุณาเลือกรายการใหม่",
							icon: "error",
							showCancelButton: false,
							confirmButtonColor: '#ff6868',
							confirmButtonText: 'ตกลง',
						}).then(function (result) {
							$('#AddEditYear option[value=""]').attr('selected','selected');
							$('#AddEditMonth option[value=""]').attr('selected','selected');
							setTimeout(function(){
								AddGuideCalendar()
							}, 300);
						});
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
			
		$('.ButtonControlPageCalender').hide();
		$('.ButtonControlPageAddCalender').show();
		$('.label_CalenderHead').text(' / แก้ไขข้อมูล');

		$.ajax({
			type	: "POST",
			url		: "EditCalendar",
			data    :{
						"ActionMode" 		: 2,
						"EditcalenYear" 	: calenYear , 
						"EditcalenMonth" 	: calenMonth
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
		Swal.fire({
			title: "ลบข้อมูล ? ",
			text: "กดยืนยันเพื่อลบข้อมูล",
			showCancelButton: false,
			confirmButtonColor: '#ff6868',
			confirmButtonText: 'ยืนยัน',
		}).then(function (result) {
			if (result.isConfirmed) {
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
		});
	}

</script>
