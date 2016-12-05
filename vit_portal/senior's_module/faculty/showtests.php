

<?php
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
       echo "<div class='panel panel-default'>
             <div class='panel-heading'><h3>List of Tests schedule</h3></div>";
        while($row = $result->fetch_assoc()){
              echo "<div id='".$row['Test_Id']." ' class='alert alert-info' style='border:solid 1px; border-radius:5px; '>";
             
              echo "<b>TEST: </b>".$count++."<br><br>";
              echo "<b>Test Name:</b>".$row['Test_Title']."<br><br> <b>Test ID:</b> ".$row['Test_Id'] .'<br /><br>';
             
              echo "<b>Timings:</b> ".$row['Start_Time']." to ".$row['End_Time']."<br> ";
              echo "<br>";
             
              echo "<b>Classes ID(s) under the test:</b> ";

              $sql="SELECT Class_Id
                    FROM tests, classes_tests
                    WHERE tests.Test_Id='".$row["Test_Id"]."'
                    AND tests.Test_Id = classes_tests.Test_Id";
                  
                  $result2=$conn->query($sql);

                  if (mysqli_num_rows($result2) == 0) 
                  echo "Not scheduled to any class";
                  else
                      {

                        while($row1 = $result2->fetch_assoc()) {
                               echo $row1['Class_Id'].",";

                         }
                     }

            

              echo "<br>";

              echo "<button onClick='create(this)' class='btn btn-default'><span class='glyphicon glyphicon-search'></span>VIEW</button></div><br><br>"; 
              echo "<br>";
         }
        echo "</div>";
       
        $conn->close();

?>