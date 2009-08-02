<?php
@(include("config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit($css_path, 2);
?>

<div id="rightcol">

<h3>New Stuff</h3>

<?php
// Get any new additions, updates to previous editions and news... Order by date?
// Story in 'latest' array, with ID, whats it is and timestamp

// Get the latest 5 additions
$result = mysql_query("SELECT id, add_ts FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY add_ts DESC LIMIT 0,7");
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		$latest[$myrow['id'] . "-add"] = $myrow['add_ts'];
		$additions[] = $myrow['id'];
		} while ($myrow = mysql_fetch_array($result));
	}
	
// Get the latest 5 updates
$result = mysql_query("SELECT id, edit_ts FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY edit_ts DESC LIMIT 0,14");
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		if (in_array($myrow['id'], $additions))
			{
			}
		else
			{
			$latest[$myrow['id'] . "-edit"] = $myrow['edit_ts'];
			}
		} while ($myrow = mysql_fetch_array($result));
	}
	
// Get the latest 5 news articles
$result = mysql_query("SELECT id, date FROM news ORDER BY date DESC LIMIT 0,7"); 
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		$latest[$myrow['id'] . "-news" ] = $myrow['date'];
		} while ($myrow = mysql_fetch_array($result));
	}	

// Order latest array by date
arsort($latest);

// Setup $printed array
$printed[] = 0;

// Run through array, print the latest 5 items...
$n = 0;
foreach ($latest as $key=>$value)
	{
	
	// Only print 7 entries
	if ($n == 7)
		{
		break;
		}
		
	// Split the value into id and type
	$pieces = explode("-", $key);
	$id = $pieces[0];
	$type = $pieces[1];
	
	print("<p>");
	
	// Print date
	print("<span class=\"date\">" . date("jS M 'y",$value) . "</span><br />");
	// Print type
	if ($type == "add")
		{
		print("<strong>New  Listing:</strong> ");
		}
	elseif ($type == "edit")
		{
		print("<strong>Updated:</strong> ");
		}
	elseif ($type == "news")
		{
		print("<strong>News:</strong> ");
		}
	// Get the relevant details and print
	if ($type == "add")
		{
		$result = mysql_query("SELECT org_name, cat_id FROM listings WHERE id = $id");
		if ($myrow = mysql_fetch_array($result)) 
			{
			print("<a href=\"/guide/view.php?id=" . $id . "&amp;cat=" . $myrow["cat_id"] . "\">" . $myrow["org_name"] . "</a></p>\n");
			$printed[] = $id;
			}
		}
	elseif ($type == "edit")
		{
		$result = mysql_query("SELECT org_name, cat_id FROM listings WHERE id = $id");
		if ($myrow = mysql_fetch_array($result)) 
			{
			print("<a href=\"/guide/view.php?id=" . $id . "&amp;cat=" . $myrow["cat_id"] . "\">" . $myrow["org_name"] . "</a></p>\n");
			$printed[] = $id;
			}
		}
	elseif ($type == "news")
		{
		$result = mysql_query("SELECT headline FROM news WHERE id = $id"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			print("<a href=\"/news.php?id=" . $id . "\">" . htmlentities($myrow["headline"]) . "</a></p>\n");
			$printed[] = $id;
			}	
		}

	$n++;
		
	}

?>
</div>

<h2>A Proper Positive Guide to Cambridge</h2>

<p class="intro" style="width: 70%">This is a directory of various socially responsible organisations in the Cambridge area, from shops to campaigning groups. We hope it's useful and of interest to newcomers and long-term residents alike.</p>

<?php
guide_index();

botbit();
?>