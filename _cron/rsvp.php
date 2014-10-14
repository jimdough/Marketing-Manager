<!-- ///////////// START EVENT EMAIL REMINDERS TO RSVPs ///////////// -->
<?PHP
	echo "<h1>RSVP Reminder Email Output</h1>";

	// Gets current date
	$month=ltrim(date('m'), "0");
	$day=date('d');
	$year=date('Y');
	$fullDate=$month . "/" . $day . "/" . $year;
	
	//
	
	$logFile = "log.html";
	$fh = fopen($logFile, 'a') or die("can't open file");
	fwrite($fh, "<h1>Logging RSVP Reminders for " . $fullDate . "</h1>");
	
	// Day Number Array
	$monthNumber = array(1=>1, 2=>32, 3=>60, 4=>91, 5=>121, 6=>152, 7=>182, 8=>213, 9=>244, 10=>274, 11=>305, 12=>335);
	//
	
	// Assigns day number value to current day
	$dayNumber = (($monthNumber[$month] + $day)-1);
	//
	
	echo "Todays Day Number is " . $dayNumber . "<br><br>";
	
	// Event info SQL Querys
	$event = mysql_query("SELECT * FROM event_em WHERE eventDate1Year >=" . $year);
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
			 
			 $rsvp = mysql_query("SELECT * FROM rsvp_em WHERE event=" . $eventInfo['id']);
			 while($rsvpInfo = mysql_fetch_array($rsvp))	{
			 
		    // Capitalizes first letter of first and last name 
		    $recipientName = ucfirst($rsvpInfo['firstName']) . " " . ucfirst($rsvpInfo['lastName']);
		    //
			
			$messageContent = "Dear " . $recipientName . ",<br><br>";
			$messageContent .= "We wanted to remind you that the " . $eventInfo['eventName'] . " that you wanted to attend on " . $eventInfo['eventDate1DayName'] . ", " .  $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] . " is just a few days away. Please see the information below to attend:<br>";
			$messageContent .= "<h3>" . $eventInfo['eventName'] . "</h3>";
			$messageContent .= "<b>" . $eventInfo['eventLocationName'] . "</b><br>" . $eventInfo['eventLocAdd1'];
			if (!empty($eventInfo['eventLocAdd2']))	{
				$messageContent .= "<br>" . $eventInfo['eventLocAdd2'] . "<br>";
			}
			$messageContent .= $eventInfo['eventLocCity'] . ", " . $eventInfo['eventLocState'] . " " . $eventInfo['eventLocZip'];
			
			$messageContent .= "<p>If you need to cancel or would like to meet with a representative at a different time, please call us at " . $eventInfo['rsvpPhone'] . " or you can <a href='mailto:" .  $eventInfo['rsvpEmail'] . "'>email us by clicking here.</a>";
			
			
			
			  //Give the message a subject
			  $message->setSubject("Hey " . ucfirst($rsvpInfo['firstName']) . ", the " . $eventInfo['eventName'] . " is coming up on " . $eventInfo['eventDate1DayName'] . ", " .  $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year']);
			
			  //Set the From address with an associative array
			  $message->setFrom($eventInfo['rsvpEmail']);
			  
			  $message->setTo($rsvpInfo['email']);
		
			  //Set the CC Address
			  $message->setBcc('jdoughcpt+MM@gmail.com');
			
			  $message ->setBody($messageContent);
			 
			  $message->setContentType("text/html");
		
		      $result = $mailer->send($message);
 
		      echo $messageContent . "<br>";
		      fwrite($fh, $messageContent . "<br><br>");
		  
		      
		    } // Close RSVP loop
		    }
	} // Close While Loop
	
	// Close Text File Log
		fclose($fh);
?>
<!-- ///////////// END EVENT EMAIL REMINDERS TO EVENT RSVPs ///////////// -->
