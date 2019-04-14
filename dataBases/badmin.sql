/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : badmin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-04-14 14:23:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ba_administrator
-- ----------------------------
DROP TABLE IF EXISTS `ba_administrator`;
CREATE TABLE `ba_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` char(3) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(100) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ba_administrator
-- ----------------------------
INSERT INTO `ba_administrator` VALUES ('1', 'Admin', 'admin', '0fdf6d8829854bedeaed992a6f3ad83a', '112', '13888888888', '1', '57a99128f2c90_thumb.jpg', '127.0.0.1', '1555222927', '1555251727', '1463362516', '1470748660');
INSERT INTO `ba_administrator` VALUES ('2', 'Editor', 'editor', 'df620c97d6c8a15b672191fe11b9a886', '519', '13888888888', '1', null, '127.0.0.1', '1470748703', '1470777503', '1463363564', '1470660594');

-- ----------------------------
-- Table structure for ba_posts
-- ----------------------------
DROP TABLE IF EXISTS `ba_posts`;
CREATE TABLE `ba_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_content` longtext,
  `post_title` text NOT NULL,
  `post_excerpt` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) DEFAULT '',
  `comment_count` bigint(20) DEFAULT '0',
  `feature_image` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`status`,`create_time`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ba_posts
-- ----------------------------
