<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($css_path, );
?>

<h1><a href="/admin/">Just Living Admin</a> &gt; News</h1>

<h2>View &amp; Edit News Articles</h2>
<ul>
<li><h3><a href="edit.php">Add News Article</a></h3></li>
</ul>

<h2>All News Articles</h2>
<ul>
<?php
$result = mysql_query("SELECT id, headline, date FROM news ORDER BY date DESC"); 
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		print("<li>" . date("jS F y",$myrow["date"]) . " &gt; <a href=\"edit.php?id=" . $myrow["id"] . "\">" . $myrow["headline"] . "</a></li>\n");
		} while ($myrow = mysql_fetch_array($result));
	}	
?>
</ul>

<?php
abotbit();
?>