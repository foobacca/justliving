<?php
@(include("config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(6);
?>

<h2>Contact <?php print $guide_name; ?></h2>

<p>If you want to get involved in <?php print $guide_name; ?>, have some feedback or just want to drop us a line, email <strong>info [at] justliving [dot] org [dot] uk</strong></p>

<p><strong>Note:</strong> Please use <a href="<?php print $app_path; ?>guide/submit.php">the correct page for submitting or suggesting listings</a>.</p>

<?php
botbit();
?>
