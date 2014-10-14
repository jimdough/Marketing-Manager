<?php 
session_set_cookie_params (86400, '/', '.careerpathtraining.com');
session_start();

include("../inc/dbOpen.php"); 

	mysql_select_db ($database,$con);
	
	$user = mysql_query("SELECT * FROM users WHERE email='" .  $_POST['email'] . "'");
	$userInfo = mysql_fetch_array($user);
	
	If ($_POST['password']==$userInfo['password'] AND $userInfo['approvalStatus']=="1") 
		{
			$_SESSION['role']=$userInfo['role'];
			$_SESSION['email']=$userInfo['email'];
			$_SESSION['id']=$userInfo['id'];
			$_SESSION['schoolID']=$userInfo['schoolID'];
			$_SESSION['employer']=$userInfo['employer'];
			$_SESSION['name']=$userInfo['firstName'] . " " . $userInfo['lastName'];
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/internalDefault.php');
			die();
		}
	else {
			$_SESSION['id']="";
		}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Password Check</title>
		
<script type="text/javascript">
	function redirectUser(){
	  window.location = "/default.php";
	}
</script>
		
	</head>
	<body  onload="setTimeout('redirectUser()', 2000)">
	
	<div id="shell">
	
		<div id="container">
	
			<div id="top">
				<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
				<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
			</div>
	
			<div class="centerContainer rounded"><div class="menuTab">Processing</div>
					<p>Invalid Login - Returning to Login Page<br/>
					<img src="loader.gif"></p>
			</div>		
			
			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="/images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>