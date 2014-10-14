<?PHP
	include("../inc/security.inc"); 
	include("../inc/dbOpen.php");
	mysql_select_db ($database, $con);
	
	// New Approval Check //
	
	$user = mysql_query("SELECT * FROM users WHERE email='" . $_POST['email'] . "' ");
	$userInfo = mysql_fetch_array($user);
	
	$adminQC = mysql_query("SELECT * FROM admin WHERE role='qcUser' ");
	$selectedAdminQC = mysql_fetch_array($adminQC);
	
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Password Recovery');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedAdminQC['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($userInfo['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("Your password for Marketing Manager is <b>" . $userInfo['password'] . "</b>. You may log into <a href='http://mm.careerpathtraining.com'>Marketing Manager </a>now.");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
    
	include("../inc/dbClose.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Order Deletion</title>
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					Your password has been sent to <?PHP echo $_POST['email']; ?><br><br><a href="../default.php">Click here to login to Marketing Manager</a>
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

