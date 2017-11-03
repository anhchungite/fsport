<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class File_library {
	 public $CI;

        public function __construct()
        {
                $this->CI =& get_instance();
        }
	public function upload_file($picture="hinhanh"){
		$arrData = array();
        $config['upload_path']    = $_SERVER['DOCUMENT_ROOT'].IMG_UPLOAD;
        $config['allowed_types']  = 'gif|jpg|png';
        //$config['encrypt_name'] = TRUE;
        $filename = $_FILES["hinhanh"]["name"];
        $arrFileName = explode('.', $filename);
        $duoiFile = '.'.array_pop($arrFileName);
        foreach($arrFileName as $key => $value){
            if($key == 0){
                $filename = $value;
            }
            else{
                $filename .= '-'.$value;
            }
        }
        $new_name = $filename.'_'.time().$duoiFile;
        $config['file_name'] = strtolower(str_replace(array('(',')'), array('',''), $new_name));

        $this->CI->load->library('upload', $config);

        if ( ! $this->CI->upload->do_upload($picture))
        {
               //return 'Có lỗi khi upload hình ảnh';
               $arrData['msg'] ="Thất bại";
        }
        else
        {
               //return 'Chuc mừng bạn upload thành công';
               $arrData['msg'] ="Thành công";
               $arrData['arrFile'] = $this->CI->upload->data();
        }
        return $arrData;
			
	}
	public function del_file($ten_file){
		$path_url = $_SERVER['DOCUMENT_ROOT'].IMG_UPLOAD.'/'.$ten_file;
		if(file_exists($path_url)){
			unlink($path_url);
		}
	}

}