
<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageList" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ข้อมูลผู้ดูแลระบบ</label>
					</div>
					<div class="col-lg-6 col-6">
						<button class="xButtonInsert pull-right" onClick="Page_Admin('pageinsert','')">+</button>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAdd" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_Admin()">ข้อมูลผู้ดูแลระบบ</label> <label class="labelHead label_AdminHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_Admin" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script-->
<?php include __DIR__ . '/../script.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_Admin(1);
	function LoadTable_Admin(numberpage){
		$('.ButtonControlPageList').show();
		$('.ButtonControlPageAdd').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_Admin",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_Admin').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//เพิ่มข้อมูลผู้ดูแลระบบ
	function Page_Admin(typepage,id){
		$('.ButtonControlPageList').hide();
		$('.ButtonControlPageAdd').show();

		if(typepage == 'pageinsert'){
			$('.label_AdminHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_AdminHead').text(' / แก้ไขข้อมูล');
		}

		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_Admin",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_Admin').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ย้อนกลับ
	function Back_Admin(){
		LoadTable_Admin(1);
	}

</script>
