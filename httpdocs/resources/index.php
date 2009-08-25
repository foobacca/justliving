<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
topbit(7);
?>

<h2>Resources</h2>

<p>To view the PDF files you will need to install <a href="http://www.adobe.com/products/acrobat/readstep2.html">Adobe Acrobat Reader</a>, if you do not already have it.</p>

<h3>Ethical Vocabulary</h3>

<ul>
<li><a href="http://en.wikipedia.org/wiki/Organic_certification">Organic Certification</a></li>
<li><a href="http://www.socialfirms.co.uk/">Social Fims</a></li>
<li><a href="http://www.socialenterprise.org.uk/pages/about-social-enterprise.html">Social Enterprises</a></li>
<li><a href="http://www.ica.coop/coop/principles.html">Co-operative Principles</a></li>
<li><a href="http://www.fairtrade.org.uk/what_is_fairtrade/default.aspx">Fair Trade</a></li>
</ul>

<h3>Useful Links</h3>
<ul>
<li><a href="http://www.vegsoc.org/environment/season.html">Seasonal UK Grown Produce</a></li>
<li><a href="http://www.vegansociety.com/">Vegan Society</a></li>
<li><a href="http://www.zen159730.zen.co.uk/Vegetarian_beers.html">Vegetarian Beers</a></li>
<li><a href="http://greenchoices.org/">Green Choices - UK guide to greener living</a></li>
</ul>

<h3><?php print $guide_name; ?> Print Editions</h3>
<ul>
<li><a href="/guide/editions/JustLiving-Summer09.pdf"><strong>Summer '09</strong></a> (4mb PDF)<br />48 page A5 booklet.</li>
<li><a href="/guide/editions/JL03-Winter06.pdf">Winter '06</a> (610kb PDF)<br />36 page A5 booklet.</li>
<li><a href="/guide/editions/JL02-LateAugust06.pdf">Late August '06</a> (854kb PDF)<br />A5 booklet.</li>
<li><a href="/guide/editions/JL01-StrawberryFair06.pdf">Spring '06</a> (693kb PDF)<br />A5 booklet.</li>
</ul>

<!--
<h3><?php print $guide_name; ?> Propaganda</h3>
<p>We've got some useful bits and pieces to help you help us with <?php print $guide_name; ?>.</p>
<ul>
<li><a href="JL_A4_GlobePoster.pdf"><?php print $guide_name; ?> A4 poster</a> (152kb PDF)</li>
<li><a href="JL_A5_GlobeLeaflets.pdf"><?php print $guide_name; ?> A5 leaflets</a> (96kb PDF)</li>
</ul>
-->

<?php
botbit();
