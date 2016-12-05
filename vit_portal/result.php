
<?php 
require 'includes/pfile.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Evaluation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="includes/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="ckeditor/ckeditor.js"></script>
  <script src="includes/javascript.js"></script>
  
  <link rel="stylesheet" href="includes/styling.css">   
</head>
<body>
  <h2 align="center"> Evaluation Of MCQ</h2><br>
  <div class="container" style="border-radius: 20px; border: 2px solid black; width: 700px; height: auto; "><br><br><br>
    <a href="faculty.php" class="btn btn-info">Back</a>
    <?php

    $var=$_POST["report"];
    $query = "SELECT RegNo,Marks FROM student_tests WHERE Test_Id= ?";

    if($st = mysqli_prepare($connection,$query))
    {
      mysqli_stmt_bind_param($st,"i",$var);
      mysqli_stmt_execute($st);
      $result = mysqli_stmt_get_result($st);
      
      echo ("<br><br><br>");
      echo("<table class='table table-striped table-hover table-condensed' style='width:650px' align = center >");
      echo("<thead>");
      echo"<tr>";
      echo"<th>Registration Number</th>";
      echo"<th>Marks Scored</th>";
      echo"</tr>";
      echo"</thead>";
      echo"<tbody>";
      while ($row=mysqli_fetch_assoc($result)) {
        
        $Reg = $row['RegNo'];
        $mark=$row['Marks'];
        echo"<tr>";
        print_r("<td>".$Reg."</td>");
        print_r("<td>".$mark."</td>");
        echo"</tr>";
      }
      echo"</tbody>";
      echo"</table>";
    }

    ?>
  </div>
</body>
</html>
