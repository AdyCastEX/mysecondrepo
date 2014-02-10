<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author: Billy Joel Arlo T. Zarate
	Class for queries and database management
*/
class Enable_disable_model extends CI_Model {

	public function generateQuery($field)
	{
		/*
			creates query according to the search parameters submitted by the user
		*/
		$sql = "SELECT * FROM user" ; //string for query

		Switch($field['field'])
		{
			Case "name" : {
				if($field['fname'] != '' || $field['mname'] != '' || $field['lname'] != '')
					$sql = $sql." WHERE ";
				
				if($field['fname'] != '')
					$sql = $sql."name_first LIKE '".$field['fname']."'";

				if($field['fname'] != '' && $field['mname'] != '')
					$sql = $sql." OR ";
				
				if($field['mname'] != '')
					$sql = $sql."name_middle LIKE '".$field['mname']."'";
				
				if(($field['mname'] != '' && $field['lname'] != '') || ($field['fname'] != '' && $field['lname'] != ''))
					$sql = $sql." OR ";
				
				if($field['lname'] != '')
					$sql = $sql."name_last LIKE '".$field['lname']."'";
				break;
			}
			Case "stdno" : {
				if($field['student_no'] != '')
					$sql = $sql." WHERE student_no LIKE '".$field['student_no']."'";
				break;
			}
			Case "uname" : {
				if($field['username'] != '')
					$sql = $sql." WHERE username LIKE '".$field['username']."'";
				break;
			}
			Case "email" : {
				if($field['email'] != '')
					$sql = $sql." WHERE email LIKE '".$field['email']."'";
				break;
			}
		}		

		if($field['status'] != "all")
			$sql = $sql." AND status LIKE '".$field['status']."'";

		$sql = $sql." ORDER BY usertype,sex";

		echo $sql;

		return $sql;
	}

	public function runQuery($sql)
	{
		/*
			runs the query passed as a parameter
		*/
		$array = $this->db->query($sql);

		if ($array->num_rows() > 0)
		{
			foreach($array->result() as $row)
			{
				$data[] = $row;//for integrating with ajax code
			}

			return $data;
		}
	}

	public function activate($username, $student_no, $email)
	{
		/*
			this function validates and activates accounts
		*/

		$sql = "SELECT * FROM our WHERE student_no LIKE '".$student_no."'";

		$array = $this->db->query($sql);//checks the our_data for a student

		if ($array->num_rows() > 0)//checks if search returned with any results
		{
			if ($array->num_rows() == 1)//checks if search returned with a valid result
			{
				$update = "UPDATE user SET status = 'enabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";

				if($this->db->query($update))//checks if the update has been implemented
				{
					echo "<br />Update has been completed.<br />";
				}
				else
				{
					echo "<br />Update has encountered an error.<br />";
				}
			}
			else
			{
				echo "<br />Search returned with multiple results. Please try again.<br />";
			}
		}
		else
		{
			echo "<br />Search returned with zero results. Please try again.<br />";
		}
	}

	public function enable($username, $email)
	{
		/*
			this function enables accounts
		*/
		$update = "UPDATE user SET status = 'enabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
		
		if($this->db->query($update))//checks if the update has been implemented
		{
			echo "<br />Update has been completed.<br />";
		}
		else
		{
			echo "<br />Update has encountered an error.<br />";
		}
	}

	public function disable($username, $student_no, $email)
	{
		/*
			this function disables accounts
		*/

		$sql = "SELECT * FROM our WHERE student_no LIKE '".$student_no."'";

		$array = $this->db->query($sql);//checks the our_data for a student

		if ($array->num_rows() > 0)//checks if search returned with any result
		{
			if ($array->num_rows() == 1)//checks if search returned with a valid result
			{
				$update = "UPDATE user SET status = 'disabled' WHERE username LIKE '".$username."' AND email LIKE '".$email."'";

				if($this->db->simple_query($update))//checks if the update has been implemented
				{
					echo "<br />Update has been completed.<br />";
				}
				else
				{
					echo "<br />Update has encountered an error.<br />";
				}
			}
			else
			{
				echo "<br />Search returned with multiple results. Please try again.<br />";
			}
		}
		else
		{
			echo "<br />Search returned with zero results. Please try again.<br />";
		}
	}

	public function log($admin, $username, $email, $action)
	{
		/*
			logs the changes made into the database
		*/
		$insert = "INSERT INTO account_history(username_user, username_admin, email, action) VALUES ('".$username."','".$admin."','".$email."','".$action."')";
		
		if($this->db->query($insert))//checks if the update has been implemented
		{
			echo "<br />Insert has been completed.<br />";
		}
		else
		{
			echo "<br />Insert has encountered an error.<br />";
		}
	}
}


/* End of file enable_disable_model.php */
/* Location: ./application/models/enable_disable_model.php */