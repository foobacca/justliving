<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Just Living - Print Index</title>
<style type="text/css" media="all"></style>
</head>
<body>
<?php
	
// Get the index
$sql = "SELECT org_name, email, website, phone FROM listings WHERE (state = 'justliving' OR state = 'signed off') ORDER BY org_name";
$result2 = mysql_query($sql);

if ($myrow2 = mysql_fetch_array($result2)) 
	{
	do 
		{
		print("<p><strong>" . clean_text($myrow2["org_name"]) . "</strong>");
		
		if ($myrow2["phone"])
			{
			print(" " . clean_text($myrow2["phone"]) . "");
			}
		elseif ($myrow2["email"])
			{
			print(" " . clean_text($myrow2["email"]) . "");
			}
		elseif ($myrow2["website"])
			{
			print(" " . clean_text($myrow2["website"]) . "");
			}
			
		print("Page ");
		
		print("</p>\n");
		} while ($myrow2 = mysql_fetch_array($result2));
	}


?>
</body>
</html>