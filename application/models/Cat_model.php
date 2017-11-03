<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Cat_model extends CI_Model{
	protected $_table;
	public function __construct(){
		parent::__construct();
		$this->_table = 'tbl_category';
	}
	
	
	
	
	//============================ PUBLIC ===============================//
	public function tab_cat($arr_cat)
	{
		$this->db->select('categoryID, categoryURL, categoryName');
		//$this->db->from($this->_table);
		//$this->db->join('tbl_product_category', 'tbl_product_category.categoryID = tbl_category.categoryID');
		$this->db->where_in('categoryID', $arr_cat);
		$this->db->order_by('categorySortOrder', "ASC");
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	
	//============================ ADMIN ===============================//
	public function show()
	{
		//$offset = $page * $rows_page - $rows_page;
		//$this->db->limit($rows_page, $offset);
		$this->db->order_by('parentCategoryID');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	public function get()
	{
		$this->db->order_by('categorySortOrder','ASC');
		$query = $this->db->get($this->_table);
        $result = $query->result_array();
		foreach ($result as $key => $value){
            $result[$key]['countSP'] = $this->Cat_model->count_product($value['categoryID']);
        };
        return $result;
	}

	// Đếm số sp từng DM
    public function count_product($id){
        //$this->db->select('COUNT("productID") AS "countProduct"');
        $this->db->where('categoryID', $id);
        $query = $this->db->get('tbl_product_category');
        return $query->num_rows();
    }
	public function num_rows()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function get_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('categoryID' => $id));
		return $query->row_array();
	}
    // Lấy danh sách category của 1 product (chức năng edit product)
    public function get_by_product($id_product){
        $this->db->select('categoryID');
        $this->db->from('tbl_product_category');
        $this->db->where('productID', $id_product);
        $query = $this->db->get();
        $return = array();
        foreach ($query->result_array() as $value){
            $return[] = $value['categoryID'];
        }
        return $return;
    }
	public function add($arrData)
	{
		return $this->db->insert($this->_table, $arrData);
	}
	public function edit($categoryID, $arrData)
	{
		$this->db->where('categoryID', $categoryID);
		return $this->db->update($this->_table, $arrData);
	}
	public function del($categoryID)
	{
		$this->db->where('categoryID', $categoryID);
		return $this->db->delete($this->_table);
	}
    // Cập nhật lại parent id sau khi xóa.
	public function get_parent($id){
        $this->db->select('parentCategoryID');
        $query = $this->db->get_where($this->_table, array('categoryID' => $id));
        return $query->row_array()['parentCategoryID'];
    }
    public function update_child($id, $parent){
        $this->db->where('parentCategoryID', $id);
        return $this->db->update($this->_table, array('parentCategoryID' => $parent));
    }

	// Kiểm tra trùng lặp Category
    public function check_exist_cat($cat_name = "", $cat_id =""){
        $sql ="SELECT * FROM $this->_table WHERE BINARY `categoryName` = ? AND `categoryID` != ?";
        $query = $this->db->query($sql, array($cat_name, $cat_id));
        if($query->num_rows() > 0){
            return true;
        }
        return false;

    }
}
