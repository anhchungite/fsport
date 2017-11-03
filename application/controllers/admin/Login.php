<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends AC_Controller {
	public function __construct(){
		parent::__construct();
		$this->_data['title'] = "Đăng nhập hệ thống";
		
	}

	public function index()
	{
		$this->load->model('User_model');
		$this->output->enable_profiler(true);
		if($this->form_validation->run('login'))
		{
			if($this->input->post('btn_login')){

				$arrInfo['userName'] = strtolower($this->input->post()['userName']);
				$arrInfo['userPass'] = md5($this->input->post()['userPass']);
				$arrResult = $this->User_model->ck_Auth($arrInfo);
				unset($arrResult['userPass']);
				if(count($arrResult) > 0){
					$this->auth->setLogin($arrResult);
					redirect('admin');
					exit();
				}
				$this->session->set_flashdata('flash_er','Sai tài khoản hoặc mật khẩu');
				//redirect('login');
				//exit();
			}
		}
		
		$this->load->view('layout/login/layout', $this->_data);
	}
	public function logout()
	{
		$this->auth->setLogout();
		redirect('admin/login');
		exit();
	}
	
}
