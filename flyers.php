<?PHP include("inc/security.inc"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - User Entry</title>
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

				<div class="rightContainer rounded"><div class="menuTab">Flyers</div>
			<?PHP

				 if (($_SESSION['employer']=="Roadmaster") or ($_SESSION['employer']=="CPT")) {
				 
				 if(mysql_num_rows($usermenuRM)!=0){
				 echo "<div id='flyerGrid'>";
				 
					while($usermenuInfo = mysql_fetch_array($usermenuRM)) {
					
					echo "<div class='flyerTile'><h3>" . $usermenuInfo['name'] . "</h3><a class='group1' target='_blank' href='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg'><img border='1' width='175' height='225' src='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg' border='0'></a><br>";
					
					echo "<div class='button'><a class='group1' target='_blank' href='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg'><span>Preview</span></a></div>";
					
					echo "<div class='button'><a title='" . $usermenuInfo['title'] . "' onClick=\"alert('Your PDF is generating now. This may take a minute. Click OK to continue')\"  href='http://do.convertapi.com/web2pdf?curl=http://mm.careerpathtraining.com/downloadable/" . $usermenuInfo['id'] . "/default.php?userID=" . $_SESSION['id'] . "&PageOrientation=" . $usermenuInfo['orientation'] . "&outputmode=service&OutputFileName=" . $usermenuInfo['name'] . "&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=0&PageWidth=" . $usermenuInfo['width'] . "mm&PageHeight=" . $usermenuInfo['height'] . "mm&ApiKey=225522257&AlternativeParser=true'>Generate PDF</a></div></div>";
					
					}}
					
				} elseif (($_SESSION['employer']=="CFI") or ($_SESSION['employer']=="CPT")) {
				
					 if(mysql_num_rows($usermenuCFI)!=0){
									 echo "<div id='flyerGrid'>";
									 
										while($usermenuInfo = mysql_fetch_array($usermenuCFI)) {
										
										echo "<div class='flyerTile'><h3>" . $usermenuInfo['name'] . "</h3><a class='group1' target='_blank' href='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg'><img border='1' width='175' height='225' src='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg' border='0'></a><br>";
										
										echo "<div class='button'><a class='group1' target='_blank' href='" . $usermenuInfo['link'] . "/" . $usermenuInfo['id'] . "/preview.jpg'><span>Preview</span></a></div>";
										
										echo "<div class='button'><a title='" . $usermenuInfo['title'] . "' onClick=\"alert('Your PDF is generating now. This may take a minute. Click OK to continue')\"  href='http://do.convertapi.com/web2pdf?curl=http://mm.careerpathtraining.com/downloadable/" . $usermenuInfo['id'] . "/default.php?userID=" . $_SESSION['id'] . "&PageOrientation=" . $usermenuInfo['orientation'] . "&outputmode=service&OutputFileName=" . $usermenuInfo['name'] . "&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=0&PageWidth=" . $usermenuInfo['width'] . "mm&PageHeight=" . $usermenuInfo['height'] . "mm&ApiKey=225522257'>Generate PDF</a></div></div>";
					
					}}
}

			?>
			
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