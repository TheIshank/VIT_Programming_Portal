
<?php


    	include("conect_to_db.php");
		
		

    	$regno = $_REQUEST['regno'];
		
		$query = "SELECT Reg_No FROM password_reset_otp WHERE Reg_No = '$regno'";
		$result = mysqli_query($conn,$query);
		
		
        
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_shuffled = str_shuffle($string);
        $otp = substr($string_shuffled, 1, 6);
       
        
        date_default_timezone_set("Asia/Kolkata"); 
        $exp_time = date("Y/m/d G:i:s", strtotime("+30 minutes"));

       $current_time=date("Y/m/d G:i:s");
	   
	   $query="select * from password_reset_otp ";
		
	   $result=mysqli_query($conn,$query);
	
		while($row=mysqli_fetch_array($result))
		{ 
		   $exptime=strtotime($row['Expiary_Time']);
		   
		   $newexptime = date('Y/m/d G:i:s',$exptime);
		   
		   if($current_time>$newexptime)
		   {
		     
		      $query="delete from password_reset_otp where Expiary_Time='$newexptime'";
			 
			  mysqli_query($conn,$query);
		   }

		   
		}
		
		
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
		      $query = "SELECT Reg_No FROM password_reset_otp WHERE Reg_No = '$regno'";
		      $result = mysqli_query($conn,$query);
		 
		     if(mysqli_num_rows($result) > 0)
		     {
		       $query = "UPDATE password_reset_otp SET OTP='$otp', Expiary_Time ='$exp_time' WHERE Reg_No='$regno' ";
		       $result = mysqli_query($conn,$query);
		  
		       if($result){
    		   echo "Email has been sent again<br>";
			   $out ="Enter the OTP <input type='text' id='entered_otp'><br>";

               $out.="<button onclick='otpcompare()'>ENTER</button>"; 

               echo $out;
			   
			   }
		     }
			 else
			 {
			  
		      if ($stmt = mysqli_prepare($conn, "INSERT INTO password_reset_otp values (?,?,?)")) 
              {

  			      mysqli_stmt_bind_param($stmt, "sss", $regno,$otp,$exp_time);
  		          mysqli_stmt_execute($stmt);
			      mysqli_stmt_close($stmt);
		      }
			  
			  unset($otp);
			  
            
			  $out="Email has been sent. Enter your OTP below<br>";

             $out.="Enter the OTP <input type='text' id='entered_otp'><br>";

             $out.="<button onclick='otpcompare()'>ENTER</button>";

             echo $out;
			 
			 
			 }
           }
		   else
		   {
		      echo "Email cannot be sent.Please try again.";
		   }
    

?>