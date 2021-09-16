CREATE TABLE `simplepage_menuitem` (
  `menuitemId` smallint(3) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target` varchar(7) NOT NULL,
  `templateId` smallint(3) unsigned NOT NULL default '0',
  `weight` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`menuitemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;


INSERT INTO `simplepage_menuitem` (`menuitemId`, `title`, `link`, `target`, `templateId`, `weight`) VALUES
(1, 'Introduction', 'Simplepage', '', 0, 463590683),
(2, 'Main functions of the module', 'feature', '', 0, 708289858),
(5, 'Post a post', 'https://xoops.org.cn/modules/newbb/viewtopic.php?topic_id=14604&forum=3&post_id=52089#forumpost52089', '_blank', 0, 1197688208),
(8, 'Installation Notes', 'install', '', 0, 952989033);


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


INSERT INTO `simplepage_page` (`pageId`, `title`, `content`, `pageName`, `templateId`, `isDisplayTitle`, `commentable`, `created`, `updated`, `updaterUid`, `weight`, `isPublished`) VALUES
(2, 'Installation Notes', '<p>XOOPS 2.0.x Need to install Frameworks 1.20 and/or xoopseditor to install SimplePage。</p>', 'install', 0, 1, 0, 1197336012, 1224341118, 1, 1197336012, 1),
(5, 'This is a page not added to the menu', '<p>The page may not be displayed on the menu.</p>', 'not_in_the_menu', 0, 1, 0, 1197688364, 0, 1, 1197688364, 1),
(3, 'Simplepage Main functions of the module', '<h3>&nbsp;</h3>\r\n<ul>\r\n    <li><font color="#993366">Menu and breadcrumbs are automatically generated on the page</font></li>\r\n    <li><font color="#993366">Use the online editor to edit the page</font></li>\r\n    <li><font color="#993366">Menu drag and drop sort</font></li>\r\n    <li><font color="#993366">By modification of templates/simplepage_index.html the layout of the page can be modified</font></li>\r\n    <li><font color="#993366">By modification of templates/simplepage.css You can modify the appearance of the page</font></li>\r\n    <li><font color="#993366">Simplepages can be cloned using Smartclone</font></li>\r\n</ul>', 'feature', 0, 1, 0, 1197450287, 1197687449, 1, 1197450287, 1),
(4, 'Simplepage Introduction', '<p>XOOPS is powerful CMS/Framework but it can be overwhelming if all you want is to  make some simple pages. Simplepage is a module to facilitate the generation of simple pages. There are other XOOPS modules (TinyD、Quickpages) which are similar. The basic principle of development is keep this module simple and easy to use. Simplepages does not provide complicated functions (categories, article linking, etc.). The Smartclone module can be used to create multiple modules to realize different classification pages.</p>', 'Simplepage', 0, 1, 0, 1197527687, 1224340949, 1, 1197527687, 1);
