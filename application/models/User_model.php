<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class User_model extends CI_Model
{
	protected $_table;
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'tbl_user';
	}
	public function ck_Auth($arrData)
	{
		$this->db->where(array('userName' => $arrData['userName'], 'userPass' => $arrData['userPass']));
		$this->db->where_in('userLevel',array(1,2));
		$query = $this->db->get($this->_table);
		return $query->row_array();
	}
	// Thống kê người dùng
	public function num_rows($filter_birthday, $filter_fullname, $filter_level, $filter_sex, $filter_username)
	{
        $array = array('userBirthday' => $filter_birthday, 'userFullName' => $filter_fullname, 'userLevel' => $filter_level, 'userSex' => $filter_sex, 'userName' => $filter_username);
		$this->db->like($array);
        $this->db->where('userID >',1);
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	// Truy vấn người dùng theo id / Kiểm tra tồn tại người dùng theo id
	public function get_by_id($id_user)
	{
        //$this->db->select("*,CASE userSex WHEN 1 THEN 'Nam' ELSE 'Nữ' END AS 'userSex', date_format(userBirthday,'%d-%m-%Y') AS 'userBirthday', CASE userLevel WHEN 1 THEN 'Admin' WHEN 2 THEN 'Support' ELSE 'Member' END AS 'userLevel'");
        $this->db->join('tbl_city', 'tbl_city.cityID = tbl_user.cityID');
		$query = $this->db->get_where($this->_table, array('userID' => $id_user));
		return $query->row_array();
	}
	// Truy vấn tất cả người dùng
	public function get($page, $rows_page, $filter_birthday, $filter_fullname, $filter_level, $filter_sex, $filter_username)
	{	
		//$like = array('userFullName' => $keyword,'userName' => $keyword);
		$offset = $page * $rows_page - $rows_page;
		$this->db->limit($rows_page, $offset);
        $array = array('userBirthday' => $filter_birthday, 'userFullName' => $filter_fullname, 'userLevel' => $filter_level, 'userSex' => $filter_sex, 'userName' => $filter_username);
        $this->db->like($array);
        $this->db->where('userID >',1);
		$this->db->order_by('userLevel','ASC');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}
	public function get_city($id="")
	{
		$this->db->order_by('cityName','ASC');
		if($id != ""){
		    $this->db->where('cityID',$id);
            $query = $this->db->get('tbl_city');
            return  $query->row_array();
        }
        $query = $this->db->get('tbl_city');
        return $query->result_array();
	}
	// Kiểm tra tồn tại người dùng theo username
	public function a_ckUser($username){
		$query = $this->db->get_where($this->_table, array('userName' => $username));
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}
	// Kiểm tra tồn tai Email khi cập nhật (validation)
	public function a_ckEmail($email, $id_user = ""){
		$this->db->where('userEmail',$email);
        $this->db->where('userID !=',$id_user);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}


	// Kiểm tra tồn tại password theo id (Chức năng đổi mật khẩu)
	public function a_ckPass($password, $id_user){
		$query = $this->db->get_where($this->_table, array('userPass' => $password, 'userID' => $id_user));
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}
	// Cập nhật mật khẩu (Chức năng đổi mật khẩu)
	public function change_pass($id_user, $arrData)
	{
		$this->db->where('userID', $id_user);
		return $this->db->update($this->_table, $arrData);
	}
	// Thêm người dùng
	public function add($arrData)
	{
		return $this->db->insert($this->_table, $arrData);
	}
	// Sửa người dùng
	public function edit($id_user, $arrData)
	{
		$this->db->where('userID', $id_user);
		return $this->db->update($this->_table, $arrData);
	}
	// Xóa người dùng
	public function del($id_user)
	{
		$this->db->where('userID', $id_user);
		return $this->db->delete($this->_table);
	}
	public function del_all($arr_id)
	{
		$this->db->where_in('userI', $arr_id);
		$this->db->where_in('user', $arr_id);
        //$this->db->where_in(array('userI'=> $arr_id, 'user'=>$arr_id));
		return $this->db->delete($this->_table);
	}

	//PUBLIC
    // Đăng ký thành viên
    public function reg_member($arrData)
    {
        $rerult = $this->db->insert($this->_table, $arrData);
        if($rerult){
            $query = $this->db->get_where($this->_table, array('userID'=>$this->db->insert_id()));
            return $query->row_array();
        }
        return false;
    }
	// Xác thực email
    public function verify_email($username="",$verify_code =""){

	    $this->db->select('userEmail,status');
	    $this->db->where('userName',$username);
	    $query = $this->db->get($this->_table);
	    $result = $query->row_array();
        //return array($username, $verify_code, md5($result['userEmail'].'/'.$result['status']));
	    if(count($result) > 0){
            if($verify_code == md5($result['userEmail'].'/'.$result['status'])){
                $this->db->where('userName',$username);
                $arrData['status'] = 1;
                return $this->db->update($this->_table, $arrData);
            }
            return false;
        }
        return false;
    }
    // Xác thực đăng nhập
    public function ck_Login($id ="",$pass=""){
        $where = "userEmail = '{$id}' AND userPass = '{$pass}' OR userName = '{$id}' AND userPass = '{$pass}'";
        $this->db->where($where);

        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    // Lấy người dùng
    public function getUser($id=""){
        $this->db->where(array('userID' => $id));
        $this->db->or_where(array('userEmail' => $id));
        $this->db->or_where(array('userName' => $id));
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }
    // Update mật khẩu
    public function updateUser($id="",$arrData){
        if(!$id == ""){
            $this->db->where('userID', $id);
            $this->db->or_where('userEmail', $id);
            $this->db->or_where('userName', $id);
            return $this->db->update($this->_table, $arrData);
        }
        return false;
    }
    // Lấy phí vc theo thành phố
    public function get_cost($id = ""){
        $this->db->select('cost');
        $query = $this->db->get_where('tbl_city',array('cityID' => $id));
        return $query->row_array();
    }
    // lấy tên TP theo ID
	//public function
	
	public function getUserInfo($fields = array(), $mode = 'all', $where = array(), $or_where = array()){
		foreach ($fields as $field) {
			$this->db->select($field);
		}
		foreach ($or_where as $cond => $value) {
			$this->db->or_where($cond, $value);
		}
		foreach ($where as $cond => $value) {
			$this->db->where($cond, $value);
		}
		$query = $this->db->get($this->_table);
		if($mode != 'all'){
			return $query->row_array();
		}
		return $query->result_array();
	}
}