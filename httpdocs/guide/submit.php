<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(2);

if (request("submit"))
	{

	// Clean Strings
	$submit_name = request("submit_name");
	$submit_email = request("submit_email");
	$subject = request("subject");
	$cat_id = request("cat_id");
	$org_name = request("org_name");
	$description = request("description");
	$website = request("website");
	$email = request("email");
	$phone = request("phone");
	$address = request("address");
	$postcode = request("postcode");
	
	$submit_name = clean_input($submit_name);
	$submit_email = clean_input($submit_email);
	$subject = clean_input($subject);
	$cat_id = clean_input($cat_id);
	$org_name = clean_input($org_name);
	$description = clean_input($description);
	$website = clean_input($website);
	$email = clean_input($email);
	$phone = clean_input($phone);
	$address = clean_input($address);
	$postcode = clean_input($postcode);
	$scheck = request("scheck","post");



	// Check for mandatory
	if (!$org_name OR !$description)
		{
		print("<h2>ERROR</h2>");
		print("<p>You must complete 'organisation name' and 'description of activities' fields to be able to submit a listing.</p><p><a href=\"javascript:history.back();\">Back to the form and try again</a>.</p>");
		botbit();
		die();
		}
		
	// Check 'no spam' field
	if ($scheck != "no spam" AND $scheck != "No Spam" AND $scheck != "NO SPAM")
		{
		?>
		<h2>ERROR</h2>
		<p>Sorry, you have to include 'no spam' in the third field from the top in the form to prove you're not a robot.</p>
		<p><a href="javascript:history.back();">Back to the form</a></p>
		<?php
		botbit();
		die();
		}
	
	// Spam check, if hidden 'subject' field has been completed, pretend everything is ok but do nothing.
	if (!$subject)
		{
		// Insert into Data
		$now = time();
		$sql = "INSERT INTO listings (add_ts, edit_ts, submit_name, submit_email, cat_id, org_name, description, website, email, phone, address, postcode) VALUES ('$now','$now','$submit_name','$submit_email','$cat_id','$org_name','$description','$website','$email','$phone','$address','$postcode')";
		mysql_query($sql);
		$id = mysql_insert_id();
		
		// Insert into the web categories table
		mysql_query("INSERT INTO listings_categories (listing_id,category_id) VALUES ('$id','$cat_id')");
			
		// Get cat name for 'admin email'
		if ($cat_id)
			{
			$result = mysql_query("SELECT name FROM categories WHERE id = $cat_id"); 
			if ($myrow = mysql_fetch_array($result)) 
				{
				$cat = $myrow["name"];
				}
			}
		
		// Set Vars
		$sendtoemail="organise@justliving.org.uk";
		$replyemail="server@justliving.org.uk";
		$thesubject="$guide_name - New Listing";
		
		// Headers
		$headers = "From: $replyemail\r\n";
		$headers .= "Reply-To: $replyemail\r\n";
		$headers .= "Return-Path: $replyemail\r\n";
		
		// Format the body of the email
		$themessage = "A new listing has been added, check it out at:\nhttp://www.justliving.org.uk/admin/listings/edit.php?id=$id\n\nOrganisation Name: $org_name\nCategory: $cat\nDescription: $description\n\n---\nAutoMail from $guide_name";
		
		// Send
		if ($id)
			{
			mail("$sendtoemail","$thesubject","$themessage","$headers");
			}
		
	
		}
		
	?>

	<h2>Listing submitted</h2>

	<p><strong>Thanks for that, your listing details have now been sent to the <?php print $guide_name; ?> team.</strong></p>
	
	<p>We're all volunteers here at <?php print $guide_name; ?>, so in time one of us will get round to checking the details and possibly contacting the organisation in question to confirm details. If the organisation is right for our guide, we'll then publish it on our website and in our next printed version of the guide.</p>

	<p>If you have a photograph that you'd like to include with the listing, then please <a href="/contact.php">email us</a> the image.</p>

	<p>We do have some  <a href="/principles/">principles</a> and some <a href="/resources/">resources</a> to help produce good quality listings.</p>

	<p>Know of more socially responsible organisations that we're missing, then <a href="submit.php">submit another listing</a>.</p>

	<?php
	}
else
	{
	?>

	<h2>Submit a listing</h2>

	<ul>
	<li>If you know of something in <?php print $city; ?> that should be listed in our guide then let us know.</li>
	<li>If you don't know much about an organisation, then just submit as much as you know.</li>
	<li>We have some <a href="/principles/">guiding principles</a> as to what we think is suitable for this guide.</li>
	<li>Your email address will not be public, we may use it to contact you about the listing.</li>
	<li>Mandatory fields are in bold and marked with an asterix*.</li>
	</ul>
	
	<form method="post" action="<?php print($PHP_SELF); ?>">
		
	<fieldset>
	<legend>Your details</legend>
		
	<p>
	<label for="submit_name">Your name</label>
	<input type="text" name="submit_name" size="45" maxlength="100" id="submit_name" />
	</p>
		
	<p>
	<label for="submit_email">Your email</label>
	<input type="text" name="submit_email" size="45" maxlength="100" id="submit_email" />
	</p>
	
	<p>
	<label for="scheck">Please type 'no spam' in this field</label>
	<input type="text" name="scheck" size="45" maxlength="100" id="scheck" />
	</p>
	
	</fieldset>
	
	<fieldset>
	<legend>Organisation details</legend>
	
	<p class="special">
	<label for="subject">Subject</label>
	<input type="text" name="subject" size="45" maxlength="100" id="subject" />
	</p>
	
	<p>
	<label for="contact">Listing category</label>
	<select id="cat_id" name="cat_id">
	<option value="">Please select a category</option>
	<?php
	$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			print("<option value=\"" . $myrow["id"] . "\">" . $myrow["name"] . "</option>\n");
			} while ($myrow = mysql_fetch_array($result));
	}
	?>
	</select>
	</p>
	
	<p>
	<label for="orgname"><strong>Organisation name*</strong></label>
	<input type="text" name="org_name" size="45" maxlength="200" id="orgname" />
	</p>
		
	<p>
	<label for="description"><strong>Description of activities*</strong></label>
	<textarea cols="45" rows="10" name="description" id="description"></textarea>
	</p>
	
	<p>
	<label for="website">Website</label>
	<input type="text" name="website" size="45" maxlength="100" id="website" />
	</p>

	<p>
	<label for="email">Email</label>
	<input type="text" name="email" size="45" maxlength="100" id="email" />
	</p>
	
	<p>
	<label for="phone">Phone</label>
	<input type="text" name="phone" size="45" maxlength="50" id="phone" />
	</p>
	
	<p>
	<label for="address">Address</label>
	<input type="text" name="address" size="45" maxlength="255" id="address" />
	</p>
	
	<p>
	<label for="postcode">Postcode</label>
	<input type="text" name="postcode" size="8" maxlength="8" id="postcode" />
	</p>
		
	<p>
	<input type="submit" name="submit" class="but" value="Submit Listing" />
	</p>
	
	</fieldset>
	
	</form>
	
	<?php
	}
?>


<?php
botbit();
?>
