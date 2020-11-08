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
			$SQL 			= "SELECT COUNT(*) AS NumAll FROM package";
			$QueryCount 	= $this->db->query($SQL);

			//ข้อมูลเรียงลำดับจากล่าสุดไปน้อยสุด
			$SQL 			= "SELECT package.* , guide.* FROM package INNER JOIN guide ON package.guide_id = guide.guide_id ORDER BY package.package_id DESC LIMIT $row_count OFFSET $offset ";
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
