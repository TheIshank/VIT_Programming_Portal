<?php 
require 'includes/pfile.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Test</title>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="includes/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="includes/javascript.js"></script>
	<link rel="stylesheet" href="includes/styling.css">  
	<script type="text/javascript" src="includes/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="includes/jquery.simple-dtpicker.css" rel="stylesheet" />
	
</head>
<body>

	<div class="container">
				
		<?php

		if(isset($_POST['updatesubmit']))
			$testid = $_POST['updatesubmit'];
		else
			$testid = $_POST['upt'];

		echo "<h1 align='center'>Edit Test $testid</h1><br><br><br>";
		echo '<a href="http://localhost/internship/vit_portal/admin.php" class="btn btn-primary">Back</a>';
		echo "<h3> Previously Included Probems</h3>";
		$q = "SELECT Problem_Id from tests WHERE Test_Id = ?";
		if($st = mysqli_prepare($connection,$q))
		{
			mysqli_stmt_bind_param($st,"i",$testid);
			mysqli_stmt_execute($st);
			$result = mysqli_stmt_get_result($st);
			$row=mysqli_fetch_assoc($result);
			$probs = explode(",",$row['Problem_Id']);
			$i = 0;
			$len = count($probs);

			echo("<table class= table table-striped table-hover table-condensed>");
			echo("<thead>");
			echo"<tr>";
			echo"<th>S.NO</th>";
			echo"<th>Problem Id</th>";
			echo"</tr>";
			echo"</thead>";
			echo"<tbody>";

			for($i = 0;$i < $len ; $i++) {

				$pt = $probs[$i];
				$ii = $i+1;
				echo"<tr>";
				print_r("<td>".$ii."</td>");
				print_r("<td>".$pt."</td>");

				echo"</tr>";

			}
			echo"</tbody>";
			echo"</table>";

		}
		?><br><br><hr><br><br>

		<div class="form-group">
			<label for="subject">Include Problems From Subject:</label> 

			<?php

			echo('<select id="ssubjectfetch" name="subject" class="form-control" >');
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
				echo('</select><br>');
			}
			?>

		</div>

		<form method="post">
			<div class="form-group">
				<label for="title">Tags:</label><br>


				<?php

				echo('<select id="ttag1" name="tag1"  class="form-control" style="width:250px;">');
				echo('<option value="empty">Choose The First Tag</option>');

				$query = "SELECT Distinct Tag1 FROM problems_quiz";

				if($st = mysqli_prepare($connection,$query))
				{

					mysqli_stmt_execute($st);
					$result = mysqli_stmt_get_result($st);

					while ($row=mysqli_fetch_assoc($result)) {


						$code = $row['Tag1'];
						echo("<option value='$code'>$code</option>");    
					}
					echo('</select><br>');
				}
				?>
			</div>


			<div class="form-group">

				<?php

				echo('<select id="ttag2" name="tag2"  class="form-control" style="width:250px;">');
				echo('<option value="empty">Choose The Second Tag</option>');

				$query = "SELECT Distinct Tag2 FROM problems_quiz";

				if($st = mysqli_prepare($connection,$query))
				{

					mysqli_stmt_execute($st);
					$result = mysqli_stmt_get_result($st);

					while ($row=mysqli_fetch_assoc($result)) {


						$code = $row['Tag2'];
						echo("<option value='$code'>$code</option>");    
					}
					echo('</select><br>');
				}
				?>
			</div>

			<input type="hidden" name="testid" value= <?php echo $testid;?>>



			<div id="pd" style="overflow: auto; height: 300px; border:2px solid black;padding: 10px;border-radius: 10px;">
				<h1>Display Of Problems</h1> 
			</div><br>

			<button type="submit" name="upt" value=<?php echo $testid;?> class="btn btn-danger" style="width: 75px;">Edit</button><br><br><br>

		</form>

	</div>

</body>
</html>
