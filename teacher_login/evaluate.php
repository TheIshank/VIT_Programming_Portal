
<?php
     session_start();
     $regno=$_SESSION['regno'];
     include('../header1.php');
     include('functions.php');
     if(isset($_POST['studentRegNo']))
     {
     $_SESSION['studentRegNo'] = $_POST['studentRegNo'];
    
     }
    
     	  $studentRegNo = $_SESSION['studentRegNo'];

	 connectdb();
?>


<li><a href="index.php">Admin Panel</a></li>
              <li><a href="users.php">Users</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="container">
    <?php
      // get the name, email and status
      $query = "SELECT  Block_Status FROM students WHERE RegNo='".$studentRegNo."'";
      $result = mysql_query($query);
      $row = mysql_fetch_array($result);
    ?>
    <h1><small>Profile details for <?php echo($studentRegNo); if($row['Block_Status'] == 1) echo(" <span class=\"label label-important\">Banned</span>");?></small></h1>
    <br/><br/>
    Details of problems attempted:
    <table class="table table-striped">
      <thead><tr>
        <th>Problem</th>
        <th>Status</th>
      </tr></thead>
      <tbody>
      <?php
        // list all the problems attempted or solved
        $query = "SELECT Problem_Id, Submit_Status, Status FROM submissions WHERE RegNo='".$studentRegNo."'";
        $result = mysql_query($query);
       	while($row = mysql_fetch_array($result)) {
       		$sql = "SELECT Problem_Title FROM problems WHERE Problem_Id=".$row['Problem_Id'];
       		$res = mysql_query($sql);
       		if(mysql_num_rows($res) != 0) {
       			$field = mysql_fetch_array($res);

	       		/*echo("<tr><td><a href=\"teacher_login/evaluate.php\" onclick=\"$('#area').load('teacher_login/preview.php', {action: 'code', uname: '".$studentRegNo."', id: '".$row['Problem_Id']."', name: '".$field['Problem_Title']."'});\">".$field['Problem_Title']."</a></td>");*/

	       		$uname = $studentRegNo;
	       		$id = $row['Problem_Id'];
	       		$name = $field['Problem_Title'];


               echo("<tr><td><a href='teacher_login/preview.php?uname=".$uname."&id=".$id."&name=".$name."'>".$name."</a></td>");


       			if($row['Submit_Status'] == 1)// || $row['Status'] == 1)
       				echo("<td><span class=\"label label-warning\">Attempted</span></td></tr>\n");
       			else if($row['Submit_Status'] == 2)
       				echo("<td><span class=\"label label-success\">Solved</span></td></tr>\n");
            else if($row['Status'] == 1)
              echo("<td><span class=\"label label-warning\">Attempted</span></td></tr>\n");

       		}
       	}
      ?>
      </tbody>
      </table>
      <div id="area"></div>
    </div> <!-- /container -->

<?php
	include('../footer.php');
?>
