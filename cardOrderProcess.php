<?PHP
	include("inc/security.inc"); 
	include("inc/dbOpen.php");
	
	$supplyID = $_GET['supplyID'];

	mysql_select_db ($database, $con);
	
	$supply = mysql_query("SELECT * FROM schoolmenu WHERE ID=' " . $supplyID . " ' ");
	$supplyInfo = mysql_fetch_array($supply);
?>

<html>
<head>
<title>Marketing Manager - Card Order Process</title>
<?PHP include("inc/head.inc"); ?>
</head>
<body >
<div id="logo"><a href="internalDefault.php"><img border="0" src="assets/marketingManager2Med.png"></a></div>
<div id="supplyEntry">

<form action="functions/supplyOrderProcess.php" method="post" id="supply">
<input type="hidden" name="supplyID" value="<?PHP echo $supplyInfo['id']; ?>">
<input type="hidden" name="userID" value="<?PHP echo $_SESSION['id']; ?>">

<div class="labelLarge clear">Requested Qty of <?PHP echo $supplyInfo['name']; ?></div>
<div class="inputSmall"><input type="text"  name="supplyQuantity" size="5" class="required" /></div>

<div class="submitButton clear"><input class="button" type="submit" name="submit" id="submit" value="Submit this Form" /></div>

</form>

<?PHP include("inc/dbClose.php"); ?>

</body>
</html>
