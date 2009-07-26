<?php
if (substr($_SERVER["HTTP_HOST"], 0, 4) == "www.")
	{
	$domain = substr($_SERVER["HTTP_HOST"], 4);
	}
else
	{
	$domain = $_SERVER["HTTP_HOST"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<title><?php print($_SERVER["HTTP_HOST"]); ?> Website Statistics</title>

<style type="text/css" media="all">
body	{
	margin: 20px;
	padding: 0;
	color: #000;
	font: small/1.6 "Trebuchet MS", "Bitstream Vera Sans", Verdana, Helvetica, sans-serif;
	background: #fff;
	}
	
</style>

</head>
<body>

<?php

print("<h1>$domain  Website Statistics</h1>");
print("<ul>\n");

// Get all the years
$dir = substr($_SERVER["SCRIPT_FILENAME"], 0, -9) . "stats";
$dh = opendir($dir);
while (gettype($f = readdir($dh)) != boolean)
	{
	if ($f != "." AND $f != "..")
		{
		$years[] = $f;
		}
	}
closedir($dh);

// Order the years
rsort($years);

// Run through each year and get the months
foreach ($years as $year)
	{
	$dir = substr($_SERVER["SCRIPT_FILENAME"], 0, -9) . "stats/" . $year;
	$dh = opendir($dir);
	while (gettype($f = readdir($dh)) != boolean)
		{
		if ($f != "." AND $f != "..")
			{
			$months[] = $f;
			}
		}
	closedir($dh);
	
	// Order the months
	rsort($months);
	
	// Print out the links
	foreach ($months as $month)
		{
		if ($month == "01")
			{
			$nice_month = "January";
			}
		elseif ($month == "02")
			{
			$nice_month = "Febuary";
			}
		elseif ($month == "03")
			{
			$nice_month = "March";
			}
		elseif ($month == "04")
			{
			$nice_month = "April";
			}
		elseif ($month == "05")
			{
			$nice_month = "May";
			}
		elseif ($month == "06")
			{
			$nice_month = "June";
			}
		elseif ($month == "07")
			{
			$nice_month = "July";
			}
		elseif ($month == "08")
			{
			$nice_month = "August";
			}
		elseif ($month == "09")
			{
			$nice_month = "September";
			}
		elseif ($month == "10")
			{
			$nice_month = "October";
			}
		elseif ($month == "11")
			{
			$nice_month = "November";
			}
		elseif ($month == "12")
			{
			$nice_month = "December";
			}
		print("<li><a href=\"stats/$year/$month/awstats.$domain.html\">$nice_month $year Statistics</a></li>\n");
		}
	
	
	// Clear the array
	unset($months);	
	
	}

print("</ul>\n");

?>
</body>
</html>