<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - Edit User</title>
		<?PHP include("inc/validation.inc"); ?>
		
					<script>
						function goto(site) {
						var msg = confirm("Are you Sure you want to DELETE this event?")
						if (msg) {window.location.href = site}
						else (null)
						}
					</script>
		
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
			<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
				<div class="rightContainer"><div class="menuTab">Edit Text</div>
					<?php 
	
								include("inc/dbOpen.php"); 
							
								mysql_select_db ($database,$con);
								
								$highlightID = $_POST['highlightID'];
								
								$record = mysql_query("SELECT * FROM highlight_em WHERE id=' " . $highlightID . " ' ");
								$recordInfo = mysql_fetch_array($record);
					 ?> 
	   
	<div id="stylized" class="form">
	<div class="full">		 
	<form action="functions/highlightFunctions.php?function=update" method="post" enctype="multipart/form-data">
	    <p><label>Highlight</label>
	    <textarea cols="80" rows="10" name="highlightName" id="highlightName"><?PHP echo $recordInfo['highlight'];  ?></textarea>
	    <button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Update User</button>
	</form></div></div></div>

			
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