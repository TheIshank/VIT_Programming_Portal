<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Faculty Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Hammer And Tongs</a>
        </div>
      </div>
    </div>


<body>
	    <center>
	   <h3>Faculty Login</h3><br>
       <form method="post">
                Faculty Id: <input type="text" name="user"><br><br>
                Password: <input type="password" name="pw"><br><br>
                <input type="submit" value="SUBMIT" name="sub" class = "btn btn-default">

       </form>

        </center>

<?php
     if(isset($_POST['sub']))
     {

       	$regno=$_POST['user'];
        $pw=$_POST['pw'];

        include('conect_to_db.php');

        if($stmt=mysqli_prepare($conn,"SELECT Password from faculties where Faculty_Id=?"))
        {
        	mysqli_stmt_bind_param($stmt,"s",$regno);

        	mysqli_stmt_execute($stmt);

        	mysqli_stmt_bind_result($stmt,$realpw);

        	mysqli_stmt_fetch($stmt);

        	mysqli_stmt_close($stmt);
        }

      mysqli_close($conn);

      if($pw==$realpw)
      	 {
      	 	echo "Password Confirmed.Go to index page";
      	 	$_SESSION['regno']=$regno;
      	 	header("location:tschedule.php");

      	 }
      else
          {
      	   echo "Password incorrect.Try Again";
          }


     }


  include('../footer.php');
?>


