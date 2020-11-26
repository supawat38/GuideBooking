<style>
.form-control{
    color:#333333!important;
    font-size:15px!important;
}
.mybtn{
    color:#333333!important;
    font-size:15px!important;
}
</style>
<?php
      $ActionMode = $ActionMode; //Mode การทำงาน  1 : เพิ่มข้อมูล  2 : แก้ไขข้อมูล

      if(isset($AddMonth)){
         $Month = $AddMonth; //เดือนที่ต้องการเพิ่ม / แก้ไข
       }else{
         $Month = ''; //เดือนที่ต้องการเพิ่ม / แก้ไข
       }
       if(isset($AddYear)){
        $Year = $AddYear; //เดือนที่ต้องการเพิ่ม / แก้ไข
       }else{
        $Year = ''; //เดือนที่ต้องการเพิ่ม / แก้ไข
       }
      
      if($Month != '' and  $Year !=''){
         $DayInMonth = cal_days_in_month(CAL_GREGORIAN, $Month, $Year); //หาจำนวนวันในเดือน/ปี  ที่ต้องการเพิ่ม/แก้ไข
      }else{
        $DayInMonth =''; 
      }
      
?>
<div class="row">
					<div class="col-lg-6 col-6">
						<label class="labelHead textActiveMenuBar" onclick="LoadGuideCalendar()">ตารางเวลา</label> <label class="labelHead label_packageHead"> / <?php if($ActionMode == 1){ echo "เพิ่ม"; } else{ echo "แก้ไข";} ?></label>
					</div>
</div>
<?php if($ActionMode == 1){ ?>
<div class="row">
    <div class="col-lg-2 col-2">
          <select class="form-control" id="AddEditYear">
          <option value="">เลือกปี</option>
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
    </div>
    <div class="col-lg-2 col-2">
         <select class="jSelectedsingle form-control"  id="AddEditMonth">
          <option value="">เลือกเดือน</option>
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
    </div>
    <div class="col-lg-3 col-3">
         <button class="btn btn-secondary" onclick="CheckAddGuideCalendar()">+ เพิ่มตารางงาน</button>
    </div>
</div>

<!-- ถ้าเป็น Mode แก้ไขข้อมูลจะแสดงข้อมูล เดือน / ปี ที่กำลังแก้ไข -->
<?php } else { ?>
    <div class="row">
    <div class="col-lg-12 col-12">เดือน <?php echo ConvertThaiMonth($AddMonth);?> <?=$AddYear?> </div>
    </div>
<?php } ?>
<!-- จบ -->


<div class="row">
    <div class="col-lg-12 col-12">
    <table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" width="10%">ลำดับ</th>
				<th scope="col" width="10%">วัน</th>
				<th scope="col">วันที่</th>
                <th scope="col" width="15%">สถานะ</th>
			</tr>
		</thead>
		<tbody>
        <?php 

        if($ActionMode == 1){ //ถ้าเป็น Mode เพิ่มข้อมูล
            //ตรวจสอบว่ามีการเลือกเดือน/ปี ที่ต้องการสร้างมาหรือไม่
            if($DayInMonth != '') { //OPEN IF

            
            for($i = 1 ; $i<=$DayInMonth; $i++){ 
              $date = $Year."-".$Month."-".$i;
        ?>
				<tr>
                    <th><?=$i?></th>
                    <td><?php echo ConvertThaiDay(date('l', strtotime($date))); ?></td>
                    <td><?=$i?>/<?=$Month?>/<?=$Year?>
                        <input type="hidden" name="CalendarDate[]" value="<?=$date?>">
                    </td>
                    <td>
                    <select class="jSelectedsingle form-control" name="CalendarSet[]">
                    <option value="0">ว่าง</option>
                    <option value="2">ไม่รับงาน</option>
                    </select>
                    </td>
                </tr>
        <?php  

            } //End for 
        } //END IF
        else{
            echo "<tr><td colspan='5' style='text-align:center'>--กรุณาเลือกปี/เดือน ที่ต้องการสร้างตารางงาน--</td></tr>";
        }

        }else{ //OPEN ELSE
             
            //  โหมดแก้ไขข้อมูลตารางเวลา ระบบจะดึงข้อมูลตารางเวลาที่เคยสร้างไว้ขึ้นมาให้แก้ไข
            $lineNo = 0; //หมายเลขแถว
            foreach($Result['Items'] AS $Key => $Value){ //OPEN FOR

                $lineNo++; //เพิ่มค่าให้หมายเลขแถว
                $calenDay  = ConvertThaiDay(date('l', strtotime($Value["guide_date"]))); //วันในตารางงาน
                $calenDate = $Value["guide_date"]; //วันที่ในตารางงาน
                $showDate = date("d/m/Y", strtotime($Value["guide_date"])); //วันที่สำหรับแสดงในตาราง
                $calenDayStatus = $Value["guide_status"]; //สถานะของตารางเวลาของแต่ละวัน

        ?>

                <tr>
                    <th><?=$lineNo?></th>
                    <td><?=$calenDay?></td>
                    <td>
                        <?=$showDate?>
                        <input type="hidden" name="CalendarDate[]" value="<?=$calenDate?>">
                    </td>
                    <td>
                         <?php  if($calenDayStatus == 1){ ?>
                                    <select class="jSelectedsingle form-control" name="CalendarSet[]" style="display:none">
                                            <option value="1">จองแล้ว</option>
                                    </select>
                                    <img src="<?=base_url()?>/application/assets/images/icon/user.png" style="width:18px"> <label style="color:green"> จองแล้ว<label>
                         <?php } else { //OPEN ELSE?>
                                    <select class="jSelectedsingle form-control" name="CalendarSet[]">
                                            <?php if($calenDayStatus == 0){ ?>
                                                    <option value="0" selected="true">ว่าง</option>
                                            <? } else { ?>
                                                     <option value="2">ไม่รับงาน</option>
                                            <?php } ?>

                                            <?php if($calenDayStatus == 2){ ?>
                                                     <option value="2" selected="true">ไม่รับงาน</option>
                                            <? } else { ?>
                                                     <option value="0">ว่าง</option>
                                            <?php } ?>
                                            
                                    </select>
                         <?php } //END ELSE?>
                    </td>
                </tr>
            <?php } //END FOR ?>

        <?php  }  //END ELSE ?>
			</tbody>
	</table>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-8">&nbsp;</div>
    <div class="col-lg-4 col-4 text-right" style="padding-bottom:10px;">
         <!-- Mode AddNew / Edit -->
         <input type="hidden" id="ActionMode" value="<?=$ActionMode?>">
         <button type="button" class="btn btn-primary waves-effect waves-light mybnt" 
                onclick="SaveGuideCalendar()">บันทึก</button>
    </div>
</div>