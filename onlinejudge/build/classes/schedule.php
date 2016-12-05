
<!DOCTYPE html>
<?php include('header1.php'); ?>



 <li class="active"><a href="#">Problems</a></li>
              <li><a href="submissions.php">Submissions</a></li>
              <li><a href="scoreboard.php">Scoreboard</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

     

   
    <h3>Tests List</h3>
    
    <div class="container">

    <?php
  // require('showtests.php');
     ?>
    </div>

  <?php
             if(isset($_POST['FreezeButton']))
             {

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "hnt";
              
                $StatusTestId=$_POST['OpenStatus'];
                
                //echo "<br>".$StatusTestId."<br>";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "update tests set Open_Status=0 where Test_Id='$StatusTestId'";
               // echo $sql;
                if(!$result = $conn->query($sql)){
                            die('There was an error running the query [' . $conn->error . ']');
                  }

              
 
              //s  $conn->query($sql);

             }
             if(isset($_POST['RemoveBeginKeyButton']))
             {
                  $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "hnt";
              
                $BeginKeyStatusTestId=$_POST['BeginKeyStatus'];
                
                //echo "<br>".$StatusTestId."<br>";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "update tests set Remove_Begin_Key=1 where Test_Id='$BeginKeyStatusTestId'";
                //echo $sql;
                if(!$result = $conn->query($sql)){
                            die('There was an error running the query [' . $conn->error . ']');
                  }

              

             }


  ?>

  

   
    <?php
	include('footer.php');
?>

  

</html>
