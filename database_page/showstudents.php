<?php
//session_start();

if(isset($_POST['search']))
{
if(!empty($_SESSION['batch']))
{
    if(empty($_POST['degrees'])) { die("Please select atleast one field");}
    include('conect_to_db.php');

   // $buffer=
    $degrees=$_POST['degrees'];
    $batch=$_SESSION['batch'];     

//echo $degrees[0];
    //echo "BATCH ".$batch."<br>";
   /*foreach($degrees as $degree)
    {
    echo $degree."<br>";
     } */   
    
    
    echo "<h3>Show Details of Students</h3><br>";
    echo "<table class = 'table table-bordered table-hover'>";
    echo "<tr><th>RegNo</th><th>Name</th><th>Batch</th><th>Degree</th><th>Email_Id</th></tr>";
    foreach($degrees as $degree)
    {
    	
    	$sql="select RegNo,Name,Batch,Degree,Email_Id from students where Batch='".$batch."'and Degree='".$degree."'";
    	//echo $sql."<br>";
        
         if(!$result = $conn->query($sql)){
                                die('There was an error running the query [' . $conn->error . ']');
            }
         else
         	//echo "Query Worked<br>";

         if (mysqli_num_rows($result) == 0) {
            die("No students registered under this batch");

         }
         else
         {
         while($row=$result->fetch_assoc())
           {
             echo "<tr>";
             echo "<td>".$row['RegNo']."</td>";
             echo "<td>".$row['Name']."</td>";
             echo "<td>".$row['Batch']."</td>";
             echo "<td>".$row['Degree']."</td>";
             echo "<td>".$row['Email_Id']."</td>";
             echo "</tr>";
             
           }
         }

    }
    echo "</table>";
    
}

}

?>