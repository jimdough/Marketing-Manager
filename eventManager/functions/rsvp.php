<?php

	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);
	
	
	$sql="INSERT INTO rsvp_em (event, date, email, phone, firstName, lastName) VALUES ('$_POST[event]', '$_POST[date]', '" . mysql_real_escape_string($_POST['email']) . "', '" . mysql_real_escape_string($_POST['phone']) . "', '" . mysql_real_escape_string($_POST['firstName']) . "', '" . mysql_real_escape_string($_POST['lastName']) . "')";
	

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
	  $message->setSubject('MM - RSVP Confirmation for ' . $_POST['eventName']);
	
	  //Set the From address with an associative array
	  $message->setFrom(($_POST['email']));
	
	  //Set the To addresses with an associative array
	  $message->setTo($_POST['rsvpEmail']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("There has been a RSVP sent from " .  $_POST['firstName'] . " " . $_POST['lastName'] ." for the event called ". $_POST['eventName'] . " starting on " . $_POST['eventDate'] . ". " . $_POST['firstName'] . "'s email address is <a href='mailto:". $_POST['email'] . "'>" . $_POST['email'] . "</a> and his/her phone number is " . $_POST['phone'] . " in case you want to contact them prior to the event.");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);


	include("../inc/dbClose.php");

?>
<html>
<head>
<script type="text/javascript">
	function redirectUser(){
	  window.location = "http://www.roadmaster.com/MM/MM-event-confirmation.php?eventID=<?PHP echo $_POST['event']; ?>";
	}
</script>
</head>
<body onload="setTimeout('redirectUser()', 0)"></body>
</html>