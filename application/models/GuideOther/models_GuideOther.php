<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_GuideOther extends CI_Model {

	//โหลดข้อมูลตาราง
	public function LoadDataGuideOther($parameter){
		try{
			$page 		= $parameter['page'];
			$row_count 	= $parameter['row'];
			$offset 	= ($page - 1) * $row_count ;

			$SQL 			= "SELECT COUNT(*) AS NumAll FROM guide ";
			$QueryCount 	= $this->db->query($SQL);

			$SQL 			= "SELECT  * FROM guide LIMIT $row_count OFFSET $offset";
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
