<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_tag extends CI_Controller
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
		$this->_data['title'] = 'Quản lý tag';
		$this->_data['name'] = 'Thẻ';
		$this->load->Model('Tag_model');
        $this->output->enable_profiler(TRUE);
	}
    // PHƯƠNG THỨC INDEX
	public function index($page = 1)
	{
		//echo base_url().ltrim($_SERVER['REQUEST_URI'], '/');die();
		$keyword = "";
		if($this->input->get()){
			$arrGet = $this->input->get();
			if(isset($arrGet['btn_search'])){
				$keyword = $arrGet['search'];
			}
			if(isset($arrGet['per_page'])){
				$page = $arrGet['per_page'];
			}
		}
		$rows_page = $this->_data['site_info']['site_num_page']; // Số dòng / trang
		$total_rows = $this->_data['count'] = $this->Tag_model->num_rows($keyword); // Tổng số dòng
		if($total_rows > 0)
		{
			$maxpage = ceil($total_rows / $rows_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->_data['arrTag'] = $this->Tag_model->show($page, $rows_page, $keyword);
		
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 2;
			$config['base_url'] = base_url('admin/admin_tag/index');
			if(isset($arrGet['btn_search'])){
				$config['base_url'] = base_url('admin/admin_tag/index?search='.$keyword.'&btn_search=Tìm+kiếm');
			}
		
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rows_page;
		
			$this->pagination->initialize($config);
		}
		if($this->input->post('btn_apdung'))
		{
			$arr_id = $this->input->post('ck_item');
			$tacvu = $this->input->post('tacvu');
			if ($tacvu == 'delete'){
				$result = $this->Tag_model->del_all($arr_id);
				if($result){
					$this->session->set_flashdata('flash_ss','Xóa các tag đã chọn thành công');
					redirect('admin/admin_tag');
					exit();
				}
				$this->session->set_flashdata('flash_er','Lỗi xóa tag đã chọn');
			}
		}
		// Load view
		$this->load->view("layout/admin/layout", $this->_data);
	}
    // PHƯƠNG THỨC THÊM TAG
	public function add()
	{
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        $this->form_validation->set_rules('name','Tên Tag','trim|required|callback_check_tag_exist['.$this->input->post('name').']');
        $this->form_validation->set_rules('des','Tên Mô tả','trim');
        if($this->form_validation->run()){
            if($this->input->post('btn_save'))
            {
                $arrInsert['tagName'] 		= $this->input->post('name');
                $arrInsert['tagURL'] 		= convertUrl($this->input->post('name'));
                $arrInsert['tagDes'] 	= $this->input->post('des');
                $result = $this->Tag_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm tag thành công');
                    redirect('admin/admin_tag');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi khi thêm tag');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrInsert['tagName'] 		= $this->input->post('name');
                $arrInsert['tagURL'] 		= convertUrl($this->input->post('name'));
                $arrInsert['tagDes'] 	= $this->input->post('des');
                $result = $this->Tag_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm tag thành công');
                    redirect(uri_string());
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi khi thêm tag');
            }
        }

		// Load view
		$this->_data['title'] = 'Thêm tag';
		$this->load->view("layout/admin/layout", $this->_data);
	}
	// PHƯƠNG THỨC SỬA TAG
	public function edit($id)
	{
		$arr_tag = $this->Tag_model->get_by_id($id);
		if(count($arr_tag) <= 0){
			redirect('Error_404');
			exit();
		}
		$this->_data['arrTag'] = $this->Tag_model->get_by_id($id);
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        $this->form_validation->set_rules('name','Tên Tag','trim|required|callback_check_tag_exist['.$id.']');
        $this->form_validation->set_rules('des','Tên Mô tả','trim');
        if($this->form_validation->run()){
            if($this->input->post('btn_save'))
            {
                $arrUpdate['tagName'] 		= $this->input->post('name');
                $arrUpdate['tagURL'] 		= convertUrl($this->input->post('name'));
                $arrUpdate['tagDes'] 		= $this->input->post('des');
                $result = $this->Tag_model->edit($id, $arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa tag thành công');
                    redirect('admin/admin_tag');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi khi sửa tag');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrUpdate['tagName'] 		= $this->input->post('name');
                $arrUpdate['tagURL'] 		= convertUrl($this->input->post('name'));
                $arrUpdate['tagDes'] 		= $this->input->post('des');
                $result = $this->Tag_model->edit($id, $arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa tag thành công');
                    redirect('admin/admin_tag/add');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi khi sửa tag');
            }
        }


		// Load view
		$this->_data['title'] = 'Sửa tag';
		$this->load->view("layout/admin/layout", $this->_data);
	}
    // PHƯƠNG THỨC XÓA TAG
	public function del($id)
	{
		$arr_tag = $this->Tag_model->get_by_id($id);
		if(count($arr_tag) <= 0){
			redirect('Error_404');
			exit();
		}
		
		$result = $this->Tag_model->del($id);
		if($result){
			$this->session->set_flashdata('flash_ss','Xóa tag thành công');
			redirect('admin/admin_tag');
			exit();
		}
		$this->session->set_flashdata('flash_er','Lỗi xóa tag');

	}
	// CALLBACK
    // Kiểm tra trùng lặp tag
    public function check_tag_exist($name,$id){
        if($this->Tag_model->check_tag_exist($name, $id)){
            $this->form_validation->set_message('check_tag_exist','%s đã tồn tại');
            return false;
        }else{
            return true;
        }
    }
}
