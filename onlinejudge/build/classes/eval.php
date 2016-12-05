<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Compiler PHP Script
 */
   
	require_once('functions.php');
	
	include('dbinfo.php');
	connectdb();
	/*$query = "SELECT * FROM prefs";
        $result = mysql_query($query);
        $accept = mysql_fetch_array($result);*/
        //$query = "SELECT status FROM users WHERE username='".$_SESSION['username']."'";



		$query = "SELECT Block_Status FROM students WHERE RegNo='".$_SESSION['username']."'"; //  Status of the student
        $result = mysql_query($query);
        $status = mysql_fetch_array($result);




	// if (!preg_match("/^[^\\/?* :;{}\\\\]+\\.[^\\/?*: ;{}\\\\]{1,4}$/", $_POST['filename']))
	//	header("Location: solve.php?ferror=1&id=".$_POST['id']); // invalid filename
        // check if the user is banned or allowed to submit and SQL Injection checks
         if($status['Block_Status'] == 1 and is_numeric($_POST['id'])) {


            //Fetch Test Id from problems table

         	$query = "SELECT Test_Id FROM problems WHERE Problem_Id='".$_POST['id']."'";
         	$result = mysql_query($query);
         	$testIdRow = mysql_fetch_array($result);
         	$test_id = $testIdRow['Test_Id'];
             
			// Find all details about the particular submission 
			$query = "select * from submissions where RegNo = '".$_SESSION['username']."' and Problem_Id = '".$_POST['id']."'";
			$result = mysql_query($query);
			$username = $_SESSION['username']; 
		    $problemId = $_POST['id'];

		    // If no submissions have been made, create a new folder with hierarchy Reg_No/Test_Id/Problem_Id
		    if(mysql_num_rows($result)==0)
			{
				mkdir("$username");
                 mkdir("$username/$test_id");
				mkdir("$username/$test_id/$problemId");
			}
			// Get the precode, post code and solution via POST method ( Could also obtain it from the problems table)
        	$soln = $_POST['soln'];
			$pre = "";
			$post = "";
			$pre1 = ""; // For file
			$post1 = ""; // For file
			if(isset($_POST['precode']))
			{
			$pre = str_replace("\n", '$_n_$', treat($_POST['precode']));
			$pre1 = $_POST['precode'];
			// Obtain Precode
			}
			if(isset($_POST['postcode']))
			{
			$post = str_replace("\n", '$_n_$', treat($_POST['postcode'])); // Obtain Post Code
			$post1 = $_POST['postcode'];
			// Obtain Postcode
			}
			// Identify language selected in the drop down menu, and appropriately create the file name
			
			if($_POST['lang']=="c")
				$filename = "solve.c";
		    else if($_POST['lang']=="cpp")
				$filename = "solve.cpp";
			else if($_POST['lang']=="java")
				$filename = "solve.java";
			else if($_POST['lang']=="python")
				$filename = "solve.py";
		//	fwrite($file,$filename);
			
        	//$filename = mysql_real_escape_string($_POST['filename']);
			
        	$lang = mysql_real_escape_string($_POST['lang']);
			//Debug
		//	fwrite($file,$soln." ".$_SESSION['username']);
		
			
        	//check if entries are empty
			
        	if(trim($soln) == "" or trim($filename) == "" or trim($lang) == "")
        		header("Location: solve.php?derror=1&id=".$_POST['id']);
        	else {
				//$soln = str_replace("\n", '$_n_$', treat($_POST['soln']));

               


               // Append precode and postcode to the main code, if they exist!
				$soln = $pre1."\n".$soln."\n".$post1;
				//$soln = str_replace("\n", '$_n_$', treat($soln));
				$file = fopen("$username/$test_id/$problemId/solution.txt","w+");
				fwrite($file,$soln);
				fclose($file);
				$solnPath = "$username/$test_id/$problemId/solution.txt";
				 if($pre1!="" || $post1!="")
                  {
                  	$file = fopen("$username/$test_id/$problemId/solution_main.txt","w+");
                  	fwrite($file,$soln);
				    fclose($file);
				    $solnPath1 = "$username/$test_id/$problemId/solution_main.txt";

                  }
                  else
                  	$solnPath1 = $solnPath;
				

            // Check if it is a new submission/ re-submission. Insert if the submission is new, and updation for the latter.

			if($_POST['ctype']=='new')
			{	

			// add to database if it is a new submission
			     
				$query = "INSERT INTO submissions ( `Problem_Id` ,`Test_Id`, `RegNo`,`Submitted_Solution_Path`,`Solution_Path`, `File_Name`, `Language_Used`, `Class_Id`) VALUES ('".$_POST['id']."','".$test_id."', '".$_SESSION['username']."', '".$solnPath."','".$solnPath1."', '".$filename."', '".$lang."','1267')";
				$query1 = "INSERT INTO student_tests  VALUES ('".$test_id."','".$_SESSION['username']."','0','0')";
				mysql_query($query1);
			$file = fopen("a.txt","w+");
				fwrite($file,$query1);
				fclose($file);
				
				
			}
			else {
				// update database if it is a re-submission
				$tmp = "SELECT Number_Of_Attempts FROM submissions WHERE (Problem_Id='".$_POST['id']."' AND RegNo='".$_SESSION['username']."')";
				$result = mysql_query($tmp);
				$fields = mysql_fetch_array($result);
				$query = "UPDATE submissions SET Language_Used='".$lang."', Number_Of_Attempts='".($fields['Number_Of_Attempts']+1)."', Submitted_Solution_Path='".$solnPath."', File_Name='".$filename."' WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
			}
			mysql_query($query);
             
			// connect to the java compiler server to compile the file and fetch the results
			$socket = fsockopen($compilerhost, $compilerport);
			if($socket) {
				fwrite($socket, $filename."\n");

			// Depending on whether the "Compile" button, or the "Submit" button has been pressed, either the "input" or the "Hidden Input" must be fetched
				if(isset($_POST["compile"]))
					$query = "SELECT Execution_Time , Test_Case_Input_Path as input, Test_Case_Output_Path as output FROM problems WHERE Problem_Id='".$_POST['id']."'"; // Compile and test Code
				else if(isset($_POST["submit"]))
					$query = "SELECT Execution_Time, Hidden_Case_Input_Path as hiddenInput, Hidden_Case_Output_Path as hiddenOutput FROM problems WHERE Problem_Id='".$_POST['id']."'"; // Submit Code
				$result = mysql_query($query);
				$fields = mysql_fetch_array($result);
				
				
				
				
				
			
				// Send Execution time to Java Server
				fwrite($socket, $fields['Execution_Time']."\n");
				
				
				$soln = str_replace("\n", '$_n_$', treat($_POST['soln']));
				$soln = $pre."\n".$soln."\n".$post;
				$soln = str_replace("\n", '$_n_$', treat($soln));

				// Send the solution to Java Server
				fwrite($socket, $soln."\n");

				// Based on the above query, variable input will contain the sample input OR the hidden input
				if(isset($_POST["compile"]))
				{   $inputPath = "../../".$fields['input'];
				    $file = fopen($inputPath,"r");
				    $input = fread($file,filesize($inputPath));
				    fclose($file);

					$input = str_replace("\n", '$_n_$', treat($input));
				}
				else if(isset($_POST["submit"]))
				{
					$inputPath = "../../".$fields['hiddenInput'];
					$file = fopen($inputPath,"r");
					$input = fread($file,filesize($inputPath));
					fclose($file);

					$input = str_replace("\n", '$_n_$', treat($input));
				}
			    

			    // Send input to the Java Server
				fwrite($socket, $input."\n");

				// Send the specified language to the Java Server
				fwrite($socket, $lang."\n");

				//  Send the registration number of the student
				fwrite($socket, $_SESSION['username']."\n");

				$input = str_replace('$_n_$',"\n", treat($input));


				// Read the status after code compilation/ Execution 
				$status = fgets($socket);
				
				$contents = "";
				if($status!=2)
				{
				while(!feof($socket))
					$contents = $contents.fgets($socket);
				
				$con = $contents;
				
				}
			    fclose($socket);

			    // Indicates Compile Error
				if($status == 0) {
					// oops! compile error
					if(isset($_POST['compile'])) 
				        $query = "UPDATE submissions SET Status=1 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
					else if(isset($_POST['submit']))
						$query = "UPDATE submissions SET Submit_Status=1 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
					mysql_query($query);
					$_SESSION['cerror'] = trim($contents);
					// Redirect to solve.php page to display the appropriate error message. Store the error message in a session variable
					header("Location: solve.php?cerror=1&id=".$_POST['id']);
					}


				// No Compiler Error. Output generated by Java, and sent to PHP via socket.	 
				else if($status == 1) 
				{
				
					
					
					
					//$outputString = $fields['output'];
					//$outputString = treat($outputString);

					// Logic to fetch the expected output of the question, and compare it with the actual output
					// Can be the sample input, or the hidden input 
					if(isset($_POST["compile"]))
					{
							$outputPath = "../../".$fields['output'];
							$file = fopen($outputPath,"r");
							$output = fread($file,filesize($outputPath));
							fclose($file);
							
						    $outputString = treat($output);
					}
				    else if(isset($_POST["submit"]))
					{   
				        $outputPath = "../../".$fields['hiddenOutput'];
						$file = fopen($outputPath,"r");
						$output = fread($file,filesize($outputPath));
						fclose($file);
						$outputString = treat($output);
					}

					// preprocess both the outputs
					$treatedString = trim($outputString);
					$treatedString = str_replace(" ","",$treatedString);
					$colonOccur=substr_count($treatedString,";");
					$trimContents=str_replace(" ","",trim($contents));



                    // Compare the outputs
					if($trimContents == $treatedString) {


						// holla! problem solved

						// Update necessary flags in the database, and redirect to solve.php with necessary message to indicate the problem has been solved
						if(isset($_POST['compile'])) 
						{
						    $query = "UPDATE submissions SET Status=2 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
							mysql_query($query);
							header("Location: solve.php?success=1&id=".$_POST['id']);
							
						}
						else if(isset($_POST['submit']))
						{
							$query = "UPDATE submissions SET Submit_Status=2 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
							mysql_query($query);
							header("Location: solve.php?success=2&id=".$_POST['id']);
						}			
					} 
					else 
					{
						// duh! wrong output

                      /******************************   


						   This block is executed when at least ONE of the several testcases fail.
						   Thus, we need to differentiate between the correct, and the incorrect test cases.
						   Thus, the expected output, and the actual output for every test case is compared, and 
						   depending upon the result of the comparison, the details of the testcase are written into a temportary file as  - Input, Expected output, Actual output, Inference( Incorrect, timeout, or correct)
						  


					   ******************************/



							$trim_outputString = $outputString;
							$trim_input = $input;
							$trim_contents = $contents;
						
						
						
						
							$statement = "";
							
								
						        
							while($colonOccur--){
                              
								// Remove new line ("\n"), if any, in front of the string
								if($input[0]=="\n")
								{
									$input[0] = "";
								}
								if($outputString[0]=="\n")
								{
									$outputString[0] = "";
								}
								if($contents[0]=="\n")
								{
									$contents[0] = "";
								}
						
						  //  fwrite($fr,$colonOccur."hahahhaha!\n");
							// Find out the position of ";" in the file so as to obtain the current testcase. Some
							// of these variables might be unused ahead
								$colonIndex1 = strpos($input,";");
								$colonIndex2 = strpos($outputString,";");
								$colonIndex3 = strpos($contents,";");
								$colonIndex4 = strpos($trimContents,";");
								$colonIndex5 = strpos($treatedString,";");
								
						        //fclose($file1);
								

								// Will need to check if this is of any significance [ :-) ]
								if(!strpos($trimContents,";"))
								{
								  

								}

								// Infer from the comparison, whether the code has passed, or failed the test case

								if(substr($trimContents,0,$colonIndex4)==substr($treatedString,0,$colonIndex5))
								{
									$answer = "<b>"."Passed"."</b>";
								}
								else
								{
									if(substr($trimContents,0,$colonIndex4) == "timeout")
									{
										$answer = "<b>"."Timeout"."</b>";

									}
									else
									{
									$answer = "<b>Failed</b>";
									}
								}



							    
								$writeto = "\nInput - <br>".substr($input,0,$colonIndex1)."<br>Expected - <br>".substr($outputString,0,$colonIndex2)."<br>Received - <br>".substr($contents,0,$colonIndex3)."<br>".$answer."<br>";
							// fwrite($file1,"\nstring - ".str_replace(substr($trimContents,0,$colonIndex4+1),"a",$trimContents)." ");
								$statement .= $writeto;

								$input = str_replace_first(substr($input,0,$colonIndex1+2),"",$input);
								$outputString = str_replace_first(substr($outputString,0,$colonIndex2+2),"",$outputString);
								$contents = str_replace_first(substr($contents,0,$colonIndex3+2),"",$contents);
								$trimContents = str_replace_first(substr($trimContents,0,$colonIndex4+2),"",$trimContents);
								$treatedString= str_replace_first(substr($treatedString,0,$colonIndex5+2),"",$treatedString);
							   
							  
							}
							
							//$statement[strrpos($statement,"\n")] = "";


							// If condition to create different temperory files depending upon compilation/ submission 
							if(isset($_POST['compile']))  
						{

							 // Open Temporary file
								$fr=fopen("$username/$test_id/$problemId/testcasecheck.txt","w+");


							 // Write the necessary details to the temporary file.
							fwrite($fr,$statement);
							fclose($fr);
							
							$query = "UPDATE submissions SET Status=1 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
							mysql_query($query);
							header("Location: solve.php?oerror=1&id=".$_POST['id']."&mode=1");
						}
						 else
						{

						    // Open Temporary file
							$fr=fopen("$username/$test_id/$problemId/testcasecheck_submit.txt","w+");

							// Write the necessary details to the temporary file.
							fwrite($fr,$statement);
							fclose($fr);
							$query = "UPDATE submissions SET Submit_Status=1 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
							mysql_query($query);
							header("Location: solve.php?oerror=1&id=".$_POST['id']);
						}
							
							
						}
					   
					    
				}	
				


				// Time out error
				 
				else if($status == 2) {
					$query = "UPDATE submissions SET Status=1 WHERE (RegNo='".$_SESSION['username']."' AND Problem_Id='".$_POST['id']."')";
					mysql_query($query);
					header("Location: solve.php?terror=1&id=".$_POST['id']);
				}
			} 

			  // Compiler Error 
			else
				header("Location: solve.php?serror=1&id=".$_POST['id']); // compiler server not running
		}
	}
?>
