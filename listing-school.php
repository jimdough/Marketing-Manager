<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Listing by School</title>
		
		<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to DELETE this user?")
			if (msg) {window.location.href = site}
			else (null)
			}
		</script>
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
			
			<div class="rightContainer rounded"><div class="menuTab">Users</div>
				
				<div class="innerWrapper">
				<?PHP

				include("inc/dbOpen.php"); 

				mysql_select_db ($database,$con);
				$record = mysql_query("SELECT * FROM users WHERE schoolID='" . $_SESSION['schoolID'] . "' AND role='User' ORDER BY lastName");
				
				echo "<div class='full'>";

				echo ("<div class='headers'><span class='name'>Name</span><span class='title'>Title</span><span class='function'>Functions</span></div>");


				echo ("<hr style='clear:both;' />");
			
				while($recordInfo = mysql_fetch_array($record))
							{
							  if ($recordInfo['approvalStatus']=='0')
							  	echo "<div class='userEntryPending'>";
							  else
							  	echo "<div class='userEntryApproved'>";
							  
								echo "<span class='name'><a title='Edit User' href='edit-user.php?userID=" . $recordInfo['id'] . "'>" . $recordInfo['firstName'] . " " . $recordInfo['lastName'] . "</a></span>" ;
								
								echo "<span class='title'>" . $recordInfo['title'] . "</span>" ;
			
							  	echo "<span class='function'><a title='Edit this User' class='iconEdit' href='edit-user.php?userID=" . $recordInfo['id'] . "'><img border='0' src='images/icons/spacer.png'></a></span>" ;
							 
							  	echo "<span class='function'><a title='Delete this User' class='iconDelete' href=\"javascript:goto('functions/delete-user.php?userID=" . $recordInfo['id'] . "')\"><img border='0' src='images/icons/spacer.png'></a></span>" ;
							  	
							  	echo "</div><hr/>";
							  	}
							  	echo "<br></div>";
					?></div>
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