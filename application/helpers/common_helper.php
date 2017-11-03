<?php
/**
 * Created by PhpStorm.
 * User: Tran Anh Chung
 * Date: 6/17/2017
 * Time: 10:53 PM
 */

function current_full_url(){
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}
function get_order_status($id){
    $CI = & get_instance();
    $CI->load->Model('Order_model');
    $result = $CI->Order_model->getOrderStatus($id);
    if($result) return $result;
    return "---";
}
function get_city($id = '', $name = false){
    $id = (int)$id;
    $CI = & get_instance();
    $CI->load->Model('User_model');
    $result = $CI->User_model->get_city($id);
    if($result){
        if($name == true){
            return $result['cityName'];
        }
        return $result;
    }
}
function get_pay_method($id){
    switch ($id){
        case 'ck':
            return "Chuyển khoản";
            break;
        case 'cod':
            return "Thu tiền khi giao hàng";
            break;
        default:
            return "---";
    }
}
function pr_r($array, $die = false){
    if($die == true){
        echo '<pre>';
        print_r($array);
        echo '<pre>';die();
        return;
    }
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
function convert_vi_to_en($str)
{
    $characters = array(
        '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/' => 'a',
        '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/' => 'e',
        '/ì|í|ị|ỉ|ĩ/' => 'i',
        '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/' => 'o',
        '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/' => 'u',
        '/ỳ|ý|ỵ|ỷ|ỹ/' => 'y',
        '/đ/' => 'd',
        '/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/' => 'A',
        '/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/' => 'E',
        '/Ì|Í|Ị|Ỉ|Ĩ/' => 'I',
        '/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/' => 'O',
        '/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/' => 'U',
        '/Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'Y',
        '/Đ/' => 'D',
    );

    return preg_replace(array_keys($characters), array_values($characters), $str);
}
function convertUrl($text) {
        $text = str_replace(
	    array(' ','&quot;','%',"/"," - ",":",'<','>','?',"#","^","`","'","=","!",":",".","..","*","&","__","- "," -","  ",',','`','“','”','"','(',')'),
	    array(' ','','' ,''," "," "," ","","","",""," ",""," "," "," ","","","","",""," "," "," ",'','','','','','',''),
	    $text);
	   
	    $chars = array("a","A","e","E","o","O","u","U","i","I","d", "D","y","Y");
	   
	    $uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ", "ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ");
	    $uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ", "Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ");
	    $uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề" ,"ệ","ể","ễ");
	    $uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề" ,"Ệ","Ể","Ễ");
	    $uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ", "ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ");
	    $uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ", "Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ");
	    $uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ", "ự","ử","ữ");
	    $uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ", "Ự","Ử","Ữ");
	    $uni[8] = array("í","ì","ị","ỉ","ĩ");
	    $uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	    $uni[10] = array("đ");
	    $uni[11] = array("Đ");
	    $uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	    $uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");
	   
	    for($i=0; $i<=13; $i++) {
	        $text = str_replace($uni[$i],$chars[$i],$text);
	    }
	    
	    $text = str_replace(' ', '-', $text);
	    $text = strtolower($text);
	    
	    return $text;
    }
    
    function getUserInfo($fields = array(), $mode = 'all', $where = array(), $or_where = array()){
        $CI->load->Model('User_model');
        $CI = & get_instance();
        return $CI->User_model->getUserInfo($fields, $mode, $where, $or_where);
    }