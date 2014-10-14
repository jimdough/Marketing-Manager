<?php 
include("../../inc/dbOpen.php"); 

$eventID = $_GET['eventID'];

mysql_select_db ($database,$con);

$event = mysql_query("SELECT * FROM event_em WHERE id=' " . $eventID . " ' ");
$eventInfo = mysql_fetch_array($event);

$school = mysql_query("SELECT * FROM schools WHERE id= ' " . $eventInfo['schoolID'] . " ' ");
$schoolInfo = mysql_fetch_array($school);

$design = mysql_query("SELECT * FROM email_em WHERE id=' " . $eventInfo['email'] . " ' ");
$designInfo = mysql_fetch_array($design);

$flyer = mysql_query("SELECT * FROM flyer_em WHERE id=' " . $eventInfo['flyer'] . " ' ");
$flyerInfo = mysql_fetch_array($flyer);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	</head>
	<body style="font-family: Helvetica, Verdana, Arial, sans-serif;">
		<table style="width:776px; height 900px; border:1px solid black;" align="center" cellpadding="0" cellspacing="0">
		
		<!-- TOP BAR -->
		<tr>
			<td colspan="2" height="40" style="background-color:<?PHP echo $designInfo['darkColor'] ?>; color:<?PHP echo $designInfo['lightColor'] ?>; background-color:<?PHP echo $designInfo['darkColor'] ?>;"><span style="font-size:26px; float:left; padding-left:10px;"><a style="color:<?PHP echo $designInfo['lightColor'] ?>; text-decoration:none;" href="http://www.roadmaster.com/<?PHP echo $schoolInfo['schoolURL'] ?>" style="color:<?PHP echo $designInfo['darkColor'] ?>;"><?PHP echo $schoolInfo['schoolName'] ?></a></span><span style="font-size:26px; color:<?PHP echo $designInfo['lightColor'] ?>; float:right; padding-right:10px;"><?PHP echo $eventInfo['rsvpPhone'] ?></span>
			</td>
		</tr>
		<!-- END TOP BAR -->
		
		<!-- LEFT COLUMN -->
		
			
		<tr>
			<!-- LOGO -->
			<td style="background-color:<?PHP echo $designInfo['leftBGColor'] ?>;"><a href="http://www.roadmaster.com"><img style="padding:10px;" src="http://mm.careerpathtraining.com/eventManager/emails/<?PHP echo $eventInfo['email'] ?>/emailLogo.jpg" border="0"></a></td>
			
			<!-- END LOGO -->
			
			<!-- EVENT NAME -->
			<td style="font-size:34px; text-align:center; font-weight:bold; background-color:<?PHP echo $designInfo['rightBGColor'] ?>;"><a style="color: <?PHP echo $designInfo['headlineColor'] ?>; text-decoration:none;" href="http://www.roadmaster.com/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>"><?PHP echo $eventInfo['eventName'] ?></a></td>
			<!-- END EVENT NAME -->
		</tr>
			
		
		<tr>
			<td rowspan="3" width="200" style="background-color:<?PHP echo $designInfo['leftBGColor'] ?>; vertical-align:top; padding-top:20px;">
			
			<!-- DATES & TIMES -->
			
			<?php if( !empty( $eventInfo['eventDate2DayName']  ) ): ?>
				<div style="background-color:<?PHP echo $designInfo['lightColor'] ?>; width:90%; margin:auto; font-size:12px; padding-top:10px; padding-bottom:10px; color:<?PHP echo $designInfo['darkColor'] ?>;">
					<h2 style="color:<?PHP echo $designInfo['headlineColor'] ?>; margin0; padding:0; padding-left:10px;">Event Dates & Times</h2>
					<ul style="list-style:none; font-size:14px; font-weight:bold; color:<?PHP echo $designInfo['darkColor'] ?>; padding-left:10px;">
						<?PHP echo "<li>" . $eventInfo['eventDate1DayName'] . ", " . $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] . " from<br> " .  $eventInfo['eventTime1Hour'] . ":" .  $eventInfo['eventTime1Minutes'] . " " . $eventInfo['eventTime1AMPM'] . " until " .  $eventInfo['eventTime1EndHour'] . ":" .  $eventInfo['eventTime1EndMinutes'] . " " . $eventInfo['eventTime1EndAMPM'] . "</li><br>" ?>
						
						<?php if( !empty( $eventInfo['eventDate2DayName']  ) ): ?>
							<?PHP echo "<li>" . $eventInfo['eventDate2DayName'] . ", " . $eventInfo['eventDate2Month'] . "/" . $eventInfo['eventDate2Day']  . "/" . $eventInfo['eventDate2Year'] . " from<br> " .  $eventInfo['eventTime2Hour'] . ":" .  $eventInfo['eventTime2Minutes'] . " " . $eventInfo['eventTime2AMPM'] . " until " .  $eventInfo['eventTime2EndHour'] . ":" .  $eventInfo['eventTime2EndMinutes'] . " " . $eventInfo['eventTime2EndAMPM'] . "</li><br>" ?>
						<?php endif; ?>
						
						<?php if( !empty( $eventInfo['eventDate3DayName']  ) ): ?>
							<?PHP echo "<li>" . $eventInfo['eventDate3DayName'] . ", " . $eventInfo['eventDate3Month'] . "/" . $eventInfo['eventDate3Day']  . "/" . $eventInfo['eventDate3Year'] . " from<br> " .  $eventInfo['eventTime3Hour'] . ":" .  $eventInfo['eventTime3Minutes'] . " " . $eventInfo['eventTime3AMPM'] . " until " .  $eventInfo['eventTime3EndHour'] . ":" .  $eventInfo['eventTime3EndMinutes'] . " " . $eventInfo['eventTime3EndAMPM'] . "</li><br>" ?>
						<?php endif; ?>
						
						<?php if( !empty( $eventInfo['eventDate4DayName']  ) ): ?>
							<?PHP echo "<li>" . $eventInfo['eventDate4DayName'] . ", " . $eventInfo['eventDate4Month'] . "/" . $eventInfo['eventDate4Day']  . "/" . $eventInfo['eventDate4Year'] . " from<br> " .  $eventInfo['eventTime4Hour'] . ":" .  $eventInfo['eventTime4Minutes'] . " " . $eventInfo['eventTime4AMPM'] . " until " .  $eventInfo['eventTime4EndHour'] . ":" .  $eventInfo['eventTime4EndMinutes'] . " " . $eventInfo['eventTime4EndAMPM'] . "</li><br>" ?>
						<?php endif; ?>
						
						<?php if( !empty( $eventInfo['eventDate5DayName']  ) ): ?>
							<?PHP echo "<li>" . $eventInfo['eventDate5DayName'] . ", " . $eventInfo['eventDate5Month'] . "/" . $eventInfo['eventDate5Day'] . "/" . $eventInfo['eventDate5Year'] . " from<br> " .  $eventInfo['eventTime5Hour'] . ":" .  $eventInfo['eventTime5Minutes'] . " " . $eventInfo['eventTime5AMPM'] . " until " .  $eventInfo['eventTime5EndHour'] . ":" .  $eventInfo['eventTime5EndMinutes'] . " " . $eventInfo['eventTime5EndAMPM'] . "</li><br>" ?>
						<?php endif; ?>
					</ul>
				</div><br>
			<?php endif; ?>
			
			<!-- END DATES & TIMES -->
			
			<!-- HIGHLIGHTS -->
			
			<?php if( !empty( $eventInfo['eventHighlight1']  ) ): ?>
				
				<div style="background-color:<?PHP echo $designInfo['lightColor'] ?>; width:90%; margin:auto; font-size:11px; padding-top:10px; padding-bottom:10px;">
					<h2 style="color:<?PHP echo $designInfo['headlineColor'] ?>; margin0; padding:0; padding-left:10px;">Highlights</h2>
					<ul style="font-size:14px; font-weight:bold; color:<?PHP echo $designInfo['darkColor'] ?>;">
						
						<?php if( !empty( $eventInfo['eventHighlight1']  ) ): ?>
							<li><?PHP echo $eventInfo['eventHighlight1'] ?></li><br>
						<?php endif; ?>
						
						<?php if( !empty( $eventInfo['eventHighlight2']  ) ): ?>
							<li><?PHP echo $eventInfo['eventHighlight2'] ?></li><br>
						<?php endif; ?>
							
						<?php if( !empty( $eventInfo['eventHighlight3']  ) ): ?>	
							<li><?PHP echo $eventInfo['eventHighlight3'] ?></li><br>
						<?php endif; ?>
							
						<?php if( !empty( $eventInfo['eventHighlight4']  ) ): ?>	
							<li><?PHP echo $eventInfo['eventHighlight4'] ?></li><br>
						<?php endif; ?>
							
						<?php if( !empty( $eventInfo['eventHighlight5']  ) ): ?>	
							<li><?PHP echo $eventInfo['eventHighlight5'] ?></li><br>
						<?php endif; ?>
						
						<?php if( !empty( $eventInfo['eventHighlight6']  ) ): ?>	
							<li><?PHP echo $eventInfo['eventHighlight6'] ?></li>
						<?php endif; ?>
					</ul>
				</div><br>
				
				<?php endif; ?>
				<!-- END HIGHLIGHTS -->
				
				<!-- BEGIN MORE INFO LINKS -->
				
				<div style="background-color:<?PHP echo $designInfo['lightColor'] ?>; width:90%; margin:auto; font-size:12px; padding-top:10px; padding-bottom:10px;">
					<h2 style="color:<?PHP echo $designInfo['headlineColor'] ?>; margin0; padding:0; padding-left:10px;">More Information</h2>
					<ul style="font-size:14px; font-weight:bold; color:<?PHP echo $designInfo['darkColor'] ?>;">
					
					<li><a style="color:<?PHP echo $designInfo['darkColor'] ?>;" href="http://www.roadmaster.com/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>">RSVP & More Information</a></li><br>
					
						<li><a href="http://maps.google.com/maps?daddr=<?PHP echo $eventInfo['eventLocAdd1'] ?>+<?PHP echo $eventInfo['eventLocAdd2'] ?>+<?PHP echo $eventInfo['eventLocCity'] ?>+<?PHP echo $eventInfo['eventLocState'] ?>+<?PHP echo $eventInfo['eventLocZip'] ?>" style="color:<?PHP echo $designInfo['darkColor'] ?>;">Event Directions</a></li><br>
						<li><a href="http://www.roadmaster.com/<?PHP echo $schoolInfo['schoolURL'] ?>" style="color:<?PHP echo $designInfo['darkColor'] ?>;">School Website</a></li><br>
						<li><a target="_blank" href="http://do.convertapi.com/web2pdf?curl=http://www.roadmaster.com/eventmanager/flyers/<?PHP echo $eventInfo['flyer']; ?>/flyer.php?eventID=<?PHP echo $eventInfo['id']; ?>&PageOrientation=<?PHP echo $flyerInfo['orientation']; ?>&OutputFileName=EventFlyer&MarginTop=0&MarginBottom=0&MarginLeft=0&MarginRight=2&PageSize=letter&ApiKey=225522257" style="color:<?PHP echo $designInfo['darkColor'] ?>;">Save Flyer as PDF</a></li>
					</ul>
				</div><br><br>		
				
				<!-- END MORE INFO LINKS -->	
			</td>
			<!-- END LEFT COLUMN -->
			
			<!-- BEGIN RIGHT COLUMN -->
			
			<td style="padding:10px; background-color:<?PHP echo $designInfo['rightBGColor'] ?>;">
			
			<?php if( empty( $eventInfo['eventDate2DayName']  ) ): ?>		
				<div style="font-size:32px; color:<?PHP echo $designInfo['darkColor'] ?>; text-align:center; width:100%; font-weight:bold;"><?PHP echo $eventInfo['eventDate1DayName'] . ", " . $eventInfo['eventDate1Month'] . "/" . $eventInfo['eventDate1Day'] . "/" . $eventInfo['eventDate1Year'] ."<br>from " .  $eventInfo['eventTime1Hour'] . ":" . $eventInfo['eventTime1Minutes'] . $eventInfo['eventTime1AMPM'] . " until " . $eventInfo['eventTime1EndHour'] . ":" . $eventInfo['eventTime1EndMinutes'] . $eventInfo['eventTime1EndAMPM'] ?></div><br>
			<?php endif; ?>
				
				<div align="center"><a href="http://www.roadmaster.com/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>"><img border="0" src="http://mm.careerpathtraining.com/eventManager/emails/<?PHP echo $eventInfo['email'] ?>/emailPic.jpg"></a></div>
			</td>
		</tr>
		
		<tr>
			<td align="center" style="padding:10px;background-color:<?PHP echo $designInfo['rightBGColor'] ?>;"><div style="font-size:18px; color:<?PHP echo $designInfo['darkColor'] ?>; text-align:center; width:100%;"><?PHP echo nl2br($eventInfo['eventDesc']) ?></div></td>
		</tr>
		
		<tr>
			<td colspan="2" style="text-align:center; vertical-align:top; padding-top:20px; padding-bottom:20px; background-color:<?PHP echo $designInfo['rightBGColor'] ?>;"><a style="text-decoration:none; font-size:26px; color: <?PHP echo $designInfo['headlineColor'] ?>; font-weight:bold;" href="http://www.roadmaster.com/MM/MM-event-view.php?eventID=<?PHP echo $eventInfo['id'] ?>">Click Here to Reserve Your Spot</a><span style="text-decoration:none; font-size:26px; color: <?PHP echo $designInfo['headlineColor'] ?>; font-weight:bold;"><br>or<br>Call <?PHP echo $eventInfo['rsvpPhone'] ?></span><br><br>
			<a href="http://maps.google.com/maps?daddr=<?PHP echo $eventInfo['eventLocAdd1'] ?>+<?PHP echo $eventInfo['eventLocAdd2'] ?>+<?PHP echo $eventInfo['eventLocCity'] ?>+<?PHP echo $eventInfo['eventLocState'] ?>+<?PHP echo $eventInfo['eventLocZip'] ?>" style="color:<?PHP echo $designInfo['darkColor'] ?>;"><img border="1" src="http://maps.googleapis.com/maps/api/staticmap?center=<?PHP echo $eventInfo['eventLocAdd1'] ?>+<?PHP echo $eventInfo['eventLocAdd2'] ?>+<?PHP echo $eventInfo['eventLocCity'] ?>+<?PHP echo $eventInfo['eventLocState'] ?>+<?PHP echo $eventInfo['eventLocZip'] ?>&markers=color:red%7Clabel:%7C<?PHP echo $eventInfo['eventLocAdd1'] ?>+<?PHP echo $eventInfo['eventLocAdd2'] ?>+<?PHP echo $eventInfo['eventLocCity'] ?>+<?PHP echo $eventInfo['eventLocState'] ?>+<?PHP echo $eventInfo['eventLocZip'] ?>&zoom=15&size=450x250&maptype=roadmap&sensor=false" alt="Event Location" /></a><br><br>
				<div style="font-size:24px; color: <?PHP echo $designInfo['darkColor'] ?>; text-align:center; width:100%;">
				<?php if( !empty( $eventInfo['eventLocationName']  ) ): ?>
					<?PHP echo $eventInfo['eventLocationName'] ?><br>
				<?php endif; ?>
				
				<?PHP echo $eventInfo['eventLocAdd1'] ?>
				<?php if( !empty( $eventInfo['eventLocAdd2']  ) ): ?>
					<?PHP echo " | " . $eventInfo['eventLocAdd2'] ?>
				<?php endif; ?>
				<br><?PHP echo $eventInfo['eventLocCity'] ?>, <?PHP echo $eventInfo['eventLocState'] ?> <?PHP echo $eventInfo['eventLocZip'] ?></div><br>
			</td>
			
			<!-- END RIGHT COLUMN -->
		</tr>
		
		<!-- BEGIN BOTTOM BAR -->
		<tr><td colspan="2" height="40" style="background-color:<?PHP echo $designInfo['darkColor'] ?>;" align="center">
		
		<span style="padding-right:30px;"><a style="color:<?PHP echo $designInfo['lightColor'] ?>; text-decoration:none; font-size:14px; vertical-align:middle;" href="http://www.facebook.com/RoadmasterDriversSchool"><img align="middle" src="http://mm.careerpathtraining.com/eventManager/emails/general/facebook.png" style="padding-left:10px; padding-right:10px;" border="0">Like us on Facebook</a></span>

<span style="padding-right:30px;"><a style="color:<?PHP echo $designInfo['lightColor'] ?>; text-decoration:none; font-size:14px; vertical-align:middle;" href="http://twitter.com/RoadmasterCDL"><img align="middle" src="http://mm.careerpathtraining.com/eventManager/emails/general/twitter.png" style="padding-left:10px; padding-right:10px;" border="0">Follow us on Twitter</a></span>

<span><a style="color:<?PHP echo $designInfo['lightColor'] ?>; text-decoration:none; font-size:14px; vertical-align:middle;" href="http://www.youtube.com/roadmastercdl"><img align="middle" src="http://mm.careerpathtraining.com/eventManager/emails/general/youtube.png" style="padding-left:10px; padding-right:10px;" border="0">Watch us on YouTube</a></span>

			</td></tr>
			<!--END BOTTOM BAR -->
		
		</table>
	</body>
</html>

<?php include("../../inc/dbClose.php"); ?>