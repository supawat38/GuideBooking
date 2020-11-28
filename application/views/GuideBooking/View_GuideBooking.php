<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListguidebooking" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ข้อมูลการจอง</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddguidebooking" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_guidebooking()">ข้อมูลการจอง</label> <label class="labelHead label_guidebookingHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_guidebooking" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า guide-->
<?php include_once __DIR__ . '/../script.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_guidebooking(1);
	function LoadTable_guidebooking(numberpage){
		$('.ButtonControlPageListguidebooking').show();
		$('.ButtonControlPageAddguidebooking').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_guidebooking",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#ftco-loader').removeClass('show');
				$('#odvContent_guidebooking').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//เพิ่มข้อมูลผู้ดูแลระบบ
	function Page_guidebooking(typepage,id){
		$('.ButtonControlPageListguidebooking').hide();
		$('.ButtonControlPageAddguidebooking').show();

		if(typepage == 'pageinsert'){
			$('.label_guidebookingHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_guidebookingHead').text(' / รายละเอียดการจอง');
		}

		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_guidebooking",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_guidebooking').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ย้อนกลับ
	function Back_guidebooking(){
		LoadTable_guidebooking(1);
	}

</script>
