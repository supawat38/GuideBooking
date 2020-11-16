<div class="row">
	<div class="col-lg-12" style="margin:10px 0px;">
		<div class="row">
			<div class="col-lg-12 col-12 ButtonControlPageListManageCustomer" style="display:block;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead" >ข้อมูลลูกค้า</label>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-12 ButtonControlPageAddManageCustomer" style="display:none;">
				<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onClick="Back_ManageCustomer()">ข้อมูลลูกค้า</label> <label class="labelHead label_ManageCustomerHead"></label>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div id="odvContent_ManageCustomer" class="row"></div>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ script หน้า information-->
<?php include_once __DIR__ . '/../script.php';?>

<script>
	//โหลดหน้าตาราง
	LoadTable_ManageCustomer(1);
	function LoadTable_ManageCustomer(numberpage){
		$('.ButtonControlPageListManageCustomer').show();
		$('.ButtonControlPageAddManageCustomer').hide();
		$.ajax({
			type	: "POST",
			url		: "Loadtable_ManageCustomer",
			data 	: {
						'numberpage' 		: numberpage
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_ManageCustomer').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}

	//แก้ไขข้อมูลลูกค้า
	function Page_ManageCustomer(typepage,id){
		$('.ButtonControlPageListManageCustomer').hide();
		$('.ButtonControlPageAddManageCustomer').show();

		$('.label_ManageCustomerHead').text(' / แก้ไขข้อมูล');
		
		$.ajax({
			type	: "POST",
			url		: "PageInsOrEdit_ManageCustomer",
			data 	: {
						'typepage' 		: typepage,
						'id'			: id
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {
				$('#odvContent_ManageCustomer').html(Result);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	}


	//ย้อนกลับ
	function Back_ManageCustomer(){
		LoadTable_ManageCustomer(1);
	}

</script>
