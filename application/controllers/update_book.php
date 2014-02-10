<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_book extends CI_Controller {


	public function index()
	{
		echo "hello";
	}
	public function lend(){
		echo "tada";
		$data['book_no'] = $_GET['id']; 
		$this->load->model('reserve_model');
		$this->reserve_model->dequeue($data['book_no']);
		// get from ajax
		$data['username_user'] = "edzerium";
		$data['email'] = "dzerium@gmail.com";
		$data['username_admin'] = "admin";
		$data['transaction_no'] = "transaction no";
		$this->load->model('update_book_model');		//loading of the updateBook_model

	//	$this->update_book_model->lend($data);              //we call the lend function which updates the status of the book from reserved to borrowed
	//	$this->update_book_model->insertLend($data);			//we call this function to insert into the log the whole transaction
	//	$this->load->view('confirmation_view');				// this is not yet finish


	//	$this->index(); 	 			// returns to the indexpage of the controller in the actual implementation, this should return to the search results
	}
	public function received(){
	
		$data['book_no'] = $_GET['id'];   // temporary data. actual data must be pass via onClick in the actual implementation
		$data['status'] = "borrowed";

		$this->load->model('update_book_model');		// loads the updateBook_model
		$data['transaction_no'] = $this->update_book_model->getTransactionno($data['book_no']);
		$this->update_book_model->received($data);	// updates the status of the book from borrowed to available
		$this->update_book_model->updateLend($data);	// writes the whole transaction into log
		
	}


}