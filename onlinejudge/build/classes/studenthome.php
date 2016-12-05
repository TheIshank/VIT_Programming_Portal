<?php
require_once('functions.php');
    if(!loggedin())
        header("Location: login.php");
    else
        include('../../header1.php');
        //connectdb();
     
     $regno=$_SESSION['username'];
     
     //$name=$_SESSION['name'];

     //echo "<h2>Welcome '$name'</h2>";
     
     include('conect_to_db.php');

     echo "<li class='active'><a href='onlinejudge/src/studenthome.php'>Tests</a></li>
              <li><a href='onlinejudge/src/submissions.php'>Submissions</a></li>
              <li><a href='onlinejudge/src/account.php'>Account</a></li>
              <li><a href='onlinejudge/src/logout.php'>Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>";

     $query="SELECT sc.Regno, c.Course_Title as ctitle,c.Class_id as cid, t.Test_Id as testid, t.Test_Title as testtitle, 
             t.Start_Time as teststart, t.End_Time as testend
			 FROM students_classes AS sc, tests AS t, classes_tests AS ct, classes as c
			 WHERE t.Open_Status=1
			 AND sc.Regno = '$regno'
			 and t.Test_Id = ct.Test_Id
 			 AND ct.Class_Id = sc.Class_Id
			 AND c.Class_Id=sc.Class_Id";

	 //echo "Query: ".$query."<br>";

             

     $result=mysqli_query($conn,$query);

   
   
     if(mysqli_num_rows($result)==0)
     {
     	echo "NO tests scheduled at the moment.";
     }
     else
     {
        echo "<div class='container'>";
        echo "<div class='well'><h3>List of Tests schedule</h3></div>";
     	$testcount=1;
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {    echo "<div class='alert alert-info' style='border:solid 1px; border-radius:5px; '>";
             echo "<b>Class ID: </b>".$row['cid']."<br><br>";
             echo "<b>Test Number:</b> ".$testcount++."<br><br>";
             echo "<b>Course Title:</b> ".$row['ctitle']."<br><br>";
             echo "<b>Test Title: </b>".$row['testtitle']."<br><br>";
             echo "<b>Test ID: </b>".$row['testid']."<br><br>";
             echo "<b>Start Time: </b> ".$row['teststart']."<br><br>";
             echo "<b>End Time: </b>".$row['testend']."<br><br>";
             echo "<form method = 'post' action = 'onlinejudge/src/index.php'><input type = 'hidden' value = '".$row['testid']."' name = 'testid'><input type = 'submit' value = 'Take the test' class = 'btn btn-default'></form>";
             echo "</div>";
             echo "<br><br>"; 


        }
          echo "</div>";
     }
   


     mysqli_close($conn);
    

    include('footer.php');

?>