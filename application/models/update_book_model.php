<?php 

Class Update_book_model extends CI_Model{
	
	function lend($data){

		$parameter = array('status' => 'borrowed'); // values we update in this case: status to borrowed
		$where = "book_no = '{$data['book_no']}'"; // where clause 
		$this->db->update('book', $parameter, $where);// 1st parameter : table name, 2nd : values to change, 3d where clause

	}

	function received($data){
	
		$parameter = array('status' => 'available'); // value to be updated; status to available
		$where = "book_no = '{$data['book_no']}'";	 // where clause
		$this->db->update('book', $parameter, $where); // 1st parameter : table name, 2nd : values to change, 3d where clause
	}

	
	function insertLend($data){
	$parameter = array(                                 // these are the data we would like to insert into our log- lend
               'book_no' => "{$data['book_no']}",
               'username_user' => "{$data['username_user']}",
               'email' => "{$data['email']}",
               'username_admin' => "{$data['username_admin']}"
            );
	$this->db->insert('lend', $parameter);   // insert query accepts 2 parameters. the table name and the parameters or values to be inserted

	}

	function updateLend($data){
		date_default_timezone_set("Asia/Manila");
		$parameter = array('date_returned' => date('Y-m-d H:i:s'));// in update lend, we only need to insert the returned date, hence the use of now()	
		$where = "transaction_no = {$data['transaction_no']}"; // where clause
		$this->db->update('lend', $parameter, $where); // the update query accepts 3 parameters, the table name, values to be updated and the where clause
		echo $this->db->update_string('lend', $parameter, $where);
		echo "SUUUUUUUUUUCCCCCCCCCCCCCCCCCCCCEEEEEEEEEEEEEEESSSSSSSSSSSSs";
	}
	function getTransactionno($data){
		$q = $this->db->query("SELECT transaction_no FROM lend WHERE
				book_no = '{$data}' and date_returned IS NULL ");			
		$row = $q->row();
	return $row->transaction_no;
	}

}
