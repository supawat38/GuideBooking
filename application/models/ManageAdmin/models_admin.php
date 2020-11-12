<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_admin extends CI_Model {

	//โหลดข้อมูลตาราง admin
	public function LoadDataAdamin($parameter){
		try{
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM admin ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT * FROM admin LIMIT $row_count OFFSET $offset";
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

	//เช็คข้อมูล login ว่าซ้ำกันไหม
	public function CheckUserLogin($Result){
		try{	
			$UserName 	= $Result['username'];
			$Typepage   = $Result['Typepage'];
			$UserID 	= $Result['ID'];

			//ถ้าเป็นการลงทะเบียนใหม่เช็ค username ห้ามซ้ำ
			if($Typepage == 'pageinsert'){
				$SQL 		= "SELECT * FROM Login WHERE username = '$UserName' ";
			}else if($Typepage == 'pageedit'){ //ถ้าเป็นการแก้ไขข้อมูลเช็ค username ห้ามซ้ำ ยกเว้นของตัวเองไม่ต้องเช็ค
				$SQL 		= "SELECT * FROM Login WHERE username = '$UserName' AND login_type NOT IN ('1') AND reflogin_id NOT IN ('$UserID') ";
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

	//แก้ไขข้อมูลตารางหลัก
	public function Update_Admin($Result,$TableName){
		$this->db->set('firstname', $Result['firstname']);
		$this->db->set('lastname', $Result['lastname']);
		$this->db->set('admin_image', $Result['admin_image']);
		$this->db->set('admin_email', $Result['admin_email']);
		$this->db->set('admin_phone', $Result['admin_phone']);
		$this->db->set('admin_status', $Result['admin_status']);
		$this->db->set('status_delete',0);
		$this->db->where('admin_id',$Result['ID']);
		$this->db->update('admin');

		//กำหนดค่าให้ sestion
		$this->session->set_userdata("session_name",$Result['firstname']);	
	}

	//แก้ไขข้อมูลตารางเข้าสู่ระบบ
	public function Update_Login($Result){
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

	//เพิ่มข้อมูลตารางหลัก
	public function Insert_Admin($Result,$TableName){
		try{	
			$firstname		= $Result['firstname'];
			$lastname		= $Result['lastname'];
			$admin_image	= $Result['admin_image'];
			$admin_email	= $Result['admin_email'];
			$admin_phone	= $Result['admin_phone'];
			$admin_status 	= $Result['admin_status'];

			$SQL = "INSERT INTO admin (firstname,lastname,admin_image,admin_email,admin_phone,admin_status,status_delete) 
					VALUES ('$firstname','$lastname','$admin_image','$admin_email','$admin_phone',$admin_status,'0')";
			$this->db->query($SQL);
		}catch(Exception $Error){
			echo $Error;
		}
	}
	
	//เพิ่มข้อมูลตารางเข้าสู่ระบบ
	public function Insert_Login($Result){
		try{
			$username		= $Result['username'];
			$password		= md5($Result['password']);

			//หาข้อมูลผู้ดูแลระบบที่เพิ่มเข้าไปล่าสุด เอา ID มาใช้
			$SQL 			= "SELECT admin_id FROM admin ORDER BY admin_id DESC";
			$Query 			= $this->db->query($SQL);
			$IDLast 		= $Query->result_array()[0]['admin_id'];
			
			//เพิ่มข้อมูลลงตาราง login
			$SQLIns = "INSERT INTO login (username,password,login_type,reflogin_id) 
					VALUES ('$username','$password',1,'$IDLast')";
			$this->db->query($SQLIns);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//โหลดข้อมูลตามรหัส
	public function GetData_Admin($id){
		try{
			$SQL 			= "SELECT * FROM admin INNER JOIN login ON login.login_type = 1 AND login.reflogin_id = admin.admin_id WHERE admin_id ='$id' ";
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
	public function Delete_Admin($id){
		$this->db->set('status_delete', 1);
		$this->db->set('admin_status', 0);
		$this->db->where('admin_id',$id);
		$this->db->update('admin');
	}
}
