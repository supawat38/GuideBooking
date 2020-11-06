<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_Information extends CI_Model {
	
	//โหลดข้อมูลตัวเอง
	public function LoadDataInformation(){
		try{

			$tUserType 	= $this->session->userdata("session_reftype");	
			$tUserID 	= $this->session->userdata("session_refid");

			if($tUserType == 1){ //ผู้ดูแลระบบ
				$SQL 	= "SELECT admin.* , login.username , login.password FROM admin INNER JOIN login ON login.login_type = 1 AND login.reflogin_id = admin.admin_id WHERE admin_id ='$tUserID' ";
			}else if($tUserType == 2){ //ลูกค้า
				$SQL 	= "SELECT customer.* , login.username , login.password FROM customer INNER JOIN login ON login.login_type = 2 AND login.reflogin_id = customer.cus_id WHERE cus_id ='$tUserID'";
			}else if($tUserType == 3){ //มัคคุเทศก์
				//$SQL 	= "SELECT * FROM guide WHERE guide_id ='$tUserID' ";
			}

			$Query 	= $this->db->query($SQL);
			if($Query->num_rows() > 0){
				$aResult = array(
					'Items'  => $Query->result_array(),
					'Code'   => '1',
					'Desc'   => 'success'
				);
			}else{
				$aResult = array(
					'Code' 	=> '800',
					'Desc' 	=> 'data not found'
				);
			}
			return $aResult;
		}catch(Exception $Error){
			echo $Error;
		}
	}

}
