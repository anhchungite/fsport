<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_file extends CI_Controller{
	protected $_data;
	public function __construct(){
		parent::__construct();
		if(!$this->auth->checkLogged()){
			redirect('admin/login');
			exit();
		}
		$this->_data['site_name'] = 'F4Sport Admin';
		$this->_data['title'] = 'Quản lý file';
		$this->_data['name'] = 'Tập tin';
	}
	public function index(){
		$this->load->view("layout/admin/layout", $this->_data);
	}
}