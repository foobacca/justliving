<?php
@(include("config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit();

$id = request("id");
if (!$id)
	{
	?>

	<h2><?php print $guide_name; ?> News</h2>
	<p>Things move quickly sometimes, slower at others... Just what have we been up to?</p>

	<ul>
	<?php
	$result = mysql_query("SELECT id, headline, date FROM news ORDER BY date DESC"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			print("<li><strong>" . date("jS F y",$myrow["date"]) . "</strong><br /><a href=\"" . $app_path . "news.php?id=" . $myrow["id"] . "\">" . $myrow["headline"] . "</a></li>\n");
			} while ($myrow = mysql_fetch_array($result));
		}	
	?>
	</ul>
		
	<?php
	
	}
else
	{
        settype ($id, 'integer');
	$result = mysql_query("SELECT headline, date, article FROM news WHERE id = $id"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		print("<h2>" . $myrow["headline"] . "</h2>\n");
		print("<p><strong><span class=\"date\">" . date("jS F Y",$myrow["date"]) . "</span></strong></p>");
		print(autop($myrow["article"]));
		print("<ul><li><a href=\"" . $app_path . "news.php\"><strong>" . $guide_name . " News Archive</strong></a></li></ul>");
		}	
	}

botbit();
?>
