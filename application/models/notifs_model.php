<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifs_Model extends CI_Model {

	public function get_all($username) {

		$this->db->where('username', $username);
		$q = $this->db->get('notificationss');

		if (q->num_rows() > 0)
			return $q->result();
		else return null;
	}

}

?>