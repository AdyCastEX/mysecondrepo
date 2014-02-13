<hr>
<h4>ADD BOOK</h4>
<form autocomplete="on" id="add_book_form">
    <table id="add_book_table">
        <tr>
            <th>Book No.	</th>
            <th>Book Title 	</th>
            <th>Author 		</th>
            <th>Description </th>
            <th>Publisher 	</th>
            <th>Publish Date</th>
            <th>Tags 		</th>
        </tr>
        <tr>
            <td><input type="text" name="book_no" id="add_book_no" required/></td>
            <td><input type="text" name="book_title" id="add_book_title" required/></td>
            <td><input type="text" name="author" id="add_author" /></td>
            <td><textarea name="description" id="add_description" ></textarea></td>
            <td><input type="text" name="publisher" id="add_publisher" /></td>
            <td><input type="date" name="date_published" id="add_date_published"/></td>
            <td><input type="text" name="tags" id="add_tags"/></td>
            <td><button type="submit" name="add_button" id="add_button">Add Button</button></td>
        </tr>
        <tr>
            <td><span name = "book_no_msg"></span></span></td>
            <td> <span name = "book_title_msg"></span></td>
            <td> <span name = "author_msg"></span></td>
            <td> <span name = "description_msg"></span></td>
            <td> <span name = "publisher_msg"></span></td>
            <td> <span name = "date_published_msg"></span></td>
            <td> <span name = "tags_msg"></span></td>
        </tr>
    </table>
</form>
<hr/>
<h4>EDIT BOOK</h4>
<form name="edit_book" method="post">
    <fieldset>
        <legend>Personal Information</legend>

        <label for="book_no">Book No: </label>
        <input type="text" name="book_no" id="book_no" /><span name="help_book_no"> </span>
        </br>
        <label for="book_title">Book Title: </label>
        <input type="text" name="book_title" id="book_title" /><span name="help_book_title"> </span>
        </br>

        <label for="book_status">Book Status: </label>
        <select name="book_status" id="book_status">
            <option value = "available"> Available </option>
            <option value = "reserved"> Reserved </option>
            <option value = "borrowed"> Borrowed </option>
        </select>
        <span name="help_book_status"> </span>
        <br />

        <label for="description">Book Description: </label></br>
        <textarea name="description" id="edit_description"size=50 maxlength=255></textarea><span name="help_book_description"> </span><br />

        <label for="publisher">Book Publisher: </label>
        <input type="text" name="publisher" id="edit_publisher" /><span name="help_book_publisher"> </span><br />

        <label for="author">Book Author: </label>
        <input type="text" name="author" id="edit_author" /><span name="help_book_author"> </span>
        </br>
        Tags:
        <input type="text" name="tags" /><span name="help_tags"></span><br/>
        Date Published:
        <input type="date" name="date_published" /> <span name="help_date_published"> </span>
        <br/>
        <input type="submit" id="submit_edit" name="submit_edit"/>
    </fieldset>
</form>