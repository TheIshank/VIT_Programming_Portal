<?php 
require 'includes/pfile.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Schedule Test</title>
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

	<div class="container">

		<h2>Schedule MCQ Test</h2><br><br>

		<div class="row">
			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="pill" href="#newtest">Create a New Test</a></li>
				<li><a data-toggle="pill" href="#newques">Create a New Problem</a> </li>
				<li><a data-toggle="pill" href="#updateques">Update Questions</a> </li>
				<li><a data-toggle="pill" href="#deleteques">Delete Questions</a> </li>
			</ul>
		</div>
		
		<br><br>

		<div class="tab-content"> 
			<div id="newques" class="tab-pane fade in ">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#menu1">Description And Reference</a></li>
					<li><a data-toggle="tab" href="#menu2">Options</a></li>
				</ul>
				
				<form name="myForm" action="admin.php" method="post" enctype="multipart/form-data"><br>

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
							<button type="submit" class="btn btn-primary" value="submit" id="submit_nq" name="submit_nq">Create Problem</button><br><br>
						</div>
					</div>
				</form>
			</div>

			<div id="newtest" class="tab-pane fade in active" >

				<br><br>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#ques">New Test</a></li>
				</ul>

				<div class="tab-content" >  
					<div id="home" class="tab-pane fade in active">
						<br>
						<form name="myForm_2" action="admin.php" method="post" >

							<h4 id="demo"><font color=red>Please select the test type first before filling other details</font></h4>

							<div class="form-group">
								<p><b>Test Type:</b></p>
								<input type="radio" name="qtype" value="0" id="qtype1" onclick="goFurther()" > Code Test &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="qtype" value="1" id="qtype2" onclick="goFurther()" > Quiz Test  
							</div><br><br>

							<div class="form-group">
								<label for="title">Test Title:</label>
								<input type="text" name="title" id="testtitle" maxlength="50" class="form-control" disabled="true"><br><br>
							</div>

							<div class="form-group">
								<label for="batch">Select Batch:</label>

								<?php
								echo('<select id="batch" name="batch" class="form-control" disabled="true">');
								echo('<option value="empty">Choose a Batch</option>');
								
								$query = "SELECT distinct Batch FROM classes";

								if($st = mysqli_prepare($connection,$query))
								{
									
									mysqli_stmt_execute($st);
									$result = mysqli_stmt_get_result($st);
									
									while ($row=mysqli_fetch_assoc($result)) {


										$code = $row['Batch'];
										echo("<option value='$code'>$code</option>");    
									}
									echo('</select>');
								}
								?>
							</div>

							<div id="batchdisp">
								<!-- for display of problrms -->
							</div><br><br>
							
							<div class="form-group">
								<label for="subject">Include Problems From Subject:</label> 

								<?php

								echo('<select id="subjectfetch" name="subject" class="form-control" disabled="true">');
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
								?>

							</div>

							<div id="probdisp">
								<!-- for display of problrms -->
							</div><br><br>
							
							<div class="form-group">
								<label for = "datetimepicker">Start Time</label>
								<input type = "datetime-local" id="datetimepicker" name="stime" class="form-control" disabled="true"><br><br>
							</div>
							
							<div class="form-group">
								<label for = "datetimepicker2">End Time</label>
								<input type = "datetime-local" id="datetimepicker2" name="etime" class="form-control" disabled="true"><br><br>
							</div>

							<div class="form-group">
								<input type="checkbox" id="beginKeyCheckbox" onchange="beginKeyStatus()" name = "beginKeyCheckbox" value="1" disabled="true">
								<label for="beginKeyCheckbox">Key Required To Begin Test</label>
							</div><br>

							<div id="beginKeyDiv"></div><br><br>
							<button type="submit" class="btn btn-primary" value="submit" name="submit_nt" style="margin-right:50px">Create Test</button><br><br><br><br><br>
						</form>
						
						<!--<button type="reset" class="btn btn-danger">Reset</button>-->
						<!--</div>-->  <!-- for the menu1 -->
					</div><!--tab_conent-->
				</div>
			</div>

			<div id="updateques" class="tab-pane fade in" >
				<label for="subject">Update Problems From Subject:</label> 
				<?php

				echo('<select id="subjectupdate" name="subject" class="form-control" >');
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

				<button class="btn btn-primary" onclick="update()" style="margin-right:50px">Show</button><br><br>
				<div id="probupdate">
					<!-- for display of problrms -->
				</div><br><br>
			</div>

			<div id="deleteques" class="tab-pane fade in" >
				<label for="subject">Delete Problems From Subject:</label> 
				<?php

				echo('<select id="subjectdelete" name="subject" class="form-control" >');
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

				<button class="btn btn-primary" onclick="deleteques()" style="margin-right:50px">Show</button><br><br>
				<div id="probdelete">
					<!-- for display of problrms -->
				</div><br><br>
			</div>
		</div>
	</div>
</body>
</html>