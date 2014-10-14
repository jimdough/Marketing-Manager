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

				<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
						<?PHP include("leftNav.php"); ?>
				</div>
			
				<div class="rightContainer rounded"><div class="menuTab">Tutorials</div>
					<div class="full">
						<ul>
						<?PHP if (($_SESSION['role']=="School") OR ($_SESSION['role']=="Admin")) { ?>
							<li><a href="http://www.youtube.com/embed/AwHNoBJOWO4?rel=0" class="youtube">How to create a new user</li>
							<li><a href="http://www.youtube.com/embed/yYECm3f-V-c?rel=0" class="youtube">How to manage staff</li>
							<li><a href="http://www.youtube.com/embed/z0fyEVN_1is?rel=0" class="youtube">How to order business cards</li>
							<li><a href="http://www.youtube.com/embed/WHx0OTT7JME?rel=0" class="youtube">How to order supplies</li>
							<li><a href="http://www.youtube.com/embed/7MkXae4uSuQ?rel=0" class="youtube">How to enter a new event</li>
							<li><a href="http://www.youtube.com/embed/wNoAk7W5-fY?rel=0" class="youtube">How to manage events</li>
							<?PHP } ?>
							<li><a href="http://www.youtube.com/embed/aHyJEcGDql4?rel=0" class="youtube">How to download a file</li>
							<li><a href="http://www.youtube.com/embed/nAR66q9SKqc?rel=0" class="youtube">How to generate flyers</li>
						</ul>
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