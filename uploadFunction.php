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


				<div class="leftContainer rounded"><div class="menuTab">News</div>
						<?PHP include("leftNav.php"); ?>
				</div>
			
				<div class="rightContainer rounded"><div class="menuTab">Upload</div>
				<div class="centerContainer rounded"><div class="menuTab">Status</div>

					<?php
					
if ($_POST['adtype']!=2){

// Upload File

$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 500000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    $fileName=$_FILES["file"]["name"];

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo "<div id='error'>ERROR<br>";
      echo $_FILES["file"]["name"] . " already exists</div><br/>";
      echo "<div id='adPreview'><a class='group3' target='_blank' href='upload/" . $fileName . "'><img border='2' width='300' src='upload/" . $fileName . "'></a></div>";
      echo "<a class='group3' target='_blank' href='upload/" . $fileName . "'><img border='0' src='images/icons/preview2.png'><span>See Full Size Ad</span></a><br/>";
      echo "<br><div class='adText'>Press the back button in your web browser to go to the previous page or <a href='uploadAd.php'>click here to start over</a></div>";
      die();

      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
       $fileName=$_FILES["file"]["name"];
       echo "<div id='success'>SUCCESS<br>";
      echo $_FILES["file"]["name"] . " was uploaded<br></div>";
      echo "<div id='adPreview'><a class='group3' target='_blank' href='upload/" . $fileName . "'><img border='2' width='300' src='upload/" . $fileName . "'></a></div>";
      echo "<a class='group3' target='_blank' href='upload/" . $fileName . "'><img border='0' src='images/icons/preview2.png'><span>See Full Size Ad</span></a><br/>";
      echo "<div class='adText'><br><a href='uploadAd.php'>Click here to upload another ad</a></div>";
      
      }
    }
  }
else
  {
  echo "<h2>Invalid file type or file is too large</h2>";
  die();
  }

// END Upload File
}
mysql_select_db ($database, $con);
$comments = mysql_real_escape_string($_POST['comments']);
$theDate = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";


if ($_POST['adtype']==2)	{
	$sql="INSERT INTO admanager (school, publication, comments, startDate, endDate, type) VALUES ('$_POST[schoolID]', '$_POST[publicationID]', '$comments', '$theDate', '', '$_POST[adtype]')";
	echo "<h2>Your ad was uploaded successfully</h2><a href='uploadAd.php'>Click here to upload another ad</a>";
} else	{
	$sql="INSERT INTO admanager (school, publication, comments, startDate, endDate, fileName, type) VALUES ('$_POST[schoolID]', '$_POST[publicationID]', '$comments', '$theDate', '', '$fileName', '$_POST[adtype]')";
	}
	

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
?>

				</div>		
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