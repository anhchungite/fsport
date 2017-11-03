<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Contact_model extends CI_Model{
	protected  $_table;
	public function __construct(){
		parent::__construct();
		$this->_table = "tbl_contact";
	}
	
	// Gửi thông tin
	public function send($arrData){
		return $this->db->insert($this->_table, $arrData);
	}
	// Hiển thị các contact
	public function show($page, $rows_page, $status){
		$offset = $page * $rows_page - $rows_page;
		$this->db->select('id_contact,name,email,date_format(date, "%d-%m-%Y") as date,status');
		if($status != 'all'){
			$this->db->where('status', $status);
		}
		$this->db->order_by('id_contact', 'desc');
		$this->db->limit($rows_page, $offset);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	// Phân trang
	public function NumRow($status){
		if($status != 'all'){
			$this->db->where('status', $status);
		}
		$query = $this->db->get($this->_table);
		return  $query->num_rows();
	}
	// Hiển thị chi tiet contact
	public function detail($id_contact){
		$this->db->select('id_contact,name,email,date_format(date, "%H:%i:%s | %d-%m-%Y") as date,phone,content');
		$query = $this->db->get_where($this->_table, array('id_contact' => $id_contact));
		return $query->row_array();
	}
	// Update trạng thái contact
	public function update($id_contact, $arrData){
		$this->db->where('id_contact', $id_contact);
		return $this->db->update($this->_table, $arrData);
	}
	// Update trạng thái contact hàng loạt
	public function updateAll($arrID, $arrData){
		$this->db->where_in('id_contact', $arrID);
		return $this->db->update($this->_table, $arrData);
	}
	// Xóa contact
	public function del($id_contact){
		$this->db->where('id_contact', $id_contact);
		return $this->db->delete($this->_table);
	}
	// Xóa hàng loạt
	public function delAll($arrID){
		$this->db->where_in('id_contact', $arrID);
		return $this->db->delete($this->_table);
	}
	// Hiển thị các trạng thái chưa đọc
	public function unread(){
		$this->db->where('status',0);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
}