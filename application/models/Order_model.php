<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Order_model extends CI_Model
{
	protected  $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = "tbl_order";


	}
    // Đếm số hóa đơn
    public function num_rows($array_filter)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tbl_user', 'tbl_order.userID = tbl_user.userID');

        if ($array_filter['id'] !="")
        {
            $this->db->like('orderID', $array_filter['id']);
        }
        if ($array_filter['status'] !="")
        {
            $this->db->like('orderStatusID', $array_filter['status']);
        }
        if ($array_filter['customer'] !="")
        {
            if(is_numeric($array_filter['customer'])){
                //$array_filter['customer'] = (int)$array_filter['customer'];
                if($array_filter['customer'][0] == 0){
                    $this->db->where('userPhone', $array_filter['customer']);
                }else{
                    $this->db->where('tbl_order.userID', $array_filter['customer']);
                }
            }else if(preg_match('/^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/', $array_filter['customer']) == true)
            {
                $this->db->where('userEmail', $array_filter['customer']);
            } else{
                $this->db->like('userName', $array_filter['customer']);
                $this->db->or_like('userFullName', $array_filter['customer']);
            }

        }
        if ($array_filter['total'] !="")
        {
            $this->db->where('total', $array_filter['total']);
        }
        if ($array_filter['pur_date'] !="")
        {
            $this->db->where('purchaseDate', $array_filter['pur_date']);
        }
        if ($array_filter['chan_date'] !="")
        {
            $this->db->like('changeDate', $array_filter['chan_date']);
        }
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // Lấy hóa đơn
    public function getOrder($id)
    {
        $this->db->join('tbl_user', 'tbl_user.userID = tbl_order.userID');
        $query = $this->db->get_where($this->_table, array('tbl_order.orderID' => $id));
        return count($query->row_array() > 0)? $query->row_array() : false;
    }

    public function getOrderByUser($id){
        $this->db->order_by('orderID', 'DESC');
        $query = $this->db->get_where($this->_table, array('userID' => $id));
        return count($query->result_array()) > 0 ? $query->result_array() : false;
    }
    // Hiển thị tất cả hóa đơn
    public function show($page, $rows_page, $array_filter)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('tbl_user', 'tbl_order.userID = tbl_user.userID');

        $offset = $page * $rows_page - $rows_page;
        if ($array_filter['id'] !="")
        {
            $this->db->like('orderID', $array_filter['id']);
        }
        if ($array_filter['status'] !="")
        {
            $this->db->like('orderStatusID', $array_filter['status']);
        }
        if ($array_filter['customer'] !="")
        {
            if(is_numeric($array_filter['customer'])){
                //$array_filter['customer'] = (int)$array_filter['customer'];
                if($array_filter['customer'][0] == 0){
                    $this->db->where('userPhone', $array_filter['customer']);
                }else{
                    $this->db->where('tbl_order.userID', $array_filter['customer']);
                }
            } else{
                $this->db->like('userName', $array_filter['customer']);
                $this->db->or_like('userFullName', $array_filter['customer']);
            }
        }
        if ($array_filter['total'] !="")
        {
            $this->db->where('total', $array_filter['total']);
        }
        if ($array_filter['pur_date'] !="")
        {
            $this->db->where('purchaseDate', $array_filter['pur_date']);
        }
        if ($array_filter['chan_date'] !="")
        {
            $this->db->like('changeDate', $array_filter['chan_date']);
        }
        $this->db->where('deleted', 0);
        $this->db->limit($rows_page, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Lấy trạng thái order
    public function getOrderStatus($id = '')
    {
        if(isset($id)){
            $this->db->where('orderStatusID', $id);
            $query = $this->db->get('tbl_order_status');
            return $query->row_array()['orderStatusDes'];
        }
        $query = $this->db->get('tbl_order_status');
        return $query->result_array();
    }
    // Update
    public function update($id, $arrData)
    {
        if(is_array($id)){
            $this->db->where_in('orderID', $id);
        }else{
            $this->db->where('orderID', $id);
        }
        return $this->db->update($this->_table, $arrData);
    }


    // Delete
    public function delete($id)
    {
        if(is_array($id)){
            $this->db->where_in('orderID', $id);
        }else{
            $this->db->where('orderID', $id);
        }
        return $this->db->update($this->_table, array('deleted' => 1));
    }

}