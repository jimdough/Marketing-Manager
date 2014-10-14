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
		$school = mysql_query("SELECT * FROM schools ORDER BY schoolName ASC");   
		$publication = mysql_query("SELECT * FROM publications ORDER BY pubName ASC");   
		$adtype = mysql_query("SELECT * FROM adtype ORDER BY type ASC");   
	?> 
		<?php
				// Request selected language
				$hl = (isset($_POST["hl"])) ? $_POST["hl"] : false;
				if(!defined("L_LANG") || L_LANG == "L_LANG")
				{
					if($hl) define("L_LANG", $hl);
				
					// You need to tell the class which language you want to use.
					// L_LANG should be defined as en_US format!!! Next line is an example, just put your own language from the provided list
					else define("L_LANG", "en_US"); // Ebraic example - change the red value to your desired language (from the list provided)
				}
		?>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>

			<div class="leftContainer rounded"><div class="menuTab">Navigation</div>
					<?PHP include("leftNav.php"); ?>			
			</div>
			
			
				<div class="rightContainer rounded"><div class="menuTab">Upload Ad</div>

	   
	<div id="stylized" class="form">		 
	<div class="innerWrapper">
	
	<form action="uploadFunction.php" method="post" enctype="multipart/form-data">

<?PHP
		echo "<p><label for ='schoolID'>Choose School</label>";
		echo "<select style='width:300px;' name='schoolID' class='required'>";
		echo "<option value=''>Please Choose the School</option>";
			while($schoolinfo = mysql_fetch_array($school))
				  {
				  echo "<option value='" . $schoolinfo['id'] . "'>" . $schoolinfo['schoolName'] . "</option>";
				  }
		echo "</select></p>";
		
		echo "<p><label for ='publicationID'>Choose Publication<br><a href='editPublications.php'>Edit</a></label>";
		echo "<select style='width:300px;' name='publicationID' class='required'>";
		echo "<option value=''>Please Choose the Publication</option>";
			while($publicationinfo = mysql_fetch_array($publication))
				  {
				  echo "<option value='" . $publicationinfo['id'] . "'>" . $publicationinfo['pubName'] . "</option>";
				  }
		echo "</select></p>";
		
				echo "<p><label for ='adtype'>Choose Ad Type</label>";
		echo "<select style='width:300px;' name='adtype' class='required'>";
		echo "<option value=''>Please Choose the Ad Type</option>";
			while($adtypeinfo = mysql_fetch_array($adtype))
				  {
				  echo "<option value='" . $adtypeinfo['id'] . "'>" . $adtypeinfo['type'] . "</option>";
				  }
		echo "</select></p>";
		
?>

<p><label for="comments">Comments / Line Ad</label>
<textarea cols="40" rows="5" name="comments"></textarea></p><br>
<p><label for="startDate">Start Date</label>

<div id="calPicker">
<?php
//get class into the page
require_once('calendar/tc_calendar.php');

 $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2020);
	  $myCalendar->dateAllow('2000-01-01', '2022-12-31', false);
	  $myCalendar->writeScript();  
?>
</div>
</p><br>


<p><label for="file">Choose Ad:</label>
<input type="file" name="file" id="file"></p>

<div style="text-align:center; clear:both;"><button class="button" type="submit" name="submit" id="submit" value="Submit this Form">Upload Ad</button></div>
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