<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">Categories</a> &gt; Edit</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
        $name = request("name","post");
	$introduction = request("introduction","post");
	$id  = request("id","post");
	
	// Update
	$sql = "UPDATE categories SET name = '$name', introduction = '$introduction' WHERE id = $id";
	$result = mysql_query($sql);
			
	// Message
	print("<h2>Category Updated</h2><p>Back to the <a href=\"index.php\">Categories List</a>.</p>");
	}
else
	{
        $id = request("id");
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

	<label for="name">Name</label>
	<input type="text" name="name" id="name" value="<?php print($name); ?>" />

	<label for="introduction">Introduction</label>
	<textarea name="introduction" id="introduction" cols="60" rows="10"><?php print($introduction); ?></textarea>
	<span style="display: block; font-size: 0.9em; padding: 0 0 4px 0; width: 400px;">At the moment, this is inserted within paragraph tags. So you can only add HTML links and line breaks within the text will be line breaks on the website.</span>
	</p>
	
	<input type="submit" name="update" class="submit" value="Update Category" />
		
	</fieldset>
	</form>

        <p>You can also <a href="delete.php?id=<?php print $id; ?>">delete this category</a>.</p>
<?php
	}
	
abotbit();
?>
