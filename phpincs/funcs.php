<?php

// Always connect to DB
@(include("dbconn.php")) OR die("Could not find dbconn.php. Make sure you have copied dbconn.php.sample to dbconn.php");

// Always run this to kill any form spam
if ($_REQUEST){foreach($_REQUEST as $key=>$val){if(eregi("MIME-Version: ",$val)){die('Get out.');}}}

// Always set this header...
header("Content-Type: text/html; charset=UTF-8");

// Prints the topbit of the page
function topbit($n = false, $page_title = "Just Living - A proper positive guide to Cambridge")
	{
          # use these globals
          global $app_path;
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php print($page_title); ?></title>
<meta name="description" content="<?php print($page_title); ?>" />
<meta name="keywords" content="Cambridge ethical just living guide green environment community volunteering activism food tourism resources" />
<link rel="stylesheet" type="text/css" href="<?php print $app_path; ?>css/print.css" media="print" />
<style type="text/css" media="all">@import "<?php print $app_path; ?>css/website.css";</style>
</head>
<body>

<div id="topbar">

<form method="get" action="http://www.google.co.uk/custom">
<div id="search">
<input type="hidden" name="sitesearch" value="http://www.justliving.org.uk" />
<input type="hidden" name="domains" value="http://www." />
<input type="text" name="q" size="30" maxlength="255" style="margin: 0;" />
<input type="submit" name="sa" value="Search" class="but" style="margin: 0 0 0 5px;" />
</div>
</form>

<h1><a href="<?php print $app_path; ?>"><img src="<?php print $app_path; ?>imgs/JL_logo.gif" alt="Just Living" width="293" height="60" /></a></h1>

<div id="navcontainer">
<ul id="navlist">
<li><a href="<?php print $app_path; ?>" <?php if ($n == 2) {print("id=\"current\""); } ?>>View Guide</a></li>
<li><a href="<?php print $app_path; ?>stockists/" <?php if ($n == 10) {print("id=\"current\""); } ?>>Stockists</a></li>
<li><a href="<?php print $app_path; ?>about.php" <?php if ($n == 5) {print("id=\"current\""); } ?>>About</a></li>
<li><a href="<?php print $app_path; ?>principles/" <?php if ($n == 8) {print("id=\"current\""); } ?>>Principles</a></li>
<li><a href="<?php print $app_path; ?>resources/" <?php if ($n == 7) {print("id=\"current\""); } ?>>Resources</a></li>
<li><a href="<?php print $app_path; ?>getinvolved.php" <?php if ($n == 4) {print("id=\"current\""); } ?>>Get Involved</a></li>
<li><a href="<?php print $app_path; ?>contact.php" <?php if ($n == 6) {print("id=\"current\""); } ?>>Contact</a></li>
</ul>
</div>

</div>

<div id="page">
<?php
	}
	
// Prints the botbit of the page
function botbit()
	{
          global $app_path;
	?>
<div class="clear"></div>
</div>

<p>&nbsp;</p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align:center;">
<div>
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
<img alt="" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
" />
</div>
</form>

<p class="center adminlink"><a href="<?php print $app_path; ?>admin/" id="adminlink"><img src="<?php print $app_path; ?>imgs/admin.gif" alt="Just Living Admin" width="20" height="20" /></a></p>

<p>&nbsp;</p>

</body>
</html>
<?php
	}

// --------------------------------------------------------------------------------------------------------- //
// GUIDE STUFF 
// --------------------------------------------------------------------------------------------------------- //

// Prints the guide index
function guide_index()
	{
          global $app_path;
	?>

<div class="guideindexbox">
<table class="guideindex"><tr><td class="large">
<ul>
<?php
// Run through the categories
$result = mysql_query("SELECT id, name FROM categories ORDER BY seq");
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		// Get the number of entries in this category
		$sql = "SELECT listings.id FROM listings_categories, listings WHERE listings.id = listings_categories.listing_id AND listings_categories.category_id = " . $myrow["id"] . " AND (listings.state = 'justliving' OR listings.state = 'signed off')";
		$numresult = mysql_query($sql);
		if ($nummyrow = mysql_fetch_array($numresult)) 
			{
			$number = mysql_num_rows(mysql_query($sql)); 
			print("<li><strong><a href=\"" . $app_path . "guide/list.php?cat_id=" . $myrow["id"] . "\">" . $myrow["name"] . "</a></strong> ($number)");
			print("</li>\n");
			}
		// If it's transport, then start another cell
		if ($myrow["id"] == 7)
			{
			print("</ul></td><td class=\"large\"><ul>");
			}
		} while ($myrow = mysql_fetch_array($result));
	}
?>
</ul>
</td></tr>
<tr><td>
<ul>
<li><a href="<?php print $app_path; ?>guide/listings_index.php">All listings</a></li>
<li><a href="<?php print $app_path; ?>guide/list.php?recent=true">Latest additions</a></li>
</ul>
</td><td>
<p style="margin: 24px 0 0 34px;"><a href="<?php print $app_path; ?>guide/submit.php" class="submit">Submit listing</a></p>
</td></tr></table>
</div>

	<?php
	}

// Prints the category list 
function jl_cat_list($current_cat_id = false)
	{
	// Get the cats
	$total = 0;
	$result = mysql_query("SELECT id, name FROM categories ORDER BY seq");
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			// Only display if we've got some listings...
			$sql = "SELECT id FROM listings WHERE (state = 'justliving' OR state = 'signed off') AND cat_id = " . $myrow["id"];
			$result2 = mysql_query($sql);
			if ($myrow2 = mysql_fetch_array($result2)) 
				{
				if ($current_cat_id == $myrow["id"])
					{
					$s .= ("<strong>" . $myrow["name"] . "</strong> | ");
					}
				else	
					{
					$s .= ("<a href=\"list.php?cat_id=" . $myrow["id"] . "\">" . $myrow["name"] . "</a> | ");
					}
				}
			} while ($myrow = mysql_fetch_array($result));
		}
	// Chop a bit at the end
	$s = substr($s, 0, -2);
	print($s);
	}

// Request var func
function request($var, $rtype = "", $allowhtml = false)
	{
	if (strtolower($rtype)=="get")
		{$data = $_GET[$var];}
	elseif (strtolower($rtype)=="post")
		{$data = $_POST[$var];}
	elseif (strtolower($rtype)=="cookie")
		{$data = $_COOKIE[$var];}
	else
		{$data = $_REQUEST[$var];}
	// If results is array.. as in check boxes etc.. return the array as is
	if (is_array($data))
		{
		return $data;
		}
	else
		{
		
		// SANITY CHECKS
		$data = trim($data);
	
		// Allow HTML from user input or not (flag set in application Constants)
		if ($allowhtml)
			{
			$data = strip_tags($data);
			}

		// if magic quotes, return data as is, otherwise add slashes
		if (get_magic_quotes_gpc()==1)
			{
			return $data;
			}
		else
			{
			return addslashes($data);
			}
		}
	}

// ----------------------- //
// DEALING WITH FORM INPUT //
// ----------------------- //

// Clean any form input strings
function clean_input($str)
	{
	return(showtextintags(escapeshellcmd(trim($str))));
	}

// Alternative strip tags function, leaves the text in the tags
function showtextintags($text)
	{
	$text = preg_replace("/(\<script)(.*?)(script>)/si", "dada", "$text");
	$text = strip_tags($text);
	$text = str_replace("<!--", "&lt;!--", $text);
	$text = preg_replace("/(\<)(.*?)(--\>)/mi", "".nl2br("\\2")."", $text);
	return $text;
	}
	
// ---------- //
// DATE STUFF //
// ---------- //

// Convert a date to a timestamp (dd/mm/yyyy > Unix Timestamp)
function datetotimestamp($date)
	{
	if ($date)
		{
		// Split the date into it's three components
		$dateday = substr ($date, 0, 2); 
		$datemon = substr ($date, 3, 2); 
		$dateyear = substr ($date, 6, 4);
		// Convert those components into a midday timestamp
		$date = mktime(12,0,0,$datemon,$dateday,$dateyear);
		return $date;
		}
	else
		{
		return("");
		}
	}

// Convert a timestamp to a date (dd/mm/yyyy)
function timestamptodate($time)
	{
	if ($time)
		{
		$value = date("d/m/Y", $time);
		return($value);
		}
	else
		{
		return("");
		}
	}
	
// ----------------------- //
// PRINTING BITS TO SCREEN //
// ----------------------- //

// formats / cleans a db text entry for xhtml printing to screen
function clean_text($text)
	{
	return(htmlentities($text, ENT_NOQUOTES, 'UTF-8'));
	}
	
// Works with bbcode text, but returns a 300 char abstract 
// edited to rename to create_abstract - in php5 abstract is a reserved keyword
// cannot find it used elsewhere in the code though, so maybe we should just
// get rid of it? Hamish 2/8/09
function create_abstract($text)
	{
	if ($text)
		{
		// Chop the string
		$text = substr($text, 0, 300) . "...";
		
		// Run the standard long text func
		$text = longtext($text);
		
		// Replace any <br /> tags with spaces
		$text = str_replace("<br />"," ",$text);
		
		// Do the same with paras
		$text = str_replace("</p>"," ",$text);
		
		// Rip out any html tags
		$text = strip_tags($text);
		
		// Return text
		return($text);
		}
	}
	
// Returns website text where bbcode and link formatting is included
function longtext($text)
	{
	if ($text)
		{
		// Convert any special characters to HTML entities
		$text = htmlentities($text, ENT_NOQUOTES, 'UTF-8');
		
		// URL matching...
		$text = match_urls($text);
		
		// Auto paragraph func
		$text = autop($text);
			
		// Return text
		return($text);
		}
	}
	
// Returns text that allows simple html (for links etc) but also auto paragraphs?
function htmltext($text)
	{
	if ($text)
		{
		// Convert any special characters to HTML entities
		$text = htmlentities($text, ENT_NOQUOTES, 'UTF-8');
		
		// Auto paragraph func
		$text = autop($text);
			
		// Return text
		return($text);
		}
	}
	
// URL Matching
function match_urls($text)
	{
	$text = ereg_replace("((www.)([a-zA-Z0-9@:%_.~#-\?&]+[a-zA-Z0-9@:%_~#\?&/]))", "http://\\1", $text);
  	$text = ereg_replace("((ftp://|http://|https://){2})([a-zA-Z0-9@:%_.~#-\?&]+[a-zA-Z0-9@:%_~#\?&/])", "http://\\3", $text);
  	$text = ereg_replace("(((ftp://|http://|https://){1})[a-zA-Z0-9@:%_.~#-\?&]+[a-zA-Z0-9@:%_~#\?&/])", "<a href=\"\\1\">\\1</a>", $text);
  	$text = ereg_replace("([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $text);
	return($text);
	}
	
// Auto paragraph text
function autop($text) 
	{
	$text = preg_replace("/(\r\n|\n|\r)/", "\n", $text); // cross-platform newlines
	$text = preg_replace("/\n\n+/", "\n\n", $text); // take care of duplicates
	$text = preg_replace('/\n?(.+?)(\n\n|\z)/s', "<p>$1</p>", $text); // make paragraphs, including one at the end
	$text = preg_replace('|(?<!</p>)\s*\n|', "<br />", $text); // make line breaks
	return $text;
	}
	
// Converts special Word characters into htmlentities (and runs htmlentities());
function superhtmlentities($text) 
	{
	die("superhtmlentities func no longer in use");
	}
	
	
// ---------- //
// EMAIL BITS //
// ---------- //

// Only used in submit listing + addition for sending emails to JL admin
function send_jl_mail($email, $subject, $msg)
	{
	$msg = $msg . "\n\n--\nJust Living - An Ethical Guide to Cambridge\nWebsite: http://www.justliving.org.uk\nWiki: http://wiki.justliving.org.uk";
	$headers = "From: automail@justliving.org.uk\r\n";
	$headers .= "Reply-To: automail@justliving.org.uk\r\n";
	$headers .= "Return-Path: automail@justliving.org.uk\r\n";
	mail($email, stripslashes($subject), stripslashes(remove_extra_linebreaks($msg)), $headers) or die("Mail not sent");
	}
	
// Removes double line breaks for when sending form to email
function remove_extra_linebreaks($string) 
	{
	$new_string=urlencode ($string);
	$new_string=ereg_replace("%0D", " ", $new_string);
	$new_string=urldecode  ($new_string);
  	return $new_string;
	}
	
	
// ---------- //
// ADMIN ONLY //
// ---------- //


// Topbit
function atopbit()
	{
          global $app_path;
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Just Living Admin</title>
<style type="text/css" media="all">@import "<?php print $app_path; ?>/admin.css";</style>
          <script src="<?php print $app_path; ?>js/sorttable.js"></script>
</head>
<body>
	<?php
	}

// Botbit	
function abotbit()
	{
	?>
</body>
</html>
	<?php
	}

	
// Clean input in case of header injection attempts
function clean_input_4email($value)
	{
 	$patterns[0] = '/content-type:/';
 	$patterns[1] = '/to:/';
 	$patterns[2] = '/cc:/';
 	$patterns[3] = '/bcc:/';
 	$patterns[4] = '/\r/';
  	$patterns[5] = '/\n/';
  	$patterns[6] = '/%0a/';
  	$patterns[7] = '/%0d/';
	$patterns[8] = '/mime-version:/';
 	//NOTE: can use str_ireplace as this is case insensitive but only available on PHP version 5.0.
 	return preg_replace($patterns, "", strtolower($value));
	}
	
// SPAM CHECK

// encrypt
function encrypt($data)
	{
	$data = strtr(strtolower($data), $GLOBALS['chars']);
	return $data;
	}

// decrypt
function decrypt($data)
	{
	$charset = array_flip($GLOBALS['chars']);
	$charset = array_reverse($charset, true);
	$data = strtr($data, $charset);
	unset($charset);
	return $data;
	}
	
?>
