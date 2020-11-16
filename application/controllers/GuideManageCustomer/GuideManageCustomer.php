<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuideManageCustomer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('GuideManageCustomer/models_GuideManageCustomer');
		$this->load->model('Information/models_Information');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_GuideManageCustomer->LoadDataManageCustomer($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('GuideManageCustomer/View_ManageCustomerDatatable',$PackData);
	}

	//โหลดหน้าจอแก้ไขข้อมูลลูกค้า
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');
		
		if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_GuideManageCustomer->GetData_ManageCustomer($id);
		}

		$PackData = array(
			'typepage' 			=> $typepage,
			'Result'			=> $result
		);
		$this->load->view('GuideManageCustomer/View_ManageCustomerForms',$PackData);
	}

	//ลบข้อมูล
	public function EventDeleteManageCustomer(){
		$ID = $this->input->post('ID');
		$this->models_GuideManageCustomer->Delete_ManageCustomer($ID);
	}

	//แก้ไขข้อมูล
	public function EventInsoredit(){
		//เช็คข้อมูลก่อนว่า username ซ้ำกันในตาราง login ไหม
		$CheckCustomerLogin = array(
			'username' 		=> $this->input->post('regisCustomerLoginID'),
			'ID' 			=> $this->input->post('hiddenCustomerID')
		);
		$CheckUserLogin = $this->models_GuideManageCustomer->CheckUserLogin($CheckCustomerLogin);
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
		$this->models_GuideManageCustomer->Update_Customer($UpdateCustomer,'customer');
		$this->models_GuideManageCustomer->UpdateLogin($UpdateCustomer);
	}


}
