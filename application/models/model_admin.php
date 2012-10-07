<?php defined('BASEPATH') or die('No direct script access allowed');

class Model_admin extends MY_Model
{
	// checks whether a user is admin
	public function is_admin($fb_user_id)
	{
		// if not logged
		if(!$fb_user_id) return FALSE;

		$this->db->select('id');
		$this->db->from('admins');
		$this->db->where('fb_id', $fb_user_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->num_rows() > 0;
	}
}
