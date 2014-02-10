<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 2/3/14
 * Time: 4:55 PM
 */
?>
<script>
    $(document).ready(function(){

        //delete button
        $('.delete_button').on('click',function(){
            var result = confirm("Confirm deleting this book");
            if (result==true) {
                var bookNo = $(this).attr('bookno');
                $(this).closest('tr').remove();
                $.post('index.php/booker/delete',{book_no:bookNo},function(data){
                    //callback function for delete
                });
            }
        });

        function addBook(event){
            event.preventDefault();  /* stop form from submitting normally */

            if(checkAll()){
                var date = $('#add_date_published').val();
                var data = {
                    book_no : $('#add_book_no').val(),
                    book_title : $('#add_book_title').val(),
                    description : $('#add_description').val(),
                    publisher : $('#add_publisher').val(),
                    date_published : date,
                    tags : $('#add_tags').val(),
                    author : $('#add_author').val()
                };

                $.post("index.php/booker/add",$('#add_book_form').serialize(),function(data){});
                $('#add_book_form')[0].reset();
            }
        }

        $('#add_book_form').submit(addBook);

        $('.edit').on('click',function(event){
            var row = $(this).closest('tr').children();

            row[0].innerHTML = inputify('book_no',row[0].innerHTML);
            row[1].innerHTML = inputify('book_title',row[1].innerHTML);
            row[2].innerHTML = selectify('book_status',row[2].innerHTML);
            row[3].innerHTML = inputify('description',row[3].innerHTML);
            row[4].innerHTML = inputify('publisher',row[4].innerHTML);
            row[5].innerHTML = datify('date_published',row[5].innerHTML);
            row[6].innerHTML = inputify('tags',row[6].innerHTML);

        });

        function datify(id,value){
            console.log(value);
            var str = '<input type="date" id="edit_'+id+'" value="'+value+'"/>';
            console.log(str);
            return str;
        }

        function selectify(id,selected){
            var str = '<select id="edit_book_status"> <option value="available" '+isSelected('available',selected)+'>available</option>'+
                ' <option value="reserved" '+isSelected('reserved',selected)+'>reserved</option> '+
                '<option value="borrowed" '+isSelected('borrowed',selected)+'>borrowed</option> </select>';

            return str;
        }

        function isSelected(value,inputVal){
            if(value == inputVal) return 'selected';
            else return '';

        }

        function inputify(id,value){
            if(value == undefined) value = "";
            return '<input type="text" id="edit_'+id+'" value="'+value+'" />';
        }
    });
</script>
</body>
</html>