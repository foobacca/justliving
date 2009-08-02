<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>

<h1><a href="/admin/">Just Living Admin</a> &gt; Categories</h1>

<h2>Choose a category to edit:</h2>
<ul>
<?php
$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		print("<li><a href=\"edit.php?id=" . $myrow["id"] . "\">" . $myrow["name"] . "</a></li>\n");
		} while ($myrow = mysql_fetch_array($result));
	}	
?>
</ul>

<p>Categories are easily added / edited, but it's a bit of a  'geek job', so add suggested changes to a Just Living meeting agenda.</p>

<?php
abotbit();
?>