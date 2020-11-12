<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="margin:70px 0px;">
				<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 15px;">
					<div class="col-lg-12 col-12 ButtonControlPageList" style="display:block;">
						<div class="row">
							<div class="col-lg-6 col-6">
								<label class="labelHead" >กำหนดราคา</label>
							</div>
							<div class="col-lg-6 col-6">
								<button class="xButtonInsert pull-right" onClick="Page_rate('pageinsert','')">+</button>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-12 ButtonControlPageAdd" style="display:none;">
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
	</div>
</section>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../footer.php';?>

<script>

	//โหลดหน้าตาราง
	LoadTable_rate(1);
	function LoadTable_rate(numberpage){
		$('.ButtonControlPageList').show();
		$('.ButtonControlPageAdd').hide();
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
		$('.ButtonControlPageList').hide();
		$('.ButtonControlPageAdd').show();

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
