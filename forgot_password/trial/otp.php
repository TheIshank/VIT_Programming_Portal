<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<link href="css/bootstrap.css" rel="stylesheet">
  
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
function otpgen()
{
    var name=document.getElementById('regno').value; 


   //alert("Name"+name);


    try{
    var xmlhttp=new XMLHttpRequest();
    }
    catch(e) {alert("Error");}

    xmlhttp.open("POST","generateotp.php",true);
    var parameters='regno='+name;
	//alert(name);
    //alert(parameters);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.onreadystatechange=function()
    {
    	if(xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		document.getElementById('writeotp').innerHTML=xmlhttp.responseText;
    	}
    };
   
    xmlhttp.send(parameters);

}



function otpcompare()
{
	
   var name=document.getElementById('regno').value; 
   var entered_otp=document.getElementById('entered_otp').value;

   //alert("Name"+name);


    try{
    var xmlhttp=new XMLHttpRequest();
    }
    catch(e) {alert("Error");}

    xmlhttp.open("POST","getotpcompare.php",true);
    var parameters='regno='+name+'&otp='+entered_otp;
    //alert(parameters);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.onreadystatechange=function()
    {
    	if(xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		document.getElementById('writeotp').innerHTML=xmlhttp.responseText;
    	}
    };
    
    xmlhttp.send(parameters);
    

}

function newpwgen()
{
	
   var name=document.getElementById('regno').value; 
   var newpw=document.getElementById('newpw').value;
   var cnewpw=document.getElementById('cnewpw').value;
   

    try{
    var xmlhttp=new XMLHttpRequest();
    }
    catch(e) {alert("Error");}
    
    xmlhttp.open("POST","reset_password.php",true);
    var parameters='regno='+name+'&newpw='+newpw+'&cnewpw='+cnewpw;
    //alert(parameters);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.onreadystatechange=function()
    {
    	if(xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
    		document.getElementById('writeotp').innerHTML=xmlhttp.responseText;
    	}
    };

    xmlhttp.send(parameters);
    
}



</script>



<center>



 <h4>Enter Regno</h4><input type="text" name='regno' id="regno">
        <button Onclick="otpgen()">Generate OTP</button>



<p id="writeotp"></p>

</center>

<?php
    include('../../footer.php');
?>