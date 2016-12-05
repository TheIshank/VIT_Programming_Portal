  <?php

    require_once('../../admin-login/functions.php');
  if(!loggedinAdmin())
    header("Location: ../../admin-login/login.php");
  else if($_SESSION['usernameAdmin'] !== 'admin')
    header("Location: ../../admin-login/login.php");
  else
    include('../../header1.php');
    connectdb();
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



  <script type="text/javascript">
        
   var addButtonFlag = true;
   var OpenStatus=0;
   var OpenStart=0;
   var CurrentOpen;
   var ChangedStart=0;
   function create(buttonHandler)
   {
    //if(OpenStatus==1) {RemoveAllButtons(CurrentOpen);}

     //alert('OpenStatus'+ OpenStatus);

     if(addButtonFlag==false) {return;}
    
   // alert('addButtonFlag: '+addButtonFlag);
     var parentDiv=buttonHandler.parentNode;
     var CurrentOpen=parentDiv;
     OpenStatus=1;
    //CurrentOpen=buttonHandler.parentNode.id;
      //   alert("CurrentOpen: "+CurrentOpen);

    var CurrentNode=document.getElementById(CurrentOpen);
    
    
    //alert("nodes2");
   

    
    var TimingsForm=document.createElement("form");
    TimingsForm.setAttribute("method","post");
    TimingsForm.setAttribute("action","schedule2.php");
    TimingsForm.setAttribute("id","ChangeTime");

    var HiddenTest=document.createElement("input");
    HiddenTest.setAttribute("type","hidden");
    HiddenTest.setAttribute("name","testid");
    TimingsForm.appendChild(HiddenTest);
   
    
    var newbutt1=document.createElement('button');
    newbutt1.setAttribute("class","btn btn-success");
    newbutt1.setAttribute("type","submit");
    newbutt1.setAttribute("name","timesub");
    var text=document.createTextNode('CHANGE TIME');
    newbutt1.appendChild(text);
    
    TimingsForm.appendChild(newbutt1);

    //parentDiv.appendChild(newbutt1);
   
    parentDiv.appendChild(TimingsForm); 

    HiddenTest.setAttribute("value",""+HiddenTest.parentNode.parentNode.id);
    
    /*
    var newbutt2=document.createElement('button');
    var text=document.createTextNode('ETIME');
    newbutt2.appendChild(text);
    newbutt2.setAttribute("id","EndTimeButton");
    parentDiv.appendChild(newbutt2);

    var newbutt3=document.createElement('button');
    var text=document.createTextNode('REPORT');
    newbutt3.appendChild(text);
    newbutt3.setAttribute("id","ReportButton");
    parentDiv.appendChild(newbutt3);
     */


    var ButtonForm=document.createElement('form');
    ButtonForm.setAttribute("method","post");
    ButtonForm.setAttribute("id","FreezeButton");
    
    var newbutt5=document.createElement('button');
    var text=document.createTextNode('FREEZE');
    newbutt5.appendChild(text);
    
    // newbutt5.setAttribute("type","submit");
     newbutt5.setAttribute("name","FreezeButton");
     newbutt5.setAttribute("class","btn btn-primary");
     ButtonForm.appendChild(newbutt5);
    newbutt5.setAttribute("onClick","FreezeConfirm(this.parentNode.parentNode.id)");
   // parentDiv.appendChild(newbutt5);

    var hiddentest=document.createElement('input');
    hiddentest.setAttribute("type","hidden");
    hiddentest.setAttribute("id","OpenStatus");
    hiddentest.setAttribute("name","OpenStatus");
    ButtonForm.appendChild(hiddentest)
    
    parentDiv.appendChild(ButtonForm);
   


     var ButtonForm1=document.createElement('form');
    ButtonForm1.setAttribute("method","post");
    ButtonForm1.setAttribute("id","RemoveBeginKeyButton");
    
    var newbutt6=document.createElement('button');
    var text=document.createTextNode('REMOVE BEGIN KEY');
    newbutt6.appendChild(text);
    
    // newbutt5.setAttribute("type","submit");
     newbutt6.setAttribute("name","RemoveBeginKeyButton");
     newbutt6.setAttribute("class","btn btn-warning");
     ButtonForm1.appendChild(newbutt6);
    newbutt6.setAttribute("onClick","RemoveBeginKey(this.parentNode.parentNode.id)");
   // parentDiv.appendChild(newbutt5);

    var hiddentest=document.createElement('input');
    hiddentest.setAttribute("type","hidden");
    hiddentest.setAttribute("id","BeginKeyStatus");
    hiddentest.setAttribute("name","BeginKeyStatus");
    ButtonForm1.appendChild(hiddentest)
    
    parentDiv.appendChild(ButtonForm1);
   
    var assessform=document.createElement('form');
    assessform.setAttribute("name","aform");
    assessform.setAttribute("method","post");
    assessform.setAttribute("action","Test Schedule/testschedule/assessment.php");
    assessform.setAttribute("id","AssessmentButton");
    
    var newbutt6=document.createElement('input');
    newbutt6.setAttribute("type","submit");
    newbutt6.setAttribute("class","btn btn-info");
    
    newbutt6.setAttribute("value","ASSESSMENT");
    newbutt6.setAttribute("name","ASSESSMENT");
    
    hiddenid=document.createElement("input");
    hiddenid.setAttribute("type","hidden");
    hiddenid.setAttribute("name","testid");
    hiddenid.setAttribute("id","testid");
    assessform.appendChild(hiddenid);
    
    assessform.appendChild(newbutt6);
    
    parentDiv.appendChild(assessform);

    hiddenid.setAttribute("value",""+hiddenid.parentNode.parentNode.id);
    

    var newbutt4=document.createElement('button');
    var text=document.createTextNode('CLOSE');
    newbutt4.appendChild(text);
    newbutt4.setAttribute("id","CloseButton");
    newbutt4.setAttribute("class","btn btn-danger");
    
    parentDiv.appendChild(newbutt4);
    newbutt4.setAttribute("onClick","RemoveAllButtons(this.parentNode)");

    parentDiv.appendChild(newbutt4);
    
     addButtonFlag=false;
     OpenStatus=1;
        
    }

    function RemoveAllButtons(parentDiv)
    {   


      
       
      addButtonFlag=true;
        
         //while(parentDiv.firstChild) {parentDiv.removeChild(parentDiv.firstChild);}

       
       parentDiv.removeChild(document.getElementById("ChangeTime"));
     //   parentDiv.removeChild(document.getElementById("EndTimeButton"));  
      //  parentDiv.removeChild(document.getElementById("ReportButton"));
        parentDiv.removeChild(document.getElementById("FreezeButton"));
        parentDiv.removeChild(document.getElementById("AssessmentButton"));
        parentDiv.removeChild(document.getElementById("RemoveBeginKeyButton"));
        parentDiv.removeChild(document.getElementById("CloseButton"));
        
       /*
        for(var i=8;i<parentDiv.childNodes.length;i++)
          //{alert(parentDiv.childNodes[i].id);}
          {parentDiv.removeChild(parentDiv.childNodes[i]);}
        //alert(i);
        */
        OpenStart=0;
        ChangedStart=0;
         OpenStatus=0;
    }
 
    function ChangeStartTime(parentDiv)
    {
       if(!OpenStart)
        {
          if(!ChangedStart)
          {
          var ChangeTimeForm=document.createElement("form");
          ChangeTimeForm.setAttribute("method","post");
          ChangeTimeForm.setAttribute("action","changetim.php");

          var NewTime=document.createElement("button");
          var TextTime=document.createTextNode("Change Timings")
         // NewTime.setAttribute("value","Change Timings");
         NewTime.appendChild(TextTime);
         // NewTime.setAttribute("name","changetim");
       /*   NewTime.setAttribute("placeholder","Enter New Start Time");
          NewTime.setAttribute("id","datetimepicker");
         */
          NewTime.setAttribute("OnSubmit");
          ChangeTimeForm.appendChild(NewTime);

          parentDiv.appendChild(ChangeTimeForm);
      //parentDiv.innerHTML+= 'Start Time: <input type="text" value="" id="datetimepicker" name="stime"><p id="stimevalid" //name="errorp"></p><br>';
          ChangedStart=1;
          OpenStart=1;
        }
        }
        else
        {
          //parentDiv.removeChild(startNode);
          OpenStart=0;
        }
      

    }
    
    function FreezeConfirm(testID)
    {
       if(confirm("Do you want to freeze test ID: "+ testID))
       { 
           
           document.getElementById('OpenStatus').value=testID;
           //alert(document.getElementById('OpenStatus').value);
       }
        

    }
    function RemoveBeginKey(testID)
    {
        if(confirm("Do you want to Remove Begin Key for test ID:" + testID))
        {
           
           document.getElementById('BeginKeyStatus').value=testID;

        }

    }



</script>


  

   
   
    
    <div class="container">

    <?php
   require('showtests.php');
     ?>
    </div>

  <?php
             if(isset($_POST['FreezeButton']))
             {

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vit_programming_portal_2";
              
                $StatusTestId=$_POST['OpenStatus'];
                
                //echo "<br>".$StatusTestId."<br>";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "update tests set Open_Status=0 where Test_Id='$StatusTestId'";
               // echo $sql;
                if(!$result = $conn->query($sql)){
                            die('There was an error running the query [' . $conn->error . ']');
                  }

              
 
              //s  $conn->query($sql);

             }
             if(isset($_POST['RemoveBeginKeyButton']))
             {
                  $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vit_programming_portal_2";
              
                $BeginKeyStatusTestId=$_POST['BeginKeyStatus'];
                
                //echo "<br>".$StatusTestId."<br>";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "update tests set Remove_Begin_Key=1 where Test_Id='$BeginKeyStatusTestId'";
                //echo $sql;
                if(!$result = $conn->query($sql)){
                            die('There was an error running the query [' . $conn->error . ']');
                  }

              

             }


  ?>


<?php
    include('../../footer.php');
?>




  