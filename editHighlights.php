<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Add, Edit and Delete Highlights</title>
		
				<script>
			function goto(site) {
			var msg = confirm("Are you Sure you want to DELETE this user?")
			if (msg) {window.location.href = site}
			else (null)
			}
		</script>
		
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
	$highlight = mysql_query("SELECT * FROM highlights_em ORDER BY id ASC");  
	?>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

				<div class="leftContainer rounded"><div class="menuTab">Menu</div>
						<?PHP include("leftNav.php"); ?>
				</div>
			
				<div class="rightContainer rounded"><div class="menuTab">Highlights</div>
				
				<div class="centerContainerLG rounded" style="text-align:center;"><div class="menuTab">Add</div>
				<form action="functions/highlightFunctions.php?function=add" method="post" enctype="multipart/form-data">
						<p><label for="highlight"><h1>Highlight</h1></label><br>
						<textarea cols="70" rows="10" name="highlight" id="highlight"></textarea></p>
						<button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Add Highlight</button>
				</form>
				</div>
				
				<div class="centerContainerLG rounded" style="text-align:center;"><div class="menuTab">Edit/Delete</div>
					
					<?PHP
						while($highlightInfo = mysql_fetch_array($highlight))
									  {
									  echo "<div style='clear:both; padding-bottom:50px;'><form action='functions/highlightFunctions.php?function=multiple&action=update&id=" . $highlightInfo['id']  . "' method='post' enctype='multipart/form-data'>";
									  echo "<textarea cols='70' rows='10' name='highlight' id='highlight'>" . $highlightInfo['highlight'] . "</textarea>";
									  echo "<div style='text-align:center; width:300px; margin:auto;'><div style='float:left;'><button class='button' type='submit' name='submit' id='submit' value='Submit this Form'>Update Highlight</button></div>";
									  echo "<div class='button' style='float:left;'><a href=\"javascript:goto('functions/highlightFunctions.php?function=multiple&action=delete&id=" . $highlightInfo['id'] . "')\" >Delete Highlight</a></div></div>";
									  echo "</form></div>";
									  }
				?>

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