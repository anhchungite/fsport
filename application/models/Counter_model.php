<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Counter_model extends CI_Model{
	protected $_table;
	function __construct(){
		parent::__construct();
		$this->_table = "tbl_counter";
	}
	public function counter($arrData){
		return $this->db->insert($this->_table, $arrData);
	}
	public function get_access_by_month($month, $year){
		$this->db->where(array('date_format(date, "%m")=' => $month, 'date_format(date, "%Y")=' => $year));
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
}