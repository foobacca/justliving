<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">News</a> &gt; Add / Edit</h1>
<?php

$headline = null;
$date = null;
$article = null;
// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
	$id = request("id","post");
        settype($id, "integer");
	$headline = request("headline","post");
	$date = request("date","post");
	$article = request("article","post");

	// ADD

	if (request("add","post"))
		{
		// Check mandatory
		if (!$headline OR !$date OR !$article)
			{
			die();
			}
			
		// Deal with the date
		$date = datetotimestamp($date);
		
		// Insert
		$now = time();
                $sql = "INSERT INTO news (headline, date, article) VALUES ('" . 
                  mysql_real_escape_string($headline) . "', '" .
                  mysql_real_escape_string($date) . "','" .
                  mysql_real_escape_string($article) . "')";
		$result = mysql_query($sql);
		
		// Message
		print("<h2>News Article Added</h2>");
		}
		
	// UPDATE
	
	elseif (request("update","post"))
		{

		// Check mandatory
		if (!$headline OR !$date OR !$article)
			{
			die();
			}
			
		// Deal with the date
		$date = datetotimestamp($date);
		
		// Update
		$now = time();
                $sql = "UPDATE news SET " . 
                  "headline = '" . mysql_real_escape_string($headline) . "', " . 
                  "date = '" . mysql_real_escape_string($date) . "', " . 
                  "article = '" . mysql_real_escape_string($article) . "'" . 
                  " WHERE id = $id";
		$result = mysql_query($sql);
	
		// Message
		print("<h2>News Article Updated</h2>");
		}
		
	// DELETE
	
	elseif (request("delete","post"))
		{
		// Delete
		$sql = "DELETE FROM news WHERE id = $id";
		$result = mysql_query($sql);
		
		// Message
		print("<h2>News Article Deleted</h2>");
		}
	}
else
	{
	if ($id = request("id","get"))
		{
                settype($id, "integer");
		$result = mysql_query("SELECT * FROM news WHERE id = $id"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			$headline = $myrow["headline"];
			$date = $myrow["date"];
			$article = $myrow["article"];
			
			// Convert date
			$date = timestamptodate($date);
			}
		}
	?>
	 
	<form method="post" action="edit.php">
	<fieldset>
	<legend>News Article</legend>
		
	<p>
	<input name="submit" type="hidden" value="submit" />
	<input name="id" type="hidden" value="<?php print($id); ?>" />

	<label for="date">Article Date (dd/mm/yyyy):</label>
	<input type="text" name="date" size="12" maxlength="10" id="date" value="<?php print($date); ?>" />
	</p>
	
	<p>
	<label for="headline">Headline:</label>
	<input type="text" name="headline" size="45" maxlength="100" id="headline" value="<?php print($headline); ?>" />
	</p>
		
	<p>
	<label for="article">Article:</label>
	<textarea cols="60" rows="20" name="article" id="article"><?php print($article); ?></textarea>
	<br /><em>Basic HTML, line breaks are line breaks on the final page.</em>
	</p>
	
	<?php
	if ($id)
		{
		?>
	<input type="submit" name="update" class="submit" value="Update News Article" /> <input type="submit" name="delete" class="submit" value="Delete News Article" />
		<?php
		}
	else
		{
		?>
	<input type="submit" name="add" class="submit" value="Add News Article" />
		<?php
		}
	?>
		
	</fieldset>
	</form>
<?php
	}
	
abotbit();
?>
