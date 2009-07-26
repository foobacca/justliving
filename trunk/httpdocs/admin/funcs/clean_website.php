<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Clean Up: Website</h1>

<p>This script will remove any 'http://' from the start of the website field.</p>

<table>
<?php
$sql = "SELECT id, org_name, website FROM listings ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{

		if ($myrow["website"])
			{
			print("<tr><td><strong><a href=\"/admin/listings/edit.php?id=" . $myrow["id"] . "\">" . clean_text($myrow["org_name"]) . "</a></strong></td><td>" . clean_text($myrow["website"]) . "</td>");
			
			$myrow["website"] = trim($myrow["website"]);
			
			// Check for 'http://' at the start...
			if (substr ($myrow["website"],0 ,7) == "http://")
				{
				// Chop of the first 7 characters
				$myrow["website"] = substr($myrow["website"],7);
				
				// Update the entry
				mysql_query("UPDATE listings SET website = '" . $myrow["website"] . "' WHERE id = " . $myrow["id"]);
			
				print("<td><strong>" . $myrow["website"] . "</strong></td>");
				}
			else
				{
				print("<td></td>");
				}
			
			print("</tr>");
			}

		} while ($myrow = mysql_fetch_array($result));
	}

?>
</table>
<?php
abotbit();
?>