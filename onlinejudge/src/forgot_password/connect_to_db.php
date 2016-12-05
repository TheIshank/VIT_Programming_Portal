<?php
     $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $dbname = "vit_programming_portal_2";

					// Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
	 if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	  }
?>