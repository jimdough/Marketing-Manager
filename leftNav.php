	<?PHP
			include("inc/dbOpen.php"); 
			mysql_select_db ($database,$con);
			
			$schoolmenuRM = mysql_query("SELECT * FROM schoolmenu WHERE OWNER='rm' or OWNER='all' ORDER BY id");
			$schoolmenuCFI = mysql_query("SELECT * FROM schoolmenu WHERE OWNER='cfi' or OWNER='all' ORDER BY id");
			$usermenuRM = mysql_query("SELECT * FROM usermenu WHERE OWNER='rm' or OWNER='all' ORDER BY id");
			$usermenuCFI = mysql_query("SELECT * FROM usermenu WHERE OWNER='cfi' or OWNER='all' ORDER BY id");
			$downloadMenuRM = mysql_query("SELECT * FROM downloads WHERE OWNER='rm' or OWNER='all' ORDER BY id");
			$downloadMenuCFI = mysql_query("SELECT * FROM downloads WHERE OWNER='cfi' or OWNER='all' ORDER BY id");
			$usermenu = mysql_query("SELECT * FROM usermenu ORDER BY id");
	?>
		
		
		<?PHP if ($_SESSION['role']!="School") { ?>
		<h3>Profile</h3>
		<ul class="navList"><li><a href="edit-user.php?mode=self&userID=<?PHP echo $_SESSION['id']; ?>">Edit your profile</a></li></ul>
		<?PHP } ?>
		<!-- ADMIN MENU -->	
			<?PHP if ($_SESSION['role']=="Admin") { ?>
				<h3>Admin Menu</h3>
				<ul class="navList">
					<li><a href='listing-user.php?sort=approvalStatus&order=ASC'>View All Users (sortable)</a></li>
					<li><a href='listing-userBySchool.php'>View All Users (by school)</a></li>
					<li><a href='orders.php'>View Recent Orders</a></li>
				</ul>
			<h3>Ad Manager</h3>
				<ul class="navList">
					<li><a href='uploadAd.php'>Upload Ads</a></li><br>
					<li><a href='editPublications.php'>Edit Publications</a></li><br>
					<li><a href='viewAds.php'>Active Ads</a></li><br>
					<li><a href='archivedViewAds.php'>Archived Ads</a></li>
				</ul>
			<?PHP } ?>
			<!-- END ADMIN MENU -->	
			
			<!-- SCHOOL MENU -->
			<?PHP if ($_SESSION['role']=="School" or $_SESSION['role']=="Admin") { ?>
				<h3>School Menu</h3>
				<ul class="navList">
					<li><a href="entry-user.php">Create New User Profile</a></li>
					<li><a href="listing-school.php">View Staff</a></li><br>
					<li><a href="orders-school.php">View Recent Orders</a></li>
					<!--<li><a href='adViewSchool.php'>View Current Ads</a></li>-->
					<li><a href="http://www.jotformpro.com/careerpathtraining/urgent" target="_blank">Post URGENT Notice</a><br>
					<a></a><span style="color:red; font-size:11px;">Password is rm11300</span></li>
					</ul>
					
					<?PHP if ($_SESSION['employer']!="CFI") { ?>
					<h3>Event Manager</h3>
					<ul class="navList">
					<li><a href="eventManager/entry.php">Create Event</a></li>
					<li><a href="eventManager/listing.php">View Event Listings</a></li>
				<?PHP if ($_SESSION['role']=="Admin") { ?>
					<li><a href='editHighlights.php'>Add / Edit Highlights</a></li>
				<?PHP } } ?>
				</ul>
					
			<?PHP 
				
				
				 if ($_SESSION['employer']=="Roadmaster") {
					echo '<h3>Order Supplies</h3><ul class="navList">';
					while($schoolmenuInfo = mysql_fetch_array($schoolmenuRM)) {
					echo "<li><a href='" . $schoolmenuInfo['link'] . "?supplyID=" . $schoolmenuInfo['id'] . "'>" . $schoolmenuInfo['name'] . "</a></li><br/>";
					}
					echo "</ul>";
					} elseif ($_SESSION['employer']=="CFI") {
					echo '<h3>Order Supplies</h3><ul class="navList">';
					while($schoolmenuInfo = mysql_fetch_array($schoolmenuCFI)) {
					echo "<li><a href='" . $schoolmenuInfo['link'] . "?supplyID=" . $schoolmenuInfo['id'] . "'>" . $schoolmenuInfo['name'] . "</a></li><br/>";
					}
					echo "</ul>";
					}}
			?>
			<!-- SCHOOL MENU -->
			
				
		<!-- Start Download Menu -->
				<h3>Downloads</h3>
					<ul class="navList">
					
					<?PHP 
					 if (($_SESSION['employer']=="Roadmaster") OR ($_SESSION['employer']=="CPT")) {
					 			while($downloadMenuInfo = mysql_fetch_array($downloadMenuRM)) {
						 			echo ('<li><a target="_blank" href="/downloads/rm/' . $downloadMenuInfo["link"] . '">' . $downloadMenuInfo["title"] . '</a></li><br/>');
						 }

						 echo "<li><a href='flyers.php'>Flyers</a></li>";
					
					} elseif (($_SESSION['employer']=="CFI")  OR ($_SESSION['employer']=="CPT"))	{
					
					while($downloadMenuInfo = mysql_fetch_array($downloadMenuCFI)) {
						 			echo ('<li><a target="_blank" href="/downloads/cfi/' . $downloadMenuInfo["link"] . '">' . $downloadMenuInfo["title"] . '</a></li><br/>');
						 }

						}
					?>
					</ul>

		
		<!-- Catalog Addendum List -->
		<div style='display:none'>
			<div id='addendum' style='padding:10px; background:#fff;'>
			<h3>Catalog Addendums</h3>
				<ul>
					<li><a href="downloads/rm/rm-addendum-chatt.pdf" target="_blank">Chattanooga,TN Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-columbus.pdf" target="_blank">Columbus,OH Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-nc.pdf" target="_blank">Dunn.NC Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-ca.pdf" target="_blank">Fontana,CA Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-in.pdf" target="_blank">Indianapolis,IN Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-jacksonville.pdf" target="_blank">Jacksonville,FL Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-orlando.pdf" target="_blank">Orlando,FL Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-sa.pdf" target="_blank">San Antonio,TX Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-slc.pdf" target="_blank">Salt Lake City, UT Catalog Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-tampa.pdf" target="_blank">Tampa,FL Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-ok.pdf" target="_blank">Tulsa,OK Addendum</a></li>
					<li><a href="downloads/rm/rm-addendum-ak.pdf" target="_blank">West Memphis,AR Catalog Addendum</a></li>
				</ul>
			</div>
	</div>
	
		<!-- Enrollment Agreement List -->
			<div style='display:none'>
			<div id='enrollment' style='padding:10px;'>
			<h3>Enrollment Agreements</h3>
				<ul class="navList">
					<li><a href="downloads/rm/enrollment-ak-tn.pdf" target="_blank">Arkansas Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-ak-tn.pdf" target="_blank">Tennessee Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-ca.pdf" target="_blank">California Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-fl.pdf" target="_blank">Florida Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-in.pdf" target="_blank">Indiana Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-nc.pdf" target="_blank">North Carolina Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-oh.pdf" target="_blank">Ohio Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-ok.pdf" target="_blank">Oklahoma Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-tx.pdf" target="_blank">Texas Enrollment Agreement</a></li>
					<li><a href="downloads/rm/enrollment-ut.pdf" target="_blank">Utah Enrollment Agreement</a></li>
				</ul>
			</div>
	</div>

		<!-- DEVELOPER MENU-->		
					<?PHP if ($_SESSION['role']=="Admin") { ?>
					<h3>Developer Menu</h3>
					<ul class="navList">
						<li><a target="_blank" href="/_cron/log.html">View Cron Job Log</a></li><br>
						<li><a target="_blank" href="print/#/default.php?userID=1">Print Asset</a></li>
						<li><a target="_blank" href="downloadable/#/default.php?userID=1">Downloadable Asset</a></li>
						<li><a target="_blank" href="http://devmm.careerpathtraining.com/eventManager/flyers/1/flyer.php?eventID=1">Event Manager Flyer</a></li>
						<li><a target="_blank" href="http://www.roadmaster.com/event-banner-sim.php" target="_blank">Banner Simulator</a></li>
					</ul>
					 <?PHP } ?>
		<!-- END DEVELOPER MENU-->
		<h3>Help</h3>
			<ul class="navList">
				<li><a href="tutorials.php">Video Tutorials</a></li>
			</ul>
		
		
		<h3>Feedback</h3>
		<ul class="navList">
			<li><a class="lightbox-22484315193958" style="cursor:pointer;">Stories from the Schools</a></li>
			<li><a class="lightbox-22483883263965" style="cursor:pointer;">Marketing Manager Feedback</a></li>
		</ul>
			
