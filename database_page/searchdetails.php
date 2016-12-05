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



<script>
  function AddBatch()
  {
     var batch=document.getElementById('batch').value;
     document.getElementById('batch1').value=batch;
     alert(batch);
  }
  function validate()
  {
    // alert('hi');
    //location.reload();
     var validFlag=true;
     var batch1=document.getElementsByName('batch');

     batch1.innerHTML="";
     

     var batch=document.getElementById('batch').value;
     if(batch=="")
        {
         document.getElementById('validBatch').innerHTML="Enter a batch";
         validFlag=false;
        }   
     // 
     return validFlag;

  }
  function valid2()
  {
   
    var validDegreeFlag=true;
     var degree=document.getElementsByName('degrees').value;
     if(degree="")
     {
          alert("hi");
         document.getElementById('validgree').innerHTML="Select atleast one field";
         validDegreeFlag=false;
     }


     return validDegreeFlag;

  }
</script>	
<body>
	
<div class="container">
  <h3>Enter Batch and Degree </h3><br>
  <form method = "POST" onSubmit="return(validate())">
     Batch: <input type ="text" name ="batch" id="batch" value ="<?php if(isset($_POST["batch"])) echo $_POST["batch"]; ?>" style="height:25px"> 
     <p id='validBatch'></p><br>
     <button type = "submit" name = "sub" class = "btn btn-default"> PROCEED </button>  
 </form>

  <form method = "post" name='searchform'>
	    
		  <input type="hidden" name="batch1" value="">
		  <?php include('my_degreeretrieval.php'); ?>
		  
      <p id="validgree"></p>
		  <input type="submit" name="search" value = "SEARCH" class = "btn btn-default"> 
  </form>
   <?php
      include('showstudents.php');
	  include('../footer.php');
    ?>
</div>
</body>


</html>