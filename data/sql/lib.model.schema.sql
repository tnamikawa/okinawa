
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
	`wander_width` INTEGER,
	`wander_height` INTEGER,
	`slide_width` INTEGER,
	`slide_height` INTEGER,
	`longitude` DOUBLE,
	`latitude` DOUBLE,
	`shot_date` DATETIME,
	`open_date` DATE,
	`modified_date` DATETIME,
	`metamodified_date` DATETIME,
	`filemtime` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `filename_uniq` (`filename`),
	UNIQUE KEY `title_uniq` (`title`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tag_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tag_mst`;


CREATE TABLE `tag_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`englishtitle` VARCHAR(255)  NOT NULL,
	`filename` VARCHAR(64),
	`description` VARCHAR(255),
	`order_priority` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photo_and_tag_rel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_and_tag_rel`;


CREATE TABLE `photo_and_tag_rel`
(
	`photo_id` INTEGER  NOT NULL,
	`tag_id` INTEGER,
	`open_flag` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- blog_photo_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `blog_photo_mst`;


CREATE TABLE `blog_photo_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photo_id` INTEGER  NOT NULL,
	`use_date` DATE,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wall_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wall_mst`;


CREATE TABLE `wall_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photo_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- top_photo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `top_photo`;


CREATE TABLE `top_photo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photo_id` INTEGER  NOT NULL,
	`text_color` VARCHAR(7)  NOT NULL,
	`link_color` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- linkcategory_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `linkcategory_mst`;


CREATE TABLE `linkcategory_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(64)  NOT NULL,
	`order_priority` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- link_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `link_mst`;


CREATE TABLE `link_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`url` VARCHAR(255)  NOT NULL,
	`title` VARCHAR(64)  NOT NULL,
	`description` VARCHAR(255)  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	`inserted_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- seolink_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `seolink_mst`;


CREATE TABLE `seolink_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`linkstr` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- note_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `note_mst`;


CREATE TABLE `note_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photo_id` INTEGER,
	`name` VARCHAR(64)  NOT NULL,
	`content` TEXT  NOT NULL,
	`font_family` INTEGER  NOT NULL,
	`font_size` INTEGER  NOT NULL,
	`write_date` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- blogpartsuser_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `blogpartsuser_mst`;


CREATE TABLE `blogpartsuser_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`url` VARCHAR(64)  NOT NULL,
	`last_access` DATE  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- carte_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `carte_mst`;


CREATE TABLE `carte_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`englishtitle` VARCHAR(255)  NOT NULL,
	`filename` VARCHAR(64)  NOT NULL,
	`comment` VARCHAR(255),
	`width` INTEGER,
	`height` INTEGER,
	`thumb_width` INTEGER,
	`thumb_height` INTEGER,
	`ins_date` DATE,
	PRIMARY KEY (`id`),
	UNIQUE KEY `filename_uniq` (`filename`),
	UNIQUE KEY `title_uniq` (`title`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- cartetag_mst
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cartetag_mst`;


CREATE TABLE `cartetag_mst`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`englishtitle` VARCHAR(255)  NOT NULL,
	`description` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- carte_and_tag_rel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `carte_and_tag_rel`;


CREATE TABLE `carte_and_tag_rel`
(
	`carte_id` INTEGER  NOT NULL,
	`tag_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
