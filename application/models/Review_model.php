<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Review_model extends CI_Model
{
	protected $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'tbl_review';
	}
	public function create($arrData){
        return $this->db->insert($this->_table, $arrData);
    }

    public function view($id_product){
        $this->db->select('reviewID, reviewScore, reviewName, reviewEmail, reviewText, reviewDate, member');
        $query = $this->db->get_where($this->_table, array('productID' => $id_product, 'deleted' => 0, 'accepted' => 0));
        return $query->result_array();
    }

    public function check_useragent($id_product, $email, $userIP){
        $this->db->or_where('reviewIP', $userIP);
        $this->db->or_where('reviewEmail', $email);
        $query = $this->db->get_where($this->_table, array('productID' => $id_product,'deleted' => 0));
        if(count($query->row_array()) > 0){
            return true;
        }
        return false;
    }

    public function publicView($id_product){
        $this->db->select('reviewID, reviewScore, reviewName, reviewEmail, reviewText, reviewDate, member');
        $query = $this->db->get_where($this->_table, array('productID' => $id_product, 'deleted' => 0, 'accepted' => 1));
        return $query->result_array();
    }
}