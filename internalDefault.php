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
			
				<div class="rightContainer rounded"><div class="menuTab">News</div>
					<h2>Marketing Manager 1.2 Release Notes</h2>
<ul>
<li>All new Ad Manager. View the print ads currently running for your school.</li>
<li>Pre-filled Event Highlights</li>
<li>Email Reminder Notifications for marketing email to go out</li>
<li>Email Reminder Notifications to schools about upcoming events with RSVP list</li>
<li>Email Reminder Notifications to people who RSVPd to the event</li>
<li>Business Card Orders and Supply Orders will now go to separate points of contact</li>
<li>Added login credentials and instructions to email sent to approved new users</li>
<li>Event Manager new entry requests now show event information on the notification email sent to Event Manager point of contact</li>
<li>Changed hyperlink on name on page "View users by school" to be an edit user functionality</li>
<li>Removed IT Lead Pull notification</li>
<li>Removed Flyer listing from left navigation and changed it to a full page that shows all of the flyers available.</li>
<li>Automated Order Summary for Approval</li>
<li>Fixed Internet Explorer formatting issues</li>
<li>Moved Logout function to top navigation</li>
<li>Removed some excess font styles for enhanced UI</li>
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