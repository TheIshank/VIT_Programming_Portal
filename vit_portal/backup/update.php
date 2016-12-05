
<?php
require 'includes/pfile.php';

$row = array();;
$id = 0;

if(isset($_POST["updatesubmit"]))
{
	$id = $_POST["updatesubmit"]; 


	$query = "SELECT Subject,Problem_Title,Option_1,Option_2,Option_3,Option_4,Answer FROM problems where Problem_id=?;";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"i",$id);
		mysqli_stmt_execute($st);
		$result = mysqli_stmt_get_result($st);
		$row=mysqli_fetch_assoc($result);
		
	}
}

if (isset($_POST["submit_uq"])) 
{

	if ( $_POST["subject"]!='empty' && !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["usr1"]) && !empty($_POST["usr2"])) 

	{

		$probid = $_POST["id"];
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

	$query="UPDATE `problems` SET `Subject`=?,`Problem_Title`=?,`Description_Path`=?,`question_mark`=?,`Option_1`=?,`Option_2`=?,`Option_3`=?,`Option_4`=?,`Answer`=?,`Type`=? WHERE Problem_id=?;";

	if($st = mysqli_prepare($connection,$query))
	{
		mysqli_stmt_bind_param($st,"sssisssssii",$subject,$title,$description,$quesmarks,$usr1,$usr2,$usr3,$usr4,$answers,$type,$probid);
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

$id = $probid; 


$query1 = "SELECT Subject,Problem_Title,Option_1,Option_2,Option_3,Option_4,Answer FROM problems where Problem_id=?;";

if($st = mysqli_prepare($connection,$query1))
{
	mysqli_stmt_bind_param($st,"i",$id);
	mysqli_stmt_execute($st);
	$result = mysqli_stmt_get_result($st);
	$row=mysqli_fetch_assoc($result);
	
}
}

?>

<html>
<head>
	<title>Problem Update</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="includes/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="includes/javascript.js"></script>
</head>
<body>

	<div class="container">


		<h2 align="center"><font color="red">PREVIOUS INPUTS</font></h2><br><br>
		<a href="admin.php" class="btn btn-info">Home</a><br><br><br>
		<?php  

		echo("<table class='table table-striped table-hover table-condensed' style='border: 2px solid black; float:center;'>");
		echo("<thead>");
		echo"<tr>";
		echo"<th>Field</th>";
		echo"<th>Input</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";


		foreach($row as $x => $x_value) {

			echo"<tr>";
			echo"<td>".$x."</td>";
			echo"<td>".$x_value."</td>";
			echo"</tr>";

		}
		echo"</tbody>";
		echo"</table><br><br><br>";



		?> 


		<h2 align="center"><font color="red">	UPDATE THE PROBLEM</font></h2><br><br>
		<div id="newques" class="tab-pane fade in ">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#menu1">Description And Reference</a></li>
				<li><a data-toggle="tab" href="#menu2">Options</a></li>
			</ul>

			<form name="myForm" action="update.php" method="post" enctype="multipart/form-data"><br>

				<div class="tab-content">

					<div id="menu1" class="tab-pane fade in active"><br>

						<div class="form-group">
							<label for="title">Problem Title:</label>
							<input type="text" name="title" id="title" maxlength="50" class="form-control"><br><br>
						</div>




						<div class="form-group">


							<label for="subject">Include Problems From Subject:</label> 

							<?php

							echo('<select id="subject" name="subject" class="form-control">');
							echo('<option value="empty">Choose a Subject</option>');

							$query = "SELECT subject_code FROM subjects";

							if($st = mysqli_prepare($connection,$query))
							{
								mysqli_stmt_bind_param($st,"s",$sub);
								mysqli_stmt_execute($st);
								$result = mysqli_stmt_get_result($st);

								while ($row=mysqli_fetch_assoc($result)) {


									$code = $row['subject_code'];
									echo("<option value='$code'>$code</option>");    
								}
								echo('</select><br><br>');
							}
							?>
						</div>
						<div class="form-group">
							<p><b>Question Image:</b></p>
							<img id="blah" style="background-color: transparent; border:3px solid maroon; border-radius: 10px;" width="200" height="100" /><br><br>
							<input type="file" name="imgfile" id="imgfile" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br><br>
						</div>

						<label for="description">Description:</label>        
						<br><div style="padding-bottom:50px;"><textarea id="description" name="description" class="ckeditor"></textarea></div>
					</div>
					<!-- validate the options page with atleast 2 options-->
					<div id="menu2" class="tab-pane fade"> 

						<p id="al"></p><br> 
						<h3>Options</h3>

						<table class="table table-striped table-hover table-condensed ">
							<thead>

								<tr>
									<th>S.NO</th> 
									<th>Desciption</th>
									<th>Answer</th>
									<th>Reset Option</th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td>1</td>
									<td>
										<div class="form-group">
											<p id="text1">
												<input type="text" class="form-control" id="usr1" name="usr1" required placeholder="Enter The Option (Required)">
											</p>  
										</div>
									</td>
									<td>
										<div class="checkbox" style="padding-left: 28px">
											<p id="check1">
												<label><input type="checkbox" value="1" name="ans[]" id="ans1"></label>
											</p>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-danger" onclick="reset1()" style="margin-left:15px; margin-top: 8px;">Reset</button>
									</td>
								</tr>

								<tr>
									<td>2</td>
									<td>
										<div class="form-group">
											<p id="text2">
												<input type="text" placeholder="Enter The Option (Required)" required class="form-control" id="usr2" name="usr2">
											</p>
										</div>
									</td>  
									<td>
										<div class="checkbox" style="padding-left: 28px">
											<p id="check2">
												<label><input type="checkbox" value="2" name="ans[]" id="ans2"></label> 
											</p>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-danger" onclick="reset2()" style="margin-left:15px; margin-top: 8px;">Reset</button>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td>
										<div class="form-group">
											<p id="text3">
												<input type="text" class="form-control" id="usr3" placeholder="Enter the option" name="usr3">
											</p>
										</div>
									</td>
									<td>
										<div class="checkbox" style="padding-left: 28px">
											<p id="check3">
												<label><input type="checkbox" value="3" name="ans[]" id="ans3"></label>
											</p>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-danger" onclick="reset3()" style="margin-left:15px; margin-top: 8px;">Reset</button>
									</td>
								</tr>
								<tr>
									<td>4</td>
									<td>
										<div class="form-group">
											<p id="text4">
												<input type="text" class="form-control" id="usr4" placeholder="Enter the option" name="usr4">
											</p>
										</div>
									</td>

									<td>
										<div class="checkbox" style="padding-left: 28px">
											<p id="check4">
												<label><input type="checkbox" value="4" name="ans[]" id="ans4" ></label>
											</p>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-danger" onclick="reset4()" style="margin-left:15px; margin-top: 8px;">Reset</button>
									</td>
								</tr>
							</tbody>
						</table>
						<!-- to make the submit button and validate the form-->
						<input type="hidden" name="id" value=<?php echo($id)?> >

						<button type="submit" class="btn btn-primary" value="submit" id="submit_uq" name="submit_uq">Update Problem</button><br><br>

					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
