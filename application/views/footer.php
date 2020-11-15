		<style>

			.swal2-confirm{
				font-family: THSarabunNew;
				font-size:  25px !important;
				padding : 8px 50px;
			}

			/*CSS สำหรับ footer */ 
			.FontHeadFooter{
				font-family: THSarabunNew;
				font-size:  28px !important;
				color: #2f2f2f !important;
			}

			.FontDetailFooter{
				font-family: THSarabunNew;
				font-size:  28px !important;
				color: #2f2f2f !important;
			}

			/*CSS สำหรับ Modal */ 
			.modal {
				padding-right: 0px !important;
			}

			/*CSS ส่วนของ From ลูกค้าทั่วไป */
			.FontError{
				color: red !important;
				text-align: right !important;
				display: block !important;
				font-size:22px !important;
				margin-bottom: 0px;
			}

			#ModalLogin label{
				font-family: THSarabunNew;
				font-size:  25px;
				color : black;
			}

			#ModalLogin input{
				font-family: THSarabunNew;
				font-size:  20px !important;
			}

			.FontLogin{
				font-family: THSarabunNew;
				font-size:  28px !important;
				margin: 0px;
				color: #FFF !important;
			}

			.FontLoginClick{
				font-family: THSarabunNew;
				font-size:  22px !important;
				padding: 5px 30px;
			}
		</style>
		
		<footer class="ftco-footer bg-bottom ftco-no-pt" style="margin-top: 60px; background-image: url(application/assets/images/bg_3.jpg);">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md pt-5">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2 FontHeadFooter">ติดตามเราได้ทาง</h2>
							<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
								<li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2 FontHeadFooter">ติดต่อเรา</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon fa fa-phone"></span><span class="text FontDetailFooter">+2 392 3929 210</span></li>
									<li><span class="icon fa fa-paper-plane"></span><span class="text FontDetailFooter">info@yourdomain.com</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
		</footer>

		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
		
		<!-- popup เข้าสู่ระบบ -->
		<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background: #ec6941; padding: 10px 20px;">
						<label class="FontLogin"> เข้าสู่ระบบ</label>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label> ชื่อเข้าใช้งาน</label>
								<input type="text" maxlength="50" class="form-control formlogininput" autocomplete="off" id="LoginID" name="LoginID" placeholder="ชื่อเข้าใช้งาน">
							</div>
							<div class="form-group col-md-12">
								<label> รหัสผ่าน</label>
								<input type="password" maxlength="50" class="form-control formlogininput" autocomplete="off"  id="LoginPassword" name="LoginPassword" placeholder="รหัสผ่าน">
							</div>
							<div class="form-group col-md-12 showerror" style="display:none; margin-bottom: 0px;">
								<label class="FontError"> ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary FontLoginClick">เข้าใช้งาน</button>
					</div>
				</div>
			</div>
		</div>

		<!--Footer-->
		<?php include_once __DIR__ . '/script.php';?>
				
		<script>
			//ทุกครั้งที่กดที่ input ใน login กล่อง validate ข้อมูลผิดพลาดจะหายไป
			$('.formlogininput').click(function(){
				$('.showerror').hide();
			});

			//เข้าสู่ระบบ
			$('.FontLoginClick').click(function(){
				if($('#LoginID').val() == ''){
					$('#LoginID').focus();
					return;
				}

				if($('#LoginPassword').val() == ''){
					$('#LoginPassword').focus();
					return;
				}

				$.ajax({
					type 			: "POST",
					url 			: "login",
					data 			: { 'username' : $('#LoginID').val() , 'password' : $('#LoginPassword').val() },
					success			: function(Result){
						if(Result == 'notfound'){
							$('#LoginID').val('');
							$('#LoginPassword').val('');
							$('.showerror').show();
						}else{
							window.location.href = "main";
						}
					},
					error: function (data){
						console.log(data);
					}
				});

			});
		</script>
	</body>
</html>
