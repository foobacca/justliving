<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($app_path, );
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; <a href="index.php">Additions</a> &gt; Edit</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	
	// UPDATE
	
	if (request("update","post"))
		{
		
		// Get vars
		$id = request("id","post");
		$comment = request("comment","post");
		$submit_name = request("submit_name","post");
		$submit_email = request("submit_email","post");
		$notes = request("notes","post");
		$state = request("state","post");
		
		// Update
		$now = time();
		$sql = "UPDATE comments SET edit_ts = '$now', comment = '$comment', submit_name = '$submit_name', submit_email = '$submit_email', notes = '$notes', state = '$state' WHERE id = $id";
		$result = mysql_query($sql);
	
		// Message
		print("<h2>Addition Updated</h2>");
		}
		
	// DELETE
	
	elseif (request("delete","post"))
		{
		// Delete
		$sql = "DELETE FROM comments WHERE id = $id";
		$result = mysql_query($sql);
		
		// Message
		print("<h2>Addition Deleted</h2>");
		}
		
	}
else
	{
	if ($id = request("id","get"))
		{
		$result = mysql_query("SELECT * FROM comments WHERE id = $id"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			$add_ts = $myrow["add_ts"];
			$edit_ts = $myrow["edit_ts"];
			$listing_id = $myrow["listing_id"];
			$title = $myrow["title"];
			$comment = $myrow["comment"];
			$submit_name = $myrow["submit_name"];
			$submit_email = $myrow["submit_email"];
			$notes = $myrow["notes"];
			$state = $myrow["state"];
			}
		}
	?>
	
	<form method="post" action="edit.php">
	
	<?php
	$result = mysql_query("SELECT org_name  FROM listings WHERE id = $listing_id"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			print("<h3>Addition For: <strong>" . $myrow["org_name"] . "</strong> | ");
			print("<a href=\"/ethical-guide/view.php?id=" . $listing_id . "\">View listing on website</a> | ");
			print("<a href=\"/admin/listings/edit.php?id=" . $listing_id . "\">Edit the listing details</a></h3>");
			}
	?>
	
	<fieldset>
	<legend>Addition State</legend>

	<p>

	<div style="float:right;"><input type="submit" name="update" class="submit" value="Update Addition" /> <input type="submit" name="delete" class="submit" value="Delete Addition" /></div>

	<select name="state" id="state" style="font-size: 160%;">
	<option value="notlive" <?php if ($state == "notlive") {print("selected=\"selected\"");} ?>>Rejected</option>
	<option value="unchecked" <?php if ($state == "unchecked") {print("selected=\"selected\"");} ?>>Unchecked</option>
	<option value="checked" <?php if ($state == "checked") {print("selected=\"selected\"");} ?>>Live</option>
	</select>
	</p>
	
	</fieldset>
	
	<fieldset>
	<legend>Displayed on Website</legend>
		
	<p>
	<input name="submit" type="hidden" value="submit" />
	<input name="id" type="hidden" value="<?php print($id); ?>" />

	<label for="comment">Addition:</label>
	<textarea cols="60" rows="10" name="comment" id="comment"><?php print($comment); ?></textarea>
	</p>
	
	<p>
	<label for="submit_name">Submitters Name:</label>
	<input type="text" name="submit_name" size="45" maxlength="200" id="submit_name" value="<?php print($submit_name); ?>" />
	</p>
		
	</fieldset>
		
	<fieldset>
	<legend>Admin Only</legend>
	
	<?php 
	if ($add_ts)
		{
		?>
		<p>
		<strong>Submitted on:</strong> <?php print(date("jS F y",$add_ts)); ?><br />
		<strong>Last edited on:</strong> <?php print(date("jS F y",$edit_ts)); ?><br />
		</p>
		<?php
		}
	?>
	
	<p>
	<label for="submit_email">Submitters Email:</label>
	<input type="text" name="submit_email" size="45" maxlength="200" id="submit_email" value="<?php print($submit_email); ?>" />
	</p>
	
	<p>
	<label for="notes">Notes:</label>
	<textarea cols="60" rows="3" name="notes" id="notes"><?php print($notes); ?></textarea>
	</p>
		
	<input type="submit" name="update" class="submit" value="Update Addition" /> <input type="submit" name="delete" class="submit" value="Delete Addition" />
		
	</fieldset>
	</form>
<?php
	}
	
abotbit();
?>