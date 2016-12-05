<?php
   

	require_once('functions.php');
	if(!loggedinAdmin())
		header("Location: login.php");
	else if($_SESSION['usernameAdmin'] !== 'admin')
		header("Location: login.php");
	else
		include('header.php');
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
					<li><a href="onlinejudge/src/admin/problems.php">Create Problem</a></li>
					<li><a href="scheduling_a_code_test/scheduling_a_code_test.php">Create Test</a></li>
				  </ul>
			  </li>
			  <li><a href="">MCQ Test</a></li>
			  <li><a href="database_page/searchdetails.php">Database</a></li>
			  <li><a href="admin-login/logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<link rel="stylesheet" href="widgEditor/css/widgEditor.css" />
<script src="widgEditor/scripts/widgEditor.js"></script>

    <div class="container">
      <?php
        if(isset($_GET['added']))
          echo("<div class=\"alert alert-success\">\nProblem added!\n</div>");
        else if(isset($_GET['deleted']))
          echo("<div class=\"alert alert-error\">\nProblem deleted!\n</div>");
        else if(isset($_GET['updated']))
          echo("<div class=\"alert alert-success\">\nProblem updated!\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
      ?>
      <ul class="nav nav-tabs">
        <li><a href="index.php">General</a></li>
        <li class="active"><a href="#">Problems</a></li>
      </ul>
      <div>
        <div>
          Below is a list of already added problems. Click on a problem to edit it.
          <ul class="nav nav-list">
            <li class="nav-header">ADDED PROBLEMS</li>
            	<?php
            	  // list all the problems
            	  $query = "SELECT * FROM problems";
          	  $result = mysql_query($query);
          	  if(mysql_num_rows($result)==0)
          	    echo("<li>None</li>\n");
          	  else {
          	    while($row = mysql_fetch_array($result)) {
          	      if(isset($_GET['action']) and $_GET['action']=='edit' and isset($_GET['id']) and $_GET['id']==$row['sl']) {
          	        $selected = $row;
          	        echo("<li class=\"active\"><a href=\"problems.php?action=edit&id=".$row['sl']."\">".$row['name']."</a></li>\n");
          	      } else
          	        echo("<li><a href=\"problems.php?action=edit&id=".$row['sl']."\">".$row['name']."</a></li>\n");
          	    }
          	  }
          	?>
          	<li class="divider"></li>
          	<?php
          	  if(!isset($_GET['action']) and !isset($_GET['id']))
          	    echo("<li class=\"active\"><a href=\"#\">Add problem</a></li>\n");
          	  else
          	    echo("<li><a href=\"problems.php\">Add problem</a></li>\n");
          	?>
          </ul>
          <hr/>
          <?php
            if(isset($_GET['action']) and $_GET['action']=='edit') {
              // edit a selected problem
          ?>
          <h1><small>Edit a Problem</small></h1>
          <form method="post" action="update.php">
          <input type="hidden" name="action" value="editproblem" id="action"/>
          <input type="hidden" name="id" id="id" value="<?php echo($selected['sl']);?>"/>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Problem</a></li>
            <li><a href="#tab2" data-toggle="tab">Sample Input</a></li>
            <li><a href="#tab3" data-toggle="tab">Sample Output</a></li>
			<li><a href="#tab4" data-toggle="tab">Hidden Input</a></li>
            <li><a href="#tab5" data-toggle="tab">Hidden Output</a></li>
			<li><a href="#tab6" data-toggle="tab">Pre-Code</a></li>
            <li><a href="#tab7" data-toggle="tab">Post-Code</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
          Problem Title: <input style="width:700px;" type="text" id="title" name="title" value="<?php echo($selected['name']);?>"/><br/>
          <div class="controls">
            <div class="input-append">
              Time Limit: <input class="span2" id="appendedInput" size="8" type="text" name="time" value="<?php echo($selected['time']); ?>"><span class="add-on">ms</span>
            </div>
          </div>
		  
		  Language: <select id = "lang_freeze" name = "lang_freeze" style = "border-radius:3px;" value = "<?php echo $selected['lang_freeze'];?>">
		  <option value = "">Select</option>
		 <option value = "c" <?php if($selected['lang_freeze'] == "c") echo "selected"; ?> >C</option>
		  <option value = "cpp" <?php if($selected['lang_freeze'] == "cpp") echo "selected"; ?> >C++</option>
		  <option value = "java" <?php if($selected['lang_freeze'] == "java") echo "selected"; ?> >Java</option>
		  <option value = "python" <?php if($selected['lang_freeze'] == "python") echo "selected"; ?> >Python</option>
		  </select>
		  
          <br/>
          Detailed problem: <span class="label label-info">Markdown formatting supported</span></br/><br/>
          <textarea style="width:785px; height:400px;" name="problem" id="text" class = "widgEditor">
		  <?php
		  $path = $selected['sl']."/description.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?>
		  </textarea>
		  <br/>
          </div>
          <div class="tab-pane" id="tab2">
          <textarea style="font-family: mono; width:785px; height:400px;" name="input" id="input"><?php
		  $path = $selected['sl']."/input.txt";
		  $file = fopen($path,"r");
		   echo fread($file,filesize($path));
		  fclose($file);
		  ?></textarea><br/>
          </div>
          <div class="tab-pane" id="tab3">
          <textarea style="font-family: mono; width:785px; height:400px;" name="output" id="output"><?php
		  $path = $selected['sl']."/output.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?></textarea><br/>
          </div>
		  <!-- Hidden Input and output -->
		  <div class="tab-pane" id="tab4">
          <textarea style="font-family: mono; height:400px;" class="span9" name="hiddenInput" id="hiddenInput"><?php
		  $path = $selected['sl']."/hiddenInput.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?></textarea><br/>
          </div>
		  <div class="tab-pane" id="tab5">
          <textarea style="font-family: mono; height:400px;" class="span9" name="hiddenOutput" id="hiddenOutput"><?php
		  $path = $selected['sl']."/hiddenOutput.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?></textarea><br/>
          </div>
		  <!-- Pre-Code and Post-Code -->
		  <div class="tab-pane" id="tab6">
          <textarea style="font-family: mono; height:400px;" class="span9" name="precode" id="precode"><?php
		  $path = $selected['sl']."/precode.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?></textarea><br/>
          </div>
		  <div class="tab-pane" id="tab7">
          <textarea style="font-family: mono; height:400px;" class="span9" name="postcode" id="postcode"><?php
		  $path = $selected['sl']."/postcode.txt";
		  $file = fopen($path,"r");
		  while(!feof($file))
		  {
			  echo fgets($file);
		  }
		  fclose($file);
		  ?></textarea><br/>
          </div>
		  
		  
          </div>
          <input class="btn btn-primary btn-large" type="submit" value="Update Problem"/>
          <input class="btn btn-large" type="button" value="Preview" onclick="$('#preview').load('preview.php', {action: 'preview', title: $('#title').val(), text: $('#editor').val()});"/>
          <input class="btn btn-danger btn-large" type="button" value="Delete Problem" onclick="window.location='update.php?action=delete&id='+$('#id').val();"/>
          </form>
          <div id="preview"></div>
          <?php }else { // add a problem
          ?>
          <h1><small>Add a Problem</small></h1>
          <form method="post" action="update.php">
          <input type="hidden" name="action" value="addproblem"/>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Problem</a></li>
            <li><a href="#tab2" data-toggle="tab">Sample Input</a></li>
            <li><a href="#tab3" data-toggle="tab">Sample Output</a></li>
			<li><a href="#tab4" data-toggle="tab">Hidden Input</a></li>
            <li><a href="#tab5" data-toggle="tab">Hidden Output</a></li>
			<li><a href="#tab6" data-toggle="tab">Pre-Code</a></li>
            <li><a href="#tab7" data-toggle="tab">Post-Code</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
          Problem Title: <input class="span8" type="text" id="title" name="title"/><br/>
          <div class="controls">
            <div class="input-append">
              Time Limit: <input class="span2" id="appendedInput" size="8" type="text" name="time"><span class="add-on">ms</span>
            </div>
          </div>
		  
		    Language: <select id = "lang_freeze" name = "lang_freeze" style = "border-radius:3px;">
			<option value = "">Select</option>
		  <option value = "c">C</option>
		  <option value = "cpp">C++</option>
		  <option value = "java">Java</option>
		  <option value = "python">Python</option>
		  </select>
          <br/>
          Detailed problem: <span class="label label-info">Markdown formatting supported</span></br/><br/>
          <textarea style="height:400px;" name="problem" id="text" class = "widgEditor span9"></textarea>

		  

		  <br/>
          </div>
          <div class="tab-pane" id="tab2">
          <textarea style="font-family: mono; height:400px;" class="span9" name="input" id="input"></textarea><br/>
          </div>
          <div class="tab-pane" id="tab3">
          <textarea style="font-family: mono; height:400px;" class="span9" name="output" id="output"></textarea><br/>
          </div>
		  <!-- Hidden Input and output -->
		  <div class="tab-pane" id="tab4">
          <textarea style="font-family: mono; height:400px;" class="span9" name="hiddenInput" id="hiddenInput"></textarea><br/>
          </div>
		  <div class="tab-pane" id="tab5">
          <textarea style="font-family: mono; height:400px;" class="span9" name="hiddenOutput" id="hiddenOutput"></textarea><br/>
          </div>
		  <!-- Pre-Code and Post-Code -->
		  <div class="tab-pane" id="tab6">
          <textarea style="font-family: mono; height:400px;" class="span9" name="precode" id="precode"></textarea><br/>
          </div>
		  <div class="tab-pane" id="tab7">
          <textarea style="font-family: mono; height:400px;" class="span9" name="postcode" id="postcode"></textarea><br/>
          </div>
          </div>
          <input class="btn btn-primary btn-large" type="submit" value="Add Problem"/>
          <input class="btn btn-large" type="button" value="Preview" onclick="$('#preview').load('preview.php', {action: 'preview', title: $('#title').val(), text: $('#editor').val()});"/>
          </form>
          <div id="preview"></div>
          <?php }?>
        </div>
      </div>
    </div> <!-- /container -->

<?php
	include('footer.php');
?>


