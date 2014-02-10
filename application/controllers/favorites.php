<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
*	All functions of this class is called via AJAX. Return data should be in
*	`echo json_encode()` format.
*/ 
class Favorites extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('favorites_model');
	}



	/**
	*	For testing purposes lang. To test this, uncomment/comment the appropriate
	*	lines of codes, and then specify this controlller as the 'default_controller'
	*	in the /config/routes.php file
	*/
	public function index() {

		/* get_all($username) */
		// $data['get_all_1'] = $this->get_all('user123');
		// $data['get_all_2'] = $this->get_all('user789');

		/* add() */
		//$this->add();

		/* get_all($username) */
		// $data['get_all_3'] = $this->get_all('user123');
		// $data['get_all_4'] = $this->get_all('user789');

		/* remove() */
		//$this->remove();

		/* get_all($username) */
		// $data['get_all_5'] = $this->get_all('user123');
		// $data['get_all_6'] = $this->get_all('user789');

		// $this->load->view('favorites_view', $data);
	}



	/*
	*	Sample call of this function in AJAX.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/favorites/get_all/" + username,
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function get_all($username) {

		$data = $this->favorites_model->get_all($username);

		/* passes back to AJAX call */
		echo json_encode($data);

		/* 
		*	Use this and uncomment above when testing this controller.
		*	`return` only returns data within the server level. `echo`
		*	renders readable data which is fed unto the AJAX caller.
		*/	
		// return json_encode($data);
	}



	/*
	*	Sample call of this function in AJAX.
	*	`info` is a js var[] containing the data needed.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/favorites/add/",
	*		data : { arr : info },
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function add() {

		$info = $this->input->post('arr');

		/*		 Use this for testing the function
		$data = array (
					'username' => 'user789',
					'book_no' => 'QA_431_65',
					'date_added' => 'NOW()'
				);	
		*/

		
		$data = array (
					'username' => $info[0],
					'book_no' => $info[1],
					'date_added' => 'NOW()'
				);	
		
		$this->favorites_model->add($data);
	}



	/*
	*	Sample call of this function in AJAX.
	*	`info` is a js var[] containing the data needed.
	*
	*	$.ajax({
	*		url : "http://localhost/128_team2/favorites/remove/",
	*		data : { arr : info },
	*		type : 'POST',
	*		dataType : "html",
	*		async : true,
	*		success: function(data) {}
	*	});
	*/
	public function remove() {

		$info = $this->input->post('arr');

		/* 		Use this for testing the function
		$data = array (
					'username' => 'user789',
					'book_no' => 'QA_431_65'
				);	

		*/

		$data = array (
					'username' => $info[0],
					'book_no' => $info[1]
				);

		$this->favorites_model->remove($data);
	}
}

?>