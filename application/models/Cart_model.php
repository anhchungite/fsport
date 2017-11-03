<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Cart_model extends CI_Model
{
	protected $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'tbl_order';
	}

	public function addOrder($arr_cus = array(), $arr_pro = array()){
	    $this->db->trans_start();
        $this->db->insert($this->_table, $arr_cus);
        $order_id = $this->db->insert_id();
        foreach ($arr_pro as $key => $value){
            $arr_pro[$key]['orderID'] =  $order_id;
        }
        $this->db->insert_batch('tbl_order_product', $arr_pro);
        $this->db->trans_complete();

	    if($this->db->trans_status()){

            return true;

        }
    }
}