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
TRUNCATE TABLE `categories`;

--
-- Dumping data for table `categories`
--

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
TRUNCATE TABLE `comments`;

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
TRUNCATE TABLE `flags`;

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
TRUNCATE TABLE `listings`;

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
TRUNCATE TABLE `listings_categories`;

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
TRUNCATE TABLE `listings_flags`;

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
TRUNCATE TABLE `news`;

--
-- Dumping data for table `news`
--

