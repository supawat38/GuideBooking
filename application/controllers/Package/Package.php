<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('Package/models_package');
	}

	//โหลดหน้าจอแรก
	public function index(){

		//เช็คว่าเข้ามาแบบไหน
		$tUserType 	= $this->session->userdata("session_reftype");	
		$tUserID 	= $this->session->userdata("session_refid");

		$aPackData = array(
			'pageName' 		=> 'package'
		);

		if($tUserType == 1){ //ผู้ดูแลระบบ
			$this->load->view('header',$aPackData);
			$this->load->view('Package/View_package',$aPackData);
		}else if($tUserType == 2){ //ลูกค้า
			$this->load->view('header',$aPackData);
			$this->load->view('Package/View_package',$aPackData);
		}else if($tUserType == 3){ //มัคคุเทศก์
			$this->load->view('header',$aPackData);
			$this->load->view('Package/View_package',$aPackData);
		}else{
			echo 'คุณไม่มีสิทธิ์ใช้งานหน้านี้ กรุณาล็อคอินเข้าระบบใหม่อีกครั้ง';
		}
	}

	//โหลดข้อมูลตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 6
		);

		$result = $this->models_package->LoadDatapackage($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('Package/View_packageDataTable',$PackData);
	}

    //อัพโหลดไฟล์
    public function UploadFilePackage(){
		if ($_FILES["file"]["size"] < 120000000){
			if ($_FILES["file"]["error"] > 0){
				echo 406; //ไฟล์มีปัญหา
			}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],"./application/assets/File/package/" . $_FILES["file"]["name"]);
				echo $_FILES["file"]["name"];
			}
		}else{
			echo 405; //ไฟล์มีความผิดพลาด
		}
	}

	//โหลดหน้าจอเพิ่มข้อมูล + แก้ไข แพ๊คเกจ
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');

		//ข้อมูลไกด์ทั้งหมด กรณีให้ผู้ดูแลระบบเป็นคนเพิ่มให้
		$guideall = $this->models_package->LoadDataguide();

		if($typepage == 'pageinsert'){
			$result		= '';
		}else if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_package->GetData_package($id);
		}

		$PackData = array(
			'typepage' 			=> $typepage,
			'Result'			=> $result,
			'guideall'			=> $guideall
		);
		$this->load->view('Package/View_packageForms',$PackData);
	}

	//บันทึกข้อมูลหรือแก้ไขข้อมูล		
	public function EventInsoredit(){
		//Event Insert หรือ Edit
		$Typepage = $this->input->post('hiddenTypePage');

		//ประเภทของผู้ใช้
		$UserType 	= $this->session->userdata("session_reftype");	
		if($UserType == 1){ //ผู้ดูแลระบบ
			$guide_id = $this->input->post('GuidePackage');
		}else{
			$guide_id = $this->session->userdata("session_refid");
		}

		//เตรียมข้อมูลลงตาราง package
		$UpdatePackage = array(
			'package_id' 		=> $this->input->post('hiddenPackageID'),
			'guide_id' 			=> $guide_id,
			'package_file'	 	=> $this->input->post('regisPackageFileName'),
			'package_name' 		=> $this->input->post('regisPackageName'),
			'package_con' 		=> $this->input->post('regisPackageCon'),
			'package_image' 	=> $this->input->post('hiddenImgInsertPackage'),
			'package_status' 	=> ($this->input->post('regisPackageStatusUse') == 'on') ? 1 : 0
		);

		if($Typepage == 'pageedit' || $Typepage == 'pageedit'){ //แก้ไขข้อมูล
			$this->models_package->Update_package($UpdatePackage,'package');
		}else{ //เพิ่มข้อมูล
			$this->models_package->Insert_package($UpdatePackage,'package');
		}
	}

	//ลบข้อมูล
	public function EventDeletePackage(){
		$ID = $this->input->post('ID');
		$this->models_package->Delete_Package($ID);
	}
}
