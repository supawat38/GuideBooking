<?php
      $ActionMode = $ActionMode; //Mode การทำงาน  1 : เพิ่มข้อมูล  2 : แก้ไขข้อมูล

      $Month = '02'; //เดือนที่ต้องการเพิ่ม / แก้ไข
      $Year  = '2020'; //ปีที่ต้องการเพิ่ม / แก้ไข
      $DayInMonth = cal_days_in_month(CAL_GREGORIAN, $Month, $Year); //หาจำนวนวันในเดือน/ปี  ที่ต้องการเพิ่ม/แก้ไข
?>
<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onclick="LoadGuideCalendar()">ตารางเวลา</label> <label class="labelHead label_packageHead"> / <?php if($ActionMode == 1){ echo "เพิ่ม"; } else{ echo "แก้ไข";} ?></label>
					</div>
</div>
<?php if($ActionMode == 1){ ?>
<div class="row">
    <div class="col-lg-12 col-12">เลือก ปี / เดือน </div>
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
<?php } else { ?>
    <div class="row">
    <div class="col-lg-12 col-12">เดือน มกราคม 2020 </div>
    </div>
<?php } ?>
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
        <?php 
        if($ActionMode == 1){
            for($i = 1 ; $i<=$DayInMonth; $i++){ 
              $date = $Year."-".$Month."-".$i;
        ?>
				<tr>
                    <th>1</th>
                    <td><?php echo date('l', strtotime($date)); ?></td>
                    <td><?=$i?>/<?=$Month?>/<?=$Year?>
                        <input type="hidden" name="CalendarDate[]" value="<?=$date?>">
                    </td>
                    <td>
                    <select name="CalendarSet[]">
                    <option value="0">ว่าง</option>
                    <option value="2">ไม่ว่าง</option>
                    <option value="1">จองแล้ว</option>
                    </select>
                    </td>
                </tr>
        <?php     } //End for 
             }else{
        ?>
                <tr>
                    <th>1</th>
                    <td>??</td>
                    <td>???</td>
                    <td>
                    <select name="CalendarSet[]">
                    <option value="0">ว่าง</option>
                    <option value="2">ไม่ว่าง</option>
                    <option value="1">จองแล้ว</option>
                    </select>
                    </td>
                </tr>
        <?php  }  ?>
			</tbody>
	</table>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-8">&nbsp;</div>
    <div class="col-lg-4 col-4">
         <button type="button" class="align-self-stretch btn btn-primary BTNConfirmRegis" 
                onclick="SaveGuideCalendar()">บันทึก</button>
    </div>
</div>