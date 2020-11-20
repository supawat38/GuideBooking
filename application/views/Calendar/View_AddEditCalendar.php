<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onclick="LoadGuideCalendar()">ตารางเวลา</label> <label class="labelHead label_packageHead"> / เพิ่มข้อมูล</label>
					</div>
</div>

<div class="row">
    <div class="col-lg-12 col-12">เลือก ปี / เดือน</div>
    <div class="col-lg-6 col-9">
          <select name="" id="">
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
         </select>
         <select name="" id="">
          <option value="01">มกราคม</option>
          <option value="02">กุมภาพันธ์</option>
          <option value="03">มีนาคม</option>
          <option value="04">เมษายน</option>
          <option value="05">พฤษภาคม</option>
          <option value="06">มิถุนายน</option>
          <option value="07">กรกฎาคม</option>
          <option value="08">สิงหาคม</option>
          <option value="09">กันยายน</option>
          <option value="10">ตุลาคม</option>
          <option value="11">พฤษจิกายน</option>
          <option value="12">ธันวาคม</option>
         </select>
         
         <button>สร้างตาราง</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-12">
    <table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" width="10%">ลำดับ</th>
				<th scope="col" width="10%">วัน</th>
				<th scope="col">วันที่</th>
                <th scope="col" width="10%">สถานะ</th>
			</tr>
		</thead>
		<tbody>
        <?php for($i = 1 ; $i<=31; $i++){ 
              $date = "2020-01-".$i;
        ?>
				<tr>
                    <th>1</th>
                    <td><?php echo date('l', strtotime($date)); ?></td>
                    <td><?=$i?>/01/2020</td>
                    <td>
                    <select name="" id="">
                    <option value="01">ว่าง</option>
                    <option value="02">ไม่ว่าง</option>
                    <option value="03">จองแล้ว</option>
                    </select>
                    </td>
                </tr>
        <?php } //End for ?>
			</tbody>
	</table>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-8">&nbsp;</div>
    <div class="col-lg-4 col-4">
         <button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" 
                onclick="LoadGuideCalendar()">บันทึก</button>
    </div>
</div>