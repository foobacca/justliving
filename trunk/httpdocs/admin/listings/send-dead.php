<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();

$result = mysql_query("SELECT email, id FROM `listings` WHERE email != '' AND email IS NOT NULL ");

if ($lmyrow = mysql_fetch_array($result))
{
	do
	{
		$mail_to='michael@decisiontrees.net';
                $mail_from=$organise_email;
		$mail_sub='test';
		$mail_mesg=$txtMsg;
		
		if(mail($mail_to,$mail_sub,$mail_mesg,"From:$mail_from/r/nReply-to:$mail_from"))
		echo "<span class='textred'>E-mail has been sent successfully from $mail_sub to $mail_to</span>";
		else
		echo "<span class='textred'>Failed to send the E-mail from $mail_sub to $mail_to</span>";

	} while ( $lmyrow = mysql_fetch_array($result) );
}

?>
