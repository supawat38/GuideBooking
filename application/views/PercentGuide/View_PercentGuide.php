<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListpercentguide" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ข้อมูลมัคคุเทศก์ (แบ่ง %)</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddpercentguide" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_percentguide()">ข้อมูลมัคคุเทศก์ (แบ่ง %)</label> <label class="labelHead label_percentguideHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_percentguide" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า guide-->
<?php include_once __DIR__ . '/../script.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_percentguide(1);
	function LoadTable_percentguide(numberpage){
		$('.ButtonControlPageListpercentguide').show();
		$('.ButtonControlPageAddpercentguide').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_percentguide",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_percentguide').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//เพิ่มข้อมูลผู้ดูแลระบบ
	function Page_percentguide(typepage,id){
		$('.ButtonControlPageListpercentguide').hide();
		$('.ButtonControlPageAddpercentguide').show();

		if(typepage == 'pageinsert'){
			$('.label_percentguideHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_percentguideHead').text(' / แก้ไขข้อมูล');
		}

		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_percentguide",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_percentguide').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ย้อนกลับ
	function Back_percentguide(){
		LoadTable_percentguide(1);
	}

</script>
