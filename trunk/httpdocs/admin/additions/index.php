<?php
include("/home/httpd/vhosts/justliving.org.uk/phpincs/funcs.php");
atopbit();
?>

<h1><a href="/admin/">Just Living Admin</a> &gt; Additions</h1>

<h2>View</h2>

<ul>
<?php
$n_not_live = mysql_num_rows(mysql_query("SELECT id FROM comments WHERE state = 'notlive'"));
$n_unchecked = mysql_num_rows(mysql_query("SELECT id FROM comments WHERE state = 'unchecked'"));
$n_checked = mysql_num_rows(mysql_query("SELECT id FROM comments WHERE state = 'checked'"));
$n_all = mysql_num_rows(mysql_query("SELECT id FROM comments"));

if (!$view) {$view = "unchecked";}	

if ($view == "notlive")
	{
	$where = "WHERE state = 'notlive'";
	?>
	<li><span class="bolder">Rejected</span> (<?php print($n_not_live); ?>)</li>
	<li><a href="index.php?view=unchecked">Unchecked</a> (<?php print($n_unchecked); ?>)</li>
	<li><a href="index.php?view=checked">Live</a> (<?php print($n_checked); ?>)</li>
	<li><a href="index.php?view=all">All Additions</a> (<?php print($n_all); ?>)</li>
	</ul>
	<h2>List 'Rejected' Additions</h2>
	<?php
	}
elseif ($view == "unchecked")
	{
	$where = "WHERE state = 'unchecked'";
	?>
	<li><a href="index.php?view=notlive">Rejected</a> (<?php print($n_not_live); ?>)</li>
	<li><span class="bolder">Unchecked</span> (<?php print($n_unchecked); ?>)</li>
	<li><a href="index.php?view=checked">Live</a> (<?php print($n_checked); ?>)</li>
	<li><a href="index.php?view=all">All Additions</a> (<?php print($n_all); ?>)</li>
	</ul>
	<h2>List 'Unchecked' Additions</h2>
	<?php
	}
elseif ($view == "checked")
	{
	$where = "WHERE state = 'checked'";
	?>
	<li><a href="index.php?view=notlive">Rejected</a> (<?php print($n_not_live); ?>)</li>
	<li><a href="index.php?view=unchecked">Unchecked</a> (<?php print($n_unchecked); ?>)</li>
	<li><span class="bolder">Live</span> (<?php print($n_checked); ?>)</li>
	<li><a href="index.php?view=all">All Additions</a> (<?php print($n_all); ?>)</li>
	</ul>
	<h2>List 'Live' Additions</h2>
	<?php
	}
elseif ($view == "all")
	{
	$where = "";
	?>
	<li><a href="index.php?view=notlive">Rejected</a> (<?php print($n_not_live); ?>)</li>
	<li><a href="index.php?view=unchecked">Unchecked</a> (<?php print($n_unchecked); ?>)</li>
	<li><a href="index.php?view=checked">Live</a> (<?php print($n_checked); ?>)</li>
	<li><span class="bolder">All Additions</span> (<?php print($n_all); ?>)</li>
	</ul>
	<h2>List 'All' Additions</h2>
	<?php
	}

?>


<?php
print("<ul>");
$cresult = mysql_query("SELECT id, listing_id, title FROM comments $where ORDER BY add_ts"); 
if ($cmyrow = mysql_fetch_array($cresult)) 
	{
	do 
		{

		print("<li><a href=\"edit.php?id=" . $cmyrow["id"] . "\">View Addition</a>");

		// Get listing name
		$lresult = mysql_query("SELECT org_name FROM listings WHERE id = " . $cmyrow["listing_id"]); 
		if ($lmyrow = mysql_fetch_array($lresult)) 
			{
			print(" - " . $lmyrow["org_name"] . "</li>\n");
			}
		else
			{
			// There's no matching listing for this addition, so delete the edition
			mysql_query("DELETE FROM comments WHERE id = " . $cmyrow["id"]); 
			}		
						
		} while ($cmyrow = mysql_fetch_array($cresult));
	}	
print("</ul>");

abotbit();
?>