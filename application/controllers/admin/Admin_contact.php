<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_contact extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->checkAdmin())
		{
			redirect('admin/login');
			exit();
		}
		$this->_data['site_info'] = $this->Site_model->get('admin');
		$this->_data['title'] = 'Quản lý liên hệ';
		$this->_data['name'] = 'Liên hệ';
		$this->load->Model('Contact_model');
	}
	public function index($page = 1)
	{
		$status = 'all';
 		if($this->input->get())
 		{
 			$arrGet = $this->input->get();
			if(isset($arrGet['select']))
			{
 				$status = $arrGet['select'];
			}
			if(isset($arrGet['per_page']))
			{
 				$page = $arrGet['per_page'];
			}
 		}
		$rows_page = $this->_data['site_info']['site_num_page']; // Số dòng / trang
		$total_rows = $this->_data['count'] = $this->Contact_model->NumRow($status); // Tổng số dòng
		if($total_rows > 0)
		{
			$maxpage = ceil($total_rows / $rows_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->_data['arrContact'] = $this->Contact_model->show($page, $rows_page, $status);
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 3;
			$config['base_url'] = base_url('admin/admin_contact/index');
			if(isset($arrGet['select']))
			{
				$config['base_url'] = base_url('admin/admin_contact/index?select='.$status);
			}
			
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rows_page;
			
			$this->pagination->initialize($config);
		}
		if($this->input->post('apdung'))
		{
			$arrInput = $this->input->post();
			if($arrInput['tacvu'] == 'delete')
			{
				$arrID = $arrInput['checklist'];
				$result = $this->Contact_model->delAll($arrID); // Thực thi xóa
				if($result){
					$this->session->set_flashdata('flash_ss', 'Đã xóa các mục đã chọn');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi xóa các mục này');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}
			}
			if($arrInput['tacvu'] == 'read')
			{
				$arrID = $arrInput['checklist'];
				$arrUpdate = array('status' => 1);
				$result = $this->Contact_model->updateAll($arrID, $arrUpdate); // Thực thi cập nhật
				if($result)
				{
					$this->session->set_flashdata('flash_ss', 'Hoàn tất đánh dấu đã xem');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra đánh dấu các mục này');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}
			}
			if($arrInput['tacvu'] == 'unread')
			{
				$arrID = $arrInput['checklist'];
				$arrUpdate = array('status' => 0);
				$result = $this->Contact_model->updateAll($arrID, $arrUpdate); // Thực thi cập nhật
				if($result)
				{
					$this->session->set_flashdata('flash_ss', 'Hoàn tất đánh dấu chưa xem');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra đánh dấu các mục này');
					redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
					exit();
				}
			}
		}
		
		$this->_data['title'] = "Liên hệ";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	
	public function view($id_contact)
	{
		$this->_data['arrContact'] = $this->Contact_model->detail($id_contact);
		// Kiểm tra tồn tại
		if(count($this->_data['arrContact']) <=0)
		{
			redirect('admin/admin_contact');
			exit();
		}
		$arrUpdate = array('status'=>1);
		$this->Contact_model->update($id_contact, $arrUpdate);
		$this->_data['title'] = "Chi tiết liên hệ";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function del($id_contact)
	{
		$arrContact = $this->Contact_model->detail($id_contact); // Lấy thông tin
		// Kiểm tra tồn tại
		if(count($arrContact) <=0){
			redirect('admin/admin_contact');
			exit();
		}
		$result = $this->Contact_model->del($id_contact);
		if($result)
		{
			$this->session->set_flashdata('flash_success', 'Đã xóa liên hệ');
			redirect('admin/admin_contact');
			exit();
		}else {
			$this->session->set_flashdata('flash_error', 'Lỗi xóa liên hệ');
			redirect('admin/admin_contact');
			exit();
		}
	}
}