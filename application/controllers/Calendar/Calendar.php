<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	//โหลดหน้าจอตารางงาน
	public function index(){
		$this->load->view('Calendar/View_CalendarDatatable');
	}

	//โหลดหน้าจอสร้างตารางงาน
	public function AddCalendar($ActionMode){
		
		$this->load->view('Calendar/View_AddEditCalendar',array("ActionMode"=>$ActionMode));
	}
}
