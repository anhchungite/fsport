<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 04/01/2017
 * Time: 8:46 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class Member_fsport extends AC_Controller{
    public function __construct()
    {
        parent:: __construct();
        if(!$this->session->userdata('user_profile')){
            redirect(base_url());
            exit();
        }
        $this->load->Model(array('User_model'));
        $this->_data['tdk'] = array(
            'title' => '',
            'keyword' => '',
            'description' => ''
        );
    }
    public function index(){
        //var_dump($this->session->userdata('user_profile'));
        $this->_data['tdk']['title'] = $this->session->userdata('user_profile')['userFullName'];
        $id = $this->session->userdata('user_profile')['userID'];
        $this->_data['arr_user_profile'] = $this->User_model->get_by_id($id);
        $this->load->view('layout/public/layout',$this->_data);
    }
    public function update_profile(){
        $this->_data['tdk']['title'] = 'Cập nhật thông tin cá nhân';
        $id = $this->session->userdata('user_profile')['userID'];
        $this->_data['arr_user_profile'] = $this->User_model->get_by_id($id);
        $this->_data['arrCity'] = $this->User_model->get_city();
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        
        if($this->input->post('btn_save'))
		{
            $this->form_validation->set_rules('email','Email','trim|required|callback_regex_email['.$id.']');
            $this->form_validation->set_rules('fullname','Họ và tên','required|trim');
            $this->form_validation->set_rules('dienthoai','Số điện thoại','trim|numeric');
            $this->form_validation->set_rules('diachi','Địa chỉ','trim');
            $this->form_validation->set_rules('ngaysinh','Ngày sinh','trim|callback_regex_date');
            $this->form_validation->set_rules('quanhuyen','Quận huyện','trim');
            $this->form_validation->set_rules('gioitinh','Giới tính','trim');
            $this->form_validation->set_rules('thanhpho','Thành phố','trim');
            if($this->form_validation->run() == TRUE){
                $arrInput = $this->input->post();
				$arrUpdate['userEmail'] 	= strtolower($arrInput['email']);
				$arrUpdate['userFullName'] 	= $arrInput['fullname'];
		    	$arrUpdate['userBirthday'] 	= $arrInput['ngaysinh'];
		    	$arrUpdate['userPhone'] 	= $arrInput['dienthoai'];
			    $arrUpdate['userSex'] 		= $arrInput['gioitinh'];
		    	$arrUpdate['userAddress'] 	= $arrInput['diachi'];
		    	$arrUpdate['userDistrict'] 	= $arrInput['quanhuyen'];
                $arrUpdate['cityID'] 		= $arrInput['thanhpho'];
                if($_FILES['hinhanh']['name'] != ''){
                    $result_upload = $this->file_library->upload_file("hinhanh");
                    if(count($result_upload) <= 1)
                    {
                        $this->session->set_flashdata('flash_er', 'Có lỗi xảy ra khi upload');
                        redirect(base_url(uri_string()));
                    }
                    $arrUpdate['userAvatar'] = strtolower($result_upload['arrFile']['file_name']);
                } 
				// Thực hiện cập nhật
				$result = $this->User_model->edit($id, $arrUpdate);
				if($result){
					$this->session->set_flashdata('flash_ss', 'Đã lưu thông tin');
					redirect(base_url(uri_string()));
				}
				$this->session->set_flashdata('flash_er', 'Có lỗi khi lưu thông tin');
            }
        }
        $this->load->view('layout/public/layout',$this->_data);
    }
    public function change_password(){
        $this->_data['tdk']['title'] = 'Thay mật khẩu';
        $id = $this->session->userdata('user_profile')['userID'];
        $this->_data['arr_user_profile'] = $this->User_model->get_by_id($id);

        if($this->input->post('btn_save')){
			$arrInput = $this->input->post();

			// VALIDATION
			$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			$this->form_validation->set_rules('matkhaucu','Mật khẩu cũ','callback_regex_old_password['.$id.']|required|trim');
			$this->form_validation->set_rules('matkhaumoi','Mật khẩu mới','required|trim');
			$this->form_validation->set_rules('xn_matkhaumoi','Xác nhận mật khẩu','required|trim|matches[matkhaumoi]');
			if($this->form_validation->run() == true)
			{
				$arrUpdate['userPass'] = md5($arrInput['matkhaumoi']);
                $result = $this->User_model->change_pass($id, $arrUpdate);
                if($result)
                {
                    $this->session->set_flashdata('flash_ss', 'Đổi mật khẩu thành công');
                    redirect(base_url('member/update-profile'));
                    exit();
                }else{
                    $this->session->set_flashdata('flash_er', 'Có lỗi khi đổi mật khẩu');
                }
			}
        }
        $this->load->view('layout/public/layout',$this->_data);
    }
    public function order_history(){
        $this->_data['tdk']['title'] = 'Lịch sử mua hàng';
		$this->load->Model(array('Order_model'));
        $id = $this->session->userdata('user_profile')['userID'];
        $this->_data['arrOrder'] = $this->Order_model->getOrderByUser($id);

        $this->load->view('layout/public/layout',$this->_data);

    }
    public function order_detail($order_id){
        $this->_data['tdk']['title'] = 'Chi tiết hóa đơn';
        $this->load->Model(array('Order_product_model', 'Order_model'));
        $id = $this->session->userdata('user_profile')['userID'];
        $this->_data['arrOrder'] = $this->Order_model->getOrder($order_id);
        if(!$this->_data['arrOrder']){
            redirect(base_url('order-history'));
        }
        if($this->_data['arrOrder']['userID'] != $id){
            redirect(base_url('order-history'));
        }
        $this->_data['arrOrderProduct'] = $this->Order_product_model->getOrderProduct($order_id);
        

        $this->load->view('layout/public/layout',$this->_data);

    }
    // CALLBACK
    public function file_valid()
    {
        if($_FILES['hinhanh']['name'] == ''){
            $this->form_validation->set_message('file_valid', 'Vui lòng chọn hình ảnh');
            return FALSE;
        }
        return TRUE;
    }
    public function regex_old_password($old_password,$id)
	{
		if($this->User_model->a_ckPass(md5($old_password), $id) == false)
		{
			$this->form_validation->set_message('regex_old_password', '%s không tồn tại');
			return false;
		}else {
			return true;
		}
	}
    public function regex_email($email, $id_user)
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
    public function regex_date($date){
        if(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $date) != TRUE){
            $this->form_validation->set_message('regex_date', '%s không hợp lệ');
			return false;
        }
        return TRUE;
    }
}