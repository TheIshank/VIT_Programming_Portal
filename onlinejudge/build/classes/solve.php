<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Solution submission page
 */
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		connectdb();
?>
              <li><a href="studenthome.php">Tests</a></li>
              <li><a href="submissions.php">Submissions</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
	<link rel="stylesheet" type="text/css" href="css/codemirror.css">
<link rel="stylesheet" type="text/css" href="css/ambiance.css">
<link rel="stylesheet" type="text/css" href="css/solarized.css">
<script type="text/javascript" src="js/codemirror.js"></script>
<script type="text/javascript" src="js/clike/clike.js"></script>
	<script type="text/javascript" src="js/python/python.js"></script>
	
	   <div class="container">

<?php 
      /*  $query = "SELECT * FROM prefs";
        $result = mysql_query($query);
        $accept = mysql_fetch_array($result);*/

        // To find out whether the student is blocked or not
        $query = "SELECT Block_Status FROM students WHERE RegNo='".$_SESSION['username']."'";
        $result = mysql_query($query);
        $status = mysql_fetch_array($result);
      
        if($status['Block_Status'] == 0)
          echo("<div class=\"alert alert-error\">\nYou have been banned. You cannot submit a solution.\n</div>");
      ?>
	    <h1><small>Submit Solution</small></h1>
      <?php


        // display the problem statement
      	if(isset($_GET['id']) and is_numeric($_GET['id'])) {
      		$query = "SELECT * FROM problems WHERE Problem_Id='".$_GET['id']."'";
          	$result = mysql_query($query);
          	$row = mysql_fetch_array($result);
      		include('markdown.php');
			$file = fopen("../../".$row['Description_Path'],'r');// Path of the problem statement/Description File
			
			
		$out = Markdown(fread($file,filesize("../../".$row['Description_Path'])));
		echo("<hr/>\n<h1>".$row['Problem_Title']."</h1>\n");
		echo($out);
		fclose($file);
        
		// Logic to find out if some particular language has been frozen
		// $flag = 1 indicates that no language has been frozen, else the other flags are used.
		$flag1 = 0;
		$flag2 = 0;
		$flag3 = 0;
		$flag4 = 0;
		$flag = 0;
		
		if(($row['Lang_Freeze'])!= "")
		{
			if($row['Lang_Freeze'] == "c")
			{
				$flag1 = 1;
			}
			else if($row['Lang_Freeze'] == "cpp")
			{
				$flag2 = 1;
			}
			else if($row['Lang_Freeze'] == "java")
			{
				$flag3 = 1;
			}
			else if($row['Lang_Freeze'] == "python")
			{
				$flag4 = 1;
			}
		}
		else
		{
			$flag = 1;
		}
      ?>
      <br/><span class="label label-info">Time Limit: <?php echo($row['Execution_Time']/1000); ?> seconds</span>
      <hr/>
      <?php

        // get the peviously submitted solution if exists
        if(is_numeric($_GET['id'])) {
          $query = "SELECT * FROM submissions WHERE (Problem_Id='".$_GET['id']."' AND RegNo='".$_SESSION['username']."')";
          $result = mysql_query($query);
          $num = mysql_num_rows($result);
          $fields = mysql_fetch_array($result);
        }
      ?>
      <form method="post" action="eval.php">

      <?php
        // Hidden input to indicate if it is a new solution, or modification of existing solution

        if($num == 0)
          echo('<input type="hidden" name="ctype" value="new"/>');
        else
          echo('<input type="hidden" name="ctype" value="change"/>');
      ?>

      <!-- Other hidden inputs -->
      <input type="hidden" name="id" value="<?php if(is_numeric($_GET['id'])) echo($_GET['id']);?>"/>
      <input type="hidden" name="lang" id="hlang" value="<?php if($flag) echo('Select'); else if($row['Lang_Freeze'] != "") echo($row['Lang_Freeze']); else echo($fields['Language_Used']); ?>"/>
      <div class="btn-group">
        <div id="blank"></div>
        <a id="lang" class="btn dropdown-toggle" data-toggle="dropdown" href="#">Language: 
        <?php

        // Displaying the drop down menu (Depending on whether language has been frozen, or not)
		  if($flag) echo('Select');
		  else 
		  {
          if($flag1) echo('C');
          else if($flag2) echo('C++');
          else if($flag3) echo('Java');
          else if($flag4) echo('Python');
		  }
        ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
		<li><a>Select</a><li>
		<?php

		// Code to indicate to CodeMirror, the code editor, the language in which the code is going to be written.
		// Necessary because this ensures that keywords of this particular language are highlighted in the editor.\
		// Definition of changeLang() Function at the bottom  (Between Script Tags) 
		if(!$flag1 && !$flag)
		{
		    echo "<li><a href=# onclick =changeLang('C'), return false; style = color:#ccc;>C</a></li>";
		}
		else
		{
			echo "<li><a href=# onclick =changeLang('C');>C</a></li>";
		}
		if(!$flag2 && !$flag)
		{
			
         echo "<li><a href=# onclick =changeLang('C++'), return false; style = color:#ccc;>C++</a></li>";
		}
		else
		{
			echo "<li><a href=# onclick =changeLang('C++');>C++</a></li>";
		}
		if(!$flag3 && !$flag)
		{
         echo "<li><a href=# onclick =changeLang('Java'), return false; style = color:#ccc;>Java</a></li>";
		}
		else
		{
			echo "<li><a href=# onclick =changeLang('Java');>Java</a></li>";
		}
		if(!$flag4 && !$flag)
		{
         echo "<li><a href=# onclick =changeLang('Python'), return false; style = color:#ccc;>Python</a></li>";
		}
		else
		{
			echo "<li><a href=# onclick =changeLang('Python');>Python</a></li>";
		}
          
        
	  ?>
	  </ul>
      </div>
      <br/>
      <!--Filename: <input class="span8" type="hidden" id="filename" name="filename" value="<?php //if(!($num == 0)) echo($fields['filename']);?>"/>-->


      <br/>Type your program below:<br/><br/> 
		 <!-- Get Pre Code and display it in a Code Editor window -->
		 <?php
		    // Read the precode specified in the precode file, and display it. This is read-only.
		    $file = fopen("../../".$row['Precode_Path'],'r');
			if(filesize("../../".$row['Precode_Path'])>0)
			{
			$code1 = fread($file,filesize("../../".$row['Precode_Path']));
		     echo "<textarea id='pre' name = 'precode' class='CodeMirror'>" ;echo $code1;echo " </textarea>";
			}
			fclose($file);
		 ?>
	 <!-- Main code editor window, where the code will be written -->
	 <textarea id="template-html" name="soln"  class="CodeMirror">
	 <?php 
     // Check if there has been a submission so far. If yes, display the last submission. $num checks the number of rows     associated with the registration number, the test number and the problem Id.
	 if($num!=0)
	 {


	 $file = fopen($fields['Solution_Path'],'r');
			if(filesize($fields['Solution_Path'])>0)
			{
			$code1 = fread($file,filesize($fields['Solution_Path']));
		    echo $code1;
			}
			fclose($file);
	 }
	 ?></textarea>
	  <!-- Get Post Code and display it in a Code Editor window -->
	     <?php
	     // Read the postcode specified in the postcode file, and display it. This is read-only.
		    $file = fopen("../../".$row['Postcode_Path'],'r');
			if(filesize("../../".$row['Postcode_Path'])>0)
			{
			$code2 = fread($file,filesize("../../".$row['Postcode_Path']));
		    echo "<textarea id='post' name = 'postcode' class='CodeMirror'>"; echo $code2;echo " </textarea>";
			}
			fclose($file);
		 ?>

<!-- Javascript used for Codemirror, the code editor class -->
<script language="javascript">
      var config1,config2,config3, editor1,editor2,editor3;
// Configuration for the pre-code code editor window.
    config1 = {
        lineNumbers: true,
		mode: "text/x-c",
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: false
    };

 // Configuration for the main code editor window
	config2 = {
        lineNumbers: true,
		mode: "text/x-c",
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: true
    };
	// Configuration for the post-code code editor window.
	config3 = {
        lineNumbers: true,
		mode: "text/x-c",
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: true
    };
    // Instatiate objects with the specific configurations
    editor1 = CodeMirror.fromTextArea(document.getElementById("template-html"), config1);
    editor2 = CodeMirror.fromTextArea(document.getElementById("pre"), config2);
	editor3 = CodeMirror.fromTextArea(document.getElementById("post"), config3);
	//editor1.setSize(500, 300);
	editor2.setSize("100%", 200);
	editor3.setSize("100%", 200);
	

    function selectTheme() {
        editor1.setOption("theme", "ambiance");
		editor2.setOption("theme", "ambiance");
		editor3.setOption("theme", "ambiance");
		
		
    }
    setTimeout(selectTheme, 5000);
	
     

     // Function to detect change in the language selected in the drop-down menu.
      function changeLang(lang) {
		  var m = "";
        $('#lang').remove();
        $('#blank').after('<a id="lang" class="btn dropdown-toggle" data-toggle="dropdown" href="#">Language: ' + lang + ' <span class="caret"></span></a>');
        // Variable 'm' stores the CodeMirror string associated with the selected language. For example, for c, mode becomes  - 'text/x-c'.
        if(lang == 'C')
		{
          $('#hlang').val('c');
		  //m = m.concat('x-c');
		  m = "text/x-c";
		}
        else if(lang== 'C++')
		{
          $('#hlang').val('cpp');
		   //m = m.concat('x-c++');
		    m = "text/x-c++src";
		}
        else if(lang== 'Java')
		{
          $('#hlang').val('java');
		   ///m = m.concat('x-java');
		    m = "text/x-java";
		}
        else if(lang== 'Python')
		{
          $('#hlang').val('python');
		   //m = m.concat('python');
		    m = "python";
		   
		}
		
	
	// Redefine all configurations based on the selected language.	
		var config1,config2,config3, editor1,editor2,editor3;

    config1 = {
        lineNumbers: true,
		mode: m,
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: false
    };
	
	config2 = {
        lineNumbers: true,
		mode: m,
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: true
    };
	
	config3 = {
        lineNumbers: true,
		mode: m,
        theme: "ambiance",
        indentWithTabs: true,
        readOnly: true
    };
	
	

    editor1 = CodeMirror.fromTextArea(document.getElementById("template-html"), config1);
	editor2 = CodeMirror.fromTextArea(document.getElementById("pre"), config2);
	editor3 = CodeMirror.fromTextArea(document.getElementById("post"), config3);
	//editor1.setSize(500, 300);
	editor2.setSize("100%", 200);
	editor3.setSize("100%", 200);

    function selectTheme() {
        editor1.setOption("theme", "ambiance");
		editor2.setOption("theme", "ambiance");
		editor3.setOption("theme", "ambiance");
		
    }
    setTimeout(selectTheme, 5000);
      }
    </script>
	 <br>
	 <br>
	 
               <?php
                  // Compile and Test, Submit Buttons
	  				echo("<input type=\"submit\" value=\"Compile and Test\" name=\"compile\" class=\"btn btn-primary btn-large\"/>&nbsp;&nbsp;<input type=\"submit\" value=\"Submit\" name=\"submit\" class=\"btn btn-success btn-large\"/>");
                ?>
      <span class="label label-info">You are allowed to use any of the following languages: 
      <?php $txt="";
        if( $flag1 || $flag) $txt = "C, ";
        if($flag2 || $flag) $txt = $txt."C++, ";
        if($flag3|| $flag) $txt = $txt."Java, ";
        if($flag4|| $flag) $txt = $txt."Python, ";
        $final = substr($txt, 0, strlen($txt) - 2);
        echo($final."</span>\n");
      ?>
      </form>
      <?php
	}
      ?>
	  
	  
	  <?php
	     if(isset($_GET['success']))
	     {
	     	if($_GET['success'] == 1)
	     	{
          		echo("<div class=\"alert alert-success\">\nCongratulations! The sample testcases have passed.\n</div>");
            }
            else
            {
      			echo("<div class=\"alert alert-success\">\nCongratulations! You have solved the problem.\n</div>");
            }
        }
    	else if(isset($_GET['terror']))
          echo("<div class=\"alert alert-warning\">\nYour program exceeded the time limit. Maybe you should improve your algorithm.\n</div>");
        else if(isset($_GET['cerror']))
          echo("<div class=\"alert alert-error\">\n<strong>The following errors occured:</strong><br/>\n<pre>\n".$_SESSION['cerror']."\n</pre>\n</div>");
        else if(isset($_GET['oerror']))
		{
			echo("<div class=\"alert alert-error\">\nYour program output did not match the solution for the problem. Please check your program and try again.<br></div>");
			if(isset($_GET["mode"]))   //checks which testcase has passed,failed or timedout and puts it in appropriate red,green or yellow div.
			{
				$username = $_SESSION['username']; 
				$Problem_Id = $_GET['id'];
				$Test_Id = $fields['Test_Id'];
				$myFile = fopen("$username/$Test_Id/$Problem_Id/testcasecheck.txt","r");
			
				
		   
				while(!feof($myFile))
			  
				{	   
					$tc = "";
					$line=fgets($myFile);
					   while(!strpos($line,"Passed") && !strpos($line,"Failed") && !feof($myFile) && !strpos($line,"Timeout"))
					   {  
						  
						  $tc .= $line."<br>";
						 // echo $tc."<br>";
						  //echo $line."<br>";	
						  $line = fgets($myFile); 
						//  echo "tc:-".$tc."<br>";
						  
					   }
					 //  echo "i am infinite";
						  //echo "<br>".feof($myFile);
						  $tc .= $line;
						
						 // echo $line."<br>";
						 // echo $line."<br>";
						  if(strpos($line,"Passed"))
						  {
							 // echo "test";
							  echo("<div class=\"alert alert-success\">\n".$tc."\n</div>");
						  }
						  else if(strpos($line,"Failed"))
						  {
							 // echo "test1";
							  echo("<div class=\"alert alert-error\">\n".$tc."\n</div>");
						  }
						  else if(strpos($line,"Timeout"))
						  {
							 // echo "test1";
							  echo("<div class=\"alert alert-warning\">\n TimeOut\n</div>");
						  }	  
						 
					   
				  }
		
		  
		 
		  fclose($myFile);
			}
		}
        else if(isset($_GET['lerror']))
          echo("<div class=\"alert alert-error\">\nYou did not use one of the allowed languages. Please use a language that is allowed.\n</div>");
        else if(isset($_GET['serror']))
          echo("<div class=\"alert alert-error\">\nCould not connect to the compiler server. Please contact the admin to solve the problem.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
        else if(isset($_GET['ferror']))
          echo("<div class=\"alert alert-error\">\nPlease enter a legal filename.\n</div>");
 ?>
	  
	  
    </div> <!-- /container -->
    
    
<?php
	include('footer.php');
?>
