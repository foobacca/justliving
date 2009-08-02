<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($app_path, );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Just Living - Print Text</title>
<style type="text/css" media="all"></style>
</head>
<body>

<h1><a href="/admin/">Just Living Admin</a> &gt; Print Functions</h1>

<h2>Odd Scripts</h2>

<ul>
<li><a href="all_listings.php">New All Listings</a></li>
<li><a href="listings_index.php">Listings Index</a>
</ul>

<h2>By Category</h2>

<?php

// Get the cats
$result = mysql_query("SELECT id, name, introduction FROM categories ORDER BY seq");
if ($myrow = mysql_fetch_array($result)) 
	{
	print("<ul>");
	do 
		{
		print("<li><a href=\"category_listings.php?id=" . $myrow["id"] . "\">" . $myrow["name"] . "</a></li>");
		} while ($myrow = mysql_fetch_array($result));
	print("</ul>");
	}
?>

<h2>'See Also' Category Links</h2>

<?php

// Get the cats
$result = mysql_query("SELECT id, name, introduction FROM categories ORDER BY seq");
if ($myrow = mysql_fetch_array($result)) 
	{
	print("<ul>");
	do 
		{
		print("<li><a href=\"see_also.php?id=" . $myrow["id"] . "\">" . $myrow["name"] . "</a></li>");
		} while ($myrow = mysql_fetch_array($result));
	print("</ul>");
	}
?>

<?php
abotbit();
?>
