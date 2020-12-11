<?php
	if($typepage == 'pageinsert'){
		$ID					= "";
		$amount				= "";
		$detail				= "";
		$person 			= "";
		$TextButton 		= 'เพิ่มข้อมูล';
	}else if($typepage == 'pageedit'){
		$ID					= $Result['Items'][0]['rate_id'];
		$amount				= $Result['Items'][0]['amount'];
		$detail				= $Result['Items'][0]['note'];
		$person 			= $Result['Items'][0]['person'];
		$TextButton 		= 'แก้ไขข้อมูล';
	}
?>

<!--ฟอร์มสร้างเรทราคา + แก้ไข-->
<div class="col-lg-12"><hr></div>
<form id="formRate" class="form-signin" method="post" action="javascript:void(0)">
	<div class="col-lg-12" id="divRegisRate" >
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<div class="form-row">

					<input type="hidden" id="hiddenTypePage" name="hiddenTypePage" value="<?=$typepage?>">
					<input type="hidden" id="hiddenrateID" name="hiddenrateID" value="<?=$ID?>">

					<div class="form-group col-md-12">
						<label><span style="color:red;">*</span> เรทราคา ต่อวัน</label>
						<input type="text" maxlength="6" class="form-control xCNInputNumericWithoutDecimal" id="rateprice" name="rateprice" placeholder="เรทราคา" value='<?=$amount?>'>
						<input type="hidden" id="ratepriceold" name="ratepriceold" value='<?=$amount?>'>
					</div>
					<div class="form-group col-md-12">
						<label>จำนวนคน</label>	
						<select class="jSelectedsingle form-control" name="personrate">
							<option value="1" <?=($person == '1') ? 'selected' : '' ?> > 1 คน </option>
							<option value="2" <?=($person == '2') ? 'selected' : '' ?>> 2 คน </option>
							<option value="3" <?=($person == '3') ? 'selected' : '' ?>> 3 คน </option>
							<option value="4" <?=($person == '4') ? 'selected' : '' ?>> 4 คน </option>
							<option value="5" <?=($person == '5') ? 'selected' : '' ?>> 5 คน </option>
							<option value="6" <?=($person == '6') ? 'selected' : '' ?>> 6 คน </option>
							<option value="7" <?=($person == '7') ? 'selected' : '' ?>> 7 คน </option>
							<option value="8" <?=($person == '8') ? 'selected' : '' ?>> 8 คน </option>
							<option value="9" <?=($person == '9') ? 'selected' : '' ?>> 9 คน </option>
							<option value="10" <?=($person == '10') ? 'selected' : '' ?>> 10 คน </option>
							<option value="10++" <?=($person == '10++') ? 'selected' : '' ?>> มากกว่า 10 คน </option>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label>เงื่อนไข</label>	
						<textarea id="ratedetail" maxlength="255" name="ratedetail" cols="30" rows="3" class="form-control" placeholder="เงื่อนไข"><?=$detail?></textarea>
					</div>
					<div class="form-group col-md-12">
						<button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" onclick="EventSaveOrEdit_rate()"><?=$TextButton?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<!--Validate ทำให้ input กรอกได้เเต่ตัวเลข , ตัวอักษร-->
<script src="<?= base_url('application/assets/js/FormValidate.js')?>"></script>

<script>

	$(document).ready(function() {
		//ช่องจำนวนคน
		$(".jSelectedsingle").select2();
		$(".jSelectedsingle").select2({ width: '100%' , dropdownCssClass: "FontSelect2"});  
	});

	//เพิ่มข้อมูล
	function EventSaveOrEdit_rate(){
		//เช็คว่ากรอกข้อมูลครบหรือยัง

		//ไม่ได้กรอกเรทราคา
		if($('#rateprice').val() == ''){
			$('#rateprice').focus();
			return;
		}

		$.ajax({
			type 			: "POST",
			url 			: "EventInsOrEdit_rate",
			data 			: $('#formRate').serialize(),
			success			: function (Result){
				if('<?=$typepage?>' == 'pageinsert'){ 
					var TitleSwal = 'เพิ่มข้อมูลสำเร็จ';
				}else if('<?=$typepage?>' == 'pageedit'){ 
					var TitleSwal = 'แก้ไขข้อมูลสำเร็จ';
				}

				//มีการใช้งานอยู๋เเก้ไขไม่ได้
				if(Result == 'rate_use'){
					//ไม่ผ่าน
					Swal.fire({
						title: 'กรุณาตรวจสอบความถูกต้อง',
						text: "ราคานี้มีการจองแล้วไม่สามารถปรับเเก้ไขราคาได้",
						icon: "error",
						showCancelButton: false,
						confirmButtonColor: '#ff6868',
						confirmButtonText: 'ตกลง',
					}).then(function (result) {});
				}else{
					//ผ่าน
					Swal.fire({
						title: TitleSwal,
						text: "",
						icon: "success",
						showCancelButton: false,
						confirmButtonColor: '#bfe6a9',
						confirmButtonText: 'ตกลง',
					}).then(function (result) {
						Back_rate();
					});
				}
			},
			error: function (data){
				console.log(data);
			}
		});
	}
</script>
