<?PHP include("../inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		
			<!-- Main CSS Override -->
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
		
		<title>Marketing Manager - View All Events</title>


		</head>

		<div id="shell">
		<div id="container">
<?PHP include("../inc/topNav.php"); ?>

<div id="listings">
<div class="menuTab">Events</div>
<?PHP
	include("inc/dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	// Set initial dates and values
	
	$year=date('Y');
	$nextYear=$year+1;
	$month=ltrim(date('m'), "0");
	$day=date('d');
	$school=$_SESSION['schoolID'] ;
	
	$admin = mysql_query("SELECT * FROM admin WHERE role='qcEvent' ");
	$adminInfo = mysql_fetch_array($admin);

	// loops through each year until it hits $nextYear
	for ($y=$year; $y<=$nextYear; $y++)	
	{
	
	if ($y==$year) {
		$m=$month;
	} else if  ($y!=$year) {
		$m=1;
	}

	
	for ($i=$m; $i<=12; $i++)
	{
	
	if ($_SESSION['role']=="School")	
			$record = mysql_query("SELECT * FROM event_em WHERE schoolID='" . $school . "' AND eventDate1Year='" . $y ."' AND eventDate1Month = '" . $i . "' ORDER BY eventDate1Day+0");
	elseif ($_SESSION['role']=="Admin")	
			$record = mysql_query("SELECT * FROM event_em WHERE eventDate1Year='" . $y ."' AND eventDate1Month = '" . $i . "' ORDER BY eventDate1Day+0");


		////// START DO WHILE LOOP //////
		
			if (mysql_num_rows ($record) != 0) {
				echo "<h1>Events in " . $i . "/" . $y . "</h1>"; 
				echo '<div class="entry"><span class="eventDate">Start Date</span><span class="schoolName">School Name</span><span class="eventName">Event Name</span>';
				echo "</div>";
			
			while($recordInfo = mysql_fetch_array($record))
				  {
		  	$schoolID = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
			$schoolInfo = mysql_fetch_array($schoolID);
			$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $recordInfo['flyer'] . " ' ");
			$selectedFlyer = mysql_fetch_array($flyer);
			
			
				// Sets color and functions based on approval
				
				  if ($recordInfo['approvalStatus']=='0')
				  	echo "<div class='entryPending'>";
				  else
				  	echo "<div class='entryApproved'>";

				  // Created Header Row
				  echo "<span class='eventDate'>" . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] . "</span>" ;
				  
				  // Writes first part of event info based on login credentials
				  if ($_SESSION['role']=="Admin") {
					  echo "<span class='schoolName'><a href='edit.php?eventID=" . $recordInfo['id'] . "'>" . $schoolInfo['schoolName'] . "</a></span>";
					  echo "<span class='eventName'><a class='button' href='view.php?eventID=" . $recordInfo['id'] . "'>View</a>&nbsp;&nbsp;";
					  echo "<a href='edit.php?eventID=" . $recordInfo['id'] . "'>" . $recordInfo['eventName'] . "</a></span>";
					  }
				  elseif  ($_SESSION['role']=="School" AND $recordInfo['approvalStatus']=='1') {
				 	  echo "<span class='schoolName'><a href='view.php?eventID=" . $recordInfo['id'] . "'>" . $schoolInfo['schoolName'] . "</a></span>";
				 	  echo "<span class='eventName'><a class='button' href='view.php?eventID=" . $recordInfo['id'] . "'>View</a>&nbsp;&nbsp;";
					  echo "<a href='edit.php?eventID=" . $recordInfo['id'] . "'>" . $recordInfo['eventName'] . "</a></span>";
				 	  }
				 elseif  ($_SESSION['role']=="School" AND $recordInfo['approvalStatus']=='0') {
				 	  echo "<span class='schoolName'><a href='#'>" . $schoolInfo['schoolName'] . "</a></span>";
				 	  echo "<span class='eventName'><a class='button' href='view.php?eventID=" . $recordInfo['id'] . "'>View</a>&nbsp;&nbsp;";
				 	  echo "<a href='#'>" . $recordInfo['eventName'] . "</a></span>";
				 	  } 	  
				 	  
				 	  
				// Displays functions if record is approved
				  if ($recordInfo['approvalStatus']=='1') {
				  echo "<span class='listingControls'><span class='function2'><a class='button' target='_blank' href='emails/" . $recordInfo['email'] . "/email.php?eventID=" . $recordInfo['id'] . "'>Email</a></span>" ;
				  echo "<span class='function2'><a class='button' target='_blank' href='http://www.roadmaster.com/event-banner-preview.php?mode=preview&eventID=" . $recordInfo['id'] . "'>Banner</a></span>" ;
				  echo "<span class='function2'><a class='button' target='_blank' href='http://www.roadmaster.com/MM/mm-event-view.php?eventID=" . $recordInfo['id'] . "'>Page</a></span>" ;
				   echo "<span class='function2'><a class='button' href='http://do.convertapi.com/web2pdf?curl=http://" . $_SERVER['SERVER_NAME'] . "/eventManager/flyers/" . $recordInfo['flyer'] . "/flyer.php?eventID=" . $recordInfo['id'] . "&PageOrientation=" . $selectedFlyer['orientation'] . "&outputmode=service&OutputFileName=EventFlyer&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=0&PageSize=letter&ApiKey=225522257&AlternativeParser=true'>Flyer</a></span>";

				  
				  }
				  // Displays functions if NOT approved
				  elseif ($recordInfo['approvalStatus']=='0') {
				  	 echo "<span class='listingControls'><span class='function2'>Pending Approval by <a href='mailto:"  . $adminInfo['email'] .  "'>" . $adminInfo['name']  .  "</a></span>" ;
				  }
				  
				  
				  // Displays functions based on permissions level
				  if ($_SESSION['role']=="Admin") {
				  	echo "<span class='function2'><a class='buttonUpdate' href='edit.php?eventID=" . $recordInfo['id'] . "'>Edit</a></span>" ;
				  	echo "<span class='function2'><a class='buttonDelete' href=\"javascript:goto('functions/delete.php?eventID=" . $recordInfo['id'] . "')\">Delete</a></span></span>" ;
				  	}
				  elseif ($_SESSION['role']=="School") {
				  	echo "<span class='function2'><a class='buttonDelete' href=\"javascript:goto('functions/delete.php?eventID=" . $recordInfo['id'] . "')\">Delete</a></span></span>" ;
				  	}
				  	echo "</div>";
				  	}
				  	
		    }
		    
		    }
		    }
		    /// CLOSE FOR LOOP ///
		    
				?>
		<div class="entry" style="text-align:center;">{<span class="swatchApproved">Events that are APPROVED are in Green</span> | <span class="swatchPending">Events PENDING Approval are in Red</span>}</div>
		
		<div class="disclaimer">New events that have not been approved by the marketing department will not appear here until they are approved.</div>


	<?PHP include("inc/dbClose.php"); ?>
	
</div>
<div class="controls">
<a class="buttonUpdate add" href="entry.php">Create a New Event</a>
<a class="button" href="listing-archived.php">View Past Events</a>
</div>
</div>
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="../images/cpt.png"></a>
					</div>
			</div>

</div>
</div>
