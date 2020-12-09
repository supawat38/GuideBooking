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
		$yearSearch  =  $this->input->post('calendarYearSearch'); //ปีที่ค้นหา
		$monthSearch = $this->input->post('calendarMonthSearch'); //เดือนที่ค้นหา

		$Filter = array("guide_id" => $guide_id,
						"yearSearch"  => $yearSearch,
					    "monthSearch" => $monthSearch);

		$Result = $this->models_GuideCalendar->ShowList_Calendar($Filter);

		$this->load->view('Calendar/View_CalendarDatatable',array("Result"     =>$Result,
																  "yearSearch" =>$yearSearch,
																  "monthSearch"=>$monthSearch));
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
		$AddYear 	= $this->input->post('AddYear');
		$AddMonth 	= $this->input->post('AddMonth');

		$this->load->view('Calendar/View_CalendarForms',array("ActionMode"=>$ActionMode,
																"AddYear"   => $AddYear,
															    "AddMonth"  => $AddMonth));
	}

	//บันทึกหน้าจอสร้างตารางงาน
	public function SaveCalendar(){

		   $CalendarSet = $this->input->post('CalendarSet');
		   $CalendarDate = $this->input->post('CalendarDate');
		   $ActionMode = $this->input->post('ActionMode');
		   $GuideId = $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์

		   $CalenMonth  = date("m", strtotime($CalendarDate[0]));
		   $CalenYear   = date("Y", strtotime($CalendarDate[0]));
			
		   //Mode Add
		   if($ActionMode == 2){ 
			   
				$Condition = array("guide_id"   => $GuideId ,
								   "CalenMonth" => $CalenMonth,
								   "CalenYear"  => $CalenYear);
			    $this->models_GuideCalendar->Delete_Calendar($Condition);
		     
		   }
		
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

					echo  $Result = $this->models_GuideCalendar->Insert_Calendar($Data,"calender");

				}
		   

		   
	}

	//แก้ไขหน้าจอสร้างตารางงาน
	public function EditCalendar(){

		    //รับพารามิตเตอร์ที่ส่งมาจาก Ajax
			$ActionMode = $this->input->post('ActionMode');
			$GuideId = $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์
			$EditcalenYear = $this->input->post('EditcalenYear'); //ปีที่ต้องการแก้ไข
			$EditcalenMonth = $this->input->post('EditcalenMonth'); //เดือนที่ต้องการแก้ไข
			
			//สร้างเงื่อนไขในการค้นหาข้อมูลตารางเวลาที่ต้องการแก้ไข
			$Filter = array("guide_id"   => $GuideId,
				            "calenYear"  => $EditcalenYear ,
		                    "calenMonth" => $EditcalenMonth);
 
			$Result = $this->models_GuideCalendar->_GetCalendarByMonth($Filter); //ดึงตารางเวลาที่ต้องการแก้ไข

			$this->load->view('Calendar/View_CalendarForms',array("ActionMode"=> $ActionMode,
																	"AddYear"   => $EditcalenYear,
																	"AddMonth"  => $EditcalenMonth,
																    "Result"    => $Result));
	}


    public function DeleteCalendar(){
		
		 //รับพารามิตเตอร์ที่ส่งมาจาก Ajax
		 $GuideId = $this->session->userdata("session_refid"); //รหัสมัคคุเทศก์
		 $DeletecalenYear = $this->input->post('calenYear'); //ปีที่ต้องการลบ
		 $DeletecalenMonth = $this->input->post('calenMonth'); //เดือนที่ต้องการลบ

		 $Condition = array("guide_id"   => $GuideId ,
							"CalenMonth" => $DeletecalenMonth,
							"CalenYear"  => $DeletecalenYear);
		  $this->models_GuideCalendar->Delete_Calendar($Condition);

	}

	
}
