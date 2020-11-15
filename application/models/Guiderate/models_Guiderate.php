<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_Guiderate extends CI_Model {

	//โหลดข้อมูลตาราง rate
	public function LoadDataRate($parameter){
		try{
			$tUserID 	= $this->session->userdata("session_refid");
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM rate WHERE guide_id = '$tUserID' ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT rate.* , guide.firstname FROM rate 
							   LEFT JOIN guide ON rate.guide_id = guide.guide_id
							   WHERE rate.guide_id = '$tUserID' LIMIT $row_count OFFSET $offset";
			$QueryItem 		= $this->db->query($SQL);
			if($QueryItem->num_rows() > 0){

				$CountItemAll 	= $QueryCount->result_array()[0]['NumAll'];
				$EndPage 		= ceil($CountItemAll/$row_count); 

				$Result = array(
					'Items'  		=> $QueryItem->result_array(),
					'CountItemAll' 	=> $CountItemAll,
					'CurrentPage'	=> $page,
					'EndPage'		=> $EndPage,
					'Code'   		=> '1',
					'Desc'   		=> 'success'
				);
			}else{
				$Result = array(
					'CountItemAll' 	=> 0,
					'CurrentPage'	=> 1,
					'EndPage'		=> 1,
					'Code' 			=> '800',
					'Desc' 			=> 'data not found'
				);
			}
			return $Result;
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//แก้ไขข้อมูลตารางเรท
	public function Update_rate($Result){
		$rate_id		= $Result['rate_id'];
		$guide_id		= $Result['guide_id'];
		$amount			= $Result['amount'];
		$note			= $Result['note'];
		$person			= $Result['person'];

		$this->db->set('person', $person);
		$this->db->set('amount', $amount);
		$this->db->set('note', $note);
		$this->db->set('status_delete', 0);
		$this->db->where('rate_id',$rate_id);
		$this->db->update('rate');
	}

	//เพิ่มข้อมูลตารางหลัก
	public function Insert_rate($Result,$TableName){
		try{	
			$guide_id		= $Result['guide_id'];
			$amount			= $Result['amount'];
			$note			= $Result['note'];
			$status_delete	= $Result['status_delete'];
			$person			= $Result['person'];

			$SQL = "INSERT INTO rate (guide_id,amount,person,note,status_delete) 
					VALUES ('$guide_id','$amount','$person','$note','$status_delete')";
			$this->db->query($SQL);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//โหลดข้อมูลตามรหัส
	public function GetData_rate($id){
		try{
			$SQL 			= "SELECT * FROM rate WHERE rate_id ='$id' ";
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

	//ลบข้อมูล
	public function Delete_rate($id){
		$this->db->set('status_delete', 1);
		$this->db->where('rate_id',$id);
		$this->db->update('rate');
	}
}
