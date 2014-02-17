<?php 
	  //Author: Cyril Bravo
	  //Description: This document is the actual view of enable/disable
?>
		<div id="container">
			<h1>ICS Library</h1>
		  	<div id="body">
		  		<?php echo form_open('enable_disable/search'); //creates a form?>
			  		<select name="field" onchange='changeTextBox(value)'>
						<option value="name">Name</option>
						<option value="stdno">Student Number</option>
						<option value="uname">Username</option>
						<option value="email">Email Address</option>
					</select>
					<div id="divtext">
	            		<input type="text" placeholder="Enter first name" name="firstname"/>
	            		<input type="text" placeholder="Enter middle name" name="middlename"/>
	            		<input type="text" placeholder="Enter last name" name="lastname"/>
	            	</div>
	            	</br><input type = "radio" name = "status" value = "all" checked = "true"/>All
	            	<input type = "radio" name = "status" value = "pending"/>Pending
	            	<input type = "radio" name = "status" value = "enabled"/>Enabled
	            	<input type = "radio" name = "status" value = "disabled"/>Disabled

	            	</br><button type="submit" id="submitButton"> Search </button>
          	</div>
          	<div id="result">
          		<?php
          			if(isset($result))//checks if $result not null
          			{
	          			echo "<table border='1'><tr><th>Username</th><th>Email</th><th>First name</th><th>Middle name</th><th>Last name</th><th>Course</th><th>College</th><th>action</th></tr>";
						foreach ($result as $row)
						{
							echo "<tr>";
							echo "<td>".$row->username."</td>";
							echo "<td>".$row->email."</td>";
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
									echo  "<input type='button' value='Activate' class='Activate_button' username='{$row->username}' student_no='{$row->student_no}' email='{$row->email}'/>";//creates a button named activate
									break;
								}
								case "enabled":
								{
									echo "<input type='button' value='Disable' class='Disable_button' username='{$row->username}' student_no='{$row->student_no}' email='{$row->email}'/>";//creates a button named disable
									break;
								}
								case "disabled":
								{
									echo "<input type='button' value='Enable' class='Enable_button' username='{$row->username}' student_no='{$row->student_no}' email='{$row->email}'/>";//creates a button named enable
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

			//Script Author : Cyril Justine D. Bravo
			//Description : a JQuery script that changes the field/s depending on the search category

			function changeTextBox(value){ 
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
			//Script Author : Carl Adrian P. Castueras
			//Description : AJAX functions used for to call the activate,enable and disable controllers and then update the page dynamically
	
			function activate_handler()
			{
				$this = $(this);
				var username = $(this).attr('username');
				var student_no = $(this).attr('student_no');
				var email = $(this).attr('email');
				var constr = "Are you sure you want to Activate?\nUsername: "+username+"\nStudent Number: "+student_no+"\nE-mail: "+email;
				if(confirm(constr))
				{
					$.ajax({
						url : "http://localhost/mysecondrepo/index.php/enable_disable/activate/"+ username +"/"+ student_no + "/" + email,
						type : 'POST',
						dataType : "html",
						async : true,
						success: function(data) {
							
							$this.val("Disable");
							$this.off("click").on("click",disable_handler);
							$this.removeClass("Activate_button").addClass("Disable_button");
						}
					});
				}
			}

			function disable_handler()
			{
				$this = $(this);
				var username = $(this).attr('username');
				var student_no = $(this).attr('student_no');
				var email = $(this).attr('email');
				var constr = "Are you sure you want to Disable?\nUsername: "+username+"\nStudent Number: "+student_no+"\nE-mail: "+email;
				if(confirm(constr))
				{
					$.ajax({
						url : "http://localhost/mysecondrepo/index.php/enable_disable/disable/"+ username +"/"+ student_no + "/" + email,
						type : 'POST',
						dataType : "html",
						async : true,
						success: function(data) {
							$this.val("Enable");
							$this.off("click").on("click",enable_handler);
							$this.removeClass("Disable_button").addClass("Enable_button");
						}
					});
				}
			}

			function enable_handler()
			{
				$this = $(this);
				var username = $(this).attr('username');
				var student_no = $(this).attr('student_no');
				var email = $(this).attr('email');
				var constr = "Are you sure you want to Enable?\nUsername: "+username+"\nStudent Number: "+student_no+"\nE-mail: "+email;
				if(confirm(constr))
				{
					$.ajax({
						url : "http://localhost/mysecondrepo/index.php/enable_disable/enable/"+ username +"/"+ student_no + "/" + email,
						type : 'POST',
						dataType : "html",
						async : true,
						success: function(data) {
							$this.val("Disable");
							$this.off("click").on("click",disable_handler);
							$this.removeClass("Enable_button").addClass("Disable_button");
						}
					});
				}
			}

			//bind the corresponding functions to the click events of the appropriate buttons
			$('.Activate_button').on("click",activate_handler);
			$('.Enable_button').on("click",enable_handler);
			$('.Disable_button').on("click",disable_handler);
				
		</script>
<?php //end of file enable_disable_view ?>
