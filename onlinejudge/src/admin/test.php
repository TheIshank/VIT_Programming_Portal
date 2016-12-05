<html>
<body>
<textArea rows="5" cols="25">
<?php
  $path = "1/input.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
?></textArea>
</body>
</html>
