<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResearchGuide extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('ResearchGuide/models_ResearchGuide');
	}

	//โหลดหน้าจอแรก
	public function index(){

		$provincebooking 	= $this->input->post("provincebooking");	
		$personbookig 		= $this->input->post("personbookig");
		$datestartbooking 	= $this->input->post("datestartbooking");
		$datestopbooking 	= $this->input->post("datestopbooking");

		$aPackData = array(
			'pageName' 		=> 'ResearchGuide'
		);

		
		$Condition = array(//โหลดข้อมูลจังหวัด
			'provincename' 		=> $this->models_ResearchGuide->LoadDataProvince($provincebooking),
			'provincebooking' 	=> $provincebooking,
			'personbookig'		=> $personbookig,
			'datestartbooking'	=> $datestartbooking,
			'datestopbooking'	=> $datestopbooking
		);
		
		$this->load->view('header',$aPackData);
		$this->load->view('ResearchGuide/View_ResearchGuide',$Condition);
	}

	//โหลดข้อมูลมัคคุเทศก์
	public function LoadtableGuide(){
		$arrayData = array(
			'type' 				=> $this->input->post("type"),
			'page' 				=> $this->input->post("numberpage"),
			'row'				=> 10,
			'provice'			=> $this->input->post("provice"),
			'personbookig'		=> $this->input->post("personbookig"),
			'datestartbooking'  => $this->input->post("datestartbooking"),
			'datestopbooking'   => $this->input->post("datestopbooking"),
		);

		//วิ่งไปหาข้อมูล
		$result = $this->models_ResearchGuide->LoadDataGuide($arrayData);
		$PackData = array(
			'result'			=> $result,
			'page'				=> $this->input->post("numberpage"),
			'provice'			=> $this->input->post("provincebooking"),
			'personbookig'		=> $this->input->post("personbookig"),
			'datestartbooking'  => $this->input->post("datestartbooking"),
			'datestopbooking'   => $this->input->post("datestopbooking"),
		);
		$this->load->view('ResearchGuide/View_ResearchGuideDatatable',$PackData);
	}
	
}
