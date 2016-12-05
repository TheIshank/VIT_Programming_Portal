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

      	 }
      else
      {
      	   echo "Password incorrect.Try Again";
      }


     }



?>