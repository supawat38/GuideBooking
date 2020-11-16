<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_GuideManageCustomer extends CI_Model {

	//โหลดข้อมูลตาราง rate
	public function LoadDataManageCustomer($parameter){
		try{
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM customer ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT  * FROM customer LIMIT $row_count OFFSET $offset";
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

	//โหลดข้อมูลตามรหัส
	public function GetData_ManageCustomer($id){
		try{
			$SQL 			= "SELECT 
									customer.* ,
									login.username , 
									login.password 
									FROM customer 
								INNER JOIN login ON login.login_type = 2 AND login.reflogin_id = customer.cus_id WHERE customer.cus_id ='$id' ";
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
	public function Delete_ManageCustomer($id){
		$this->db->set('cus_status', 0);
		$this->db->where('cus_id',$id);
		$this->db->update('customer');
	}

	//เช็คข้อมูล login ว่าซ้ำกันไหม
	public function CheckUserLogin($Result){
		try{	
			$UserName 	= $Result['username'];
			$ID 		= $Result['ID'];
			
			//ลูกค้า เช็คข้อมูลยกเว้นตัวมันเอง
			$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND reflogin_id != '$ID' ";
			$Query 		= $this->db->query($SQL);
			if($Query->num_rows() > 0){
				$aResult = array(
					'Code'   => '800',
					'Desc'   => 'duplicate'
				);
			}else{
				$aResult = array(
					'Code' 	=> '1',
					'Desc' 	=> 'pass'
				);
			}
			return $aResult;
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//แก้ไขข้อมูลตารางผู้ใช้งานทั่วไป
	public function Update_Customer($Result,$TableName){
		$this->db->set('cus_status', 1);
		$this->db->set('status_delete', 0);
		$this->db->set('firstname', $Result['firstname']);
		$this->db->set('lastname', $Result['lastname']);
		$this->db->set('cus_bd', $Result['cus_bd']);
		$this->db->set('gender', $Result['gender']);
		$this->db->set('address', $Result['address']);
		$this->db->set('cus_email', $Result['cus_email']);
		$this->db->set('cus_phone', $Result['cus_phone']);
		$this->db->set('cus_image', $Result['cus_image']);
		$this->db->set('cus_qustions', $Result['cus_qustions']);
		$this->db->where('cus_id',$Result['ID']);
		$this->db->update('customer');
	}

	//แก้ไขข้อมูลตารางเข้าสู่ระบบ
	public function UpdateLogin($Result){
		$PasswordOld 	= $Result['passwordOld'];
		$Password		= $Result['password'];
		if($PasswordOld == $Password){ //ถ้า password เหมือนกันอัพเดทแค่ชื่อ
			$this->db->set('username', $Result['username']);
			$this->db->where('login_type',$Result['login_type']);
			$this->db->where('reflogin_id',$Result['ID']);
			$this->db->update('login');
		}else{ //ถ้า password ไม่เหมือนกันอัพเดททั้งหมด
			$this->db->set('username', $Result['username']);
			$this->db->set('password', md5($Result['password']));
			$this->db->where('login_type',$Result['login_type']);
			$this->db->where('reflogin_id',$Result['ID']);
			$this->db->update('login');
		}
	}
	
}
