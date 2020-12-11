<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guiderate extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('Guiderate/models_Guiderate');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_Guiderate->LoadDataRate($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('Guiderate/View_GuiderateDatatable',$PackData);
	}

	//โหลดหน้าจอเพิ่มข้อมูล + แก้ไข ตารางราคา
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');
		if($typepage == 'pageinsert'){
			$result		= '';
		}else if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_Guiderate->GetData_rate($id);
		}

		$PackData = array(
			'typepage' 			=> $typepage,
			'Result'			=> $result
		);
		$this->load->view('Guiderate/View_GuiderateForms',$PackData);
	}

	//บันทึกข้อมูลหรือแก้ไขข้อมูล
	public function EventInsoredit(){
		//Event Insert หรือ Edit
		$Typepage = $this->input->post('hiddenTypePage');
		
		//เตรียมข้อมูลลงตาราง rate
		$Updaterate = array(
			'rate_id'		=> $this->input->post('hiddenrateID'),
			'ratepriceold'	=> $this->input->post('ratepriceold'),
			'guide_id' 		=> $this->session->userdata("session_refid"),
			'amount'		=> $this->input->post('rateprice'),
			'note' 			=> $this->input->post('ratedetail'),
			'person' 		=> $this->input->post('personrate'),
			'status_delete'	=> 0,
		);
		if($Typepage == 'pageedit'){ //แก้ไขข้อมูล

			//ต้องเช็คก่อนว่าราคาใหม่ที่กำลังจะเเก้ไขมีการจองเเล้วหรือยัง ถ้ามีเเล้วเเก้ไขไม่ได้
			$CheckUseRate = $this->models_Guiderate->CheckUse_rate($Updaterate);
			if($CheckUseRate['Code'] == 1){
				echo 'rate_use';
			}else{
				$this->models_Guiderate->Update_rate($Updaterate,'rate');
			}
		}else{ //เพิ่มข้อมูล
			$this->models_Guiderate->Insert_rate($Updaterate,'rate');
		}
	}

	//ลบข้อมูล
	public function EventDeleterate(){
		$ID 		= $this->input->post('ID');
		$Amount 	= $this->input->post('Amount'); 
		$GuideID 	= $this->input->post('GuideID');   

		//ข้อมูลสำหรับเอาไปเช็คว่ามีการใช้อยู่ไหม
		$PackData = array(
			'guide_id' 		=> $GuideID,
			'ratepriceold'	=> $Amount
		);

		//ต้องเช็คก่อนว่าราคาใหม่ที่กำลังจะเเก้ไขมีการจองเเล้วหรือยัง ถ้ามีเเล้วเเก้ไขไม่ได้
		$CheckUseRate = $this->models_Guiderate->CheckUse_rate($PackData);
		if($CheckUseRate['Code'] == 1){
			echo 'rate_use';
		}else{
			$this->models_Guiderate->Delete_rate($ID);
		}
	}
	
}
