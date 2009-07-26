<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Email Dump</h1>

<p>This page currently just lists emails from 'live - in need of some work'.</p>

<p>
<?php
	
// Get the index
//$sql = "SELECT id, org_name, email, website, phone FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY org_name";
$sql = "SELECT id, org_name, email, website, phone FROM listings WHERE (state = 'justliving') ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{

		if ($myrow["email"])
			{
			print(clean_text($myrow["email"]) . ", ");
			}
		else
			{
			$no_email[$myrow["id"]] =  clean_text($myrow["org_name"]);
			}

		} while ($myrow = mysql_fetch_array($result));
	}

print("</p>");

if (is_array($no_email))
	{
	foreach($no_email as $key => $value)
		{
		print("<a href=\"/admin/listings/edit.php?id=$key\">$value</a><br />");
		}
	}
else
	{
	print("<p>Nice work, they've all got some gubbins in the email field.</p>");
	}
	
abotbit();
?>