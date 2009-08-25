<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");

// Category listing
if ($cat_id = request("cat_id","get"))
	{
	$result = mysql_query("SELECT name, introduction FROM categories WHERE id = $cat_id");
	if ($myrow = mysql_fetch_array($result)) 
		{
		$cat_name = $myrow["name"];
		$cat_intro = $myrow["introduction"];
		}
		
	// Topbit
	topbit(2, $guide_name ." - " . $cat_name);
	
	// Get all listing for a cat
	$sql = "SELECT l.id, l.org_name, l.description FROM listings l, listings_categories lc WHERE l.id = lc.listing_id AND (l.state = 'justliving' OR l.state = 'signed off') AND lc.category_id = $cat_id ORDER BY l.org_name";
	}
	
// Is it 'most recent' listing?
elseif (request("recent","get"))
	{
	topbit(2, "$guide_name - Recent Listings");
	$cat_name = "Recent Listings";
	$cat_intro = "The latest 30 additions to the $guide_name guide.";
	// Get most recent
	$sql = "SELECT id, org_name, add_ts, state, description FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY add_ts DESC LIMIT 0,30";
	}
	
// Is it an all listing?
else
	{
	topbit(2, "All $guide_name Listings");
	// Get all
	$sql = "SELECT id, org_name, add_ts, state, description FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY org_name";
	}

// Page Title 
print("<h2 class=\"center\">$cat_name</h2>\n");

// If we've got an 'introduction', print it...
if ($cat_intro)
	{
	print("<p class=\"intro center\">" . nl2br($cat_intro) . "</p>\n");
	}

// Print the category list
print("<p class=\"center\">");
jl_cat_list($cat_id);
print("</p>\n");

// Run the SQL
$result = mysql_query($sql);
	
print("\n\n<div id=\"list\">\n");

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		print("<a href=\"view.php?id=" . $myrow["id"] . "&amp;cat=$cat_id\" class=\"block_link listing\">");
		print("<h3 style=\"text-decoration: underline;\">" . clean_text($myrow["org_name"]) . "</h3>\n");
		print("<p style=\"color: black; text-decoration: none;\">" . abstract($myrow["description"]) . "</p>\n");
		print("</a>\n\n");
		} while ($myrow = mysql_fetch_array($result));
	}
	
print("\n\n</div>\n\n");

print("<ul>");

// Print the category list
print("<p class=\"center\">");
jl_cat_list($cat_id);
print("</p>\n");

// Submit line
print("<p class=\"center\" style=\"margin: 20px 0 0 0;\"><a href=\"submit.php\" class=\"submit\">Submit listing</a>\n");

botbit();
?>
