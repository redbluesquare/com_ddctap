CREATE TABLE IF NOT EXISTS `#__ddctap_holidayplanner` (
  `ddctap_holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `holidaydatestart` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `holidaydateend` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `requested_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_on` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY (`ddctap_holiday_id`),
  KEY `holidaydatestart` (`holidaydatestart`),
  KEY `holidaydateend` (`holidaydateend`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `#__ddctap_userext` (
  `ddctap_userext_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `userdatestart` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `userdateend` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `starttime` TIME NOT NULL default '00:00:00',
  `finishtime` TIME NOT NULL default '00:00:00',
  `jobtitle` int(11) NOT NULL,
  `directreport` int(11) NOT NULL,
  `parttime` int(11) NOT NULL,
  `rbgb` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `dsp` int(11) NOT NULL,
  PRIMARY KEY (`ddctap_userext_id`),
  KEY `user_id` (`user_id`),
  KEY `directreport` (`directreport`),
  KEY `jobtitle` (`jobtitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
  
CREATE TABLE IF NOT EXISTS `#__ddctap_entitled_holiday` (
  `ddctap_ent_holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `allowance` int(2) NOT NULL default '25',
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`ddctap_ent_holiday_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddctap_options` (
  `ddctap_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100),
  `description` text,
  `catid` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`ddctap_option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
  
  
  
