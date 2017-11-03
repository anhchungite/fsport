<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Auth{
	protected $_session_name = "user_profile";
	
	public function setLogin($arrInfo)
	{
		$CI = & get_instance();
		$CI->session->set_userdata($this->_session_name, $arrInfo);
	}
	public function setLogout()
	{
		$CI = & get_instance();
		$CI->session->unset_userdata($this->_session_name);
	}
	public function getInfo()
	{
		$CI = & get_instance();
		return $CI->session->userdata($this->_session_name);
	}
	public function checkLogged()
	{
		$data = $this->getInfo();
		if($data){
			return true;
		}
		return false;
	}
	public function checkAdmin()
	{
		$data = $this->getInfo()['userLevel'];
		if($data == 1){
			return true;
		}
		return false;
	}
	public function checkVerify(){
        $data = $this->getInfo()['status'];
        if($data == 1){
            return true;
        }
        return false;

    }
}