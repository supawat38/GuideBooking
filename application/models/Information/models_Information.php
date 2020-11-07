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
				$SQL 	= "SELECT guide.* , login.username , login.password FROM guide INNER JOIN login ON login.login_type = 3 AND login.reflogin_id = guide.guide_id WHERE guide_id ='$tUserID' ";
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

	//เช็คข้อมูล login ว่าซ้ำกันไหม
	public function CheckUserLogin($Result){
		try{	
			$UserName 	= $Result['username'];
			$tUserType 	= $this->session->userdata("session_reftype");	
			$tUserID 	= $this->session->userdata("session_refid");
			if($tUserType == 1){ //ผู้ดูแลระบบ เช็คข้อมูลยกเว้นตัวมันเอง
				$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND ( login_type != 1 OR reflogin_id != '$tUserID' )";
			}else if($tUserType == 2){ //ลูกค้า เช็คข้อมูลยกเว้นตัวมันเอง
				$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND ( login_type != 2 OR reflogin_id != '$tUserID' )";
			}else if($tUserType == 3){ //มัคคุเทศก์ เช็คข้อมูลยกเว้นตัวมันเอง
				$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND ( login_type != 3 OR reflogin_id != '$tUserID' )";
			}
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

	//แก้ไขข้อมูลตารางหลัก ผู้ดูแลระบบ
	public function Update_Admin($Result,$TableName){
		$this->db->set('firstname', $Result['firstname']);
		$this->db->set('lastname', $Result['lastname']);
		$this->db->set('admin_image', $Result['admin_image']);
		$this->db->set('admin_email', $Result['admin_email']);
		$this->db->set('admin_phone', $Result['admin_phone']);
		$this->db->where('admin_id',$Result['ID']);
		$this->db->update('admin');

		//กำหนดค่าให้ sestion
		$this->session->set_userdata("session_name",$Result['firstname']);
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

	//แก้ไขข้อมูลตารางผู้ใช้งานทั่วไป
	public function Update_Customer($Result,$TableName){
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

		//กำหนดค่าให้ sestion
		$this->session->set_userdata("session_name",$Result['firstname']);
	}

}
