<?PHP
	include("../inc/security.inc"); 
	
	include("../inc/dbOpen.php");
	
	$userID = $_POST['userID'];

	mysql_select_db ($database, $con);
	
	// New Approval Check //
	
	$approval = mysql_query("SELECT approvalStatus FROM users WHERE id=' " . $userID . " ' ");
	$approvalInfo = mysql_fetch_array($approval);
	
	$employer = mysql_query("SELECT employer FROM schools WHERE id=' " . $_POST['schoolID'] . " ' ");
	$employerInfo = mysql_fetch_array($employer);
	
	$email = mysql_query("SELECT * FROM users WHERE email= '" . $_POST['email'] . "'");
	$emailCount = mysql_num_rows($email);
	$emailInfo = mysql_fetch_array($email);
	
	$password = mysql_real_escape_string($_POST['passwordUpdate']);
	$firstName = mysql_real_escape_string($_POST['firstName']);
	$lastName = mysql_real_escape_string($_POST['lastName']);
	$email = mysql_real_escape_string($_POST['email']);
	$schoolID = mysql_real_escape_string($_POST['schoolID']);
	$mobilePhone = mysql_real_escape_string($_POST['mobilePhone']);
	$extension = mysql_real_escape_string($_POST['extension']);
	$fax = mysql_real_escape_string($_POST['fax']);
	$jobTitle = mysql_real_escape_string($_POST['jobTitle']);
	$credentials = mysql_real_escape_string($_POST['credentials']);
	$role = mysql_real_escape_string($_POST['role']);
	$email = mysql_real_escape_string($_POST['email']);
	$employer = $employerInfo['employer'];
	$approvalStatus = mysql_real_escape_string($_POST['approvalStatus']);
	
	// Checks to see if the user exists and either updates or rejects based upon the result
	if ($emailCount=="1")	{
		if ($userID==$emailInfo['id']) {
				mysql_query("UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', password='$password', schoolID='$schoolID', mobilePhone='$mobilePhone', extension='$extension', fax='$fax', title='$jobTitle', credentials='$credentials', role='$role', employer='$employer', approvalStatus='$approvalStatus' WHERE id = '$userID' ");
		
		} elseif ($userID!=$emailInfo['id']) {
				header("Location:../userExists.php?flag=exists&email=" . $email  . "");
					die();     // just to make sure no scripts execute
		}
	} elseif ($emailCount=="0")	{
				mysql_query("UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', password='$password', schoolID='$schoolID', mobilePhone='$mobilePhone', extension='$extension', fax='$fax', title='$jobTitle', credentials='$credentials', role='$role', employer='$employer', approvalStatus='$approvalStatus' WHERE id = '$userID' ");
} 
	// END
	
	$adminQC = mysql_query("SELECT * FROM admin WHERE role='qcUser' ");
	$selectedAdminQC = mysql_fetch_array($adminQC);
	
	$adminEmail = mysql_query("SELECT * FROM admin WHERE role='admin' ");


// Email is sent to submitter and cc'd to maketing team and IT for lead pull

if (($approvalStatus=="1") && ($approvalInfo['approvalStatus']=="0")) {

require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Your Profile is now active!');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedAdminQC['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($email);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("Your profile has been approved by " .  $selectedAdminQC['name'] . " and Marketing Manager is ready for your use. Please visit  <a href='http://mm.careerpathtraining.com'>Marketing Manager</a> to gather materials or order supplies. If there are any errors or changes, please <a href='mailto:" . $selectedAdminQC['email'] . "'>email them to ". $selectedAdminQC['name'] . "</a><br><br><h3>Login Credentials</h3><b>E-Mail Address:</b> " . $email . "<br/><b>Password: </b>" . $password);
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

    }
	include("../inc/dbClose.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../inc/head.inc"); ?>
		<title>Marketing Manager - Order Deletion</title>
		
<script type="text/javascript">
	function redirectUser(){
	  window.location = "/edit-user.php?userID=<?PHP echo $userID; ?>";
	}
</script>
		
	</head>
	<body onload="setTimeout('redirectUser()', 2000)">
	
	<div id="shell">
	
		<div id="container">
	
	<div id="top">
		<div id="logo"><a href="/internalDefault.php"><img border="0" src="/images/logo.png"></div>
		<div id="home"><a href="/internaldefault.php"><img border="0" src="/images/home.png"> HOME</a></div>
	</div>
	
			<div class="centerContainer"><div class="menuTab">Processing</div>
				<p>Updating profile</p>
				<img src="loader.gif">
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