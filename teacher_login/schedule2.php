<?php
session_start();
if(isset($_POST['timesub']))
{
   $_SESSION['testid']=$_POST['testid'];
  
}
 include('../header1.php');

?>

<li class="dropdown">
         <a class="dropdown-toggle" data-toggle="dropdown" href="#">Schedule
         <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="">Code Test</a></li>
            <li><a href="">MCQ Test</a></li>
          </ul>
        </li>
              <li><a href="candidate_management/candidate_management.php">Candidate Management</a></li>
              <li><a href="scoreboard.php">Reports</a></li>
              <li><a href="account.php">Profile</a></li>
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


<link rel="stylesheet" type="text/css" href="teacher_login/datetimepicker-master/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<script type="text/javascript">
       function done()
       {
           //if(confirm("Test timings changed"))

            alert("Test Timings changed");


            
              window.open("teacher_login/tschedule.php",target='_self');
            


 
           
       }

       function validate()
       {

           var validFlag = true; 
           var pelements=document.getElementsByName('errorp');
           var i=0;
           for(i=0;i<pelements.length;i++)
               {pelements[i].innerHTML="";}
            
           var TestTitle= document.testform.title.value;

           if(TestTitle=="")
           	   {document.getElementById('titlevalid').innerHTML="Enter the Test Title";validFlag = false;}

           	var StartDate=document.testform.stime.value;

           	if(StartDate=="")
           	   {document.getElementById('stimevalid').innerHTML="Enter the Start Time";validFlag=false;}

           	var EndDate=document.testform.etime.value;

             if(EndDate=="")
           	   {document.getElementById('etimevalid').innerHTML="Enter the End Time";validFlag=false;}

           	var BeginKey=document.testform.bgkey.value;
           
             if(BeginKey=="")
           	   {document.getElementById('keyvalid').innerHTML="Enter the Begin Key";validFlag=false;}

             var TestType=document.testform.typ.value;

             if(TestType=="")
              {document.getElementById('typevalid').innerHTML="Enter the Test Type"; validFlag=false;}
          
          return validFlag;
       }
</script>

	 <center>
     <h2>Change Test Timings</h2><br>
	 <form method="post" name="testform" onsubmit="return(validate())">
           Start Time: <input type="text" value="" id="datetimepicker" name="stime" style = "height:25px;"><p id="stimevalid" name="errorp"></p><br>
           End Time: <input type="text" value="" id="datetimepicker2" name="etime" style = "height:25px;"><p id="etimevalid" name="errorp"></p><br>
            <input type="submit" value="CHANGE TEST SCHEDULE" name="submit" class = "btn btn-default">

	 </form>


   <?php

    if(isset($_POST['submit']))
    {

        $stime=$_POST['stime'];
        $etime=$_POST['etime'];

       

        $testid=$_SESSION['testid'];

     //   echo "Stime:".$datestime." Etime: ".$dateetime." testid ".$testid;

        $conn=mysqli_connect("localhost","root","","vit_programming_portal_2");

        if(mysqli_connect_errno())
        {
          die('Connection failed');
        }

        $flag=0;

        if($stmt=mysqli_prepare($conn,"UPDATE tests SET Start_Time=? WHERE Test_Id=? "))
        {

          mysqli_stmt_bind_param($stmt,"ss",$stime,$testid);
         
          mysqli_stmt_execute($stmt);
        //  echo "table updated";
          mysqli_stmt_close($stmt);
          $flag++;
          
        }
        

        if($stmt=mysqli_prepare($conn,"UPDATE tests SET End_Time=? WHERE Test_Id=? "))
        {

          mysqli_stmt_bind_param($stmt,"ss",$etime,$testid);


          mysqli_stmt_execute($stmt);
        //  echo "table updated";
          mysqli_stmt_close($stmt);
          $flag++;
        }


        if($flag==2) {
            
          echo "<script> done(); </script>";
          
          }


    }


   ?>
    


<script src="teacher_login/jquery.js"></script>
<script src="teacher_login/build/jquery.datetimepicker.full.js"></script>
<script>

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
<?php
    include('../footer.php');
?>
