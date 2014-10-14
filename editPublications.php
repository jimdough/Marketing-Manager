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
	$publication = mysql_query("SELECT * FROM publications ORDER BY pubName ASC");  
	?>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

				<div class="leftContainer rounded"><div class="menuTab">Menu</div>
						<?PHP include("leftNav.php"); ?>
				</div>
			
				<div class="rightContainer rounded"><div class="menuTab">Publications</div>
				
				<div class="centerContainer rounded"><div class="menuTab">Add</div>
				<form action="functions/adFunctions.php?function=add" method="post" enctype="multipart/form-data">
						<p><label for="pubName">Publication Name</label><br>
						<input size="50" type="text" name="pubName" id="pubName"></input></p>
						<button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Add Publication</button>
				</form>
				</div>
				
				<div class="centerContainer rounded"><div class="menuTab">Delete</div>
					<form action="functions/adFunctions.php?function=delete" method="post" enctype="multipart/form-data">
					<?PHP
						echo "<p><label for ='publicationID'>Choose Publication</label>";
						echo "<select style='width:300px;' name='publicationID' class='required'>";
						echo "<option value=''>Please Choose the Publication</option>";
								while($publicationinfo = mysql_fetch_array($publication))
									  {
									  echo "<option value='" . $publicationinfo['id'] . "'>" . $publicationinfo['pubName'] . "</option>";
									  }
						echo "</select></p>";
				?>
					<button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Delete Publication</button>
					</form>
				</div></div>

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