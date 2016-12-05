<?php
   ob_start();
     require("connect_to_db.php");
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
           function openGroupPage(GroupID)
           {    
                 
                 window.open("email_group/grouppage.php?groupid="+GroupID , target="_self");

           }

           function deleteGroup(GroupID)
           {

           		window.open("email_group/deletegroup.php?groupid="+GroupID,target="_self");
           }

	</script>





<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage Student Groups</h3> <br><br>
<form method="post">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select a Passout batch(*) &nbsp;&nbsp;&nbsp;
<input type="text" name="batch" id="batch" style = "height:25px" required> <br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description: 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="description" id="description" style = "height:25px" required><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batch Registration No. (comma seperated): 
<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="regno" id="regno" rows = "10" class="input-large"></textarea><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Create" class = "btn btn-default">
</form>
<?php
	if(isset($_POST['submit']))
	{

		$batch=$_POST['batch'];
		$description=$_POST['description'];
		$regno=$_POST['regno'];

	//	$regno=explode(",",$regno);
        
        $query = $conn->prepare("INSERT INTO email_group (Batch,Description,Reg_Nos)  VALUES (?, ?,?)");
		$query->bind_param("iss",$batch, $description,$regno);
		$query->execute();   
		header("Location: emailgroup.php");                  

	}
  
?>

<br><br>


	<?php
         
          $res = mysqli_query($conn,"select * from email_group order by Group_Id desc");

          if(mysqli_num_rows($res)>0)
          {	
          		echo "<table class = 'table table-bordered' style = 'margin-left:30px;width:500px;'>
					<tr>
					<th>Group ID</th><th>Description</th><th>Batch</th><th>Edit</th><th>Delete</th>
					</tr>";

      		    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
        	    {
        		    echo "<tr>";
        		  	echo "<td>".$row['Group_Id']."</td>";
          			echo "<td>".$row['Description']."</td>";
          			echo "<td>".$row['Batch']."</td>";
          			echo "<td> <input type='button' class = 'btn btn-default btn-primary' value='Edit' onclick=openGroupPage(".$row['Group_Id'].")></td>"; 
          			echo "<td> <input type='button' class = 'btn btn-default btn-primary' value='Delete' onclick=deleteGroup(".$row['Group_Id'].")></td>"; 
          			echo "</tr>";

         		 }

         		 echo "</table>";
      		}
      		else
      		{

      			 echo "No group formed yet";	

      		}	



	?>
	<?php include("../footer.php"); ?>




 



