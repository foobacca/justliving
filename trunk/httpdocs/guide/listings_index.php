<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(2, "Just Living - Listings Index");

print("<h2>Listings Index</h2>");
$sql = "SELECT id, org_name, email, website, phone FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY org_name";
	
// Run the SQL
$result = mysql_query($sql);
	
// Table
print("<ul>");

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		print("<li><strong><a href=\"view.php?id=" . $myrow["id"] . "\">" . clean_text($myrow["org_name"]) . "</a></strong>");
		print("</li>\n");
		} while ($myrow = mysql_fetch_array($result));
	}
	
print("</ul>");

print("<p>Something missing? Then <a href=\"submit.php\">submit the details</a> and we'll do the rest.</p>");

botbit();
?>
