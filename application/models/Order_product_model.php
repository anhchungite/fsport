<?php
/**
 * Created by PhpStorm.
 * User: Tran Anh Chung
 * Date: 7/1/2017
 * Time: 5:33 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class Order_product_model extends CI_Model
{
    protected $_table;

    public function __construct()
    {
        parent::__construct();
        $this->_table = "tbl_order_product";
    }


    // Lấy chi tiết hóa đơn
    public function getOrderProduct($id)
    {
        $this->db->where(array('orderID' => $id, 'deleted' => 0));
        $query = $this->db->get($this->_table);
        return count($query->result_array() > 0) ? $query->result_array() : false;
    }

    public function delete($id)
    {
        if(is_array($id)){
            $this->db->where_in('orderProductID', $id);
        }else{
            $this->db->where('orderProductID', $id);
        }
        return $this->db->delete($this->_table);
    }

    public function update($id, $arrData)
    {
       $this->db->where('orderProductID', $id);

        return $this->db->update($this->_table, $arrData);
    }


}