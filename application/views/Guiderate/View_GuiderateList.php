<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListrate" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >กำหนดราคา</label>
					</div>
					<div class="col-lg-6 col-6">
						<button class="xButtonInsert pull-right" onClick="Page_rate('pageinsert','')">+</button>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddrate" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_rate()">กำหนดราคา</label> <label class="labelHead label_rateHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_rate" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../script.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_rate(1);
	function LoadTable_rate(numberpage){
		$('.ButtonControlPageListrate').show();
		$('.ButtonControlPageAddrate').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_rate",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_rate').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//เพิ่มข้อมูลผู้ดูแลระบบ
	function Page_rate(typepage,id){
		$('.ButtonControlPageListrate').hide();
		$('.ButtonControlPageAddrate').show();

		if(typepage == 'pageinsert'){
			$('.label_rateHead').text(' / เพิ่มข้อมูล');
		}else{
			$('.label_rateHead').text(' / แก้ไขข้อมูล');
		}

		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_rate",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_rate').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//ย้อนกลับ
	function Back_rate(){
		LoadTable_rate(1);
	}

</script>
