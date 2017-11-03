<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Product_model extends CI_Model
{
	protected  $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = "tbl_product";
	}
	//============PUBLIC===================================================================================//
	public function new_product()
	{
		$this->db->order_by('productID','DESC');
		$this->db->where('productStatus',1);
		$this->db->limit(4,0);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function tab_product($id_cat)
	{
	    $this->db->select("*");
        $this->db->distinct();
	    $this->db->from($this->_table);
        $this->db->join("tbl_product_category", "tbl_product.productID = tbl_product_category.productID");
        $this->db->join("tbl_category", "tbl_category.categoryID = tbl_product_category.categoryID");
        $this->db->where(array("tbl_category.categoryID" => $id_cat));
        //$this->db->where(array("tbl_category.parentCategoryID" => $id_cat));
        $this->db->order_by('productSort','DESC');
        $this->db->limit(3,0);
        $query = $this->db->get();
        return $query->result_array();
	}

	public function getRelateProducts($idProduct){
		$this->db->select('tbl_tag.tagID');
		$this->db->from('tbl_tag');
        $this->db->join('tbl_product_tag','tbl_tag.tagID = tbl_product_tag.tagID');
		$this->db->where('productID', $idProduct);
		$query = $this->db->get();
		$tagsId = array();
		foreach ($query->result_array() as $key => $value) {
			$tagsId[$key] = $value['tagID'];
		}
		$this->db->reset_query();
		$this->db->select('tbl_product.productID, productName, productDiscount, productPrice, productImage, productColor, productSize, productURL');
		$this->db->from($this->_table);
        $this->db->join('tbl_product_tag','tbl_product.productID = tbl_product_tag.productID');
		$this->db->where_in('tbl_product_tag.tagID', $tagsId);
		$this->db->distinct();
		$query = $this->db->get();
		$product = $query->result_array();
		$this->db->reset_query();
		
	}
	//============ADMIN===================================================================================//
	// Thống kê
	public function count()
	{
		$this->db->where('productStatus', 1);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	// Hiển thị các sp
	public function show($page, $rows_page, $sort_by, $sort_order,$filter_name,$filter_price,$filter_quantity,$filter_status)
	{
		$offset = $page * $rows_page - $rows_page;
		if ($filter_name !="")
		{
			$this->db->like('productName', $filter_name);
		}
		if ($filter_price !="")
		{
			$this->db->like('productPrice', $filter_price);
		}
		if ($filter_quantity !="")
		{
			$this->db->where('productQuantity', $filter_quantity);
		}

		if ($filter_status !="")
		{
			$this->db->like('productStatus', $filter_status);
		}
		if($sort_by !='' && $sort_order !=''){
			$this->db->order_by("$sort_by", "$sort_order");
		}else {
			$this->db->order_by('productID', 'DESC');
		}
		$this->db->limit($rows_page, $offset);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	// Phân trang
	public function num_rows($filter_name,$filter_price,$filter_quantity,$filter_status)
	{
	if ($filter_name !="")
		{
			$this->db->like('productName', $filter_name);
		}
		if ($filter_price !="")
		{
			$this->db->like('productPrice', $filter_price);
		}
		if ($filter_quantity !="")
		{
			$this->db->where('productQuantity', $filter_quantity);
		}

		if ($filter_status !="")
		{
			$this->db->like('productStatus', $filter_status);
		}
		$query = $this->db->get($this->_table);
		return  $query->num_rows();
	}
	
	// Thêm sản phẩm
	public function add($arr_insert_product, $arr_insert_product_category, $arr_insert_product_tag)
	{
		$this->db->trans_begin();
			$this->db->insert($this->_table, $arr_insert_product); // Chèn vào bảng SP
			$id_product = $this->db->insert_id(); // Lấy id SP vừa chèn

            // Chèn vào tbl_product_category
            function insert_product_category($arr_insert_product_category,$id_product, $option = array('productID', 'categoryID'))
            {
                $return = array();
                foreach ($arr_insert_product_category as $id_cat){
                    $return[] = array($option[0] => $id_product, $option[1] => $id_cat);
                }
                return $return;
            }
            $this->db->insert_batch('tbl_product_category', insert_product_category($arr_insert_product_category, $id_product));
            // Chèn vào tbl_product_tag
            function insert_product_tag($arr_insert_product_tag, $id_product, $option = array('productID', 'tagID')){
                $CI = & get_instance();
                $arr_all_tag = $CI->Tag_model->get_tag_name();
                $arr_tag = array();
                $return = array();
                foreach ($arr_insert_product_tag as $value){
                    if(in_array($value, $arr_all_tag)){
                        // Đã tồn tại trả về id của từng tags
                        $arr_tag_id = $CI->Tag_model->get_id_by_name($value);
                        $return[] = array($option[0]=>$id_product, $option[1] => $arr_tag_id);
                    }else{
                        // Chưa tồn tại chèn vào và trả về id
                        $arr_tag['tagName'] = $value;
                        $arr_tag['tagURL'] = convertUrl($value);
                        $arr_tag_id = $CI->Tag_model->add_return_id($arr_tag);
                        $return[] = array($option[0]=>$id_product, $option[1] => $arr_tag_id);
                    }
                }
                return $return;
            }
            $this->db->insert_batch('tbl_product_tag', insert_product_tag($arr_insert_product_tag, $id_product));

		if(!$this->db->trans_status())
		{
			$this->db->trans_rollback();
			return false;
		}else {
			$this->db->trans_commit();
			return true;
		}
	}

	
	
	// Thêm sản phẩm
	public function edit($id, $arr_update_product, $arr_update_product_category, $arr_update_product_tag)
	{
		$this->db->trans_begin();
            $this->db->where('productID', $id);

            // Cập nhật bảng tbl_product
            $this->db->update($this->_table, $arr_update_product);

            // Cập nhật bảng tbl_product_category
            $this->db->where('productID', $id);
            $this->db->delete('tbl_product_category');
            function insert_product_category($arr_update_product_category,$id, $option = array('productID', 'categoryID'))
            {
                $return = array();
                foreach ($arr_update_product_category as $id_cat){
                    $return[] = array($option[0] => $id, $option[1] => $id_cat);
                }
                return $return;
            }
            $this->db->insert_batch('tbl_product_category', insert_product_category($arr_update_product_category, $id));

            // Cập nhật bảng tbl_product_tag
            $this->db->where('productID', $id);
            $this->db->delete('tbl_product_tag');
            function insert_product_tag($arr_update_product_tag, $id, $option = array('productID', 'tagID')){
                $CI = & get_instance();
                $arr_all_tag = $CI->Tag_model->get_tag_name();
                $arr_tag = array();
                $return = array();
                foreach ($arr_update_product_tag as $value){
                    if(in_array($value, $arr_all_tag)){
                        // Đã tồn tại trả về id của từng tags
                        $arr_tag_id = $CI->Tag_model->get_id_by_name($value);
                        $return[] = array($option[0]=>$id, $option[1] => $arr_tag_id);
                    }else{
                        // Chưa tồn tại chèn vào và trả về id
                        $arr_tag['tagName'] = $value;
                        $arr_tag['tagURL'] = convertUrl($value);
                        $arr_tag_id = $CI->Tag_model->add_return_id($arr_tag);
                        $return[] = array($option[0]=>$id, $option[1] => $arr_tag_id);
                    }
                }
                return $return;
            }
            $this->db->insert_batch('tbl_product_tag', insert_product_tag($arr_update_product_tag, $id));

		if(!$this->db->trans_status())
		{
			$this->db->trans_rollback();
			return false;
		}else {
			$this->db->trans_commit();
			return true;
		}
	}
	

	
	
	
	
	
	
	
	
	public function get_product_tag(){
		$query = $this->db->get('tbl_product_tag');
		return $query->result_array();
	}
	public function get_product_cat(){
		$query = $this->db->get('tbl_product_category');
		return $query->result_array();
	}
	
	public function get_by_id($id)
	{
		$query = $this->db->get_where($this->_table,array('productID' => $id));
		return $query->row_array();
	}
	public function get_product_tag_by_id($id)
	{
		$this->db->select('tbl_product_tag.tagID, tagName');
		$this->db->from($this->_table);
		$this->db->join('tbl_product_tag', 'tbl_product.productID = tbl_product_tag.productID');
		$this->db->join('tbl_tag', 'tbl_tag.tagID = tbl_product_tag.tagID');
		$this->db->where(array('tbl_product_tag.productID' => $id));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_product_category_by_id($id)
	{
		$this->db->select('categoryID');
		$this->db->from('tbl_product_category');
		$this->db->where(array('productID' => $id));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_product_image_by_id($id)
	{
		$this->db->select('image');
		$this->db->from('tbl_product_image');
		$this->db->where(array('productID' => $id));
		$query = $this->db->get();
		return $query->result_array();
	}

	// Update trạng thái sản phẩm hàng loạt
	public function update_status_all($arrID, $arrData)
	{
		$this->db->where_in('productID', $arrID);
		return $this->db->update($this->_table, $arrData);
	}
	// Xóa từng sp
	public function del($id)
	{
		$this->db->where('productID', $id);
		return $this->db->delete($this->_table);
	}
	// Xóa hàng loạt
	public function del_all($arrID)
	{
		$this->db->where_in('productID', $arrID);
		return $this->db->delete($this->_table);
	}
    public function getAttr($id)
    {
        $this->db->select('productColor, productSize');
        $this->db->where('productID', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }
    public function get_all()
    {
        $query = $this->db->get_where($this->_table, array('deleted' => 0));
        return $query->result_array();
    }
}