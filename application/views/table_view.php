<div id="search_table_container">
                <table id="search_table" border="1" width='60%'>
                    <?php
                        // $is_admin = true; //temporary

                        //new
                        if(isset($table)){
                            echo "<tr >
                                <th width='10%'>Book No.    </th>
                                <th width='40%'>Book        </th>
                                <th width='15%'>Publishment </th>
                            ";
                            if ($is_admin) echo "<th width='10%'>Tags</th>";

                     
                            echo "</tr>";

                            foreach($table as $row):
                                echo "<tr>";                               
                                echo "<td book_data='book_no'  align='center'>" . $row->book_no . "</td>";
                                echo "<td>" .
                                        "<div style = 'font:20px Verdana'  book_data='book_title'>" . 
                                            $row->book_title . 
                                        "</div>" . 
                                        
                                        "<div style = 'font-size:17px'  book_data='description'> " . 
                                            $row->description   . "<br>" .  
                                        "</div>" . 

                                        "<div style = 'font-size:13px' book_data='author'><em> " . 
                                            $row->name . "<br>" .
                                        "</em></div>";


                                        if ($is_admin){  //--------------- ADMIN ACTIONS ----------------\\
                                            
                                            // Edit , Delete Button
                                            echo "<span><a href='#' bookno='{$row->book_no}' class='edit_button'>Edit</a></span>&nbsp&nbsp&nbsp";
                                            echo "<span><a href='#' bookno='{$row->book_no}' class='delete_button'>Delet]e</a></span>&nbsp | &nbsp";
                                            echo "<span><a ";

                                            // Lend , Return Button
                                            if ($row->status == "reserved")  echo "bookno='{$row->book_no}' class='lendButton' >Lend</a>";
                                            elseif ($row->status == "borrowed") echo "bookno='{$row->book_no}' class = 'receivedButton'>Return</a>";
                                            else echo "'>(" . $row->status . ")";

                                            echo "</span>";

                                            
                                        } else { //--------------- USER ACTIONS ----------------\\
                                            
                                            //like button
                                            echo
                                            "<span>" .
                                                "<a href='#' book_no='" . $row->book_no . "'>Favorite</a>&nbsp;&nbsp;" . //condition is to be added here
                                            "</span>" .

                                            //reserve button
                                            "<span>" .
                                                "<a ";

                                                if ($row->status == "available") echo "href='#' bookno='{$row->book_no}'>Reserve";
                                                else echo ">(" . $row->status . ")";

                                                echo "</a>" .
                                            "</span>";
                                        }


                                     "</td>";

                                    //other data
                                echo "<td align='center'>" . 
                                         "<div book_data='publisher'>" . $row->publisher . "</div>" .
                                         "<div book_data='date_published'>" . $row->date_published . "</div>" .
                                     "</td>";

                                if ($is_admin) echo "<td book_data='Tags'>" . $row->Tags . "</td>";


                               
                                echo "</tr>";
                            endforeach;
                        } else  {
                            if (isset($search_submitted)) echo "No results to display";
                        }

                    ?>

</table>
</div>
<script> // Edzer Padilla
 $('.lendButton').on('click', lendClick);
 $('.receivedButton').on('click', receivedClick);

function lendClick(){
    $this = $(this);
    $bookno = $this.attr('bookno');
    $bookauthor = $this.closest('td').find('[book_data = author]').text()
    $booktitle = $this.closest('td').find('[book_data = book_title]').text()
    if (confirm('Are you sure you want to lend: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {    
        alert($bookno);
         $.ajax({
            url: 'index.php/update_book/lend/',
            data: {id:$bookno},
            success: function(data) { 
                $this.text('Return');
                $this.off('click').on('click', receivedClick);            }
        });      

    } else {
    // Do nothing!
    }

}

 function receivedClick(){
    $this = $(this);
    $bookno = $this.attr('bookno');
    $bookauthor = $this.closest('td').find('[book_data = author]').text()
    $booktitle = $this.closest('td').find('[book_data = book_title]').text()
     if (confirm('Are you sure you want to return: \n'+$booktitle+'\n'+$bookno+'\n'+$bookauthor+"?")) {
         $.ajax({
            url: 'index.php/update_book/received/',
            data: {id:$bookno},
            success: function(data) { 
                $this.text('(available)');
                $this.off('click');
           // $this.addClass('lendButton'); 
            }
        });        
    } else {
    // Do nothing!
    }
 } 
</script>

