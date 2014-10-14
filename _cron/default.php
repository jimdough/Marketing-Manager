<?PHP
	$username = 'cpt';
	$password = '77#nrtuM#';
	$host     = 'localhost:30697';
	$database = 'marketingmanager';
	
	# connect to the database or die
	$con = mysql_connect($host, $username, $password);
	if (!$con) {
	  die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db ($database, $con);

	require_once 'Swift/lib/swift_required.php';

	// Start Modules

    include("leadPull.php");
	
	include("rsvp.php");
	
	include("eventAdmin.php");
	
	// END Modules

	mysql_close($con);
?>