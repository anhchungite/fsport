<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Brand_model extends CI_Model
{
	protected $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'tbl_brand';
	}
	public function num_rows($keyword)
	{
        $this->db->like('brandName', $keyword);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function show($page, $rows_page, $keyword)
	{
		$offset = $page * $rows_page - $rows_page;
		$this->db->limit($rows_page, $offset);
		$this->db->order_by('brandID','DESC');
        $this->db->like('brandName', $keyword);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function get()
	{
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function get_by_id($id)
	{
		$this->db->where('brandID', $id);
		$query = $this->db->get($this->_table);
		return $query->row_array();
	}
	public function add($arrData)
	{
		return $this->db->insert($this->_table, $arrData);
	}
	public function edit($brandID, $arrData)
	{
		$this->db->where('brandID', $brandID);
		return $this->db->update($this->_table, $arrData);
	}
	public function del($id)
	{
		$this->db->where('brandID', $id);
		return $this->db->delete($this->_table);
	}
}