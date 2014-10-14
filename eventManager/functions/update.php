<?PHP
	include("../../inc/security.inc"); 
	
	include("../inc/dbOpen.php");
	
	$eventID = $_GET['eventID'];

	mysql_select_db ($database,$con);
	
	// New Approval Check //
	
	$approval = mysql_query("SELECT approvalStatus FROM event_em WHERE id=' " . $eventID . " ' ");
	$approvalInfo = mysql_fetch_array($approval);
	
	$eventName = mysql_real_escape_string($_POST['eventName']);
	$eventDesc = mysql_real_escape_string($_POST['eventDesc']);
	$eventDesc = mysql_real_escape_string($_POST['eventDesc']);
	$marketingNotes = mysql_real_escape_string($_POST['marketingNotes']);
	$eventLocAdd1 = mysql_real_escape_string($_POST['eventLocAdd1']);
	$eventLocAdd2 = mysql_real_escape_string($_POST['eventLocAdd2']);
	$eventLocCity = mysql_real_escape_string($_POST['eventLocCity']);
	$eventLocationName = mysql_real_escape_string($_POST['eventLocationName']);
	$eventHighlight1 = mysql_real_escape_string($_POST['eventHighlight1']);
	$eventHighlight2 = mysql_real_escape_string($_POST['eventHighlight2']);
	$eventHighlight3 = mysql_real_escape_string($_POST['eventHighlight3']);
	$eventHighlight4 = mysql_real_escape_string($_POST['eventHighlight4']);
	
	mysql_query("UPDATE event_em SET targetAreaCode1='$_POST[targetAreaCode1]', targetAreaCode2='$_POST[targetAreaCode2]', targetAreaCode3='$_POST[targetAreaCode3]', targetAreaCode4='$_POST[targetAreaCode4]', targetAreaCode5='$_POST[targetAreaCode5]', email='$_POST[email]', flyer='$_POST[flyer]', rsvpPhone='$_POST[rsvpPhone]', rsvpEmail='$_POST[rsvpEmail]', eventName='$eventName', eventLocationName='$eventLocationName', eventLocAdd1='$eventLocAdd1', eventLocAdd2='$eventLocAdd2', eventLocCity='$eventLocCity', eventLocState='$_POST[eventLocState]', eventLocZip='$_POST[eventLocZip]', eventDate1DayName='$_POST[eventDate1DayName]', eventTime1Hour='$_POST[eventTime1Hour]', eventTime1Minutes='$_POST[eventTime1Minutes]', eventTime1AMPM='$_POST[eventTime1AMPM]', eventTime1EndHour='$_POST[eventTime1EndHour]', eventTime1EndMinutes='$_POST[eventTime1EndMinutes]', eventTime1EndAMPM='$_POST[eventTime1EndAMPM]', eventDate1Month='$_POST[eventDate1Month]', eventDate1Day='$_POST[eventDate1Day]', eventDate1Year='$_POST[eventDate1Year]', eventDesc='$eventDesc', eventHighlight1='$eventHighlight1', eventHighlight2='$eventHighlight2', eventHighlight3='$eventHighlight3', eventHighlight4='$eventHighlight4', marketingNotes='$marketingNotes', leadRadius='$_POST[leadRadius]', leadRange='$_POST[leadRange]', bannerToggle='$_POST[bannerToggle]', calendarToggle='$_POST[calendarToggle]', admin='$_POST[adminID]', approvalStatus='$_POST[approvalStatus]' WHERE id = '$eventID' ");
	
	$record = mysql_query("SELECT * FROM event_em WHERE id=' " . $eventID . " ' ");
	$recordInfo = mysql_fetch_array($record);
	
	$school = mysql_query("SELECT * FROM schools WHERE id=' " . $recordInfo['schoolID'] . " ' ");
	$schoolInfo = mysql_fetch_array($school);
	
	$admin = mysql_query("SELECT * FROM admin WHERE id=' " . $recordInfo['admin'] . " ' ");
	$selectedAdmin = mysql_fetch_array($admin);
	
	$adminIT = mysql_query("SELECT * FROM admin WHERE role='it' ");
	$selectedAdminIT = mysql_fetch_array($adminIT);
	
	$leads = mysql_query("SELECT * FROM admin WHERE role='leads' ");
	$selectedLeads = mysql_fetch_array($leads);
	
	$adminOMM = mysql_query("SELECT * FROM admin WHERE role='omm' ");
	$selectedAdminOMM = mysql_fetch_array($adminOMM);
	
	$adminQC = mysql_query("SELECT * FROM admin WHERE role='qcEvent' ");
	$selectedAdminQC = mysql_fetch_array($adminQC);
	
	$adminEmail = mysql_query("SELECT * FROM admin WHERE role='admin' ");


// Email is sent to submitter and cc'd to maketing team and IT for lead pull

if ($_POST['approvalStatus']=="1" && $approvalInfo['approvalStatus']=="0")
{

require_once 'Swift/lib/swift_required.php';

	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Your Event Marketing Materials are now ready');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedAdminQC['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($recordInfo['yourEMail']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	  	  
	/* while($adminEmailInfo = mysql_fetch_array($adminEmail))
	  {
	  	$message->addTo($adminEmailInfo['email']);
	  }*/
	
	  //Give it a body
	 $message ->setBody("Your event, <b>" . $_POST['eventName'] . "</b> scheduled to start on " . $_POST['eventDate1Month'] . "/" . $_POST['eventDate1Day'] . "/" . $_POST['eventDate1Year'] . " has been approved by " .  $selectedAdminQC['name'] . " for " . $schoolInfo['schoolName'] . " and the marketing materials are ready for your use. Please visit  <a href='http://mm.careerpathtraining.com/eventManager/view.php?eventID=" . $eventID . "'>your event page by clicking here</a> to gather materials to start promoting your event. If there are any errors or changes, please <a href='mailto:" . $selectedAdminQC['email'] . "'>email them to ". $selectedAdminQC['name'] . "</a><h2>" .  $schoolInfo['schoolName'] . "</h2><h3>Event Name: " . $eventName . "</h3><b>Date: " . $_POST['eventDate1DayName'] . ", " . $_POST['eventDate1Month'] . "/" . $_POST['eventDate1Day'] . "/" . $_POST['eventDate1Year'] . "</b><br>" .  $eventLocAdd1 . "," . $eventLocAdd2 . "<br>" . $eventLocCity . ", " . $_POST['eventLocState'] . " " . $_POST['eventLocZip'] . "<br><h3>Marketing Notes</h3><p>"  . $_POST['marketingNotes'] . "</p>");
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);

    /*
    ///////////////// send email to IT for lead pull ///////////////////
  
  	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  //Give the message a subject
	  $message->setSubject('MM - Lead Pull Request');
	
	  //Set the From address with an associative array
	  $message->setFrom($selectedLeads['email']);
	
	  //Set the To addresses with an associative array
	  $message->setTo($selectedAdminIT['email']);
	  
	  //Set the CC Address
	  $message->setCc('jdoughcpt+MM@gmail.com');
	
	  //Give it a body
	 $message ->setBody("The event, <b>" . $_POST['eventName'] . "</b> has been approved by " .  $selectedAdminQC['name'] . " for " . $schoolInfo['schoolName'] . ". Please pull a list of unconverted leads for the last " . $recordInfo['leadRange'] . " days within a " . $recordInfo['leadRadius'] . " mile radius of the zip code: " . $recordInfo['eventLocZip']   . "<br><br>Please send these to " . $selectedLeads['name'] . " at " . $selectedLeads['email'] );
	 
	 $message->setContentType("text/html");

  	$result = $mailer->send($message);
  	*/
  }
 
	include("../inc/dbClose.php");

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?PHP include("../../inc/head.inc"); ?>
		<title>Marketing Manager - Event Update</title>
		
<script type="text/javascript">
	function redirectUser(){
	  window.location = "../edit.php?eventID=<?PHP echo $eventID; ?>";
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
				<p>Updating Event</p>
				<img src="loader.gif">
			</div>		
			
			
			</div> <!-- END CONTAINER -->
			
			<div id="bottomStripe">
					<div id="bottom">
						<?PHP include("../../inc/footer.inc"); ?>
						<a href="http://www.careerpathtraining.com" target="_blank"><img border="0" src="/images/cpt.png"></a>
					</div>
			</div>
			
</div> <!-- END SHELL -->
	</body>
</html>
