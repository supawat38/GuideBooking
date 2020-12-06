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
			'provice'			=> $this->input->post("provice"),
			'personbookig'		=> $this->input->post("personbookig"),
			'datestartbooking'  => $this->input->post("datestartbooking"),
			'datestopbooking'   => $this->input->post("datestopbooking"),
		);
		$this->load->view('ResearchGuide/View_ResearchGuideDatatable',$PackData);
	}

	//การจอง
	public function Booking(){
		$Condition = array(
			'provincename' 		=> $this->models_ResearchGuide->LoadDataProvince($this->input->post('ProvinceID')),
			'provincebooking' 	=> $this->input->post('ProvinceID'),
			'personbookig'		=> $this->input->post('RateID'),
			'datestartbooking'	=> $this->input->post('DateStart'),
			'datestopbooking'	=> $this->input->post('DateStop'),
			'GuideID'			=> $this->input->post('GuideID'),
			'DetailRate'		=> $this->models_ResearchGuide->LoadInformationRate($this->input->post('GuideID'),$this->input->post('RateID')),
			'Customer'			=> $this->models_ResearchGuide->LoadInformationCustomer(),
			'Guide'				=> $this->models_ResearchGuide->LoadInformationGuide($this->input->post('GuideID'))
		);
		$this->load->view('ResearchGuide/View_Booking',$Condition);
	}

	//โหลดข้อมูลเพิ่มเติมของไกด์
	public function BookingDetailGuide($GuideID){
		$Condition = array(
			'DetailGuide'	=> $this->models_ResearchGuide->LoadInformationGuideOnly($GuideID),
			'DetailRate'	=> $this->models_ResearchGuide->LoadInformationGuideRate($GuideID),
			'DetailPackage'	=> $this->models_ResearchGuide->LoadInformationGuidePackage($GuideID),
			'DetailArea'	=> $this->models_ResearchGuide->LoadInformationGuideArea($GuideID),
			'DetailReview'	=> $this->models_ResearchGuide->LoadInformationGuideReview($GuideID)
		);
		$this->load->view('GuideAll/View_DetailGuide',$Condition);
	}

	//โหลดหน้าจอจ่ายเงิน
	public function BookingConfirm(){
		//Insert ลงตาราง
		$provincebooking 	= $this->input->post('provincebooking');
		$personbookig		= $this->input->post('personbookig');
		$datestartbooking	= $this->input->post('datestartbooking');
		$datestopbooking	= $this->input->post('datestopbooking');
		$GuideID			= $this->input->post('GuideID');

		//หาเลขที่เอกสารล่าสุด
		$LastCode 	= $this->models_ResearchGuide->GetLastDocumentBooking();
		if($LastCode['Code'] == 800){
			$BookingCode = 'BOOKING00001';
		}else{
			$LastCode 		= $LastCode['Items'][0]['booking_id'];
			$Explode		= explode("BOOKING",$LastCode);
			$Number		= $Explode[1] + 1;
			$CountNumber	= count($Number);
			if($CountNumber == 1){
				$Format 		= '0000';
			}else if($CountNumber == 2){
				$Format 		= '000';
			}else if($CountNumber == 3){
				$Format 		= '00';
			}else{
				$Format 		= '0';
			}

			$BookingCode = 'BOOKING'.str_pad($Number,strlen($Format)+1,$Format,STR_PAD_LEFT);
		}

		//หาว่าวันที่ห่างกันกี่วัน
		$DateBookingStart = date_create(str_replace('/', '-', $datestartbooking));
		$DateBookingStop  = date_create(str_replace('/', '-', $datestopbooking));
		$DateDiff		  =	date_diff($DateBookingStart,$DateBookingStop);
		if($DateDiff->format("%a") == 0){
			$DateDiff = 1;
		}else{
			$DateDiff = $DateDiff->format("%a");
		}

		//ข้อมูลลูกค้า
		$Cusotmer 		  = $this->models_ResearchGuide->LoadInformationCustomer();
		$CustomerEmail    = $Cusotmer[0]['cus_email'];
		$CustomerTelphone = $Cusotmer[0]['cus_phone'];

		//ราคาการจองครั้งนี้
		$Price 			  = $this->models_ResearchGuide->LoadInformationRate($GuideID,$personbookig);
		$Price			  = $Price[0]['amount'];

		//เอาไปอัพเดทในตาราง calendar ว่า guide คนนี้มีการจอง
		$PackDataInscalendar = array(
			'guide_date'	=> date("Y-m-d", strtotime(str_replace('/', '-', $datestartbooking))),  
			'qty_date'		=> $DateDiff,
			'guide_id'		=> $GuideID,
			'guide_status'	=> '1',
			'note'			=> 'จองแล้ว'
		);
		$this->models_ResearchGuide->UpdateCalendar($PackDataInscalendar);
		
		//เตรียมข้อมูล insert
		$PackDataIns = array(
			'booking_id' 		=> $BookingCode, 
			'cus_id' 			=> $this->session->userdata("session_refid"), 
			'guide_id' 			=> $GuideID, 
			'booking_date' 		=> date("Y-m-d"), 
			'province_id' 		=> $provincebooking, 
			'travel_date' 		=> date("Y-m-d", strtotime(str_replace('/', '-', $datestartbooking))),  
			'qty_date' 			=> $DateDiff, 
			'cus_email' 		=> $CustomerEmail, 
			'cus_phone' 		=> $CustomerTelphone, 
			'amount' 			=> '0', 
			'pro_amount' 		=> '0', 
			'grandtotal' 		=> $Price, 
			'status_booking' 	=> '1', //0:เอกสารไม่สมบูรณ์ 1:สมบูรณ์
			'status_payment' 	=> '0', //0:ยังไม่ได้ชำระ 1:ชำระแล้ว
			'refpayment_id' 	=> '',  
			'status_paytoguide' => '', 
			'note' 				=> '-', 
		);
		$this->models_ResearchGuide->InsertBooking($PackDataIns);

		//โหลดหน้าจอชำระเงิน
		$DataToView = array(
			'booking_id'	=> $BookingCode,
			'grandtotal'	=> $Price
		);
		$this->load->view('ResearchGuide/View_BookingPayment',$DataToView);
	}

	//อัพโหลดรูปภาพสลิป
	public function UploadSlip(){
		if ($_FILES["file"]["size"] < 120000000){
			if ($_FILES["file"]["error"] > 0){
				echo 406; //ไฟล์มีปัญหา
			}else{
				$BookingID 	= $this->input->post('bookingID');
				$Unit 		= $this->input->post('unit');
				move_uploaded_file($_FILES["file"]["tmp_name"],"./application/assets/images/slip/".$BookingID.".".$Unit);
				echo $BookingID.".".$Unit;
			}
		}else{
			echo 405; //ไฟล์มีความผิดพลาด
		}
	}

	//แจ้งจ่ายเงินจบการจอง
	public function ConfirmPayment(){
		$pathSlip 		= $this->input->post('pathSlip');
		$bankFrom 		= $this->input->post('bankFrom');
		$booking_id 	= $this->input->post('booking_id');
		$grandtotal		= $this->input->post('grandtotal');

		//หาเลขที่เอกสารล่าสุด
		$LastCode 	= $this->models_ResearchGuide->GetLastDocumentPayment();
		if($LastCode['Code'] == 800){
			$PayMentCode = 'PAY00001';
		}else{
			$LastCode 		= $LastCode['Items'][0]['payment_id'];
			$Explode		= explode("PAY",$LastCode);
			$Number			= $Explode[1] + 1;
			$CountNumber	= count($Number);
			if($CountNumber == 1){
				$Format 		= '0000';
			}else if($CountNumber == 2){
				$Format 		= '000';
			}else if($CountNumber == 3){
				$Format 		= '00';
			}else{
				$Format 		= '0';
			}

			$PayMentCode = 'PAY'.str_pad($Number,strlen($Format)+1,$Format,STR_PAD_LEFT);
		}

		//เตรียมข้อมูล insert
		$PackDataIns = array(
			'payment_id'		=> $PayMentCode, 
			'refbooking_id'		=> $booking_id, 
			'payment_date'		=> date("Y-m-d"), 
			'payment_time'		=> date("H:i:s"), 
			'payment_type'		=> 2, 
			'payment_slip'		=> $pathSlip, 
			'payment_frombank'	=> $bankFrom, 
			'payment_tobank'	=> 'ไทยพาณิชย์', 
			'payment_account'	=> '206-244992-5', 
			'amount'			=> $grandtotal, 
			'payment_rcv'		=> '', 
			'status_approve'	=> 0,  
			'approved_by'		=> '',  
			'approved_date'		=> '', 
			'note'				=> '' 
		);
		$this->models_ResearchGuide->InsertPayment($PackDataIns);
	}
	
	//โหลดหน้าจอจ่ายเงิน
	public function BookingConfirmLater(){
		//โหลดหน้าจอชำระเงิน
		$DataToView = array(
			'booking_id'	=> $this->input->post('booking_id'),
			'grandtotal'	=> $this->input->post('grandtotal')
		);
		$this->load->view('ResearchGuide/View_BookingPaymentLater',$DataToView);
	}
	
}
