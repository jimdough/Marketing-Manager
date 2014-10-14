<?php
	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 

	$orderID = $_GET['orderID'];

	mysql_select_db ($database,$con);
	  	
  	mysql_query("DELETE FROM orders WHERE id='" . $orderID . "'");
	
	include("../inc/dbClose.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Order Deletion</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "../orders.php";
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
					<p>Deleting Order</p>
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