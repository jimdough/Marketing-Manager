<?PHP
	include("../inc/security.inc");
	include("../inc/dbOpen.php");

	mysql_select_db ($database, $con);
	
	$user = mysql_query("SELECT * FROM users WHERE ID='" . $_POST['userID'] . "'");
	$userInfo = mysql_fetch_array($user);
	
	$school = mysql_query("SELECT * FROM schools WHERE ID='" . $userInfo['schoolID'] . "'");
	$schoolMenu = mysql_fetch_array($school);
	
	$supply = mysql_query("SELECT * FROM schoolMenu WHERE ID='" . $_POST['supplyID'] . "'");
	$supplyInfo = mysql_fetch_array($supply);

	$adminCA = mysql_query("SELECT * FROM admin WHERE role='cardAdmin' ");
	$selectedAdminCA = mysql_fetch_array($adminCA);	
	
	$adminSA = mysql_query("SELECT * FROM admin WHERE role='supplyAdmin' ");
	$selectedAdminSA = mysql_fetch_array($adminSA);
	
	$price = mysql_query("SELECT * FROM prices WHERE ID='" . $_POST['priceID'] . "'");
	$priceInfo = mysql_fetch_array($price);
	
	$month = date('n');
	$day = date('j');
	$year = date('y');
	
	$sql="INSERT INTO orders (supplyID, supplyName, qty, requestorID, requestedFor, schoolID, month, day, year, cost, pdf) VALUES ('$supplyInfo[id]', '$supplyInfo[name]', '$priceInfo[productQuantity]', '$_SESSION[id]', '$_POST[userID]', '$_SESSION[schoolID]', '$month', '$day', '$year', '$priceInfo[productPrice]', '$supplyInfo[pdf]')";
  	
  	if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
  	$order = mysql_query("SELECT * FROM orders ORDER BY id DESC");
	$orderInfo = mysql_fetch_array($order);

	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Supply Order #' . ($orderInfo['id']));
	
	  //Set the From address with an associative array
	  $message->setFrom($userInfo['email']);
	  
	  if ($supplyInfo['type']=="card")	{
		  	  $message->setTo($selectedAdminCA['email']);
	  } elseif ($supplyInfo['type']=="supply")	{
	  		  $message->setTo($selectedAdminSA['email']);
	  }
	
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	if($supplyInfo['pdf']==1)	{
	  //Give it a body
	 $message ->setBody($userInfo['firstName'] . " " . $userInfo['lastName'] . " has requested " . $priceInfo['productQuantity'] . " " . $supplyInfo['name'] . ". <br><br>They should be shipped to:<br><br><b>" . $schoolMenu['schoolName'] . "</b><br>" . $schoolMenu['add1'] . " " .  $schoolMenu['add2'] . "<br>" . $schoolMenu['city'] . "," . $schoolMenu['state'] . " " . $schoolMenu['zip'] . "<br><br>You can download the PDF Proof by <a href='http://do.convertapi.com/web2pdf?curl=http://mm.careerpathtraining.com/print/" . $supplyInfo['id'] . "/default.php?userID=" . $userInfo['id'] . "&PageOrientation=portrait&outputmode=service&OutputFileName=" . $supplyInfo['name'] . " for " . $userInfo['firstName'] . "-" . $userInfo['lastName'] . "&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=0&PageWidth=88.9mm&PageHeight=50.8mm&ApiKey=225522257'>clicking here</a>" );
	 } else {
		 	 $message ->setBody($userInfo['firstName'] . " " . $userInfo['lastName'] . " has requested " . $priceInfo['productQuantity'] . " " . $supplyInfo['name'] . ". <br><br>They should be shipped to:<br><br><b>" . $schoolMenu['schoolName'] . "</b><br>" . $schoolMenu['add1'] . " " .  $schoolMenu['add2'] . "<br>" . $schoolMenu['city'] . "," . $schoolMenu['state'] . " " . $schoolMenu['zip']);
	 }
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
  	

	include("../inc/dbClose.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Order Process</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "../internalDefault.php";
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
<p>Your request has been processed and you should receive it shortly. <br><br><img src="loader.gif"></p>
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