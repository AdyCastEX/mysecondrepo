<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct(); //super sa java
		$this->load->database(); //connect to database

	}

	function insert_data($data){
		$this->db->query("INSERT INTO user VALUES (
			'{$data['username']}',
			'{$data['password']}',
			'{$data['sex']}',
			'',
			'{$data['email']}',
			'{$data['usertype']}',
			'{$data['emp_no']}',
			'{$data['student_no']}',
			'{$data['name_first']}',
			'{$data['name_middle']}',
			'{$data['name_last']}',
			 {$data['mobile_no']},
			'{$data['course']}',
			'{$data['college']}'
			)" 
		);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */