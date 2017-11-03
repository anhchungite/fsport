<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Error_404 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		
		$this->data['title'] = "404";
		$this->load->view("layout/404/layout", $this->data);
	}
}