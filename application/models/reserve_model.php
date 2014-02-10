<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reserve_Model extends CI_Model {

	function remove($data) {
	
		$this->db->where($data);
		$this->db->delete('reserves');
	}

	function dequeue($book_no) {

		$q = $this->db->query("SELECT * FROM reserves WHERE
				rank = (SELECT min(rank) FROM reserves) AND 
				book_no LIKE '{$book_no}'");

		if ($q->num_rows() == 0)
			return false;
		else
			return $q;
	}

	function enqueue($data) {

		$this->db->where($data);
		$this->db->insert('reserves');
	}

	function get($username) {

		$this->db->where('username', $username);
		$q = $this->db->get('reserves');

		if ($q->num_rows() > 0)
			return $q;
		else
			return false;
	}

	function check($data) {

		$this->db->where($data);
		$q = $this->db->get('reserves');

		if ($q->num_rows() == 0)
			return false;
		else
			return true;
	}
}

?>