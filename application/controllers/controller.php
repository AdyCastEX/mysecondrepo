<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller extends CI_Controller {

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

	public function page2(){
		$data['username']= $_GET['username'];
		$data['password']= $_GET['password'];
		$data['sex']= $_GET['sex'];
		$data['email']= $_GET['email'];
		$data['usertype']= $_GET['usertype'];
		$data['emp_no']= $_GET['emp_no'];
		$data['student_no']= $_GET['student_no'];
		$data['name_first']= $_GET['name_first'];
		$data['name_middle']= $_GET['name_middle'];
		$data['name_last']= $_GET['name_last'];
		$data['mobile_no']= $_GET['mobile_no'];
		$data['course']= $_GET['course'];
		$data['college']= $_GET['college'];

		$this->load->view('search', $data);
		$this->savedata($data);
	}

	public function savedata($data){
		$this->model->insert_data($data);
	}
	
	function __construct(){
		parent::__construct(); //super sa java
		$this->load->model('model');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */