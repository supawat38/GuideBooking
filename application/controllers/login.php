<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//เรียกใช้งานส่วน query
		$this->load->model('login/models_login');
	}

	//ตรวจสอบข้อมูลเข้าสู่ระบบ
	public function checklogin(){
		$CheckLogin = array(
			'username' 		=> $this->input->post('username'),
			'password'		=> md5($this->input->post('password'))
		);
		$Result = $this->models_login->ChecLogin($CheckLogin);
		if($Result['Code'] == '800'){
			echo $Result['Desc'];
		}else{
			//ถ้าผ่านกำหนด session ให้
			$Username 		= $Result['Items'][0]['username'];
			$login_type 	= $Result['Items'][0]['login_type'];
			$reflogin_id 	= $Result['Items'][0]['reflogin_id'];

			if($login_type == 1){ //ผู้ดูแลระบบ
				$name 		= $Result['Items'][0]['Adminfirstname'];
			}else if($login_type == 2){ //ลูกค้า
				$name 		= $Result['Items'][0]['Customerfirstname'];
			}else if($login_type == 3){ //มัคคุเทศก์
				$name 		= $Result['Items'][0]['Guidefirstname'];
			}else if($login_type == 0){ //เจ้าของ
				$name 		= 'เจ้าของระบบ';
			}

			//กรณีที่ login ได้แต่ acount นั้นไม่ใช้งานจะขึ้นว่าไม่พบข้อมูล
			if($name == '' || $name == null){
				echo 'notfound';
			}else{
				$this->session->set_userdata("session_username",$Username);	
				$this->session->set_userdata("session_reftype",$login_type);	
				$this->session->set_userdata("session_refid",$reflogin_id);
				$this->session->set_userdata("session_name",$name);	
			}
		}
	}

	//ออกจากระบบ
	public function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
