<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_GuideAll extends CI_Model {

	//โหลดข้อมูลตาราง guide
	public function LoadDataGuideAll($parameter){
		try{
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM guide ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT 
									guide.* , 
									province.province_name 
								FROM guide ";
			$SQL 			.= "LEFT JOIN province ON guide.province_id = province.province_id ";
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
		}catch(Exception $Error){
			echo $Error;
		}
	}
	
}
