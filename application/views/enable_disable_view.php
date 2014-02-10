<!-- This document is the view of the search module for user accounts-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>ICS Library</title>
		
	</head>

	<body>
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
	          			echo "<table border='1'><tr><th>Username</th><th>First name</th><th>Middle name</th><th>Last name</th><th>Course</th><th>College</th><th>action</th></tr>";
						foreach ($result->result_array() as $row)
						{
							echo "<tr>";
							echo "<td>".$row['username']."</td>";
							echo "<td>".$row['name_first']."</td>";
							echo "<td>".$row['name_middle']."</td>";
							echo "<td>".$row['name_last']."</td>";
							echo "<td>".$row['course']."</td>";
							echo "<td>".$row['college']."</td>";
							echo "<td>";
							switch($row['status'])//creates a button depending on user status
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
		
		<script type = "text/javascript">
			function changeTextBox(value){ // This function checks the value of the text box
				if(value=='name'){
					string = "<input type='text' placeholder='Enter first name' name='firstname'/>";
	            	string+= "<input type='text' placeholder='Enter middle name' name='middlename'/>";
	            	string+= "<input type='text' placeholder='Enter last name' name='lastname'/>";
	            	document.getElementById("divtext").innerHTML = string; 
				}
				else if(value=='stdno'){
					string = "<input type='text' placeholder='Enter student number' name='studentno'/>";
					document.getElementById("divtext").innerHTML = string;
				}
				else if(value=='uname'){
					string = "<input type='text' placeholder='Enter username' name='username'/>";
					document.getElementById("divtext").innerHTML = string;
				}
				else if(value=='email'){
					string = "<input type='text' placeholder='Enter email address' name='emailadd'/>";
					document.getElementById("divtext").innerHTML = string;
				}
			}
		</script>

		<script type="text/javascript">
			
		</script>
	</body>
</html>