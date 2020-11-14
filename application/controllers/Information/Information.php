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

		//เช็คว่าเข้ามาแบบไหน
		$tUserType 	= $this->session->userdata("session_reftype");	
		$tUserID 	= $this->session->userdata("session_refid");

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

		if($tUserType == 1){ //ผู้ดูแลระบบ
			$this->load->view('Information/View_InformationAdmin',$aPackData);
		}else if($tUserType == 2){ //ลูกค้า
			$this->load->view('header',$aPackData);
			$this->load->view('Information/View_InformationCustomer',$aPackData);
		}else if($tUserType == 3){ //มัคคุเทศก์
			$this->load->view('Information/View_InformationGuide',$aPackData);
		}else{
			echo 'คุณไม่มีสิทธิ์ใช้งานหน้านี้ กรุณาล็อคอินเข้าระบบใหม่อีกครั้ง';
		}
	}	

	//แก้ไขข้อมูลส่วนตัว ผู้ดูแลระบบ
	public function UpdateInformationAdmin(){
		//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
		$CheckAdminLogin = array(
			'username' 		=> $this->input->post('regisAdminLoginID')
		);
		$CheckUserLogin = $this->models_Information->CheckUserLogin($CheckAdminLogin);
		if($CheckUserLogin['Code'] == 800){
			echo $CheckUserLogin['Desc'];
			exit;
		}

		//เตรียมข้อมูลลงตาราง admin
		$UpdateAdmin = array(
			'login_type'	=> 1,
			'username' 		=> $this->input->post('regisAdminLoginID'),
			'passwordOld'	=> $this->input->post('hiddenAdminPassword'),
			'password' 		=> $this->input->post('regisAdminPassword'),
			'ID'			=> $this->input->post('hiddenAdminID'),
			'firstname'		=> $this->input->post('regisAdminFirstname'),
			'lastname'		=> $this->input->post('regisAdminLastname'),
			'admin_image'	=> $this->input->post('hiddenImgInsertAdmin'),
			'admin_email'	=> $this->input->post('regisAdminEmail'),
			'admin_phone'	=> $this->input->post('regisAdminTelephone')
		);

		//อัพเดทข้อมูล admin
		$this->models_Information->Update_Admin($UpdateAdmin,'admin');
		$this->models_Information->UpdateLogin($UpdateAdmin);
	}

	//แก้ไขข้อมูลส่วนตัว ผู้ใช้งาน
	public function UpdateInformationCustomer(){
		//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
		$CheckCustomerLogin = array(
			'username' 		=> $this->input->post('regisCustomerLoginID')
		);
		$CheckUserLogin = $this->models_Information->CheckUserLogin($CheckCustomerLogin);
		if($CheckUserLogin['Code'] == 800){
			echo $CheckUserLogin['Desc'];
			exit;
		}

		//คำถามส่งมารูปแบบ array ต้องแปลงเป็น Text
		$Question 		= $this->input->post('regisCustomerQuestion');
		$TextQuestion 	= '';
		if(count($Question) > 0){
			for($i=0; $i<count($Question); $i++){
				$TextQuestion .= $Question[$i].',';

				//ถ้าวนลูปจนถึงตัวสุดท้ายเเล้ว ให้ ลบ , ตัวสุดท้ายออก
				if($i == count($Question)-1){
					$TextQuestion = substr($TextQuestion,0,-1);
				}
			}
		}

		//เตรียมข้อมูลลงตาราง customer
		$UpdateCustomer = array(
			'login_type'	=> 2,
			'username' 		=> $this->input->post('regisCustomerLoginID'),
			'passwordOld'	=> $this->input->post('hiddenCustomerPassword'),
			'password' 		=> $this->input->post('regisCustomerPassword'),
			'ID'			=> $this->input->post('hiddenCustomerID'),
			'firstname' 	=> $this->input->post('regisCustomerFirstname'),
			'lastname'		=> $this->input->post('regisCustomerLastname'), 
			'cus_bd'		=> date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('regisCustomerBirthday')))),
			'gender'		=> $this->input->post('regisCustomerGenter'), 
			'address'		=> $this->input->post('regisCustomerAddress'), 
			'cus_email'		=> $this->input->post('regisCustomerEmail'),
			'cus_phone'		=> $this->input->post('regisCustomerTelephone'),  
			'cus_image'		=> $this->input->post('hiddenImgInsertCustomer'), 
			'cus_qustions'	=> $TextQuestion,
			'cus_status'	=> 1,
			'status_delete'	=> 0
		);

		//อัพเดทข้อมูล customer
		$this->models_Information->Update_Customer($UpdateCustomer,'customer');
		$this->models_Information->UpdateLogin($UpdateCustomer);
	}

	//แก้ไขข้อมูลส่วนตัว มัคคุเทศก์
	public function UpdateInformationGuide(){
		//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
		$CheckCustomerLogin = array(
			'username' 		=> $this->input->post('regisGuideLoginID')
		);
		$CheckUserLogin = $this->models_Information->CheckUserLogin($CheckCustomerLogin);
		if($CheckUserLogin['Code'] == 800){
			echo $CheckUserLogin['Desc'];
			exit;
		}

		//เตรียมข้อมูลลงตาราง guide	 
		$UpdateGuide = array(
			'login_type'	=> 3,
			'username' 		=> $this->input->post('regisGuideLoginID'),
			'passwordOld'	=> $this->input->post('hiddenGuidePassword'),
			'password' 		=> $this->input->post('regisGuidePassword'),
			'ID'			=> $this->input->post('hiddenGuideID'),
			'firstname' 	=> $this->input->post('regisGuideFirstname'), 
			'lastname' 		=> $this->input->post('regisGuideLastname'), 
			'gender'		=> $this->input->post('regisGuideGenter'),
			'guide_bd'		=> date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('regisGuideBirthday')))),
			'guide_credit' 	=> $this->input->post('regisGuideCredit'), 
			'guide_license' => $this->input->post('regisGuideLicense'), 
			'address' 		=> $this->input->post('regisGuideAddress'), 
			'province_id' 	=> $this->input->post('regisGuideProvince'), 
			'postcode' 		=> $this->input->post('regisGuidePostCode'), 
			'guide_phone' 	=> $this->input->post('regisGuideTelephone'), 
			'guide_email' 	=> $this->input->post('regisGuideEmail'), 
			'guide_image' 	=> $this->input->post('hiddenImgInsertGuide'), 
			'intro_profile' => $this->input->post('regisGuideAbout'), 
			'guide_status' 	=> 1, 
			'status_delete' => 0
		);

		//อัพเดทข้อมูล guide
		$this->models_Information->Update_Guide($UpdateGuide,'guide');
		$this->models_Information->UpdateLogin($UpdateGuide);

		//แก้ไขจังหวัดที่มัคคุเทศน์ให้บริการ
		$area = $this->input->post('regisGuideArea');

		//ลบข้อมูลตาราง area
		$this->models_Information->Delete_Area($UpdateGuide);

		//เพิ่มข้อมูลใหม่ตาราง area
		if(count($area) > 0){
			for($i=0; $i<count($area); $i++){
				$InsertArea = array(
					'guide_id' 		=> $this->input->post('hiddenGuideID'),
					'province_id' 	=> $area[$i],
					'status_delete' => 0
				);
				$this->models_Information->Insert_Area($InsertArea,'area');
			}
		}
	}
}
