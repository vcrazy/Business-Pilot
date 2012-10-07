<?php defined('BASEPATH') or die('No direct script access allowed');

class Fb extends MY_Controller
{
	// not implemented yet
	public function login()
	{
		// if not logged (getUser() = 0) go log in
		if(!$this->fb->getUser())
		{
			// ask for permissions
			redirect($this->fb->getLoginUrl(array(
				'scope' => 'email, manage_pages, publish_stream'
			)));
			exit;
		}
		else
		{
			redirect('/admin/post');
			exit;
		}
	}
}
