<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">Categories</a> &gt; Delete</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
	$id  = request("id","post");
	
	// Delete the category
	$sql = "DELETE FROM categories WHERE id = $id";
	$result = mysql_query($sql);
			
	// Also delete the relevant items from the listings_categories table
	$sql = "DELETE FROM listings_categories WHERE category_id = $id";
	$result = mysql_query($sql);
			
	// Message
	print("<h2>Category Deleted</h2><p>Back to the <a href=\"index.php\">Categories List</a>.</p>");
	}
else
	{
        $id = request("id");
	$result = mysql_query("SELECT name FROM categories WHERE id = $id"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		$name = $myrow["name"];
		}
	?>
	<form method="post" action="delete.php">
		
	<fieldset>
	<legend>Delete Category: <?php print($name); ?></legend>

        <?php
        $query = "SELECT listing_id FROM listings_categories WHERE category_id = $id";
        $result = mysql_query($query);
        if ($myrow = mysql_fetch_array($result)) 
        {
          print ("<p>The $name category contains the following listings:</p><ul>");
          do 
          {
            $listing_query = "SELECT org_name FROM listings WHERE id = " . 
                $myrow["listing_id"];
            $listing_result = mysql_query($listing_query);
            $listing_row = mysql_fetch_array($listing_result);
            print ("<li>" . $listing_row["org_name"] . "</li>");
          } while ($myrow = mysql_fetch_array($result));
          print ("</ul>");
        } else {
          print ("<p>The $name category contains no listings.</p>");
        } ?>
		
	<p>
	<input name="submit" type="hidden" value="submit" />
	<input name="id" type="hidden" value="<?php print($id); ?>" />
        Are you sure you want to delete the <strong><?php print $name; ?></strong> category?
        </p>
	
	<input type="submit" name="delete" class="submit" value="Delete Category" />
		
	</fieldset>
	</form>
	<p><a href="index.php"><strong>Cancel:</strong> Back to the Categories List</a>.</p>

<?php
	}
	
abotbit();
?>
