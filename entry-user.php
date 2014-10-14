<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - User Entry</title>
		<?PHP include("inc/validation.inc"); ?>

	<?php 
		include("inc/dbOpen.php"); 
		mysql_select_db ($database,$con);
		$school = mysql_query("SELECT * FROM schools ORDER BY schoolName ASC");   
		$title = mysql_query("SELECT * FROM jobtitle WHERE employer='" . $_SESSION['employer'] .  "' ORDER BY title ASC");  
		$titleRoadmaster = mysql_query("SELECT * FROM jobtitle WHERE employer='Roadmaster' ORDER BY title ASC");   
		$titleCFI = mysql_query("SELECT * FROM jobtitle WHERE employer='CFI' ORDER BY title ASC");   
	?> 
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
			
				<div class="rightContainer rounded"><div class="menuTab">Profile</div>

	   
	<div id="stylized" class="form">		 
	<div class="innerWrapper">
	<form action="functions/insert-profile.php" method="post" id="event">
	
	 <?PHP
		if (($_SESSION['role']=="User") or ($_SESSION['role']=="School"))
			echo "<input type='hidden' name='schoolID' value='" . $_SESSION['schoolID']  . "'>";
		else	{
		echo "<p><label for ='schoolID'>Choose Employer</label>";
		echo "<select style='width:400px' name='schoolID' class='required'>";
		echo "<option value=''>Please Choose the Employer</option>";
			while($schoolinfo = mysql_fetch_array($school))
				  {
				  echo "<option value='" . $schoolinfo['id'] . "'>" . $schoolinfo['schoolName'] . "</option>";
				  }
		echo "</select></p>";
		}
    ?>

    <p>
	    <label for= "firstName">First Name <span class="req">*</span></label>
	    <input type="text" id="firstName"  name="firstName" size="28" class="required" />
    </p>
    
    <p>
	    <label>Last Name <span class="req">*</span></label>
	    <input type="text" name="lastName" size="28" class="required" />
    </p>
        
    <p>
    	<label>Email <span class="req">*</span></label>
    	<input type="text" name="email" size="28" class="required email" />
    </p>
    
    <p>
    <label>Mobile Phone<span class="small">If you want it listed on printed materials</span></label>
    <input type="text"  name="mobilePhone" size="28" class="phone" />
    </p>
    
    <p>
    <label>Custom FAX<span class="small">If you have a  fax number other than the schools</span></label>
    <input type="text" name="fax" size="28" class="phone" />
    </p>
    
    <p><label>Extension<span class="small">Only numbers, we will enter the rest</span></label>
    <input type="text" class="digits" name="extension" size="28" />
    </p>
    
    <?PHP  if ($_SESSION['employer']=="CFI") { ?>
    <p><label>Credentials<span class="small">ie. LPN, CCT, CRAT, RMA</span></label>
    <input type="text"  name="credentials" size="28" />
    </p>
    <?PHP } elseif ($_SESSION['employer']!="CFI") { ?>
    <input type="hidden"  name="credentials" size="28" value="" />
    <?PHP } ?>
    
    <p><label>Title <span class="req">*</span></label>
    <?PHP
    echo "<select style='width:400px' class='required' name='jobTitle'>";
		echo "<option value=''>Choose Job Title</option>";
		
		if (($_SESSION['role']=="User") or ($_SESSION['role']=="School"))	{
			while($titleInfo = mysql_fetch_array($title))
				  {
				  echo "<option value='" . $titleInfo['title'] . "'>" . $titleInfo['title'] . "</option>";
				  }
		}	else 	{
				echo "<optgroup label='Roadmaster Positions' />";
				
				while($titleInfo = mysql_fetch_array($titleRoadmaster))
				  {
				  echo "<option value='" . $titleInfo['title'] . "'>" . $titleInfo['title'] . "</option>";
				  }
				  
				 echo "<optgroup label='CFI Positions' />";
				 while($titleInfo = mysql_fetch_array($titleCFI))
				  {
				  echo "<option value='" . $titleInfo['title'] . "'>" . $titleInfo['title'] . "</option>";
				  }
		}
	  
		echo "</select></p>";
	?>
	    
   <p>
	   <label>Password <span class="req">*</span><span class="small">Enter a password you would like to use</span></label>
	   <input id="password" name="password" type="password" />
   <p/>    
   
   <p>
	   <label>Verify Password <span class="req">*</span><span class="small">Enter the password again</span></label>
	   <input id="confirm_password" name="confirm_password" type="password" size="28" />
   </p>
    
      <?PHP
		if ($_SESSION['role']=="Admin")	{
				echo "<p><label>Role</label>";
				echo "<select name='role'>";
				echo "<option value='User'>User</option>";
				echo "<option value='School'>School</option>";
				echo "<option value='Admin'>Admin</option>";
				echo "</select></p>";
				  }
		else	{
				echo "<input type='hidden' name='role' value='User' />";
				}
	?>

		<p class="message">Please make sure that all information is correct before submitting your profile. All changes after submission will have to be emailed to the marketing department.</p>
    	<div style="padding-left:150px;"><button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Create User</button></div>
    
     </form>
     </div></div></div>
			
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