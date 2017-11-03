<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_brand extends CI_Controller
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
		$this->_data['name'] = 'Thương hiệu';
		$this->_data['title'] = 'Quản lý thương hiệu';
		$this->load->Model('Brand_model');
	}
	public function index($page = 1)
	{
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
		$total_rows = $this->_data['count'] = $this->Brand_model->num_rows($keyword); // Tổng số dòng
		if($total_rows > 0)
		{
			$maxpage = ceil($total_rows / $rows_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->_data['arrBrand'] = $this->Brand_model->show($page, $rows_page, $keyword);
			
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 3;
			$config['base_url'] = base_url('admin/admin_brand/index');
            if(isset($arrGet['btn_search'])){
                $config['base_url'] = base_url('admin/admin_brand/index?search='.$keyword.'&btn_search=Tìm+kiếm');
            }
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rows_page;
		
			$this->pagination->initialize($config);
		}
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function add()
	{
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        $this->form_validation->set_rules('name','Tên Thương Hiệu','trim|required');
        $this->form_validation->set_rules('logo', 'Logo','trim|required');
		if($this->form_validation->run()){
            if($this->input->post('btn_save'))
            {
                $arrInsert['brandName'] = $this->input->post()['name'];
                $arrInsert['brandURL'] 	= convertUrl($this->input->post()['name']);
                $arrInsert['brandLogo'] = $this->input->post()['logo'];
                $result = $this->Brand_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm thương hiệu thành công');
                    redirect('admin/admin_brand');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi thêm thương hiệu');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrInsert['brandName'] = $this->input->post()['name'];
                $arrInsert['brandURL'] 	= convertUrl($this->input->post()['name']);
                $arrInsert['brandLogo'] = $this->input->post()['logo'];
                $result = $this->Brand_model->add($arrInsert);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Thêm thương hiệu thành công');
                    redirect(uri_string());
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi thêm thương hiệu');
            }
        }
		$this->_data['title'] = 'Thêm thương hiệu';
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function edit($id)
	{
		$arr_brand = $this->Brand_model->get_by_id($id);

		if(count($arr_brand) <= 0){
			redirect('Error_404');
			exit();
		}
		$this->_data['arrBrand'] = $this->Brand_model->get_by_id($id);
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        $this->form_validation->set_rules('name','Tên Thương Hiệu','trim|required');
        $this->form_validation->set_rules('logo', 'Logo','trim|required');
        if($this->form_validation->run()){
            if($this->input->post('btn_save'))
            {
                $arrUpdate['brandName'] = $this->input->post()['name'];
                $arrUpdate['brandURL'] = convertUrl($this->input->post()['name']);
                if($this->input->post()['logo'] != '')
                {
                    $arrUpdate['brandLogo'] = $this->input->post()['logo'];
                }

                $result = $this->Brand_model->edit($id,$arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa thương hiệu thành công');
                    redirect('admin/admin_brand');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi sửa thương hiệu');
            }
            if($this->input->post('btn_save_add'))
            {
                $arrUpdate['brandName'] = $this->input->post()['name'];
                $arrUpdate['brandURL'] = convertUrl($this->input->post()['name']);
                if($this->input->post()['logo'] != '')
                {
                    $arrUpdate['brandLogo'] = $this->input->post()['logo'];
                }
                $result = $this->Brand_model->edit($id,$arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss','Sửa thương hiệu thành công');
                    redirect('admin/admin_brand/add');
                    exit();
                }
                $this->session->set_flashdata('flash_er','Có lỗi xảy ra khi sửa thương hiệu');
            }
        }


		$this->_data['title'] = 'Sửa thương hiệu';
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function del($id)
	{
		$arr_brand = $this->Brand_model->get_by_id($id);
		if(count($arr_brand) <= 0){
			redirect('Error_404');
			exit();
		}
		$result = $this->Brand_model->del($id);
		if($result)
		{
			$this->session->set_flashdata('flash_ss','Xóa thương hiệu thành công');
			redirect('admin/admin_brand');
			exit();
		}
	}
}