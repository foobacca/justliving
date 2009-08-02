<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($app_path, );
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; <a href="index.php">Listings</a> &gt; Add / Edit</h1>
<?php

// Have they just submitted from a preview page?
if (request("submit","post"))
	{
	// Get vars
	$id = request("id","post");
	$cat_id = request("cat_id","post");
	$org_name = request("org_name","post");
	$address = request("address","post");
	$postcode = request("postcode","post");
	$email = request("email","post");
	$website = request("website","post");
	$phone = request("phone","post");
	$description = request("description","post");
	$state = request("state","post");
	$submit_name = request("submit_name","post");
	$submit_email = request("submit_email","post");
	$notes = request("notes","post");
	$welcome_email_sent = request("welcome_email_sent","post");
	
	// ADD

	if (request("add","post"))
		{
		// Check mandatory
		if (!$org_name)
			{
			die();
			}
		
		// Insert
		$now = time();
		$sql = "INSERT INTO listings (add_ts, edit_ts, cat_id, org_name, address, postcode, email, website, phone, description, state, submit_name, submit_email, notes, welcome_email_sent) VALUES ('$now', '$now','$cat_id','$org_name','$address','$postcode','$email','$website','$phone','$description','$state','$submit_name','$submit_email','$notes','n')";
		$result = mysql_query($sql);
		$id = mysql_insert_id();
		
		// Deal with multiple categories
		$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			do 
				{
				// Check to see if this cat is set to 'on', if so, add an entry into the database
				if (${"cat_" . $myrow[id]} == "on")
					{
					mysql_query("INSERT INTO listings_categories (listing_id, category_id) VALUES ('$id', '" . $myrow[id] . "')");
					}
				} while ($myrow = mysql_fetch_array($result));
			} 
			
		// Check if no categories set, in which case add one for the main print category
		if ($cat_id)
			{
			$result = mysql_query("SELECT id FROM listings_categories WHERE listing_id = $id AND category_id = $cat_id"); 
			if ($myrow = mysql_fetch_array($result)) 
				{
				}
			else
				{
				mysql_query("INSERT INTO listings_categories (listing_id, category_id) VALUES ('$id', '$cat_id')");
				}
			}
			
		// Deal with flags
		$result = mysql_query("SELECT id, name FROM flags ORDER BY seq"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			do 
				{
				// Check to see if this cat is set to 'on', if so, add an entry into the database
				if (${"flag_" . $myrow[id]} == "on")
					{
					mysql_query("INSERT INTO listings_flags (listing_id, flag_id) VALUES ('$id', '" . $myrow[id] . "')");
					}
				} while ($myrow = mysql_fetch_array($result));
			} 
		
		// Message
		print("<h2>Listing Added</h2><ul><li><a href=\"javascript:history.go(-2)\">View listings index in admin</li><li><a href=\"/guide/view.php?id=$id&amp;cat=$cat_id\">View listing on website</li><li><a href=\"edit.php?id=$id\">Continue to edit listing</a></li><li><a href=\"/admin/\">Admin homepage</a></ul>"); 
		}
		
	// UPDATE
	
	elseif (request("update","post"))
		{

		// Check mandatory
		if (!$org_name)
			{
			die();
			}
	
		// Deal with welcome email checkbox	
		if ($welcome_email_sent == "on")
			{
			$welcome_email_sent = "y";
			}
		elseif (!$welcome_email_sent)
			{
			$welcome_email_sent = "n";
			}
			
		// Update
		$now = time();
		$sql = "UPDATE listings SET edit_ts = '$now', cat_id = '$cat_id', org_name = '$org_name', address = '$address', postcode = '$postcode', email = '$email', website = '$website', phone = '$phone', description = '$description', state = '$state', submit_name = '$submit_name', submit_email = '$submit_email', notes = '$notes', welcome_email_sent = '$welcome_email_sent' WHERE id = $id";
		$result = mysql_query($sql);
		
		// Deal with multiple categories
		// First, delete all category / listings entries for this listing
		mysql_query("DELETE FROM listings_categories WHERE listing_id = $id");
		// Now add in the correct rows
		$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			do 
				{
				// Check to see if this cat is set to 'on', if so, add an entry into the database
				if (${"cat_" . $myrow[id]} == "on")
					{
					mysql_query("INSERT INTO listings_categories (listing_id, category_id) VALUES ('$id', '" . $myrow[id] . "')");
					}
				} while ($myrow = mysql_fetch_array($result));
			} 
			
		// Check if no web categories set, in which case add one for the main print category
		if ($cat_id)
			{
			$result = mysql_query("SELECT id FROM listings_categories WHERE listing_id = $id AND category_id = $cat_id"); 
			if ($myrow = mysql_fetch_array($result)) 
				{
				}
			else
				{
				mysql_query("INSERT INTO listings_categories (listing_id, category_id) VALUES ('$id', '$cat_id')");
				}
			}
			
		// Deal with flags
		// First, delete all flags / listings entries for this listing
		mysql_query("DELETE FROM listings_flags WHERE listing_id = $id");
		// Now add in the correct rows
		$result = mysql_query("SELECT id, name FROM flags ORDER BY seq"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			do 
				{
				// Check to see if this cat is set to 'on', if so, add an entry into the database
				if (${"flag_" . $myrow[id]} == "on")
					{
					mysql_query("INSERT INTO listings_flags (listing_id, flag_id) VALUES ('$id', '" . $myrow[id] . "')");
					}
				} while ($myrow = mysql_fetch_array($result));
			} 
	
		// Message
		print("<h2>Listing Updated</h2><ul><li><a href=\"javascript:history.go(-2)\">View listings index in admin</li><li><a href=\"/guide/view.php?id=$id&amp;cat=$cat_id\">View listing on website</li><li><a href=\"edit.php?id=$id\">Continue to edit listing</a></li><li><a href=\"/admin/\">Admin homepage</a></ul>");
		}
		
	// DELETE
	
	elseif (request("delete","post"))
		{
		// Delete main listing
		mysql_query("DELETE FROM listings WHERE id = $id");
		
		// Delete any web categories
		mysql_query("DELETE FROM listings_categories WHERE listing_id = $id");
		
		// Delete any flags
		mysql_query("DELETE FROM listings_flags WHERE listing_id = $id");
		
		// Message
		print("<h2>Listing Deleted</h2><ul><li><a href=\"javascript:history.go(-2)\">Back to admin listings list</li><li><a href=\"/admin/\">Admin homepage</a></ul>");
		}
	}
else
	{
	
	if ($id = request("id","get"))
		{
		$result = mysql_query("SELECT * FROM listings WHERE id = $id"); 
		if ($myrow = mysql_fetch_array($result)) 
			{
			$id = $myrow["id"];
			$add_ts = $myrow["add_ts"];
			$edit_ts = $myrow["edit_ts"];
			$cat_id = $myrow["cat_id"];
			$org_name = $myrow["org_name"];
			$address = $myrow["address"];
			$postcode = $myrow["postcode"];
			$email = $myrow["email"];
			$website = $myrow["website"];
			$phone = $myrow["phone"];
			$description = $myrow["description"];
			$state = $myrow["state"];
			$submit_name = $myrow["submit_name"];
			$submit_email = $myrow["submit_email"];
			$notes = $myrow["notes"];
			$welcome_email_sent = $myrow["welcome_email_sent"];
			$web_img = $myrow["web_img"];
			$print_img = $myrow["print_img"];
			}
		}
		
	// Check for delete image links
	// Delete web image
	if (request("delete_web_img","get"))
		{
		// Delete the image
		unlink("../../imgs/listing_imgs/$web_img");
		
		// Update the database
		mysql_query("UPDATE listings SET web_img = '' WHERE id = $id");
		 
		// Clear $web_img for the rest of this page
		unset($web_img);
		}
	// Delete web image
	if (request("delete_print_img","get"))
		{
		// Delete the image
		unlink("../../imgs/listing_imgs/$print_img");
		
		// Update the database
		mysql_query("UPDATE listings SET print_img = '' WHERE id = $id");
		 
		// Clear $print_img for the rest of this page
		unset($print_img);
		}
		
	?>
	<form method="post" action="edit.php">
	<fieldset>
	<legend>Listing State</legend>
	<p>
	<?php
	if ($id)
		{
		?>
	<div style="float: right;"><input type="submit" name="update" class="submit" value="Update Listing" /> <input type="submit" name="delete" class="submit" value="Delete Listing" /></div>
		<?php
		}
	else
		{
		?>
	<input type="submit" name="add" class="submit" value="Add Listing" />
		<?php
		}
	?>
	<select name="state" id="state" style="font-size: 160%;">
	<option value="placeholder" <?php if ($state == "placeholder") {print("selected=\"selected\"");} ?>>Placeholder</option>
	<option value="notlive" <?php if ($state == "notlive") {print("selected=\"selected\"");} ?>>Rejected</option>
	<option value="unchecked" <?php if ($state == "unchecked") {print("selected=\"selected\"");} ?>>Unchecked</option>
	<option value="justliving" <?php if ($state == "justliving" OR !$state) {print("selected=\"selected\"");} ?>>Live - In need of work</option>
	<option value="signed off" <?php if ($state == "signed off") {print("selected=\"selected\"");} ?>>Live - Ready to print</option>
	</select>
	</p>
	</fieldset>
	
	<fieldset>
	<legend>Displayed on Website - <a href="/guide/view.php?id=<?php print($id); ?>" target="_new">View on website</a></legend>
	
	<!-- CATEGORY BIT -->
	<div style="float: right; border: 1px solid black; margin: 0 10px 0 0; padding: 6px 6px 0 0;">
	<p><strong>WEBSITE CATEGORIES:</strong></p>
	<p>
	<?php
	$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			// Check to see if this listing is in this category, only bother if we've got an $id
			if ($id)
				{
				$catresult = mysql_query("SELECT id FROM listings_categories WHERE category_id = " . $myrow[id] . " AND listing_id = $id"); 
				if ($catmyrow = mysql_fetch_array($catresult)) 
					{
					print("<input type=\"checkbox\" name=\"cat_" . $myrow["id"] . "\" checked=\"checked\"> " . $myrow["name"] . "<br />\n");
					}
				else
					{
					print("<input type=\"checkbox\" name=\"cat_" . $myrow["id"] . "\"> " . $myrow["name"] . "<br />\n");
					}
				}
			else
				{
				print("<input type=\"checkbox\" name=\"cat_" . $myrow["id"] . "\"> " . $myrow["name"] . "<br />\n");
				}
			} while ($myrow = mysql_fetch_array($result));
		}
	?>
	</p>
	</div>
		
	<p>
	<input name="submit" type="hidden" value="submit" />
	<input name="id" type="hidden" value="<?php print($id); ?>" />

	<label for="contact">Main (Print) Category:</label>
	<select id="cat_id" name="cat_id">
	<option value="">None Selected</option>
	<?php
	$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			if ($cat_id == $myrow["id"])
				{
				print("<option value=\"" . $myrow["id"] . "\" selected=\"selected\">" . $myrow["name"] . "</option>\n");
				}
			else
				{
				print("<option value=\"" . $myrow["id"] . "\">" . $myrow["name"] . "</option>\n");
				}
			} while ($myrow = mysql_fetch_array($result));
		}
	?>
	</select>
	</p>
	
	<p>
	<label for="org_name"><strong>Organisation Name:</strong> [Mandatory]</label>
	<input type="text" name="org_name" size="45" maxlength="200" id="orgname" value="<?php print($org_name); ?>" />
	</p>
		
	<p>
	<label for="description">Description of activities: [<a href="/admin/help.php">HTML format help</a>]</label>
	<textarea cols="80" rows="20" name="description" id="description"><?php print($description); ?></textarea>
	</p>
	
	<p>
	<label for="website">Website: (Do not include 'http://')</label>
	<input type="text" name="website" size="45" maxlength="200" id="website" value="<?php print($website); ?>" />
	<?php
	if ($website)
		{
		print("&nbsp;&nbsp;&nbsp; <a href=\"http://$website\">Link to website</a>");
		}
	?>
	</p>

	<p>
	<label for="email">Email:</label>
	<input type="text" name="email" size="45" maxlength="200" id="email" value="<?php print($email); ?>" />
	<?php
	if ($email)
		{
		print("&nbsp;&nbsp;&nbsp; <a href=\"mailto:$email\">Mailto</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;");
		if ($welcome_email_sent == 'n')
			{
			print("<a href=\"email.php?id=$id\">Send welcome email</a>");
			print("<input name=\"welcome_email_sent\" type=\"hidden\" value=\"n\" />");
			}
		else
			{
			print("<input name=\"welcome_email_sent\" type=\"checkbox\" checked=\"checked\" /> Welcome email sent");
			}
		}
	?>
	</p>
	
	<p>
	<label for="phone">Phone:</label>
	<input type="text" name="phone" size="45" maxlength="200" id="phone" value="<?php print($phone); ?>" />
	</p>
	
	<p>
	<label for="address">Address: (Comma separated lines, nothing at end of address)</label>
	<input type="text" name="address" size="90" maxlength="255" id="address" value="<?php print($address); ?>" />
	</p>
	
	<p>
	<label for="postcode">Postcode:</label>
	<input type="text" name="postcode" size="8" maxlength="8" id="postcode" value="<?php print($postcode); ?>" />
	</p>
	
	</fieldset>
	
	<?php
	
	if ($id)
		{
		?>
	
		<fieldset>
		<legend>Listing Images</legend>
			
		<p><strong>Website Image</strong> (lo-res): <?php
		if ($web_img)
			{
			print("Image uploaded - <a href=\"edit.php?id=$id&delete_web_img=true\">Remove web image</a><br />");
			print("<img src=\"/imgs/listing_imgs/$web_img\">");
			}
		else
			{
			print("<a href=\"upload_web_img.php?id=$id\" target=\"_new\">Upload Web Image</a> (opens new window or tab)");
			}
		?></p>
		
		<p><strong>Print Image</strong> (hi-res): <?php
		if ($print_img)
			{
			print("Image uploaded - <a href=\"edit.php?id=$id&delete_print_img=true\">Remove print image</a> | <a href=\"/imgs/listing_imgs/$print_img\">View print image</a>");
			}
		else
			{
			print("<a href=\"upload_print_img.php?id=$id\" target=\"_new\">Upload Print Image</a> (opens new window or tab)");
			}
		?></p>
		
		</fieldset>
		
		<?php
		}
	?>
	
	<fieldset>
	<legend>Admin Only</legend>
	
	<!-- FLAGS BIT -->
	<div style="float: right; border: 1px solid black; margin: 0 10px 0 0; padding: 6px 6px 0 0;">
	<p><strong>FLAGS:</strong></p>
	<p>
	<?php
	$result = mysql_query("SELECT id, name FROM flags ORDER BY seq"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			
			if ($id)
				{
				// Check if flagged
				$flagresult = mysql_query("SELECT id FROM listings_flags WHERE listing_id = " . $id . " AND flag_id = " . $myrow["id"]); 
				if ($flagmyrow = mysql_fetch_array($flagresult)) 
					{
					print("<input type=\"checkbox\" name=\"flag_" . $myrow["id"] . "\" checked=\"checked\"> " . $myrow["name"] . "<br />\n");
					}
				else
					{
					print("<input type=\"checkbox\" name=\"flag_" . $myrow["id"] . "\"> " . $myrow["name"] . "<br />\n");
					}
				}
			else
				{
				print("<input type=\"checkbox\" name=\"flag_" . $myrow["id"] . "\"> " . $myrow["name"] . "<br />\n");
				}
				
			} while ($myrow = mysql_fetch_array($result));
		}
	?>
	</p>
	</div>
	
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
	<label for="notes">Notes:</label>
	<textarea cols="60" rows="3" name="notes" id="notes"><?php print($notes); ?></textarea>
	</p>
	
	<p>
	<label for="submit_name">Submitters Name:</label>
	<input type="text" name="submit_name" size="45" maxlength="200" id="submit_name" value="<?php print($submit_name); ?>" />
	</p>
		
	<p>
	<label for="submit_email">Submitters Email:</label>
	<input type="text" name="submit_email" size="45" maxlength="200" id="submit_email" value="<?php print($submit_email); ?>" />
	</p>
	
	<?php
	if ($id)
		{
		?>
	<input type="submit" name="update" class="submit" value="Update Listing" /> <input type="submit" name="delete" class="submit" value="Delete Listing" />
		<?php
		}
	else
		{
		?>
	<input type="submit" name="add" class="submit" value="Add Listing" />
		<?php
		}
	?>
		
	</fieldset>
	</form>
<?php
	}
	
abotbit();
?>