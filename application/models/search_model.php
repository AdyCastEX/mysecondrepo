<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

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

    function query_result($details){
        $details['search_term'] = filter_var($details['search_term'], FILTER_SANITIZE_STRING);

        $tok = explode(" ", $details['search_term']);
        
        $q = array(
                'select' => "select * from book b, author a ",
                'where' => " where " . $details['status_check'] . " b.book_no = a.book_no ",
                'orderby' => "order by " . $details['order_by']
        );

        $word_count = 0;
        if (trim($details['search_term']) != ""){
            $q['where'] .= " and (";
            foreach ($tok as $search) {
                // echo $search."<br>";
                if (trim($search)=='') continue;
                if($word_count > 0) $q['where'] .= " or ";

                if($details['search_by']== 'book_title'){
                   $q['where'] .= "book_title like '%" . $search . "%' or description like '%" . $search . "%' or Tags like '%" . $search . "%' ";
                } else {
                    $q['where'] .= $details['search_by'] . " like '%".$search."%' ";
                }
               

                $word_count++;
            }
            $q['where'] .= ") ";
        }        


        //if admin did not enter any search terms
        if ($details['is_admin'] ){
            if ($details['order_by'] == 'search_relevance'){
                if (trim($details['search_term']) == ""){
                    $q['orderby'] = ' order by a.book_no';
                } else {
                    $q['orderby'] = "";
                }
            }
        }

        $query_string = $q['select'] . $q['where'] .= $q['orderby'];
        // echo $query_string;
        return $this->db->query($query_string)->result();
    }
}






/* End of file search_model.php */
/* Location: ./application/controllers/search_model.php */