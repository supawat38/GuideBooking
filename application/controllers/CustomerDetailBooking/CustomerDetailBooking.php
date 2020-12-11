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
			'row'	=> 10
		);

		$result = $this->models_CustomerDetailBooking->LoadDataBooking($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('CustomerDetailBooking/View_CustomerDetailBookingDatatable',$PackData);
	}

	//โหลดข้อมูลไกด์ ให้เอาไปสำหรับรีวิว
	public function LoadInformationGuideForReview(){
		$GuideID 	= $this->input->post('GuideID');
		$BookingID 	= $this->input->post('BookingID');
		$result 	= $this->models_CustomerDetailBooking->LoadInformationGuideForReview($GuideID);
		$PackData = array(
			'result'			=> $result,
			'BookingID'			=> $BookingID
		);
		$this->load->view('CustomerDetailBooking/View_ReviewGuide',$PackData);
	}

	//แสดงความคิดเห็น
	public function ReviewGuide(){
		$GuideID 			= $this->input->post('GuideID');
		$reviewGuideText 	= $this->input->post('reviewGuideText');
		$reviewpoint 		= $this->input->post('reviewpoint');
		$BookingID			= $this->input->post('BookingID');
		$Insert 			= array( 
			'guide_id'		=> $GuideID,
			'booking_id'	=> $BookingID,
			'cus_id'		=> $this->session->userdata("session_refid"), 
			'review_date'	=> date('Y-m-d'), 
			'review_point'	=> $reviewpoint, 
			'review_text'	=> $reviewGuideText
		);
		$this->models_CustomerDetailBooking->InsertGuideForReview($Insert);
	}
}
