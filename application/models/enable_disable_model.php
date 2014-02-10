<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Class for queries and database management
*/
class Enable_disable_model extends CI_Model {

	public function generateQuery($field)
	{
		$sql = "SELECT * FROM user" ; //string for query

		Switch($field['field'])
		{
			Case "name" : {
				$sql = $sql." WHERE name_first LIKE '".$field['fname']."' OR name_middle LIKE '".$field['mname']."' OR name_last LIKE '".$field['lname']."'";
				break;
			}
			Case "stdno" : {
				$sql = $sql." WHERE student_no LIKE '".$field['student_no']."'";
				break;
			}
			Case "uname" : {
				$sql = $sql." WHERE username LIKE '".$field['username']."'";
				break;
			}
			Case "email" : {
				$sql = $sql." WHERE email LIKE '".$field['email']."'";
				break;
			}
		}		

		if($field['status'] != "all")
			$sql = $sql." AND status LIKE '".$field['status']."'";

		$sql = $sql." GROUP BY usertype,sex";

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
				$data[] = $row;
			}
			return $data;
		}
	}

	public function activate($username, $student_no, $email)
	{
		/*
			this function validates and activates accounts
		*/

		$sql = "SELECT * FROM our_data WHERE student_no LIKE '".$student_no."'";

		$array = $this->db->query($sql);//checks the our_data for a student

		if ($array->num_rows() > 0)//checks if search returned with any results
		{
			if ($array->num_rows() == 1)//checks if search returned with a valid result
			{
				$update = "UPDATE user SET('status' = enabled) WHERE username LIKE '".$username."' AND email LIKE '".$email."'";

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

	public function enable($username, $email)
	{
		/*
			this function validates and activates accounts
		*/
		$update = "UPDATE user SET('status' = enabled) WHERE username LIKE '".$username."' AND email LIKE '".$email."'";
		
		if($this->db->simple_query($update))//checks if the update has been implemented
		{
			echo "<br />Update has been completed.<br />";
		}
		else
		{
			echo "<br />Update has encountered an error.<br />";
		}
	}

	public function disabled($username, $student_no, $email)
	{
		/*
			this function validates and activates accounts
		*/

		$sql = "SELECT * FROM our_data WHERE student_no LIKE '".$student_no."'";

		$array = $this->db->query($sql);//checks the our_data for a student

		if ($array->num_rows() > 0)//checks if search returned with any result
		{
			if ($array->num_rows() == 1)//checks if search returned with a valid result
			{
				$update = "UPDATE user SET('status' = disabled) WHERE username LIKE '".$username."' AND email LIKE '".$email."'";

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
		$time = "M d, Y H:i:s";

		$insert = "INSERT INTO account_history(username_user, username_admin, email, action) VALUES ('".$username."','".$admin."','".$email."','".$action."'";
		
		if($this->db->simple_query($insert))//checks if the update has been implemented
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