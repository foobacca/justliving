<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">Categories</a> &gt; Add New</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
        $name = request("name","post");
	$introduction = request("introduction","post");
        $seq = request("seq","post");
	$id  = request("id","post");
	
	// Update
	$sql = "INSERT categories SET name = '$name', introduction = '$introduction', seq = '$seq'";
	$result = mysql_query($sql);
			
	// Message
	print("<h2>Category Added</h2><p>Back to the <a href=\"index.php\">Categories List</a>.</p>");
	}
else
	{ ?>
	<form method="post" action="add.php">
		
	<fieldset>
	<legend>New Category: ></legend>
		
	<p>
	<input name="submit" type="hidden" value="submit" />

	<label for="name">Name</label>
	<input type="text" name="name" id="name"  />

	<label for="introduction">Introduction</label>
	<textarea name="introduction" id="introduction" cols="60" rows="10"></textarea>
	<span style="display: block; font-size: 0.9em; padding: 0 0 4px 0; width: 400px;">At the moment, this is inserted within paragraph tags. So you can only add HTML links and line breaks within the text will be line breaks on the website.</span>

	<label for="seq">Sequence Number</label>
	<input type="text" name="seq" id="seq"  />
	<span style="display: block; font-size: 0.9em; padding: 0 0 4px 0; width: 400px;">This determines the order of categories.</span>
	</p>
	
	<input type="submit" name="add" class="submit" value="Add Category" />
		
	</fieldset>
	</form>

<?php
	}
	
abotbit();
?>
