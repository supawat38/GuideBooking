<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('main/models_main');
		$this->load->model('register/models_register');
	}

	public function index(){

		//โหลดข้อมูลจังหวัด
		$resultProvince = $this->models_register->LoadDataProvince();
		if($resultProvince['Code'] == '800' ){
			$arrayProvince = array();
		}else{
			$arrayProvince = $resultProvince;
		}

		//เตรียมข้อมูลส่งไปที่หน้า view
		$aPackData = array(
			'pageName' 		=> 'main',
			'dataprovince' 	=> $arrayProvince,
			'guidepoppular'	=> $this->models_main->LoadDataguidePoppular()
		);

		$this->load->view('header',$aPackData);
		$this->load->view('main/body',$aPackData);
	}

	//อัพโหลดรูปภาพ
	public function Uploadimage(){
		$tPath = $this->input->post('path');

		if($_FILES['file']['name']!=''){
			if(!is_dir('./application/assets/'.$tPath)){
				mkdir('./application/assets/'.$tPath);
			}
			$tCaracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
			$tQuantidadeCaracteres = strlen($tCaracteres);
			$tHash=NULL;
			for($x=1;$x<=10;$x++){
				$tPosicao = rand(0,$tQuantidadeCaracteres);
				$tHash .= substr($tCaracteres,$tPosicao,1);
			}
			$tFilename = 'Img'.$tHash.date('Ymd');
			$aConfig = array(
				'file_name'     => $tFilename,
				'allowed_types' => '*',
				'upload_path'   => './application/assets/'.$tPath,
				'max_size'      => '1000000',
				'max_width'     => '1024000',
				'max_height'    => '768000',
			);

			$this->load->library('upload');
			$this->upload->initialize($aConfig);
			
			if(!$this->upload->do_upload('file')){
				$aData = array('error' => $this->upload->display_errors());
			}else{
				$aData = array('upload_data' => $this->upload->data());
				if(!empty($aData['upload_data']['file_name'])){
					$aImageData = $aData['upload_data'];
					$tStaResize = $this->ImgResize($aImageData);
					if($tStaResize == "done"){
						$tPath     = $aImageData['full_path'];
						$raImageData = array(
							'tImgName'     => $aImageData['file_name'],
							'tImgType'     => $aImageData['image_type'],
							'tImgFullPath' => $aImageData['full_path']
						);
					}
				}
				echo json_encode($raImageData);
			}
		}
	}

	//ย่อขนาดรูปภาพ
	public function ImgResize($ImgUL=null){
        $this->load->library('image_lib');
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $ImgUL['full_path'];
        $config['create_thumb'] 	= FALSE;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			= 600;
        $config['height'] 			= 600;
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()){
            return $this->image_lib->display_errors();
        } else{
            return "done";
        }
	}

	//โหลดข้อมูล package
	public function LoadtablePackage(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 3
		);

		$result = $this->models_main->LoadDatapackage($Condition);
		$PackData = array(
			'result'			=> $result,
			'Page'				=> $numberpage
		);
		$this->load->view('main/View_table_package',$PackData);
	}

	//โหลดข้อมูล รีวิวมัคคุเทศก์
	public function LoadtableReviewGuide(){
		$numberpage = $this->input->post('numberpage');
		$Condition = array(
			'page'  => $numberpage,
			'row'	=> 3
		);

		$result = $this->models_main->LoadDatareviewguide($Condition);
		$PackData = array(
			'result'			=> $result,
			'Page'				=> $numberpage
		);
		$this->load->view('main/View_table_reviewguide',$PackData);
	}
}
