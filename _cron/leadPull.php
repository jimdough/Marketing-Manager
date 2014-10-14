<!-- ///////////// START EVENT EMAIL REMINDERS TO EVENT ADMIN ///////////// -->
<?PHP
	echo "<h1>Lead Pull Reminder Email Output</h1>";

	// Gets current date
	$month=ltrim(date('m'), "0");
	$day=date('d');
	$year=date('Y');
	$fullDate=$month . "/" . $day . "/" . $year;
	//
	
	$logFile = "log.html";
	$fh = fopen($logFile, 'a') or die("can't open file");
	fwrite($fh, "<h1>Logging Email Pull Reminders for " . $fullDate . "</h1>");

	
	// Day Number Array
	$monthNumber = array(1=>1, 2=>32, 3=>60, 4=>91, 5=>121, 6=>152, 7=>182, 8=>213, 9=>244, 10=>274, 11=>305, 12=>335);
	//
	
	// Assigns day number value to current day
	$dayNumber = (($monthNumber[$month] + $day)-1);
	//
	
	echo "Todays Day Number is " . $dayNumber . "<br><br>";
	
	// Event info SQL Querys
	$event = mysql_query("SELECT * FROM event_em WHERE eventDate1Year >=" . $year);
	$eventAdmin = mysql_query("SELECT * FROM admin WHERE role='leads'");
	$eventAdminInfo = mysql_fetch_array($eventAdmin);
	//

	// Start Mailer Info  
	
	$transport = Swift_SmtpTransport::newInstance('mail.roadmaster.com', 25)
	  ->setUsername('noreply@roadmaster.com')
	  ->setPassword('cptc007')
	  ;
	  
	  $mailer = Swift_Mailer::newInstance($transport);
	 
	  //Create the message
	  $message = Swift_Message::newInstance("text/html");

	  // END Mailer Info	
	
	// offset accounts for leap day and the first day of the month combined with 8-9 days ahead of time
	while($eventInfo = mysql_fetch_array($event))	{
		$eventDayNumber = (($monthNumber[$eventInfo['eventDate1Month']] + $eventInfo['eventDate1Day'])-1);
		
		if ($eventInfo['eventDate1Year'] > $year) {
			$eventDayNumber = $eventDayNumber + 365;
		}
		
		$offset = $eventDayNumber - $dayNumber;
		
		if (($offset==10) OR ($offset==2)) {
		

			 $school = mysql_query("SELECT * FROM schools WHERE id=" . $eventInfo['schoolID']);
			 $schoolInfo = mysql_fetch_array($school);
			 
			  //Give the message a subject
			  $message->setSubject('MM - Event Email ' . $offset . ' Day Reminder - ' . $eventInfo['eventName']);
			
			  //Set the From address with an associative array
			  $message->setFrom('norepy@roadmaster.com');
			  
			  $message->setTo($eventAdminInfo['email']);
		
			  //Set the CC Address
			  $message->setCc('jdoughcpt+MM@gmail.com');
			
			  $messageContent = "Please pull and send leads for the event below. It is " . $offset . " days away";
			  $messageContent .= "<h3>" . $eventInfo['eventName'] . "</h3><p><b>" . $schoolInfo['schoolName'] . "</b></p>";
			  $messageContent .= "Event Date: " . $eventInfo['eventDate1DayName'] . ", " . $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] . "<br>";
			  $messageContent .= "<a href='http://mm.careerpathtraining.com/eventManager/emails/" . $eventInfo['email'] . "/email.php?eventID=" . $eventInfo['id'] . "'>Click here to view the email</a><br>";
			
			  $message ->setBody($messageContent);
			 
			  $message->setContentType("text/html");
		
		      $result = $mailer->send($message);
 
		      echo $messageContent . "<br>";
		      fwrite($fh, $messageContent . "<br><br>");
		    }
	} // Close While Loop
		fclose($fh);
?>
<!-- ///////////// END EVENT EMAIL REMINDERS TO EVENT ADMIN ///////////// -->
