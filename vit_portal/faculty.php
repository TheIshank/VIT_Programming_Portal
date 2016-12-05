<?php 
require 'includes/pfile.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="includes/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="includes/javascript.js"></script>
	
	<link rel="stylesheet" href="includes/styling.css">   
</head>


<body>
	<div class="container">

		<h1 align="center">Test View</h1><br>

		<form method="post">

			<div id="updateques" class="tab-pane fade in" >
				<label for="subject">Update Problems From Subject:</label> 
				<?php

				echo('<select id="subjectupdate" name="facsub" class="form-control" >');
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
					echo('</select>');
				}
				?><br>

				<button class="btn btn-primary" style="margin-right:50px" type="submit" name="sub">Show</button>

			</form>
			<br><br>
			<div id="probupdate">
				<!-- for display of problrms -->
			</div><br><br>
		</div>

		<?php

		if (isset($_POST["sub"]))
		{
			$subject =  $_POST["facsub"];
			$query = "SELECT * FROM tests where Subject = ?;";
			if($st = mysqli_prepare($connection,$query))
			{
				mysqli_stmt_bind_param($st,"s",$subject);
				mysqli_stmt_execute($st);
				$result = mysqli_stmt_get_result($st);
				$i = 1;

				while ($row=mysqli_fetch_assoc($result)) {

					$testid = $row["Test_Id"];
					$testname = $row["Test_Title"];
					$start = $row["Start_Time"];
					$end = $row["End_Time"];
					$key = $row["Begin_Key"];
					$sub = $row["Subject"];
					$color = "lightblue";


					echo("<div class='panel-group' style='border-top:5px solid black; border-radius:10px; '>
						<div class='panel panel-default'>
							<div class='panel-heading' style='background-color:{$color};'>
								<p> <b>TEST NAME :</b> {$testname} </p>
								<p> <b>TEST ID :</b> {$testid} </p>
								<p> <b>START TIME :</b> {$start} </p>
								<p> <b>END TIME :</b> {$end} </p>
								<p> <b>KEY :</b> {$key} </p>
								<p> <b>SUBJECT :</b> {$sub} </p>
								<h4 class='panel-title'>
									<button data-toggle='collapse' href='#{$i}' class='btn btn-danger'>Settings</button>
								</h4>
							</div>
							<div id='{$i}' class='panel-collapse collapse'>
								<div class='panel-body'>
									<form action ='change_date_time.php' method='post'><button class='btn btn-success' value='{$testid}' name='change_time'>Change Time</button></form><br>
									<form action ='block.php' method='post'><button class='btn btn-danger' value='{$testid}' name='block_student'>Block Students</button></form><br>
									<form method='post'><button name= 'freeze' class='btn btn-info' value='{$testid}'>Freeze</button></form><br>
									<form action ='beginkey.php' method='post'><button class='btn btn-warning' value='{$testid}' name='begin_key'>Alter Begin Key</button></form><br>
									<form action ='result.php' method='post'><button class='btn btn-primary' value='{$testid}' name='report'>Report</button></form><br>
								</div>
							</div>
						</div>
					</div>");
					$i++;  
				}
			}
		}
		?>
	</div>
</body>
</html>
