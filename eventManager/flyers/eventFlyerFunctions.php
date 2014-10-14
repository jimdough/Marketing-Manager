<?php 
include("../../inc/dbOpen.php");

$eventID = $_GET['eventID'];

mysql_select_db ($database,$con);

// Gets Event Info
$event = mysql_query("SELECT * FROM event_em WHERE id=' " . $eventID . " ' ");
$eventInfo = mysql_fetch_array($event);

// Gets School Info
$school = mysql_query("SELECT * FROM schools WHERE id= ' " . $eventInfo['schoolID'] . " ' ");
$schoolInfo = mysql_fetch_array($school);

// Gets Month Name
$month= mysql_query("SELECT * FROM months WHERE id= ' " . $eventInfo['eventDate1Month'] . " ' ");
$monthInfo = mysql_fetch_array($month);

// Gets Day of the Month Suffix ie. 1st, 2nd, 3rd, 4th
$suffix= mysql_query("SELECT * FROM suffixes WHERE id= ' " . $eventInfo['eventDate1Day'] . " ' ");
$suffixInfo = mysql_fetch_array($suffix);

?>