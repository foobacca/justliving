<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Format Check: Phone</h1>

<p>Only displays listings set to go into print ('Live - needs work' or 'Live - ready to go').</p>

<table>
<?php

$sql = "SELECT id, org_name, phone FROM listings WHERE state = 'signed off' OR state = 'justliving' ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{

		if ($myrow["phone"])
			{
			print("<tr><td><strong><a href=\"/admin/listings/edit.php?id=" . $myrow["id"] . "\">" . clean_text($myrow["org_name"]) . "</a></strong></td><td>" . clean_text($myrow["phone"]) . "</td></tr>");
			}

		} while ($myrow = mysql_fetch_array($result));
	}

?>
</table>
<?php
abotbit();
?>