Once you've played with the code, you'll want to make the site yours.

## First steps - config.php ##

  * Pick a domain name. Buy it!
  * Edit config.php:
    1. Set the city name.
    1. Set email address.
    1. Set wiki location.
    1. Sort out paypal stuff.

## Sort out the text on various pages ##

  * Edit other/dbcreate-categories.sql - You need to choose categories. Write introductions. Then run the following command (note that it deletes everything in your existing database!):
```
$ cd ~/justliving/
$ mysql -p -u justliving justliving < other/dbcreate-sample.sql
```

  * Now edit the following files. This is just changing text:there is no computer coding here!
    1. httpdocs/stockists/index.php
    1. httpdocs/about.php
    1. httpdocs/resources/index.php
    1. httpdocs/getinvolved.php
    1. httpdocs/principles/index.php

## The database ##

  * Now start populating the database...

## Look and feel - the CSS and logos ##

  * You will want to adjust the .css so that the style is what you want.

_The below needs to checked_

JL\_Logo.gif is used in the "topbar" div element which appears on every page (I think!).

guide-couple.gif is used on the root page, in the bottom right corner of the listings
box.

admin.gif appears on every page at the bottom (link to the admin section)

## Anything else ##

?