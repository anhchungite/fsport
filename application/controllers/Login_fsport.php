<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 04/01/2017
 * Time: 8:46 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class Login_fsport extends AC_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->Model(array('User_model'));
        $this->load->library('facebook');
        $this->load->library('googleplus');
    }
//    public function index(){
//        if($this->auth->checkLogged()){
//            redirect(base_url());
//            exit();
//        }
//        redirect(base_url('login/login'));
//        exit();
//    }
    public function index(){
        if($this->auth->checkLogged()){
            redirect(base_url());
            exit();
        }
        if(isset($_POST['btn_login_modal'])){
            $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
            if($this->form_validation->run('member_login') == true){
                $id = $_POST['id'];
                $pass = md5($_POST['password']);
                $result = $this->User_model->ck_Login($id, $pass);
                if(count($result) > 0){
                    $this->auth->setLogin($result);
                    redirect($this->session->userdata['redirectURL']);
                    exit();
                }
                $this->_data['mg'] = "<p class='login_er'>Sai tài khoản hoặc mật khẩu</p>";
                $this->_data['id'] = $id;
            }
        }
        $this->load->view('layout/public/layout', $this->_data);
    }
    public function forgot_password(){
        if($this->input->post('btn_send')){
            $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
            $this->form_validation->set_rules('email','Email','required|valid_email', array('required'=>'Vui lòng nhập email','valid_email' => 'Địa chỉ email không hợp lệ'));
            if($this->form_validation->run() == true){
                $email = $this->input->post()['email'];
                $result = $this->User_model->a_ckEmail($email);
                if($result){
                    $this->load->helper('phpmailer');
                    $this->load->helper('render_v_code');
                    $arr_code = render_v_code($email);
                    $this->session->set_tempdata($arr_code, Null, 300);

                    $title = "Xác nhận yêu cầu mật khẩu";
                    $content = "Ai đó đã yêu cầu đổi mật khẩu cho địa chỉ email này, nếu đó là bạn hãy click vào link bên dưới<br/><a href='".base_url('login/reset-password')."/{$this->session->tempdata('v_code')['code']}'>".base_url('login/reset-password')."/{$this->session->tempdata('v_code')['code']}</a><br/>Ngược lại, hãy bỏ qua email này.<br/>Thanks!";
                    $sendmail = phpmailer($title, $content, "", $email);
                    if($sendmail){
                        $this->session->set_flashdata('sm_ss',"Link xác nhận đã được gửi đến <a href='mailto:{$email}'>{$email}</a>, vui lòng kiểm tra hộp thư đến hoặc thư mục thư rác.<br/>* Lưu ý: link chỉ tồn tại trong 5 phút.</br>Thanks!");
                        redirect(base_url('login/success'));
                        exit();
                    }
                }else{
                    $this->_data['mg'] = '<ul class="form_error"><li>Địa chỉ email không tồn tại</li></ul>';
                }
            }

        }

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function reset_password($code=""){
        if($code == ""){
            redirect(base_url());
            exit();
        }
        if($code != $this->session->tempdata('v_code')['code']){
            $this->session->set_flashdata('rs_er',"Link xác thực đã hết hiệu lực, vui lòng gửi lại yêu cầu.</br>Thanks!");
            redirect(base_url('login/error'));
            exit();
        }
        if($this->input->post('btn_send')){
            $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
            $this->form_validation->set_rules('pass','Mật khẩu','required|min_length[6]');
            $this->form_validation->set_rules('repass','Xác nhận mật khẩu','required|matches[pass]');
            if($this->form_validation->run() == true){
                $email = $this->session->tempdata('v_code')['email'];
                $arrInput['userPass'] = md5(trim($this->input->post()['pass']));
                $result = $this->User_model->updateUser($email, $arrInput);
                if($result){
                    $this->session->set_flashdata('rs_ss',"Mật khẩu của bạn đã được thay đổi.</br>Thanks!");
                    redirect(base_url('login/success'));
                    exit();
                }
            }
        }
        $this->load->view('layout/public/layout', $this->_data);
    }
    public function success(){
        if(!$this->session->flashdata()){
            redirect(base_url());
            exit();
        }

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function error(){
        if(!$this->session->flashdata()){
            redirect(base_url());
            exit();
        }

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function facebook(){
        if($this->auth->checkLogged()){
            redirect(base_url());
            exit();
        }
        // LOGIN FB
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me?fields=name,email');
                $result = $this->User_model->getUser($user_profile['email']);
                if($result){
                    $this->auth->setLogin($result);
                    redirect($this->session->userdata('redirectURL'));
                    exit();
                }
                $arr_profile = array();
                $arr_profile['userFullName'] = $user_profile['name'];
                $arr_profile['userEmail'] = $user_profile['email'];
                $this->auth->setLogin($arr_profile);
                redirect(base_url());
                exit();
//                redirect(base_url('member/update-profile'));
//                exit();
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $fb_login_url = $this->facebook->getLoginUrl(
                array(
                    'redirect_uri' => base_url('login/facebook'),
                    'scope' => array("email") // permissions here
                )
            );
            redirect($fb_login_url);
            exit();
        }

    }
    public function google(){
        if($this->auth->checkLogged()){
            redirect(base_url());
            exit();
        }
        // LOGIN GG
        if ($this->input->get('code')) {

            $auth = $this->googleplus->getAuthenticate();
            if($auth){
                $user_profile = $this->googleplus->getUserInfo();
                $result = $this->User_model->getUser($user_profile['email']);
                if($result){
                    $this->auth->setLogin($result);
                    redirect($this->session->userdata('redirectURL'));
                    exit();
                }
                $arr_profile = array();
                $arr_profile['userFullName'] = $user_profile['name'];
                $arr_profile['userEmail'] = $user_profile['email'];
                $this->auth->setLogin($arr_profile);
                redirect(base_url());
                exit();
//                redirect(base_url('member/update-profile'));
//                exit();
            }
            redirect(base_url());
            exit();
        }else{
            $gg_login_url = $this->googleplus->loginURL();
            redirect($gg_login_url);
        }

    }
    public function logout(){
        if(!$this->auth->checkLogged()){
            redirect(base_url());
            exit();
        }
        $this->auth->setLogout();
        $this->facebook->destroySession();
        $this->googleplus->revokeToken();
        redirect(base_url());
        exit();
    }
}