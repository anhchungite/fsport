<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_user extends CI_Controller
{
	protected $_data;
	public function __construct()
	{
        $this->_data['arr_level']    = array(1=>'admin','support','member');

        date_default_timezone_set('Asia/Ho_Chi_Minh');
		parent::__construct();
		if(!$this->auth->checkLogged())
		{
			redirect('admin/login');
			exit();
		}
		$this->_data['site_setting']   = $this->Site_model->get('admin');
		$this->_data['title']       = 'Quản lý người dùng';
		$this->_data['name']        = 'Người dùng';

		$this->load->Model('User_model');
	}
    // PHƯƠNG THỨC INDEX
	public function index($page = 1)
	{
		$filter_username		=	"";
		$filter_fullname		=	"";
		$filter_sex				=	"";
		$filter_birthday		=	"";
		$filter_level			=	"";
		$sort_by			    =	"";
		$sort_order			    =	"";
 		if($this->input->get())
 		{
 			$arrGet = $this->input->get();
			if(isset($arrGet['per_page']))
			{
 				$page = $arrGet['per_page'];
			}
			if(isset($arrGet['filter_fullname']))
			{
				$filter_fullname = $arrGet['filter_fullname'];
			}
			if(isset($arrGet['filter_sex']))
			{
				$filter_sex = $arrGet['filter_sex'];
			}
			if (isset($arrGet['filter_username']))
			{
				$filter_username = $arrGet['filter_username'];
			}

			if (isset($arrGet['filter_birthday']))
			{
				$filter_birthday = $arrGet['filter_birthday'];
			}
			if (isset($arrGet['filter_level']))
			{
                $filter_level = $arrGet['filter_level'];
			}
			if (isset($arrGet['sort_by']))
			{
                $sort_by = $arrGet['sort_by'];
			}
            if (isset($arrGet['sort_order']))
            {
                $sort_order = $arrGet['sort_order'];
            }

        }

        $this->_data['query_str'] = $query_str = $_SERVER['QUERY_STRING'];
        if(preg_match('/&per_page/', $_SERVER['QUERY_STRING'])){
            $pos = stripos($_SERVER['QUERY_STRING'], '&per_page'); // Loại bỏ query phân trang
            $query_str = substr($_SERVER['QUERY_STRING'], 0, $pos);
        };
		$rows_page = $this->_data['site_setting']['site_num_page']; // Số dòng / trang
        $this->_data['offset'] = $page * $rows_page - $rows_page;
		$total_rows = $this->_data['countUser'] = $this->User_model->num_rows($filter_birthday, $filter_fullname, $filter_level, $filter_sex, $filter_username);; // Tổng số dòng
		if($total_rows > 0)
		{

            // Kiểm tra số trang hợp lệ
            $this->_data['max_page'] = $maxpage = ceil($total_rows / $rows_page);
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->_data['arrUser'] = $this->User_model->get($page, $rows_page, $filter_birthday, $filter_fullname, $filter_level, $filter_sex, $filter_username);
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 2;
			$config['base_url'] = base_url("admin/admin_user/index?{$query_str}");

			$config['total_rows'] = $total_rows;
			$config['per_page'] = $rows_page;
		
			$this->pagination->initialize($config);
		}

		if($this->input->post('btn_apdung'))
		{
			$arr_id = $this->input->post('ck_item');
            $tacvu = $this->input->post('tacvu');
            if(isset($arr_id)){
                if ($tacvu == 'delete'){
                    $result = $this->User_model->del_all($arr_id);
                    if($result){
                        $this->session->set_flashdata('flash_ss','Xóa các mục đã chọn thành công');
                        redirect('admin/admin_user');
                        exit();
                    }
                    $this->session->set_flashdata('flash_er','Lỗi xóa các mục đã chọn');
                }
            }

		}
		$this->load->view("layout/admin/layout", $this->_data);
	}
    // PHƯƠNG THỨC XEM NGƯỜI DÙNG
	public function view($id_user){
        $this->_data['arr_user'] = $arr_user = $this->User_model->get_by_id($id_user);
        if(count($arr_user) < 0){
            $this->session->set_flashdata('flash_er', 'Access denied');
            redirect(base_url('admin/admin_user'));
            exit();
        }
        $this->_data['title'] = "Chi tiết";
        $this->load->view("layout/admin/layout", $this->_data);
    }
    // PHƯƠNG THỨC THÊM NGƯỜI DÙNG
	public function add(){
        if(!$this->auth->checkAdmin())
        {
            $this->session->set_flashdata('flash_er', 'Access denied');
            redirect(base_url('admin/admin_user'));
            exit();
        }
		if($this->input->post('btn_save_admin')){
		    // VALIDATION
		    $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			if($this->form_validation->run('admin_user') == true){
                $arrInput = $this->input->post();
                $arrInsert['userName'] 		= strtolower(trim($arrInput['username']));
                $arrInsert['userPass'] 		= md5(trim($arrInput['password']));
                $arrInsert['userEmail'] 	= strtolower(trim($arrInput['email']));
                $arrInsert['userFullName'] 	= trim(ucwords($arrInput['fullname']));
                $arrInsert['userLevel'] 	= $arrInput['quyen'];
                $arrInsert['createDate'] 	= date('Y-m-d');

				// Thực hiện thêm
				$result = $this->User_model->add($arrInsert);
				if($result){
					$this->session->set_flashdata('flash_ss', 'Thêm người dùng thành công');
					redirect(base_url('admin/admin_user'));
					exit();
				}
				$this->session->set_flashdata('flash_er', 'Có lỗi khi thêm người dùng');
			}
			
		}
		$this->_data['title'] = "Thêm người dùng";
		$this->load->view("layout/admin/layout", $this->_data);
	}
    // PHƯƠNG THỨC SỬA NGƯỜI DÙNG
	public function edit($id_user)
	{
		//$this->output->enable_profiler(true);
		if($this->input->post('btn_upload'))
		{
			// Xử lý upload hình
			$result_upload = $this->file_library->upload_file("hinhanh");
// 			echo '<pre>';
// 			print_r($result_upload);
// 			echo '</pre>';
			if(count($result_upload) <= 1)
			{
				$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi upload');
			}else {
				$arrUpdate['userAvatar'] = strtolower($result_upload['arrFile']['file_name']);
				// Xử lý update dữ liệu
				$result = $this->User_model->edit($id_user, $arrUpdate);
				if($result)
				{
					$this->session->set_flashdata('flash_ss', 'Upload avatar thành công');
					redirect(uri_string());
					exit();
				}else{
					$this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi upload avatar');
					redirect(base_url(uri_string()));
					exit();
				}
			}
			
		}
		$this->_data['arrCity'] = $this->User_model->get_city();
		// Lấy thông tin user theo id
		$arrData = $this->_data['arrUser'] = $this->User_model->get_by_id($id_user);
		if(count($arrData) <= 0 || !$this->auth->checkAdmin() && $this->auth->getInfo()['userID'] != $id_user || $this->auth->getInfo()['userID'] != 1 && $id_user == 1)
		{
			$this->session->set_flashdata('flash_er', 'Access denied');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		
		// Lấy thông tin đổ vào mảng khi nhấn nút submit
		if($this->input->post('btn_save_admin'))
		{
			// VALIDATION
			$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			$this->form_validation->set_rules('email','Email','required|trim|callback_regex_email['.$id_user.']');

			if($this->form_validation->run() == true)
			{
				$arrInput = $this->input->post();
				$arrUpdate['userEmail'] 	= strtolower(trim($arrInput['email']));
				$arrUpdate['userFullName'] 	= trim($arrInput['fullname']);
		    	$arrUpdate['userLevel'] 	= $arrInput['quyen'];
		    	$arrUpdate['userBirthday'] 	= $arrInput['ngaysinh'];
		    	$arrUpdate['userPhone'] 	= trim($arrInput['dienthoai']);
			    $arrUpdate['userSex'] 		= $arrInput['gioitinh'];
		    	$arrUpdate['userAddress'] 	= $arrInput['diachi'];
			    $arrUpdate['cityID'] 		= $arrInput['thanhpho'];

				// Thực hiện cập nhật
				$result = $this->User_model->edit($id_user, $arrUpdate);
				if($result){
					$this->session->set_flashdata('flash_ss', 'Sửa người dùng thành công');
					redirect(base_url('admin/admin_user'));
					exit();
				}
				$this->session->set_flashdata('flash_er', 'Có lỗi khi sửa người dùng');
			}
		}
		
		// Hiển thị title + view
		$this->_data['title'] = "Sửa người dùng";
		$this->load->view("layout/admin/layout", $this->_data);
	}
	public function change_password($id_user){
		// Kiểm tra tồn tại người dùng
		$arrData = $this->User_model->get_by_id($id_user);
		if(count($arrData) <= 0 || !$this->auth->checkAdmin() && $this->auth->getInfo()['userID'] != $id_user || $this->auth->getInfo()['userID'] != 1 && $id_user == 1)
		{
			$this->session->set_flashdata('flash_er', 'Access denied');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		// Chức năng đổi mật khẩu
		if($this->input->post('btn_save_admin')){
			$arrInput = $this->input->post();

			// VALIDATION
			$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			$this->form_validation->set_rules('old-password','Mật khẩu cũ','callback_regex_old_password['.$id_user.']|required|trim');
			$this->form_validation->set_rules('new-password','Mật khẩu mới','callback_regex_password|required|trim');
			$this->form_validation->set_rules('re-password','Xác nhận mật khẩu','required|trim|matches[new-password]');
			if($this->form_validation->run() == true)
			{
				// Kiểm tra trùng khớp mật khẩu cũ.
				$password = md5($arrInput['old-password']);
				$ckPass = $this->User_model->a_ckPass($password, $id_user);
				if(count($ckPass) > 0)
				{ // Nếu trùng khớp tiến hành đổi mật khẩu
					$arrUpdate['userPass'] = md5($arrInput['new-password']);
					$result = $this->User_model->change_pass($id_user, $arrUpdate);
					if($result)
					{
						$this->session->set_flashdata('flash_ss', 'Đổi mật khẩu thành công');
						redirect(base_url('admin/admin_user'));
						exit();
					}else{
						$this->session->set_flashdata('flash_er', 'Có lỗi khi đổi mật khẩu');
					}
				}else { // Ngược lại báo lỗi
					$this->session->set_flashdata('flash_er', 'Mật khẩu cũ không tồn tại');
				}
			}
				
		}
		// Hiển thị title + view
		$this->_data['title'] = "Đổi mật khẩu";
		$this->load->view("layout/admin/layout", $this->_data);
	}
    // PHƯƠNG THỨC XÓA NGƯỜI DÙNG
	public function del($id_user)
	{
		// Kiểm tra tồn tại người dùng
		$arrData = $this->User_model->get_by_id($id_user);
		if(count($arrData) <= 0 || !$this->auth->checkAdmin() || $this->auth->getInfo()['userID'] == $id_user || $id_user == 1)
		{
			$this->session->set_flashdata('flash_er', 'Access denied');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		// Thực hiện xóa
		$result = $this->User_model->del($id_user);
		if($result)
		{
			$this->session->set_flashdata('flash_ss', 'Xóa người dùng thành công');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		$this->session->set_flashdata('flash_er', 'Lỗi xóa người dùng');
	}
	
	// CAllBACK VALIDATION
	function regex_username($username)
	{
		if(preg_match('/^[a-z_][a-z0-9_\.\s]{2,31}$/', $username) == true)
		{
			if($this->User_model->a_ckUser($username) == true)
			{
				$this->form_validation->set_message('regex_username','%s đã tồn tại');
				return false;
			}else {
				return true;
			}
		}else {
			$this->form_validation->set_message('regex_username', '%s phải bắt đầu bằng 1 ký tự <li> Chỉ chứa chữ, số, dấu chấm (.), dấu gạch dưới (_)</li><li>Độ dài từ 3 - 32 ký tự</li>');
			return false;
		}
	}
	function regex_password($password)
	{
		if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{6,}$/', $password) == true)
		{
			return true;
		}else {
			$this->form_validation->set_message('regex_password', '%s phải tối thiểu 6 ký tự<li>Chứa ít nhất 1 ký tự đặc biệt, 1 ký tự in hoa và 1 chữ số</li> ');
			return false;
		}
	}
	function regex_old_password($old_password,$id_user)
	{
		if($this->User_model->a_ckPass(md5($old_password), $id_user) == false)
		{
			$this->form_validation->set_message('regex_old_password', '%s không tồn tại');
			return false;
		}else {
			return true;
		}
	}
	function regex_email($email, $id_user)
	{
		if(preg_match('/^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/', $email) == true)
		{
			if($this->User_model->a_ckEmail($email, $id_user) == true){
				$this->form_validation->set_message('regex_email', '%s đã tồn tại');
				return false;
			}else {
				return true;
			}
		}else {
			$this->form_validation->set_message('regex_email', '%s không hợp lệ');
			return false;
		}
	}

}
