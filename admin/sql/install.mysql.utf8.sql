--
-- Tabellenstruktur für Tabelle `#__bookmarks`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT '0',
  `title` varchar(250) DEFAULT '',
  `url` text,
  `description` text,
  `detail` text,
  `imageurl` varchar(250) DEFAULT '',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `rating` float(3,2) DEFAULT '0.00',
  `ratingcount` int(11) DEFAULT '0',
  `ratingadmin` tinyint(3) DEFAULT '0',
  `hits` int(11) DEFAULT '0',
  `published` tinyint(1) DEFAULT '0',
  `access` tinyint(3) DEFAULT '0',
  `checked_out` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `archived` tinyint(1) DEFAULT '0',
  `approved` tinyint(1) DEFAULT '1',
  `validated` varchar(5) DEFAULT '0',
  `validationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `validationstatus` varchar(250) DEFAULT '',
  `pagerank` tinyint(2) DEFAULT '-1',
  `redirect` tinyint(1) DEFAULT '0',
  `private` tinyint(1) DEFAULT '0',
  `openwin` tinyint(1) DEFAULT '1',
  `keywords` varchar(255) DEFAULT '',
  `credits` int(11) DEFAULT '0',
  
  `catid` int(11) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Tabellenstruktur für Tabelle `#__bookmarks_categories`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT '',
  `name` text,
  `image` varchar(200) DEFAULT '',
  `image_position` varchar(10) DEFAULT '',
  `icon` varchar(200) DEFAULT '',
  `description` text,
  `published` tinyint(1) DEFAULT '0',
  `checked_out` int(11) unsigned DEFAULT '0',
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT '',
  `access` tinyint(3) unsigned DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `parent` int(11) DEFAULT '0',
  `keywords` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Tabellenstruktur für Tabelle `#__bookmarks_columns`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks_columns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) DEFAULT '',
  `name` varchar(25) DEFAULT '',
  `visible` tinyint(3) DEFAULT '0',
  `visibleedit` tinyint(3) DEFAULT '0',
  `visibledetail` tinyint(3) DEFAULT '0',
  `visibleinfobox` tinyint(3) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `custom` tinyint(1) DEFAULT '0',
  `title` varchar(25) DEFAULT '',
  `f_type` tinyint(3) DEFAULT '0',
  `f_length` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Tabellenstruktur für Tabelle `#__bookmarks_itemcat`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks_itemcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) unsigned DEFAULT '0',
  `catid` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cats` (`catid`,`itemid`),
  KEY `ordering` (`ordering`),
  KEY `items` (`itemid`,`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Tabellenstruktur für Tabelle `#__bookmarks_prefs`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks_prefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `category` varchar(25) DEFAULT '',
  `name` varchar(25) DEFAULT '',
  `value` text,
  PRIMARY KEY (`id`),
  KEY `catname` (`userid`,`category`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Tabellenstruktur für Tabelle `#__bookmarks_vote`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks_vote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT '0',
  `host` varchar(250) DEFAULT '0.0.0.0',
  `userid` int(11) DEFAULT '0',
  `vote` int(2) DEFAULT '0',
  `votedate` datetime DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) DEFAULT '0',
  `hitsdate` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `itemid` (`itemid`),
  KEY `host` (`host`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;