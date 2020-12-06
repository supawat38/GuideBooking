<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportIncome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ReportIncome/models_ReportIncome');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage
		);

		$result = $this->models_ReportIncome->LoadDataReportIncome($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('ReportIncome/View_ReportIncomeDatatable.php',$PackData);
	}

}
