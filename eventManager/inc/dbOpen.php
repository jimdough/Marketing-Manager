<?php
$username = 'cpt';
$password = '77#nrtuM#';
$host     = 'localhost:30697';
$database = 'marketingmanager';

# connect to the database or die
$con = mysql_connect($host, $username, $password);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

?>