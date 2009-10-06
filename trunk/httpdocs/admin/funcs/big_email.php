<?php
die("KILLED SCRIPT");
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; BIG EMAIL to 'live - in need of work' organisations</h1>

<h3>Sending emails...</h3>

<?php

// Set Vars
$replyemail="organise@justliving.org.uk";

// Set Headers
$headers = "From: $replyemail\r\n";
$headers .= "Reply-To: $replyemail\r\n";
$headers .= "Return-Path: $replyemail\r\n";

$sql = "SELECT id, org_name, address, postcode, email, website, description, phone FROM listings WHERE state = 'justliving' ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		if ($myrow["email"])
			{

			// Set the to address and subject
			$sendtoemail = $myrow["email"];
			//$sendtoemail = "wheresmyhat@gmail.com"; // DEBUG
			$thesubject="Listing for '" . clean_text($myrow["org_name"])  . "' in proper positive guide to $city";

			// Format the body of the email
			$themessage = "Hi there,

Some of you may have received this before in which case hello again! - we'd really like to hear from you. We're aiming to publish our next printed guide within a couple of months, so we're keen on making sure all details are correct.

We're writing to let you know that your organisation is currently listed in a publication called \"Just Living\", a free volunteer-run guide to socially responsible organisations that are doing positive stuff in $city - we think you're one of them! 

Here's a copy of the details we currently have for you:

======================

Name: " . clean_text($myrow["org_name"])  . "
Description: " . clean_text($myrow["description"])  . "
Website: " . clean_text($myrow["website"])  . "
Email: " . clean_text($myrow["email"])  . "
Address: " . clean_text($myrow["address"])  . "
Postcode: " . clean_text($myrow["postcode"])  . "

======================

We'd like to know:

    * is the information we have for your organisation correct?
    * do you know of any other socially responsible organisations that you think we could promote?
    * do you have a photograph that we could include in our guide (email them to us)?
    * would you be interested in stocking the printed version of our guide?
    * would you be interested in stocking business cards or posters advertising the fact that you're listed in the guide? 

Please note - on the last two points there's no obligation at all, we'd just like to make as many people as possible aware of the organisations we list.

We're doing this because we'd like to see more organisations working to create a positive society, and we want people to be aware of and support the ones that $city has right now. We don't get paid for this, and we don't allow advertising in the guide. 

Just Living is available online for free at http://www.justliving.org.uk, and we're currently working on the next edition of a paper copy, which we make available for donations when we have them in stock.

If you'd like any more information or have any suggestions or questions then take a look at our website, or don't hesitate to email us - organise@justliving.org.uk and someone will be in touch shortly.

Cheers! Ben (one of the Just Living volunteers).";

			// Send email
			mail("$sendtoemail","$thesubject","$themessage","$headers");
			//mail("wheresmyhat@gmail.com","$thesubject","$themessage","$headers");

			// Log
			print("Sending to... " . clean_text($myrow["org_name"]) . " - " . clean_text($myrow["email"]) . "... SENT<br />");

			}
		else
			{
			$no_email[$myrow["id"]] =  clean_text($myrow["org_name"]);
			}

		} while ($myrow = mysql_fetch_array($result));
	}

print("<hr />");

// Print out all organisations not emailed
print("<h3>List of organisations not emailed</h3>");
if(is_array($no_email))
	{
	foreach($no_email as $key => $value)
		{
		print("<a href=\"{$app_path}admin/listings/edit.php?id=$key\">$value</a><br />");
		}
	}
	
abotbit();
?>
