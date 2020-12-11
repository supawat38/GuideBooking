<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_GuideBooking extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataGuideBooking($parameter){
		try{
			$tUserID 	= $this->session->userdata("session_refid");
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM booking WHERE booking.guide_id = '$tUserID' ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT booking.* , payment.* , customer.firstname , customer.cus_phone , province.province_name FROM booking
								LEFT JOIN payment ON payment.refbooking_id = booking.booking_id  
								LEFT JOIN customer ON customer.cus_id = booking.cus_id  
								LEFT JOIN province ON province.province_id = booking.province_id  
								WHERE booking.guide_id = '$tUserID' ORDER BY booking.travel_date DESC LIMIT $row_count OFFSET $offset";
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

	//ข้อมูลการจอง
	public function GetData_Booking($ID){
		try{
			$SQL 	= "SELECT 
						booking.* ,
						payment.* ,
						province.province_name ,
						customer.firstname AS cus_firstname,
						customer.cus_phone AS cus_phone ,
						guide.firstname AS guide_firstname ,
						guide.guide_phone AS guide_phone ,
						admin.firstname AS admin_firstname ,
						rate.person
					FROM booking
					LEFT JOIN payment 	ON booking.booking_id 	= payment.refbooking_id
					LEFT JOIN province 	ON booking.province_id 	= province.province_id
					LEFT JOIN guide 	ON booking.guide_id 	= guide.guide_id 
					LEFT JOIN customer 	ON booking.cus_id 		= customer.cus_id 
					LEFT JOIN admin 	ON payment.approved_by 	= admin.admin_id 
					LEFT JOIN rate		ON booking.guide_id     = rate.guide_id AND booking.grandtotal = rate.amount
					WHERE booking.booking_id ='$ID' ";

			$QueryItem 		= $this->db->query($SQL);
			if($QueryItem->num_rows() > 0){
				$Result = array(
					'Items'  		=> $QueryItem->result_array(),
					'Code'   		=> '1',
					'Desc'   		=> 'success'
				);
			}else{
				$Result = array(
					'Code' 			=> '800',
					'Desc' 			=> 'data not found'
				);
			}
			return $Result;
		}catch(Exception $Error){
			echo $Error;
		}
	}

}
