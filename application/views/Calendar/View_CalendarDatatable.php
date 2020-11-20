<div class="row">
    <div class="col-lg-6 col-6">
        <label class="labelHead">ตารางงาน</label>
    </div>
    <div class="col-lg-6 col-6">
        <button class="xButtonInsert pull-right" onclick="AddGuideCalendar('pageinsert')">+</button>
    </div>
</div>

<div class="row">
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
         
         <button>ค้นหา</button>
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
				<tr>
                    <th>1</th>
                    <td>2020</td>
                    <td>มกราคม</td>
                    <td><img class="img-responsive ImageEdit" src="<?=base_url()?>/application/assets/images/icon/edit.png" onclick="#"></td>
                    <td><img class="img-responsive ImageDelete" src="<?=base_url()?>/application/assets/images/icon/delete.png" onclick="#"></td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>2020</td>
                    <td>กุมภาพันธ์</td>
                    <td><img class="img-responsive ImageEdit" src="<?=base_url()?>/application/assets/images/icon/edit.png" onclick="#"></td>
                    <td><img class="img-responsive ImageDelete" src="<?=base_url()?>/application/assets/images/icon/delete.png" onclick="#"></td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>2020</td>
                    <td>มีนาคม</td>
                    <td><img class="img-responsive ImageEdit" src="<?=base_url()?>/application/assets/images/icon/edit.png" onclick="#"></td>
                    <td><img class="img-responsive ImageDelete" src="<?=base_url()?>/application/assets/images/icon/delete.png" onclick="#"></td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>2020</td>
                    <td>เมษายน</td>
                    <td><img class="img-responsive ImageEdit" src="<?=base_url()?>/application/assets/images/icon/edit.png" onclick="#"></td>
                    <td><img class="img-responsive ImageDelete" src="<?=base_url()?>/application/assets/images/icon/delete.png" onclick="#"></td>
                </tr>
			</tbody>
	</table>