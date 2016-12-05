<?php 
require 'includes/pfile.php';
$testid = 0;
if(isset($_POST["freeze"]))
{
	$testid = $_POST["freeze"];

	echo "testid". $testid;
	echo "<br>";
	$timezone=date_default_timezone_set('Asia/Kolkata');
	//echo "The current server timezone is: " . $timezone;
	$date = date('Y/m/d h:i:s a',time());
	echo "date:".$date;



	$query = "UPDATE `tests` SET `End_Time`= ? WHERE Test_Id= $testid";//change the end_time to the current time so that the test stops then and there

						 if($st = mysqli_prepare($connection,$query))
						 {
						 	mysqli_stmt_bind_param($st,"s",$date);
						 	mysqli_stmt_execute($st);
						 	mysqli_stmt_fetch($st);
						 	print('<div class="alert alert-success" >');
						 	print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
						 	print('<strong>Success !</strong> Begin key has been set.');
						 	print('</div>');
						 }
						 else
						 {
						 	print('<div class="alert alert-danger" >');
						 	print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
						 	print('<strong>Error!</strong> Begin key not set.');
						 	print('</div>');
						 }

}


?>