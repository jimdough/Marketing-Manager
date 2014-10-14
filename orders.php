<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Orders</title>

		<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to DELETE this order?")
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
				$order = mysql_query("SELECT * FROM orders ORDER BY id DESC LIMIT 50");
				
				echo '<div class="headers"><span class="selectBox">&nbsp;</span><span class="orderDate">Date</span><span class="orderRequestor">Requestor</span><span class="orderRequestedFor">Requested For</span><span class="orderProduct">Product</span><span class="orderFunctions">Functions</span></div>';
			
				echo '<form action="functions/orderSummary.php" method="post" enctype="multipart/form-data">';
				
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
				  	
				   echo "<span class='selectBox'>";
				   echo "<input class='deleteCheck' type='checkbox' name='order[]' value='" . $orderInfo['id'] . "'/>";
				   echo "</span>";
				  
				   echo "<span class='orderDate'>" . $orderInfo['month'] . "/" . $orderInfo['day'] . "/" . $orderInfo['year'] . "</span>";
				  
					echo "<span class='orderRequestor'>" . $requestorInfo['firstName'] . " " . $requestorInfo['lastName'] . "</span>" ;
					
					echo "<span class='orderRequestedFor'>" . $userInfo['firstName'] . " " . $userInfo['lastName'] . "</span>" ;
					
					echo "<span class='orderProduct'>" . $orderInfo['qty'] . " " . $supplyInfo['name'] . "</span>";

				  	echo "<span class='orderFunctions'><a  class='iconDone' title='Complete Order' href='functions/process-order.php?orderID=" . $orderInfo['id'] . "&requestorEmail=" . $userInfo['email'] . "'><img border='0' src='images/icons/spacer.png'></a> " ;
				 
				  	echo "<a class='iconDelete' title='Delete Order' href=\"javascript:goto('functions/delete-order.php?orderID=" . $orderInfo['id'] . "')\"><img border='0' src='images/icons/spacer.png'></a>" ;

				  	if ($orderInfo['pdf']==1)	{
						echo "<a class='iconPreview' title='Preview Card' target='_blank' href='print/" . $orderInfo['supplyID'] . "/default.php?userID=" . $userInfo['id'] .  "'><img border='0' src='images/icons/spacer.png'></a>";
					
						echo "<a class='iconDownload' title='Download PDF' href='http://do.convertapi.com/web2pdf?curl=http://mm.careerpathtraining.com/print/" . $orderInfo['supplyID'] . "/default.php?userID=" . $userInfo['id'] . "&PageOrientation=" .  $supplyInfo['orientation'] . "&outputmode=service&OutputFileName=Business-Card-for-" . $userInfo['firstName'] . "-" . $userInfo['lastName'] . "&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=0&PageWidth=" . $supplyInfo['width'] . "&PageHeight=" . $supplyInfo['height']. "&ApiKey=225522257&AlternativeParser=true'><img border='0' src='images/icons/spacer.png'></a>";
						
					}
				  	
				  	echo "</span></div>";
				  	}
				  	echo '<div style="text-align:center;"><button class="button" type="submit" name="submit" id="submit" value="Send Summary">Send Approval Summary</button></div>';
				  	echo "<br /></form>";
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