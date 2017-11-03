<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class AC_Controller extends CI_Controller{
	protected $_data;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->_data['site_info'] = $this->Site_model->get('public');

	}
}