<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_CheckBookingPayment extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataBookingPayment($parameter){
		try{
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
								guide.guide_phone AS guide_phone ,
								payment.payment_id
							   FROM booking 
							   LEFT JOIN payment 	ON booking.booking_id 	= payment.refbooking_id
							   LEFT JOIN province 	ON booking.province_id = province.province_id 
							   LEFT JOIN guide 		ON booking.guide_id = guide.guide_id 
							   LEFT JOIN customer 	ON booking.cus_id = customer.cus_id 
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

	//โหลดข้อมูลตามรหัส
	public function GetData_BookingPayment($id){
		try{
			$SQL 			= "SELECT 
								booking.* ,
								payment.* ,
								province.province_name ,
								customer.firstname AS cus_firstname,
								customer.cus_phone AS cus_phone ,
								guide.firstname AS guide_firstname ,
								guide.guide_phone AS guide_phone ,
								admin.firstname AS admin_firstname
							FROM booking
							LEFT JOIN payment 	ON booking.booking_id 	= payment.refbooking_id
							LEFT JOIN province 	ON booking.province_id 	= province.province_id
							LEFT JOIN guide 	ON booking.guide_id 	= guide.guide_id 
							LEFT JOIN customer 	ON booking.cus_id 		= customer.cus_id 
							LEFT JOIN admin 	ON payment.approved_by 	= admin.admin_id 
							 WHERE booking.booking_id ='$id' ";

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

	//อัพเดทข้อมูล
	public function UpdateData_Booking($PackData,$Where){
		$this->db->set('status_payment',$PackData['status_payment']);
		$this->db->set('refpayment_id',$PackData['refpayment_id']);
		$this->db->where('booking_id',$Where['booking_id']);
		$this->db->update('booking');
	}
	
	//อัพเดทข้อมูล
	public function UpdateData_Payment($PackData,$Where){
		$this->db->set('payment_rcv', $PackData['payment_rcv']);
		$this->db->set('status_approve', $PackData['status_approve']);
		$this->db->set('approved_by', $PackData['approved_by']);
		$this->db->set('approved_date', $PackData['approved_date']);
		$this->db->where('payment_id',$Where['payment_id']);
		$this->db->where('refbooking_id',$Where['refbooking_id']);
		$this->db->update('payment');
	}
}
