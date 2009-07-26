<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Format Check: Address</h1>

<p>Only displays listings set to go into print ('Live - needs work' or 'Live - ready to go').</p>

<table>
<?php

$sql = "SELECT id, org_name, address FROM listings WHERE state = 'signed off' OR state = 'justliving' ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{

		if ($myrow["address"])
			{
			print("<tr><td><strong><a href=\"/admin/listings/edit.php?id=" . $myrow["id"] . "\">" . clean_text($myrow["org_name"]) . "</a></strong></td><td>" . nl2br(clean_text($myrow["address"])) . "</td></tr>");
			}

		} while ($myrow = mysql_fetch_array($result));
	}

?>
</table>
<?php
abotbit();
?>