<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	//โหลดหน้าจอตารางงาน
	public function index(){
		$this->load->view('Calendar/View_Calendar');
	}
	
	//Get Event
	public function get_events(){
		$start 			= $this->input->get("start");
		$end 			= $this->input->get("end");
		$startdt 		= new DateTime('now'); 
		$startdt->setTimestamp($start); 
		$start_format 	= $startdt->format('Y-m-d H:i:s');

		$enddt 			= new DateTime('now'); 
		$enddt->setTimestamp($end); 
		$end_format 	= $enddt->format('Y-m-d H:i:s');
		// $events 		= $this->models_ResearchGuide->get_events($start_format, $end_format);
		$data_events 	= array();

		// foreach($events->result() as $r) {
			$data_events[] = array(
				"id" 			=> '1',
				"title" 		=> 'Title',
				"description" 	=> '',
				"start" 		=> '2020-11-05 00:00:00',
				"end" 			=> '2020-11-11 00:00:00',
			);
		// }

		echo json_encode(array("events" => $data_events));
		exit();
	}
}
