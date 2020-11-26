<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuideAll extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('GuideAll/models_GuideAll');
	}

	//โหลดหน้าแรก
	public function index(){
		$PackData = array(
			'pageName' 		=> 'GuideAll',
		);
		$this->load->view('header',$PackData);
		$this->load->view('GuideAll/View_GuideAll',$PackData);
	}

	//โหลดข้อมูลมัคคุเทศก์
	public function LoadtableGuide(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_GuideAll->LoadDataGuideAll($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('GuideAll/View_GuideAllDatatable',$PackData);
	}
}
