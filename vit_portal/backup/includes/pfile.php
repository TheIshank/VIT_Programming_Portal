<?php

	// 3 insert into db the ticked question
	$sub = " "; // for display of subject
	$dbhost= "localhost";
	$dbuser= "root";
	$dbpass="my_password";
	$dbname="vit_portal";
	$quesmarks = 1; // for calculating the question marks if multicorrect hen two else one 
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); // stabilishing connection with the database
	if (mysqli_connect_errno())
	{
		die("CONNECTION FAILED" .
			mysqli_connect_error().
			"(" . mysqli_connect_errno().")"
			);
	}

if (isset($_POST["submit_nq"]))  // submit button if the admin wants to input a new question

{
	if ( $_POST["subject"]!='empty' && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["usr1"]) && !empty($_POST["usr2"])) 
	{
		$answers = [];
		$check = 1;
		$subject = $_POST["subject"];
		$title = $_POST["title"];
		$description = $_POST["description"];
		$usr1 = $_POST["usr1"];
		$usr2 = $_POST["usr2"];

	if (isset($_POST["usr3"])) // option three is optional
	$usr3 =  $_POST["usr3"];
	else
		$usr3 = "";

	if (isset($_POST["usr4"])) // option four is optional
	$usr4 =  $_POST["usr4"];
	else
		$usr4 = "";

	if(!isset($_POST["ans"])) // checking that atlest one correct anser is checked
	{
		print('<div class="alert alert-warning" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('Please Select The Correct Answers');
		print('</div>'); 
		$check = 0;
	}
	else
		$answers = $_POST["ans"];

	if(!empty($_POST["imgfile"])) 
	{

 if ($_FILES["imgfile"]["size"] > 500000) // checking size of file 
 {
 	print('<div class="alert alert-warning" >');
 	print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
 	print('Please Restrict File Size To 5MB');
 	print('</div>');
 	$check = 0;
 }

 $filename = $_FILES["imgfile"]["name"];
 $filetype = pathinfo($filename, PATHINFO_EXTENSION);

}

if(sizeof($answers) > 1) // checking if the question in multicorrect or single correct
{
	$quesmarks = 2;
	$type = 1;
}

else
{
	$quesmarks = 1;
	$type = 0;
}

$answers = implode(",",$answers);

if ($check == 1)
{
	$query = "INSERT INTO `problems`(`Subject`, `Problem_Title`, `Description_Path`, `question_mark`, `Option_1`, `Option_2`, `Option_3`, `Option_4`, `Answer`, `Type`) VALUES (?,?,?,?,?,?,?,?,?,?)";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"sssisssssi",$subject,$title,$description,$quesmarks,$usr1,$usr2,$usr3,$usr4,$answers,$type);
		mysqli_stmt_execute($st);
		mysqli_stmt_fetch($st);
		print('<div class="alert alert-success" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('<strong>Success !</strong> Question Saved.');
		print('</div>');

	}
	
	else
	{
		print('<div class="alert alert-danger" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('<strong>Error!</strong> Problem Not Saved.');
		print('</div>');
	}
}
}

else
{

	print('<div class="alert alert-warning" > ');
	print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
	print('<strong>Incomplete Form !</strong> Please Input All The Details.');
	print('</div>');
	
}
}

if (isset($_POST["subjectsubmit"])) {

	$sub = $_POST["subjectfetch"];
	echo "<h3> Questions From The Subject<font color='red'> ".$sub."</font></h3><br>";  

	$query = "SELECT * FROM problems WHERE subject = ?";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"s",$sub);
		mysqli_stmt_execute($st);
		$result = mysqli_stmt_get_result($st);
		$i = 1;
		
		echo("<table class=table table-striped table-hover table-condensed>");
		echo("<thead>");
		echo"<tr>";
		echo"<th>S.NO</th>";
		echo"<th>Problem Title</th>";
		echo"<th>Please Select</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";

		while ($row=mysqli_fetch_assoc($result)) {

			$pt = $row['Problem_Title'];
			$id = $row['Problem_Id'];
			$cb="<input type='checkbox' name = 'ques1[]' value = '$id'>";
			
			echo"<tr>";
			print_r("<td>".$i."</td>");
			print_r("<td>".$pt."</td>");
			print_r("<td>".$cb."</td>");
			echo"</tr>";
			$i++;  
		}
		echo"</tbody>";
		echo"</table>";
	}
}


if (isset($_POST["submitupdate"])) {

	$sub = $_POST["subjectupdate"];
	echo "<h3> Questions From The Subject<font color='red'> ".$sub."</font></h3><br>";  

	$query = "SELECT * FROM problems WHERE subject = ?";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"s",$sub);
		mysqli_stmt_execute($st);
		$result = mysqli_stmt_get_result($st);
		$i = 1;
		
		echo("<form action='update.php' method='post'> ");
		echo("<table class=table table-striped table-hover table-condensed>");
		echo("<thead>");
		echo"<tr>";
		echo"<th>S.NO</th>";
		echo"<th>Problem Title</th>";
		echo"<th>Please Select</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";

		while ($row=mysqli_fetch_assoc($result)) {

			$pt = $row['Problem_Title'];
			$id = $row['Problem_Id'];
			$cb="<button class='btn btn-danger' type='submit' name = 'updatesubmit' value = '$id'>Update</button>";
			
			echo"<tr>";
			print_r("<td>".$i."</td>");
			print_r("<td>".$pt."</td>");
			print_r("<td>".$cb."</td>");
			echo"</tr>";
			$i++;  
		}
		echo"</tbody>";
		echo"</table>";
		echo"</form>";
	}
}


if (isset($_POST["batchsubmit"])) {

	$batch = $_POST["batch"];
	echo "<h3> Classes From The Year<font color='red'> ".$batch."</font></h3><br>";  

	$query = "SELECT Class_Id,Course_Title FROM classes where Batch=?;";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"s",$batch);
		mysqli_stmt_execute($st);
		$result = mysqli_stmt_get_result($st);
		$i = 1;
		
		echo("<table class=table table-striped table-hover table-condensed>");
		echo("<thead>");
		echo"<tr>";
		echo"<th>S.NO</th>";
		echo"<th>Course Title</th>";
		echo"<th>Class Id</th>";
		echo"<th>Please Select</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";

		while ($row=mysqli_fetch_assoc($result)) {

			$pt = $row['Class_Id'];
			$id = $row['Class_Id'];
			$title = $row['Course_Title'];
			$cb="<input type='checkbox' name = 'ques10[]' value = '$id'>";
			
			echo"<tr>";
			print_r("<td>".$i."</td>");
			print_r("<td>".$title."</td>");
			print_r("<td>".$pt."</td>");
			print_r("<td>".$cb."</td>");
			echo"</tr>";
			$i++;  
		}
		echo"</tbody>";
		echo"</table>";
	}
}


elseif(isset($_POST["delete"]) && isset($_POST["ques3"]))
{
	$arr = $_POST["ques3"];

	for($i=0; $i<sizeof($_POST["ques3"]) ; $i++)
	{
		$ele = $arr[$i];
		$query = "DELETE FROM `problems` WHERE `Problem_Id` = '$ele';";

		if(mysqli_query($connection, $query))
		{
			print('<div class="alert alert-success" >');
			print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
			print("<strong>Success !</strong> Question with id '$ele' Removed.");
			print('</div>');

		}

		else
		{
			print('<div class="alert alert-warning" >');
			print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
			print('<strong>Error Occuered</strong>');
			print('</div>');
		}
	}
}


if (isset($_POST["submitdelete"])) {

	$sub = $_POST["subjectdelete"];
	echo "<h3> Questions From The Subject<font color='red'> ".$sub."</font></h3><br>";  

	$query = "SELECT * FROM problems WHERE subject = ?";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"s",$sub);
		mysqli_stmt_execute($st);
		$result = mysqli_stmt_get_result($st);
		$i = 1;
		
		echo ("<form action='index.php' method='post'>");
		echo("<table class=table table-striped table-hover table-condensed>");
		echo("<thead>");
		echo"<tr>";
		echo"<th>S.NO</th>";
		echo"<th>Problem Title</th>";
		echo"<th>Please Select</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";
		
		while ($row=mysqli_fetch_assoc($result)) {

			$pt = $row['Problem_Title'];
			$id = $row['Problem_Id'];
			$cb="<input type='checkbox' name = 'ques3[]' value = '$id'>";
			echo"<tr>";
			print_r("<td>".$i."</td>");
			print_r("<td>".$pt."</td>");
			print_r("<td>".$cb."</td>");
			echo"</tr>";
			$i++;  
		}
		echo"</tbody>";
		echo"</table>";
		echo"<input type='submit' class = 'btn btn-danger' name='delete' value='delete'>";
		echo("</form>");
	}
}

if(isset($_POST["submit_nt"])) 
{   
	$last_id = 0;
	$check = 1;
	$keyremove = 0;
	$open = 0;
	$classes = [];


	

	if (!empty($_POST["title"]) && $_POST["subject"] != 'empty' && !empty($_POST["ques1"]) && !empty($_POST["ques10"]) && isset($_POST["qtype"]) && !empty($_POST["stime"]) && !empty($_POST["etime"])) 
	{

		$classes = $_POST["ques10"];		

		if (!isset($_POST["beginKeyCheckbox"])) {
			$keyrequire = 1;
			$key = "";
		}  

		elseif (isset($_POST["beginKeyCheckbox"])) {
			$keyremove = 0;
			if(empty($_POST["beginKey"]))
			{
				print('<div class="alert alert-warning" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('<strong>Incomplete Form !</strong> Please Input Begin Key.');
				print('</div>');        
				$check = 0;
			}

			else
				$key = $_POST["beginKey"];
		}

		if($_POST["etime"] < $_POST["stime"])
		{
			$check = 0;
			print('<div class="alert alert-warning" >');
			print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
			print("End Time Can't be in the Past With Respect To The Start Time");
			print('</div>');
		}

		if ($check == 1)
		{
			$q = $_POST["ques1"];
			$q = implode(",",$q);
			$query = "INSERT INTO `tests`(`Test_Title`, `Start_Time`, `End_Time`, `Open_Status`, `Begin_Key`, `Remove_Begin_Key`, `Type`, `Subject`, `Problem_Id`) VALUES (?,?,?,?,?,?,?,?,?)";
			if($st = mysqli_prepare($connection,$query))
			{
				mysqli_stmt_bind_param($st,"sssisiiss",$_POST["title"],$_POST["stime"],$_POST["etime"],$open,$key,$keyremove,$_POST["qtype"],$_POST["subject"],$q);
				mysqli_stmt_execute($st);
				$last_id = mysqli_insert_id($connection);
				mysqli_stmt_fetch($st);
				print('<div class="alert alert-success" >');
				print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
				print('<strong>Success !</strong> Test Scheduled.');
				print('</div>');

				for($i = 0;$i<sizeof($classes);$i++)
				{
					
					$var = $classes[$i];
					$query1 = "INSERT into classes_tests(Class_Id,Test_Id) VALUES (?,?)";
					if($st1 = mysqli_prepare($connection,$query1))
					{
						mysqli_stmt_bind_param($st1,"si",$var,$last_id);
						mysqli_stmt_execute($st1);
						mysqli_stmt_fetch($st1);
					}
				}
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

	else
	{

		print('<div class="alert alert-warning" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('<strong>Incomplete Form !</strong> Please Input All The Details.');
		print('</div>');

	}







}

if(isset($_POST["freeze"]))
{
	$testid = $_POST["freeze"];

	$query = "UPDATE `tests` SET `Open_Status`= 0 WHERE `Test_Id` = ?;";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"i",$testid);
		mysqli_stmt_execute($st);
		mysqli_stmt_fetch($st);
		print('<div class="alert alert-success" >');
		print('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		print('<strong>Success !</strong> Status of test changed to closed.');
		print('</div>');
	}
	else
		echo "error";
}
?>
