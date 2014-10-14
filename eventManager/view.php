<?php 
	include("../inc/security.inc"); 
		
	include("inc/dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $_GET['eventID'] . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $recordInfo['flyer'] . " ' ");
	$selectedFlyer = mysql_fetch_array($flyer);
	
	$rsvp = mysql_query("SELECT * FROM rsvp_em WHERE event='" . $_GET['eventID']  . "'");
	$num_rows = mysql_num_rows($rsvp);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Event Manager - View Your Event</title>
		
		<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to DELETE this event?")
			if (msg) {window.location.href = site}
			else (null)
			}
		</script>
		
			<style>
				h1	{padding-bottom: 15px; padding-top: 15px; font-size: 24px;}
				h3	{padding-bottom: 15px; padding-top: 15px; font-size: 24px;}
			</style>

	</head>
		
<div id="shell">
		<div id="container">
<?PHP include("../inc/topNav.php"); ?>

<div id="view" class="rounded">
<div class="menuTab">Event Info</div>

<h1><?PHP echo $recordInfo['eventName']; ?></h1>

<h1>Event Date(s) and Time(s)</h1>

<ul>
	<li><?PHP echo $recordInfo['eventDate1DayName'] . ", " . $recordInfo['eventDate1Month'] . "/" . $recordInfo['eventDate1Day'] . "/" . $recordInfo['eventDate1Year'] . " at " . $recordInfo['eventTime1Hour'] . ":" . $recordInfo['eventTime1Minutes'] . $recordInfo['eventTime1AMPM'] . " until " . $recordInfo['eventTime1EndHour'] . ":" . $recordInfo['eventTime1EndMinutes'] . $recordInfo['eventTime1EndAMPM'] ; ?></li>
	
	<?php if( !empty( $recordInfo['eventDate2DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate2DayName'] . ", " . $recordInfo['eventDate2Month'] . "/" . $recordInfo['eventDate2Day'] . "/" . $recordInfo['eventDate2Year'] . " at " . $recordInfo['eventTime2Hour'] . ":" . $recordInfo['eventTime2Minutes'] . " " . $recordInfo['eventTime2AMPM']  . " until " . $recordInfo['eventTime2EndHour'] . ":" . $recordInfo['eventTime2EndMinutes'] . $recordInfo['eventTime2EndAMPM'] ; ?></li>
	<?php endif; ?>
	
	<?php if( !empty( $recordInfo['eventDate3DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate3DayName'] . ", " . $recordInfo['eventDate3Month'] . "/" . $recordInfo['eventDate3Day'] . "/" . $recordInfo['eventDate3Year'] . " at " . $recordInfo['eventTime3Hour'] . ":" . $recordInfo['eventTime3Minutes'] . " " . $recordInfo['eventTime3AMPM'] . " until " . $recordInfo['eventTime3EndHour'] . ":" . $recordInfo['eventTime3EndMinutes'] . $recordInfo['eventTime3EndAMPM']  ; ?></li>
	<?php endif; ?>

	<?php if( !empty( $recordInfo['eventDate4DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate4DayName'] . ", " . $recordInfo['eventDate4Month'] . "/" . $recordInfo['eventDate4Day'] . "/" . $recordInfo['eventDate4Year'] . " at " . $recordInfo['eventTime4Hour'] . ":" . $recordInfo['eventTime4Minutes'] . " " . $recordInfo['eventTime4AMPM'] . " until " . $recordInfo['eventTime4EndHour'] . ":" . $recordInfo['eventTime4EndMinutes'] . $recordInfo['eventTime4EndAMPM']  ; ?></li>
	<?php endif; ?>

	<?php if( !empty( $recordInfo['eventDate5DayName']  ) ): ?>
	<li><?PHP echo $recordInfo['eventDate5DayName'] . ", " . $recordInfo['eventDate5Month'] . "/" . $recordInfo['eventDate5Day'] . "/" . $recordInfo['eventDate5Year'] . " at " . $recordInfo['eventTime5Hour'] . ":" . $recordInfo['eventTime5Minutes'] . " " . $recordInfo['eventTime5AMPM'] . " until " . $recordInfo['eventTime5EndHour'] . ":" . $recordInfo['eventTime5EndMinutes'] . $recordInfo['eventTime5EndAMPM']  ; ?></li>
	<?php endif; ?>

</ul>

<h1>Event Information</h1>
<ul>
	<li><b>RSVP Phone:</b> <?PHP echo $recordInfo['rsvpPhone']; ?></li>
	<li><b>RSVP Email:</b> <?PHP echo $recordInfo['rsvpEmail']; ?></li>
	<li><b>Location Name:</b> <?PHP echo $recordInfo['eventLocationName']; ?></li>
	<li><b>Event Address:</b> <?PHP echo $recordInfo['eventLocAdd1'] . " " . $recordInfo['eventLocAdd2'] . " " . $recordInfo['eventLocCity'] . ", " . $recordInfo['eventLocState'] . " " . $recordInfo['eventLocZip'] ;?></li>
</ul>		
<h1>Marketing Information</h1>
<h3>Print Marketing</h3>
<p>The marketing department has been notified about your event "<?PHP echo $recordInfo['eventName']; ?>". You may now <a target="_blank" href="flyers/flyer.php?eventID=<?PHP echo $_GET['eventID']; ?>">use the flyer</a> below to promote your event. The <a target="_blank" href="http://www.web2pdfconvert.com/engine?curl=http://www.roadmaster.com/eventmanager/flyers/<?PHP echo $recordInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $_GET['eventID']; ?>&outputmode=service&filename=EventFlyer&margintop=0&marginbottom=0&marginleft=0&marginright=2&porient=<?PHP echo $selectedFlyer['orientation']; ?>&psize=letter&id=225522257">PDF may be printed</a> or sent to a printing company to be reproduced.</p> 

<h3>Online Marketing</h3>
<p>You may also select, copy and paste <a target="_blank" href="emails/email.php?eventID=<?PHP echo $_GET['eventID']; ?>">the email</a> and send to your contacts. The marketing department will also send a mass email to leads from the last <?PHP echo $recordInfo['leadRange']; ?> days that are within <?PHP echo $recordInfo['leadRadius']; ?> miles of the event. The initial email is scheduled to be sent one week before the event with a resend scheduled to go out the day before the event.</p>

<h3>Electronic Marketing</h3>
<p>We will make every attempt to tag any radio or TV promotions that you may currently have running in your area. Due to production time, altering these commercials may not be possible.</p>

<?php if( !empty( $recordInfo['marketingNotes']  ) ): ?>
<h3>Marketing Notes</h3>
<p><?PHP echo $recordInfo['marketingNotes']; ?></p>
<?php endif; ?>

<h3>RSVP Information</h3>
<p><b>Total Online RSVPs: <?PHP echo $num_rows; ?></b></p>
<?PHP 
			if (mysql_num_rows ($rsvp) == 0) {
				echo "<div>There are no online RSVPs found yet.</div>";
			}
			else { 
				echo "<ul>";
					while($rsvpInfo = mysql_fetch_array($rsvp))
						  {
						  
						  echo "<li class='rsvp'><span><b>Name: </b>". $rsvpInfo['firstName'] . " " . $rsvpInfo['lastName'] . "</span>";
						  
						  if( !empty( $rsvpInfo['phone']  ) )
						  	echo "<span><b>Phone: </b>" . $rsvpInfo['phone'] . "</span>";
						  
						  if( !empty( $rsvpInfo['email']  ) )
						  	echo "<span style='width:200px;'><b>Email: </b><a href='mailto:" . $rsvpInfo['email'] . "'>" . $rsvpInfo['email'] . "</a></span>";
						  echo "</li>";
			}	
			echo "</ul>";
				}

?>
</div>
<div class="toolbarShell">

<a class="button" target="_blank" href="emails/<?PHP echo $recordInfo['email']; ?>/email.php?eventID=<?PHP echo $_GET['eventID']; ?>">View Email</a>
<a class="button" target="_blank" href="http://do.convertapi.com/web2pdf?curl=http://mm.careerpathtraining.com/eventmanager/flyers/<?PHP echo $recordInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $_GET['eventID']; ?>&PageOrientation=<?PHP echo $selectedFlyer['orientation']; ?>&OutputFileName=EventFlyer&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=2&PageSize=letter&ApiKey=225522257&AlternativeParser=true">Save Flyer as PDF</a>
<a class="button" target="_blank" href="http://www.roadmaster.com/event-banner-preview.php?mode=preview&eventID=<?PHP echo $_GET['eventID']; ?>">View Banner</a>
<a class="button" target="_blank" href="http://www.roadmaster.com/MM/mm-event-view.php?eventID=<?PHP echo $_GET['eventID']; ?>">View Event Page</a>
<br><br>
<a class="buttonDelete delete" href="javascript:goto('functions/delete.php?eventID=<?PHP echo $recordInfo['id']; ?>')">Delete this Event</a>
<a class="button" href="listing.php">Return to Listings</a>
<a class="button" href="default.php">Logout</a></div>

</div></div>
<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="../images/cpt.png"></a>
					</div>
			</div>

</div>
<?PHP include("inc/dbClose.php"); ?>