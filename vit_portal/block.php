
<?php 
require 'includes/pfile.php';
$var = 0;
if(isset($_POST["block_student"]))
{
  $var = $_POST["block_student"];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Block Student</title>
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
  <h2 align="center"> Block Students</h2><br>
  <div class="container" style="border-radius: 20px; border: 2px solid black; width: 700px; height: auto; "><br><br><br>
    <a href="faculty.php" class="btn btn-info">Back</a>
    <form name="myForm_5" action="bLock.php" method="post" >

      <input type="hidden" name="testid" value= <?php echo($var); ?> > 

      <?php

      echo $var;

      $query = "SELECT RegNo FROM student_tests WHERE Test_Id= ?";

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
        echo"<th>Select the students to be blocked</th>";
        echo"</tr>";
        echo"</thead>";
        echo"<tbody>";
        while ($row=mysqli_fetch_assoc($result)) {

          $Reg = $row['RegNo'];
          echo"<tr>";
          print_r("<td>".$Reg."</td>");
          print_r("<td>"."<input type=checkbox value=$Reg name=block[]>"."</td>");
          echo"</tr>";
        }
        echo"</tbody>";
        echo"</table>";
      }
      ?> 

      <br>
      <button type="submit" class="btn btn-primary" value="submit" name="submit_block" style="margin-right:50px">Block students</button><br><br><br><br><br>
    </form>
  </div>




  <?php
  if(isset($_POST["submit_block"]))
  {
    if(!empty($_POST["block"]))
    {
      $status=1;
      $mark=0;
      foreach($_POST['block'] as $blocked)
      {
           //gets the test id
        $var=$_POST["testid"];

        $query = "UPDATE `student_tests` SET `Block_Status`= ? ,`Marks`= ? WHERE RegNo= ? AND Test_Id= ?";

        if($st = mysqli_prepare($connection,$query))
        {
          mysqli_stmt_bind_param($st,"iisi",$status,$mark,$blocked,$var);
          mysqli_stmt_execute($st);
          mysqli_stmt_fetch($st);
        }

      }

      print('<div class="alert alert-success" >');
      print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
      print('<strong>Success !</strong> Students have been blocked from giving the Test.');
      print('</div>');
    }
    else
    {
      print('<div class="alert alert-danger" >');
      print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
      print('<strong>Error!</strong> Nothing Selected.');
      print('</div>');
    }

  }

//test id lene mein problem aa rhi h mujhe 
//code sahi chal rha h
//abhi kam hone k bad block.php pe hi redirect ho rha h wapas 
//usse meine action se try kra but couldnt make it work 
//ek bar testid aaje toh page ko wapas faculty.php pe bhej dena and wahan pe success msg sho ho jaye 
//and agar koi change ho th btana mein kr dunga ispe kaam 
//please check for validation 
//i have done it but still second check
//Enjoy Your Vacations :)



  ?>
</body>
</html>




