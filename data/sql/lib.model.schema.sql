
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- photo_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_mst`;


CREATE TABLE `photo_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`filename` VARCHAR(64)  NOT NULL,
	`comment` VARCHAR(255),
	`width` INTEGER,
	`height` INTEGER,
	`thumb_width` INTEGER,
	`thumb_height` INTEGER,
	`icon_width` INTEGER,
	`icon_height` INTEGER,
	`longitude` DOUBLE,
	`latitude` DOUBLE,
	`shot_date` DATETIME,
	`modified_date` DATETIME,
	`metamodified_date` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `filename_uniq` (`filename`),
	UNIQUE KEY `title_uniq` (`title`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tag_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tag_mst`;


CREATE TABLE `tag_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photo_and_tag_rel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_and_tag_rel`;


CREATE TABLE `photo_and_tag_rel`
(
	`photo_id` INTEGER  NOT NULL,
	`tag_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- view_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `view_log`;


CREATE TABLE `view_log`
(
	`photo_id` INTEGER  NOT NULL,
	`ipaddress` VARCHAR(15)  NOT NULL,
	`created_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
