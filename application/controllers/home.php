<?php defined('BASEPATH') or die('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_home');
	}

	// not implemented yet
	public function index()
	{
		redirect('/admin/post');
		exit;
	}
}
