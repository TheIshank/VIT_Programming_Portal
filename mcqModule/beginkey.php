<?php 
require 'includes/pfile.php';
$testid = 0;
if(isset($_POST["begin_key"]))
{
	$testid = $_POST["begin_key"];
}
// see the removal wala part _ $var needs to be changed 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Set Begin Key</title>
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

	<h2 align = "center">Set Begin Key</h2>

	<div class ="container" style="border-radius: 20px; border: 2px solid black; padding-top: 20px"> 
		<p align="right"><a href="faculty.php" class="btn btn-danger">FACULTY</a></p>
		<form name="myForm_4" action="beginkey.php" method="post" >

			<input type="hidden" name="testtid" value= <?php echo($testid);?> >

			<div class="form-group">
				<input type="checkbox" id="beginKeyCheckbox" onchange="beginKeyStatus()" name = "beginKeyCheckbox" value="1" >
				<label for="beginKeyCheckbox" >Include Begin Key</label>
			</div><br>

			<div id="beginKeyDiv"></div>

			<div class="form-group">
				<input type="checkbox" id="removeKeyCheckbox" name = "removeKeyCheckbox" value="1" >
				<label for="beginKeyCheckbox" >Remove Begin Key</label>
			</div><br>
			<button type="submit" class="btn btn-primary" value="submit" name="submit_beginkey" style="margin-right:50px">Change</button><br><br><br><br><br>
		</form>
	</div><br><br>

	<?php
	if(isset($_POST["submit_beginkey"])) 
	{    	
		$var=$_POST["testtid"]; 
		$check = 1;

				if (!empty($_POST["beginKey"]) & (!isset($_POST["removeKeyCheckbox"]))) //to make sure only the inclusion of the key is done and not removal i.e only one task is done wrt to the check box ticked is done
				{
					if ($check == 1)
					{

						$removekey=0;
						 $query = "UPDATE `tests` SET `Begin_Key`= ?, `Remove_Begin_Key` = ? WHERE Test_Id=$var";//remove_begin_key = 1 if no begin key is there else it should be 1 *change it if you want *

						 if($st = mysqli_prepare($connection,$query))
						 {
						 	mysqli_stmt_bind_param($st,"si", $_POST["beginKey"],$removekey);
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
					}  

				elseif (isset($_POST["removeKeyCheckbox"]) & (!isset($_POST["beginKeyCheckbox"]))) //to make sure only the removal of the key is done and not inclusion i.e only one task is done wrt to the check box ticked is done
				{  $check=0;

					if ($check == 0)
					{
						$var=$_POST["testtid"]; 
						$removekey=1;
						$query = "UPDATE `tests` SET `Begin_Key`= NULL, `Remove_Begin_Key` = ? WHERE Test_Id=$var";

						if($st = mysqli_prepare($connection,$query))
						{
							mysqli_stmt_bind_param($st,"i",$removekey);
							mysqli_stmt_execute($st);
							mysqli_stmt_fetch($st);
							print('<div class="alert alert-success" >');
							print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
							print('<strong>Success !</strong> Begin key has been removed');
							print('</div>');
						}
						else
						{
							print('<div class="alert alert-danger" >');
							print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
							print('<strong>Error!</strong> Begin key not removed.');
							print('</div>');
						}
					}
				}  

				else //either both ticked or include is checked but no input for the key is done 
				{
					print('<div class="alert alert-danger" >');
					print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
					print('<strong>Error!</strong> Please select One Option or Fill the Complete Details.');
					print('</div>');

				}
			}
			?>

		</body>
		</html>
