<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuideBooking extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('GuideBooking/models_GuideBooking');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		echo 'test';
		// $numberpage = $this->input->post('numberpage');
		// $Condition = array(
		// 	'page'  => $numberpage,
		// 	'row'	=> 20
		// );

		// $result = $this->models_GuideBooking->LoadDataGuideBooking($Condition);
		// $PackData = array(
		// 	'result'			=> $result,
		// 	'nPage'				=> $numberpage
		// );
		// $this->load->view('GuideBooking/View_GuideBookingDatatable',$PackData);
	}
}
