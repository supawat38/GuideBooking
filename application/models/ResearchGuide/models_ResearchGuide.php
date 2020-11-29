<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_ResearchGuide extends CI_Model {
	
	//โหลดข้อมูลจังหวัด
	public function LoadDataProvince($provinceCode){
		try{
			$SQL 	= "SELECT * FROM province WHERE province_id = '$provinceCode' ";
			$Query 	= $this->db->query($SQL);
			return $Query->result_array();
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//โหลดข้อมูลไกด์
	public function LoadDataGuide($parameter){
		$type 				= $parameter["type"];
		$provice			= $parameter["provice"];
		$personbookig		= $parameter["personbookig"];
		$datestartbooking   = date("Y-m-d", strtotime(str_replace('/', '-', $parameter["datestartbooking"])));
		$datestopbooking    = date("Y-m-d", strtotime(str_replace('/', '-', $parameter["datestopbooking"])));
		$page 				= $parameter['page'];
		$row_count 			= $parameter['row'];
		$offset 			= ($page - 1) * $row_count ;

		//จำนวนข้อมูล
		$SQL 			= "SELECT COUNT(*) AS NumAll FROM area ";
		$SQL 			.= "LEFT JOIN guide ON area.guide_id = guide.guide_id ";
		$SQL 			.= "LEFT JOIN rate ON area.guide_id = rate.guide_id ";
		$SQL 			.= "INNER JOIN 
							( SELECT guide_id , SUM(guide_status) AS guide_status FROM calender WHERE guide_date BETWEEN '$datestartbooking' AND '$datestopbooking' GROUP BY guide_id  ) CALENDARS
							ON guide.guide_id = CALENDARS.guide_id ";
		$SQL 			.= "WHERE area.province_id = '$provice'  ";
		$SQL 			.= "AND rate.person = '$personbookig' ";
		$SQL 			.= "AND CALENDARS.guide_status = 0";
		$QueryCount 	= $this->db->query($SQL);

		//เงื่อนไขการค้นหา
		if($type == 'All'){ //ถ้ากรองตามทั้งหมด
			$SQLConcat = ' ';
		}else if($type == 'Review'){ //ถ้ากรองตามคะแนนรีวิว มากไปน้อย
			$SQLConcat = ' ORDER BY review.point DESC ';
		}else if($type == 'Price'){ //ถ้ากรองตามราคา น้อยไปมาก
			$SQLConcat = ' ORDER BY rate.amount ASC ';
		}else{
			$SQLConcat = ' ';
		}

		$SQL 			= "SELECT area.* , guide.* , rate.* , review.POINT FROM area ";
		$SQL 			.= "LEFT JOIN guide ON area.guide_id = guide.guide_id ";
		$SQL 			.= "LEFT JOIN rate ON area.guide_id = rate.guide_id ";
		$SQL 			.= " LEFT JOIN  
							( SELECT guide_id , SUM(review_point) /  COUNT(review_id) AS POINT FROM review )
							review ON review.guide_id = guide.guide_id ";
		$SQL 			.= " INNER JOIN 
							( SELECT guide_id , SUM(guide_status) AS guide_status FROM calender WHERE guide_date BETWEEN '$datestartbooking' AND '$datestopbooking' GROUP BY guide_id  ) CALENDARS
							ON guide.guide_id = CALENDARS.guide_id ";
		$SQL 			.= "WHERE area.province_id = '$provice'  ";
		$SQL 			.= "AND rate.person = '$personbookig' ";
		$SQL 			.= "AND CALENDARS.guide_status = 0";
		$SQL 			.= $SQLConcat;
		$SQL 			.= "LIMIT $row_count OFFSET $offset ";
		$QueryItem 		= $this->db->query($SQL);
		
		if($QueryItem->num_rows() > 0){
			$CountItemAll 	= $QueryCount->result_array()[0]['NumAll'];
			$EndPage 		= ceil($CountItemAll/$row_count); 
			$Result = array(
				'Items'  		=> $QueryItem->result_array(),
				'CountItemAll' 	=> $CountItemAll,
				'CurrentPage'	=> $page,
				'EndPage'		=> $EndPage,
				'Code'   		=> '1',
				'Desc'   		=> 'success'
			);
		}else{
			$Result = array(
				'CountItemAll' 	=> 0,
				'CurrentPage'	=> 1,
				'EndPage'		=> 1,
				'Code' 			=> '800',
				'Desc' 			=> 'data not found'
			);
		}
		return $Result;
	}

	//โหลดข้อมูลเรทราคา
	public function LoadInformationRate($GuideID,$RateID){
		$SQL 	 		= "SELECT * FROM rate WHERE guide_id = '$GuideID' AND person = '$RateID' ";
		$Query 	 		= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลลูกค้า
	public function LoadInformationCustomer(){
		$CustomerID 	= $this->session->userdata("session_refid");
		$SQL 	 		= "SELECT * FROM customer WHERE cus_id = '$CustomerID' ";
		$Query 	 		= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ 
	public function LoadInformationGuide($GuideID){
		$SQL 			= "SELECT * FROM guide WHERE guide_id = '$GuideID' ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ + จังหวัด
	public function LoadInformationGuideOnly($GuideID){
		$SQL 			= "SELECT guide.* , province.province_name FROM guide INNER JOIN province ON guide.province_id = province.province_id WHERE guide.guide_id = '$GuideID'  ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ + package
	public function LoadInformationGuidePackage($GuideID){
		$SQL 			= "SELECT * FROM package WHERE guide_id = '$GuideID' AND package_status = 1 ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ + ตารางที่รับงาน
	public function LoadInformationGuideArea($GuideID){
		$SQL 			= "SELECT area.* , province.province_name FROM area INNER JOIN province ON area.province_id = province.province_id WHERE guide_id = '$GuideID' ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ + รีวิว
	public function LoadInformationGuideReview($GuideID){
		$SQL 			= "SELECT * FROM review WHERE guide_id = '$GuideID' ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//โหลดข้อมูลไกด์ + เรทราคา
	public function LoadInformationGuideRate($GuideID){
		$SQL 			= "SELECT * FROM rate WHERE guide_id = '$GuideID' AND status_delete = 0 ";
		$Query 			= $this->db->query($SQL);
		return $Query->result_array();
	}

	//ค้นหาเลขที่เอกสารการจองล่าสุด
	public function GetLastDocumentBooking(){
		$SQL 	= "SELECT booking_id FROM booking ORDER BY booking_id DESC LIMIT 1";
		$Query 	= $this->db->query($SQL);
		if($Query->num_rows() > 0){
			$Result = array(
				'Items'  => $Query->result_array(),
				'Code'   => '1',
				'Desc'   => 'success'
			);
		}else{
			$Result = array(
				'Code' => '800',
				'Desc' => 'data not found'
			);
		}
		return $Result;
	}

	//ค้นหาเลขที่เอกสารการจ่ายเงินล่าสุด
	public function GetLastDocumentPayment(){
		$SQL 	= "SELECT payment_id FROM payment ORDER BY payment_id DESC LIMIT 1";
		$Query 	= $this->db->query($SQL);
		if($Query->num_rows() > 0){
			$Result = array(
				'Items'  => $Query->result_array(),
				'Code'   => '1',
				'Desc'   => 'success'
			);
		}else{
			$Result = array(
				'Code' => '800',
				'Desc' => 'data not found'
			);
		}
		return $Result;
	}

	//เพิ่มข้อมูลตารางบุ๊คกิ๊ง
	public function InsertBooking($Parameter){
		try{
			$this->db->insert('booking', $Parameter);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//เพิ่มข้อมูลตารางการชำระเงิน
	public function InsertPayment($Parameter){
		try{
			$this->db->insert('payment', $Parameter);
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//อัพเดทตารางเวลางาน
	public function UpdateCalendar($Parameter){
		$qty_date = $Parameter['qty_date'];
		if($qty_date == 1){ //จองแค่วันเดียว
			$this->db->set('note', $Parameter['note']);
			$this->db->set('guide_status', $Parameter['guide_status']);
			$this->db->where('guide_date',$Parameter['guide_date']);
			$this->db->where('guide_id',$Parameter['guide_id']);
			$this->db->update('calender');
		}else{
			$DataBookingStart 	= $Parameter['guide_date'];
			$DataBookingEnd 	= date("Y-m-d", strtotime($DataBookingStart . "+$qty_date days" ));
			$Status				= $Parameter['guide_status'];
			$Note				= $Parameter['note'];
			$SQL 	= "UPDATE calender
						SET note = '$Note' , guide_status = '$Status'
						WHERE guide_date BETWEEN '$DataBookingStart' AND '$DataBookingEnd'; ";
			$this->db->query($SQL);
		}
	}
	


}
