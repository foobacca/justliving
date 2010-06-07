<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; Big Text Area Spell Check</h1>

<h2>Backup of listings table</h2>
<p>At the moment this is manual, via phpmyadmin... will work on a site wide back up thing sometime, before we start handing out this code to other groups.</p>

<?php
// Have they just submitted from a preview page?
if (request("update","post"))
	{
	// Get vars
	$total_number_listing = request("total_number_listing","post");
	
	print("<h2>Text Areas Updated</h2>");
	print("<p>Date / Time: " . date("Y-m-d-H-i-s") . "</p>");
	print("<p>Number of listings: $total_number_listing</p>");
	print("<p>IDS: ");
	// Run through descriptions and update the listings
	$n = 1;
	while ($n <= $total_number_listing)
		{
		// Get the details for one listing
		$id = request("id_$n","post");
                settype($id, 'integer');
		$description = request("description_$n","post");
		
		// Debug
		//print("<p>$id: $description</p>");
		print("$id. ");
		
		// Update the listing...
		$sql = "UPDATE listings SET description = '$description' WHERE id = '$id'";
		$result = mysql_query($sql);
		
		$n++;
		}
	print("... <strong>DONE.</strong></p>");
	}
?>


<h2>Edit Text Areas</h2>

<p>These are all the 'descriptions' from listings set to go into print ('Live - needs work' or 'Live - ready to go'). You should be able to use 'Firefox spell check' to check lots of typos. Correct them and then save all the bastards at the same time. That's the theory anyway.</p>

<form method="post" action="textareaspellcheck.php">
	

<?php
$sql = "SELECT id, org_name, description FROM listings WHERE state = 'signed off' OR state = 'justliving' ORDER BY org_name";
$result = mysql_query($sql);
$number_listing = 1;

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		?>
		<fieldset>
		<?php
		print("<input name=\"id_$number_listing\" type=\"hidden\" value=\"" . $myrow["id"] . "\" />");
		?>
		<legend><?php print($myrow["org_name"]); ?></legend>
		<input type="submit" name="update" class="submit" value="Update All Listings" style="float: right;" />
		<textarea cols="80" rows="20" name="description_<?php print($number_listing); ?>" id="description_<?php print($number_listing); ?>"><?php print($myrow['description']); ?></textarea>
		</fieldset>
		<?php
		$number_listing++;
		} while ($myrow = mysql_fetch_array($result));
	}
	
print("<input name=\"total_number_listing\" type=\"hidden\" value=\"$number_listing\" />");
?>

</form>

<?php
abotbit();
?>
