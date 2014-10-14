<?PHP
	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php");
	
	$orderID = $_GET['orderID'];
	$requestorEmail = $_GET['requestorEmail'];

	mysql_select_db ($database, $con);
	
	// Change completed field in orders table to 1 for requesting order
	
	mysql_query("UPDATE orders SET completed='1' WHERE id = '$orderID' ");
	
	$orders = mysql_query("SELECT * FROM orders WHERE id='" . $orderID . "'");
	$ordersInfo = mysql_fetch_array($orders);
	
	if ($ordersInfo['pdf']=="1")	{
		$adminQC = mysql_query("SELECT * FROM admin WHERE role='cardAdmin' ");
	} else {
		$adminQC = mysql_query("SELECT * FROM admin WHERE role='supplyAdmin' ");
	}
	
	$selectedAdminQC = mysql_fetch_array($adminQC);
	
	// Send Email to requestor

	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Your order has been processed');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedAdminQC['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($_GET['requestorEmail']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("Your order of " .  $ordersInfo['qty'] . " " . $ordersInfo['supplyName'] . " has been processed. If there are any errors or changes, please <a href='mailto:" . $selectedAdminQC['email'] . "'>email them to ". $selectedAdminQC['name'] . "</a>");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

	include("../inc/dbClose.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Process Order</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "/orders.php";
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
					<p>Updating system</p>
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