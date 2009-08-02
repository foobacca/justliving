<?php
@(include("../config.php")) OR die("Could not find config.php. Make sure you have copied config.php.sample to config.php");
atopbit($css_path, );
?>
<h1><a href="/admin/">Just Living Admin</a> &gt; Help</h1>

<h2>Help with Just Living Admin</h2>

<h3>HTML Form Input</h3>
<p>The description of a listing allows HTML tags to use for formatting. Learning HTML is pretty easy, here's some of the basics...</p>

<table>
<tr>
	<th>What you type</th>
	<th>What happens</th>
</tr>
<tr>
	<td>Something here</td>
	<td>Something here</td>
</tr>
<tr>
	<td>&lt;strong&gt;Something here&lt;/strong&gt;</td>
	<td><strong>Something here</strong></td>
</tr>
<tr>
	<td>&lt;em&gt;Something here&lt;/em&gt;</td>
	<td><em>Something here</em></td>
</tr>
<tr>
	<td>&lt;a href="http://www.google.com"&gt;Something here&lt;/a&gt;</td>
	<td><a href="http://www.google.com">Something here</a></td>
</tr>
<tr>
	<td>&lt;a href="mailto:andyt@dspoke.com"&gt;Something here&lt;/a&gt;</td>
	<td><a href="mailto:andyt@dspoke.com">Something here</a></td>
</tr>
<tr>
	<td>&lt;ul&gt;<br />&lt;li&gt;Something here&lt;/li&gt;<br />&lt;/ul&gt;</td>
	<td><em>Something here</em></td>
</tr>
</table>
<?php
abotbit();
?>