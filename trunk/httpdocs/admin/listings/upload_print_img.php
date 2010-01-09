<?php
@(include("../../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");

// Get the $id for the listing
$id = request("id");

// SETUP VARS FOR UPLOAD FORM

// Max size PER file in KB
$max_file_size="4096";

// Max size for all files COMBINED in KB
$max_combined_size="2048";

//How many file uploads do you want to allow at a time?
$file_uploads="1";

//The name of the uploader..
$websitename="Just Living File Uploader";

// Use random file names? true=yes (recommended), false=use original file name. Random names will help prevent overwritting of existing files!
$random_name=true;

// Please keep the array structure.
$allow_types=array("jpg","gif","png");

// Path to files folder. If this fails use $fullpath below. With trailing slash
$folder="../../imgs/listing_imgs/";

// Full url to where files are stored. With Trailing Slash
$full_url="http://www.YOUR_SITE.com/uploads/";

// Only use this variable if you wish to use full server paths. Otherwise leave this empty! With trailing slash
$fullpath="";


// UPLOAD FUNCTIONS

// Function to get the extension a file.
function get_ext($key) { 
	$key=strtolower(substr(strrchr($key, "."), 1));
	// Cause there the same right?
	$key=str_replace("jpeg","jpg",$key);
	return $key;
}

$ext_count=count($allow_types);
$i=0;
foreach($allow_types AS $extension) {
	
	//Gets rid of the last comma for display purpose..
	
	If($i <= $ext_count-2) {
		$types .="*.".$extension.", ";
	} Else {
		$types .="*.".$extension;
	}
	$i++;
}
unset($i,$ext_count); // why not

$error="";
$display_message="";
$uploaded==false;

$password_form = request('password_form','post');
// Dont allow post if $password_form has been populated
If($_POST['submit']==true AND $password_form != null) {

	For($i=0; $i <= $file_uploads-1; $i++) {
					
		If($_FILES['file']['name'][$i]) {
						
			$ext=get_ext($_FILES['file']['name'][$i]);
			$size=$_FILES['file']['size'][$i];
			$max_bytes=$max_file_size*1024;
			
			// For random names
			If($random_name){
				$file_name[$i]=time()+rand(0,100000).".".$ext;
			} Else {
				$file_name[$i]=$_FILES['file']['name'][$i];
			}
			
			//Check if the file type uploaded is a valid file type. 
						
			If(!in_array($ext, $allow_types)) {
							
				$error.= "Invalid extension for your file: ".$_FILES['file']['name'][$i].", only ".$types." are allowed.<br />Your file(s) were <b>not</b> uploaded.<br />";
							
				//Check the size of each file
							
			} Elseif($size > $max_bytes) {
				
				$error.= "Your file: ".$_FILES['file']['name'][$i]." is to big. Max file size is ".$max_file_size."kb.<br />Your file(s) were <b>not</b> uploaded.<br />";
				
				// Check if the file already exists on the server..
			} Elseif(file_exists($folder.$file_name[$i])) {
				
				$error.= "The file: ".$_FILES['file']['name'][$i]." exists on this server, please rename your file.<br />Your file(s) were <b>not</b> uploaded.<br />";
				
			}
						
		} // If Files
	
	} // For
	
	//Tally the size of all the files uploaded, check if it's over the ammount.
				
	$total_size=array_sum($_FILES['file']['size']);
	  			
	$max_combined_bytes=$max_combined_size*1024;
				
	If($total_size > $max_combined_bytes) {
		$error.="The max size allowed for all your files combined is ".$max_combined_size."kb<br />";
	}
		
	
	// If there was an error take notes here!
	
	If($error) {
		
		$display_message=$error;
		
	} Else {
		
		// No errors so lets do some uploading!
		
		For($i=0; $i <= $file_uploads-1; $i++) {
				
			If($_FILES['file']['name'][$i]) {
				
				If(@move_uploaded_file($_FILES['file']['tmp_name'][$i],$folder.$file_name[$i])) {
					$uploaded=true;
				} Else {
					$display_message.="Couldn't copy ".$file_name[$i]." to server, please make sure ".$folder." is chmod 777 and the path is correct.\n";
				}
			}
				
		} //For
		
	} // Else
	
} // $_POST AND !$password_form

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Just Living Admin</title>
<style type="text/css" media="all">@import "/css/admin.css";</style>
</head>
<body>

<h1><a href="<?php print $app_path; ?>admin/">Just Living Admin</a> &gt; <a href="index.php">Listings</a> &gt; <a href="edit.php?id=<?php print($id); ?>">Add / Edit</a> &gt; Upload Print Image</h1>

<?php
If($password_form != null)
	{
	Echo $password_form;
	} 
Elseif($uploaded==true)
	{
	?>
	<h2>Your image has been uploaded.</h2>
	<?php
	For($i=0; $i <= $file_uploads-1; $i++)
		{
		If($_FILES['file']['name'][$i])
			{
			$file=$i+1;
			
			// UPDATE THE DATABASE
			$sql = "UPDATE listings SET print_img = '" . $file_name[$i] . "' WHERE id = $id";
			$result = mysql_query($sql);
			
			//Echo("<p><b>File #".$file.":</b> ".$full_url.$file_name[$i]."</p>\n");
			}
		}
	
	// Print link back to edit listing
	print("<p><strong><a href=\"edit.php?id=$id\">Back to editing the listing</a></strong></p>");

	} 
Else // UPLOAD FORM
	{

	If($display_message)
		{
		?>
		<p><strong><?php print $display_message; ?></strong></p>
		<?php
		}
	?>

<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="phuploader">

<fieldset>
<legend>Upload Image</legend>

<p>
<strong>Allowed File Types:</strong> <?php print $types; ?><br />
<strong>Max size per file:</strong> <?php print $max_file_size; ?>kb.<br />
<strong>The file has no dimension restrictions, but as it's for print, the resolution should be 300dpi and size around 3x3cm.</strong>
</p>
		
	<?php
	For($i=0;$i <= $file_uploads-1;$i++)
		{
		?>
		<p><b>Select File:</b>
		<input type="file" name="file[]" size="30" /></p>
		<?php
		}
	?>
	
<p>
<input type="hidden" name="submit" value="true" />
<input type="hidden" name="id" value="<?php print($id); ?>" />
<input type="submit" value=" Upload Image" />
</p>

</fieldset
</form>

	<?php
	}
?>

</body>
</html>
