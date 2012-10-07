<?php defined('BASEPATH') or die('No direct script access allowed');

class Err extends MY_Controller
{
	// not implemented
	public function index()
	{
		redirect('/err/admin');
		exit;
	}

	// shows error if the user is not admin
	public function admin()
	{
		$this->data['view'] = 'error/admin';

		$this->load_view();
	}
}
