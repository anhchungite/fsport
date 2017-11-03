<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 18/03/2017
 * Time: 11:14 SA
 */
function tinh_tien($sl, $id_sp){
    $CI = & get_instance();
    $CI->load->Model('Product_model');
    $result = $CI->Product_model->get_by_id($id_sp);
    if($result){
        return $sl * $result['productPrice'];
    }
}
function discount_price($price, $discount){
    return $price - $discount * $price / 100;
}