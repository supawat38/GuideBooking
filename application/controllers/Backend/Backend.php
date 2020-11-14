<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('Guiderate/models_Guiderate');
	}

	//โหลดหน้าจอแรก
	public function index(){

		//เช็คว่าเข้ามาแบบไหน
		$tUserType 	= $this->session->userdata("session_reftype");	
		$tUserID 	= $this->session->userdata("session_refid");

		$aPackData = array(
			'pageName' 		=> 'Backend'
		);

		if($tUserType == 3 || $tUserType == 1 || $tUserType == 0){ //มัคคุเทศก์ + ผู้ดูแลระบบ + เจ้าของ
			$this->load->view('header',$aPackData);
			$this->load->view('Backend/View_BackendList',$aPackData);
		}else{
			echo 'คุณไม่มีสิทธิ์ใช้งานหน้านี้ กรุณาล็อคอินเข้าระบบใหม่อีกครั้ง';
		}
	}
	
}
