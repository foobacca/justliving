<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>

<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; Categories</h1>

<h2><a href="add.php">Add New Category</a></h2>

<h2><a href="order.php">Change the order of the categories</a></h2>

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



<?php
abotbit();
?>
