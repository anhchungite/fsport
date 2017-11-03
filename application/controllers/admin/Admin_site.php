<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_site extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->checkAdmin())
		{
			redirect('admin');
			exit();
		}
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['title'] = 'Cài đặt';
		$this->_data['name'] = 'Cài đặt';
	}
	public function index()
	{
		$this->_data['arr_site_admin'] = $this->Site_model->get('admin');
		$this->_data['arr_site_public'] = $this->Site_model->get('public');

		if($this->input->post('btn_save_admin'))
		{
			$arrUpdate['site_name'] = $this->input->post('name');
			$arrUpdate['site_title'] = $this->input->post('title');
			$arrUpdate['site_des'] = $this->input->post('des');
			if($this->input->post('logo') != '')
			{
				$arrUpdate['site_logo'] = $this->input->post('logo');
			}
			if($this->input->post('icon') != '')
			{
				$arrUpdate['site_favicon'] = $this->input->post('icon');
			}
			$arrUpdate['site_num_page'] = $this->input->post('rows_page');

			$result = $this->Site_model->edit('admin', $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_ss','Cập nhật thông tin trang quản trị thành công');
				redirect(uri_string());
				exit();
			}
			$this->session->set_flashdata('flash_er','Lỗi cập nhật thông tin trang quản trị');
			
		}
		if($this->input->post('btn_save_public'))
		{
			$arrUpdate['site_name'] = $this->input->post('name');
			$arrUpdate['site_title'] = $this->input->post('title');
			$arrUpdate['site_des'] = $this->input->post('des');
			$arrUpdate['site_key'] = $this->input->post('key');
			if($this->input->post('logo') != '')
			{
				$arrUpdate['site_logo'] = $this->input->post('logo');
			}
			if($this->input->post('icon') != '')
			{
				$arrUpdate['site_favicon'] = $this->input->post('icon');
			}
			$arrUpdate['site_num_page'] = $this->input->post('rows_page');

			$result = $this->Site_model->edit('public', $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_ss','Cập nhật thông tin trang public thành công');
				redirect(uri_string());
				exit();
			}
			$this->session->set_flashdata('flash_er','Lỗi cập nhật thông tin trang public');
				
		}
		$this->load->view("layout/admin/layout", $this->_data);
	}
}
