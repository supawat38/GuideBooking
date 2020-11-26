<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_GuideCalendar extends CI_Model {

	//ดึงข้อมูล Calendar ของ Guide แต่ละคน
	public function ShowList_Calendar($Filter){
		try{	

			$SQL = " SELECT DISTINCT DATE_FORMAT(guide_date, '%Y') AS CalenYear ";
			$SQL.= ", DATE_FORMAT(guide_date, '%M') AS CalenMonth " ;
			$SQL.= " FROM calender ";

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

	//เพิ่มข้อมูลตารางหลัก
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
}
