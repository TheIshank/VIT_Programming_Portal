<?php
 session_start();


?>


<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Database Page</title>
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
          <a class="brand" href="#">Codejudge</a>
          <a class="brand" href='#'>Schedule</a>
          <a class="brand" href='#'>Candidate Mgmt</a>
          <a class="brand" href='#'>Reports</a>
          <a class="brand" href='#'> Profile</a>
          <a class="brand" href='#'> Content Mgmt</a>
          <a class="brand" href="searchdetails.php" > Database </a> 
        </div>
      </div>
    </div>
 </body>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>



<script>
  function AddBatch()
  {
     var batch=document.getElementById('batch').value;
     document.getElementById('batch1').value=batch;
     alert(batch);
  }
  function validate()
  {
    // alert('hi');
    //location.reload();
     var validFlag=true;
     var batch1=document.getElementsByName('batch');

     batch1.innerHTML="";
     

     var batch=document.getElementById('batch').value;
     if(batch=="")
        {
         document.getElementById('validBatch').innerHTML="Enter a batch";
         validFlag=false;
        }   
     // 
     return validFlag;

  }
  function valid2()
  {
   
    var validDegreeFlag=true;
     var degree=document.getElementsByName('degrees').value;
     if(degree="")
     {
          alert("hi");
         document.getElementById('validgree').innerHTML="Select atleast one field";
         validDegreeFlag=false;
     }


     return validDegreeFlag;

  }
</script>	
<body>
	
<div class="container">
  <h3>Enter Batch and Degree </h3>
  <form method = "POST" onSubmit="return(validate())">
     Batch: <input type ="text" name ="batch" id="batch" value ='<?php if(!isset($_POST["batch"])) echo $_POST["batch"] ?>'> 
     <p id='validBatch'></p><br>
     <button type = "submit" name = "sub" > PROCEED </button><br>  
 </form>

  <form method = "post" name='searchform'>
	    
		  <input type="hidden" name="batch1" value="">
		  <?php include('my_degreeretrieval.php'); ?>
		  
      <p id="validgree"></p>
		  <input type="submit" name="search" value = "SEARCH"> 
  </form>
   <?php
      include('showstudents.php');
    ?>
</div>
</body>


</html>