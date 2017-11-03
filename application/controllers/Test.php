<?php

class Test extends CI_Controller
{
	public function index()
	{
        $this->load->library('zend_search');
		$this->zend_search->create_index();
	}
}