<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	This document is the controller of the search module for user accounts
*/
class Enable_disable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');//loads the form helper
		$this->load->library('session');//loads the session library
	}

	public function index()
	{
		$this->load->view('enable_disable_view');
	}

	public function search()
	{
		$data['field'] = $_POST["field"];//copies the data from $_POST to an array
		switch($_POST["field"]){
			case "name": {
				$data['fname'] = $_POST["firstname"];
				$data['mname'] = $_POST["middlename"];
				$data['lname'] = $_POST["lastname"];
				break;
			}

			case "stdno": {
				$data['student_no'] = $_POST["studentno"];
				break;
			}

			case "uname": {
				$data['username'] = $_POST["username"];
				break;
			}

			case "email": {
				$data['email'] = $_POST["emailadd"];
				break;
			}
		}
		$data['status'] = $_POST["status"];
		$this->load->model('enable_disable_model');
		$this->session->set_userdata('sql', $this->enable_disable_model->generateQuery($data));
		$result = $this->enable_disable_model->runQuery($this->session->userdata('sql'));
		$array['result'] = $result;
		$this->load->view('enable_disable_view', $array);
	}

	public function activate($username, $student_no, $email)
	{
		$admin = "team3";
		$action = "activate";

		$this->load->model('enable_disable_model');
		$this->enable_disable_model->activate($username, $student_no, $email);
		$this->enable_disable_model->log($admin, $username, $email, $action);
		$result = $this->enable_disable_model->runQuery($this->session->userdata('sql'));
		$array['result'] = $result;
		$this->load->view('enable_disable_view', $array);
	}

	public function enable($username, $email)
	{
		$admin = "team3";
		$action = "enable";

		$this->load->model('enable_disable_model');
		$this->enable_disable_model->enable($username, $email);
		$this->enable_disable_model->log($admin, $username, $email, $action);
		$result = $this->enable_disable_model->runQuery($this->session->userdata('sql'));
		$array['result'] = $result;
		$this->load->view('enable_disable_view', $array);
	}

	public function disable($username, $student_no, $email)
	{
		$admin = "team3";
		$action = "disable";

		$this->load->model('enable_disable_model');
		$this->enable_disable_model->disable($username, $student_no, $email);
		$this->enable_disable_model->log($admin, $username, $email, $action);
		$result = $this->enable_disable_model->runQuery($this->session->userdata('sql'));
		$array['result'] = $result;
		$this->load->view('enable_disable_view', $array);
	}
}

/* End of file enable_disable.php */
/* Location: ./application/controllers/enable_disable.php */