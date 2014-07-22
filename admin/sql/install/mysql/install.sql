CREATE TABLE IF NOT EXISTS `#__ddctap_holidayplanner` (
  `ddctap_holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `holidaydate` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `created` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL,
  `modified` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `requested_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_on` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY (`ddctap_holiday_id`),
  KEY `holidaydate` (`holidaydate`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

