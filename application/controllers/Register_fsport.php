<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 04/01/2017
 * Time: 8:46 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class Register_fsport extends AC_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->Model(array('User_model'));
    }
    public function index(){
        if($this->auth->checkLogged()){
            redirect(base_url());
            exit();
        }
        $this->load->helper('phpmailer');
        $this->load->helper('render_mail');


        if($this->input->post('btn_reg')){
            $this->_data['post_modal'] = $_POST;
        }
        $this->_data['arrCity'] = $this->User_model->get_city();
        $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
        if($this->input->post('btn_send')){
            if($this->form_validation->run('register') == true){
                $arrInput = $this->input->post();
                $arrInsert['userName'] 		= strtolower(trim($arrInput['reg_username']));
                $arrInsert['userPass'] 		= md5(trim($arrInput['reg_pass']));
                $arrInsert['userEmail'] 	= strtolower(trim($arrInput['reg_email']));
                $arrInsert['userPhone'] 	= $arrInput['reg_phone'];
                $arrInsert['userFullName'] 	= trim(ucwords($arrInput['reg_name']));
                $arrInsert['userAddress'] 	= trim($arrInput['reg_address']);
                $arrInsert['userDistrict'] 	= trim(ucwords($arrInput['reg_district']));
                $arrInsert['cityID'] 	    = trim($arrInput['reg_city']);
                $arrInsert['userLevel'] 	= 3;
                $arrInsert['createDate'] 	= date('Y-m-d');

                // Xử lý đăng ký
                $result = $this->User_model->reg_member($arrInsert);
                if($result){
                    // Xử lý gửi mail xác nhận
                    $title = 'Xác nhận đăng ký thành viên';
                    $content = render_mail(md5($arrInsert['userEmail'].'/0'));
                    $nTo = $arrInsert['userFullName'];
                    $mTo = $arrInsert['userEmail'];
                    $mail = phpmailer($title, $content, $nTo, $mTo);
                    if($mail){
                        $this->auth->setLogin($result);
                        $this->session->set_flashdata('fl_ss',true);
                        redirect(base_url('register/success'));
                        exit();
                    }
                }

            }
        }
        $this->load->view('layout/public/layout', $this->_data);
    }
    public function success(){

        if(!$this->session->flashdata('fl_ss')){
            redirect(base_url());
            exit();
        }
        $this->_data['email'] = $this->auth->getInfo()['userEmail'];

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function verify_email($verify_code = ""){
        if($verify_code == ""){
            redirect(base_url());
            exit();
        }
        $result = $this->User_model->verify_email($this->auth->getInfo()['userName'], $verify_code);
        if($result){
            $this->_data['message'] = 1;
        }else{
            $this->_data['message'] = 0;
        }

        $this->load->view('layout/public/layout', $this->_data);
    }


    public function check_username(){
        if(!isset($_POST['username'])){
            redirect(base_url());
            exit();
        }
        $user = $_POST['username'];
        if($this->User_model->a_ckUser($user)){
            echo "false";
        }else{
            echo "true";
        }
    }
    public function check_email(){
        if(!isset($_POST['email'])){
            redirect(base_url());
            exit();
        }
        $email = $_POST['email'];
        if($this->User_model->a_ckEmail($email)){
            echo "false";
        }else{
            echo "true";
        }
    }

}