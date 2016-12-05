<?php

		require_once('../admin-login/functions.php');
	if(!loggedinAdmin())
		header("Location: ../admin-login/login.php");
	else if($_SESSION['usernameAdmin'] !== 'admin')
		header("Location: ../admin-login/login.php");
	else
		include('../header1.php');
		connectdb();
?>              
              
              <li class="dropdown">
			   <a class="dropdown-toggle" data-toggle="dropdown" href="#">Schedule
			   <span class="caret"></span></a>
			      <ul class="dropdown-menu">
				      <li><a href="Test Schedule/testschedule/schedule.php">Code Test</a></li>
					  <li><a href="">MCQ Test</a></li>
				  </ul>
			  </li>
              <li><a href="candidate_management/candidate_management.php">Candidate Management</a></li>
              <li><a href="">Reports</a></li>
              <li><a href="">Profile</a></li>
			  <li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Code Test
			   <span class="caret"></span></a>
			      <ul class="dropdown-menu">
					<li><a href="admin-login/problems.php">Create Problem</a></li>
					<li><a href="scheduling_a_code_test/scheduling_a_code_test.php">Create Test</a></li>
				  </ul>
			  </li>
			  <li><a href="mcqModule/admin.php">MCQ Test</a></li>
			  <li><a href="database_page/searchdetails.php">Database</a></li>
			  <li><a href="email_group/emailgroup.php">Create Email Group</a></li>
			  <li><a href="admin-login/logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<center>
	<h2>&nbsp;&nbsp;&nbsp;&nbsp;Manage Candidate</h2>
	<br><br>
	
	  
		 <script>
		    function fun_div1()
			{
				document.getElementById('div2').innerHTML = "";
			     document.getElementById('div1').innerHTML = "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = 'text' name = 'new_password' id = 'new_password' style='height:25px'> <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Re-Type Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = 'text' name = 're_password' id = 're_password' style='height:25px'> <br> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type = 'submit' name = 'new_pswd_submit' id ='new_pswd_submit' class = 'btn btn-default'> CHANGE </button>";
			}
		 </script>
	
	 
        
	    <form  method = "post" >
		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Email: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <input type = "text" name = "s_email" id = "s_email" value = '<?php  if(!empty($_POST['s_email'])) echo $_POST['s_email'];?>' style="height:25px"> 
			 <br><br>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Number:&nbsp;&nbsp; <input type = "text" name ="r_number" id = "r_number" value = '<?php  if(isset($_POST['r_number'])) echo $_POST['r_number'];?>' style="height:25px">
			 <br><br>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type = "submit" name = "sub" id = "sub" class = "btn btn-default"> SEARCH </button>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <button type = "button" name = "password" id = "password" onclick = "fun_div1()" class = "btn btn-default"> CHANGE PASSWORD</button><br>
			 <br><br>
			 <div id = "div1">
			 </div>
		</form>
	
		
<div id = "div2">
<?php
	include('candidate_management_fetch.php');
?>
</div>
<?php
    include('../footer.php');
?>