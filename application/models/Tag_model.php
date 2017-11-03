<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Tag_model extends CI_Model
{
	protected $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'tbl_tag';
	}
	public function get()
	{
        $this->db->distinct();
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	// Lấy số lượng SP của 1 tag

    public function count_product($id){
        $this->db->where('tagID', $id);
        $query = $this->db->get('tbl_product_tag');
        return $query->num_rows();
    }
	public function get_tag_name(){
        $this->db->select('tagName');
        $query = $this->db->get($this->_table);
        $return = array();
        foreach ($query->result_array() as $value){
            $return[] = $value['tagName'];
        }
        return $return;
    }
    public function get_id_by_name($name){
        $sql = "SELECT `tagID` FROM $this->_table WHERE BINARY `tagName` = ?";
        $query = $this->db->query($sql, array($name));
        $return = array();
        return $query->row_array()['tagID'];
//        foreach ($query->row_array() as $value){
//            $return = $value['tagID'];
//        }
//        return $return;
    }
	public function get_by_id($id)
	{
		$query = $this->db->get_where($this->_table, array('tagID' => $id));
		return $query->row_array();
	}
	// Lấy danh sách tag của 1 product (chức năng edit product)
	public function get_by_product($id_product){
        $this->db->select('tagName');
        $this->db->from($this->_table);
        $this->db->join('tbl_product_tag','tbl_tag.tagID = tbl_product_tag.tagID');
        $this->db->where('productID', $id_product);
        $query = $this->db->get();
        $return = array();
        foreach ($query->result_array() as $value){
            $return[] = $value['tagName'];
        }
        return $return;
    }
	public function select_id($arrData)
	{
		$query = $this->db
				->select('tagID')
				->where_in('tagName',$arrData)
				->get('tbl_tag');
		return $query->result_array();
	}
	public function show($page, $rows_page, $keyword)
	{
		$offset = $page * $rows_page - $rows_page;
		$this->db->order_by('tagID','DESC');
		$this->db->limit($rows_page, $offset);
		$this->db->like('tagName', $keyword, 'both');
		$query = $this->db->get($this->_table);
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $result[$key]['countSP'] = $this->Tag_model->count_product($value['tagID']);
        }
        return $result;
	}
	public function num_rows($keyword)
	{
		$this->db->like('tagName', $keyword, 'both');
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function add($arrData)
	{
		return $this->db->insert($this->_table, $arrData);
	}
	public function add_return_id($arr)
	{
		$this->db->insert($this->_table, $arr);
		return $this->db->insert_id();

	}
	public function edit($tagID, $arrData)
	{
		$this->db->where('tagID', $tagID);
		return $this->db->update($this->_table, $arrData);
	}
	public function del($id)
	{
		$this->db->where('tagID', $id);
		return $this->db->delete($this->_table);
	}
	public function del_all($arr_id)
	{
		$this->db->where_in('tagID', $arr_id);
		return $this->db->delete($this->_table);
	}

	public function check_tag_exist($tag_name="", $id="")
    {
        $sql = "SELECT * FROM $this->_table WHERE BINARY `tagName` = ? AND `tagID` != ?";
        $query =  $this->db->query($sql, array($tag_name, $id));
        if($query->num_rows() > 0){
            return true;
        }
        return false;
	}
	
	public function publicTagByProduct($idProduct){
		$this->db->select('tbl_tag.tagID');
		$this->db->from($this->_table);
        $this->db->join('tbl_product_tag','tbl_tag.tagID = tbl_product_tag.tagID');
        $this->db->where('productID', $idProduct);
		$query = $this->db->get();
		$tagsId = array();
		foreach ($query->result_array() as $key => $value) {
			$tagsId[$key] = $value['tagID'];
		}
		return $tagsId;
	}
}
