<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
*	All functions of this class is called via AJAX. Return data should be in
*	json_encode() format.
*/ 
class Notifs extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('notifs_model');
	}

	/*
	*	Sample call of this function in AJAX.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/notifs/view_by_username/" + username,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function view_by_username($username) {

		$q = $this->notifs_model->get_all($username);
		echo json_encode($q);
	}

	public function send_custom_notif() {
		
	}

}

?>