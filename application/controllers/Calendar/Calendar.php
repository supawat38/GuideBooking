<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('GuideCalendar/models_GuideCalendar');
	}

	//โหลดหน้าจอตารางงาน
	public function index(){

		$guide_id = $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์

		$Filter = array("guide_id" => $guide_id);

		$Result = $this->models_GuideCalendar->ShowList_Calendar($Filter);

		$this->load->view('Calendar/View_CalendarDatatable',array("Result"=>$Result));
	}

	//ตรวจสอบการสร้างตารางงาน
	public function CheckAddCalendar(){

		   $AddYear  =  $this->input->post('AddYear'); //ปีที่เลือก
		   $AddMonth = $this->input->post('AddMonth'); //เดือนที่เลือก
		   $GuideId  =  $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์
		   $Conditions = array("AddYear"  => $AddYear,
							   "AddMonth" => $AddMonth,
							   "GuideId"  => $GuideId);
		   echo $this->models_GuideCalendar->CheckAddCalendar($Conditions);

	}

	//โหลดหน้าจอสร้างตารางงาน
	public function AddCalendar(){

		$ActionMode = $this->input->post('ActionMode');
		$AddYear = $this->input->post('AddYear');
		$AddMonth = $this->input->post('AddMonth');

		$this->load->view('Calendar/View_AddEditCalendar',array("ActionMode"=>$ActionMode,
																"AddYear"   => $AddYear,
															    "AddMonth"  => $AddMonth));
	}

	//บันทึกหน้าจอสร้างตารางงาน
	public function SaveCalendar(){

		   $CalendarSet = $this->input->post('CalendarSet');
		   $CalendarDate = $this->input->post('CalendarDate');
		   $ActionMode = $this->input->post('ActionMode');
		   $GuideId = $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์
			
		   //Mode Add
		   if($ActionMode == 1){
		
                for($i = 0; $i<count($CalendarDate); $i++){
					$note = '';

					//ตรวจสอบ สถานะ การ Set Calendar
					switch ($CalendarSet[$i]) {
						case '0':

							$note = "ว่าง";
							break;
						case '1':
							$note = "จองแล้ว";
							break;
						case '2':
							$note = "ไม่ว่าง";
							break;
						
						default:
						    $note = "ว่าง";
							break;
					}

					$Data = array("guide_date" => $CalendarDate[$i],
									"guide_id" => $GuideId,
									"guide_status" => $CalendarSet[$i],
									"note" => $note);

					echo "Res: " . $Result = $this->models_GuideCalendar->Insert_Calendar($Data,"calender");

				}
		   }

		   
	}

	
}
