<?php
//session_start();
if(isset($_POST['sub']))
{
	  //session_start();
     include('conect_to_db.php');
	 $batch = $_POST["batch"];
     $_SESSION['batch']=$batch;
     //echo "SEssion var ".$_SESSION['batch']."<br>";
	 $query = "select distinct(Degree) from students where Batch = '$batch' ";
	 
	 $res = mysqli_query($conn,$query);
	 echo "Select Degree: <br><br>";
	 echo "<select name='degrees[]' multiple class = 'form-control' style = 'width:500px;'>";
	 if($res)
	 {
	    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
		{
		    echo '<option value="'.$row['Degree'].'">'.$row['Degree'].'</option>';
		}
	 echo "</select></br>";
	 }
	 else 
	 {
	   echo mysqli_error();
	 } 
	 
}
?>