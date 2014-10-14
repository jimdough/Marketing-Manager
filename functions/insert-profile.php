<?php

	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);
	
	$qc = mysql_query("SELECT * FROM admin WHERE role= 'qcUser' ");
	$qcInfo = mysql_fetch_array($qc);
	
	$employer = mysql_query("SELECT * FROM schools WHERE id= '" . $_POST['schoolID'] . "'");
	$employerInfo = mysql_fetch_array($employer);
	
	$user = mysql_query("SELECT * FROM users WHERE email= '" . $_POST['email'] . "'");
	$userInfo = mysql_fetch_array($user);
	
	if( empty( $userInfo['email']  ) )	{
	
	$sql="INSERT INTO users (password, firstName, lastName, email, schoolID, mobilePhone, extension, fax, title, credentials, approvalStatus, employer, role) VALUES ('$_POST[password]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[email]', '$_POST[schoolID]', '$_POST[mobilePhone]', '$_POST[extension]', '$_POST[fax]', '$_POST[jobTitle]', '$_POST[credentials]', '0', '$employerInfo[employer]', '$_POST[role]')";
	
	}
	else	{
		header("Location:../userExists.php?flag=exists&email=" . $userInfo['email']  . "");
    		die();     // just to make sure no scripts execute
	}

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
  ///// EMAIL TO USER QC PERSON IN MARKETING ////////
  
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - New Profile Created');
	
	  //Set the From address with an associative array
	  $message->setFrom(array($_POST['email']));
	
	  //Set the To addresses with an associative array
	  $message->setTo($qcInfo['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("A new profile has been created by " .  $_POST['firstName'] . " " . $_POST['lastName'] . " for " . $employerInfo['schoolName'] . " and is ready for approval. Please <a href='http://mm.careerpathtraining.com/listing-user.php?sort=id&order=DESC'>go to the Marketing Manager</a> to edit and/or approve the profile.");
	 
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
	  $message->setSubject('MM - New Profile Created');
	
	  //Set the From address with an associative array
	  $message->setFrom($qcInfo['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($_POST['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("Your request for a Marketing Manager profile has been sent to " .  $qcInfo['name'] . ". After the submission is approved you will receive an email indicating that your profile is ready. If you have any questions, concerns or corrections please email " . $qcInfo['name'] . " at <a href='mailto:" . $qcInfo['email'] . "'>" . $qcInfo['email'] . "</a>");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

	include("../inc/dbClose.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Insert Profile</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "../internalDefault.php";
			}
		</script>
		
	</head>
	<body onload="setTimeout('redirectUser()', 3000)">
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					Your profile has been created and the Marketing Department has been notified. You will receive an email when your profile has been approved.<br>
					<img src="loader.gif">
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