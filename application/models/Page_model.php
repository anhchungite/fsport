<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Page_model extends CI_Model{
	protected  $_table;
	function __construct(){
		parent::__construct();
		$this->_table = "tbl_page";
	}
	// Hiển thị chi tiết trang
	function showDetail($id_page){
		$query = $this->db->get_where($this->_table, array('id_page' => $id_page, 'status_page' => 1));
		return $query->row_array();
	}
	// Hiển thị các trang
	function showPage(){
		$this->db->select('id_page, name_page,url_page');
		$this->db->where('status_page', 1);
		$this->db->order_by('id_page','ASC');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	//============> ADMIN <===========//
	// Thống kê trang
	function count(){
		$this->db->where('status_page',1);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	// Truy vấn trang theo id
	function get_by_id($id_page){
		$query = $this->db->get_where($this->_table, array('id_page' => $id_page));
		return $query->row_array();
	}
	// Truy vấn tất cả các trang
	function get()
	{
		$this->db->order_by('id_page','DESC');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	// Thêm trang
	function add($arrData)
	{
		return $this->db->insert($this->_table, $arrData);
	}
	// Sửa trang
	function edit($id_page, $arrData)
	{
		$this->db->where('id_page', $id_page);
		return $this->db->update($this->_table, $arrData);
	}
	// Xóa trang
	function del($id_page)
	{
		$this->db->where('id_page', $id_page);
		return $this->db->delete($this->_table);
	}
}