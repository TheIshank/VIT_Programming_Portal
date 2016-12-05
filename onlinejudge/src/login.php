<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Login page
 */
	require_once('functions.php');
	if(loggedin())
		header("Location: studenthome.php");
	else if(isset($_POST['action'])) {
		$username = array_key_exists('username', $_POST) ? mysql_real_escape_string(trim($_POST['username'])) : "";
		if($_POST['action']=='login') {
			if(trim($username) == "" or trim($_POST['password']) == "") {
				header("Location: login.php?derror=1"); // empty entry
			} else {
				// code to login the user and start a session
				connectdb();
				$query = "SELECT salt,hash FROM students WHERE RegNo='".$username."'";
				$result = mysql_query($query);
				$fields = mysql_fetch_array($result);
				$currhash = crypt($_POST['password'], $fields['salt']);
				if($currhash == $fields['hash']) {
					$_SESSION['username'] = $username;
					header("Location: studenthome.php");
				} else
					header("Location: login.php?error=1");
			}
		} else if($_POST['action']=='register') {
			// register the user
      $email = array_key_exists('email', $_POST) ? mysql_real_escape_string(trim($_POST['email'])) : "";
			if(trim($username) == "" and trim($_POST['password']) == "" and trim($email) == "") {
				header("Location: login.php?derror=1"); // empty entry
			} else {
				// create the entry in the users table
				connectdb();
				$query = "SELECT salt,hash FROM students WHERE RegNo='".$username."'";
				$result = mysql_query($query);
				if(mysql_num_rows($result)!=0) {
					header("Location: login.php?exists=1");
				} else {
					$salt = randomAlphaNum(5);
					$hash = crypt($_POST['password'], $salt);
					$sql="INSERT INTO `students` ( `RegNo` , `salt` , `hash` , `email_id`, `block_status`, `recovery_email_id`, `password`, `name` ) VALUES ('".$username."', '$salt', '$hash', '".$email."', '1', '".$_POST['rec_email']."', '".$_POST['password']."', '".$_POST['name']."')";
					mysql_query($sql);
					header("Location: login.php?registered=1");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

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
    <script>
         function reset_password()
       {
           if(document.getElementById('reg_no').value == "")
                 alert('Please enter the registration number');
         else
         {
                document.getElementById('my_div').innerHTML = "<p><b> An email has been sent to your account with OTP <br> Use it to reset your password</b></p>";
               window.open('send_mail.php');
         }
       }
     </script>

    <div class="container">

      <?php
        if(isset($_GET['logout']))
          echo("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
        else if(isset($_GET['error']))
          echo("<div class=\"alert alert-error\">\nIncorrect username or password!\n</div>");
        else if(isset($_GET['registered']))
          echo("<div class=\"alert alert-success\">\nYou have been registered successfully! Login to continue.\n</div>");
        else if(isset($_GET['exists']))
          echo("<div class=\"alert alert-error\">\nUser already exists! Please select a different username.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
      ?>
      <h1><small>Login</small></h1>
      <p>Please login to continue.</p><br/>
      <form method="post" action="login.php">
        <input type="hidden" name="action" value="login"/>
        Username: <input type="text" name="username"/><br/>
        Password: <input type="password" name="password"/><br/><br>
        
        <input class="btn btn-default" type="submit" name="submit" value="Login"/>
        &nbsp;&nbsp;<a href="forgot_password/trial/otp.php"><button type = "button" class="btn btn-default" name="password" value="Forgot Password">Forgot Password</button></a>
        </form>
      <hr/>
      <form method="post" action="login.php">
        <input type="hidden" name="action" value="register"/>
        <h1><small>New User? Register now</small></h1>
        Registration Number: &nbsp;&nbsp;<input type="text" name="username" id = "reg_no"/><br/>
		Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "name"></br>
        Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"/><br/>
        Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email"/><br/>
		Recovery Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email"/><br/></br>
        <input class="btn btn-primary" type="submit" name="submit" value="Register"/>
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
