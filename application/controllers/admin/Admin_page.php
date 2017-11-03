<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_page extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->checkAdmin())
		{
            $this->session->set_flashdata('flash_er', 'Access denied');
			redirect('admin');
			exit();
		}
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['title'] = 'Quản lý trang';
		$this->_data['name'] = 'Trang';
		$this->load->Model('Page_model');
	}
	public function index()
	{
		$this->_data['arrPage'] = $this->Page_model->get();
		$this->_data['title'] = "Quản lý trang";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function add()
	{
		if($this->input->post('btn_save'))
		{
			$arrInput = $this->input->post();
			$arrInsert['name_page']		= $arrInput['tieude'];
			$arrInsert['url_page']		= convertUrl($arrInput['tieude']);
			$arrInsert['detail_page']	= $arrInput['noidung'];
			$arrInsert['status_page']	= $arrInput['trangthai'];
			// Xử lý thêm mới trang
			$result = $this->Page_model->add($arrInsert);
			if($result)
			{
				$this->session->set_flashdata('flash_ss', 'Thêm trang thành công');
				redirect('admin/admin_page');
				exit();
			}
			$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi thêm trang');
		 }
		 if($this->input->post('btn_save_add'))
		 {
		 	$arrInput = $this->input->post();
		 	$arrInsert['name_page']		= $arrInput['tieude'];
		 	$arrInsert['url_page']		= convertUrl($arrInput['tieude']);
		 	$arrInsert['detail_page']	= $arrInput['noidung'];
		 	$arrInsert['status_page']	= $arrInput['trangthai'];
		 	// Xử lý thêm mới trang
		 	$result = $this->Page_model->add($arrInsert);
		 	if($result)
		 	{
		 		$this->session->set_flashdata('flash_ss', 'Thêm trang thành công');
		 		redirect(uri_string());
		 		exit();
		 	}
		 	$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi thêm trang');
		 }
		$this->_data['title'] = "Thêm trang";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function edit($id_page)
	{
		$this->_data['arrPage'] = $this->Page_model->get_by_id($id_page);
		// Kiểm tra tồn tại
		if(count($this->_data['arrPage']) <= 0)
		{
			redirect('admin/admin_page');
			exit();
		}
		// Xử lý sự kiện button editPage
		if($this->input->post('btn_save'))
		{
			$arrUpdate = array();
			$arrInput = $this->input->post();
			$arrUpdate['name_page']		= $arrInput['tieude'];
			$arrUpdate['url_page']		= convertUrl($arrInput['tieude']);
			$arrUpdate['detail_page']	= $arrInput['noidung'];
			$arrUpdate['status_page']	= $arrInput['trangthai'];
			// Xử lý thêm mới trang
			$result = $this->Page_model->edit($id_page, $arrUpdate);
			if($result)
			{
				$this->session->set_flashdata('flash_ss', 'Sửa trang thành công');
				redirect('admin/admin_page');
				exit();
			}
			$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi sửa trang');
		}
		if($this->input->post('btn_save_add'))
		{
			$arrUpdate = array();
			$arrInput = $this->input->post();
			$arrUpdate['name_page']		= $arrInput['tieude'];
			$arrUpdate['url_page']		= convertUrl($arrInput['tieude']);
			$arrUpdate['detail_page']	= $arrInput['noidung'];
			$arrUpdate['status_page']	= $arrInput['trangthai'];
			// Xử lý thêm mới trang
			$result = $this->Page_model->edit($id_page, $arrUpdate);
			if($result)
			{
				$this->session->set_flashdata('flash_ss', 'Sửa trang thành công');
				redirect('admin/admin_page/add');
				exit();
			}
			$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi sửa trang');
		}
		$this->_data['title'] = "Sửa trang";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function del($id_page)
	{
		$arrPage = $this->Page_model->get_by_id($id_page);
		// Kiểm tra tồn tại
		if(count($arrPage) <=0)
		{
			redirect('admin/admin_page');
			exit();
		}
		$result = $this->Page_model->del($id_page);
		if($result){
			$this->session->set_flashdata('flash_ss', 'Xóa trang thành công');
			redirect('admin/admin_page');
			exit();
		}
		$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi xóa trang');
	}
}