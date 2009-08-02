<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($css_path, );

// Get vars

?>

<h1><a href="/admin/">Just Living Admin</a> &gt; <a href="index.php">Listings</a> &gt; Email Selected Listings</h1>

<?php
if ($confirm)
	{
	// Send Email
	print("<h2>Email sent to...</h2><ul>");
	
	// Set Email Headers
	$replyemail="organise@justliving.org.uk";
	$headers = "From: $replyemail\r\n";
	$headers .= "Reply-To: $replyemail\r\n";
	$headers .= "Return-Path: $replyemail\r\n";

	// Get the listings array back
	$listings = unserialize(urldecode($listings_str)); 
	
	// Send the email
	// Run through the array we've been sent and print a list of the organisations you're about to email
	//$listings = array_unique($listings);
	if (is_array($listings))
		{
		foreach($listings as $key=>$value) 
			{
			// Get Details
			$sql = "SELECT org_name, email FROM listings WHERE id = $value";
			$result = mysql_query($sql);
			if ($myrow = mysql_fetch_array($result)) 
				{
				print("<li>" . $myrow[org_name] . "</li>");
				
				// SEND EMAIL
				mail($myrow[email],stripslashes(stripslashes($subject)),stripslashes(stripslashes($body)),"$headers");
				//mail("wheresmyhat@gmail.com",stripslashes(stripslashes($subject)),stripslashes(stripslashes($body)),"$headers");
				
				}
			else
				{
				die("Badass Error?");
				}
			}
		print("</ul>");
		print("<p>... Done!</p>");
		}
	else
		{
		die("No $listings variable, odd that?");
		}
		
	}
elseif ($review)
	{
	// Review the email
	?>
	<h2>Review your email</h2>
	
	<h3><?php print(stripslashes($subject)); ?></h3>
	<p><?php print(nl2br(stripslashes($body))); ?></p>
	<form method="post" action="email-listings.php">
	<input name="confirm" type="hidden" value="true" />
	<input type="hidden" name="listings_str" value="<?php print($listings_str); ?>">
	<input name="subject" type="hidden" value="<?php print($subject); ?>" />
	<input name="body" type="hidden" value="<?php print($body); ?>" />
	<input type="submit" name="submit" class="submit" value="Send Email" />
	</form>
	
	<?php
	}
else
	{
	// Show list and enter email details
	?>
	<p>The email will be sent from 'organise@justliving.org.uk'.</p>
	<h2>You're about to email the following organisations</h2>
	<form method="post" action="email-listings.php">
	
	<?php
	//Serialize and encode the Array to make it a simple string.
	$listings_str = urlencode(serialize($listings)); 
	?>
	<input type="hidden" name="listings_str" value="<?php print(stripslashes($listings_str)); ?>">
	
	<ul>
	<?php
	// Run through the array we've been sent and print a list of the organisations you're about to email
	$listings = array_unique($listings);
	if (is_array($listings))
		{
		foreach($listings as $key=>$value) 
			{
			// Get Details
			$sql = "SELECT org_name FROM listings WHERE id = $value";
			$result = mysql_query($sql);
			if ($myrow = mysql_fetch_array($result)) 
				{
				print("<li>" . $myrow[org_name] . "</li>");
				}
			else
				{
				die("Badass Error?");
				}
			}
		}
	else
		{
		die("No $listings variable, odd that?");
		}
	?>
	</ul>
	
	
		
	<fieldset>
	<legend>Enter Email Details</legend>
	<input name="review" type="hidden" value="true" />
	
	<p>
	<label for="subject">Subject:</label>
	<input type="text" name="subject" size="45" maxlength="200" id="subject" value="<?php print($subject); ?>" />
	</p>
			
	<p>
	<label for="body">Body:</label>
	<textarea cols="80" rows="20" name="body" id="body"><?php print($body); ?></textarea>
	</p>
		
	<input type="submit" name="submit" class="submit" value="Review Email" />
		
	</fieldset>
	</form>

	<?php
	}
	
	
abotbit();
?>