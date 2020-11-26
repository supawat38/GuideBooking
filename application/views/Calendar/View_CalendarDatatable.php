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
<div class="row">
    <div class="col-lg-6 col-6">
        <label class="labelHead">ตารางงาน</label>
    </div>
    <div class="col-lg-6 col-6">
        <button class="xButtonInsert pull-right" onclick="AddGuideCalendar('pageinsert')">+</button>
    </div>
</div>

<div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2 col-2">
          <select class=" form-control" name="" id="">
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
    <div class="col-sm-2 col-md-2 col-lg-2 col-2">
          <select class="form-control" name="" id="" style="color:#cccccc">
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
    <div class="col-sm-2 col-md-2 col-lg-2 col-2">
         <button class="btn btn-primary waves-effect waves-light mybtn" style="width:100px;hight:50px">ค้นหา</button>
    </div>
</div>

<table class="table table-hover" style="margin-top: 20px;">
		<thead>
			<tr>
				<th scope="col" width="10%">ลำดับ</th>
				<th scope="col" width="10%">ปี</th>
				<th scope="col">เดือน</th>
				<th class="text-center" width="5%">แก้ไข</th>
				<th class="text-center" width="5%">ลบ</th>
			</tr>
		</thead>
		<tbody>
        <?php 
              //helper('DateConvert');
              //ตรวจสอบว่าพบข้อมูลหรือไม่
              if($Result["Code"] == 1){
                
                $line_no = 0; //เก็บหมายเลขแถว
                
                //วนลูปแสดงข้อมูลตารางงาน
                foreach($Result['Items'] AS $Key => $Value){ 
                
                $calenYear  =  $Value['CalenYear']; //Calendar Year
                $calenMonth =  $Value['CalenMonth']; //Calendar Month

                $line_no++; //เพิ่มค่าเลขแถวที่ละ 1
        ?>
				<tr>
                    <th><?=$line_no?></th>
                    <td><?=$calenYear?></td>
                    <td><?php echo ConvertThaiMonth($calenMonth);?></td>
                    <td><img class="img-responsive ImageEdit" src="<?=base_url()?>/application/assets/images/icon/edit.png" onclick="EditGuideCalendar('<?=$calenYear?>','<?=$calenMonth?>')"></td>
                    <td><img class="img-responsive ImageDelete" src="<?=base_url()?>/application/assets/images/icon/delete.png" onclick="#"></td>
                </tr>
        <?php  

                } //END FOR

              }//END IF

              //ถ้าไม่พบข้อมูลให้แสดงไม่พบข้อมูล
              else{
                  echo "<tr><td colspan='5' style='text-align:center'>--ไม่พบข้อมูล--</td></tr>";
              }
        ?>
			</tbody>
	</table>