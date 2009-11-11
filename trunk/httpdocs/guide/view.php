<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");

// Get the id
$id = request("id");

// Always got an $id
if (!$id){die();}

// Has the user just submitted a comment?
if (request("submit_comment","post"))
	{
	topbit(2);
	
	// Get vars
	$subject = request("subject","post");
	$comment = request("comment","post");
	$submit_name = request("submit_name","post");
	$submit_email = request("submit_email","post");
	$spam_check = request("scheck","post");
	
	// Get the cat, which is hidden
	$cat_id = request("cat","post");
	
	// Check mandatory
	if (!$comment)
		{
		?>
		<h2>ERROR</h2>
		<p>Sorry, you have to write something.</p>
		<p><a href="javascript:history.back();">Back to the form</a></p>
		<?php
		botbit();
		die();
		}
		
	// Check 'no spam' field
	if (strtolower($spam_check) != "no spam")
		{
		?>
		<h2>ERROR</h2>
		<p>Sorry, you have to include 'no spam' in the last field in the form to prove you're not a robot.</p>
		<p><a href="javascript:history.back();">Back to the form</a></p>
		<?php
		botbit();
		die();
		}
		
	// Spam check, if hidden 'subject' field has been completed, pretend everything is ok but do nothing.
	if (!$subject)
		{
	
		// Insert
		$now = time();
		$sql = "INSERT INTO comments (add_ts, edit_ts, listing_id, comment, submit_name, submit_email) VALUES ('$now', '$now','$id','$comment','$submit_name','$submit_email')";
		$result = mysql_query($sql);
		$id = mysql_insert_id();
		
		// Set Vars
		$thesubject="$guide_name - New Addition to a Listing";
		
		// Headers
                $replyemail = $server_email;
		$headers = "From: " . $replyemail . "\r\n";
		$headers .= "Reply-To: " . $replyemail . "\r\n";
		$headers .= "Return-Path: " . $replyemail . "\r\n";
		
		// Format the body of the email
		$themessage = "A new addition has been posted, check it out at:\n" . $site_url . $app_path . "admin/additions/edit.php?id=$id\n\nText: $comment\n$Submit Name: $submit_name\nSubmit Email: $submit_email\n\n---\nAutoMail from $guide_name";
		
		// Send
		mail("$organise_email","$thesubject","$themessage","$headers");
		
		}
	
	// Message
	?>
	<h2>Information Added</h2>
	<p>Your additional information has been sent to the <?php print $guide_name; ?> team. One of us will check out the suggested changes to the listing and update it if necessary. Cheers.</p>
	<ul>
        <li><a href="<?php print $app_path; ?>guide/view.php?id=<?php print($id); ?>&cat=<?php print($cat_id); ?>">Back to the listing</a></li>
	<li><a href="<?php print $app_path; ?>">View guide index</a></li>
	</ul>

	<?php
		
	
	}
else
	{
	
	// Not just posted a comment, so a normal view page
	
	// ------- //
	// LISTING //
	// ------- //
	
	// Add a 'view'
	mysql_query("UPDATE listings SET views = (views + 1) WHERE id = $id");
		
	// Get the details
	$result = mysql_query("SELECT add_ts, edit_ts, org_name, cat_id, address, postcode, email, website, phone, description, state, web_img FROM listings WHERE id = $id");
	if ($myrow = mysql_fetch_array($result)) 
		{
		$add_ts = $myrow["add_ts"];
		$edit_ts = $myrow["edit_ts"];
		$org_name = $myrow["org_name"];
		$address = $myrow["address"];
		$postcode = $myrow["postcode"];
		$email = $myrow["email"];
		$website = $myrow["website"];
		$phone = $myrow["phone"];
		$description = $myrow["description"];
		$state = $myrow["state"];
		$print_cat_id = $myrow["cat_id"];
		$web_img = $myrow["web_img"];
		}
		
	// Cat id in GET 
	$cat_id = request("cat","get");
	
	// If not cat_id, use the main print category id
	if (!$cat_id)
		{
		$cat_id = $print_cat_id;
		}
	
	// Get the category name
	$result = mysql_query("SELECT name FROM categories WHERE id = $cat_id");
	if ($myrow = mysql_fetch_array($result)) 
		{
		$cat_name = $myrow["name"];
		}
		
	// Topbit
	topbit(2, $org_name);
	
	// Page Title 
	print("<h2 class=\"center\"><a href=\"list.php?cat_id=$cat_id\">$cat_name</a></h2>\n");

	// Previous / next links
	$sql = "SELECT l.id FROM listings l, listings_categories lc WHERE l.id = lc.listing_id AND (l.state = 'justliving' OR l.state = 'signed off') AND lc.category_id = $cat_id ORDER BY l.org_name";
	$result = mysql_query($sql);
        $pre_id = null;
	if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		// If 'next' is true, then this is the one for the next link
		if (isset($next) && $next)
			{
			$next_id = $myrow["id"];
			$next = false;
			}
		// Got to current viewed listing
		if ($id == $myrow["id"])
			{
			// So next iteration is the next link
			$next = true;
			// And the previous link is the $pre_id
			$prev_id = $pre_id;
			}
		// Keep track of this id, in case it's the previous link
		$pre_id = $myrow["id"];
		} while ($myrow = mysql_fetch_array($result));
	}

	// Build the next / previous string
	$nextprev = ("<p class=\"center\">");
	if (isset($prev_id) && $prev_id)
		{
		$nextprev .= ("<a href=\"view.php?id=$prev_id&amp;cat=$cat_id\">&lt;&lt; Previous</a>");
		}
	else
		{
		$nextprev .= ("&lt;&lt; Previous");
		}
	$nextprev .= (" | <a href=\"$app_path\">Guide Index</a> | ");
	if (isset($next_id) && $next_id)
		{
		$nextprev .= ("<a href=\"view.php?id=$next_id&amp;cat=$cat_id\">Next &gt;&gt;</a>");
		}
	else
		{
		$nextprev .= ("Next &gt;&gt;");
		}
	$nextprev .= ("</p>\n");

	print($nextprev);


	print("<div class=\"listing\">\n");
	
	// Web Image
	if ($web_img)
		{
		list($width, $height, $type, $attr) = getimagesize("../imgs/listing_imgs/$web_img");
		print("<img style=\"float: right; margin: 5px 0 10px 10px;\" src=\"../imgs/listing_imgs/$web_img\" $attr alt=\"$org_name Image\">");
		}
		
	// Org Name
	print("<h2>$org_name</h2>\n");
	
	// Details
	print("<div id=\"list\">");
	
	if ($address OR $postcode) 
		{
		print("<p class=\"infoline\"><strong>Address</strong> <span>$address $postcode");
		
		if ($postcode)
			{
			$link_postcode = str_replace(" ", "+", $postcode);
			$link_org_name = str_replace(" ", "+", $org_name);

			//print(" (<a href=\"http://www.streetmap.co.uk/streetmap.dll?postcode2map?" . $link_postcode . "&" . $link_org_name . "\">map</a>)");
			print(" (<a href=\"http://maps.google.co.uk/maps?q=" . $link_postcode . "\">map</a>)");

			}
		
		print("</span></p>\n");
		}
	if ($email) 
		{
		// Mash email address...
		$mashed_email = str_replace("@", " [at] ", $email);
		$mashed_email = str_replace(".", " [dot] ", $mashed_email);
		print("<p class=\"infoline\"><strong>Email</strong> <span>" . $mashed_email . "</span></p>\n");
		}
	if ($website)
		{
		if (substr($website, 0, 7) != "http://")
			{
			$website = "http://" . $website;
			}
		print("<p class=\"infoline\"><strong>Website</strong> <span>" . match_urls($website) . "</span></p>\n");
		}
	if ($phone) {print("<p class=\"infoline\"><strong>Telephone</strong> <span>$phone</span></p>\n");}
	
	print("</div>");
	
	// Text
	print("<div class=\"description\">");
	print(longtext($description)); 
	print("</div>");
	
	
	print("<div style=\"clear:both;\"></div>\n");
	print("<div class=\"metalist\"><p>Submitted on " . date("jS F y",$add_ts));
	if ($add_ts != $edit_ts)
		{
		print(" | Last edited on the " . date("jS F y", $edit_ts));
		}
	print("</p></div>\n");
	print("</div>\n\n");

	print($nextprev);
	
	// --------- //
	// ADDITIONS //
	// --------- //
	$sql = "SELECT add_ts, title, comment, submit_name FROM comments WHERE listing_id = $id AND state = 'checked' ORDER BY add_ts";
	$result = mysql_query($sql);
	if ($myrow = mysql_fetch_array($result)) 
		{
		print("<h3 style=\"margin: 2em 0 0.5em 0;\">Listing Additions</h3>\n");
		do 
			{
			print("<div class=\"comment\">\n");
			print("<h4>" . clean_text($myrow["title"]) . "</h4>\n");
			print("<p>" . longtext($myrow["comment"]) . "</p>");
			print("<p class=\"metalist\">Submitted by: <strong>" . clean_text($myrow["submit_name"]) . "</strong> on <strong>" . date("jS F y",$myrow["add_ts"]) . "</strong></p>");
			print("</div>");
			} while ($myrow = mysql_fetch_array($result));
		}
	
	
	// ------------ //
	// ADD ADDITION //
	// ------------ //
	
	?>
	
	<form method="post" action="<?php print($_SERVER['PHP_SELF']); ?>">
		
	<fieldset style="padding-top: 10px;">
	<legend>Post additional information</legend>
	
	<ul style="margin-top: 0; padding-top: 0; padding-bottom: 10px;">
	<li>If you think we're missing details or this listing is incorrect, please let us know.</li>
	<li>Your email address will not be public, we may use it to contact you about the addition.</li>
	<li>Mandatory fields are in bold and marked with an asterix*.</li>
	<li><strong>Please note. You are about to contact the <?php print $guide_name; ?> team NOT the organisation listed above.</strong></li>
	</ul>
	
	<p>
	<input type="hidden" name="id" value="<?php print($id); ?>" />
	<input type="hidden" name="cat" value="<?php print($cat_id); ?>" />
	<input type="hidden" name="submit_comment" value="true" />
	</p>
	
	<p class="special">
	<label for="subject">Subject</label>
	<input type="text" name="subject" size="45" maxlength="100" id="subject" />
	</p>
	
	<p>
	<label for="comment"><strong>Additional information*</strong></label>
	<textarea cols="45" rows="5" name="comment" id="comment"></textarea>
	</p>
		
	<p>
	<input name="submit_name" type="hidden" value="submit" />
	<label for="submit_name">Your name</label>
	<input type="text" name="submit_name" size="45" maxlength="100" id="submit_name" />
	</p>
		
	<p>
	<label for="submit_email">Contact email</label>
	<input type="text" name="submit_email" size="45" maxlength="100" id="submit_email" />
	</p>
	
	<p>
	<label for="scheck"><strong>Please type 'no spam' in this field*</strong></label>
	<input type="text" name="scheck" size="45" maxlength="100" id="scheck" />
	</p>
			
	<p>
	<input type="submit" name="submit" class="but" value="Submit Information" />
	</p>
		
	</fieldset>
	</form>
	
	<?php

	} // End the 'if not comment post'

botbit();
?>
