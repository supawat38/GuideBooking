<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$aPackData = array(
			'pageName' => 'main'
		);

		$this->load->view('header',$aPackData);
		$this->load->view('main/body',$aPackData);
		$this->load->view('footer',$aPackData);
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
	public function ImgResize($paImgUL=null){
        $this->load->library('image_lib');
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $paImgUL['full_path'];
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

 
}
