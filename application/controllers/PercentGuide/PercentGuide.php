<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PercentGuide extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('PercentGuide/models_PercentGuide');
		$this->load->model('register/models_register');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_PercentGuide->LoadDataPercentGuide($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('PercentGuide/View_PercentGuideDatatable',$PackData);
	}

	//โหลดหน้าจอเพิ่มข้อมูล + แก้ไข % GP
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');
		if($typepage == 'pageinsert'){
			$result		= '';
		}else if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_PercentGuide->GetData_PercentGuide($id);
		}

		//โหลดข้อมูลจังหวัด
		$resultProvince = $this->models_register->LoadDataProvince();

		$PackData = array(
			'typepage' 			=> $typepage,
			'dataprovince' 		=> $resultProvince,
			'Result'			=> $result
		);
		$this->load->view('PercentGuide/View_PercentGuideForms',$PackData);
	}

	//แก้ไขข้อมูลส่วนตัว มัคคุเทศก์
	public function EventInsoredit(){
		
		//คำถามส่งมารูปแบบ array ต้องแปลงเป็น Text
		$Question 		= $this->input->post('regisGuideQuestion');
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

		//เตรียมข้อมูลลงตาราง guide	 
		$UpdateGuide = array(
			'login_type'	=> 3,
			'username' 		=> $this->input->post('hiddenGuideID'),
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
			'guide_gp' 		=> $this->input->post('regisGuidePercent'), 
			'guide_qustions'=> $TextQuestion, 
			'guide_status' 	=> 1, 
			'status_delete' => 0
		);

		//อัพเดทข้อมูล guide
		$this->models_PercentGuide->Update_Guide($UpdateGuide,'guide');
		
		//แก้ไขจังหวัดที่มัคคุเทศน์ให้บริการ
		$area = $this->input->post('regisGuideArea');

		//ลบข้อมูลตาราง area
		$this->models_PercentGuide->Delete_Area($UpdateGuide);

		//เพิ่มข้อมูลใหม่ตาราง area
		if(count($area) > 0){
			for($i=0; $i<count($area); $i++){
				$InsertArea = array(
					'guide_id' 		=> $this->input->post('hiddenGuideID'),
					'province_id' 	=> $area[$i],
					'status_delete' => 0
				);
				$this->models_PercentGuide->Insert_Area($InsertArea,'area');
			}
		}
	}

	//ลบข้อมูล
	public function EventDeletepercentguide(){
		$ID = $this->input->post('ID');
		$this->models_PercentGuide->Delete_percentguide($ID);
	}
	
}
