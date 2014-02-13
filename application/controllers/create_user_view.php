<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Input Forms</title>

		<style type="text/css">

		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body{
			margin: 0 15px 0 15px;
		}
		
		p.footer{
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
		
		#container{
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		</style>
		<script type="text/javascript">
			window.onload=function(){
				

				disablefield();
				document.getElementById('student').onchange = disablefield;
				document.getElementById('employee').onchange = disablefield;

				userForm.username.onblur=validateUsername;
				userForm.password.onblur=validatePassword;
				userForm.email.onblur=validateEmail;
				userForm.emp_no.onblur=validateEmployeeNumber;
				userForm.student_no.onblur=validateStudentNumber;
				userForm.name_first.onblur=validateFirstName;
				userForm.name_middle.onblur=validateMiddleName;
				userForm.name_last.onblur=validateLastName;
				userForm.mobile_no.onblur=validateMobileNumber;
				userForm.onsubmit=validateAll;
			}

			function disablefield()
			{
				if ( document.getElementById('student').checked == true ){
				document.getElementById('emp_no').value = '';
				document.getElementById('emp_no').style.visibility='hidden';
				document.getElementById('student_no').style.visibility='visible';
				document.getElementsByName("spanEmp_no")[0].innerHTML='';
				}

				else if (document.getElementById('employee').checked == true ){		
				document.getElementById('student_no').value = '';
				document.getElementById('student_no').style.visibility='hidden';
				document.getElementById('emp_no').style.visibility='visible';
				document.getElementsByName("spanStudent_no")[0].innerHTML='';
				}
			}

			function validateAll(){
				if( validateUsername()&&
					validatePassword()&&validateEmail()&&
					(validateEmployeeNumber()||lidateStudentNumber())&&
					validateFirstName()&&validateMiddleName()&&
					validateLastName()&&validateMobileNumber()){
					return true;
				}
				else return false;
				<?php echo "error" ?>
			}
			

			function validateUsername(){
				str=userForm.username.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanUsername")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validatePassword(){
				str=userForm.password.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9a-zA-Z]{6,18}$/))  msg+="Must be 6-18 characters long";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanPassword")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validateEmail(){
				str=userForm.email.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanEmail")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validateEmployeeNumber(){
				str=userForm.emp_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{12}$/))  msg+="Input must be 12-digit combination";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanEmp_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}			
			function validateStudentNumber(){
				str=userForm.student_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{4}-[0-9]{5}$/))  msg+="Input format is XXXX-XXXXX";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanStudent_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validateFirstName(){
				str=userForm.name_first.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_first")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validateMiddleName(){
				str=userForm.name_middle.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_middle")[0].innerHTML=msg;

				if(msg=="") return true;
			}
			function validateLastName(){
				str=userForm.name_last.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[\w\-'\s]+$/))  msg+="Invalid Input";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanName_last")[0].innerHTML=msg;

				if(msg=="") return true;
			}

			function validateMobileNumber(){
				str=userForm.mobile_no.value;
				msg="";

				if (str=="") msg+="Required";
				else if (!str.match(/^[0-9]{12}$/))  msg+="The format must be 639XXXXXXXXX";
				else if(msg="Invalid input") msg="";
				document.getElementsByName("spanMobile_no")[0].innerHTML=msg;

				if(msg=="") return true;
			}		

		</script>
	</head>
	
	<body>
		<form name="userForm" action="index.php/controller/page2" method="get" >
			
			<div id="container">
				<h1>Input Forms</h1>

				<div id="body">
					Username: <input type="text" name="username" required/><span name="spanUsername"></span><br/>
					Password: <input type="password" name="password" required/><span name="spanPassword"></span><br/>
					Sex: <input type="radio" name="sex" value="male" id="male" checked/>
						 <label for="male">Male</label>
						 <input type="radio" name="sex" value="female" id="female"/>
						 <label for="female">Female</label><br/>

					Email: <input type="text" name="email" required/><span name="spanEmail"></span><br/>
					User Type: <input type="radio" name="usertype" value="student" id="student" checked/>
						 <label for="student">Student</label>
						 <input type="radio" name="usertype" value="employee" id="employee" />
						 <label for="employee">Employee</label><br/>
					Employee Number:<input type="text" name="emp_no" id="emp_no" /><span name="spanEmp_no"></span><br/>
					Student Number: <input type="text" name="student_no" id="student_no" /><span name="spanStudent_no"></span><br/>
					First Name: <input type="text" name="name_first" required/><span name="spanName_first"></span><br/>
					Middle Name: <input type="text" name="name_middle" required/><span name="spanName_middle"></span><br/>
					Last Name: <input type="text" name="name_last" required/><span name="spanName_last"></span><br/>
					Mobile Number: <input type="text" name="mobile_no" required /><span name="spanMobile_no"></span><br/>

					

					College: 
					<select name="college">						
						<option value="CA">CA (College of Agriculture)</option>
						<option value="CAS">CAS (College of Arts and Sciences)</option> 
						<option value="CDC">CDC (College of Development Communication)</option>
						<option value="CEM">CEM (College of Economics and Management)</option>
						<option value="CEAT">CEAT (College of Engineering and Agro-Industrial Technology)</option>
						<option value="CFNR">CFNR (College of Forestry and Natural Resources)</option>	
						<option value="CHE">CHE (College of Human Ecology)</option>	
						<option value="CVM">CVM (College of Veterinary Medicine)</option>
					</select>
					Course:
					<select name="course">
						<option value="BSAM">BS Agribusiness Management</option>
						<option value="BSAE">BS Agricultural and Biosystems Engineering</option>
						<option value="BSAC">BS Agricultural Chemistry</option>	
						<option value="BSAE">BS Agricultural Economics</option>
						<option value="BSA">BS Agriculture</option>
						<option value="BSAM">BS Applied Mathematics</option>
						<option value="BSAP">BS Applied Physics</option>
						<option value="BSB">BS Biology</option>
						<option value="BSChE">BS Chemical Engineering</option>
						<option value="BSC">BS Chemistry</option>
						<option value="BSCE">BS Civil Engineering</option>
						<option value="BSAC">BA Communication Arts</option>
						<option value="BSCS">BS Computer Science</option>
						<option value="BSDC">BS Development Communication</option>
						<option value="BSE">BS Economics</option>
						<option value="BSEE">BS Electrical Engineering</option>
						<option value="BSF">BS Forestry</option>
						<option value="BSHE">BS Human Ecology</option>
						<option value="BSIE">BS Industrial Engineering</option>
						<option value="BSM">BS Mathematics</option>
						<option value="BSMST">BS Mathematics and Science Teaching</option>
						<option value="BSN">BS Nutrition</option>
						<option value="BAP">BA Philosophy</option>
						<option value="BAS">BA Sociology</option>						
						<option value="BSS">BS Statistics</option>
						<option value="BSVM">BS Vetererary Medicine</option>
					</select></br>

					<input type="Submit" value="Submit" />
				</div>

				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
			</div>
		</form>
	</body>
</html>