<?php
   if(isset ($_POST['schedule']))
{
     include('../conect_to_db.php'); 
     $class_numbers = $_POST['class_numbers'];
	 $title = $_POST['title'];
	 $start_time = $_POST['stime'];
	 $end_time = $_POST['etime'];
	 $open_status = 1;
     
	 if(isset($_POST['beginKeyCheckbox']))
	 {
		
		$begin_key = $_POST['beginKey'];
		$remove_begin_key = 0;
		$type = 0;
		
		$query = $conn->prepare("INSERT INTO tests (Test_Title, Start_Time,End_Time,Open_Status,Begin_Key,Remove_Begin_Key,Type) VALUES (?, ?,?,?,?,?,?)");
		$query->bind_param("sssisii",$title, $start_time,$end_time,$open_status,$begin_key,$remove_begin_key,$type);
		$query->execute();
		
		
		$key = mysqli_insert_id($conn);
		
		foreach($class_numbers as $number)
		{
		     $query = $conn->prepare("INSERT INTO classes_tests (Class_Id,Test_Id) VALUES (?,?)");
			 $query -> bind_param("si",$number,$key);
			 $query ->execute();
			 echo "done"."<br>";
			 
		}	
	 }
	 else
	 {
	     $begin_key = "";
		 $remove_begin_key = 1;
		 $type = 0;
		 
	     $query = $conn->prepare("INSERT INTO tests (Test_Title, Start_Time,End_Time,Open_Status,Begin_Key,Remove_Begin_Key,Type) VALUES (?, ?,?,?,?,?,?)");
		 $query->bind_param("sssisii",$title, $start_time,$end_time,$open_status,$begin_key,$remove_begin_key,$type);
		 $query->execute();
		 
		 $key = mysqli_insert_id($conn);
		 
		 foreach($class_numbers as $number)
		{
		     $query = $conn->prepare("INSERT INTO classes_tests (Class_Id,Test_Id) VALUES (?,?)");
			 $query -> bind_param("si",$number,$key);
			 $query ->execute();
			
		}	
	 }
	 echo "<b> Test creation successful <br>  TEST ID: ".$key."</b>";
}   

?>