<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Orders</title>

		<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to CANCEL this order?")
			if (msg) {window.location.href = site}
			else (null)
			}
		</script>
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
			
			<div class="rightContainer"><div class="menuTab">Orders</div>
				<div class="innerWrapperXL">
				<?PHP
				
				include("inc/dbOpen.php"); 

				mysql_select_db ($database,$con);				
				$order = mysql_query("SELECT * FROM orders WHERE schoolID='" . $_SESSION['schoolID'] . "' ORDER BY id DESC LIMIT 50");
				
				echo '<div class="headers"><span class="orderID">ID</span><span class="orderDate">Date</span><span class="orderRequestor">Requestor</span><span class="orderRequestedFor">Requested For</span><span class="orderProduct">Product</span><span class="orderFunctions">Functions</span></div>';
			
				while($orderInfo = mysql_fetch_array($order))
				{
				
					$requestor = mysql_query("SELECT * FROM users WHERE id='" . $orderInfo['requestorID'] . "'");
					$requestorInfo = mysql_fetch_array($requestor);
					
					$user = mysql_query("SELECT * FROM users WHERE id='" . $orderInfo['requestedFor'] . "'");
					$userInfo = mysql_fetch_array($user);
					
					$supply = mysql_query("SELECT * FROM schoolMenu WHERE id='" . $orderInfo['supplyID'] . "'");
					$supplyInfo = mysql_fetch_array($supply);
				
					echo ("<hr style='clear:both;' />");
				
				  if ($orderInfo['completed']=='0')
				  	echo "<div class='userEntryPending'>";
				  else
				  	echo "<div class='userEntryApproved'>";
				  	
				  	echo "<span class='orderID'>" . $orderInfo['id'] . "</span>";
				  
				   echo "<span class='orderDate'>" . $orderInfo['month'] . "/" . $orderInfo['day'] . "/" . $orderInfo['year'] . "</span>";
				  
					echo "<span class='orderRequestor'>" . $userInfo['firstName'] . " " . $userInfo['lastName'] . "</span>" ;
					
					echo "<span class='orderRequestedFor'>" . $requestorInfo['firstName'] . " " . $requestorInfo['lastName'] . "</span>" ;
					
					echo "<span class='orderProduct'>" . $orderInfo['qty'] . " " . $supplyInfo['name'] . "</span>";

				  	echo "<span class='orderFunctions'>" ;
				 
				  	echo "<a class='iconDelete' title='Cancel Order' href=\"javascript:goto('functions/cancel-order.php?orderID=" . $orderInfo['id'] . "')\"><img border='0' src='images/icons/spacer.png'></a>" ;

				  	if ($orderInfo['pdf']==1)	{
						echo "<a class='iconPreview' title='Preview Card' target='_blank' href='print/" . $orderInfo['supplyID'] . "/default.php?userID=" . $userInfo['id'] .  "'><img border='0' src='images/icons/spacer.png'></a>";
					}
				  	
				  	echo "</span></div>";
				  	}
				  	echo "<br />";
		?></div>
			</div>
		
			
			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>