<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($css_path, );
?>

<h1><a href="/admin/">Just Living Admin</a> &gt; <a href="index.php">Listings</a> &gt; Send welcome email</h1>

<?php
// Get the confirm, if set
$confirm = request("confirm","get");

// Get the id
$id = request("id","get");

// Set Vars
$replyemail="organise@justliving.org.uk";

// Set Headers
$headers = "From: $replyemail\r\n";
$headers .= "Reply-To: $replyemail\r\n";
$headers .= "Return-Path: $replyemail\r\n";

// Get Details
$sql = "SELECT id, org_name, address, postcode, email, website, description, phone FROM listings WHERE id = $id";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{

	// Set the to address and subject
	$sendtoemail = $myrow["email"];
	
	// Subject
	$thesubject="Listing for '" . clean_text($myrow["org_name"])  . "' in socially responsible guide to Cambridge";

	// Format the body of the email
	$themessage = "Hi there,

We're writing to let you know that your organisation has just been listed in \"Just Living\", a free volunteer-run guide to socially responsible organisations that are doing positive stuff in Cambridge - we think you're one of them!

Here's a copy of the details we currently have for you:

==============
Name: " . clean_text($myrow["org_name"])  . "
Description: " . clean_text($myrow["description"])  . "
Website: " . clean_text($myrow["website"])  . "
Email: " . clean_text($myrow["email"])  . "
Address: " . clean_text($myrow["address"])  . "
Postcode: " . clean_text($myrow["postcode"])  . "
==============

We'd like to know:

- is the information we have for your organisation correct?
- do you know of any other socially responsible organisations that we could promote?
- do you have a photograph that we could include in our guide?
- would you be interested in stocking the printed version of our guide?
- would you be interested in stocking business cards or posters advertising the fact that you're listed in the guide?
- if you have any other suggestions for our guide?

Also, if your organisation has a website and if it would be appropriate, you could also mention that you're listed in Just Living and add a link to our site - www.justliving.org.uk - you can get the logo from our site or we can send you one.

Please note - there's no obligation at all to answer or do any of this - you'll still be listed with us. All of this just helps us to help organisations like yours. We might chase you up at some point to check your details if we don't hear from you, because we want to make sure we've listed you accurately.

We're doing this because we'd like to see more organisations working to create a positive society, and we want people to be aware of and support the ones that Cambridge has right now. We don't get paid for this, and we don't allow advertising in the guide.

Just Living is available online for free at http://www.justliving.org.uk, and we're currently working on the next edition of a paper copy, which we make available for donations when we have them in stock.

If you'd like any more information or have any questions then take a look at our website, or don't hesitate to email us - organise@justliving.org.uk and someone will be in touch shortly.

Cheers! Tom (one of the Just Living volunteers).";

	if ($confirm == "yes")
		{
		// Send email
		mail("$sendtoemail","$thesubject","$themessage","$headers");
		print("<p><strong>EMAIL SENT</strong></p>");
		print("<p><a href=\"edit.php?id=$id\">Back to edit listing</a></p>");
		
		// Update the database
		mysql_query("UPDATE listings SET welcome_email_sent = 'y' WHERE id = $id");
		}

	else
		{
		// Print out what you're about to send
		print("<p><strong>Sending email to:</strong> ". $myrow[email] . "</p>");
		print("<p><strong>Email subject:</strong> $thesubject</p>");
		print("<p><strong>Email body:</strong> " . nl2br($themessage) . "</p>");
	
		// Print confirm send email link
		print("<p><strong><a href=\"email.php?id=$id&confirm=yes\">SEND EMAIL</a></strong></p>");
		}
		
	}

abotbit();
?>