<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Dump text for spell check</h1>
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