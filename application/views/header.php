<?php
/**
 * Created by PhpStorm.
 * User: isnalla
 * Date: 1/15/14
 * Time: 6:47 PM
 */
?>
<html>
<head>
    <title><?php echo $title ?></title>

    <script src="http://localhost/myfirstrepo/jquery-1.11.0.js"></script>
    <script name="input_validation_add">
        var str, msg;
        $(document).ready(function(){

            var columns = $('#table_add_book input');
            columns.on('blur',checkAll);

            checkAll();
        });

        function validateBookNo(){
            str = $('#add_book_no').val();
            msg = "";
            if(str == ""){
                msg+="Book no is required.";
            }//else if(!str.match(/^[+]\([0-9]{12}\)$/) ){
            else if(!str.match(/^[a-zA-Z0-9 ]+$/)){
                msg+="Wrong Input";
            }
            else if(msg == "Invalid input: "){
                msg = "";
            }
            document.getElementsByName("book_no_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;
        }
        function validateTitle(){
            str = $('#add_book_title').val();
            msg = "";
            if(str == ""){
                msg+="Book title is required.";
            }
            else if(!str.match(/^[a-zA-Z0-9 ]+$/)){
                msg+="Wrong Input";
            }
            else if(msg == "Invalid input: "){
                msg = "";
            }
            document.getElementsByName("book_title_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;
        }

        function validateDatePublished(){
            var str = $('#add_date_published').val().toString();
            var currentDate = str.split("-");
            str = new Date(currentDate[0],(currentDate[1] - 1), (currentDate[2]));
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var year = today.getFullYear();
            msg = "";

            if(str.getFullYear()>=year){
                if(str.getMonth()+1 >= mm){
                    if(str.getDate() > dd){
                        msg+="Wrong date.";
                    }
                    else{
                        msg+="Wrong date.";
                    }
                }
            }
            document.getElementsByName("date_published_msg")[0].innerHTML = msg;

            if(msg == ""){
                return true;
            }
            return false;

        }

        function validateName(name){
            //regex for name

            str = $('#add_'+name).val().toString();
            msg = "";

            //write regex here

            if(msg == ""){
                return true;
            }
            return false;
        }

        function validateTags(){
            return true;
        }

        function checkAll(){
            var addButton = $('#add_button');

            if( validateBookNo() && validateTitle() && validateName('author')
                && validateName('publisher')  && validateDatePublished()&& validateTags())
            {
                return true;
            }
            else{
                return false;
            }
        }

    </script>
</head>
<body>
