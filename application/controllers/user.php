<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	public function index()
	{
		$this->load->view('create_user_view');
	}

	public function page2(){
		$this->load->view('search');
		var_dump($_GET['username']);
		var_dump($_GET['password']);
		var_dump($_GET['sex']);
		var_dump($_GET['status']);
		var_dump($_GET['email']);
		var_dump($_GET['usertype']);
		var_dump($_GET['emp_no']);
		var_dump($_GET['student_no']);
		var_dump($_GET['name_first']);
		var_dump($_GET['name_middle']);
		var_dump($_GET['name_last']);
		var_dump($_GET['mobile_no']);
		var_dump($_GET['course']);
		var_dump($_GET['college']);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */