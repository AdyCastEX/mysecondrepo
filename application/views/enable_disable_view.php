<?php //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable?>
		<div id="container">
			<h1>ICS Library</h1>
		  	<div id="body">
		  		<?php //echo form_open('enable_disable/search'); //creates a form?>
			  		<select name="field" onchange='changeTextBox(value)'>
						<option value="name">Name</option>
						<option value="stdno">Student Number</option>
						<option value="uname">Username</option>
						<option value="email">Email Address</option>
					</select>
					<div id="divtext">
	            		<input type="text" placeholder="Enter first name" name="firstname" id="enterFname"/>
	            		<input type="text" placeholder="Enter middle name" name="middlename" id="enterMname"/>
	            		<input type="text" placeholder="Enter last name" name="lastname" id="enterLname"/>
	            	</div>
	            	</br><input type = "radio" name = "status" value = "all" checked = "true"/>All
	            	<input type = "radio" name = "status" value = "pending"/>Pending
	            	<input type = "radio" name = "status" value = "enabled"/>Enabled
	            	<input type = "radio" name = "status" value = "disabled"/>Disabled

	            	</br><button type="button" id="submitButton"> Search </button>
          	</div>
          	<div id="result">
          		<?php
          			if(isset($result))//checks if $result not null
          			{
	          			echo "<table border='1'><tr><th>Username</th><th>First name</th><th>Middle name</th><th>Last name</th><th>Course</th><th>College</th><th>action</th></tr>";
						foreach ($result as $row)
						{
							echo "<tr>";
							echo "<td>".$row->username."</td>";
							echo "<td>".$row->name_first."</td>";
							echo "<td>".$row->name_middle."</td>";
							echo "<td>".$row->name_last."</td>";
							echo "<td>".$row->course."</td>";
							echo "<td>".$row->college."</td>";
							echo "<td>";
							switch($row->status)//creates a button depending on user status
							{
								case "pending":
								{
									echo form_button('activate','Activate');//creates a button named activate
									break;
								}
								case "enabled":
								{
									echo form_button('disable','Disable');//creates a button named disable
									break;
								}
								case "disabled":
								{
									echo form_button('enable','Enable');//creates a button named enable
									break;
								}
							}
							echo "</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
				?>
          	</div>
		</div>
		<script type="text/javascript" src = "http://localhost/mysecondrepo/jquery-1.11.0.js"></script>
		<script type = "text/javascript">
			function changeTextBox(value){ // This function changes the field/s depending on the search category
				if(value=='name'){
					string = "<input id='enterFname'/> <input id='enterMname'/> <input id='enterLname'/>"; //creates 3 fields for name
	            	$('#divtext').html(string); // innerhtml equivalent in jquery
	            	$('#divtext #enterFname').attr({ // set attributes for name
 						'name': 'firstname',
 						'type': 'text',
 						'placeholder': 'Enter first name'
 					});
	            	$('#divtext #enterMname').attr({
 						'name': 'middlename',
 						'type': 'text',
 						'placeholder': 'Enter middle name'
 					});
	            	$('#divtext #enterLname').attr({
 						'name': 'lastname',
 						'type': 'text',
 						'placeholder': 'Enter last name'
 					});
				}
				else if(value=='stdno'){
					string = "<input id='enterStdno'/>"; //creates field for studno
	            	$('#divtext').html(string);
	            	$('#divtext #enterStdno').attr({ // set attributes for studno
 						'name': 'studentno',
 						'type': 'text',
 						'placeholder': 'Enter student number'
 					});
				}
				else if(value=='uname'){
					string = "<input id='enterUname'/>"; //creates field for username
	            	$('#divtext').html(string);
	            	$('#divtext #enterUname').attr({ // set attributes for username
 						'name': 'username',
 						'type': 'text',
 						'placeholder': 'Enter username'
 					});
				}
				else if(value=='email'){
					string = "<input id='enterEmail'/>"; //creates field for email
	            	$('#divtext').html(string);
	            	$('#divtext #enterEmail').attr({ // set attributes for email
 						'name': 'emailadd',
 						'type': 'text',
 						'placeholder': 'Enter email address'
 					});
				}
			}
		</script>

		<script type="text/javascript">
			
			$('#submitButton').click(
			


			function search_user()
			{
				var search_category = $('select[name=field]').val();

				var json_data;
				switch(search_category){
					//create a JSON object to be passed to the AJAX call with the appropriate attributes
					case "name" : 
						json_data = {

							'field' : 'name',
							'firstname' : $('#enterFname').val(),
							'middlename' : $('#enterMname').val(),
							'lastname' : $('#enterLname').val() 
						};
						break;
					case "stdno" :
						json_data = {
							'field' : 'stdno',
							'studentno' : $('#enterStdno').val()
						};
						break;
					case "uname" :
						json_data = {
							'field' : 'uname',
							'username' : $('#enterUname').val()
						};
						break;
					case "email" :
						json_data = {
							'field' : 'email',
							'emailadd' : $('#enterEmail').val()
						};	
						break;
					default :  
						json_data = {

							'field' : 'name',
							'firstname' : $('#enterFname').val(),
							'middlename' : $('#enterMname').val(),
							'lastname' : $('#enterLname').val() 
						};
				}

				//console.log(json_data);

				$.ajax({
					url : 'http://localhost/mysecondrepo/index.php/enable_disable/search', 
					type : 'POST',
					dataType : "json",
					data : json_data,
					async : true,
					success: function(data) {
						
						
						var json_array = data;
						//var array_json = $.parseJSON(json_array);
						console.log(json_array);
						$('#result').append('<table id="result_table"></table>');

						$.each(json_array, function(){
							$('#result_table').append('<tr class="row"></tr>')
							$('.row').append('<td>' +this.username+ '</td><td>' +this.name_first+ '</td><td>' +this.name_middle+ '</td><td>' +this.name_last+ '</td><td>' +this.course+ '</td><td>' +this.college+ '</td><td>' +this.status+ '</td>');
	
							$('.row').append('<td><input type="button" value="Some Button" /></td>')
						});

						
					}
				});
			});

		</script>
<?php //end of file enable_disable_view ?>