<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Just Living - Print Text</title>
<style type="text/css" media="all"></style>
</head>
<body>
<?php

// Get the cats
$result = mysql_query("SELECT id, name, introduction FROM categories WHERE id = $id ORDER BY seq");
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		//print("<h1>" . $myrow["name"] . "</h1>");
		print("<h2>" . strip_tags($myrow["introduction"]) ."</h2>");

		// Get all listing for a cat
		$sql = "SELECT add_ts, edit_ts, org_name, address, postcode, email, website, phone, description FROM listings WHERE (state = 'justliving' OR state = 'signed off') AND cat_id = " . $myrow["id"] . " ORDER BY org_name";
		$result2 = mysql_query($sql);

		if ($myrow2 = mysql_fetch_array($result2)) 
			{
			do 
				{
				print("<h3>" . clean_text($myrow2["org_name"]) . "</h3>\n");
				if ($myrow2["address"])
					{
					print("<h4>" . $myrow2["address"] . " " . $myrow2["postcode"] . "</h4>\n");
					}
				if ($myrow2["email"])
					{
					print("<h4>=e= " . $myrow2["email"] . "</h4>\n");
					}
				if ($myrow2["website"])
					{
					print("<h4>=w= " . $myrow2["website"] . "</h4>\n");
					}
				if ($myrow2["phone"])
					{
					print("<h4>=t= " . $myrow2["phone"] . "</h4>\n");
					}
				print("<p>" . $myrow2["description"] . "</p>\n");
				} while ($myrow2 = mysql_fetch_array($result2));
			}
			
		} while ($myrow = mysql_fetch_array($result));
	}

?>
</body>
</html>