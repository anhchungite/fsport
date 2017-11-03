<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_cat extends CI_Controller
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
		$this->_data['site_setting'] = $this->Site_model->get('admin');
		$this->_data['name'] = 'Danh mục';
		$this->_data['title'] = 'Quản lý danh mục';
		$this->load->Model('Cat_model');
	}

	public function index($page = 1)
	{
        //$this->output->enable_profiler(TRUE);
		$this->_data['count'] = $total_rows = $this->Cat_model->num_rows(); // Tổng số dòng

		$this->_data['arr_all_cat'] = $this->Cat_model->get();

		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function add()
	{
		$this->_data['arr_all_cat'] = $this->Cat_model->get();
        $this->form_validation->set_error_delimiters("<ul class='form_error'><li>", "</li></ul>");
        if($this->form_validation->run("admin_cat")){
            if($this->input->post('btn_save'))
            {
                $arrInsert['categoryName'] 		= $this->input->post('name');
                $arrInsert['categoryURL'] 			= convertUrl($this->input->post('name'));
                $arrInsert['categoryImage'] 		= $this->input->post('image');
                $arrInsert['categoryDescription'] 	= $this->input->post('des');
                $arrInsert['categorySortOrder'] 	= $this->input->post('sort');
                $arrInsert['parentCategoryID'] 	= $this->input->post('parent');
                $result = $this->Cat_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm danh mục thành công');
                    redirect('admin/admin_cat');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi thêm danh mục');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrInsert['categoryName'] 		= $this->input->post('name');
                $arrInsert['categoryURL'] 			= convertUrl($this->input->post('name'));
                $arrInsert['categoryImage'] 		= $this->input->post('image');
                $arrInsert['categoryDescription'] 	= $this->input->post('des');
                $arrInsert['categorySortOrder'] 	= $this->input->post('sort');
                $arrInsert['parentCategoryID'] 	= $this->input->post('parent');
                $result = $this->Cat_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm danh mục thành công');
                    redirect(uri_string());
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi thêm danh mục');
            }
        }

		$this->_data['title'] = 'Thêm danh mục';
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function edit($id)
	{
		$arr_cat = $this->Cat_model->get_by_id($id);
		if(count($arr_cat) <= 0){
			redirect('admin');
			exit();
		}
        $this->_data['arr_all_cat'] = $this->Cat_model->get();
		$this->_data['arr_cat'] = $this->Cat_model->get_by_id($id);

        $this->form_validation->set_error_delimiters("<ul class='form_error'><li>", "</li></ul>");
        $this->form_validation->set_rules('name','Tên Danh mục','required|trim|prep_for_form|max_length[200]|callback_check_exist_cat['.$id.']');
        $this->form_validation->set_rules('image','Hình ảnh','required|trim|prep_for_form|max_length[200]');
        $this->form_validation->set_rules('des','Mô tả','trim|prep_for_form|max_length[200]');
        if($this->form_validation->run()){
            if($this->input->post('btn_save'))
            {
                $arrUpdate['categoryName'] 		= $this->input->post('name');
                $arrUpdate['categoryURL'] 			= convertUrl($this->input->post('name'));
                if($this->input->post('image') != '')
                {
                    $arrUpdate['categoryImage'] 		= $this->input->post('image');
                }
                $arrUpdate['categoryDescription'] 	= $this->input->post('des');
                $arrUpdate['categorySortOrder'] 	= $this->input->post('sort');
                $arrUpdate['parentCategoryID'] 	= $this->input->post('parent');
                $result = $this->Cat_model->edit($id, $arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa danh mục thành công');
                    redirect('admin/admin_cat');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi sửa danh mục');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrUpdate['categoryName'] 		= $this->input->post('name');
                $arrUpdate['categoryURL'] 			= convertUrl($this->input->post('name'));
                if($this->input->post('image') != '')
                {
                    $arrUpdate['categoryImage'] 		= $this->input->post('image');
                }
                $arrUpdate['categoryDescription'] 	= $this->input->post('des');
                $arrUpdate['categorySortOrder'] 	= $this->input->post('sort');
                $arrUpdate['parentCategoryID'] 	= $this->input->post('parent');
                $result = $this->Cat_model->edit($id, $arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa danh mục thành công');
                    redirect('admin/admin_cat/add');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi sửa danh mục');
            }
        }

		$this->_data['title'] = 'Sửa danh mục';
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function del($id)
	{
		$arr_cat = $this->Cat_model->get_by_id($id);
		if(count($arr_cat) <= 0){
			redirect('admin');
			exit();
		}
        $parent = $this->Cat_model->get_parent($id);
		$result = $this->Cat_model->update_child($id, $parent);
		if($result)
		{
			$result = $this->Cat_model->del($id);
			if($result)
			{
				$this->session->set_flashdata('flash_ss','Xóa danh mục thành công');
				redirect('admin/admin_cat');
				exit();
			}
			$this->session->set_flashdata('flash_er','Có lỗi xảy ra khi xóa danh mục');
		}
		$this->session->set_flashdata('flash_er','Có lỗi xảy ra khi xóa danh mục');
	}
     // CALLBACK kiểm tra tồn tại danh mục
    public function check_exist_cat($name, $id_cat){
        $result = $this->Cat_model->check_exist_cat($name, $id_cat);
        if($result){
            $this->form_validation->set_message('check_exist_cat', '%s đã tồn tại');
            return false;
        }
        return true;
    }
}