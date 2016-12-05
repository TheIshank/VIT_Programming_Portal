<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * PHP script that returns for AJAX requests
 */
 include('../header1.php');
 echo "<li><a href='index.php'>Admin Panel</a></li>
              <li><a href='users.php'>Users</a></li>
              <li><a href='logout.php'>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>";
if(is_numeric($_GET['id'])) {
		// formatting for codes
		include('functions.php');
		connectdb();
		echo("<hr/><h1><small>".$_GET['name']."</small></h1>\n");
		$query = "SELECT Submitted_Solution_Path FROM submissions WHERE (RegNo='".mysql_real_escape_string($_GET['uname'])."' AND Problem_Id='".$_GET['id']."')";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$count = mysql_num_rows($result);
		if(!$count)
		{
			echo ("<div class=\"alert alert-info\">\nThe student has not attempted the problem.\n</div>");
		}
		else
		{
		$path = "../onlinejudge/src/".$row['Submitted_Solution_Path'];
		$file = fopen($path,"r");
		$contents = fread($file,filesize($path));
		$str = str_replace("<", "&lt;", $contents);
		echo("<br/><br/>\n<pre>".str_replace(">", "&gt;", $str)."</pre>");

		$query = "SELECT Status,Submit_Status,Test_Id FROM submissions where (RegNo='".mysql_real_escape_string($_GET['uname'])."' AND Problem_Id='".$_GET['id']."')";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$username = $_GET['uname'];
				$Problem_Id = $_GET['id'];
				$Test_Id = $row['Test_Id'];


		if($row['Submit_Status'] == 2)
		{
			echo ("<div class=\"alert alert-success\">\nThe student has solved the problem.\n</div>");
		}
        else
        {
        	if($row['Submit_Status'] == 0)
        	 {
        	 	echo("<div class=\"alert alert-info\">\nThe Student has not submitted the problem\n</div>");
        	 }
        	if($row['Submit_Status'] == 1)
        	{
        		echo("<div class=\"alert alert-info\">\nList of Hidden Test Cases are as follows:\n</div>");
				$myFile = fopen("../onlinejudge/src/$username/$Test_Id/$Problem_Id/testcasecheck_submit.txt","r");
				
		   
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
        	
         	if($row['Status'] == 2)
			{
			echo ("<div class=\"alert alert-success\">\nThe student has passed only sample test cases.\n</div>");
			}
			else
			{
				echo("<div class=\"alert alert-info\">\nList of Sample Test Cases are as follows:\n</div>");
				
				$myFile = fopen("../onlinejudge/src/$username/$Test_Id/$Problem_Id/testcasecheck.txt","r");
			
				
		   
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
	}
}
	include('../footer.php');
?>
