<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();

$result = mysql_query("SELECT email, id FROM `listings` WHERE email != '' AND email IS NOT NULL ");

if ($lmyrow = mysql_fetch_array($result))
{
	do
	{
		$mail_to='michael@decisiontrees.net';
		$mail_from='organise@justliving.org.uk';
		$mail_sub='test';
		$mail_mesg=$txtMsg;
		
		if(mail($mail_to,$mail_sub,$mail_mesg,"From:$mail_from/r/nReply-to:$mail_from"))
		echo "<span class='textred'>E-mail has been sent successfully from $mail_sub to $mail_to</span>";
		else
		echo "<span class='textred'>Failed to send the E-mail from $mail_sub to $mail_to</span>";

	} while ( $lmyrow = mysql_fetch_array($result) );
}

?>