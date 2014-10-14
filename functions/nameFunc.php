<?php 
include("../../inc/dbOpen.php");

mysql_select_db ($database,$con);

if (!empty($_GET['userID'])) {
	$userID=$_GET['userID'];
} else {
	$userID=$_POST['userID'];
}

$user= mysql_query("SELECT * FROM users WHERE id='" . $userID . "' ");
$userInfo = mysql_fetch_array($user);

$school = mysql_query("SELECT * FROM schools WHERE id= ' " . $userInfo['schoolID'] . " ' ");
$schoolInfo = mysql_fetch_array($school);

if (!empty($userInfo['fax'])) 	{
	$fax = $userInfo['fax'];
}	else	{
	$fax = $schoolInfo['fax'];
}


// CFI Credential Formatting

if ($userInfo["employer"]=="CFI")	{

	if (!empty($userInfo['credentials']))		{
		$mcred = strpos($userInfo['credentials'], ",");
			if ($mcred == false)	{
						// 1 Credential
						$credentials = ", " . $userInfo['credentials'] . "<br><div id='creds'>&nbsp;</div>";
						echo "<!--Custom Style Override--><style>#creds {height:0px; display:inline;} #title {padding-bottom:50px;}</style>";
				} else {
						// Multiple Credentials
						$credentials = "<div id='creds'>" . $userInfo['credentials'] . "</div>";
						echo "<!--Custom Style Override--><style>#creds {height:30px;} #title {padding-bottom:0px;}</style>";
				}  
				} else { 
		// No Credentials
		$credentials = "<br><div id='creds'>&nbsp;</div>";
		echo "<!--Custom Style Override--><style>#creds {height:0px; display:inline-block;} #title {padding-bottom:50px;}</style>";
	}
} 



?>