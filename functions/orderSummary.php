<?php

	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);
	
	$adminCard = mysql_query("SELECT * FROM admin WHERE role='cardAdmin' ");
	$selectedAdminCard = mysql_fetch_array($adminCard);
	
	$approvalCard = mysql_query("SELECT * FROM admin WHERE role='cardApproval' ");
	$selectedApprovalCard = mysql_fetch_array($approvalCard);
	
	$schoolList = mysql_query("SELECT * FROM schools");
	
	$emailHeader = "The below are business card orders that have been requested. Please check and approve <br>";
	$emailContent = "";
	$costTotal =0;
	
	 foreach ( $_POST['order'] as $orderArray ) {
	   $card = mysql_query("SELECT * FROM orders WHERE id=" . $orderArray);
	   $cardInfo = mysql_fetch_array($card);

	   $orderDetails[$orderArray]=$cardInfo['schoolID'];
		 }
		 
		 	asort($orderDetails);
		     
		     $lastSchool=current($orderDetails);
		     
	         foreach ( $orderDetails as $order=>$school ) {
	         
	             $card = mysql_query("SELECT * FROM orders WHERE id=" . $order);
	             $cardInfo = mysql_fetch_array($card);
	             
	             $school = mysql_query("SELECT * FROM schools WHERE id=" . $cardInfo['schoolID']);
	             $schoolInfo = mysql_fetch_array($school);
	             
	             $supply = mysql_query("SELECT * FROM schoolMenu WHERE id=" . $cardInfo['supplyID']);
	             $supplyInfo = mysql_fetch_array($supply);
	             
	             $price = mysql_query("SELECT * FROM prices WHERE productID=" . $cardInfo['supplyID'] . " AND productQuantity=" . $cardInfo['qty']);
	             $priceInfo = mysql_fetch_array($price);
	             
	             $user = mysql_query("SELECT * FROM users WHERE id='" . $cardInfo['requestedFor'] . "'");
	             $userInfo = mysql_fetch_array($user); // SQL
	             
		             if ($lastSchool != $cardInfo['schoolID']) {
		             	$totalFlag = 1;
		             } else {
		             	$totalFlag=0;
		             }
		             	             
	           // Keeps track of each schools total cost
	             if (!isset($schoolCost[$cardInfo['schoolID']])) {
		             $schoolCost[$cardInfo['schoolID']] = $priceInfo['productPrice'];
		             $newFlag=1;
	             } else {
		             $schoolCost[$cardInfo['schoolID']] = $schoolCost[$cardInfo['schoolID']]+$priceInfo['productPrice'];
		             $newFlag=0;
	             }
	             //
	          
	            // Adds Seperator Header
	             if ($newFlag==1)	{
	             	$emailContent .= "<h2>" . $schoolInfo['schoolName'] . "</h2>";
	             	}   
	             //
	             
	            // Adds the individual order to the email output 
	             $emailContent .= "<b>Employee:</b> " . $userInfo['firstName'] . " " . $userInfo['lastName'] . "<br><b>Qty:</b> " . $cardInfo['qty'] . " " . $supplyInfo['name'] ."<br><b>Cost:</b> $" . $priceInfo['productPrice'] . "<br><br>";
	            //
	            

	             
	             $lastSchool=$cardInfo['schoolID'];
	         } // Loop End
	     
	         				$emailContent.="<h2>Cost by School</h2>";
	         				
	              // Gets Each Schools Total
			                foreach ($schoolCost as $key => $value)	{
					     	$schoolTotal = mysql_query("SELECT * FROM schools WHERE id=" . $key);
					        $schoolTotalInfo = mysql_fetch_array($schoolTotal);
					        $costTotal = $costTotal + $value;
					        
						    $emailContent .= "<b>" . $schoolTotalInfo['schoolName'] . " Cost:</b> $" . $value . "<br>";
						    }
	            
	            //
	     
	     // Displays total of all schools costs
	     $emailContent .= "<h2>Total Overall Cost: $" . $costTotal . "</h2>";
	     //
	
	require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('Supply Order Summary');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedAdminCard['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($selectedApprovalCard['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody($emailContent);
	 
	 $message->setContentType("text/html");

     $result = $mailer->send($message);

	$message="The selected ads ares being restored";
	$returnURL="../archivedViewAds.php";

	include("../inc/dbClose.php");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Process Order</title>
		
		<!--<script type="text/javascript">
			function redirectUser(){
			  window.location = "/orders.php";
			}
		</script>-->
		
	</head>
	<body onload="setTimeout('redirectUser()', 2000)">
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Summary</div>
					<p>The summary email below has been sent to<br><?PHP echo($selectedApprovalCard['name']); ?> at <?PHP echo($selectedApprovalCard['email']); ?></p>
					<div class="outputBox"><?PHP echo($emailContent); ?></div>
					<div class="button"><a href="../orders.php">Recent Orders</a></div>
					
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