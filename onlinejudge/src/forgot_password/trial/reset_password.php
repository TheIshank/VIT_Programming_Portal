<?php

$regno=$_REQUEST['regno'];
$newpw=$_REQUEST['newpw'];
$cnewpw=$_REQUEST['cnewpw'];


if($newpw!=$cnewpw)
{
	echo "Passwords did not match.Try again<br>";
	echo "New Password: <input type='password' id='newpw'><br>";
    echo "Confirm New Password: <input type='password' id='cnewpw'><br>";
    echo "<button onClick='newpwgen()' class = 'btn btn-default'>RESET </button>";
}
else
{
   include('conect_to_db.php');
   

   $query="update students set Password='$newpw' where RegNo='$regno'";

   $res=mysqli_query($conn,$query);
   $query  = "DELETE FROM password_reset_otp WHERE Reg_No = '$regno'";
    mysqli_query($conn,$query);
   
   
   if($res)
     {
     	echo "Password has been reset.Go to login page";
	 }


}





?>