<?php
session_start();

?>

<html>
<title>Student Login</title>
<body>
	    <center>
	   <h3>Student Login</h3>
       <form method="post">
                Username: <input type="text" name="user"><br><br>
                Password: <input type="password" name="pw"><br><br>
                <input type="submit" value="SUBMIT" name="sub">

       </form>

        </center>
</body>
<?php
     if(isset($_POST['sub']))
     {

       	$regno=$_POST['user'];
        $pw=$_POST['pw'];

        include('conect_to_db.php');

        if($stmt=mysqli_prepare($conn,"SELECT Password from students where RegNO=?"))
        {
        	mysqli_stmt_bind_param($stmt,"s",$regno);

        	mysqli_stmt_execute($stmt);

        	mysqli_stmt_bind_result($stmt,$realpw);

        	mysqli_stmt_fetch($stmt);

        	mysqli_stmt_close($stmt);
        }

      mysqli_close($conn);

      if($pw==$realpw)
      	 {
      	 	echo "Password Confirmed.Go to index page";
      	 	$_SESSION['regno']=$regno;
      	 	header("location:studenthome.php");

      	 }
      else
          {
      	   echo "Password incorrect.Try Again";
          }


     }



?>

</html>