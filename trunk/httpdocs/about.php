<?php
@(include("config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(5);
?>

<div id="rightcol">
<h3>Latest News</h3>
<?php
$result = mysql_query("SELECT id, headline, date FROM news ORDER BY date DESC LIMIT 0,5"); 
	if ($myrow = mysql_fetch_array($result)) 
		{
		do 
			{
			print("<p><span class=\"date\">" . date("jS F y",$myrow["date"]) . "</span><br /><a href=\"/news.php?id=" . $myrow["id"] . "\">" . $myrow["headline"] . "</a></p>\n");
			} while ($myrow = mysql_fetch_array($result));
		}	
?>
<p>&nbsp;<br /><a href="/news.php">News Archive</a></p>
</div>

<h2>About <?php print $guide_name; ?></h2>

<p><?php print $guide_name; ?> is a directory of socially responsible organisations doing proper positive stuff in <?php print $city; ?>. What does this mean? Good question; read our <a href="/principles/">principles</a> for some idea of where we're coming from and what we want to promote.</p>

<p>We hope that the guide will make it easier for people new to <?php print $city; ?> to find their way around; that long-term residents will find new stuff of interest; that anyone searching on the internet for organisations will easily find complete details; and that organisations listed will find out about, collaborate with, and support each other. We've heard of examples of this happening, which makes us feel warm and fuzzy, unless that was the whisky.</p>

<p>The guide is open to submissions from the public through the <a href="/guide/submit.php">form on the website</a>; these are checked and included in the guide as appropriate.</p>

<p>Anything that happens on the guide, e.g. revisions, maintenance, promotion, printing etc. is done on-and-off by a group of volunteers, making decisions by consensus. We don't sell advertising in the guide and any donations go towards costs of production - everyone involved does it for the love of it. There's lot of ways to <a href="getinvolved.php">get involved</a> or <a href="contact.php">contact us</a> if you have any questions.</p>

<h2>&nbsp;</h2>
<h2>History of <?php print $guide_name; ?></h2>

<h3>2008, Winter</h3>

<p>The times are a-changing. The credit crunch is upon us; Capitalism is facing some tough questions; Obama is about to take a turn at world domination; and global warming is gently heating us like the frog in the pan. Two of the original JL collaborators find themselves living in the same house, and a new wave of <?php print $city; ?> activism results in interest in reviving the guide, under the slightly less preachy subtitle of "<?php print $guide_subtitle; ?>". Let's get to it! Watch out for a facts-checked, newly devised, slickly revised and freshly evangelised A4 version coming soon to a right-on outlet near you.</p>

<h3>2007</h3>

<p>Some of the original contributors and enthusiasts moved away from <?php print $city; ?> for various reasons or got involved in other projects or their own lives, and <?php print $guide_name; ?> went into a semi-sleeping state, gently nudged occasionally when someone suggested a new organisation, or mentioned that one of the listed ones had changed or ceased to function. New residents in the city continued to use the website and give positive feedback, and things ticked over for two years.</p>

<h3>2006, Winter</h3>

<p><?php print $guide_name; ?> was published in a professional print run of a few hundred copies, offered for a suggested donation of 50p to cover costs. The stock was bought up in a few months, mainly through distribution at Arjuna Wholefoods and Libra Aries bookshop, as well as some in local farm shops and some given away to local ragamuffins, or flogged at Strawberry Fair to passing punters.</p>

<h3>2006</h3>

<p>The website came into being as the basis for the guide, with the ability for visitors to add their own suggestions. Lots of content added, the gang started some abortive collaborations with a student group, we made a bid for city council funding, promoted the guide in local venues and media, and knocked out some hand-made printed versions.</p>

<h3>2005, Autumn</h3>

<p><?php print $guide_name; ?> was born as an idea when a wily bunch of <?php print $city; ?> residents started talking about putting together what was then "an ethical guide to <?php print $city; ?>". </p>

<?php
botbit();
?>
