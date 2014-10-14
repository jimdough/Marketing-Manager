<?PHP
	include("inc/security.inc"); 
	include("inc/dbOpen.php");
	
	$supplyID = $_GET['supplyID'];

	mysql_select_db ($database, $con);
	
	$supply = mysql_query("SELECT * FROM schoolmenu WHERE ID='" . $supplyID . "' ");
	$supplyInfo = mysql_fetch_array($supply);
	
	$price = mysql_query("SELECT * FROM prices WHERE productID='" . $supplyInfo['id'] . "' ");
		
	$user = mysql_query("SELECT * FROM users WHERE schoolID='" . $_SESSION['schoolID'] . "' AND approvalStatus='1' ORDER BY lastName");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Card Order</title>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

				<div class="leftContainer rounded"><div class="menuTab">Main Menu</div>
						<?PHP include("leftNav.php"); ?>	
				</div>
			
				
				<div class="rightContainer rounded"><div class="menuTab">Card Order</div>
					
					<div id="stylized" class="form">
					<div class="full" style="width:400px;">
					<form action="print/<?PHP echo $supplyInfo['id']; ?>/default.php?mode=preview" method="post" id="card">
					<input type="hidden" name="supplyID" value="<?PHP echo $supplyInfo['id']; ?>">
					<input type="hidden" name="requestorID" value="<?PHP echo $_SESSION['id']; ?>">
					
					<p><label>Employee Name:</label>
					
					<?PHP
							echo "<select name='userID'>";
							echo "<option value='' selected>Please Choose the Employee</option>";
								while($userInfo = mysql_fetch_array($user))
									  {
									  echo "<option value='" . $userInfo['id'] . "'>" . $userInfo['firstName'] . " " . $userInfo['lastName'] . "</option>";
									  }
							echo "</select></p>";
					?>
					
					
					<p><label>Qty of <?PHP echo $supplyInfo['name']; ?></label>
						<?PHP
							echo "<select name='priceID'>";
							echo "<option value='' selected>Please Choose the Quantity</option>";
							while($priceInfo = mysql_fetch_array($price))
								{
									echo "<option value='" . $priceInfo['id'] . "'>" . $priceInfo['productQuantity'] . " - $" . $priceInfo['productPrice'] . "</option>";
								}	
							echo "</select></p>";
					?>

					<button class="button2" type="submit" name="submit" id="submit" value="Submit this Form">Preview Card</button>
					
					</form></div>
					</div>
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