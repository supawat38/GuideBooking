<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_CustomerDetailBooking extends CI_Model {

	//โหลดข้อมูล บุ๊คกิ้งของตัวเอง
	public function LoadDataBooking($parameter){
		try{
			$tUserID 	= $this->session->userdata("session_refid");
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM booking ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT  
								booking.* ,
								province.province_name ,
								customer.firstname AS cus_firstname,
								customer.cus_phone AS cus_phone ,
								guide.firstname AS guide_firstname ,
								guide.lastname AS guide_lastname ,
								guide.guide_phone AS guide_phone ,
								payment.payment_id
							   FROM booking 
							   LEFT JOIN payment 	ON booking.booking_id 	= payment.refbooking_id
							   LEFT JOIN province 	ON booking.province_id = province.province_id 
							   LEFT JOIN guide 		ON booking.guide_id = guide.guide_id 
							   LEFT JOIN customer 	ON booking.cus_id = customer.cus_id 
							   WHERE booking.cus_id = '$tUserID' 
							   ORDER BY booking.booking_id DESC
							   LIMIT $row_count OFFSET $offset";
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
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//โหลดข้อมูลไกด์เอาไว้สำหรับรีวิว
	public function LoadInformationGuideForReview($GuideID){
		$SQL 			= "SELECT guide.* FROM guide ";
		$SQL 			.= " WHERE guide.guide_id = '$GuideID' ";
		$QueryItem 		= $this->db->query($SQL);
		return $QueryItem->result_array();
	}

	//insert ลงตาราง review
	public function InsertGuideForReview($Result){
		try{
			$this->db->insert('review', $Result);
		}catch(Exception $Error){
			echo $Error;
		}
	}

}
