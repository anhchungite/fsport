<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Site_model extends CI_Model{
	protected $_table;
	public function __construct(){
		parent::__construct();
		$this->_table = 'tbl_site';
	}
	public function get($layout = '')
	{
		$query = $this->db->get_where($this->_table,array('site_layout' => $layout));
		return $query->row_array();
	}
	public function edit($layout, $arrData)
	{
		$this->db->where('site_layout', $layout);
		return $this->db->update($this->_table, $arrData);
	}
	
}