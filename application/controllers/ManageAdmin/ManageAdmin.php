<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAdmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ManageAdmin/models_admin');
	}

	//โหลดหน้าจอแรก
	public function index(){
		echo 'test';
		// $aPackData = array(
		// 	'pageName' 		=> 'ManageAdmin'
		// );

		// $this->load->view('header',$aPackData);
		// $this->load->view('ManageAdmin/view_adminTable',$aPackData);
	}	 

}
