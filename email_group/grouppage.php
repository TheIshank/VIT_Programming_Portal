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
				      <li><a href="">Code Test</a></li>
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
			  <li><a href="">MCQ Test</a></li>
			  <li><a href="database_page/searchdetails.php">Database</a></li>
			  <li><a href="email_group/emailgroup.php">Create Email Group</a></li>
			  <li><a href="admin-login/logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>





	<script>

		function deleteEntry(regNO,groupId)
		{
        window.open('email_group/delete.php?regno=' + regNO+'&groupid='+groupId ,target='_self');
		}

	</script>



<?php
	

    
    	require("connect_to_db.php");

     
	 //$groupId=$_SESSION['groupid'];
        $groupId=$_GET['groupid'];
   

        echo "<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group Id : ".$groupId . "</h2><br>";


  	   $res=mysqli_query($conn,"select * from email_group where Group_Id = '$groupId' ");
     
        $count = mysqli_num_rows($res) ;

        $res = mysqli_fetch_array($res,MYSQLI_ASSOC);

        $RegNos=$res['Reg_Nos'];
        $RegTmp = $RegNos;


         if(strlen($RegTmp)>0)
         {

            $RegNos=explode(",", $RegNos);
    
            $NameMap = array();
            $EmailMap = array();
    
 

            foreach ($RegNos as $reg)
            {
         
     	      $res=mysqli_query($conn,"select Name,Email_Id from students where RegNo = '$reg' ");
              $res=mysqli_fetch_array($res,MYSQLI_ASSOC);
              $NameMap[$reg] = $res['Name'];
              $EmailMap[$reg] = $res['Email_Id'];
            }
    
            echo "<table class = 'table table-bordered' style = 'width:500px; margin-left:35px;'>";
      echo "<tr><th>Reg. No.</th><th>Name</th><th>Email - Id</th><th>Action</th></tr>";
            foreach($RegNos as $reg)
            {
				
              echo "<tr>" ;
              echo "<td>".$reg."</td>";
              echo "<td>". $NameMap[$reg] ."</td>";
              echo "<td>". $EmailMap[$reg] ."</td>";
              // echo "<td> <input type='button' onclick='deleteEntry(" . '$reg' . ")' value='Remove' name='remove'></td>";
              echo "<td> <button type='submit' class = 'btn btn-default btn-primary' name='remove' id=". $reg ." onclick=deleteEntry(this.id,".$groupId.")> Remove </button> </td> ";
              echo "</tr>";

            }	

            echo "</table>";
        }
      else
      {
        echo "No student in this group";
      } 
                  
?>

<br><br><br>

<form method="post">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Students To Group:
<br><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="regnos" rows="10" cols="50" class = "input-large" required></textarea> 
  <br>
  <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="add" value="Add" class = "btn btn-default">

</form>


<?php
	
	if(isset($_POST['add']))
	{
         
         $toBeAdded = $_POST['regnos'];
         echo "RegTmp : ".$RegTmp;
         
         if(strlen($RegTmp)==0)
         {
             $RegNosStr =  $toBeAdded;
         }
         else
         {
             $RegNosStr = $RegTmp . ",". $toBeAdded;
         }   
         
         $query = $conn->prepare("UPDATE email_group SET Reg_Nos = ? where Group_Id= '$groupId' ");
         $query->bind_param("s", $RegNosStr);
	     $query->execute();
         unset($_POST);
         header("Location:grouppage.php?groupid=". $groupId); 
	}

?>
  <?php include("../footer.php"); ?>



 