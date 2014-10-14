<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Main Page</title>
	</head>
	<body>
	
	<?PHP
	include("inc/dbOpen.php"); 
	mysql_select_db ($database,$con);
	
	$schoolmenuRM = mysql_query("SELECT * FROM schoolmenu WHERE OWNER='rm' or OWNER='all' ORDER BY id");
	$schoolmenuCFI = mysql_query("SELECT * FROM schoolmenu WHERE OWNER='cfi' or OWNER='all' ORDER BY id");
	$usermenuRM = mysql_query("SELECT * FROM usermenu WHERE OWNER='rm' or OWNER='all' ORDER BY id");
	$usermenuCFI = mysql_query("SELECT * FROM usermenu WHERE OWNER='cfi' or OWNER='all' ORDER BY id");
	$usermenu = mysql_query("SELECT * FROM usermenu ORDER BY id");
	?>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

				<div class="leftContainer rounded"><div class="menuTab">Menu</div>
						<?PHP include("leftNav.php"); ?>
				</div>
			
				<div class="rightContainer rounded"><div class="menuTab">Print Ads</div>
			<?PHP
			
						if ($_SESSION['employer']=="Roadmaster") {
							$nationalSchool=15;
						} else if ($_SESSION['employer']=="CFI") {
							$nationalSchool=16;
						} else {
							$nationalSchool=0;
						}
						$ads = mysql_query("SELECT * FROM admanager WHERE active=1 AND school=" . $_SESSION['schoolID'] . " or school=" . $nationalSchool . " ORDER BY startDate DESC");

						
						while($adInfo = mysql_fetch_array($ads))	{
							$publications = mysql_query("SELECT * FROM publications WHERE ID=" . $adInfo['publication']);
							$publicationInfo = mysql_fetch_array($publications);
							$newDate = date('m-d-Y', strtotime($adInfo['startDate']));
						    $adtype = mysql_query("SELECT * FROM adtype WHERE id=" . $adInfo['type']);  
							$adtypeInfo = mysql_fetch_array($adtype);
				  
							echo "<div class='adView'>";
							echo "<h2>Publication Name: " . $publicationInfo['pubName'] . "</h2>";
							echo("<h3>Ad Type: " . $adtypeInfo['type'] . "</h3>");
							echo  "<h4>Start Date: " . $newDate . "</h4>";
							if ($adInfo['type']!=2)	{
								echo "<a class='group3' target='_blank' href='upload/" . $adInfo['fileName'] . "'><img width='300' src='upload/" . $adInfo['fileName'] . "'></a><br>";
								echo "<a class='group3' target='_blank' href='upload/" . $adInfo['fileName'] . "'><img border='0' src='images/icons/preview2.png'><span>See Full Size Ad</span></a><br/>";
								echo "<h4>Comments: " . $adInfo['comments'] . "</h4>";
							} else {
								echo "<h4>Ad Text: " . $adInfo['comments'] . "</h4>";	
							}
						
							echo "</div>";
						}
			?>
			</div>
		</div>

	</div><!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="images/cpt.png"></a>
					</div>
			</div>
			
	</div> <!-- END SHELL -->

	</body>
</html>