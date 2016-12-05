<?php
    
     $regno=$_SESSION['regno'];

    $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "vit_programming_portal_2";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
		if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		}

       

        $sql = "SELECT c.Batch AS batch, c.course_title AS ctitle, 
                c.class_id AS cid, t.test_id AS tid, t.test_title AS ttitle,
                t.start_time AS stime, t.end_time AS etime, t.open_status AS ostatus,
                t.begin_key AS bkey, t.remove_begin_key AS removekey
                FROM classes AS c, classes_tests AS ct, tests AS t
                WHERE c.faculty_id =  '$regno'
                AND c.class_id = ct.class_id
                AND t.test_id = ct.test_id";
                


        //echo print_r($sql); 

        if(!$result = $conn->query($sql)){
              die('There was an error running the query [' . $conn->error . ']');
        }
        else
        	
        $testcount=1;
        //echo "queryerror";

       echo "<div class='well'><h3>List of Tests schedule under Faculty ID: ".$regno."</h3></div>";

        while($row = $result->fetch_assoc()){
               echo "<div id='".$row['tid']."' class='alert alert-info' style='border:solid 1px; border-radius:5px; '>";
               echo "<b>Test Number: </b>".$testcount++."<br><br>";
               echo "<b>Class Id: </b>".$row['cid']."<br><br>";
               echo "<b>Course Title: </b>".$row['ctitle']."<br><br>";
               echo "<b>Batch: </b>".$row['batch']."<br><br>";
               echo "<b>Test Id: </b>".$row['tid']."<br><br>";
               echo "<b>Test Title: </b>".$row['ttitle']."<br><br>";
               echo "<b>Begin Key: </b>".$row['bkey']."<br><br>";
               echo "<b>Timings:</b> ".$row['stime']." to ".$row['etime']." <br><br>";
               echo "<button onClick='create(this)' class='btn btn-default'><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;SETTINGS</button><br><br>
                     </div><br><br>"; 
             
         }
       

       
        $conn->close();

?>