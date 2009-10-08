<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();

// Get the vars
$category = request("category","post");
$status = request("status","post");
$flag_id = request("flag","post");
?>

<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; Listings</h1>

<h2>Functions</h2>
<ul>
<li><a href="edit.php">Add New Listing</a></li>
<li><a href="index.php?nowelcomemailsent=y">View all listings which haven't been sent a welcome email</a></li>
</ul>

<h2>Filter Listings</h2>
<form method="post" action="index.php">
<table>
<tr>
	<th>Category</th>
	<th>Status</th>
	<th>Flag</th>
	<th></th>
</tr>
<tr>
<td>
<select name="category">
<option value="">-</option>
<?php
$result = mysql_query("SELECT id, name FROM categories ORDER BY seq"); 
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		if ($category == $myrow["id"])
			{
			print("<option value=\"" . $myrow["id"] . "\" selected=\"selected\"> " . $myrow["name"] . "</option>\n");
			}
		else
			{
			print("<option value=\"" . $myrow["id"] . "\"> " . $myrow["name"] . "</option>\n");
			}	
		} while ($myrow = mysql_fetch_array($result));
	}
?>
</select>
</td>
<td>
<select name="status">
<option value="">-</option>
<option value="all-live" <?php if ($status == "all-live") {print("selected=\"selected\"");} ?>>All Live</option>
<option value="ready-to-go" <?php if ($status == "ready-to-go") {print("selected=\"selected\"");} ?>>Live - ready to go</option>
<option value="needs-work" <?php if ($status == "needs-work") {print("selected=\"selected\"");} ?>>Live - needs work</option>
<option value="placeholder" <?php if ($status == "placeholder") {print("selected=\"selected\"");} ?>>Placeholder</option>
<option value="unchecked" <?php if ($status == "unchecked") {print("selected=\"selected\"");} ?>>Unchecked</option>
<option value="rejected" <?php if ($status == "rejected") {print("selected=\"selected\"");} ?>>Rejected</option>
</select>
</td>
<td>
<select name="flag">
<option value="">-</option>
<?php
$result = mysql_query("SELECT id, name FROM flags ORDER BY seq"); 
if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		if ($flag == $myrow["id"])
			{
			print("<option value=\"" . $myrow["id"] . "\" selected=\"selected\"> " . $myrow["name"] . "</option>\n");
			}
		else
			{
			print("<option value=\"" . $myrow["id"] . "\"> " . $myrow["name"] . "</option>\n");
			}	
		} while ($myrow = mysql_fetch_array($result));
	}
?>
</select>
</td>
<td><input type="submit" name="submit" class="submit" value="Filter" style="margin: 0;" /></td>
</tr>
</table>
</form>

<h2>View / Edit Listings</h2>
<p>Click the table headings to re-sort the listings.</p>
<form method="post" action="email-listings.php">
<table class="sortable" id="listings">
<tr>
	<th>@</th>
	<th>Title</th>
	<th>Status</th>
	<th>Print Category</th>
	<th>Last Modified</th>
	<th>&nbsp;</th>
</tr>
<?php
// Check to see if this is 'no welcome email list' or not
$nowelcomemailsent = request("nowelcomemailsent","get");

// Run the SQL
if ($nowelcomemailsent == 'y')
	{
	$result = mysql_query("SELECT id, edit_ts, cat_id, org_name, state FROM listings WHERE welcome_email_sent = 'n' ORDER BY org_name");
	}
else
	{
	// Build the $where
        $where = "";
	
	// Search by category
	if ($category)
		{
		$where .= "l.cat_id = $category AND ";
		}
		
	// Search by status
	if ($status == "all-live")
		{
		$where .= "(l.state = 'signed off' OR l.state = 'justliving') AND ";
		}
	elseif ($status == "ready-to-go")
		{
		$where .= "l.state = 'signed off' AND ";
		}
	elseif ($status == "needs-work")
		{
		$where .= "l.state = 'justliving' AND ";
		}
	elseif ($status == "placeholder")
		{
		$where .= "l.state = 'placeholder' AND ";
		}
	elseif ($status == "unchecked")
		{
		$where .= "l.state = 'unchecked' AND ";
		}
	elseif ($status == "rejected")
		{
		$where .= "l.state = 'notlive' AND ";
		}
		
	// Search by flag
	if ($flag_id)	
		{
		$where .= "lf.flag_id = $flag_id AND ";
		}
	
	// Cut last AND
	$where = substr($where, 0, -5);
	
	if ($where)
		{
		$sql = "SELECT DISTINCT  l.id, l.edit_ts, l.cat_id, l.org_name, l.state, l.email FROM listings l LEFT JOIN listings_flags lf ON l.id = lf.listing_id WHERE $where ORDER BY l.org_name";
		}
	else
		{
		$sql = "SELECT DISTINCT  l.id, l.edit_ts, l.cat_id, l.org_name, l.state, l.email FROM listings l LEFT JOIN listings_flags lf ON l.id = lf.listing_id ORDER BY l.org_name";
		}
	
	// Run SQL
	$result = mysql_query($sql) OR print($sql);
	}
	
// Run through results
//$numbers = [];
$numbers["notprocessed"] = 0;
$numbers["live"] = 0;
$numbers["rejected"] = 0;
$nowebcat = false;
if ($lmyrow = mysql_fetch_array($result))
	{
	do
		{
		
		// Do a check, if no 'web categories' selected, highlight
		$checkresult = mysql_query("SELECT id FROM listings_categories WHERE listing_id = " . $lmyrow["id"] . "");
		if ($checkmyrow = mysql_fetch_array($checkresult))
			{
			print("<tr>");
			}
		else
			{
			print("<tr style=\"background: yellow;\">");
			$nowebcat = true;
			}
			
		// Email Checkbox
		if(isset($lmyrow["email"]))
			{
			print("<td><input name=\"listings[]\" type=\"checkbox\" value=\"" . $lmyrow["id"] . "\" checked=\"checked\" /></td>");
			}
		else
			{
			print("<td></td>");
			}
		
		// Org Name
		print("<td><a href=\"edit.php?id=" . $lmyrow["id"] . "\">" . $lmyrow["org_name"] . "</a></td>");
			
		// Status
		if ($lmyrow["state"] == "placeholder")
			{
			$numbers["notprocessed"]++;
			print("<td style=\"background-color: aqua; color: white;\">Placeholder</td>");
			}
		elseif ($lmyrow["state"] == "unchecked")
			{
			$numbers["notprocessed"]++;
			print("<td style=\"background-color: red; color: white;\">Unchecked</td>");
			}
		elseif ($lmyrow["state"] == "justliving")
			{
			$numbers["live"]++;
			print("<td style=\"background-color: yellow;\">Live - needs work</td>");
			}
		elseif ($lmyrow["state"] == "signed off")
			{
			$numbers["live"]++;
			print("<td style=\"background-color: green; color: white;\">Live - ready to go</td>");
			}
		elseif ($lmyrow["state"] == "notlive")
			{
			$numbers["rejected"]++;
			print("<td style=\"background-color: black; color: white;\">Rejected</td>");
			}
		
		// Category
		print("<td>");
		$cresult = mysql_query("SELECT name FROM categories WHERE id = " . $lmyrow["cat_id"]);
		if ($cmyrow = mysql_fetch_array($cresult))
			{
			print($cmyrow["name"]);
			}
		print("</td>");
			
		// Last Mod Date
		print("<td>" . timestamptodate( $lmyrow["edit_ts"] ) . "</td>");
		
		// Edit Link
		print("<td><a href=\"edit.php?id=" . $lmyrow["id"] . "\">Edit</a>");
		if ($nowebcat)
			{
			print(" <strong>NO WEB CATEGORY</strong>");
			}
		print("</td>");
		print("</tr>");
		
		$nowebcat = false;
		
		} while ($lmyrow = mysql_fetch_array($result));
	}
?>
</table>
<p><input type="submit" name="submit" class="submit" value="Send Email to checked listings" /></p>
</form>

<h2>Listing Numbers</h2>

<ul>
<?php
print("<li><strong>TOTAL:</strong> " . ($numbers["notprocessed"] + $numbers["live"] + $numbers["rejected"]) . "</li>");
print("<li><strong>Live:</strong> " . $numbers["live"] . "</li>");
print("<li><strong>Unchecked:</strong> " . $numbers["notprocessed"] . "</li>");
print("<li><strong>Rejected:</strong> " . $numbers["rejected"] . "</li>");

$result = mysql_query("SELECT id, email FROM listings WHERE email != ''");
$email = 0;
if ($myrow = mysql_fetch_array($result))
	{
	do
		{
		$email++;
		} while ($myrow = mysql_fetch_array($result));
	}
print("<li><strong>Listings with email addresses:</strong> $email</li>");
?>
</ul>

<?php
abotbit();
?>
