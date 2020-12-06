
<section class="ftco-section ftco-no-pb ftco-no-pt" style="background: #FFF;" id="ContentReseachGuideBooking">
	<div class="container">
		<div class="row">
			<div class="col-lg-12" style="margin:70px 0px 10px 0px;">
				<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
					<div class="col-lg-8">
						<p class="labelHead" style="font-size: 30px !important; font-weight: bold; margin-bottom: 0px;">ตัวกรอง</p>
						<label class="labelHead" >จังหวัด<?=$provincename[0]['province_name']; ?> </label>
						<label class="labelHead" >&nbsp;<?=$personbookig ?> คน</label>
						<label class="labelHead" >&nbsp;วันที่ <?=$datestartbooking ?> ถึง <?=$datestopbooking ?></label>
					</div>
					<div class="col-lg-4">
						<p class="labelHead" style="font-size: 30px !important; color:#FFF; margin-bottom: 0px;">.</p>
						<a class="labelHead" href="main" style="display: block; margin: 0px auto; text-align: right; color: #f98b2d;" >เปลี่ยนการค้นหา</a>
					</div>
				</div>
			</div>

			<div class="col-lg-12" style="margin:20px 0px;">
				<div class="row" style="box-shadow: 0px 10px 23px -8px rgba(0, 0, 0, 0.11); padding: 20px;">
					<div class="col-lg-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link labelHead active" id="AllGuide-tab" onclick="LoadtableGuide(1,'All')" data-toggle="tab" href="#AllGuide" role="tab" aria-controls="AllGuide" aria-selected="true">ทั้งหมด</a>
							</li>
							<li class="nav-item">
								<a class="nav-link labelHead" id="ReviewGuide-tab" onclick="LoadtableGuide(1,'Review')" data-toggle="tab" href="#ReviewGuide" role="tab" aria-controls="ReviewGuide" aria-selected="false">ได้รับความนิยม</a>
							</li>
							<li class="nav-item">
								<a class="nav-link labelHead" id="PriceGuide-tab" onclick="LoadtableGuide(1,'Price')" data-toggle="tab" href="#PriceGuide" role="tab" aria-controls="PriceGuide" aria-selected="false">ราคา</a>
							</li>
						</ul>
						<input type="hidden" id="hiddenClickTab" name="hiddenClickTab" value="1">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="AllGuide" role="tabpanel" aria-labelledby="AllGuide-tab"></div>
							<div class="tab-pane fade" id="ReviewGuide" role="tabpanel" aria-labelledby="ReviewGuide-tab"></div>
							<div class="tab-pane fade" id="PriceGuide" role="tabpanel" aria-labelledby="PriceGuide-tab"></div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- popup เข้าสู่ระบบตอนกด Booking -->
<div class="modal fade" id="ModalLoginBeforeBooking" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #ec6941; padding: 10px 20px;">
				<label class="FontLogin"> เข้าสู่ระบบ</label>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label> ชื่อเข้าใช้งาน</label>
						<input type="text" maxlength="50" class="form-control formlogininput" autocomplete="off" id="LoginIDBeforeBooking" name="LoginIDBeforeBooking" placeholder="ชื่อเข้าใช้งาน">
					</div>
					<div class="form-group col-md-12">
						<label> รหัสผ่าน</label>
						<input type="password" maxlength="50" class="form-control formlogininput" autocomplete="off"  id="LoginPasswordBeforeBooking" name="LoginPasswordBeforeBooking" placeholder="รหัสผ่าน">
					</div>
					<div class="form-group col-md-12 showerror" style="display:none; margin-bottom: 0px;">
						<label class="FontError"> ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary FontLoginBeforeBookingClick">เข้าใช้งาน</button>
			</div>
		</div>
	</div>
</div>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../footer.php';?>

<script>

	//ข้อมูลของไกด์ทั้งหมด
	LoadtableGuide(1,'All')
	function LoadtableGuide(numberpage,type){
		$.ajax({
			type	: "POST",
			url		: "LoadtableGuide",
			data 	: {
						'numberpage' 		: numberpage,
						'type'				: type,
						'provice'			: '<?=$provincebooking?>',
						'personbookig'		: '<?=$personbookig?>',
						'datestartbooking'  : '<?=$datestartbooking?>',
						'datestopbooking'   : '<?=$datestopbooking?>'
					  },
			cache	: false,
			timeout	: 0,
			success	: function (Result) {

				//type All : ข้อมูลของไกด์ทั้งหมด
				//type Review : ข้อมูลของไกด์ที่รับความนิยม
				//type Price : ข้อมูลของไกด์ที่เรียงลำดับจากราคา
				if(type == 'All'){
					$('#AllGuide').html(Result);

					//เก็บค่าไว้ว่ากดที่แท๊บไหน
					$('#hiddenClickTab').val('All');
				}else if(type == 'Review'){
					$('#ReviewGuide').html(Result);

					//เก็บค่าไว้ว่ากดที่แท๊บไหน
					$('#hiddenClickTab').val('Review');
				}else if(type == 'Price'){
					$('#PriceGuide').html(Result);

					//เก็บค่าไว้ว่ากดที่แท๊บไหน
					$('#hiddenClickTab').val('Price');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR, textStatus, errorThrown);
			}
		});
	};
	
</script>
