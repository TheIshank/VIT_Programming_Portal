
<?php


    	include("conect_to_db.php");
		
		$out="inside generate otp";
		echo $out;

    	$regno = $_REQUEST['regno'];
        
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_shuffled = str_shuffle($string);
        $otp = substr($string_shuffled, 1, 6);
       
        
        date_default_timezone_set("Asia/Kolkata"); 
        $exp_time = date("Y/m/d G:i:s", strtotime("+30 minutes"));

       /* if ($stmt = mysqli_prepare($conn, "INSERT INTO password_reset_otp values (?,?,?)")) 
        {

  			mysqli_stmt_bind_param($stmt, "sss", $regno,$otp,$exp_time);
  		    mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}*/
		
		
	
		
		if ($stmt = mysqli_prepare($conn, "SELECT Email_Id FROM students WHERE RegNo = ?")) 
        {

  			mysqli_stmt_bind_param($stmt, "s", $regno);
			
  		    mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result ($stmt , $res);
		    mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
		}
		
		$email_id = $res;
		$subject = "OTP for ".$regno;
		// the message
        $msg = "Your OTP is ".$otp." and it expires on ".$exp_time." do reset your password within this period.";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

         // send email
        if(mail($email_id,$subject,$msg))
           {
		    //  echo "email sent";
		      if ($stmt = mysqli_prepare($conn, "INSERT INTO password_reset_otp values (?,?,?)")) 
              {

  			      mysqli_stmt_bind_param($stmt, "sss", $regno,$otp,$exp_time);
  		          mysqli_stmt_execute($stmt);
			      mysqli_stmt_close($stmt);
		      }
			  
			  unset($otp);
            /* echo "Email has been sent. Enter your OTP below<br>";
			 echo "<form method='post'>";
			 echo "<input type = 'password' name ='otp_pswd' id = 'otp_pswd'>";
			 echo "<button type='submit' name='new_password'>SET NEW PASSWORD</button><br>";
			 echo "</form>";
			 
			 
			 if(isset($_POST['new_password']))
			 {
			     $checkotp=$_POST['otp_pswd'];
				  echo $checkotp;
				 
				 
			 
			 }*/
           }
    

?>