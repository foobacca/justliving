<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">Categories</a> &gt; Change Category Order</h1>
<?php

// Have they just submitted from a preview page?
if (request("total_number_category","post"))
	{
	// Get vars
	$total_number_category = request("total_number_category","post");
	
	print("<h2>Category Order Updated</h2>");
	print("<p>Date / Time: " . date("Y-m-d-H-i-s") . "</p>");
	print("<p>Number of categories: $total_number_category</p>");
	// Run through descriptions and update the listings
	$n = 1;
	while ($n <= $total_number_category)
		{
		// Get the details for one listing
		$id = request("id_$n","post");
		$seq = request("seq_$n","post");
		
		// Update the listing...
		$sql = "UPDATE categories SET seq = '$seq' WHERE id = $id";
		$result = mysql_query($sql);
		
		$n++;
		}
	}
?>

<h2>Set the order of the categories</h2>

<p>Set the 'seq' numbers and save to see the new sequence.
</p>

<form method="post" action="order.php">
        <table>
        <tr><th>Category Name</th><th>Sequence Number</th></tr>

<?php
$sql = "SELECT id, name, seq FROM categories ORDER BY seq";
$result = mysql_query($sql);
$number_category = 1;


if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
                  print("<tr><td><input name=\"id_" . $number_category . "\" type=\"hidden\" value=\"" . 
                    $myrow["id"] . "\" /> " . $myrow["name"] . "</td>");
                  print("<td><input type=\"text\" name=\"seq_" . $number_category . "\" value=\"" . 
                    $myrow["seq"] . "\" /></td></tr>");
                  $number_category++;
		} while ($myrow = mysql_fetch_array($result));
	}
	
print("</table>");
print("<input name=\"total_number_category\" type=\"hidden\" value=\"$number_category\" />");
?>

	<input type="submit" name="order" class="submit" value="Update Order of Categories" />
		
	</form>

<?php
	
abotbit();
?>

