<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Submissions List page
 */
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
              <li><a href="studenthome.php">Test</a></li>
              <li class="active"><a href="#">Submissions</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    <h3>Below is a list of submissions you have made. Click on any to edit it.</h3><br>
    <table class="table table-bordered" style = "width:500px;">
      <thead><tr class = "success">
        <th>Test Id</th>
        <th>Problem</th>
        <th>Status</th>
      </tr></thead>
      <tbody>
      <?php
        // list all the submissions made by the user
        $query = "SELECT Problem_Id, Status, Number_Of_Attempts FROM submissions WHERE RegNo='".$_SESSION['username']."'";
        $result = mysql_query($query);
       	while($row = mysql_fetch_array($result)) {
       		$sql = "SELECT Problem_Title,Test_Id FROM problems WHERE Problem_Id=".$row['Problem_Id'];
       		$res = mysql_query($sql);
       		if(mysql_num_rows($res) != 0) {
       			$field = mysql_fetch_array($res);
	       		echo("<tr><td>".$field['Test_Id']."</td><td><a href=\"solve.php?id=".$row['Problem_Id']."\">".$field['Problem_Title']."</a></td>");
       			
            if($row['Status'] == 1)
       				echo("<td><span class=\"label label-warning\">Attempted</span></td></tr>\n");
       			else if($row['Status'] == 2)
       				echo("<td><span class=\"label label-success\">Solved</span></td></tr>\n");
       		}
       	}
      ?>
      </tbody>
      </table>
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
