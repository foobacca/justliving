<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($app_path, );
?>
<h1>Just Living Admin</h1>

<h3 style="font-size: 1.4em;"><a href="http://wiki.justliving.org.uk">JL WIKI</a></h3>

<h3><a href="listings/">Manage Listings</a></h3>
<p><?php
// Unchecked
$unchecked = mysql_num_rows(mysql_query("SELECT id FROM listings WHERE state = 'unchecked'")); 
if ($unchecked) 
	{
	print("<span class=\"bolder\">$unchecked Unchecked</span>");
	}
?> Add, edit and delete listings in Just Living guide.</p>

<h3><a href="additions/">Manage Additions</a></h3>
<p><?php
// Unchecked
$unchecked = mysql_num_rows(mysql_query("SELECT id FROM comments WHERE state = 'unchecked'")); 
if ($unchecked) 
	{
	print("<span class=\"bolder\">$unchecked Unchecked</span>");
	}
?> Edit or delete the listing additions.</p>

<h3><a href="categories/">Manage Categories</a></h3>
<p>Edit the introduction text that is displayed for each category.</p>

<h3><a href="news/">Manage News</a></h3>
<p>Add, edit and delete news articles displayed on the Just Living website.</p>

<h3>Check Formatting</h3>
<ul>
<li><strong><a href="format_check/textareaspellcheck.php">Big Text Area Spell Check</a></strong></li>
<li><a href="format_check/website.php">Website</a></li>
<li><a href="format_check/email.php">Email</a></li>
<li><a href="format_check/phone.php">Phone</a></li>
<li><a href="format_check/address.php">Address</a></li>
<li><a href="format_check/postcode.php">Postcode</a></li>
</ul>

<h3>Functions & Scripts</h3>

<ul>
<!--<li><a href="funcs/dump_text.php">Dump all listing titles and descriptions to aid spell checking</a></li>-->
<li><a href="funcs/email_list.php">Dump all email addresses from listings</a></li>
<!--<li><a href="funcs/big_email.php">BIG EMAIL to organisations</a> - V2.</li>-->
<li><a href="funcs/clean_website.php">Clean Up</a> - Strips unwanted elements from the website field for all listings</li>
<li><a href="phpMyAdmin/">PhpMyAdmin</a> - Database administration</li>
<!--<li><a href="funcs/populate_new_cats.php">Sets up the new multiple categories table</a> - Leave alone</li>-->
</ul>

<h3>Print Functions</h3>

<ul>
<li><a href="print_output/">Dump files for print edition</a></li>
</ul>

<h3><a href="stats.php">Website Statistics</a></h3>
<p>Updated overnight, every night.</p>

<?php
abotbit();
?>