<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuideOther extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('GuideOther/models_GuideOther');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_GuideOther->LoadDataGuideOther($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('GuideOther/View_GuideOtherDatatable',$PackData);
	}
}
