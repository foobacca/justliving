<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>

<h1><a href="/admin/">Just Living Admin</a> &gt; Populate new categories table</h1>

<?php
// Delete all from the listings categories table
$sql = "DELETE FROM listings_categories";
$result = mysql_query($sql);
print("<p>categories_listings data deleted</p>");

// Go through all listings, get cat, add relevant row into table
$result = mysql_query("SELECT id, cat_id, org_name FROM listings ORDER BY org_name");
if ($myrow = mysql_fetch_array($result))
	{
	do
		{
		if ($myrow[cat_id])
			{
			mysql_query("INSERT INTO listings_categories (listing_id, category_id) VALUES ('" . $myrow[id] . "', '" . $myrow[cat_id] . "')");
			}
		print("<p>" . $myrow[org_name] . " done</p>");
		} while ($myrow = mysql_fetch_array($result));
	}

abotbit();
?>