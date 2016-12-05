<?php

		require_once('../admin-login/functions.php');
	if(!loggedinAdmin())
		header("Location: ../admin-login/login.php");
	else if($_SESSION['usernameAdmin'] !== 'admin')
		header("Location: ../admin-login/login.php");
	else
		include('../header1.php');
		connectdb();
?>              
              
              <li class="dropdown">
			   <a class="dropdown-toggle" data-toggle="dropdown" href="#">Schedule
			   <span class="caret"></span></a>
			      <ul class="dropdown-menu">
				      <li><a href="Test Schedule/testschedule/schedule.php">Code Test</a></li>
					  <li><a href="">MCQ Test</a></li>
				  </ul>
			  </li>
              <li><a href="candidate_management/candidate_management.php">Candidate Management</a></li>
              <li><a href="">Reports</a></li>
              <li><a href="">Profile</a></li>
			  <li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Code Test
			   <span class="caret"></span></a>
			      <ul class="dropdown-menu">
					<li><a href="admin-login/problems.php">Create Problem</a></li>
					<li><a href="scheduling_a_code_test/scheduling_a_code_test.php">Create Test</a></li>
				  </ul>
			  </li>
			  <li><a href="">MCQ Test</a></li>
			  <li><a href="database_page/searchdetails.php">Database</a></li>
			  <li><a href="email_group/emailgroup.php">Create Email Group</a></li>
			  <li><a href="admin-login/logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
   
	<style>
.table-borderless tbody tr td, .table-borderless tbody tr th, .table-borderless thead tr th {
    border: none;
}
	</style>
	 
	 <script type="text/javascript">
       function validate()
       {
	  // alert("raichu");

           var validFlag = true; 
           var pelements=document.getElementsByName('errorp');
           var i=0;
           for(i=0;i<pelements.length;i++)
               {pelements[i].innerHTML="";}
            
           var TestTitle= document.testform.title.value;
		   
		  // alert(TestTitle);

           if(TestTitle=="")
           	   {document.getElementById('titlevalid').innerHTML="Enter the Test Title";validFlag = false;}

           	var StartDate=document.testform.stime.value;
             //  alert(StartDate);
           	if(StartDate=="")
           	   {document.getElementById('stimevalid').innerHTML="Enter the Start Time";validFlag=false;}

           	var EndDate=document.testform.etime.value;
           // alert(EndDate);
             if(EndDate=="")
           	   {document.getElementById('etimevalid').innerHTML="Enter the End Time";validFlag=false;}
			   
             if(document.getElementById("beginKeyCheckbox").checked)
			 {
           	var BeginKey=document.testform.begingKey.value;
           
             if(BeginKey=="")
           	   {document.getElementById('keyvalid').innerHTML="Enter the Begin Key";validFlag=false;}
			   }
			  // alert (validFlag);
 
          return validFlag;
       }
</script>
 
  

     <form method = "POST">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Batch: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ="text" name = "batch" value = '<?php if(isset($_POST["batch"])) echo $_POST["batch"] ?>' style = "height:25px;"> <br>
     <br>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type = "submit" name = "sub" class = "btn btn-default"> PROCEED </button><br>  
	 </form>
	 
	 <form method = "post" action="scheduling_a_code_test/schedule.php" name="testform" onsubmit="return validate()" >
	     
		
		 
		  <?php include('my_retrieval.php'); ?>
		 
		 
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="title" id = "title" style = "height:25px;"> <p id="titlevalid" name="errorp"></p>
		 <br>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start Time:&nbsp;&nbsp;&nbsp; <input type="text" value="" id="datetimepicker" name="stime" style = "height:25px;"> <p id="stimevalid" name="errorp"></p>
		 <br>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Time: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" id="datetimepicker2" name="etime" style = "height:25px;"> <p id="etimevalid" name="errorp"></p>
		 <br>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Key Entered To Begin Test:&nbsp;&nbsp; <input type="checkbox" id="beginKeyCheckbox" onchange="beginKeyStatus()" name = "beginKeyCheckbox" style = "height:25px;">
		 <br>
		 <br>
		 <div id="beginKeyDiv" > </div>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="schedule" value = "SCHEDULE" class = "btn btn-default"> 
	 </form>
	 
	 
<link rel="stylesheet" type="text/css" href="scheduling_a_code_test/datetimepicker-master/jquery.datetimepicker.css"/>	 
<script src="scheduling_a_code_test/datetimepicker-master/jquery.js"></script>
<script src="scheduling_a_code_test/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>




<script>

// Script for DatePicker

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
/*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
startDate:	'2016/01/01'
});
$('#datetimepicker').datetimepicker({value:'',step:10});

$('#datetimepicker2').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
/*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
startDate:	'2016/01/01'
});
$('#datetimepicker2').datetimepicker({value:'',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker2').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
/*disabledDates:['1986/01/08','1986/01/09','1986/01/10'],*/
startDate:	'2016/01/01'
});
$('#datetimepicker').datetimepicker({value:'',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

</script>

<script>

	// Script for displaying Begin Key input field according to the  Key Entered To Begin Test checkbox
   
	function beginKeyStatus()
	{
		var beginKeyDiv=document.getElementById("beginKeyDiv");
		
		if(document.getElementById("beginKeyCheckbox").checked)
		{
			beginKeyDiv.innerHTML='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Begin Key <input type="text" name="beginKey" id="beginKey" > <p id="keyvalid" name="errorp"></p><br> ';
		}
		else
		{
			beginKeyDiv.innerHTML='';
		}
	}

</script>
<?php
    include('../footer.php');
?>



<!-- valixation pending --!>