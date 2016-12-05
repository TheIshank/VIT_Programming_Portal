<?php
     session_start();
     $regno=$_SESSION['regno'];
     
     //$name=$_SESSION['name'];

     //echo "<h2>Welcome '$name'</h2>";
     
     include('conect_to_db.php');

     $query="SELECT sc.Regno, c.Course_Title as ctitle, t.Test_Id as testid, t.Test_Title as testtitle, 
             t.Start_Time as teststart, t.End_Time as testend
			 FROM students_classes AS sc, tests AS t, classes_tests AS ct, classes as c
			 WHERE t.Open_Status=1
			 AND sc.Regno = '$regno'
			 and t.Test_Id = ct.Test_Id
 			 AND ct.Class_Id = sc.Class_Id
			 AND c.Class_Id=sc.Class_Id";

	 //echo "Query: ".$query."<br>";

     $result=mysqli_query($conn,$query);

     echo "<h3>Tests conducted for the student</h3>";
   
     if(mysqli_num_rows($result)==0)
     {
     	echo "NO tests scheduled at the moment.";
     }
     else
     {
     	$testcount=1;
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
             echo "<b>TestNo.</b>".$testcount++."<br>";
             echo "<b>Course Title:</b>".$row['ctitle']."<br>";
             echo "<b>Test Id: </b>".$row['testtitle']."<br>";
             echo "<b>Start Time: </b>".$row['teststart']."<br>";
             echo "<b>End Time: </b>".$row['testend']."<br>";
             echo "<button>Take the test</button><br>";
             echo "<br><br>";       

        }
     }


     mysqli_close($conn);
    
?>