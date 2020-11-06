<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('Information/models_Information');
		$this->load->model('register/models_register');
	}

	//โหลดหน้าจอแรก
	public function index(){
		//โหลดข้อมูลจังหวัด
		$resultProvince = $this->models_register->LoadDataProvince();
		if($resultProvince['Code'] == '800' ){
			$arrayProvince = array();
		}else{
			$arrayProvince = $resultProvince;
		}

		//โหลดข้อมูลตัวเอง
		$resultInformation = $this->models_Information->LoadDataInformation();
		if($resultInformation['Code'] == '800' ){
			$arrayInformation = array();
		}else{
			$arrayInformation = $resultInformation;
		}

		$aPackData = array(
			'pageName' 		=> 'UpdateInformation',
			'dataprovince' 	=> $arrayProvince,
			'dataUser'		=> $arrayInformation
		);

		$this->load->view('header',$aPackData);
		$this->load->view('register/body',$aPackData);
	}	
}
