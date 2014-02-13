<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
    function Welcome(){
        parent::__construct();

        $this->load->model('book_model');
    }
    public function index()
    {
        $data['title'] = "Sample";
        $data['query'] = $this->db->get('book');
        $data['table'] = $this->search();
        $this->load->view('search_view',$data);
        $this->load->view('manage_view');
    }

    public function search(){
        //set defaults
        $search_term = "";
        $search_by = "book_title";
        $order_by = "a.book_no";
        $status_check = "status='available' or status='borrowed' or status='reserved'";

        if (isset($_POST["submit"])){
            //get user input
            $search_term = $_POST['search'];
            $search_by = $_POST['search_by'];
            $order_by = $_POST['order_by'];

            //filter by book status
            if (!isset($_POST["available"])) $status_check = str_replace("status='available' or ","",$status_check);
            if (!isset($_POST["borrowed"])) $status_check = str_replace("status='borrowed' or ","",$status_check);
            if (!isset($_POST["reserved"])){
                $status_check = str_replace(" or status='reserved'","",$status_check);
                $status_check = str_replace("status='reserved'","",$status_check);
            }

            if($search_by == "book_no")	$search_by = "a.book_no";
            if($order_by == "book_no") $order_by = "a.book_no";
        }


        if($status_check!="") $status_check = "(" . $status_check . ") and";


        $details = array(
            'search_term' 	=> $search_term,
            'search_by' 	=> $search_by,
            'order_by' 		=> $order_by,
            'status_check' 	=> $status_check
        );


        return $this->book_model->query_result($details);
    }
}




/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */