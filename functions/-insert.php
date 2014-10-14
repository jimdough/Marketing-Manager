<?php

	include("../inc/security.inc"); 

	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);
	
	$schoolID=$_POST['schoolID'];
	$school = mysql_query("SELECT * FROM schools WHERE id='" . $_POST['schoolID'] ."'");
	$schoolInfo = mysql_fetch_array($school);
	
	if ($_POST['eventHighlightSystem1']=="custom")	{
		$highlight1=$_POST['eventHighlight1'];
	} else {
		$highlight1=$_POST['eventHighlightSystem1'];
	}
	
	$sql="INSERT INTO event (schoolID, email, flyer, yourName, yourEmail, rsvpPhone, rsvpEmail, eventName, eventDesc, eventLocationName, eventLocAdd1, eventLocAdd2, eventLocCity, eventLocState, eventLocZip, eventDate1DayName, eventDate1Month, eventDate1Day, eventDate1Year, eventDate2DayName, eventDate2Month, eventDate2Day, eventDate2Year, eventDate3DayName, eventDate3Month, eventDate3Day, eventDate3Year, eventDate4DayName, eventDate4Month, eventDate4Day, eventDate4Year, eventDate5DayName, eventDate5Month, eventDate5Day, eventDate5Year, eventTime1Hour, eventTime1Minutes, eventTime1AMPM, eventTime1EndHour, eventTime1EndMinutes, eventTime1EndAMPM, eventTime2Hour, eventTime2Minutes, eventTime2AMPM, eventTime2EndHour, eventTime2EndMinutes, eventTime2EndAMPM, eventTime3Hour, eventTime3Minutes, eventTime3AMPM, eventTime3EndHour, eventTime3EndMinutes, eventTime3EndAMPM, eventTime4Hour, eventTime4Minutes, eventTime4AMPM, eventTime4EndHour, eventTime4EndMinutes, eventTime4EndAMPM, eventTime5Hour, eventTime5Minutes, eventTime5AMPM, eventTime5EndHour, eventTime5EndMinutes, eventTime5EndAMPM, eventHighlight1, eventHighlight2, eventHighlight3, eventHighlight4, targetAreaCode1, targetAreaCode2, targetAreaCode3, targetAreaCode4, targetAreaCode5, approvalStatus) VALUES ('$_POST[schoolID]', '$_POST[email]', '$_POST[flyer]', '$_POST[yourName]', '$_POST[yourEmail]', '$_POST[rsvpPhone]', '$_POST[rsvpEmail]', '" . mysql_real_escape_string($_POST['eventName']) . "', '" . mysql_real_escape_string($_POST['eventDesc']) . "', '" . mysql_real_escape_string($_POST['eventLocationName']) . "', '" . mysql_real_escape_string($_POST['eventLocAdd1']) . "', '" . mysql_real_escape_string($_POST['eventLocAdd2']) . "', '" . mysql_real_escape_string($_POST['eventLocCity']) . "', '$_POST[eventLocState]', '$_POST[eventLocZip]', '$_POST[eventDate1DayName]', '$_POST[eventDate1Month]', '$_POST[eventDate1Day]', '$_POST[eventDate1Year]', '$_POST[eventDate2DayName]', '$_POST[eventDate2Month]', '$_POST[eventDate2Day]', '$_POST[eventDate2Year]', '$_POST[eventDate3DayName]', '$_POST[eventDate3Month]', '$_POST[eventDate3Day]', '$_POST[eventDate3Year]', '$_POST[eventDate4DayName]', '$_POST[eventDate4Month]', '$_POST[eventDate4Day]', '$_POST[eventDate4Year]', '$_POST[eventDate5DayName]', '$_POST[eventDate5Month]', '$_POST[eventDate5Day]', '$_POST[eventDate5Year]', '$_POST[eventTime1Hour]', '$_POST[eventTime1Minutes]', '$_POST[eventTime1AMPM]', '$_POST[eventTime1EndHour]', '$_POST[eventTime1EndMinutes]', '$_POST[eventTime1EndAMPM]', '$_POST[eventTime2Hour]', '$_POST[eventTime2Minutes]', '$_POST[eventTime2AMPM]', '$_POST[eventTime2EndHour]', '$_POST[eventTime2EndMinutes]', '$_POST[eventTime2EndAMPM]', '$_POST[eventTime3Hour]', '$_POST[eventTime3Minutes]', '$_POST[eventTime3AMPM]', '$_POST[eventTime3EndHour]', '$_POST[eventTime3EndMinutes]', '$_POST[eventTime3EndAMPM]', '$_POST[eventTime4Hour]', '$_POST[eventTime4Minutes]', '$_POST[eventTime4AMPM]', '$_POST[eventTime4EndHour]', '$_POST[eventTime4EndMinutes]', '$_POST[eventTime4EndAMPM]', '$_POST[eventTime5Hour]', '$_POST[eventTime5Minutes]', '$_POST[eventTime5AMPM]', '$_POST[eventTime5EndHour]', '$_POST[eventTime5EndMinutes]', '$_POST[eventTime5EndAMPM]', '" . $highlight1 . "', '" . mysql_real_escape_string($_POST['eventHighlight2']) . "', '$_POST[eventHighlight3]', '" . mysql_real_escape_string($_POST['eventHighlight4']) . "', '$_POST[targetAreaCode1]', '$_POST[targetAreaCode2]', '$_POST[targetAreaCode3]', '$_POST[targetAreaCode4]', '$_POST[targetAreaCode5]', '0')";
	

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
  ///// EMAIL TO QC PERSON IN MARKETING ////////
  
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - New School Event Created');
	
	  //Set the From address with an associative array
	  $message->setFrom(array($_POST['yourEmail']));
	
	  //Set the To addresses with an associative array
	  $message->setTo($qcInfo['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("A new event has been created by " .  $_POST['yourName'] . " for " . $schoolInfo['schoolName'] . " and is ready for approval. Please <a href='http://mm.careerpathtraining.com/eventManager/default.php?eventID=" . mysql_insert_id() . "'>go to the Marketing Manager</a> to edit and/or approve the event.");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
  	
  ///// EMAIL TO SUBMITTER AT SCHOOL /////
  
  	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - New School Event Created');
	
	  //Set the From address with an associative array
	  $message->setFrom($qcInfo['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($_POST['yourEmail']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("Your request for the promotion of the event called <b>" . $_POST['eventName'] . "</b> has been sent to " .  $qcInfo['name'] . ". After the submission is approved you will receive an email indicating that your event is ready to be promoted. If you have any questions, concerns or corrections please email " . $qcInfo['name'] . " at <a href='mailto:" . $qcInfo['email'] . "'>" . $qcInfo['email'] . "</a>");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

	include("../inc/dbClose.php");

?>

<html>
<head>
<title>Marketing Manager - Insert</title>
<?PHP include("../inc/head.inc"); ?>
</head>
<body>
<div id="logo"><img src="../assets/eventManager2Med.png"></div>
<div class="statement">
Your event has been created and the Marketing Department has been notified. You will receive an email when your event listing has been approved.<br><br>
<a class="button next" href="../listing.php">View Upcoming Events</a>
</div>
</body>
</html>	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					Your event has been created and the Marketing Department has been notified. You will receive an email when your event listing has been approved.
			</div>		
			
			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="/images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>
