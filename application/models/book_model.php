<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model {

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
        parent::__construct();
        $this->load->database();
    }

    function insertBook($data){
        $date_pub = $data['date_published'];
        $query = "INSERT INTO book (book_no,book_title,description,publisher,tags,date_published)".
                " VALUES ('{$data['book_no']}'".
                ",'{$data['book_title']}'".
                ",'{$data['description']}'".
                ",'{$data['publisher']}'".
                ",'{$data['tags']}'".
                ",".($date_pub==''?'null':("'".$date_pub."'")).")";

        $this->db->query($query);

        $this->db->query("INSERT INTO author (book_no,name) VALUES ('{$data['book_no']}','{$data['author']}')");
    }

    function editBook($data){
        /*
         *
         * SANITATION GOES HERE
         *
         */

        $data['prev_book_no'] = $data['book_no'];//temporary
        $date_pub = $data['date_published'];
        $query = "UPDATE book SET book_no='".$data['book_no']."'".
                                ",book_title='".$data['book_title']."'".
                                ",status='".$data['status']."'".
                                ",description='".$data['description']."'".
                                " ,publisher='".$data['publisher']."'".
                                ",tags='".$data['tags']."'".
                                ",date_published=".($date_pub==''?'null':("'".$date_pub."'")).
                                " WHERE book_no='".$data['prev_book_no']."'";

        $this->db->query($query);
        //update author;
        $this->db->query("UPDATE author SET name='{$data['author']}' WHERE book_no='{$data['book_no']}'");
    }

 
    function delBook($book_no){
        $this->db->query("DELETE FROM book WHERE book_no='{$book_no}'");
    }

}






/* End of file booker.php */
/* Location: ./application/controllers/booker.php */