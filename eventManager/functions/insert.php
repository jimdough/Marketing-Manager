<?php

	include("../../inc/security.inc"); 

	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);
	
	$schoolID=$_POST['schoolID'];

	$school = mysql_query("SELECT * FROM schools WHERE id='" . $_POST['schoolID'] ."'");
	$schoolInfo = mysql_fetch_array($school);
	
	$qc = mysql_query("SELECT * FROM admin WHERE role= 'qcEvent' ");
	$qcInfo = mysql_fetch_array($qc);
	
	// Parse Prefilled Highlight data
	
		if ($_POST['eventHighlightSystem1']=="custom")	{
		$highlight1=$_POST['eventHighlight1'];
	} else {
		$highlightQuery1 = mysql_query("SELECT * FROM highlights_em WHERE id='" . $_POST['eventHighlightSystem1'] . "'");
		$highlight1info= mysql_fetch_array($highlightQuery1);
		
		$highlight1=$highlight1info['highlight'];
	}
	
			if ($_POST['eventHighlightSystem2']=="custom")	{
		$highlight2=$_POST['eventHighlight2'];
	} else {
		$highlightQuery2 = mysql_query("SELECT * FROM highlights_em WHERE id='" . $_POST['eventHighlightSystem2'] . "'");
		$highlight2info= mysql_fetch_array($highlightQuery2);
		
		$highlight2=$highlight2info['highlight'];
	}
	
			if ($_POST['eventHighlightSystem3']=="custom")	{
		$highlight3=$_POST['eventHighlight3'];
	} else {
		$highlightQuery3 = mysql_query("SELECT * FROM highlights_em WHERE id='" . $_POST['eventHighlightSystem3'] . "'");
		$highlight3info= mysql_fetch_array($highlightQuery3);
		
		$highlight3=$highlight3info['highlight'];
	}
	
			if ($_POST['eventHighlightSystem4']=="custom")	{
		$highlight4=$_POST['eventHighlight4'];
	} else {
		$highlightQuery4 = mysql_query("SELECT * FROM highlights_em WHERE id='" . $_POST['eventHighlightSystem4'] . "'");
		$highlight4info= mysql_fetch_array($highlightQuery4);
		
		$highlight4=$highlight4info['highlight'];
	}
	
	// end parsing
	
	$sql="INSERT INTO event_em (schoolID, email, flyer, yourName, yourEmail, rsvpPhone, rsvpEmail, eventName, eventDesc, eventLocationName, eventLocAdd1, eventLocAdd2, eventLocCity, eventLocState, eventLocZip, eventDate1DayName, eventDate1Month, eventDate1Day, eventDate1Year, eventTime1Hour, eventTime1Minutes, eventTime1AMPM, eventTime1EndHour, eventTime1EndMinutes, eventTime1EndAMPM, eventHighlight1, eventHighlight2, eventHighlight3, eventHighlight4, targetAreaCode1, targetAreaCode2, targetAreaCode3, targetAreaCode4, targetAreaCode5, approvalStatus) VALUES ('$_POST[schoolID]', '$_POST[email]', '$_POST[flyer]', '$_POST[yourName]', '$_POST[yourEmail]', '$_POST[rsvpPhone]', '$_POST[rsvpEmail]', '" . mysql_real_escape_string($_POST['eventName']) . "', '" . mysql_real_escape_string($_POST['eventDesc']) . "', '" . mysql_real_escape_string($_POST['eventLocationName']) . "', '" . mysql_real_escape_string($_POST['eventLocAdd1']) . "', '" . mysql_real_escape_string($_POST['eventLocAdd2']) . "', '" . mysql_real_escape_string($_POST['eventLocCity']) . "', '$_POST[eventLocState]', '$_POST[eventLocZip]', '$_POST[eventDate1DayName]', '$_POST[eventDate1Month]', '$_POST[eventDate1Day]', '$_POST[eventDate1Year]', '$_POST[eventTime1Hour]', '$_POST[eventTime1Minutes]', '$_POST[eventTime1AMPM]', '$_POST[eventTime1EndHour]', '$_POST[eventTime1EndMinutes]', '$_POST[eventTime1EndAMPM]', '" . $highlight1 . "', '" . $highlight2 . "', '" . $highlight3 . "', '" . $highlight4 . "', '$_POST[targetAreaCode1]', '$_POST[targetAreaCode2]', '$_POST[targetAreaCode3]', '$_POST[targetAreaCode4]', '$_POST[targetAreaCode5]', '0')";
	

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
	 $message ->setBody("A new event has been created by " .  $_POST['yourName'] . " for " . $schoolInfo['schoolName'] . " and is ready for approval. Please <a href='http://mm.careerpathtraining.com/eventManager/edit.php?eventID=" . mysql_insert_id() . "'>go to Marketing Manager</a> to edit and/or approve the event.<br /><h2>" .  $schoolInfo['schoolName'] . "</h2><h3>Event Name: " . $_POST['eventName'] . "</h3><b>Date: " . $_POST['eventDate1DayName'] . ", " . $_POST['eventDate1Month'] . "/" . $_POST['eventDate1Day'] . "/" . $_POST['eventDate1Year'] . "</b><br>" .  $_POST['eventLocAdd1'] . "," . $_POST['eventLocAdd2'] . "<br>" . $_POST['eventLocCity'] . ", " . $_POST['eventLocState'] . " " . $_POST['eventLocZip']);
	 
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
	 $message ->setBody("Your request for the promotion of the event called <b>" . $_POST['eventName'] . "</b> has been sent to " .  $qcInfo['name'] . ". After the submission is approved you will receive an email indicating that your event is ready to be promoted. If you have any questions, concerns or corrections please email " . $qcInfo['name'] . " at <a href='mailto:" . $qcInfo['email'] . "'>" . $qcInfo['email'] . "</a><h2>" .  $schoolInfo['schoolName'] . "</h2><h3>Event Name: " . $_POST['eventName'] . "</h3><b>Date: " . $_POST['eventDate1DayName'] . ", " . $_POST['eventDate1Month'] . "/" . $_POST['eventDate1Day'] . "/" . $_POST['eventDate1Year'] . "</b><br>" .  $_POST['eventLocAdd1'] . "," . $_POST['eventLocAdd2'] . "<br>" . $_POST['eventLocCity'] . ", " . $_POST['eventLocState'] . " " . $_POST['eventLocZip']);
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

	include("../inc/dbClose.php");

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../../inc/head.inc"); ?>
		<title>Event Manager - Event Created</title>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer"><div class="menuTab">Processing</div>
Your event has been created and the Marketing Department has been notified. You will receive an email when your event listing has been approved.<br><br>
<a class="button next" href="../listing.php">View Upcoming Events</a>
			</div>		
			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="/images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>