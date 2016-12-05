
<?php 
require 'includes/pfile.php';
$testid = 0;
if(isset($_POST["change_time"]))
{
  $testid = $_POST["change_time"];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Schedule Change</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="includes/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="ckeditor/ckeditor.js"></script>
  <script src="includes/javascript.js"></script>
  <script type="text/javascript" src="includes/jquery.simple-dtpicker.js"></script>
  <link type="text/css" href="includes/jquery.simple-dtpicker.css" rel="stylesheet" />

  <link rel="stylesheet" href="includes/styling.css">   
</head>
<body>

  <h2 align = "center">Change Test Timings</h2><br><br>

  <div class="container" style="border-radius: 20px; border: 2px solid black; padding-top: 20px;">  
    <p align="right"><a href="faculty.php" class="btn btn-danger">FACULTY</a></p>
    <form name="myForm_3" action="change_date_time.php" method="post" >

      <input type="hidden" name="testid" value= <?php echo($testid);?> >

      <div class="form-group">
        <label for = "datetimepicker">Start Time</label>
        <input type = "text" id="datetimepicker" name="stime" class="form-control" ><br><br>
      </div>

      <script type="text/javascript">
        $('#datetimepicker').appendDtpicker({

          "onSelect": function(handler, targetDate){

            console.log(targetDate);
          }
        });
      </script>
      
      <div class="form-group">
        <label for = "datetimepicker2">End Time</label>
        <input type = "text" id="datetimepicker2" name="etime" class="form-control"><br><br>
      </div>

      <script type="text/javascript">
      $('#datetimepicker2').appendDtpicker({

          "onSelect": function(handler, targetDate){

            console.log(targetDate);
          }
        });
      </script>

      <button type="submit" class="btn btn-primary" value="submit" name="submit_changeschedule" style="margin-right:50px">Create Schedule</button><br><br><br><br><br>
    </form>
  </div><br><br>

  <?php
  if(isset($_POST["submit_changeschedule"])) 
  {   
    $open = 0;
    $check = 1;
    if (!empty($_POST["stime"]) && !empty($_POST["etime"])) 
    {
     if($_POST["etime"] < $_POST["stime"])
     {
       $check = 0;
       print('<div class="alert alert-warning" >');
       print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
       print("End Time Can't be in the Past With Respect To The Start Time");
       print('</div>');
     }  

   }  
   
   
   if ($check == 1)
   {
   $var=$_POST["testid"]; //test id from the faculty page
   
   $query = "UPDATE `tests` SET `Start_Time`=?,`End_Time`=? WHERE Test_Id=$var";

   if($st = mysqli_prepare($connection,$query))
   {

    mysqli_stmt_bind_param($st,"ss",$_POST["stime"],$_POST["etime"]);
    mysqli_stmt_execute($st);
    mysqli_stmt_fetch($st);
    print('<div class="alert alert-success" >');
    print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    print('<strong>Success !</strong> Schedule Changed.');
    print('</div>');

  }
  
  else
  {
    print('<div class="alert alert-danger" >');
    print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    print('<strong>Error!</strong> Test Not Scheduled.');
    print('</div>');
  }
}
}
?>

</body>
</html>
