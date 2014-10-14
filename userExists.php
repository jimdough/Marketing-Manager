<?PHP
	include("inc/security.inc"); 
	include("inc/dbOpen.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager - User Exists</title>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>
	
			<div class="centerContainer rounded"><div class="menuTab">Password</div>
			<?PHP

				if ((!empty($_GET['flag'])) && ($_GET['flag']=="exists"))	{
					echo "<p>The profile you are trying to create already exists for the email address you entered. <a href='entry-user.php'>Please click here</a> to try again with a new e-mail address.</p>";
				}
				?>
				
				<form method="post" action="functions/email-password.php">
				Enter the email address to have your password sent to you <input type="text" name="email" value="<?PHP echo $_GET['email'] ?>" size="35" />
				<input type="submit" name="submit" id="submit" value="Send Password" />
				</form>

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