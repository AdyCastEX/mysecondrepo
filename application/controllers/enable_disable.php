<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	This document is the controller of the search module for user accounts
*/
class Enable_disable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');//loads the form helper
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
		$data['status'] = "pending";
		$this->load->model('enable_disable_model');
		$result = $this->enable_disable_model->runQuery($this->enable_disable_model->generateQuery($data));
		//$array['result'] = $result;
		//$this->load->view('enable_disable_view', $array);
		//var_dump($result);
		echo json_encode($result);

	}
}

/* End of file enable_disable.php */
/* Location: ./application/controllers/enable_disable.php */