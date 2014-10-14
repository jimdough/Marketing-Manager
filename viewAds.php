<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - User Entry</title>
		<script language="javascript" src="calendar/calendar.js"></script>
		<?PHP include("inc/validation.inc"); ?>

	<?php 
		include("inc/dbOpen.php"); 
		mysql_select_db ($database,$con);
		$schoolLoop = mysql_query("SELECT * FROM schools");
	?> 

	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
			<?PHP include("inc/topNav.php"); ?>
	
			<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>

				<div class="rightContainer rounded"><div class="menuTab">View Ads</div>
	   
	<div id="stylized" class="form">		 
	<div class="innerWrapper">
	
	<form action="functions/adFunctions.php?function=archiveSelected" method="post" enctype="multipart/form-data">

<?PHP

		while($loopInfo = mysql_fetch_array($schoolLoop))
				  {
						$ads = mysql_query("SELECT * FROM admanager WHERE active=1 AND school=" . $loopInfo['id']);
						$header = mysql_query("SELECT * FROM admanager WHERE active=1 AND school=" . $loopInfo['id']);
						$headerCheck = mysql_fetch_array($header);
					
						if (!empty($headerCheck['id']))	{
							echo "<h4>" . $loopInfo['schoolName'] . "</h4>";
					}

			while($adsInfo = mysql_fetch_array($ads))
				  {
				  $school = mysql_query("SELECT * FROM schools WHERE id=" . $adsInfo['school']);  
				  $schoolInfo = mysql_fetch_array($school);
				  $adtype = mysql_query("SELECT * FROM adtype WHERE id=" . $adsInfo['type']);  
				  $adtypeInfo = mysql_fetch_array($adtype);
		    	  $publications = mysql_query("SELECT * FROM publications WHERE id=" . $adsInfo['publication']);
		    	  $publicationInfo = mysql_fetch_array($publications);
		    	  $newDate = date('m-d-Y', strtotime($adsInfo['startDate']));
				  
				  echo "<div class='selectRow'>";
				  echo "<input class='deleteCheck' type='checkbox' name='ad[]' value='" . $adsInfo['id'] . "'/>";
				  echo "</div>";
				  echo "<div class='viewRow'>";
				  if ($adsInfo['type']!=2)	{
				  echo "<a class='group3' href='upload/" . $adsInfo['fileName'] . "'><img width='100' height='100' src='upload/" . $adsInfo['fileName'] . "' border='0'></a>";
				  }
				  echo "<b>School Name:</b> " . $schoolInfo['schoolName'] . "<br />";
				  echo "<b>Ad Type:</b> " . $adtypeInfo['type'] . "<br />";
				  echo "<b>Publication Name:</b> " . $publicationInfo['pubName'] . "<br />";
				  echo "<b>Start Date:</b> " . $newDate . "<br />";
				  echo "<b>Comments:</b> " . $adsInfo['comments'] . "<br />";
				  echo "<div class='button'><a href='functions/adfunctions.php?function=archiveAd&id=" . $adsInfo['id'] . "'>Archive this Ad</a></div>";
				  echo "</div>";
				  echo "<div class='clear'></div>";
				  }
}
?>

<div style="text-align:center;"><button class="button" type="submit" name="submit" id="submit" value="Archive Selected">Archive Selected Ads</button></div>
</form>

	     		</div>
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