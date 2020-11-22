<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckBookingPayment extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('CheckBookingPayment/models_CheckBookingPayment');
	}

	//โหลดหน้าจอตาราง
	public function Loadtable(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 20
		);

		$result = $this->models_CheckBookingPayment->LoadDataBookingPayment($Condition);
		$PackData = array(
			'result'			=> $result,
			'nPage'				=> $numberpage
		);
		$this->load->view('CheckBookingPayment/View_CheckBookingPaymentDatatable',$PackData);
	}

	//โหลดหน้าจอตรวจสอบและเเก้ไข
	public function PageInsoredit(){
		$typepage = $this->input->post('typepage');
		if($typepage == 'pageedit'){
			$id 		= $this->input->post('id');
			$result 	= $this->models_CheckBookingPayment->GetData_BookingPayment($id);
		}

		$PackData = array(
			'typepage' 			=> $typepage,
			'Result'			=> $result
		);
		$this->load->view('CheckBookingPayment/View_CheckBookingPaymentForms',$PackData);
	}

	//อัพเดทสถานะการจองสมบูรณ์
	public function EventInsoredit(){
		$BookingID 	= $this->input->post('BookingID');
		$PaymentID 	= $this->input->post('PaymentID');
		$Price 		= $this->input->post('Price');

		//เอาข้อมูลไปอัพเดทตาราง payment 
		$PackData = array(
			'payment_rcv'			=> $Price,
			'status_approve' 		=> 1,
			'status_payment'		=> 1,
			'approved_by'			=> $this->session->userdata("session_refid"),
			'approved_date'			=> date("Y-m-d"),
			'refpayment_id'			=> $PaymentID
		);

		//อัพเดททีเงื่อนไข
		$Where = array(
			'payment_id'			=> $PaymentID,
			'refbooking_id'			=> $BookingID,
			'booking_id'			=> $BookingID
		);

		//อัพเดทข้อมูลที่ตาราง booking
		$this->models_CheckBookingPayment->UpdateData_Booking($PackData,$Where);

		//อัพเดทข้อมูลที่ตาราง payment
		$this->models_CheckBookingPayment->UpdateData_Payment($PackData,$Where);


	}

}
