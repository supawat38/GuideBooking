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

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM booking ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT booking.* , payment.* FROM booking
								LEFT JOIN payment ON payment.refbooking_id = booking.booking_id  
								WHERE booking.guide_id = '$tUserID' LIMIT $row_count OFFSET $offset";
			$QueryItem 		= $this->db->query($SQL);

			echo $SQL;
			exit;

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

}
