<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_index extends CI_Controller{
	protected $_data;
	public function __construct(){
		parent::__construct();
		if(!$this->auth->checklogged())
		{
			redirect('admin/login');
			exit();
		}
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['name'] = 'Tổng quan';
		$this->_data['title'] = 'Trang quản trị F4Sport';
		$this->load->Model(array('Product_model', 'User_model','Order_model','Counter_model'));
	}
	public function index(){

//		$this->_data['count_product'] = $this->Product_model->count();
//		$this->_data['count_user'] = $this->User_model->num_rows(2,'');
//
//		$arrMonth = range(1, 12);
//		$arrCount = array();
//		$year = date('Y');
//		foreach ($arrMonth as $month){
//			if($month < 10){
//				$month = '0'.$month;
//			}
//			$arrCount[$month] = array(
//					//'num_post'  => $this->News_model->get_post_by_month($month, $year),
//					'num_visit' => $this->Counter_model->get_access_by_month($month, $year)
//			);
//
//		}
//		$this->_data['count_visit'] = $arrCount;
		$this->load->view("layout/admin/layout", $this->_data);
	}
}