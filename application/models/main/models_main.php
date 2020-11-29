<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class models_main extends CI_Model {

	//โหลดข้อมูลแพ็กเกจ
	public function LoadDatapackage($parameter){
		try{	
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			//จำนวนข้อมูล
			$SQL 			= "SELECT COUNT(*) AS NumAll FROM package WHERE package.package_status = '1'";
			$QueryCount 	= $this->db->query($SQL);

			//ข้อมูลเรียงลำดับจากล่าสุดไปน้อยสุด
			$SQL 			= "SELECT package.* , guide.* FROM package INNER JOIN guide ON package.guide_id = guide.guide_id  WHERE package.package_status = '1' ORDER BY package.package_id DESC 
							   LIMIT $row_count OFFSET $offset ";
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

	//โหลดข้อมูลรีวิวไกด์
	public function LoadDatareviewguide($parameter){
		try{	
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			//จำนวนข้อมูล
			$SQL 			= "SELECT COUNT(*) AS NumAll FROM review";
			$QueryCount 	= $this->db->query($SQL);

			//ข้อมูลเรียงลำดับจากล่าสุดไปน้อยสุด
			$SQL 			= "SELECT review.* , guide.* , reviewpoint.POINT FROM review 
							   LEFT JOIN guide ON review.guide_id = guide.guide_id  
							   LEFT JOIN ( 
								   SELECT guide_id , SUM(review_point) /  COUNT(review_id) AS POINT FROM review 
								) reviewpoint ON reviewpoint.guide_id = guide.guide_id 
							   LIMIT $row_count OFFSET $offset ";
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
	
}
