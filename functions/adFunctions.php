<?php

	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php"); 
	
	mysql_select_db ($database,$con);

	
	if ($_GET['function']=="add")	{
		
			$sql="INSERT INTO publications (pubName) VALUES ('$_POST[pubName]')";
			$message="Publication has been added";
			$returnURL="../editPublications.php";
			if (!mysql_query($sql,$con))
				  {
				  die('Error: ' . mysql_error());
				  }
				  
	} elseif ($_GET['function']=="delete") {
			
			$ads = mysql_query("SELECT * FROM adManager WHERE active=1 AND publication=" . $_POST['publicationID']);  
			$adsInfo = mysql_fetch_array($ads);
			$returnURL="../editPublications.php";
			
			if (empty($adsInfo['id'])) {
			    mysql_query("DELETE FROM publications WHERE id=" . $_POST['publicationID']);
				$message="The publication is being deleted";
			} else {
				$message="<div style='color:red; font-size:18px;'>There are active ads still associated with this publication so it cannot be deleted at this time</div>";
			}
	} elseif ($_GET['function']=="archiveAd") {
			$archiveDate=date('Y-m-d');
			mysql_query("UPDATE admanager SET active='0'  WHERE id=" . $_GET['id']);
			mysql_query("UPDATE admanager SET archiveDate='" . $archiveDate . "'  WHERE id=" . $_GET['id']);
			$message="The ad is being archived";
			$returnURL="../viewAds.php";
	} elseif ($_GET['function']=="unarchiveAd") {
			mysql_query("UPDATE admanager SET active='1' WHERE id=" . $_GET['id']);
			$message="The ad is being restored";
			$returnURL="../archivedViewAds.php";
	} elseif ($_GET['function']=="archiveSelected") {
			$archiveDate=date('Y-m-d');
			$message="The selected ads ares being archived";
			$returnURL="../viewAds.php";
					if ( isset( $_POST['ad'] ) ) {
					    foreach ( $_POST['ad'] as $ad ) {
					        mysql_query("UPDATE admanager SET active='0' WHERE id=" . $ad);
					        mysql_query("UPDATE admanager SET archiveDate='" . $archiveDate . "' WHERE id=" . $ad);
					    }
					}
	} elseif ($_GET['function']=="unarchiveSelected") {
			$message="The selected ads ares being restored";
			$returnURL="../archivedViewAds.php";
					if ( isset( $_POST['ad'] ) ) {
					    foreach ( $_POST['ad'] as $ad ) {
					        mysql_query("UPDATE admanager SET active='1' WHERE id=" . $ad);
					    }
					}
	}

	
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