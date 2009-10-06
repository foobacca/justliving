<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit();
?>
<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; Big Text Area Spell Check</h1>

<h2>Backup of listings table</h2>

<?php
// Delete all previous backups
$dir = 'db_backups/';
foreach(glob($dir.'*.*') as $v)
	{
   unlink($v);
	}
print("<p>All previous backups removed from server...</p>");

// Make a new backup
$tables[] = "listings";
$backup_file = backup_tables('localhost','justliving','f98v83bnu2cw','justliving',$tables);

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$backup_file_name = 'db_backups/listings-backup-' . date("Y-m-d-H-i-s") . '.sql';
	$handle = fopen($backup_file_name,'w+');
	fwrite($handle,$return);
	fclose($handle);
	return($backup_file_name);
}

print("<p>Backup complete, filename: $backup_file</p>");

?>

<h2>Edit Text Areas</h2>

<p>These are all the 'descriptions' from listings set to go into print ('Live - needs work' or 'Live - ready to go'). You should be able to use 'Firefox spell check' to check lots of typos. Correct them and then save all the bastards at the same time. That's the theory anyway.</p>

<?php
$sql = "SELECT id, org_name, description FROM listings WHERE state = 'signed off' OR state = 'justliving' ORDER BY org_name";
$result = mysql_query($sql);

if ($myrow = mysql_fetch_array($result)) 
	{
	do 
		{
		?>
		<p>
		<strong><?php print($myrow[org_name]); ?></strong><br />
		<textarea cols="80" rows="20" name="description_<?php print($myrow[id]); ?>" id="description_<?php print($myrow[id]); ?>"><?php print($myrow['description']); ?></textarea>
		</p>
		<?php
		} while ($myrow = mysql_fetch_array($result));
	}
?>

<?php
abotbit();
?>