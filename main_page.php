<?php
    
	
	require_once('admin-login/functions.php');
	if(!loggedinAdmin())
		header("Location: admin-login/login.php");
	else if($_SESSION['usernameAdmin'] !== 'admin')
		header("Location: admin-login/login.php");
	else
		include('header1.php');
		connectdb();
?>              
              
              <li class="active dropdown">
			   <a class="dropdown-toggle" data-toggle="dropdown" href="#">Schedule
			   <span class="caret"></span></a>
			      <ul class="dropdown-menu">
				      <li><a href="Test Schedule/testschedule/schedule.php">Code Test</a></li>
					  <li><a href="">MCQ Test</a></li>
				  </ul>
			  </li>
              <li><a href="candidate_management/candidate_management.php">Candidate Management</a></li>
              <li><a href="scoreboard.php">Reports</a></li>
              <li><a href="account.php">Profile</a></li>
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

    <div class="container">
    
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
