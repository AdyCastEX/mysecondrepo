<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorites_Model extends CI_Model {

	public function get_all($username) {

		$this->db->where('username', $username);
		$q = $this->db->get('favorites');
		return $q->result();
	}
	

	public function add($data) {

		$this->db->insert('favorites', $data);
		return;
	}


	public function remove($data) {	

		$this->db->delete('favorites', $data);
		return;
	}

}

?>