			<div id="search"><br>

				<form name="search_form" method="post">


					<?php
						if ($is_admin){
							echo '
							<div id="status">
								<input id = "available" type="checkbox" name = "available" checked>
								<label for="available">Available</label><br/>
								<input id = "reserved" type="checkbox" name = "reserved" checked>
								<label for="reserved">Reserved</label><br/>
								<input id = "borrowed" type="checkbox" name = "borrowed" checked>
								<label for="borrowed">Borrowed</label><br/><br/>
							</div>
							';
						}
					?>

					<a>Search by:</a>
					<select name="search_by">
						<option value="book_title">Title / Description</option>
						<option value="book_no"> Book Number </option>
						<option value="status"> Status </option>
						<option value="publisher"> Publisher</option>
						<option value="name"> Author</option>
						<option value="date_published"> Date Published</option>
					</select>

					<input type="text" name='search' placeholder='Keywords...'/>
					<input type="submit" name="submit_search" value="Search" /><br/>

					<?php
						if ($is_admin){
							echo '
							<a>Order by:</a>
							<select name="order_by">
								<option value="search_relevance"> Search Relevance </option>
								<option value="book_no"> Book Number </option>
								<option value="book_title"> Title </option>
								<option value="status"> Status </option>
								<option value="description"> Description </option>
								<option value="publisher"> Publisher</option>
								<option value="name"> Author</option>
								<option value="date_published"> Date Published</option>
							</select><br/><br/>
							';
						}
					?>
				</form>
			</div>