<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class models_ResearchGuide extends CI_Model {
	
	//โหลดข้อมูลจังหวัด
	public function LoadDataProvince($provinceCode){
		try{
			$SQL 	= "SELECT * FROM province WHERE province_id = '$provinceCode' ";
			$Query 	= $this->db->query($SQL);
			return $Query->result_array();
		}catch(Exception $Error){
			echo $Error;
		}
	}

	//โหลดข้อมูลไกด์
	public function LoadDataGuide($parameter){
		$type 				= $parameter["type"];
		$provice			= $parameter["provice"];
		$personbookig		= $parameter["personbookig"];
		$datestartbooking   = $parameter["datestartbooking"];
		$datestopbooking    = $parameter["datestopbooking"];
		$page 				= $parameter['page'];
		$row_count 			= $parameter['row'];
		$offset 			= ($page - 1) * $row_count ;

		//จำนวนข้อมูล
		$SQL 			= "SELECT COUNT(*) AS NumAll FROM area ";
		$SQL 			.= "LEFT JOIN guide ON area.guide_id = guide.guide_id ";
		$SQL 			.= "LEFT JOIN rate ON area.guide_id = rate.guide_id ";
		$SQL 			.= "WHERE area.province_id = '$provice'  ";
		$SQL 			.= "AND rate.person = '$personbookig' ";
		$QueryCount 	= $this->db->query($SQL);

		//เงื่อนไขการค้นหา
		if($type == 'All'){ //ถ้ากรองตามทั้งหมด
			$SQLConcat = ' ';
		}else if($type == 'Review'){ //ถ้ากรองตามคะแนนรีวิว
			$SQLConcat = ' ';
		}else if($type == 'Price'){ //ถ้ากรองตามราคา
			$SQLConcat = ' ORDER BY rate.amount ASC ';
		}else{
			$SQLConcat = ' ';
		}

		$SQL 			= "SELECT area.* , guide.* , rate.* FROM area ";
		$SQL 			.= "LEFT JOIN guide ON area.guide_id = guide.guide_id ";
		$SQL 			.= "LEFT JOIN rate ON area.guide_id = rate.guide_id ";
		$SQL 			.= "WHERE area.province_id = '$provice'  ";
		$SQL 			.= "AND rate.person = '$personbookig' ";
		$SQL 			.= $SQLConcat;
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
	}

}
