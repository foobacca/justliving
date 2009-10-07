<?php
@(include("config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(4);
?>

<h2>Get involved in <?php print $guide_name; ?></h2>

<p>We run as an open group and everyone is welcome to get involved in producing the guide. There's various ways of helping out, depending on your levels of interest and energy.</p> 

<h3>Submit listings</h3>

<p>You can view <a href="<?php print $app_path; ?>">our current listings</a> and <a href="<?php print $app_path; ?>guide/submit.php">submit a listing</a> that you think we might be missing. Take a look at our <a href="<?php print $app_path; ?>principles/">principles</a> to get a flavour of what <?php print $guide_name; ?> is here to promote.</p>

<h3>Submit additions &amp; corrections</h3>

<p>For each of <a href="<?php print $app_path; ?>">our listings</a> you can alert us to mistakes or information we're lacking. We'll then update the entry if required.</p>

<h3>Get involved with the group</h3>

<p>We meet on an adhoc basis to work on <?php print $guide_name; ?>. We share ideas, proposals and content for the guide and project. Please just <a href="<?php print $app_path; ?>contact.php">contact us</a> if you're interested in coming along and getting involved.</p>

<h3>Help us with distribution</h3>

<p>We're looking for places in <?php print $city; ?> that'll be happy to stock our printed guide. If you could stock the guide then please <a href="<?php print $app_path; ?>contact.php">let us know</a>.</p>

<h3>Submit artwork for the guide</h3>

<p>We like to include lovely artwork in the printed guide. If you're a <?php print $city; ?> artist looking for some exposure then we can offer a credit in return for using your work. The guide is lo-fi black &amp; white printed on re-cycled paper. <a href="<?php print $app_path; ?>contact.php">Drop us a line</a> if you're interested or want to send us some artwork.</p>

<h3>Just drop us a line</h3>

<p>We're always interested in feedback, ideas, useful contacts, words of support or money... So feel free to <a href="<?php print $app_path; ?>contact.php">contact us</a>!</p>

<?php
botbit();
?>
