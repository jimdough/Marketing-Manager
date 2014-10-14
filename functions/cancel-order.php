<?php
	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 

	$orderID = $_GET['orderID'];

	mysql_select_db ($database,$con);
	
	$adminSA = mysql_query("SELECT * FROM admin WHERE role='supplyAdmin' ");
	$selectedAdminSA = mysql_fetch_array($adminSA);
	
	$user = mysql_query("SELECT * FROM users WHERE ID='" . $_SESSION['id'] . "'");
	$userInfo = mysql_fetch_array($user);
	
	$school = mysql_query("SELECT * FROM schools WHERE ID='" . $userInfo['schoolID'] . "'");
	$schoolMenu = mysql_fetch_array($school);
	
	$order = mysql_query("SELECT * FROM orders WHERE ID='" . $_GET['orderID'] . "'");
	$orderInfo = mysql_fetch_array($order);
	  	
  	mysql_query("DELETE FROM orders WHERE id='" . $orderID . "'");
	
	include("../inc/dbClose.php");
	
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('Order # ' .  $orderInfo['id']  . ' CANCELLATION from Marketing Manager');
	
	  //Set the From address with an associative array
	  $message->setFrom($userInfo['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($selectedAdminSA['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	$message ->setBody($userInfo['firstName'] . " " . $userInfo['lastName'] . " from " . $schoolMenu['schoolName'] . " has cancelled thier order for " . $orderInfo['qty'] . " " . $orderInfo['supplyName'] . " placed on " . $orderInfo['month'] . "/" . $orderInfo['day'] . "/" . $orderInfo['year']);
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Order Cancellation</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "../orders-school.php";
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
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					<p>Cancelling Order</p><br>
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