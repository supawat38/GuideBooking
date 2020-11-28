<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_PercentGuide extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataPercentGuide($parameter){
		try{
			$tUserID 	= $this->session->userdata("session_refid");
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM guide ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT guide.* FROM guide LIMIT $row_count OFFSET $offset";
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

	//โหลดข้อมูลตาม ID
	public function GetData_PercentGuide($id){
		try{
			$SQL 			= "SELECT guide.* , area.* , guide.province_id AS ProvinceGuide FROM guide 
								LEFT JOIN area ON area.guide_id = guide.guide_id
								WHERE guide.guide_id ='$id' ";
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

	//แก้ไขข้อมูลตารางมัคคุเทศก์
	public function Update_Guide($Result,$TableName){
		$this->db->set('firstname', $Result['firstname']);
		$this->db->set('lastname', $Result['lastname']);
		$this->db->set('guide_bd', $Result['guide_bd']);
		$this->db->set('gender', $Result['gender']);
		$this->db->set('guide_credit', $Result['guide_credit']);
		$this->db->set('guide_license', $Result['guide_license']);
		$this->db->set('address', $Result['address']);
		$this->db->set('province_id', $Result['province_id']);
		$this->db->set('postcode', $Result['postcode']);
		$this->db->set('guide_phone', $Result['guide_phone']);
		$this->db->set('guide_email', $Result['guide_email']);
		$this->db->set('guide_image', $Result['guide_image']);
		$this->db->set('intro_profile', $Result['intro_profile']);
		$this->db->set('guide_status', $Result['guide_status']);
		$this->db->set('guide_qustions', $Result['guide_qustions']);
		$this->db->set('guide_gp', $Result['guide_gp']);
		$this->db->where('guide_id',$Result['ID']);
		$this->db->update('guide');
	}

	//เพิ่มข้อมูลตาราง area
	public function Insert_Area($Result){
		try{
			$this->db->insert('area', $Result);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//ลบข้อมูลตาราง area
	public function Delete_Area($Result){
		try{
			$this->db->where('guide_id', $Result['ID']);
			$this->db->delete('area'); 
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//อัพเดทสถานะไกด์ไม่ให้ใช้งาน
	public function Delete_percentguide($ID){
		$this->db->set('guide_status', 0);
		$this->db->set('status_delete', 1);
		$this->db->where('guide_id', $ID);
		$this->db->update('guide'); 
	}

}
