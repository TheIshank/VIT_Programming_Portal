<?php
    $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "newhnt";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
		if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		}

        $sql = "SELECT * 
                FROM tests";
                /*, classes_tests
                WHERE tests.test_id = classes_tests.test_id";
                 */


        //echo print_r($sql); 

        if(!$result = $conn->query($sql)){
              die('There was an error running the query [' . $conn->error . ']');
        }
        else
        	
        $count=1;
        //echo "queryerror";
        while($row = $result->fetch_assoc()){
              echo "<b>TEST: ".$count++."</b><br><div id='".$row['Test_Id']."'>";
              echo "<b>TestName:</b>".$row['Test_Title']."<br> <b>Test ID:</b> ".$row['Test_Id'] .'<br />';
             
              echo "<b>Timings:</b> ".$row['Start_Time']." to ".$row['End_Time']." ";
              echo "<button onClick='create(this)'>VIEW</button></div><br>"; 
             
         }

       
        $conn->close();

?>