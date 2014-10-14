<?php 
session_start();
unset($_SESSION['id']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("inc/head.inc"); ?>
		<title>Marketing Manager</title>
	</head>
	<body>
	
	<div id="shell">
	
		<div id="container">
	
<?PHP include("inc/topNav.php"); ?>
	
	<!--[if !IE]> -->

			<div class="centerContainer"><div class="menuTab">Login</div>
					
				<div id="stylized" class="form">
					<form action="functions/pwdCheck.php" method="post">
							<label>E-Mail Address: </label><input name="email" size="40" /><br/>
							<label>Password: </label><input type="password" size="40" name="password" /><br />
							<button class='button' type="submit">Sign In</button>
					</form>
				</div>
				<p style="clear:both;"></p>
			</div>			
<!-- <![endif]-->
	
<!--[if gte IE 8]>

			<div class="centerContainer rounded"><div class="menuTab">Login</div>
					
				<div id="stylized" class="form">
					<form action="functions/pwdCheck.php" method="post">
							<label>E-Mail Address: </label><input name="email" size="40" /><br/>
							<label>Password: </label><input type="password" size="40" name="password" /><br />
							<button type="submit">Sign In</button>
					</form>
				</div>
				<p style="clear:both;"></p>
				
			</div>			
<![endif]-->

<!--[if lte IE 7]>
<style>
#ie7		{
	color:white;
	font-size:16px;
	text-align:center;
	width:500px;
	margin:auto;
}

a	{
	color:white;
	text-decoration:underline;
}
</style>

<div id="ie7">
<p style="font-size:18px; color:white; font-weight:bold;">Your browser is too old to run Marketing Manager. <br><br>You will need to update Internet Explorer to Version 8 or greater  by running Windows Update or choose a different browser such as:</p>
<ul>
<li><a href="http://www.google.com/chrome" target="_blank">Google Chrome</a></li>
<li><a href="http://www.mozilla.org/en-US/firefox/new/" target="_blank">Firefox</a></li>
<li><a href="http://www.apple.com/safari/" target="_blank">Safari</a></li>
</ul>
<p style="font-size:18px; color:white; font-weight:bold;">The IT Department can assist you with this if needed</p>
</div>

<![endif]-->

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