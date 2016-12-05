<?php
     session_start();
     $regno=$_SESSION['regno'];
     
     //$name=$_SESSION['name'];

     //echo "<h2>Welcome '$name'</h2>";
     
     include('conect_to_db.php');

     $query="SELECT c.Batch AS batch, c.course_title AS ctitle, 
             c.class_id AS cid, t.test_id AS tid, t.test_title AS ttitle,
             t.start_time AS stime, t.end_time AS etime, t.open_status AS ostatus,
             t.begin_key AS bkey, t.remove_begin_key AS removekey
             FROM classes AS c, classes_tests AS ct, tests AS t
             WHERE c.faculty_id =  'fac1'
             AND c.class_id = ct.class_id
             AND t.test_id = ct.test_id";

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
             echo "<b>Batch:</b>".$row['batch']."<br>";
             echo "<b>Test Id: </b>".$row['tid']."<br>";
             echo "<b>Test Title:</b>".$row['ttitle']."<br>";
             echo "<b>Start Time: </b>".$row['teststart']."<br>";
             echo "<b>End Time: </b>".$row['testend']."<br>";
             echo "<button>Take the test</button><br>";
             echo "<br><br>";       

        }
     }


     mysqli_close($conn);
    
?>