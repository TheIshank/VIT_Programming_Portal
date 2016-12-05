<?php

   $reg=$_REQUEST['regno'];
   $enterotp=$_REQUEST['otp'];

   include('conect_to_db.php');

   
   $query="select OTP from password_reset_otp where Reg_No='$reg'";


   $res=mysqli_query($conn,$query);

   if($res)
	 {
	    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
		{
			
		    if($row['OTP']==$enterotp)
		    	{
		    		echo "OTP matched<br>";
		    		echo "New Password: <input type='password' name='newpw' id='newpw'><br>";
		    		echo "Confirm New Password: <input type='password' name='cnewpw' id='cnewpw'><br>";
                    echo "<button onClick='newpwgen()' class = 'btn btn-default'>RESET </button>";


		        }
		    else
		    	{echo "OTP not matched";}

		}
	 }


?>