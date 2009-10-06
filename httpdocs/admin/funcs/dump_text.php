<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; Dump text for spell check</h1>
<?php
	
// Get the index
$sql = "SELECT id, org_name, description FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{

		
		print(clean_text($myrow["org_name"]) . "<br />");
		print(clean_text($myrow["description"]) . "<br /><br />");

		} while ($myrow = mysql_fetch_array($result));
	}

abotbit();
?>