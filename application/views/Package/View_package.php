<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListpackage" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >แพ็กเกจท่องเที่ยว</label>
					</div>
					<div class="col-lg-6 col-6">
						<button class="xButtonInsert pull-right" onClick="Page_package('pageinsert','')">+</button>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddpackage" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_package()">แพ็กเกจ</label> <label class="labelHead label_packageHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_package" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า package-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดหน้าตาราง
	LoadTable_package(1);
	function LoadTable_package(numberpage){
		$('.ButtonControlPageListpackage').show();
		$('.ButtonControlPageAddpackage').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_package",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_package').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//เพิ่มข้อมูลแพ๊คเกจ
	function Page_package(typepage,id){
		$('.ButtonControlPageListpackage').hide();
		$('.ButtonControlPageAddpackage').show();

		if(typepage == 'pageinsert'){
			$('.label_packageHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_packageHead').text(' / แก้ไขข้อมูล');
		}

		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_package",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_package').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ย้อนกลับ
	function Back_package(){
		LoadTable_package(1);
	}

</script>
