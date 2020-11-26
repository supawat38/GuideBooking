<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_GuideCalendar extends CI_Model {

    //ตรวจสอบการสร้างตารางเวลา
	public function CheckAddCalendar($Conditions){
		try{	
			
			$AddYear   = $Conditions['AddYear']; //ปีที่เลือก
		    $AddMonth =  $Conditions['AddMonth']; //เดือนที่เลือก
			$guide_id  = $Conditions["GuideId"]; //รหัสไกด์

			$SQL = "  SELECT COUNT(guide_date) AS guide_date ";
			$SQL.= "  FROM calender ";
			$SQL.= "  WHERE  guide_id = '".$guide_id."' ";
			$SQL.= "  AND  DATE_FORMAT(guide_date, '%Y')= '".$AddYear."' ";
			$SQL.= "  AND  DATE_FORMAT(guide_date, '%m')= '".$AddMonth."' ";


			$QueryItem 		= $this->db->query($SQL);
			$Result = $QueryItem->result_array();
			return $Result[0]["guide_date"];
            

		}catch(Exception $Error){
			echo $Error;
		}
	}

	//ดึงข้อมูล Calendar ของ Guide
	public function ShowList_Calendar($Filter){
		try{	

			$guide_id = $Filter["guide_id"]; //รหัสไกด์

			$SQL = " SELECT DISTINCT DATE_FORMAT(guide_date, '%Y') AS CalenYear ";
			$SQL.= ", DATE_FORMAT(guide_date, '%m') AS CalenMonth " ;
			$SQL.= " FROM calender ";
			$SQL.= " WHERE  guide_id = '$guide_id' ";


			$QueryItem 		= $this->db->query($SQL);

			if($QueryItem->num_rows() > 0){
				$Result = array(
					'Items'  		=> $QueryItem->result_array(),
					'Code'   		=> '1',
					'Desc'   		=> 'success'
				);
			}else{
				$Result = array(
					'Code' 			=> '800',
					'Desc' 			=> 'data not found'
				);
			}
			return $Result;

		}catch(Exception $Error){
			echo $Error;
		}
	}

	//เพิ่มข้อมูลตารางงาน
	public function Insert_Calendar($Result,$TableName){
		try{	
			$guide_date		= $Result['guide_date'];
			$guide_id		= $Result['guide_id'];
			$guide_status	= $Result['guide_status'];
			$note	        = $Result['note'];

			$SQL = "INSERT INTO $TableName (guide_date,guide_id,guide_status,note) 
					VALUES ('$guide_date','$guide_id','$guide_status','$note')";

			if($this->db->query($SQL)){
				return 'success';
			}else{
				return 'Error';
			}
			//return $SQL;

		}catch(Exception $Error){
			echo $Error;
		}
	}

	//ลบข้อมูลตารางงาน
	public function Delete_Calendar($Condition){

		try{	

			$guide_id		= $Condition['guide_id'];
			$calenMonth		= $Condition['CalenMonth'];
			$calenYear	    = $Condition['CalenYear'];


			$SQL = " DELETE FROM calender ";
			$SQL.= " WHERE  guide_id = '".$guide_id."' ";
			$SQL.= " AND    DATE_FORMAT(guide_date, '%Y') = '".$calenYear."' ";
			$SQL.= " AND    DATE_FORMAT(guide_date, '%m') = '".$calenMonth."' ";

			if($this->db->query($SQL)){
				return 'success';
			}else{
				return 'Error';
			}
			

		}catch(Exception $Error){
			echo $Error;
		}
	}


	//ดึงข้อมูล Calendar ของ Guide สำหรับแก้ไข [Edit Calendar]
	public function _GetCalendarByMonth($Filter){
		try{	

			$guide_id = $Filter["guide_id"]; //รหัสไกด์
			$calenYear = $Filter["calenYear"]; //รหัสไกด์
			$calenMonth = $Filter["calenMonth"]; //รหัสไกด์

			$SQL = " SELECT * ";
			$SQL.= " FROM calender ";
			$SQL.= " WHERE  guide_id = '".$guide_id."' ";
			$SQL.= " AND    DATE_FORMAT(guide_date, '%Y') = '".$calenYear."' ";
			$SQL.= " AND    DATE_FORMAT(guide_date, '%m') = '".$calenMonth."' ";


			$QueryItem 		= $this->db->query($SQL);

			if($QueryItem->num_rows() > 0){
				$Result = array(
					'Items'  		=> $QueryItem->result_array(),
					'Code'   		=> '1',
					'Desc'   		=> 'success'
				);
			}else{
				$Result = array(
					'Code' 			=> '800',
					'Desc' 			=> 'data not found'
				);
			}
			return $Result;

		}catch(Exception $Error){
			echo $Error;
		}
	}


}
