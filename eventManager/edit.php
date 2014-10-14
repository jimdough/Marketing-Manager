<?PHP include("../inc/security.inc"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Event Manager - Edit Event</title>
		<?PHP include("../inc/head.inc"); ?>
		<?php include("../inc/validation.inc"); ?>
			<style>
				h1	{padding-bottom: 15px; padding-top: 15px; font-size: 24px;}
		    </style>
		    
		<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to DELETE this event?")
			if (msg) {window.location.href = site}
			else (null)
			}
		</script>
		
</head>
		
	<?php 
	
	include("inc/dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $_GET['eventID'] . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$email = mysql_query("SELECT * FROM email_em WHERE id=' " . $recordInfo['email'] . " ' ");
	$selectedEmail = mysql_fetch_array($email);
	
	$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $recordInfo['flyer'] . " ' ");
	$selectedFlyer = mysql_fetch_array($flyer);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$admin = mysql_query("SELECT * FROM admin WHERE id=' " . $recordInfo['admin'] . " ' ");
	$selectedAdmin = mysql_fetch_array($admin);
	
	$emailOptions = mysql_query("SELECT * FROM email_em ORDER BY id ASC");
	
	$flyerOptions = mysql_query("SELECT * FROM flyer_em ORDER BY id ASC");
	
	$adminOptions = mysql_query("SELECT * FROM admin WHERE role='admin' ORDER BY name ASC");
	
	$eventID = $_GET['eventID'];
	
	
	if ($recordInfo['bannerToggle'] == "1") 
	  $banner="Yes";
	    else 
	  $banner="No";

	if ($recordInfo['calendarToggle'] == "1") 
	  $calendar="Yes";
	    else 
	  $calendar="No";
	  
	  if ($recordInfo['approvalStatus'] == "1") 
	  $approval="Approved";
	    else 
	  $approval="Unapproved";

	
   ?> 

<body>

	<div id="shell">
<?PHP include("../inc/topNav.php"); ?>
	<div id="eventEntry">
<div class="menuTab">Edit Event</div>
	<form action="functions/update.php?eventID=<?PHP echo $eventID; ?>" method="post" id="event">

	<div class="sectionBreak" style="text-align:center;">
		<h1><?PHP echo $recordInfo['eventName'];  ?> for <?PHP echo $schoolInfo['schoolName'];  ?></h1>
	</div>

   
	   <div class="sectionBreak">
	   
	   <h1>Asset Information</h1>
	   
	    <div class="labelLarge">Submitter's Name</div>
	    <div class="inputMedium"><?PHP echo $recordInfo['yourName'];  ?></div>
	    
	    <div class="labelLarge">Submitter's E-Mail</div>
	    <div class="input"><a href="mailto:<?PHP echo $recordInfo['yourEMail'];  ?>"><?PHP echo $recordInfo['yourEMail'];  ?></a></div>
	
	    <div class="labelLarge clear">Area Codes to Target</div>
	    
	    <div class="inputLarge"><input type="text"  name="targetAreaCode1" size="3" id="targetAreaCode1" class="areacode" value="<?PHP echo $recordInfo['targetAreaCode1'];  ?>" /> , <input type="text"  name="targetAreaCode2" class="digits" size="3" value="<?PHP echo $recordInfo['targetAreaCode2'];  ?>" /> , <input type="text"  name="targetAreaCode3" class="digits" size="3" value="<?PHP echo $recordInfo['targetAreaCode3'];  ?>" />, <input type="text"  name="targetAreaCode4" class="digits" size="3" value="<?PHP echo $recordInfo['targetAreaCode4'];  ?>" /> , <input type="text"  name="targetAreaCode5" class="digits" size="3" value="<?PHP echo $recordInfo['targetAreaCode5'];  ?>" /></div>
    
    <div class="labelLarge clear">Email Choice</div>
    <div class="input">
    		<select name="email">
			<optgroup label="Selected">
			<option value="<?PHP echo $recordInfo['email'];  ?>"><?PHP echo $selectedEmail['name'];  ?></option>
			</optgroup>
			
			<optgroup label="Available">
			
			<?PHP
				while($emailInfo = mysql_fetch_array($emailOptions))
					  {
					  echo "<option value='" . $emailInfo['id'] . "'>" . $emailInfo['name'] . "</option>";
					  }
			?>
			</optgroup>
		</select>

    </div>
    
        <div class="labelLarge">Flyer Choice</div>
    <div class="input">
    		<select name="flyer">
			<optgroup label="Selected">
			<option value="<?PHP echo $recordInfo['flyer'];  ?>"><?PHP echo $selectedFlyer['name'];  ?></option>
			</optgroup>
			
			<optgroup label="Available">
			
			<?PHP
				while($flyerInfo = mysql_fetch_array($flyerOptions))
					  {
					  echo "<option value='" . $flyerInfo['id'] . "'>" . $flyerInfo['name'] . "</option>";
					  }
			?>
			</optgroup>
		</select>

    </div>
    
    <div class="clear"></div>
</div>

<!-- END Section -->

<!-- Section -->

<div class="sectionBreak">

    <h1>Event Contact Information</h1>

    <div class="label clear">RSVP Phone</div>
    <div class="inputMedium"><input type="text"  name="rsvpPhone" size="35" value="<?PHP echo $recordInfo['rsvpPhone'];  ?>" /></div>
    
    <div class="label">RSVP E-Mail</div>
    <div class="inputMedium"><input type="text" name="rsvpEmail" size="35" class="required email" value="<?PHP echo $recordInfo['rsvpEmail'];  ?>" /></div>
        
    <div class="label clear">Event Name</div>
    <div class="inputMedium"><input type="text" name="eventName" size="35" class="required" value="<?PHP echo $recordInfo['eventName'];  ?>" /></div>
    
    <div class="label">Location Name</div>
    <div class="inputMedium"><input type="text" name="eventLocationName" size="35" value="<?PHP echo $recordInfo['eventLocationName'];  ?>" /></div>
    
    <div class="label clear">Event Address</div>
    <div class="inputMedium"><input type="text" name="eventLocAdd1" size="35" class="required" value="<?PHP echo $recordInfo['eventLocAdd1'];  ?>" /></div>
    
    <div class="label">Event Address cont.</div>
    <div class="inputMedium"><input type="text" name="eventLocAdd2" size="35" value="<?PHP echo $recordInfo['eventLocAdd2'];  ?>" /></div>
    
    <div class="label clear">City</div>
    <div class="inputMedium"><input type="text" name="eventLocCity" id="address2" size="18" class="required" value="<?PHP echo $recordInfo['eventLocCity'];  ?>" /></div>
    
    <div class="label">State</div>
    <div class="input"><input type="text" name="eventLocState" size="2" class="required" value="<?PHP echo $recordInfo['eventLocState'];  ?>" /></div>
    
    <div class="label clear">ZipCode</div>
    <div class="input"><input type="text" name="eventLocZip" size="5" class="required digits" value="<?PHP echo $recordInfo['eventLocZip'];  ?>" /></div>
    
    <div class="clear"></div>
  
</div>

<!-- END Section -->

<!-- Section -->
<div class="sectionBreak">

<h1>Event Dates & Times</h1>
    
    <div class="labelSmall">Event 1 Day</div>
    <div class="inputSmall">
    	<input style="text" size="6" name="eventDate1DayName" value="<?PHP echo $recordInfo['eventDate1DayName'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 1 Date</div>
    <div class="input">
    	<input style="text" size="1" name="eventDate1Month" value="<?PHP echo $recordInfo['eventDate1Month'];  ?>" /> / <input style="text" size="1" name="eventDate1Day" value="<?PHP echo $recordInfo['eventDate1Day'];  ?>" /> / <input style="text" size="1" name="eventDate1Year" value="<?PHP echo $recordInfo['eventDate1Year'];  ?>" />
    </div>
    
    <div class="labelSmall">Event 1 Start</div>
    <div class="input">
	<input style="text" size="1" name="eventTime1Hour" value="<?PHP echo ltrim($recordInfo['eventTime1Hour'], '0');  ?>" />:<input style="text" size="1" name="eventTime1Minutes"value="<?PHP echo $recordInfo['eventTime1Minutes'];  ?>" /> <input size="1" style="text" name="eventTime1AMPM" value="<?PHP echo $recordInfo['eventTime1AMPM'];  ?>" />
    </div>
    
    <div class="labelSmall">Event 1 End</div>
    <div class="input">
	<input style="text" size="1" name="eventTime1EndHour" value="<?PHP echo ltrim($recordInfo['eventTime1EndHour'], '0');  ?>" />:<input style="text" size="1" name="eventTime1EndMinutes" value="<?PHP echo $recordInfo['eventTime1EndMinutes'];  ?>" /> <input size="1" style="text" name="eventTime1EndAMPM" value="<?PHP echo $recordInfo['eventTime1EndAMPM'];  ?>" />
    </div>
    

    
    <div class="labelSmall clear">Event 2 Day</div>
    <div class="inputSmall">
    	<input style="text" size="6" name="eventDate2DayName" value="<?PHP echo $recordInfo['eventDate2DayName'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 2 Date</div>
    <div class="input">
    	<input style="text" size="1" name="eventDate2Month" value="<?PHP echo $recordInfo['eventDate2Month'];  ?>" /> / <input style="text" size="1" name="eventDate2Day" value="<?PHP echo $recordInfo['eventDate2Day'];  ?>"/> / <input style="text" size="1" name="eventDate2Year" value="<?PHP echo $recordInfo['eventDate2Year'];  ?>" />
    </div> 
    
    <div class="labelSmall">Event 2 Start</div>
    <div class="input">
	<input style="text" size="1" name="eventTime2Hour" value="<?PHP echo ltrim($recordInfo['eventTime2Hour'], '0');  ?>" />:<input style="text" size="1" name="eventTime2Minutes" value="<?PHP echo $recordInfo['eventTime2Minutes'];  ?>" /> <input size="1" style="text" name="eventTime2AMPM" value="<?PHP echo $recordInfo['eventTime2AMPM'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 2 End</div>
    <div class="input">
	<input style="text" size="1" name="eventTime2EndHour" value="<?PHP echo ltrim($recordInfo['eventTime2EndHour'], '0');  ?>" />:<input style="text" size="1" name="eventTime2EndMinutes" value="<?PHP echo $recordInfo['eventTime2EndMinutes'];  ?>" /> <input size="1" style="text" name="eventTime2EndAMPM" value="<?PHP echo $recordInfo['eventTime2EndAMPM'];  ?>" />
    </div>
    

    
        <div class="labelSmall clear">Event 3 Day</div>
    <div class="inputSmall">
    	<input style="text" size="6" name="eventDate3DayName" value="<?PHP echo $recordInfo['eventDate3DayName'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 3 Date</div>
    <div class="input">
    	<input style="text" size="1" name="eventDate3Month" value="<?PHP echo $recordInfo['eventDate3Month'];  ?>" /> / <input style="text" size="1" name="eventDate3Day" value="<?PHP echo $recordInfo['eventDate3Day'];  ?>" /> / <input style="text" size="1" name="eventDate3Year" value="<?PHP echo $recordInfo['eventDate3Year'];  ?>" />
    </div> 
    
    <div class="labelSmall">Event 3 Start</div>
    <div class="input">
	<input style="text" size="1" name="eventTime3Hour" value="<?PHP echo ltrim($recordInfo['eventTime3Hour'], '0');  ?>" />:<input  name="eventTime3Minutes" style="text" size="1" value="<?PHP echo $recordInfo['eventTime3Minutes'];  ?>" /> <input size="1" style="text" name="eventTime3AMPM" value="<?PHP echo $recordInfo['eventTime3AMPM'];  ?>" />
    </div>
    
            <div class="labelSmall">Event 3 End</div>
    <div class="input">
	<input style="text" size="1" name="eventTime3EndHour" value="<?PHP echo ltrim($recordInfo['eventTime3EndHour'], '0');  ?>" />:<input style="text" size="1" name="eventTime3EndMinutes" value="<?PHP echo $recordInfo['eventTime3EndMinutes'];  ?>" /> <input size="1" style="text" name="eventTime3EndAMPM" value="<?PHP echo $recordInfo['eventTime3EndAMPM'];  ?>" />
    </div>
    

    
        <div class="labelSmall clear">Event 4 Day</div>
    <div class="inputSmall">
    	<input style="text" size="6" name="eventDate4DayName" value="<?PHP echo $recordInfo['eventDate4DayName'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 4 Date</div>
    <div class="input">
    	<input style="text" size="1" name="eventDate4Month" value="<?PHP echo $recordInfo['eventDate4Month'];  ?>" /> / <input style="text" size="1" name="eventDate4Day" value="<?PHP echo $recordInfo['eventDate4Day'];  ?>" /> / <input style="text" size="1" name="eventDate4Year" value="<?PHP echo $recordInfo['eventDate4Year'];  ?>" />
    </div> 
    
    <div class="labelSmall">Event 4 Start</div>
    <div class="input">
	<input style="text" size="1" name="eventTime4Hour" value="<?PHP echo ltrim($recordInfo['eventTime4Hour'], '0');  ?>" />:<input style="text" size="1" name="eventTime4Minutes" value="<?PHP echo $recordInfo['eventTime4Minutes'];  ?>" /> <input size="1" style="text" name="eventTime4AMPM" value="<?PHP echo $recordInfo['eventTime4AMPM'];  ?>" />
    </div>
    
            <div class="labelSmall">Event 4 End</div>
    <div class="input">
	<input style="text" size="1" name="eventTime4EndHour" value="<?PHP echo ltrim($recordInfo['eventTime4EndHour'], '0');  ?>" />:<input style="text" size="1" name="eventTime4EndMinutes" value="<?PHP echo $recordInfo['eventTime4EndMinutes'];  ?>" /> <input size="1" style="text" name="eventTime4EndAMPM" value="<?PHP echo $recordInfo['eventTime4EndAMPM'];  ?>" />
    </div>
    

    
        <div class="labelSmall clear">Event 5 Day</div>
    <div class="inputSmall">
    	<input style="text" size="6" name="eventDate5DayName" value="<?PHP echo $recordInfo['eventDate5DayName'];  ?>" />
    </div>
    
        <div class="labelSmall">Event 5 Date</div>
    <div class="input">
    	<input style="text" size="1" name="eventDate5Month" value="<?PHP echo $recordInfo['eventDate5Month'];  ?>" /> / <input style="text" size="1" name="eventDate5Day" value="<?PHP echo $recordInfo['eventDate5Day'];  ?>" /> / <input style="text" size="1" name="eventDate5Year" value="<?PHP echo $recordInfo['eventDate5Year'];  ?>" />
    </div> 
    
    <div class="labelSmall">Event 5 Start</div>
    <div class="input">
	<input style="text" size="1" name="eventTime5Hour" value="<?PHP echo ltrim($recordInfo['eventTime5Hour'], '0');  ?>" />:<input style="text" size="1" name="eventTime5Minutes" value="<?PHP echo $recordInfo['eventTime5Minutes'];  ?>" /> <input size="1" style="text" name="eventTime5AMPM" value="<?PHP echo $recordInfo['eventTime5AMPM'];  ?>" />
    </div>
    
            <div class="labelSmall">Event 5 End</div>
    <div class="input">
	<input style="text" size="1" name="eventTime5EndHour" value="<?PHP echo ltrim($recordInfo['eventTime5EndHour'], '0');  ?>" />:<input style="text" size="1" name="eventTime5EndMinutes" value="<?PHP echo $recordInfo['eventTime5EndMinutes'];  ?>" /> <input size="1" style="text" name="eventTime5EndAMPM" value="<?PHP echo $recordInfo['eventTime5EndAMPM'];  ?>" />
    </div>
    


    
    <div class="clear"></div>
    
</div>

<!-- END Section -->

<!-- Section -->

<div class="sectionBreak">

    <div class="label">Event Description</div>
    <div class="inputLarge"><textarea name="eventDesc" cols="70" rows="5" class="required" ><?PHP echo $recordInfo['eventDesc'];  ?></textarea><br><br></div>
    
    <div class="label clear">Event Highlight 1</div>
    <div class="inputMedium"><input type="text" name="eventHighlight1" size="35" value="<?PHP echo $recordInfo['eventHighlight1'];  ?>" /></div>
    
    <div class="label">Event Highlight 2</div>
    <div class="inputMedium"><input type="text" name="eventHighlight2" size="35" value="<?PHP echo $recordInfo['eventHighlight2'];  ?>" /></div>
    
    <div class="label clear">Event Highlight 3</div>
    <div class="inputMedium"><input type="text" name="eventHighlight3" size="35" value="<?PHP echo $recordInfo['eventHighlight3'];  ?>" /></div>
    
    <div class="label">Event Highlight 4</div>
    <div class="inputMedium"><input type="text" name="eventHighlight4" size="35" value="<?PHP echo $recordInfo['eventHighlight4'];  ?>" /></div>

    <div class="clear"></div>
    </div>
    
    <div class="sectionBreak">
    
    <h1>Marketing</h1>
    
     <div class="label clear">Lead Radius</div>
    <div class="inputMedium"><input style="text" name="leadRadius" value="<?PHP echo $recordInfo['leadRadius'];  ?>" size="3" /> Miles</div>
    
    <div class="label">Lead Date Range</div>
    <div class="inputSmall"><input style="text" name="leadRange" value="<?PHP echo $recordInfo['leadRange'];  ?>" size="3" /> Days</div>

    <div class="label clear">Marketing Notes</div>
    <div class="inputLarge"><textarea name="marketingNotes" cols="70" rows="5" ><?PHP echo $recordInfo['marketingNotes'];  ?></textarea><br><br></div>
    
    <div class="label clear">Event Banner</div>
    <div class="inputSmall">
    	<select name="bannerToggle">
    		<optgroup label="Selected">
    		<option value="<?PHP echo $recordInfo['bannerToggle'];  ?>"><?PHP echo $banner; ?></option>
    		</optgroup>
    		<optgroup label="Choose">
    		<option value="1">Yes</option>
    		<option value="0">No</option>
    		</optgroup>
    	</select>
    </div>
    
        <div class="label">Add to Calendar</div>
    <div class="inputSmall">
    	<select name="calendarToggle">
    		<optgroup label="Selected">
    		<option value="<?PHP echo $recordInfo['calendarToggle'];  ?>"><?PHP echo $calendar; ?></option>
    		</optgroup>
    		<optgroup label="Choose">
    		<option value="1">Yes</option>
    		<option value="0">No</option>
    		</optgroup>
    	</select>
    </div>
    
        <div class="label">Approval Status</div>
    <div class="inputSmall">
    	<select name="approvalStatus">
    		<optgroup label="Selected">
    		<option value="<?PHP echo $recordInfo['approvalStatus'];  ?>"><?PHP echo $approval; ?></option>
    		</optgroup>
    		<optgroup label="Choose">
    		<option value="1">Approved</option>
    		<option value="0">Unapproved</option>
    		</optgroup>
    	</select>
    </div>
    
        
    <input type="hidden" value="<?PHP echo $_SESSION['email']; ?>" name="admin">
    <input type="hidden" value="<?PHP echo $_SESSION['id']; ?>" name="adminID">
    
    <br><br>
     <div class="toolbar">
	    <a class="button" target="_blank" href="emails/<?PHP echo $recordInfo['email']; ?>/email.php?eventID=<?PHP echo $_GET['eventID'] ?>">View Email</a>
	    <a class="button" target="_blank" href="flyers/<?PHP echo $recordInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $_GET['eventID'] ?>">Preview Flyer</a>
	    <a class="button" target="_blank" href="http://www.roadmaster.com/event-banner-preview.php?mode=preview&eventID=<?PHP echo $_GET['eventID'] ?>">View Banner</a>
	<br>
	    <input class="buttonUpdate" type="submit" name="submit" id="submit" value="Update this Event" />
	    <a class="buttonDelete delete" href="javascript:goto('functions/delete.php?eventID=<?PHP echo $recordInfo['id']; ?>')">Delete this Request</a>
    </div>

</div>
</div>

			<div class="controls">
					<a class="button" href="listing.php">View Current Events</a>
					<a class="button" href="listing-archived.php">View Past Events</a>
			</div>

<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="../images/cpt.png"></a>
					</div>
			</div>
</div>

<!-- Section -->

</form>
<?PHP include("inc/dbClose.php"); ?>
	
	</body>
</html>