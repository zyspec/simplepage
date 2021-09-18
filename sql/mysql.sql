CREATE TABLE `simplepage_menuitem` (
  `menuitemId` smallint(3) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` varchar(7) NOT NULL,
  `templateId` smallint(3) unsigned NOT NULL default '0',
  `weight` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`menuitemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `simplepage_page` (
  `pageId` smallint(3) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text NOT NULL,
  `pageName` varchar(32) NOT NULL,
  `templateId` smallint(3) unsigned NOT NULL default '0',
  `isDisplayTitle` tinyint(1) unsigned NOT NULL,
  `commentable` tinyint(1) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `updated` int(11) unsigned NOT NULL,
  `updaterUid` mediumint(8) unsigned NOT NULL,
  `weight` int(11) unsigned NOT NULL,
  `isPublished` tinyint(1) NOT NULL,
  PRIMARY KEY  (`pageId`),
  UNIQUE KEY `pageName` (`pageName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
