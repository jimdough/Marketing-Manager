<?PHP include("../../functions/nameFunc.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>

		<title>Marketing Manager - </title>

	<link href="print-2.css" media="screen" rel="stylesheet" type="text/css" />
	<?PHP
		// Count Extra Fields Function - END //
		
		// Count Extra Fields Function //
		$count=1;
			
		if (!empty($userInfo['mobilePhone']))
			$count ++;

		if ($count==2)	{
				echo "<style>#col2 {font-size:26px; line-height:31px; bottom:65px;}</style>";
		} 
?>

<script>
//"Accept terms" form submission- By Dynamic Drive
//For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
//This credit MUST stay intact for use

var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return true
else{
alert("Please read/accept terms to submit form")
return false
}
}
}

</script>

	</head>
	<body margin="0" padding="0">
	<div id="shell">
		<div id="center">
			<span id="userName"><?PHP echo $userInfo['firstName'] . " " . $userInfo['lastName']; ?><?PHP echo $credentials; ?></span>
			<span id="title"><?PHP echo $userInfo['title']; ?></span><br/>

	</div>
	
		<div id="contact">
			<span id="email"><?PHP echo $userInfo['email']; ?></span><br/>
				<?PHP echo "Phone: " . $schoolInfo['phone']; ?><?php if( !empty( $userInfo['extension'] ) ): ?><?PHP echo " ext. " . $userInfo['extension']; ?><?php endif; ?>
				
				<br><?PHP echo "Fax: " . $fax; ?><br />
				
				<!--<?php if( !empty( $userInfo['mobilePhone'] ) ): ?>
				<?PHP echo "Mobile: " . $userInfo['mobilePhone']; ?>
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;
				<?php endif; ?>-->
				
	</div>
	
		<div id="add">
				<?PHP echo $schoolInfo['add1']; ?>
				<?php if( !empty( $schoolInfo['add2'] ) ): ?>
				<?PHP echo "<br>" . $schoolInfo['add2']; ?>
				<?php endif; ?>
				<?PHP echo $schoolInfo['city'] . ", " . $schoolInfo['state'] . " " . $schoolInfo['zip'] . "<br>Toll Free: (888) 831-8303"; ?>
				<br>
				
		</div>
	
	</div>
	
	<?PHP include("../../functions/orderFunc.php"); ?>
	</body>
</html>

<?php include("../../inc/dbClose.php"); ?>                                                                                                                                                               