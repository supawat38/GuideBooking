<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_ReportGuide extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataReportGuide($parameter){
		try{
			//ไม่ต้องแบ่ง page โชว์หมดเลย
			$page 			= $parameter['page'];

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM guide ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT guide.guide_id AS guideCode , guide.* , review.* , COUNTPOINT.COUNTCOMMENT FROM guide 
								LEFT JOIN review ON guide.guide_id = review.guide_id 
								LEFT JOIN (
									SELECT guide_id , SUM(review.review_point) AS COUNTCOMMENT FROM review GROUP BY guide_id
								) AS COUNTPOINT ON COUNTPOINT.guide_id = guide.guide_id
								ORDER BY COUNTCOMMENT DESC";
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

