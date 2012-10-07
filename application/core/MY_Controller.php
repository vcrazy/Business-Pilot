<?php defined('BASEPATH') or die('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $fb;
	protected $data;
	protected $fb_uid;
	protected $fb_at;

	public function __construct()
	{
		parent::__construct();

		// here include facebook sdk too because there's nowhere it can be included smarter
		require_once APPPATH . 'third_party/facebook.php';

		// new FB
		$this->fb = new Facebook(array(
			'appId' => '417513221629600',
			'secret' => 'b0956f1228887e724029a915c77c584f'
		));

		// not in the login controller
		if($this->uri->segment(1) != 'fb')
		{
			// if not logged (getUser() = 0) -> go log in
			if(!$this->fb->getUser())
			{
				redirect('/fb/login');
				exit;
			}

//			// check if user is admin
//			if(!$this->Model_admin->is_admin($this->fb->getUser()))
//			{
//				redirect('/err/admin');
//				exit;
//			}
		}

		if($this->fb->getUser())
		{
			$this->fb_uid = $this->fb->getUser();
			$this->fb_at = 'access_token=' . $this->fb->getAccessToken();
		}
	}

	protected function load_view($view = 'skeleton')
	{
		if(!isset($this->data['view']))
		{
			redirect('/404');
			exit;
		}

		$this->load->view($view . '.php', $this->data);
	}
}
