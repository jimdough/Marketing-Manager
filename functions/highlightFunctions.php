<?php

	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);

	if ($_GET['function']=="add")	{
	
			$highlight = mysql_real_escape_string($_POST['highlight']);	
			$sql="INSERT INTO highlights_em (highlight) VALUES ('$highlight')";
			$message="Highlight has been added";
			$returnURL="../editHighlights.php";
			if (!mysql_query($sql,$con))
				  {
				  die('Error: ' . mysql_error());
	} } elseif ($_GET['function']=="multiple")  {
	
	if ($_GET['action']=="delete") {
				mysql_query("DELETE FROM highlights_em WHERE id=" . $_GET['id']);
				$message="The highlight is being deleted";
				$returnURL="../editHighlights.php";
	} 	elseif ($_GET['action']=="update") {
				$returnURL="../editHighlights.php";
				$message="The highlight is being updated";
				$highlight = mysql_real_escape_string($_POST['highlight']);	
				$id=$_GET['id'];
				mysql_query("UPDATE highlights_em SET highlight='$highlight' WHERE id='$id'");
	}}

	include("../inc/dbClose.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Publications</title>
		
		<script type="text/javascript">
			function redirectUser(){
			  window.location = "<?PHP echo $returnURL; ?>";
			}
		</script>
		
	</head>
	<body onload="setTimeout('redirectUser()', 3000)">
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					<?PHP echo $message; ?><br><br>
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