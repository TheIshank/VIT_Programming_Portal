function reset1()

{   

 document.getElementById("text1").innerHTML='<input type="text" class="form-control" required placeholder="Enter The Option (Required)" id="usr1" name="usr1">';
 document.getElementById("check1").innerHTML='<label><input type="checkbox" value="1" name="ans[]"></label>'; 

}

function reset2()

{   

 document.getElementById("text2").innerHTML='<input type="text" class="form-control" required placeholder="Enter The Option (Required)" id="usr2" name="usr2">';
 document.getElementById("check2").innerHTML='<label><input type="checkbox" value="2" name="ans[]"></label>'; 

}

function reset3()

{   

 document.getElementById("text3").innerHTML='<input type="text" class="form-control" placeholder="Enter the option" id="usr3" name="usr3">';
 document.getElementById("check3").innerHTML='<label><input type="checkbox" value="3" name="ans[]"></label>'; 

}

function reset4()

{   

 document.getElementById("text4").innerHTML='<input type="text" class="form-control" placeholder="Enter the option" id="usr4" name="usr4">';
 document.getElementById("check4").innerHTML='<label><input type="checkbox" value="4" name="ans[]"></label>'; 

}

function beginKeyStatus()
{
    var beginKeyDiv=document.getElementById("beginKeyDiv");
    
    if(document.getElementById("beginKeyCheckbox").checked)
    {
        beginKeyDiv.innerHTML=
        '<div class="form-group"><label for="beginKey">Begin Key</label><input type="text" name="beginKey" id="beginKey" class="form-control"></div><br>';
    }
    else
    {
        beginKeyDiv.innerHTML='';
    }
}

function update()
{

    var subject = document.getElementById('subjectupdate').value;


    if (subject != 'empty') 
    {
        $.post('includes/pfile.php',{subjectupdate: subject,submitupdate: 'submit'},function(data){
            $('div#probupdate').html(data);
        });
    }

    else{
        $('div#probupdate').html("<font color='red'>Please Select A Subject</font>");            
    }


}

function deleteques()
{

    var subject = document.getElementById('subjectdelete').value;


    if (subject != 'empty') 
    {
        $.post('includes/pfile.php',{subjectdelete: subject,submitdelete: 'submit'},function(data){
            $('div#probdelete').html(data);
        });
    }

    else{
        $('div#probdelete').html("<font color='red'>Please Select A Subject</font>");            
    }


}


function up()
{


    var subject = document.getElementById('testupdate').value;


    if (subject != 'empty') 
    {
        $.post('includes/pfile.php',{test: subject,testedit: 'submit'},function(data){
            $('div#tupdate').html(data);
        });
    }

    else{
        $('div#tupdate').html("<font color='red'>Please Select A Subject</font>");            
    }


}





$(document).ready(function(){

    $('#tag2').on('change', function() {
        var subject = document.getElementById("subjectfetch").value; 
        var tag1 = document.getElementById("tag1").value;
        var tag2 = document.getElementById("tag2").value;

        var questionfetch = 0;
        if(document.getElementById("qtype1").checked == true )
            questionfetch = 0;
        else
            questionfetch = 1;

        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2,questype: questionfetch},function(data){

                $('div#probdisp').html(data);

            });
        }

        else{
            $('div#probdisp').html("<font color='red'>Please Select A Subject</font>");            
        }
    });

    $('#tag1').on('change', function() {
        var subject = document.getElementById("subjectfetch").value; 
        var tag1 = document.getElementById("tag1").value;
        var tag2 = document.getElementById("tag2").value;

        var questionfetch = 0;
        if(document.getElementById("qtype1").checked == true )
            questionfetch = 0;
        else
            questionfetch = 1;

        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2,questype: questionfetch},function(data){

                $('div#probdisp').html(data);

            });
        }

        else{
            $('div#probdisp').html("<font color='red'>Please Select A Subject</font>");            
        }
    });

    $('#tag2').on('change', function() {
        var subject = document.getElementById("subjectfetch").value; 
        var tag1 = document.getElementById("tag1").value;
        var tag2 = document.getElementById("tag2").value;

        var questionfetch = 0;
        if(document.getElementById("qtype1").checked == true )
            questionfetch = 0;
        else
            questionfetch = 1;

        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2,questype: questionfetch},function(data){

                $('div#probdisp').html(data);

            });
        }

        else{
            $('div#probdisp').html("<font color='red'>Please Select A Subject</font>");            
        }
    });


    $('#subjectfetch').on('change', function() {
        var subject = document.getElementById("subjectfetch").value; 
        var tag1 = document.getElementById("tag1").value;
        var tag2 = document.getElementById("tag2").value;
        
        var questionfetch = 0;
        if(document.getElementById("qtype1").checked == true )
            questionfetch = 0;
        else
            questionfetch = 1;

        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2,questype: questionfetch},function(data){

                $('div#probdisp').html(data);

            });
        }
        else{
            $('div#probdisp').html("<font color='red'>Please Select A Subject</font>");            
        }
    });



    $('#ttag1').on('change', function() {

        var subject = document.getElementById("ssubjectfetch").value; 
        var tag1 = document.getElementById("ttag1").value;
        var tag2 = document.getElementById("ttag2").value;

        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2},function(data){

                $('div#pd').html(data);

            });
        }

        else{
            $('div#pd').html("<font color='red'>Please Select A Subject</font>");            
        }
    });

    $('#ttag2').on('change', function() {

        var subject = document.getElementById("ssubjectfetch").value; 
        var tag1 = document.getElementById("ttag1").value;
        var tag2 = document.getElementById("ttag2").value;


        if (subject != 'empty') 
        {
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2},function(data){

                $('div#pd').html(data);

            });
        }

        else{
            $('div#pd').html("<font color='red'>Please Select A Subject</font>");            
        }
    });


    $('#ssubjectfetch').on('change', function() {

        var subject = document.getElementById("ssubjectfetch").value; 
        var tag1 = document.getElementById("ttag1").value;
        var tag2 = document.getElementById("ttag2").value;


        if (subject != 'empty') 
        {            
            $.post('includes/pfile.php',{subjectfetch: subject,subjectsubmit:'submit',tag1: tag1,tag2: tag2},function(data){

                $('div#pd').html(data);

            });
        }
        else{
            $('div#pd').html("<font color='red'>Please Select A Subject</font>");            
        }
    });



    $('#submit_uq').on('click',function(){

        var title = document.getElementById("title").value;
        var sub = document.getElementById("subject").value;
        var usr1 = document.getElementById("usr1").value;
        var usr2 = document.getElementById("usr2").value;
        var usr3 = document.getElementById("usr3").value;
        var usr4 = document.getElementById("usr4").value;
        var ans1 = document.getElementById("ans1").checked;
        var ans2 = document.getElementById("ans2").checked;
        var ans3 = document.getElementById("ans3").checked;
        var ans4 = document.getElementById("ans4").checked;

        if(usr3 == '' && ans3 == true || usr4 == '' && ans4 == true)
        {
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Option does not exist.</div>';
            return false;

        }

        else if (ans1 == false && ans2 == false && ans3 == false && ans4 == false)
        {
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Incomplete Form !</strong> Please Select The Correct Answers.</div>';
            return false;
        }


        else if(title == '' || sub == '' || sub == 'empty' || usr1 == '' || usr2 == '')
        {             
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Incomplete Form !</strong> Please Input All The Details.</div>';
            return false;
        }
        else
            return true;

    });

    $('#submit_nq').on('click',function(){

        var title = document.getElementById("title").value;
        var sub = document.getElementById("subject").value;
        var usr1 = document.getElementById("usr1").value;
        var usr2 = document.getElementById("usr2").value;
        var usr3 = document.getElementById("usr3").value;
        var usr4 = document.getElementById("usr4").value;
        var ans1 = document.getElementById("ans1").checked;
        var ans2 = document.getElementById("ans2").checked;
        var ans3 = document.getElementById("ans3").checked;
        var ans4 = document.getElementById("ans4").checked;

        if(usr3 == '' && ans3 == true || usr4 == '' && ans4 == true)
        {
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Option does not exist.</div>';
            return false;

        }

        else if (ans1 == false && ans2 == false && ans3 == false && ans4 == false)
        {
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Incomplete Form !</strong> Please Select The Correct Answers.</div>';
            return false;
        }

        else if(title == '' || sub == '' || sub == 'empty' || usr1 == '' || usr2 == '')
        {             
            document.getElementById('al').innerHTML='<div class="alert alert-warning" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Incomplete Form !</strong> Please Input All The Details.</div>';
            return false;
        }
        else
            return true;

    });

    }); //end of the document.ready

$(document).ready(function(){

    $('#batch').on('change', function() {
        var batch = this.value; 
        if (batch != 'empty') 
        {
            $.post('includes/pfile.php',{batch: batch,batchsubmit: 'submit'},function(data){

                $('div#batchdisp').html(data);

            });
        }

        else{
            $('div#batchdisp').html("<font color='red'>Please Select A Batch</font>");            
        }
    });

    $('#subjectupdate').on('change', function() {
        var subjectupdate = this.value; 
        if (subjectupdate != 'empty') 
        {
            $.post('includes/pfile.php',{subjectupdate: subjectupdate,updatesubmit: 'submit'},function(data){

                $('div#updateprobdisp').html(data);

            });
        }

        else{
            $('div#updateprobdisp').html("<font color='red'>Please Select A Subject</font>");            
        }
    });
});


window.setTimeout(function() {
    $(".alert").fadeTo(500, 500).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);

function goFurther(){
    if (document.getElementById("qtype1").checked == true || document.getElementById("qtype2").checked == true) {
        document.getElementById("demo").innerHTML = " ";
        
        document.getElementById("batch").disabled = false;
        document.getElementById("testtitle").disabled = false;
        document.getElementById("subjectfetch").disabled = false;
        document.getElementById("beginKeyCheckbox").disabled = false;
        document.getElementById("datetimepicker").disabled = false;
        document.getElementById("datetimepicker2").disabled = false;      
        document.getElementById("tag1").disabled = false;
        document.getElementById("tag2").disabled = false;
        
    }
}












