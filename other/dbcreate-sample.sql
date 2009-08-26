-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2009 at 05:44 PM
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
TRUNCATE TABLE `comments`;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` VALUES(338, '1192477130', '1199829120', 120, 'Mrs.', 'I would like to suscribe to freecycle, but have found it difficult. \r\n\r\nI would like to donate something, but I can''t do it till I am suscribed.', 'A commenter', 'address@hotmail.com', '', 'notlive');
INSERT INTO `comments` VALUES(328, '1187897236', '1199829971', 284, 'ms', 'I would like to find a trailer for my bicycle that would double up as a carrier for my garden tools to take to allotment alongwith something I could use for taking my dog for a walk further afield - he has only three legs so gets tired easily!', 'Jo Fourpack', 'jfourpack@yahoo.co.uk', '', 'notlive');
INSERT INTO `comments` VALUES(331, '1189004703', '1199829082', 120, 'ms', 'what am i supposed to put here?', 'Alexi', '', '', 'notlive');
INSERT INTO `comments` VALUES(333, '1190283473', '1199829106', 120, 'mr', 'i ve got a few beds i want to give away', 'will help', 'will4@yahoo.com', '', 'notlive');
INSERT INTO `comments` VALUES(346, '1196540727', '1199829097', 120, 'We are looking for furniture.', 'I need a washing-machine, fridge freezer, vacuum, dining table with chairs, computer desk, double bed with underbed storage, leather sofa, drawer chest. \r\nThanks for your help.', 'Jill and John', 'jillandjohn@gmail.com', '', 'notlive');

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

INSERT INTO `listings` VALUES(284, '1170789370', '1236162302', 7, 'CamCarts', '', '', 'info@camcarts.co.uk', 'www.camcarts.co.uk', '07909606069', 'CamCarts is a Cambridge-based organisation committed to promoting cycling in the city, and sustainable transport all over the UK.  \r\n\r\nIt hosts a website with lots of information and links all around cycling and eco-issues  in Cambridge, and welcomes contributions of links and information.\r\n\r\nIt also sells the CamCarts bicycle trailer, ideal for transporting larger or heavier loads without the need for a car, or carbon footprint.  Trailers can carry up to 100 kg when used as a hand cart, and 40kg when attached to a moving bike... Ideal for transporting groceries, tools of trade, picnics or hobby supplies.', 'justliving', 'Anke Adams', 'anke.adams@ntlworld.com', '', 1068, 'n', '', '');
INSERT INTO `listings` VALUES(10, '1133392740', '1236253547', 11, 'WWOOF (Willing Workers On Organic Farms)', 'PO Box 2675, Lewes, East Sussex', 'BN7 1RB', 'info@wwoof.org.uk', 'www.wwoof.org.uk', '01273 476286', 'WWOOF organisations compile a list of organic farms that (from time to time) welcome volunteer help, in return for bed and board. When you become a member of a WWOOF organisation, you will be put in contact with these farms, and can contact the farms that interest you and make your own arrangements with them. The aims of WWOOF are to enable people to learn first-hand about organic growing techniques, to enable town-dwellers to experience living and helping on a farm, to help farmers make organic production a viable alternative, and to improve communications within the organic movement. Also see international placements site www.wwoof.org .', 'signed off', '', '', '', 2507, 'n', '', '');
INSERT INTO `listings` VALUES(16, '1133461704', '1234472836', 3, 'National Association of Farmers'' Markets', '', '', 'n/a', 'www.farmersmarkets.net', '', 'Website explaining the unique values of farmers'' markets, and listing farmers'' markets across the UK.', 'justliving', '', '', '', 984, 'n', '', '');
INSERT INTO `listings` VALUES(120, '1144222848', '1243682798', 6, 'Cambridge Freecycle', '', '', 'see website', 'groups.yahoo.com/group/cambridgefreecycle/', '', 'Freecycle is an email / web-based way for getting rid of and collecting unwanted items, for free! The local group has thousands of members who offer hundreds of free items weekly. Members post items they no longer want on the website / mailing list, and anyone interested can contact them. All members of the local community can use the service for free. Local Freecycle groups are moderated by a volunteer from the area. The main rule is "Everything posted must be free, legal, and appropriate for all ages". All items posted on the website are within a reasonable distance of Cambridge.', 'signed off', 'Martha', 'martha.ocurry@ntlworld.com', '', 26034, 'n', '', '');
INSERT INTO `listings` VALUES(58, '1134575553', '1134575553', 9, 'Research / Links?', '', '', '', '', '', 'European Federation of Ethical and Alternative Banks\r\nwww.febea.org\r\n\r\nSome quick links from an email list, not checked yet.\r\nhttp://www.smile.co.uk/ethics.html?loc=l\r\nwww.eiris.org.uk\r\nwww.fste4good.co.uk', 'notlive', '', '', '', 0, 'n', '', '');
INSERT INTO `listings` VALUES(26, '1133462427', '1236200924', 9, 'Charity Bank', 'PO Box 398, \r\n194 High Street, \r\nTonbridge, \r\nKent', 'TN9 9BD', 'enquiries@charitybank.org', 'www.charitybank.org', '01732 774040', 'The bank is working with investors, depositors and borrowers to create a sustainable, alternative finance market that complements the conventional banking system. It reaches those communities and organisations that commercial lenders can''t or won''t assist. Charity Bank offers some accounts with highly effective tax breaks, and all accounts also earn interest which which can be withdrawn by yourself, donated directly to your choice of charity, donated to a Partner Charity, or reinvested in Charity Bank.', 'justliving', '', '', 'Fax: 01372 774069', 970, 'n', '', '');
INSERT INTO `listings` VALUES(27, '1133462498', '1236253392', 9, 'Triodos', 'Brunel House, 11 The Promenade, Bristol', 'BS8 3NN', 'mail@triodos.co.uk', 'www.triodos.co.uk', '01179 739339', 'Triodos Bank basically uses its money to finance the kinds of organisations that we''d list in Just Living! E.g. companies, institutions and projects that add cultural value and benefit people and the environment. They do this with the support of depositors and investors who want to encourage the development of such socially responsible organisations.\r\n\r\nProducts: personal savings, investments, business finance.', 'justliving', '', '', 'Fax: 0117 973 9303', 897, 'n', '', '');
INSERT INTO `listings` VALUES(34, '1134567893', '1236251924', 2, 'Real Seeds', 'Brithdir Mawr Farm, Newport near Fishguard, Pembrokeshire', 'SA42 0QJ', 'info@realseeds.co.uk', 'www.realseeds.co.uk', '', 'Special varieties of vegetable seeds to order by post, paypal, or nochex.\r\n\r\nThe Real Seed Catalogue is a private collection of vegetable varieties selected particularly for the home grower. All have been chosen from personal experience for great taste and simple cultivation. All are non-hybrid, non-genetically-modified, reliable and easy to grow. Their seeds come with sowing instructions, recipes, and seed saving notes.  The Real Seeds people strongly encourage community seed-saving to increase food security, and the website has instructions for saving your own seed for future years, and ideas for starting local seed-saving groups.', 'signed off', '', '', '', 1143, 'n', '', '');
INSERT INTO `listings` VALUES(48, '1134569885', '1243680390', 5, 'Phone Co-op', '5 The Millhouse, Elmsfield Business Centre, Worcester Road, Chipping Norton, Oxon', 'OX7 5XL', 'enquiries@thephone.coop', 'www.thephone.coop', '0845 4589000', 'The only co-operative phone and internet provider in the UK, distributing profits back to the individuals and organisations that own it. It was founded in 1998 with the aim of making cheaper telecommunications services available primarily to the third sector by purchasing collectively. They apply a transparent pricing policy with no ''hidden charges''. They follow environmental best practice in a number of pro-active ways -  by paying to offset all their CO2 emissions, purchasing electricity from a green source, using recycled paper and stationery, developing systems which significantly reduce paper usage, promoting the use of public transport by its employees, and monitoring miles traveled each year by different modes of transport (a detailed breakdown is included in the Annual Report). They also recycle waste office supplies.', 'justliving', '', '', '', 1053, 'n', '', '');
INSERT INTO `listings` VALUES(49, '1134570001', '1236201088', 16, 'Good Energy', 'Good Energy, \r\nFreepost (NAT4921), \r\nChippenham, \r\nWiltshire', 'SN15 1B', 'enquiries@good-energy.co.uk', 'www.good-energy.co.uk', '08454 561640', 'Good Energy is the only UK supplier that supplies only 100% renewable electricity for home and business. It concentrates on building consumer demand for renewable electricity and supports small-scale UK generators, businesses and individuals by buying renewable generation from them. Switching your home to Good Energy is simple. It takes about five minutes to sign up online, over the phone or with a paper copy of the forms.', 'justliving', '', '', 'Cut & paste job from wiki', 1040, 'n', '', '');
INSERT INTO `listings` VALUES(83, '1134579332', '1234472993', 14, 'Soil Association', '', '', 'n/a', 'www.soilassociation.org/farmvisits', '', 'Visit Soil Association certified organic farms.', 'justliving', '', '', '', 834, 'n', '', '');
INSERT INTO `listings` VALUES(86, '1134579472', '1236252812', 14, 'Tourism Concern', 'Stapleton House, 277-281 Holloway Road, London', 'N7 8HN', 'info@tourismconcern.org.uk', 'www.tourismconcern.org.uk', '02071 333330', 'Tourism Concern has been working since 1989 to raise awareness of the negative impacts of tourism, economic, cultural, environment and social. They work with communities in destination countries to reduce social and environmental problems connected to tourism and with the out-going tourism industry in the UK to find ways of improving tourism so that local benefits are increased.\r\n\r\nThey made ''THE GOOD ALTERNATIVE TRAVEL GUIDE'' - Mark Mann (2002 Tourism Concern / Earthscan, 246pp)\r\n\r\nThe new edition has many new projects and updated contact details. It remains the only guidebook to responsible community-based tourism projects, offering ethical travellers hundreds of inspiring holidays.', 'justliving', '', '', '', 1119, 'n', '', '');
INSERT INTO `listings` VALUES(249, '1164489309', '1242851893', 9, 'co-op bank / smile (internet account)', '', '', '', '', '', 'Money''s a bit of a hard one to do ethically, and the co-op bank perhaps exemplifies this. They''re a bit of a funny one - they do have a customer-influenced ethical policy of not investing in certain activities, e.g. the arms trade, and only allowing organisations that follow their ethical policy to bank with them. \r\n\r\nThey still invest in some monstrous big corporate organisations, e.g. Glaxo Smithkline. Also, their parent organisation (The Co-op group) gets up to all sorts of questionable activities, including making money from... the arms trade! - through their investments arm. \r\n\r\nThey do have the only Internet account available with any kind of ethical policy. \r\n\r\nSo basically by using them, you can mitigate some of the worst  problems associated with investing money, while being able to maintain a current account. At the same time, your money will still be invested in some dodgy types, and the profit made will go to a dodgy organisation. \r\n\r\nWe tentatively suggest that this might be the best of a bad bunch for an easily accessible current account, and a more ethical bank can be used to store any long term money.\r\n\r\nAfter two minutes think and two cans of lager - no way! There''s building society accounts that are instant access. DENIED pending further research.', 'placeholder', 'Tom', '', 'dunno if they should go in really. See above.', 0, 'n', '', '');

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

INSERT INTO `listings_categories` VALUES(585, 249, 9);
INSERT INTO `listings_categories` VALUES(513, 86, 14);
INSERT INTO `listings_categories` VALUES(343, 83, 14);
INSERT INTO `listings_categories` VALUES(483, 49, 16);
INSERT INTO `listings_categories` VALUES(628, 48, 5);
INSERT INTO `listings_categories` VALUES(499, 34, 2);
INSERT INTO `listings_categories` VALUES(518, 27, 9);
INSERT INTO `listings_categories` VALUES(480, 26, 9);
INSERT INTO `listings_categories` VALUES(155, 58, 9);
INSERT INTO `listings_categories` VALUES(639, 120, 10);
INSERT INTO `listings_categories` VALUES(638, 120, 6);
INSERT INTO `listings_categories` VALUES(341, 16, 3);
INSERT INTO `listings_categories` VALUES(525, 10, 14);
INSERT INTO `listings_categories` VALUES(524, 10, 11);
INSERT INTO `listings_categories` VALUES(523, 10, 2);
INSERT INTO `listings_categories` VALUES(438, 284, 7);


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

INSERT INTO `news` VALUES(1, 'The idea is born.', '1126695600', 'A couple people chatted to a couple of other people. Some chat in the odd <a href="http://www.cambridgeaction.net">Cambridge Action Network</a> meeting, or down the pub afterwards. And two people decide to have a crack at producing ''some kind of ethical guide to Cambridge''. Before long there''s six of us!');
INSERT INTO `news` VALUES(2, 'The first meeting.', '1128337200', 'First meeting. It seems to be a mixture of ''just what the hell is ethical?'' and ''geek stuff to aid communication within the group''. At the end of it we''ve got a ''to think about list'' and some ''action points'' to get mailing lists, wikis and all that jazz set up. We''ve also got the next meeting date.');
INSERT INTO `news` VALUES(25, 'New edition published', '1245322800', 'We managed to get the Summer ''09 edition of Just Living published just in time for this years Strawberry Fair. The reaction so far has been positive and we''re quickly getting through our print run of 500 copies. \r\n\r\nExpect updates on where you can get hold of a copy soon, in the meantime you can download a PDF of <a href="http://www.justliving.org.uk/guide/editions/JustLiving-Summer09.pdf">Just Living Summer ''09</a> (4MB). You may neeed the free <a href="http://www.adobe.com/products/reader/">Adobe Reader</a> to view the file.\r\n\r\nIf you''d like to help us out with distributing the guides, please do <a href="http://www.justliving.org.uk/contact.php">contact us</a>.');
