<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_package extends CI_Model {

	//โหลดข้อมูลแพ็กเกจ
	public function LoadDatapackage($parameter){
		try{	
			$tUserType 	= $this->session->userdata("session_reftype");	
			$tUserID 	= $this->session->userdata("session_refid");
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;


			if($tUserType == 1){ //ถ้าเป็นผู้ดูแลระบบดูได้หมด
				//จำนวนข้อมูล
				$SQL 			= "SELECT COUNT(*) AS NumAll FROM package";
				$QueryCount 	= $this->db->query($SQL);

				//ข้อมูล
				$SQL 			= "SELECT package.* , guide.* FROM package INNER JOIN guide ON package.guide_id = guide.guide_id";
				$QueryItem 		= $this->db->query($SQL);
			}else if($tUserType == 2){ //ถ้าเป็นลูกค้าดูได้หมด แต่ต้องเป็นสถานะใช้งานเท่านั้น
				//จำนวนข้อมูล
				$SQL 			= "SELECT COUNT(*) AS NumAll FROM package WHERE package_status = 1";
				$QueryCount 	= $this->db->query($SQL);

				//ข้อมูล
				$SQL 			= "SELECT package.* , guide.* FROM package INNER JOIN guide ON package.guide_id = guide.guide_id WHERE package.package_status = 1";
				$QueryItem 		= $this->db->query($SQL);
			}else if($tUserType == 3){ //ถ้าเป็นมัคคุเทศก์ดูได้แต่ของตัวเอง
				//จำนวนข้อมูล
				$SQL 			= "SELECT COUNT(*) AS NumAll FROM package WHERE package.guide_id ='$tUserID' ";
				$QueryCount 	= $this->db->query($SQL);

				//ข้อมูล
				$SQL 			= "SELECT package.* , guide.* FROM package INNER JOIN guide ON package.guide_id = guide.guide_id WHERE package.guide_id ='$tUserID' ";
				$QueryItem 		= $this->db->query($SQL);
			}

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

	//เพิ่มข้อมูลแพ็กเกจ
	public function Insert_package($Result){
		try{	
			$guide_id		= $Result['guide_id'];
			$package_file	= $Result['package_file'];
			$package_name	= $Result['package_name'];
			$package_con	= $Result['package_con'];
			$package_image	= $Result['package_image'];
			$package_status = $Result['package_status'];

			$SQL = "INSERT INTO package (guide_id, package_file, package_name, package_con, package_image, package_status) 
					VALUES ('$guide_id','$package_file','$package_name','$package_con','$package_image',$package_status)";
			$this->db->query($SQL);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//ลบข้อมูลแพ็กเกจ
	public function Delete_Package($id){
		$this->db->where('package_id',$id);
		$this->db->delete('package');
	}
	
}
