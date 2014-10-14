<?PHP
	include("inc/security.inc"); 
	include("inc/dbOpen.php");
	
	$supplyID = $_GET['supplyID'];

	mysql_select_db ($database , $con);
	
	$supply = mysql_query("SELECT * FROM schoolmenu WHERE ID=' " . $supplyID . " ' ");
	$supplyInfo = mysql_fetch_array($supply);
	
	$price = mysql_query("SELECT * FROM prices WHERE productID='" . $supplyID . "' ");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Supply Order</title>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

	<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>
			</div>
			
			
			<div class="rightContainer rounded"><div class="menuTab">Processing</div>
			<div class="full" style="width:400px;">
			<form action="functions/supplyOrderProcess.php" method="post" id="stylized">
					<input type="hidden" name="supplyID" value="<?PHP echo $supplyInfo['id']; ?>">
					<input type="hidden" name="userID" value="<?PHP echo $_SESSION['id']; ?>">
					
					<p><label>Qty of <?PHP echo $supplyInfo['name']; ?></label>
						<?PHP
							echo "<select name='priceID'>";
							echo "<option value='' selected>Please Choose the Quantity</option>";
							while($priceInfo = mysql_fetch_array($price))
								{
									echo "<option value='" . $priceInfo['id'] . "'>" . $priceInfo['productQuantity'] . " - $" . $priceInfo['productPrice'] . "</option>";
								}	?>
						</select></p>
					
 <p><button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Place Order</button></p>

</form></div>

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