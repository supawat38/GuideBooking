<style>	
	/*CSS ปุ่ม */ 
	.BTNRegis{
		width	:250px; 
		font-family: THSarabunNew;
		font-size:  25px !important;
		border-radius: 0px;
	}

	.BTNRegisActive{
		opacity: 1;
	}

	.BTNRegisDefaule{
		opacity: 0.5;
	}

	/*CSS สำหรับ การเลือกรูปภาพ */ 
	.xCNImgCenter{
		border-radius: 50%;
		width: 300px;
		height: 300px;
		text-align: center;
		display: block;
		margin: 0px auto;
		border: 1px solid #e0e0e0;
	}

	.xCNChooseImage{
		margin: 45px auto;
		display: block;
		padding: 8px 80px !important;
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS สำหรับ กดปุ่มลงทะเบียน */ 
	.BTNConfirmRegis{
		width	:250px; 
		font-family: THSarabunNew;
		font-size:  25px !important;
		border-radius: 0px;
	}

	/*CSS ส่วนของ From ผู้ดูแลระบบ */
	#divRegisAdmin label{
		font-family: THSarabunNew;
		font-size:  25px !important;
		color : black;
	}

	#divRegisAdmin input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	#divRegisAdmin input , textarea{
		font-family: THSarabunNew;
		font-size:  20px !important;
	}

	/*CSS สำหรับ selected*/ 
	.FontSelect2{
		font-family: THSarabunNew;
		font-size:  22px !important;
	}

	.select2-selection__rendered {
		font-family: THSarabunNew;
		font-size:  22px !important;
	}

	.select2-selection__rendered {
		line-height: 40px !important;
	}

	.select2-container .select2-selection--single {
		height: 40px !important;
	}

	.select2-selection__arrow{
		top : 5px !important;
	}

	.select2-container--default .select2-selection--single{
		border: 1px solid #ced4da;
	}

	.select2-container--default .select2-selection--multiple{
		border: 1px solid #ced4da !important;
	}

	/*CSS สำหรับ หน้าจอแจ้งเตือน */ 
	.swal2-title{
		font-family: THSarabunNew;
		font-size:  30px !important;
	}

	.swal2-html-container{
		font-family: THSarabunNew;
		font-size:  30px !important;
	}

	.swal2-confirm{
		font-family: THSarabunNew;
		font-size:  25px !important;
		padding : 0px 50px;
	}
	
</style>

<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="margin:70px;">
				<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
					555555555
				</div>
			</div>
		</div>
	</div>
</section>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../footer.php';?>

<!--Validate ทำให้ input กรอกได้เเต่ตัวเลข , ตัวอักษร-->
<script src="<?= base_url('application/assets/js/FormValidate.js')?>"></script>

