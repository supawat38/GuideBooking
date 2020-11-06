<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_register extends CI_Model {
	
	//เพิ่มข้อมูล
	public function InsertCustomerOrGuideOrAdmin($Result,$TableName){
		try{
			$this->db->insert($TableName, $Result);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//แก้ไขข้อมูลตารางหลัก
	public function UpdateCustomerOrGuideOrAdmin($Result,$TableName){
		if($TableName == 'admin'){
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

	//โหลดข้อมูลจังหวัด
	public function LoadDataProvince(){
		try{
			$SQL 	= "SELECT * FROM province ";
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

	//ดึงข้อมูล Guide ล่าสุดจะเอารหัสไป insert ตาราง area + login
	public function selectGuideIDLast(){
		try{
			$SQL 	= "SELECT guide_id FROM guide ORDER BY guide_id DESC LIMIT 1";
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

	//ดึงข้อมูล Guide ล่าสุดจะเอารหัสไป insert ตาราง login
	public function selectCustomerIDLast(){
		try{
			$SQL 	= "SELECT cus_id FROM customer ORDER BY cus_id DESC LIMIT 1";
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
			if($tUserType != '' || $tUserType != null){ //แก้ไขข้อมูล
				if($tUserType == 1){ //ผู้ดูแลระบบ เช็คข้อมูลยกเว้นตัวมันเอง
					$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND login_type NOT IN ('1') AND reflogin_id NOT IN ('$tUserID')";
				}else if($tUserType == 2){ //ลูกค้า เช็คข้อมูลยกเว้นตัวมันเอง
					$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND login_type NOT IN ('2') AND reflogin_id NOT IN ('$tUserID')";
				}else if($tUserType == 3){ //มัคคุเทศก์ เช็คข้อมูลยกเว้นตัวมันเอง
					$SQL = "SELECT * FROM Login WHERE username = '$UserName' AND login_type NOT IN ('3') AND reflogin_id NOT IN ('$tUserID')";
				}
			}else{ //ลงทะเบียใหม่ เช็คทั้งหมด
				$SQL = "SELECT * FROM Login WHERE username = '$UserName' ";
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

	//เพิ่มข้อมูลลงตาราง login
	public function InsertLogin($Result){
		try{
			$this->db->insert('login', $Result);
		}catch(Exception $Error){
			echo $Error;
		}
	}
}
