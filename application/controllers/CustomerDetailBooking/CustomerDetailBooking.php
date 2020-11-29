<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerDetailBooking extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('CustomerDetailBooking/models_CustomerDetailBooking');
	}

	//โหลดหน้าแรก
	public function index(){
		$PackData = array(
			'pageName' 		=> 'CustomerDetailBooking',
		);
		$this->load->view('header',$PackData);
		$this->load->view('CustomerDetailBooking/View_CustomerDetailBooking',$PackData);
	}

	//หน้าจอ Table
	public function LoadtableCustomerBooking(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_CustomerDetailBooking->LoadDataBooking($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('CustomerDetailBooking/View_CustomerDetailBookingDatatable',$PackData);
	}
}
