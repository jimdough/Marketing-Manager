<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Edit User</title>
		<?PHP include("inc/validation.inc"); ?>
		
					<script>
						function goto(site) {
						var msg = confirm("Are you Sure you want to DELETE this event?")
						if (msg) {window.location.href = site}
						else (null)
						}
					</script>
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
			<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
				<div class="rightContainer"><div class="menuTab">Edit Profile</div>
					<?php 
	
								include("inc/dbOpen.php"); 
							
								mysql_select_db ($database,$con);
								
								$userID = $_GET['userID'];	
								
								$record = mysql_query("SELECT * FROM users WHERE id=' " . $userID . " ' ");
								$recordInfo = mysql_fetch_array($record);
								
								$titleAdmin = mysql_query("SELECT * FROM jobtitle WHERE employer='" . $recordInfo['employer'] . "' ORDER BY title ASC");    
								
								$schoolChoice = mysql_query("SELECT * FROM schools WHERE id='" . $recordInfo['schoolID'] . "' ");
								$schoolChoiceInfo = mysql_fetch_array($schoolChoice);
								
								$school = mysql_query("SELECT * FROM schools");
								
								if ($recordInfo['approvalStatus']==0)
									$approvalStatus="UN-Approved";
								elseif ($recordInfo['approvalStatus']==1)
									$approvalStatus="Approved";
								
					 ?> 
	   
	<div id="stylized" class="form">
	<div class="full">		 
	<form action="functions/update-user.php" method="post" id="event">

    <p><label>First Name</label>
    <input class="required" type="text"  name="firstName" size="35" value="<?PHP echo $recordInfo['firstName'];  ?>" /><p />
    
    <p><label>Last Name</label>
    <input class="required" type="text" name="lastName" size="35" class="required" value="<?PHP echo $recordInfo['lastName'];  ?>" /><p />
        
    <p><label>Email</label>
    <input class="required email" type="text" name="email" size="35" class="required" value="<?PHP echo $recordInfo['email'];  ?>" /><p />
    
    <p><label>Title</label>
    <?PHP 
    
    			if ($_SESSION['role']=="Admin")	{
				
				echo "<select style='width:400px' name='jobTitle'>";
				echo "<optgroup label='Current' />";
				echo "<option selected value='" . $recordInfo['title'] . "'>" . $recordInfo['title'] . "</option>";
				echo "<optgroup label='Titles' />";
				
				while($titleInfo = mysql_fetch_array($titleAdmin))
				  {
				  echo "<option value='" . $titleInfo['title'] . "'>" . $titleInfo['title'] . "</option>";
				  }
				  echo "</select>";
				  
				  } else {
					  echo "<input type='hidden' name='jobTitle' value='" . $recordInfo['title'] . "' />";
					  echo "<span class='fauxInput'>" . $recordInfo['title'] . "</span>";
				  }
				  echo "</select></p>";
	?>
	
    <p><label>Mobile Phone</label>
    <input type="text" name="mobilePhone" size="35" value="<?PHP echo $recordInfo['mobilePhone'];  ?>" /></p>
    
    <p><label>FAX</label>
    <input type="text" name="fax" size="35" value="<?PHP echo $recordInfo['fax'];  ?>" /></p>
    
    <p><label>Extension</label>
    <input class="digits" type="text" name="extension" size="35" value="<?PHP echo $recordInfo['extension'];  ?>" /></p>
    
    <?PHP  if ($_SESSION['employer']=="CFI") { ?>
    <p><label>Credentials</label>
    <div class="input"><input type="text" name="credentials" size="35" value="<?PHP echo $recordInfo['credentials'];  ?>" /></div>
    <?PHP } else { ?>
    <input type="hidden" name="credentials" size="35" value="<?PHP echo $recordInfo['credentials'];  ?>" />
    <?PHP } ?>
    
    
   <p><label>Password<span class="small"><a href="userExists.php?email=<?PHP echo $recordInfo['email'];  ?>">send password</a>
</span></label>
    <input class="required" id="passwordUpdate" name="passwordUpdate" value="<?PHP echo $recordInfo['password'];  ?>" size="20" />    
    <?PHP if ($_SESSION['role']=="Admin")	{ ?>
        <p><label>Role</label>
    	   
    	   		<select name="role">
    	   		<optgroup label="Current">
   	     		<?PHP echo "<option value='" . $recordInfo['role'] . "' selected>" . $recordInfo['role'] . "</option>"; ?>
    			</optgroup>
    		
    			<optgroup label="Options">
    				<option value="User">User</option>
    				<option value="School">School</option>
    				<option value="Admin">Admin</option>
    			</optgroup>
  			</select></p>
  			
   	    <?PHP 
   	    } else {
	   	    print "<input type='hidden' value='" .  $recordInfo['role']  . "' name='role' /></p>";
   	    }
   	    
   	        if ($_SESSION['role']=="Admin")	{ 
    		echo "<p><label>School</label>";
    		echo "<select style='width:400px' name='schoolID' class='required' style='width:300px;'>";
		   	 echo "<optgroup label='Current'>";
		   	 echo "<option value='" . $schoolChoiceInfo['id'] . "'>" . $schoolChoiceInfo['schoolName'] . "</option>";
		   	 echo "</optgroup>";
		   	 echo "<optgroup label='Options'>";
			   	 	while($schoolinfo = mysql_fetch_array($school))
			   	 	  {
			   	 		  echo "<option value='" . $schoolinfo['id'] . "'>" . $schoolinfo['schoolName'] . "</option>";
			   	 	  }
			 echo "</optgroup>";
	   	     echo "</select></p>";
	   	 } else	 {
		   	 print "<input type='hidden' name='schoolID' value='" . $recordInfo['schoolID'] . "'>";
	   	 }
	 ?>
    
     <?PHP if ($_SESSION['role']=="Admin")	{ ?>
		
    <p><label>Approval</label>
        <select name="approvalStatus" class="required">
    		<optgroup label="Current">
   	     <?PHP echo "<option selected value='" . $recordInfo['approvalStatus'] . "'>" . $approvalStatus . "</option>"; ?>
    		</optgroup>
    		
    		<optgroup label="Options">
    			<option value="1">Approved</option>
    			<option value="0">UN-Approved</option>
    		</optgroup>
    		</select></p>

    <?PHP
     } else {
    	print "<input type='hidden' name='approvalStatus' value='" . $recordInfo['approvalStatus'] . "' />"; 
    } 
    ?>

<!-- END Section -->
			<input type="hidden" value="<?PHP echo $userID; ?>" name="userID">
    		<input type="hidden" value="<?PHP echo $_SESSION['email']; ?>" name="admin">
    		<input type="hidden" value="<?PHP echo $_SESSION['id']; ?>" name="adminID">

		<p style="padding-left:150px;">

	    <button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Update User</button>
	    
	    <?PHP if ($_SESSION['role']!="User")	{ ?>
	    <button class="button"><a href="javascript:goto('functions/delete-user.php?userID=<?PHP echo $recordInfo['id']; ?>')">Delete User</a></button>
	    <?PHP } ?>
		</p>
		
     </form></div></div></div>

			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>