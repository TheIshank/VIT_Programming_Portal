

<?php
      

      if(isset($_GET['regno']) and $_GET['groupid'])
      {
            require("connect_to_db.php");
 
            $groupId = $_GET['groupid'];
            
            $res=mysqli_query($conn,"select * from email_group where Group_Id = '$groupId' ");
     
            $res = mysqli_fetch_array($res,MYSQLI_ASSOC);

            $RegNos=$res['Reg_Nos'];
              
             $RegNos=explode(",", $RegNos);

      	   
            
         		$regNosArray = array_diff($RegNos,array($_GET['regno']));
            $RegNosStr = implode(",", $regNosArray);
 
             $query = $conn->prepare("UPDATE email_group SET Reg_Nos = ? where Group_Id= '$groupId' ");
             $query->bind_param("s", $RegNosStr);
	     	    $query->execute();
            header("Location:grouppage.php?groupid=". $groupId);
      		
      }	

?>  