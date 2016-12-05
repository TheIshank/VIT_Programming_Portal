<?php

   include('../conect_to_db.php'); 
   
    if(isset($_POST['new_pswd_submit']) AND !isset($_POST['sub']))
        {
		    
		     if(empty($_POST['new_password']) OR empty($_POST['re_password']))
			 {
			      echo "Please fill out the required details";
			 }
			 
			 else if ($_POST['new_password'] != $_POST['re_password'])
			 {
			    echo "Password and retyped password do not match";
			 }
			 
			 else if(empty($_POST['r_number']))
			 {
                 echo 'Enter the id to update the password';			 
			 }
			 else
			 {
			     $id = $_POST['r_number'];
			     $new_password = $_POST['new_password'];
				 $query = "UPDATE students SET Password ='$new_password' WHERE RegNo ='$id'";
				 $result = mysqli_query($conn,$query);
				
				 if(mysqli_affected_rows($conn) == 0)
				 {
				     $id = $_POST['r_number'];
				     $query = "UPDATE faculties SET Password = '$new_password' WHERE Faculty_Id = '$id'";
					 $result_1 = mysqli_query($conn,$query);
					  if(mysqli_affected_rows($conn)== 0)
					  {
					     $id = $_POST['r_number'];
					     $query = "UPDATE admin SET Password = '$new_password' WHERE Admin_Id = '$id'";
					     $result_2 = mysqli_query($conn,$query);
						 if(mysqli_affected_rows($conn) == 0)
						 {
						    echo "Please give a valid id";
						 }
						 
						 else
						 {
						    echo "Admin password updated successfully";
						 }
					  }
					  
					  else
					  {
					    echo "Faculty password updated successfully;";
					  }
				  }
				  
				  else
				  {
				     echo "Password for student has been updated successfully";
				  }
			 }
		}
	
   if(isset($_POST['sub']))
   {	
        if(!empty($_POST['r_number'])  AND !empty($_POST['s_email']))
		{
		     
		     $reg_number = $_POST['r_number'];
			 $query = "select * from students where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			
            $res=mysqli_fetch_array($res,MYSQLI_ASSOC);			
			 
			 $query = "select Class_Id from students_classes where RegNo = '$reg_number'";
			 $res2 = mysqli_query($conn,$query);
			 
			 echo "<p><div style = 'background-color: darkblue;'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Registration Number: </b></div>".$reg_number."<br> <b>Name: </b>".$res['Name']."<br><b>Email Id:</b>".$res['Email_Id']."<br><b>Recovery Email_Id</b>".$res['Recovery_Email_Id'];
			 if($res['Block_Status']==0)
			 {
			      echo "<br> <b> Block Status:</b> Unblocked";
			 }
			 else
			 {
			     echo "<br> <b> Block Status:</b> Blocked";
			 }
			 
			 $i = 0;
			 $arr;
			 while($row = mysqli_fetch_array($res2,MYSQLI_ASSOC))
			 {
			    $arr[$i] = $row['Class_Id'];
				$i = $i+1;
			 }
			 
			 $classes_taken = implode(" ",$arr);
			 echo "<br> <b> Classes </b>".$classes_taken."<br>";
			 
			 $query = "select Test_Id from student_tests where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			 
			 echo "<br><table> <tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 
			 $i = 0;
			 $arr_test_id;
			 while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
			    $arr_test_id[$i] = $row['Test_Id'];
				$i = $i+1;
			 }
			 
			 foreach ($arr_test_id as $key)
			 {
			     $query = "select Test_Id,Test_Title, TIMESTAMPDIFF(MINUTE,NOW(),End_Time) as difference FROM tests WHERE Test_Id = '$key'";
				 $res_tests = mysqli_query($conn,$query);
				 $arr_res_tests = mysqli_fetch_array($res_tests,MYSQLI_ASSOC);
				  
				 echo "<tr> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				 if($arr_res_tests['difference'] >0)
				 {
				    echo "<td>OPEN</td> <td>".$arr_res_tests['difference']."</td></tr>";
				 }
				 
				 else
				 {
				     echo "<td>CLOSED</td> <td> 0</td></tr>";
				 }
			 }
			
		   echo "</table>";
		}
		
		else if(!empty($_POST['s_email']))
		{
		   
		     $s_email = $_POST['s_email'];
			 $query = "select RegNo from students where Email_Id = '$s_email'";
			 $result = mysqli_query($conn,$query);
			 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		     $reg_number = $row['RegNo'];
			 $query = "select * from students where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			
            $res=mysqli_fetch_array($res,MYSQLI_ASSOC);			
			 
			 $query = "select Class_Id from students_classes where RegNo = '$reg_number'";
			 $res2 = mysqli_query($conn,$query);
			 
			/* echo "<p><div style = 'background-color: darkblue; width:20px;'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Registration Number: </b></div>".$reg_number."<br> <b>Name: </b>".$res['Name']."<br><b>Email Id:</b>".$res['Email_Id']."<br><b>Recovery Email_Id</b>".$res['Recovery_Email_Id'];
			 if($res['Block_Status']==0)
			 {
			      echo "<br> <b> Block Status:</b> Unblocked";
			 }
			 else
			 {
			     echo "<br> <b> Block Status:</b> Blocked";
			 }
			 
			 $i = 0;
			 $arr;
			 while($row = mysqli_fetch_array($res2,MYSQLI_ASSOC))
			 {
			    $arr[$i] = $row['Class_Id'];
				$i = $i+1;
			 }
			 
			 $classes_taken = implode(" ",$arr);
			 echo "<br> <b> Classes </b>".$classes_taken."<br>";
			 
			 
			 $query = "select Test_Id from student_tests where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			 
			 echo "<br><table> <tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 
			 $i = 0;
			 $arr_test_id;
			 while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
			    $arr_test_id[$i] = $row['Test_Id'];
				$i = $i+1;
			 }
			 
			 foreach ($arr_test_id as $key)
			 {
			     $query = "select Test_Id,Test_Title, TIMESTAMPDIFF(MINUTE,NOW(),End_Time) as difference FROM tests WHERE Test_Id = '$key'";
				 $res_tests = mysqli_query($conn,$query);
				 $arr_res_tests = mysqli_fetch_array($res_tests,MYSQLI_ASSOC);
				  
				 echo "<tr> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				 if($arr_res_tests['difference'] >0)
				 {
				    echo "<td>OPEN</td> <td>".$arr_res_tests['difference']."</td></tr>";
				 }
				 
				 else
				 {
				     echo "<td>CLOSED</td> <td> 0</td></tr>";
				 }
			 }
			
		   echo "</table>";*/
		   
		    echo "<h3>Student Details </h3><br>";
			 echo "<table class='table table-hover table-bordered' style = 'width:500px; margin-left:20px;'><tr><td ><b>Registration Number: </b></td>"."<td >".$reg_number."</td></tr>"."<tr><td ><b>Name: </b></td>"."<td >".$res['Name']."</td></tr>"."<tr><td ><b>Email Id:</b></td>"."<td >".$res['Email_Id']."</td></tr><tr><td ><b>Recovery Email_Id:</b></td><td >".$res['Recovery_Email_Id']."</td></tr>";
			 if($res['Block_Status']==0)
			 {
			      echo "<tr> <td ><b> Block Status:</b></td> <td >Unblocked</td></tr>";
			 }
			 else
			 {
			     echo "<tr><td > <b> Block Status:</b></td> <td >Blocked</td></tr>";
			 }
			 
			 $i = 0;
			 $arr;
			 while($row = mysqli_fetch_array($res2,MYSQLI_ASSOC))
			 {
			    $arr[$i] = $row['Class_Id'];
				$i = $i+1;
			 }
			 
			 $classes_taken = implode(" ",$arr);
			 echo "<tr> <td ><b> Classes: </b></td><td >".$classes_taken."</td></tr></table>";
			 
			 $query = "select Test_Id from student_tests where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			// echo "";
			// echo "<br><h3>Student Test Details</h3><br><table class = 'table table-bordered' style='width:600px;'> <tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 echo "<br><h3>Student Test Details</h3><br><table class = 'table table-bordered' style='width:600px;'>";
			 echo "<tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 $i = 0;
			 $arr_test_id;
			 while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
			    $arr_test_id[$i] = $row['Test_Id'];
				$i = $i+1;
			 }
			 
			 foreach ($arr_test_id as $key)
			 {
			     $query = "select Test_Id,Test_Title, TIMESTAMPDIFF(MINUTE,NOW(),End_Time) as difference FROM tests WHERE Test_Id = '$key'";
				 $res_tests = mysqli_query($conn,$query);
				 $arr_res_tests = mysqli_fetch_array($res_tests,MYSQLI_ASSOC);
				  
				// echo "<tr> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				 if($arr_res_tests['difference'] >0)
				 {  
			        echo "<tr class='success text-success'> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				    echo "<td>OPEN</td> <td>".$arr_res_tests['difference']."</td></tr>";
				 }
				 
				 else
				 {   
			         echo "<tr class='danger text-danger'> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				     echo "<td >CLOSED</td> <td> 0</td></tr>";
				 }
			 }
			
			
		   echo "</table></center>";
		    
		}
		
		else
		{
		      $reg_number = $_POST['r_number'];
			 $query = "select * from students where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			
            $res=mysqli_fetch_array($res,MYSQLI_ASSOC);	 
            $reg_number=$res['RegNo'];		
			 
			 $query = "select Class_Id from students_classes where RegNo = '$reg_number'";
			 $res2 = mysqli_query($conn,$query);
			 echo "<h3>Student Details </h3><br>";
			 echo "<table class='table table-hover table-bordered' style = 'width:500px; margin-left:20px;'><tr><td ><b>Registration Number: </b></td>"."<td >".$reg_number."</td></tr>"."<tr><td ><b>Name: </b></td>"."<td >".$res['Name']."</td></tr>"."<tr><td ><b>Email Id:</b></td>"."<td >".$res['Email_Id']."</td></tr><tr><td ><b>Recovery Email_Id:</b></td><td >".$res['Recovery_Email_Id']."</td></tr>";
			 if($res['Block_Status']==0)
			 {
			      echo "<tr> <td ><b> Block Status:</b></td> <td >Unblocked</td></tr>";
			 }
			 else
			 {
			     echo "<tr><td > <b> Block Status:</b></td> <td >Blocked</td></tr>";
			 }
			 
			 $i = 0;
			 $arr;
			 while($row = mysqli_fetch_array($res2,MYSQLI_ASSOC))
			 {
			    $arr[$i] = $row['Class_Id'];
				$i = $i+1;
			 }
			 
			 $classes_taken = implode(" ",$arr);
			 echo "<tr> <td ><b> Classes: </b></td><td >".$classes_taken."</td></tr></table>";
			 
			 $query = "select Test_Id from student_tests where RegNo = '$reg_number'";
			 $res = mysqli_query($conn,$query);
			// echo "";
			// echo "<br><h3>Student Test Details</h3><br><table class = 'table table-bordered' style='width:600px;'> <tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 echo "<br><h3>Student Test Details</h3><br><table class = 'table table-bordered' style='width:600px;'>";
			 echo "<tr> <td> <b> ID </b> </td> <td> <b> TEST NAME </b></td> <td> <b>STATUS </b> </td> <td> <b> MINUTES REMAINING </b> </td> </tr>";
			 $i = 0;
			 $arr_test_id;
			 while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
			    $arr_test_id[$i] = $row['Test_Id'];
				$i = $i+1;
			 }
			 
			 foreach ($arr_test_id as $key)
			 {
			     $query = "select Test_Id,Test_Title, TIMESTAMPDIFF(MINUTE,NOW(),End_Time) as difference FROM tests WHERE Test_Id = '$key'";
				 $res_tests = mysqli_query($conn,$query);
				 $arr_res_tests = mysqli_fetch_array($res_tests,MYSQLI_ASSOC);
				  
				// echo "<tr> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				 if($arr_res_tests['difference'] >0)
				 {  
			        echo "<tr class='success text-success'> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				    echo "<td>OPEN</td> <td>".$arr_res_tests['difference']."</td></tr>";
				 }
				 
				 else
				 {   
			         echo "<tr class='danger text-danger'> <td>".$arr_res_tests['Test_Id']."</td> <td>".$arr_res_tests['Test_Title']."</td>" ;
				     echo "<td >CLOSED</td> <td> 0</td></tr>";
				 }
			 }
			
			
		   echo "</table></center>";
		
		}
   }
?>