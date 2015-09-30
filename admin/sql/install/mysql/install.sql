CREATE TABLE IF NOT EXISTS `#__ddc_user_absence` (
  `ddc_user_absence_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recorddate` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `requested_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_on` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY (`ddc_user_absence_id`),
  KEY `recorddate` (`recorddate`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `#__ddc_userext` (
  `ddc_userext_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `userdatestart` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `userdateend` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `jobtitle` int(11) NOT NULL,
  `directreport` int(11) NOT NULL,
  `contract_type` int(11) NOT NULL,
  PRIMARY KEY (`ddc_userext_id`),
  KEY `user_id` (`user_id`),
  KEY `directreport` (`directreport`),
  KEY `jobtitle` (`jobtitle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
  
CREATE TABLE IF NOT EXISTS `#__ddc_entitled_leave` (
  `ddc_ent_leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `allowance` int(2) NOT NULL default '25',
  `catid` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`ddc_ent_leave_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__ddc_options` (
  `ddc_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100),
  `description` text,
  `catid` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`ddc_option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
  
  
  
