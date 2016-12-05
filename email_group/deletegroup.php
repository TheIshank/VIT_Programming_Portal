

<?php
	
	if(isset($_GET['groupid']))
	{
	   require("connect_to_db.php");
       
       $groupId = $_GET['groupid'];
	   
	    mysqli_query($conn," delete from email_group where Group_Id = '$groupId' ");	

       header("Location: emailgroup.php");

	}

?>