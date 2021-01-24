<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Models_register extends CI_Model {
	
	//เพิ่มข้อมูล
	public function InsertCustomerOrGuideOrAdmin($Result,$TableName){
		try{
			$this->db->insert($TableName, $Result);
		}catch(Exception $Error){
			echo $Error;
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
			$SQL 		= "SELECT * FROM login WHERE username = '$UserName' ";
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
