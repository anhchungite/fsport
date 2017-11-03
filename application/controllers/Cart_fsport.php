<?php
/**
 * Created by PhpStorm.
 * User: teenq
 * Date: 04/01/2017
 * Time: 8:46 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class Cart_fsport extends AC_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->Model(array('User_model', 'Cart_model','Product_model'));
        $this->session->set_userdata('redirectURL', current_url());
        $this->load->library('unit_test');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file', 'key_prefix'=>'cart_'));

//        if (!$data = $this->cache->get('foo'))
//        {
//            echo 'Saving to the cache!<br />';
//            $data = array('foobarbaz!','otoke');
//            //$foo = 'foobarbaz! otoke';
//
//            // Save into the cache for 5 minutes
//            $this->cache->save('foo', $data, 300);
//        }
//        $this->cache->delete('iterator');
//        var_dump($data);
//        echo $this->unit->run(!$this->cache->get('foo'),TRUE);
//        var_dump($this->cache->cache_info());
//        var_dump($this->cache->get_metadata('foo'));
//        //var_dump($this -> cache -> increment ( 'iterator' , 3 ));


    }
    public function index(){
        //unset($_SESSION['cart']);



        if($this->input->post('itemCount') && $this->input->post('itemCount') > 0){
            $arr_product = array();
            for ($i = 1;$i <= $_POST['itemCount']; $i++){
                $arr_product[$i]['name'] = $_POST["item_name_{$i}"];
                $arr_product[$i]['quantity'] = $_POST["item_quantity_{$i}"];
                $arr_product[$i]['price'] = $_POST["item_price_{$i}"];
                $arr_opt = explode(",", $_POST["item_options_{$i}"]);
                foreach ($arr_opt as $value){
                    if(preg_match("/idsp/", $value)){
                        $idsp = explode(':', $value)[1];
                        $arr_product[$i]['id'] = trim($idsp);
                    }
                    if(preg_match("/color/", $value)){
                        $color = explode(':', $value)[1];
                        $arr_product[$i]['color'] = trim($color);
                    }
                    if(preg_match("/size/", $value)){
                        $size = explode(':', $value)[1];
                        $arr_product[$i]['size'] = trim($size);
                    }
                }
            }
            $_SESSION['cart']['product'] = $arr_product;
            redirect(base_url('cart/checkout'));
            exit();
        }

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function checkout()
    {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';

        $this->_data['arrCity'] = $this->User_model->get_city();
        if(!$this->session->userdata('cart')['product']){
            redirect(base_url('cart'));
            exit();
        }
        $this->_data['user_profile'] = $this->session->userdata('user_profile');
        if(isset($this->session->userdata('cart')['customer'])){
            $this->_data['customer'] = $this->session->userdata('cart')['customer'];
        }

        if($this->input->post('btn_checkout')){

            $arrInput = $this->input->post();

            $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
            unset($arrInput['btn_checkout']);
            if(!isset($arrInput['shipping_address'])){
                if($this->form_validation->run('checkout') == true){
                    $_SESSION['cart']['customer'] = $arrInput;
                    redirect(base_url('cart/order-info'));
                }
            }else{
                if($this->form_validation->run('checkout_pay') == true){

                    $_SESSION['cart']['customer'] = $arrInput;
                    redirect(base_url('cart/order-info'));
                }
            }


        }
//        echo '<pre>';
//        print_r($_SESSION);
//        echo '</pre>';
        $this->load->view('layout/public/layout', $this->_data);
    }
    public function order_info()
    {
//        echo '<pre>';
//        print_r($_SESSION['cart']);
//        echo '</pre>';
        if(!$this->session->userdata('cart')['customer']){
            redirect(base_url('cart'));
            exit();
        }
        $this->load->helper(array('calc_shipping','tinh_tien'));
        $arrOrder = array();
        $total = 0;
        foreach ($_SESSION['cart']['product'] as $key => $value){
            $arrOrder['product'][$key]['productID'] = $value['id'];
            $arrOrder['product'][$key]['productName'] = $value['name'];
            $arrOrder['product'][$key]['productQuantity'] = $value['quantity'];
            $result = $this->Product_model->get_by_id($value['id']);
            if(!$result){
                die();
            }
            $arrOrder['product'][$key]['productPrice'] = $result['productPrice'];
            $arrOrder['product'][$key]['productSize'] = $value['size'];
            $arrOrder['product'][$key]['productColor'] = $value['color'];
            $total += $result['productPrice'] * $value['quantity'];
        }
        $arrOrder['customer']['userID'] = $this->auth->getInfo()['userID'];
        if(isset($_SESSION['cart']['customer']['shipping_address'])){
            $arrOrder['customer']['payName']       = $arrOrder['customer']['shipName']      = $_SESSION['cart']['customer']['pay_name'];
            $arrOrder['customer']['payPhone']      = $arrOrder['customer']['shipPhone']     = $_SESSION['cart']['customer']['pay_telephone'];
            $arrOrder['customer']['payAddress']    = $arrOrder['customer']['shipAddress']   = $_SESSION['cart']['customer']['pay_address'];
            $arrOrder['customer']['payDistrict']   = $arrOrder['customer']['shipDistrict']  = $_SESSION['cart']['customer']['pay_district'];
            $arrOrder['customer']['payCity']       = $arrOrder['customer']['shipCity']      = $_SESSION['cart']['customer']['pay_city'];
            $arrOrder['customer']['payEmail']      = $_SESSION['cart']['customer']['pay_email'];
            $arrOrder['customer']['payMethod']     = $_SESSION['cart']['customer']['pay_method'];
            $arrOrder['customer']['orderNote']     = $_SESSION['cart']['customer']['order_note'];
            $arrOrder['customer']['total']    = $total;
            $arrOrder['customer']['cost']          =  calc_shipping($total,$arrOrder['customer']['shipCity']);
        }else{
            $arrOrder['customer']['payName']       = $_SESSION['cart']['customer']['pay_name'];
            $arrOrder['customer']['payPhone']      = $_SESSION['cart']['customer']['pay_telephone'];
            $arrOrder['customer']['payAddress']    = $_SESSION['cart']['customer']['pay_address'];
            $arrOrder['customer']['payDistrict']   = $_SESSION['cart']['customer']['pay_district'];
            $arrOrder['customer']['payCity']       = $_SESSION['cart']['customer']['pay_city'];
            $arrOrder['customer']['payEmail']      = $_SESSION['cart']['customer']['pay_email'];
            $arrOrder['customer']['payMethod']     = $_SESSION['cart']['customer']['pay_method'];
            $arrOrder['customer']['orderNote']     = $_SESSION['cart']['customer']['order_note'];
            $arrOrder['customer']['shipName']      = $_SESSION['cart']['customer']['ship_name'];
            $arrOrder['customer']['shipPhone']     = $_SESSION['cart']['customer']['ship_telephone'];
            $arrOrder['customer']['shipAddress']   = $_SESSION['cart']['customer']['ship_address'];
            $arrOrder['customer']['shipDistrict']  = $_SESSION['cart']['customer']['ship_district'];
            $arrOrder['customer']['shipCity']      = $_SESSION['cart']['customer']['ship_city'];
            $arrOrder['customer']['total']    = $total;
            $arrOrder['customer']['cost']          =  calc_shipping($total,$arrOrder['customer']['shipCity']);
        }
        $this->_data['arrProduct'] = $arrOrder['product'];
        $this->_data['arrCustomer'] = $arrOrder['customer'];
        $this->_data['payCity'] = $this->User_model->get_city($arrOrder['customer']['payCity']);
        $this->_data['shipCity'] = $this->User_model->get_city($arrOrder['customer']['shipCity']);

        if($this->input->post('btn_order_info')){
            $result = $this->Cart_model->addOrder($arrOrder['customer'], $arrOrder['product']);
            if($result){
                $this->session->unset_userdata('cart');
                $this->session->set_flashdata('thanks',1);
                redirect('cart/thankyou');
            }
        }

        $this->load->view('layout/public/layout', $this->_data);
    }
    public function thankyou(){
        $this->emptyCart();
        if(!$this->session->flashdata('thanks')){
            redirect(base_url());
        }
        $this->load->view('layout/public/layout', $this->_data);
    }

    public function emptyCart(){
        $this->session->unset_userdata('cart');
    }

}