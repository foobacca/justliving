-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Server version: 3.23.58
-- PHP Version: 4.3.7



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `justliving`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `seq` mediumint(9) NOT NULL default '0',
  `name` varchar(150) NOT NULL default '',
  `introduction` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=18 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 10, 'Housing', 'Everyone deserves a roof over their heads... opt for co-ops, low-impact living, co-housing, housing associations, and all those lovely things.');
INSERT INTO `categories` VALUES(2, 20, 'Food: Grow your own', 'Grow your own with the environment in mind. Let''s tighten up that carbon footprint, save a few food miles and aim for a sustainable argicultural system. So we''re talking allotments, grower groups, sources of organic plants, seeds and places for info.');
INSERT INTO `categories` VALUES(3, 30, 'Food: Groceries &amp; Catering', 'If you can''t grow your own then at least make sure you check out our listings of local farm shops, farmers markets, organic, fair-trade, box schemes, food co-ops, wholesalers, caterers.');
INSERT INTO `categories` VALUES(4, 40, 'Food: Eating Out', 'Here you''re likely to find vegan / vegetarian friendly places to eat that make an effort to stock organic, local or fair trade stuff. Cambridge is not particularly famed for its quality, affordable cuisine and only has a few righteous hot food outlets. However, many places do vegan and vegetarian meals, especially outside the traditional British pub fare scene. Indian restaurants have lots of veg options without dairy products in (and some with, e.g. nan bread; dishes made with butter or cream - so ask), and Mediterranean, Middle Eastern, and East Asian eateries like Chinese and Thai (although ask about fish paste and sauce!) are good bets too. In general it''s good to check, then you''ll be sure and they''ll know there''s a demand.');
INSERT INTO `categories` VALUES(5, 50, 'Services', 'There are plenty of companies out there providing services which put people before profit. Business services, utilities, re-use & re-cycle schemes.');
INSERT INTO `categories` VALUES(6, 60, 'Community Resources', 'Libraries, community centres, advice centres... Anything that''s accessible and used by the local community for the common good.');
INSERT INTO `categories` VALUES(7, 70, 'Transport', 'So we''ve all got to get around. However, some forms of transport have less environmental impact than others with flying definitely at the bottom of the pile. So we''re promoting public transport, bikes, rickshaws, car share schemes and car co-ops.');
INSERT INTO `categories` VALUES(8, 80, 'Work', 'We just love co-ops, non-profits, organisations doing progressive stuff such as working with minority groups; working for free; and other forms of employment that take into account the fact that money isn''t everything. So they''ll be in here then.');
INSERT INTO `categories` VALUES(9, 90, 'Finance', 'Alternative currency schemes, participatory economics and ethical banking options are all ways to improve the name of finance.');
INSERT INTO `categories` VALUES(10, 100, 'Shopping', 'Buying some things may be inevitable. But where from? Can consumerism be ethical? Here''s a few of the alternative options to make a start...');
INSERT INTO `categories` VALUES(11, 110, 'Volunteering', 'Volunteering is highly rewarding and can often be a great learning experience. There are plenty of organisations and projects that rely on people giving away some of their time. Here are listings of  local organisations that take on or support volunteers.');
INSERT INTO `categories` VALUES(12, 120, 'Activism', 'Why not take an active role! Whether it''s about the environment, politics or social issues, change is the only way forward and it''s up to all of us to make it the change we want to see.');
INSERT INTO `categories` VALUES(13, 130, 'Spare Time: Inside Cambridge', 'Some ways to while the time away while waiting for the revolution to be announced on Facebook...');
INSERT INTO `categories` VALUES(14, 140, 'Spare Time: Outside Cambridge', 'So some times you need to get out of Cambridge for a while. Who can blame you? Here are some exciting alternatives supporting local communities by reducing the social, environmental and economic impacts of our traveler''s footprint.');
INSERT INTO `categories` VALUES(15, 200, 'Unsure', 'Just to hold stuff people aren''t sure of a category for yet...');
INSERT INTO `categories` VALUES(16, 45, 'Energy', 'Our energy use affects the ecosystem that we share with everyone on the planet. This guide promotes renewable energy sources and ways to use less energy. See the further reading resources for a discussion of ''green'' energy.');
INSERT INTO `categories` VALUES(17, 150, 'Cambridge University', 'Anything going on that''s ''Proper Positive'' going on in the Cambridge University.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `add_ts` varchar(11) NOT NULL default '',
  `edit_ts` varchar(11) NOT NULL default '',
  `listing_id` mediumint(8) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `submit_name` varchar(100) NOT NULL default '',
  `submit_email` varchar(100) NOT NULL default '',
  `notes` text NOT NULL,
  `state` enum('notlive','unchecked','checked') NOT NULL default 'unchecked',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=493 ;

--
-- removed data for comments
--

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE IF NOT EXISTS `flags` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `seq` mediumint(9) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` VALUES(1, 'Will stock guides', 0);
INSERT INTO `flags` VALUES(2, 'Will stock posters', 0);
INSERT INTO `flags` VALUES(3, 'Will stock leaflets', 0);
INSERT INTO `flags` VALUES(4, 'Will stock biz cards', 0);
INSERT INTO `flags` VALUES(5, 'Further action required', 0);
INSERT INTO `flags` VALUES(6, 'Latest email bounced', 0);
INSERT INTO `flags` VALUES(7, 'Is stocking guides', 0);

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `add_ts` varchar(11) NOT NULL default '',
  `edit_ts` varchar(11) NOT NULL default '',
  `cat_id` mediumint(8) unsigned NOT NULL default '0',
  `org_name` varchar(200) NOT NULL default '',
  `address` text NOT NULL,
  `postcode` varchar(8) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `website` varchar(100) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `description` text NOT NULL,
  `state` enum('placeholder','notlive','unchecked','justliving','signed off') NOT NULL default 'unchecked',
  `submit_name` varchar(100) NOT NULL default '',
  `submit_email` varchar(100) NOT NULL default '',
  `notes` text NOT NULL,
  `views` mediumint(8) unsigned NOT NULL default '0',
  `welcome_email_sent` enum('n','y') NOT NULL default 'n',
  `web_img` varchar(30) NOT NULL default '',
  `print_img` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=424 ;

--
-- Dumping data for table `listings`
--


-- --------------------------------------------------------

--
-- Table structure for table `listings_categories`
--

CREATE TABLE IF NOT EXISTS `listings_categories` (
  `id` mediumint(8) NOT NULL auto_increment,
  `listing_id` mediumint(8) NOT NULL default '0',
  `category_id` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=690 ;

--
-- Dumping data for table `listings_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `listings_flags`
--

CREATE TABLE IF NOT EXISTS `listings_flags` (
  `id` mediumint(8) NOT NULL auto_increment,
  `listing_id` mediumint(8) unsigned NOT NULL default '0',
  `flag_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=94 ;

--
-- Dumping data for table `listings_flags`
--


-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `headline` varchar(100) NOT NULL default '',
  `date` varchar(11) NOT NULL default '',
  `article` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=26 ;

--
-- Dumping data for table `news`
--

