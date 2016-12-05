<?php
if(isset($_POST['sub']))
{
     include('../conect_to_db.php');
	 $batch = $_POST["batch"];
     
	 $query = "select Class_Id from classes where Batch = '$batch' ";
	 
	 $res = mysqli_query($conn,$query);
	 $count = 0;
	 if($res)
	 {
		  echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select class numbers:</h4><br>";
		 echo "<div style = 'border: 3px solid black; width: 400px; border-radius: 10px; margin-left:25px;'>
		 <table class = 'table table-borderless' style = 'width:300px; margin-left: 20px;'>
		 <tr>";
	    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
		{
			if($count > 2)
			{
				echo "</tr>";
				echo "<tr>";
				$count = 0;
			}
		    echo "<td> <input type = 'checkbox' name = 'class_numbers[]' value = '".$row['Class_Id']."'>"."&nbsp;&nbsp;&nbsp;&nbsp;".$row['Class_Id']."</td>";
			$count++;
		}
	echo "</table>
		  </div><br><br>";
	 }
	 else 
	 {
	   echo mysqli_error();
	 } 
	 
}
?>