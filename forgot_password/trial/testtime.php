
<?php
      date_default_timezone_set("Asia/Kolkata"); 
      $date=date("Y/m/d G:i:s");

      echo $date."<br>";
	  
	  $exp = date("Y/m/d G:i:s", strtotime("+30 minutes"));
	  
	  echo $exp."<br>";
	  
	  
	  if($exp<$date)
	     echo "exp greater";
	  else
	     echo "date greater";

?>