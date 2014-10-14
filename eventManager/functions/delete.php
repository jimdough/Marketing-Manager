<?php
	include("../../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 

	$eventID = $_GET['eventID'];

	mysql_select_db ($database,$con);
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $eventID . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$adminEmail = mysql_query("SELECT * FROM admin WHERE role='admin' ");
	
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - School Event has been Deleted');
	
	  //Set the From address with an associative array
	  $message->setFrom(array($recordInfo['yourEMail']));
	
	  //Set the To addresses with an associative array
	  $message->setTo($recordInfo['yourEMail']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	  	  
	/* while($adminEmailInfo = mysql_fetch_array($adminEmail))
	  {
	  	$message->addTo($adminEmailInfo['email']);
	  }*/
	
	  //Give it a body
	 $message ->setBody("The event called <b>" .  $recordInfo['eventName'] . "</b> originally created by " . $recordInfo['yourName'] . " for " . $schoolInfo['schoolName'] . " and scheduled for " . $recordInfo['eventDate1Month'] . "/" .  $recordInfo['eventDate1Day'] . " has been deleted. If there are any questions you can <a href='mailto:" . $recordInfo['yourEMail'] . "'>email " . $recordInfo['yourName'] . " by clicking here</a>");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
  	
  	mysql_query("DELETE FROM event_em WHERE id='" . $eventID . "'");
	
	include("../inc/dbClose.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../../inc/head.inc"); ?>
		<title>Marketing Manager - Event Deletion</title>
		
<script type="text/javascript">
	function redirectUser(){
	  window.location = "../listing.php";
	}
</script>
		
	</head>
	<body onload="setTimeout('redirectUser()', 2000)">
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer"><div class="menuTab">Processing</div>
				<p>Deleting Event</p>
				<img src="loader.gif">
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