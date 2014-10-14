<?PHP include("../inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?PHP include("../inc/head.inc"); ?>
	<?php include("../inc/validation.inc"); ?>
	
	<!-- Main CSS Override -->
	<style>
	h1	{padding-bottom: 15px; padding-top: 15px; font-size: 24px;}
	</style>

	<!-- Box Display Function for Entry Form -->
		<script language="javascript">var counter = 0;
			var numBoxes = 4;
			function toggle4(showHideDiv) {
			       var ele = document.getElementById(showHideDiv + counter);
			       if(ele.style.display == "block") {
			              ele.style.display = "none";
			       }
			       else {
			              ele.style.display = "block";
			       }
			       if(counter == numBoxes) {
			                document.getElementById("toggleButton").style.display = "none";
			       }
			}
			
			var counter2 = 0;
			var numBoxes2 = 4;
			function toggle5(showHideDiv2) {
			       var ele = document.getElementById(showHideDiv2 + counter2);
			       if(ele.style.display == "block") {
			              ele.style.display = "none";
			       }
			       else {
			              ele.style.display = "block";
			       }
			       if(counter2 == numBoxes2) {
			                document.getElementById("toggleButton2").style.display = "none";
			       }
			}
		
			</script>
		<!-- END -->
		
		<title>Event Manager - New Event Entry</title>
		
	<?php 
	
	include("inc/dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$school = mysql_query("SELECT * FROM schools");
	
	$email = mysql_query("SELECT * FROM email_em ORDER BY id ASC");
	
	$flyer = mysql_query("SELECT * FROM flyer_em ORDER BY id ASC");
	
	$highlights1 = mysql_query("SELECT * FROM highlights_em ORDER BY id ASC");
	$highlights2 = mysql_query("SELECT * FROM highlights_em ORDER BY id ASC");
	$highlights3 = mysql_query("SELECT * FROM highlights_em ORDER BY id ASC");
	$highlights4 = mysql_query("SELECT * FROM highlights_em ORDER BY id ASC");

    function DateSelector($inName, $class, $useDate=0) 
    { 
        /* create array so we can name months */ 
        $monthName = array(1=> "January", "February", "March", 
            "April", "May", "June", "July", "August", 
            "September", "October", "November", "December"); 
      
        /* if date invalid or not supplied, use current time */ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

        /* make month selector */ 
        echo "<SELECT class='" . $class . "' NAME=" . $inName . "Month>\n"; 
        echo "<option value='' selected>Month</option>";
        for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) 
        { 
            echo "<OPTION VALUE=\""; 
            echo intval($currentMonth); 
            echo "\""; 
            echo ">" . $monthName[$currentMonth] . "\n"; 
        } 
        echo "</SELECT><br>"; 

        /* make day selector */ 
        echo "<SELECT class='" . $class . "' NAME=" . $inName . "Day>\n"; 
        echo "<option value='' selected>Day</option>";
        for($currentDay=1; $currentDay <= 31; $currentDay++) 
        { 
            echo "<OPTION VALUE=\"$currentDay\""; 
            echo ">$currentDay\n"; 
        } 
        echo "</SELECT>"; 
    
    } 
    
    function TimeSelector($eventID, $class)
    {
    		$d=1;
    	    	echo "<select class='" . $class . "' name='" . $eventID . "Hour'>";
    	    	echo "<option value='' selected>Hour</option>";
	    	
	    	while ($d<=12)
	    		{
	    			echo "<option value='" . $d . "'>" . $d . "</option>";
	    			$d++;
	    		}
		
		echo "</select><br>";
		
		echo "<select class='" . $class . "' name='" . $eventID . "Minutes'>";
		echo "<option value='' selected>Minutes</option>";
		echo "<option value='00'>00</option>";
		echo "<option value='15'>15</option>";
		echo "<option value='30'>30</option>";
		echo "<option value='45'>45</option>";
		echo "</select><br>";
		
		echo "<select class='" . $class . "' name='" . $eventID . "AMPM'>";
		echo "<option value='' selected>AM/PM</option>";
		echo "<option value='am'>am</option>";
		echo "<option value='pm'>pm</option>";
		echo "</select><br>";
    }
    
    function DaySelector($eventID, $class)
    {
    	    echo "<select class='" . $class . "' name='" . $eventID . "DayName'>";
    	    echo "<option value='' selected>Day Name</option>";
	    	echo "<option value='Monday'>Monday</option>";
	    	echo "<option value='Tuesday'>Tuesday</option>";
	    	echo "<option value='Wednesday'>Wednesday</option>";
	    	echo "<option value='Thursday'>Thursday</option>";
	    	echo "<option value='Friday'>Friday</option>";
	    	echo "<option value='Saturday'>Saturday</option>";
	    	echo "<option value='Sunday'>Sunday</option>";
    		echo "</select>";
    }
    
?> 
	</head>
	<body>
		<div id="shell">
			<div id="container">
<?PHP include("../inc/topNav.php"); ?>

	<div id="eventEntry">
	<div class="menuTab">New Event</div>
	
<form action="functions/insert.php" method="post" id="event">

<!-- Section -->

<div class="sectionBreak">
	<div class="disclaimer">Please complete the form below to send a request to the marketing department to create promotional materials for a new event</div>
</div>

<!-- END Section -->

<!-- Section -->
   
   <div class="sectionBreak">
   
   <h1>Your Information</h1>
   
    <div class="label">Your Name</div>
    <div class="inputMedium"><input type="text"  name="yourName" size="28" class="required" /><a href="#" title='For Internal Purposes'><img border="0" src="assets/help.png"></a></div>
    <div class="label">Your E-Mail</div>
    <div class="inputMedium"><input type="text" title="For Internal Contact Purposes" name="yourEmail" size="28" class="required email" /><a href="#" title='For Internal Purposes'><img border="0" src="assets/help.png"></a></div>
    
    <?PHP
		if ($_SESSION['role']=="School")
			echo "<input type='hidden' name='schoolID' value='" . $_SESSION['schoolID']  . "'>";
		else	{
   
		echo "<div class='label clear'>Choose School</div>";
	          echo "<div class='inputLarge'>";
		
		echo "<select name='schoolID' class='required'>";
		echo "<option value=''>Please Choose your School</option>";
			while($schoolinfo = mysql_fetch_array($school))
				  {
				  echo "<option value='" . $schoolinfo['id'] . "'>" . $schoolinfo['schoolName'] . "</option>";
				  }
		echo "</select></div>";
		}
    ?>
		
    <div class="clear"></div>
    </div>

<!-- END Section -->

<!-- Section -->

<div class="sectionBreak">

<h1>Asset Information</h1>
    
    <div class="labelLarge clear">Area Codes to Target</div>
    
    <div class="inputLarge"><input type="text"  name="targetAreaCode1" size="3" id="targetAreaCode1" class="areacode" /> , <input type="text"  name="targetAreaCode2" class="digits" size="3" /> , <input type="text"  name="targetAreaCode3" class="digits" size="3" />, <input type="text"  name="targetAreaCode4" class="digits" size="3" /> , <input type="text"  name="targetAreaCode5" class="digits" size="3" /><a href="#" title='Area Codes to target with banner ad'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label clear">E-mail Design</div>
    <div class="inputFull">
    		<select name="email" style="width:100px;">
			
			<?PHP
				while($emailInfo = mysql_fetch_array($email))
					  {
					  echo "<option value='" . $emailInfo['id'] . "'>" . $emailInfo['name'] . "</option>";
					  }
			?>
		
		</select>
&nbsp;&nbsp;&nbsp;<b>Preview the emails</b><a class="group1" title='Preview This Email' target="_blank" href="emails/1/preview.jpg"><img border="0" src="/images/icons/preview2.png"><span>{Blue}</span></a>
 </div>
    
        <div class="label clear">Flyer Design</div>
    <div class="inputFull">
    		<select name="flyer" style="width:100px;">
			
			<?PHP
				while($flyerInfo = mysql_fetch_array($flyer))
					  {
					  echo "<option value='" . $flyerInfo['id'] . "'>" . $flyerInfo['name'] . "</option>";
					  }
			?>
		
		</select>
&nbsp;&nbsp;&nbsp;<b>Preview the flyers</b><a class="group2" title='Preview This Flyer' target="_blank" href="flyers/1/preview.jpg"><img border="0" src="/images/icons/preview2.png"><span>{Laid Off}</span></a><a class="group2" title='Preview This Flyer' target="_blank" href="flyers/2/preview.jpg"><img border="0" src="/images/icons/preview2.png"><span>{Unemployed}</span></a><a class="group2" title='Preview This Flyer' target="_blank" href="flyers/3/preview.jpg"><img border="0" src="/images/icons/preview2.png"><span>{Red Truck}</span></a><a class="group2" title='Preview This Flyer' target="_blank" href="flyers/4/preview.jpg"><img border="0" src="/images/icons/preview2.png"><span>{Trucker}</span></a>
    </div>
    
    <div class="clear"></div>
</div>

<!-- END Section -->

<!-- Section -->

<div class="sectionBreak">

    <h1>Event Contact Information</h1>

    <div class="label clear">RSVP Phone</div>
    <div class="inputMedium"><input type="text"  name="rsvpPhone" size="28" /><a href="#" title='People will RSVP to this number'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label">RSVP E-Mail</div>
    <div class="inputMedium"><input type="text" name="rsvpEmail" size="28" class="email required" /><a href="#" title='People will RSVP to this e-mail address'><img border="0" src="assets/help.png"></a></div>
        
    <div class="label clear">Event Name</div>
    <div class="inputMedium"><input type="text" name="eventName" size="28" class="required" /><a href="#" title='examples: Driver Hiring Event or Job Fair at John"s Cafe'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label">Location Name</div>
    <div class="inputMedium"><input type="text" value="Roadmaster Drivers School" name="eventLocationName" size="28" /><a href="#" title='ie. Florida Fairgrounds or John"s Cafe'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label clear">Event Address</div>
    <div class="inputMedium"><input type="text" name="eventLocAdd1" size="28" class="required" /><a href="#" title='Event"s street address'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label">Event Address cont.</div>
    <div class="inputMedium"><input type="text" name="eventLocAdd2" size="28" /><a href="#" title='Event"s street address continued such as Suite 100'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label clear">City</div>
    <div class="inputMedium"><input type="text" name="eventLocCity" id="address2" size="18" class="required" /><a href="#" title='Event"s City'><img border="0" src="assets/help.png"></a></div>
    
    <div class="label">State</div>
    <div class="inputMedium">
    <select name="eventLocState" class="required">
        <option value="">Select a State</option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
    </select>
    <a href="#" title='Events State'><img border="0" src="assets/help.png"></a>
    </div>
    
    <div class="label clear">ZipCode</div>
    <div class="input"><input type="text" name="eventLocZip" size="6" class="required" /><a href="#" title='Events Zip Code'><img border="0" src="assets/help.png"></a></div>
    
    <div class="clear"></div>
  
</div>

<!-- END Section -->

<!-- Section -->
<div class="sectionBreak">

<h1>Event Dates & Times</h1>
    
  <div id="box">
    <div class="labelSmall">Event Day<br><a href="#" title='Event date and time'><img border="0" src="assets/help.png"></a></div>
    <div class="input">
    	<?php DaySelector( "eventDate1", "required"); ?>
    </div>
    
    <div class="labelSmall">Event Date</div>
    <div class="inputSmall">
    	<?php DateSelector( "eventDate1", "required"); ?><br>
    	<select name="eventDate1Year" class="required">
	    	<option value="" selected>Year</option>
	    	<option value="2012">2012</option>
	    	<option value="2013">2013</option>
	    	<option value="2014">2014</option>
	    	<option value="2015">2015</option>
    	</select>
    </div>
    
    <div class="labelSmall">Event  <br>Start Time</div>
    <div class="inputSmall">
	<?php TimeSelector( "eventTime1", "required"); ?>
    </div>
    
    <div class="labelSmall">Event <br>End Time</div>
    <div class="inputSmall">
	<?php TimeSelector( "eventTime1End", "required"); ?>
    </div>
    </div>
       <div class="clear"></div>
    
</div>

<!-- END Section -->

<!-- Section -->

<div class="sectionBreak">

    <div class="label">Event Description<br><a href="#" title='Describe the event and purpose in a paragraph or two'><img border="0" src="assets/help.png"></a></div>
    <div class="inputExtraLarge"><textarea name="eventDesc" cols="100" rows="5" class="required">Don&#039;t miss this opportunity to meet with trucking industry professionals! Truck drivers are in demand, and there is great earning potential as a professional truck driver!</textarea><br><br></div>
    
    <div class="label clear" style="padding-bottom:50px;">Choose Preset or<br>Enter a Custom<br><a href="#" title='Highlights are things like "Reps from TMC Transport will be here" or "Snacks will be served". You can choose a preset highlight or enter your own custom one.'><img border="0" src="assets/help.png"></a></div>
    <div class="inputMedium">
    
        <select style="width:730px;" name='eventHighlightSystem1'>
        <option value="custom">Choose a highlight or enter a custom one</option>
		    <?PHP while($highlightInfo1 = mysql_fetch_array($highlights1))
				 {
					 echo "<option value='" . $highlightInfo1['id'] . "'>" . $highlightInfo1['highlight'] . "</option>";
				 }
			?>
	 </select>
    
    <input type="text" name="eventHighlight1" size="140" /></div>
    <div class="label clear" style="padding-bottom:50px;">Choose Preset or<br>Enter a Custom<br><a href="#" title='Highlights are things like "Reps from TMC Transport will be here" or "Snacks will be served". You can choose a preset highlight or enter your own custom one.'><img border="0" src="assets/help.png"></a></div>
    <div class="inputMedium">
    
     <select style="width:730px;" name='eventHighlightSystem2'>
        <option value="custom">Choose a highlight or enter a custom one</option>
		    <?PHP while($highlightInfo2 = mysql_fetch_array($highlights2))
				 {
					 echo "<option value='" . $highlightInfo2['id'] . "'>" . $highlightInfo2['highlight'] . "</option>";
				 }
			?>
	 </select>
    
    <input type="text" name="eventHighlight2" size="140" />
    </div>
    
    <div class="label clear" style="padding-bottom:50px;">Choose Preset or<br>Enter a Custom<br><a href="#" title='Highlights are things like "Reps from TMC Transport will be here" or "Snacks will be served". You can choose a preset highlight or enter your own custom one.'><img border="0" src="assets/help.png"></a></div>
    <div class="inputMedium">
    
     <select style="width:730px;" name='eventHighlightSystem3'>
        <option value="custom">Choose a highlight or enter a custom one</option>
		    <?PHP while($highlightInfo3 = mysql_fetch_array($highlights3))
				 {
					 echo "<option value='" . $highlightInfo3['id'] . "'>" . $highlightInfo3['highlight'] . "</option>";
				 }
			?>
	 </select>
    
    <input type="text" name="eventHighlight3" size="140" />
    </div>
    
    <div class="label clear" style="padding-bottom:50px;">Choose Preset or<br>Enter a Custom<br><a href="#" title='Highlights are things like "Reps from TMC Transport will be here" or "Snacks will be served". You can choose a preset highlight or enter your own custom one.'><img border="0" src="assets/help.png"></a></div>
    <div class="inputMedium">
    
     <select style="width:730px;" name='eventHighlightSystem4'>
        <option value="custom">Choose a highlight or enter a custom one</option>
		    <?PHP while($highlightInfo4 = mysql_fetch_array($highlights4))
				 {
					 echo "<option value='" . $highlightInfo4['id'] . "'>" . $highlightInfo4['highlight'] . "</option>";
				 }
			?>
	 </select>
    
    <input type="text" name="eventHighlight4" size="140" />
    </div>
    
    <div class="alert" >
    <p>Please make sure that all information is correct before submitting your event.<br>All changes after submission will have to be emailed to the marketing department.</p>
    	<div class="submitButton clear"><input class="button" type="submit" name="submit" id="submit" value="Submit this Form" /></div>
    </div>
</div>
<!-- END Section -->

<!-- Section -->

</form>
</div></div>

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
<?PHP include("inc/dbClose.php"); ?>
	

	</body>
</html>