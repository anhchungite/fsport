<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin_ckfinder extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->auth->checkLogged()){
			redirect('admin/login');
			exit();
		}
	}
	public function connector(){
		$is_admin = $this->auth->checkLogged();
// 		$username = $this->auth->getInfo()['username'];
		define('ACTIVE_CKFINDER', $is_admin);
// 		define('FOLDER_UPLOAD', "assets/upload/{$username}/");
		
		require_once './assets/templates/admin/lib/ckfinder/core/connector/php/connector.php';
	}
	public function index(){
		
		$this->load->view('admin/ckfinder/index');
	}
}