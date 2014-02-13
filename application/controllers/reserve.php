<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
*	All functions of this class is called via AJAX. Return data should be in
*	json_encode() format.
*/ 
class Reserve extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('reserve_model');
	}


	/*
	*	Sample call of this function in AJAX.
	*	`info` is a js var[] containi	ng the data needed.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/reserve/remove/" + username + "/" + book_no + "/" + email,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	function remove($username, $book_no, $email) {
	
		$data = array (
			'username' => $username,
			'book_no' => $book_no,
			'email' => $email
		);
		
		$this->Reserve_Model->remove($data);
	}


	/*
	*	Sample call of this function in AJAX.
	*	Deletes and returns the entry in `reserve` table with the 
	*	lowest rank value.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/reserve/dequeue/" + book_no,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	function dequeue($book_no) {

		$q = $this->reserve_model->dequeue($book_no);
		echo json_encode($q);
	}

	/*
	*	Sample call of this function in AJAX.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/reserve/enqueue/" + username + "/" + book_no + "/" + email,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function enqueue($username, $book_no, $email) {
		$data = array(
				'username' => $username,
				'book_no' => $book_no,
				'email' => $email,
				'date_reserved' => date('Y-m-d H:i:s')
			);

		$this->reserve_model->enqueue($data);
	}

	/*
	*	Sample call of this function in AJAX.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/reserve/check/" + username + "/" + book_no,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function check($username, $book_no) {
		$data = array(
				'username' => $username,
				'book_no' => $book_no
			);

		$result = $this->reserve_model->check($data);
		echo json_encode($result);
	}


	/*
	*	Sample call of this function in AJAX.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/reserve/view_by_username/" + username,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function view_by_username($username) {
		$q = $this->reserve_model->get($username);
		echo json_encode($q);
	}

}

?>