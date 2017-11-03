<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 07/03/2017
 * Time: 1:47 CH
 */

function attr(){
    $obj_json = file_get_contents('./assets/attr.json');
    return $obj_json;
}
function get_attr($id, $attr){
    $CI = & get_instance();
    $CI->load->model('Product_model');
    $result = $CI->Product_model->getAttr($id);
    if($result && $attr){
        if($attr == 'color'){
            return json_decode($result['productColor']);
        }
        if($attr == 'size'){
            $arrSize = json_decode($result['productSize']);
            unset($arrSize[0]);
            return $arrSize;
        }
    }
    return false;
}