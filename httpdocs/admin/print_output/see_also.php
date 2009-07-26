<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Just Living - 'See Also' Category Links</title>
<style type="text/css" media="all"></style>
</head>
<body>

<?php
$sql = "SELECT l.add_ts, l.edit_ts, l.org_name, l.address, l.postcode, l.email, l.website, l.phone, l.description FROM listings l, listings_categories lc WHERE l.id = lc.listing_id AND (l.state = 'justliving' OR l.state = 'signed off') AND lc.category_id = " . $id . " AND l.cat_id != $id ORDER BY l.org_name";
$result2 = mysql_query($sql);

if ($myrow2 = mysql_fetch_array($result2)) 
	{
	do 
		{
		print("<h5>" . clean_text($myrow2["org_name"]) . " p. </h5>\n");
		} while ($myrow2 = mysql_fetch_array($result2));
	}
	
?>
</body>
</html>