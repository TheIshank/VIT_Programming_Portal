<?php
session_start();
if(isset($_POST['timesub']))
{
   $_SESSION['testid']=$_POST['testid'];
  
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
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


            
              window.open("schedule.php",target='_self');
            


 
           
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
</head>
<body>
	 <center>
     <h2>Change Test Timings</h2>
	 <form method="post" name="testform" onsubmit="return(validate())">
           Start Time: <input type="text" value="" id="datetimepicker" name="stime"><p id="stimevalid" name="errorp"></p><br>
           End Time: <input type="text" value="" id="datetimepicker2" name="etime"><p id="etimevalid" name="errorp"></p><br>
            <input type="submit" value="CHANGE TEST SCHEDULE" name="submit" >

	 </form>


   <?php

    if(isset($_POST['submit']))
    {

        $stime=$_POST['stime'];
        $etime=$_POST['etime'];

       

        $testid=$_SESSION['testid'];

     //   echo "Stime:".$datestime." Etime: ".$dateetime." testid ".$testid;

        $conn=mysqli_connect("localhost","root","","newhnt");

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
    

	</body>
<script src="./jquery.js"></script>
<script src="build/jquery.datetimepicker.full.js"></script>
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
</html>
