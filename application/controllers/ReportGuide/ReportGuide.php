<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportGuide extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ReportGuide/models_ReportGuide');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage
		);

		$result = $this->models_ReportGuide->LoadDataReportGuide($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('ReportGuide/View_ReportGuideDatatable',$PackData);
	}

}
