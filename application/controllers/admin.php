<?php defined('BASEPATH') or die('No direct script access allowed');

class Admin extends MY_Controller
{
	// not implemented yet
	public function index()
	{
		
	}

	// new post on facebook page
	public function post()
	{
		$pages = array();

		$page_id = FALSE;
		$page_access_token = '';

		if(!empty($_POST) && isset($_POST['save']))
		{
			$page_id = $_POST['pages'];
			unset($_POST['pages']);
		}

		{
			if(empty($accounts))
			{
				// get all accounts
				$accouns = $this->fb->api('/me/accounts?' . $this->fb_at);
			}
			else
			{
				$accouns = $this->fb->api($accouns['paging']['next']);
			}

			$next = explode('&', $accouns['paging']['next']);
			$limit = 1000;

			foreach($next as $elem)
			{
				if(substr($elem, 0, 6) === 'limit=') // because offset changes
				{
					$limit = (int)substr($elem, 6);
					break;
				}
			}

			foreach($accouns['data'] as $k => $page)
			{
				// get only pages, not apps
				if($page['category'] != 'Application')
				{
					$pages[] = array('name' => htmlspecialchars($page['name']), 'id' => $page['id']);

					if($page['id'] == $page_id)
					{
						$page_access_token = $page['access_token'];
					}
				}
			}
		}
		while($k + 1 >= $limit){}

		$this->data['pages'] = $pages;
		$this->data['view'] = 'admin/post';

		if(!empty($_POST) && isset($_POST['save']) && $page_id && $page_access_token)
		{
			$post_array = array();

			if(isset($_POST['publish_later']))
			{
				date_default_timezone_set("UTC");
				$post_array['scheduled_publish_time'] = strtotime($_POST['scheduled_publish_time']);
				$post_array['published'] = FALSE;
				unset($_POST['scheduled_publish_time']);
				unset($_POST['publish_later']);
			}

			foreach($_POST as $k => $v)
			{
				if($v !== '')
				{
					$post_array[$k] = $v;
				}
			}

			$post_array['access_token'] = $page_access_token;

			try
			{
				$post_to_page_result = $this->fb->api($page_id . '/feed', 'POST', $post_array);
			}
			catch(FacebookApiException $e)
			{
				$post_to_page_result = FALSE;
				$this->data['error'] = $e;
			}

			date_default_timezone_set("Europe/Sofia");

			$this->data['post_success'] = $post_to_page_result && isset($post_to_page_result['id']);
		}

		$this->load_view();
	}
}
