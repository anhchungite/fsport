<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Ajax_review extends CI_Controller{
	protected $_data;
	public function __construct(){
		parent::__construct();
		$this->load->Model(array('Review_model','User_model'));
	}
	public function create(){
		if($this->input->post('btn_rate')){
			$arrResponse['error'] = array();
            if(!is_numeric($this->input->post('rscore'))){
				$arrResponse['error']['rscore'] = "Điểm rating phải là số!";
			}
			if($this->input->post('rscore') > 5){
				$arrResponse['error']['rscore'] = "Điểm rating tối đa là 5!";
			}
			if(!preg_match('/^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/', $this->input->post('remail'))){
				$arrResponse['error']['remail'] = "Địa chỉ email không hợp lệ!";
			}
			if(empty($this->input->post('rname'))){
				$arrResponse['error']['rname'] = "Vui lòng nhập tên của bạn!";
			}
			if(strlen($this->input->post('rname')) > 50){
				$arrResponse['error']['rname'] = "Họ và tên tối đa 50 ký tự!";
			}
			if(strlen($this->input->post('rtext')) > 500){
				$arrResponse['error']['rtext'] = "Nội dung tối đa 500 ký tự!";
			}
			if(strlen($this->input->post('rtext')) < 50){
				$arrResponse['error']['rtext'] = "Nội dung tối thiểu 50 ký tự!";
			}
			if(count($arrResponse['error']) > 0){
				echo json_encode($arrResponse);die();
			}
			$path = explode('-', $this->input->post('rproduct'));
			$id_product = substr(array_pop($path), 1);
            $arrInput = array(
                'productID' => $id_product,
                'reviewScore' => $this->input->post('rscore'),
                'reviewName' => $this->input->post('rname'),
                'reviewEmail' => $this->input->post('remail'),
                'reviewText' => $this->input->post('rtext'),
                'reviewIP' => $this->input->ip_address(),
                'reviewDate' => strtotime(date('Y-m-d H:i:s'))
			);
			if($this->auth->checkLogged()){
				$arrInput['member'] = 1;
				$arrInput['reviewName'] = $this->auth->getInfo()['userFullName'];
				$arrInput['reviewEmail'] = $this->auth->getInfo()['userEmail'];
			}
			if(!$this->Review_model->check_useragent($arrInput['productID'], $arrInput['reviewEmail'], $arrInput['reviewIP'])){
				$result = $this->Review_model->create($arrInput);
				if($result){
					$arrResponse['success'] = "Đánh giá của bạn đã được gửi để phê duyệt";
					echo json_encode($arrResponse);die();
				}
			}else{
				$arrResponse['success'] = "Bạn đã gửi đánh giá cho sản phẩm này!";
				echo json_encode($arrResponse);die();
			}
		}
		redirect(base_url());
	}
	public function update(){
		
	}
	public function delete(){
			
	}
}