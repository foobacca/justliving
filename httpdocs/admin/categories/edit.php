<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($css_path, );
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; <a href="index.php">Categories</a> &gt; Edit</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
	$introduction = request("introduction","post");
	$id  = request("id","post");
	
	// Update
	$sql = "UPDATE categories SET introduction = '$introduction' WHERE id = $id";
	$result = mysql_query($sql);
			
	// Message
	print("<h2>Category Updated</h2><p>Back to the <a href=\"index.php\">Categories List</a>.</p>");
	}
else
	{
	$result = mysql_query("SELECT name, introduction FROM categories WHERE id = $id"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		$name = $myrow["name"];
		$introduction = $myrow["introduction"];
		}
	?>
	<form method="post" action="edit.php">
		
	<fieldset>
	<legend>Category: <?php print($name); ?></legend>
		
	<p>
	<input name="submit" type="hidden" value="submit" />
	<input name="id" type="hidden" value="<?php print($id); ?>" />

	<label for="introduction">Introduction</label>
	<textarea name="introduction" id="introduction" cols="60" rows="10"><?php print($introduction); ?></textarea>
	<span style="display: block; font-size: 0.9em; padding: 0 0 4px 0; width: 400px;">At the moment, this is inserted within paragraph tags. So you can only add HTML links and line breaks within the the next below will be line breaks on the website.</span>
	</p>
	
	<input type="submit" name="update" class="submit" value="Update Category" />
		
	</fieldset>
	</form>
<?php
	}
	
abotbit();
?>