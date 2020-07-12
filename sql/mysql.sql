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
(1, '简介', 'Simplepage', '', 0, 463590683),
(2, '模块主要功能', 'feature', '', 0, 708289858),
(5, '发布帖', 'http://xoops.org.cn/modules/newbb/viewtopic.php?topic_id=14604&forum=3&post_id=52089#forumpost52089', '_blank', 0, 1197688208),
(8, '安装说明', 'install', '', 0, 952989033);


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
(2, '安装说明', '<p>xoops 2.0.x需要安装Frameworks 1.20或以及xoopseditor才能安装SimplePage。</p>', 'install', 0, 1, 0, 1197336012, 1224341118, 1, 1197336012, 1),
(5, '这是一个没有加在菜单上的页面', '<p>页面可以不显示在菜单上。</p>', 'not_in_the_menu', 0, 1, 0, 1197688364, 0, 1, 1197688364, 1),
(3, 'Simplepage 模块的主要功能', '<h3>&nbsp;</h3>\r\n<ul>\r\n    <li><font color="#993366">页面自动生成菜单和面包屑</font></li>\r\n    <li><font color="#993366">使用在线编辑器编辑页面</font></li>\r\n    <li><font color="#993366">菜单拖放排序</font></li>\r\n    <li><font color="#993366">通过修改 templates/simplepage_index.html 可以修改页面的布局</font></li>\r\n    <li><font color="#993366">通过修改 templates/simplepage.css 可以修改页面的外观</font></li>\r\n    <li><font color="#993366">配合 clone 模块可以复制成不同的模块</font></li>\r\n</ul>', 'feature', 0, 1, 0, 1197450287, 1197687449, 1, 1197450287, 1),
(4, 'Simplepage 简介', '<p>Xoops功能强大，但制作一些简单页面却比较麻烦。为此开发了 Simplepage 模块，方便生成简单页面。与TinyD、Quickpages 模块类似。开发的基本原则是简单易用，不提供复杂的功能。利用 clone 模块可以复制成多个模块，实现不同的分类页面。</p>', 'Simplepage', 0, 1, 0, 1197527687, 1224340949, 1, 1197527687, 1);
