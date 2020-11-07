<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAdmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ManageAdmin/models_admin');
	}

	//โหลดหน้าจอแรก
	public function index(){
		$Data = array(
			'pageName' 		=> 'ManageAdmin'
		);
		$this->load->view('header',$Data);
		$this->load->view('ManageAdmin/View_AdminList',$Data);
	}	 

	//โหลดข้อมูล Table
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_admin->LoadDataAdamin($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('ManageAdmin/View_AdminDataTable',$PackData);
	}

	//โหลดหน้าจอผู้ดูแลระบบ
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');
		if($typepage == 'pageinsert'){
			$result		= '';
		}else if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_admin->GetData_Admin($id);
		}

		$PackData = array(
			'typepage' 			=> $typepage,
			'Result'			=> $result
		);
		$this->load->view('ManageAdmin/View_AdminForms',$PackData);
	}

	//บันทึกข้อมูลหรือแก้ไขข้อมูล
	public function EventInsoredit(){
		//Event Insert หรือ Edit
		$Typepage = $this->input->post('hiddenTypePage');
		
		//เช็คข้อมูลก่อนว่า username สำหรับ login ซ้ำกันในตาราง login ไหม
		$CheckAdminLogin = array(
			'username' 		=> $this->input->post('regisAdminLoginID'),
			'Typepage'		=> $Typepage,
			'ID'			=> $this->input->post('hiddenAdminID')
		);
		$CheckUserLogin = $this->models_admin->CheckUserLogin($CheckAdminLogin);
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
			'admin_phone'	=> $this->input->post('regisAdminTelephone'),
			'admin_status'	=> ($this->input->post('regisAdminStatusUse') == 'on') ? 1 : 0
		);
		if($Typepage == 'pageedit' || $Typepage == 'pageedit'){ //แก้ไขข้อมูล
			$this->models_admin->Update_Admin($UpdateAdmin,'admin');
			$this->models_admin->Update_Login($UpdateAdmin);
		}else{ //เพิ่มข้อมูล
			$this->models_admin->Insert_Admin($UpdateAdmin,'admin');
			$this->models_admin->Insert_Login($UpdateAdmin);
		}
	}
}
