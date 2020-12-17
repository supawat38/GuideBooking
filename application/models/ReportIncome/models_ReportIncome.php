<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_ReportIncome extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataReportIncome($parameter){
		try{
			//ไม่ต้องแบ่ง page โชว์หมดเลย
			$page 			= $parameter['page'];

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM payment ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT payment.* , booking.booking_id , booking.grandtotal , guide.*  FROM payment 
								LEFT JOIN booking ON payment.refbooking_id = booking.booking_id 
								LEFT JOIN guide ON booking.guide_id = guide.guide_id 
								ORDER BY guide.guide_id DESC";
			$QueryItem 		= $this->db->query($SQL);
			if($QueryItem->num_rows() > 0){

				$CountItemAll 	= $QueryCount->result_array()[0]['NumAll'];
				$Result = array(
					'Items'  		=> $QueryItem->result_array(),
					'CountItemAll' 	=> $CountItemAll,
					'CurrentPage'	=> $page,
					'Code'   		=> '1',
					'Desc'   		=> 'success'
				);
			}else{
				$Result = array(
					'CountItemAll' 	=> 0,
					'CurrentPage'	=> 1,
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

