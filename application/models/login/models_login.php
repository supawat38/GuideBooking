<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Models_login extends CI_Model {
	
	//เช็คข้อมูล login ว่ามีในระบบไหม
	public function ChecLogin($Result){
		try{	
			$UserName 	= $Result['username'];
			$Pass 		= $Result['password'];
			$SQL 		= "SELECT 
								login.* , 
								admin.firstname AS Adminfirstname , 
								guide.firstname AS Guidefirstname , 
								customer.firstname AS Customerfirstname 
							FROM login login
							LEFT JOIN admin ON login.login_type = 1 AND login.reflogin_id = admin.admin_id AND admin.admin_status = 1 AND admin.status_delete = 0
							LEFT JOIN guide ON login.login_type = 3 AND login.reflogin_id = guide.guide_id AND guide.guide_status = 1
							LEFT JOIN customer ON login.login_type = 2 AND login.reflogin_id = customer.cus_id AND customer.cus_status = 1";
			$SQL 		.= " WHERE login.username = '$UserName' ";
			$SQL 		.= " AND login.password = '$Pass' ";
			$Query 		= $this->db->query($SQL);

			if($Query->num_rows() > 0){
				$aResult = array(
					'Items'  	=> $Query->result_array(),
					'Code' 		=> '1',
					'Desc' 		=> 'found',
					'tSQL'		=> $SQL
				);
			}else{
				$aResult = array(
					'Code'   	=> '800',
					'Desc'   	=> 'notfound',
					'tSQL'		=> $SQL
				);
			}
			return $aResult;
		}catch(Exception $Error){
			echo $Error;
		}
	}
}
