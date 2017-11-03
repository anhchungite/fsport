<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 15/03/2017
 * Time: 10:27 CH
 */
function calc_shipping($total, $id_city){
    if($total >= 5000000){
        return 0;
    }
    if($total >= 3000000){
        return 1.5 * $total / 100;
    }
    if($total >= 1500000){
        return 2 * $total / 100;
    }
    if($total < 1500000){
        $CI = & get_instance();
        $CI->load->Model('User_model');
        $result = $CI->User_model->get_city($id_city);
        if($result) return $result['cost'];
    }

}