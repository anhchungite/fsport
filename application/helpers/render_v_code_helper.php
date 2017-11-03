<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 13/03/2017
 * Time: 11:58 SA
 */
function render_v_code($email=""){
    $CI = & get_instance();
    $data = array();
    $CI->load->library('encryption');
    $code = bin2hex($CI->encryption->create_key(16));
    $data['v_code'] = array('code'=>$code,'email'=> $email);
    return $data;
}