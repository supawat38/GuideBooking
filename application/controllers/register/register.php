<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
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

		$aPackData = array(
			'pageName' 		=> 'register',
			'dataprovince' 	=> $arrayProvince
		);

		$this->load->view('header',$aPackData);
		$this->load->view('register/body',$aPackData);
	}	

	//ลงทะเบียน
	public function RegisterSystems(){
		$TypeRegis = $this->input->post('ohdTypeRegis');
		if($TypeRegis == 1){ //ลงทะเบียน - แก้ไขข้อมูลผู้ดูแลระบบ

			//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
			$CheckAdminLogin = array(
				'username' 		=> $this->input->post('regisAdminLoginID')
			);
			$CheckUserLogin = $this->models_register->CheckUserLogin($CheckAdminLogin);
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
			$tUserType 	= $this->session->userdata("session_reftype");	
			if($tUserType != '' || $tUserType != null){ //แก้ไขข้อมูล
				$this->models_register->UpdateCustomerOrGuideOrAdmin($UpdateAdmin,'admin');
				$this->models_register->UpdateLogin($UpdateAdmin);
			}else{ //เพิ่มข้อมูล

			}
		}else if($TypeRegis == 2){ //ลงทะเบียน - แก้ไขข้อมูลผู้ใช้ทั่วไป

			//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
			$CheckCustomerLogin = array(
				'username' 		=> $this->input->post('regisCustomerLoginID')
			);
			$CheckUserLogin = $this->models_register->CheckUserLogin($CheckCustomerLogin);
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
			$InsertCustomer = array(
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
			//เพิ่มข้อมูลลงตาราง customer
			$this->models_register->InsertCustomerOrGuideOrAdmin($InsertCustomer,'customer');

			//ดึงข้อมูล customer ล่าสุดออกมา
			$resultCustomerID = $this->models_register->selectCustomerIDLast();
			if($resultCustomerID['Code'] == '800' ){
				$CustomerID = 0;
			}else{
				$CustomerID = $resultCustomerID['Items'][0]['cus_id'];
			}

			//เตรียมข้อมูลลงตาราง login
			$InsertCustomerLogin = array(
				'username' 		=> $this->input->post('regisCustomerLoginID'),
				'password' 		=> md5($this->input->post('regisCustomerPassword')),
				'login_type' 	=> '2', 
				'reflogin_id' 	=> $CustomerID
			);
			//เพิ่มข้อมูลลงตาราง login
			$this->models_register->InsertLogin($InsertCustomerLogin);
		}else if($TypeRegis == 3){ //ลงทะเบียน - แก้ไขข้อมูลมัคคุเทศน์

			//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
			$CheckCustomerLogin = array(
				'username' 		=> $this->input->post('regisGuideLoginID')
			);
			$CheckUserLogin = $this->models_register->CheckUserLogin($CheckCustomerLogin);
			if($CheckUserLogin['Code'] == 800){
				echo $CheckUserLogin['Desc'];
				exit;
			}

			//เตรียมข้อมูลลงตาราง guide	 
			$InsertGuide = array(
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
				'guide_gp' 		=> 0, 
				'guide_ranking' => 0, 
				'guide_status' 	=> 1, 
				'status_delete' => 0
			);
			//เพิ่มข้อมูลลงตาราง guide
			$this->models_register->InsertCustomerOrGuideOrAdmin($InsertGuide,'guide');

			//ดึงรหัสมัคคุเทศน์ล่าสุดที่พึ่งเพิ่มเข้าไป 
			$resultGuideID = $this->models_register->selectGuideIDLast();
			if($resultGuideID['Code'] == '800' ){
				$GuideID = 0;
			}else{
				$GuideID = $resultGuideID['Items'][0]['guide_id'];
			}

			//เพิ่มจังหวัดที่มัคคุเทศน์ให้บริการ
			$area = $this->input->post('regisGuideArea');
			if(count($area) > 0){
				for($i=0; $i<count($area); $i++){
					$InsertArea = array(
						'guide_id' 		=> $GuideID,
						'province_id' 	=> $area[$i],
						'status_delete' => 0
					);
					$this->models_register->InsertCustomerOrGuideOrAdmin($InsertArea,'area');
				}
			}

			//เตรียมข้อมูลลงตาราง login
			$InsertCustomerLogin = array(
				'username' 		=> $this->input->post('regisGuideLoginID'),
				'password' 		=> md5($this->input->post('regisGuidePassword')),
				'login_type' 	=> '3', 
				'reflogin_id' 	=> $GuideID
			);
			//เพิ่มข้อมูลลงตาราง login
			$this->models_register->InsertLogin($InsertCustomerLogin);
		}
	}
}
