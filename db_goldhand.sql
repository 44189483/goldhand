-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 12 月 30 日 11:14
-- 服务器版本: 5.5.47
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `db_goldhand`
--

-- --------------------------------------------------------

--
-- 表的结构 `gh_option`
--

CREATE TABLE IF NOT EXISTS `gh_option` (
  `optionType` varchar(10) NOT NULL COMMENT '类型',
  `optionKey` varchar(20) DEFAULT NULL,
  `optionValue` varchar(200) DEFAULT NULL COMMENT '值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gh_option`
--

INSERT INTO `gh_option` (`optionType`, `optionKey`, `optionValue`) VALUES
('login', 'admin', 'c39de009cd45296ebdb563d55da6fd73'),
('wx', 'lasttime', '1463540963'),
('wx', 'ticket', 'bxLdikRXVbTPdHSM05e5uxqzPQ3qTKeTr_kM2n9sf6MfiduF5ICS7rhgZ01UN0MVFgQL00hrUeIIr5TsYByZrw'),
('wx', 'accesstoken', 'uNqYSzbwgUFIcnODp5zotJiD9H88wlure-aJAD7vCb456sqo9ugJhPUTu9bJfoO0orkKkWOzPXCQsqadpUF6nQ0xbIsvU1N-MNAKhkHyuUpGYAEjh3b6n_rcShkq2AF2QIXfABAMET'),
('wx', 'appsecret', 'e7d5fdb8180d25362292f84528395af5'),
('wx', 'appid', 'wx00646b1e04c0b5b3');

-- --------------------------------------------------------

--
-- 表的结构 `gh_prize`
--

CREATE TABLE IF NOT EXISTS `gh_prize` (
  `prizeId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `prizeName` varchar(50) NOT NULL COMMENT '奖品名称',
  `prizeImg` varchar(50) DEFAULT NULL COMMENT '奖品图片',
  `prizeContent` varchar(1000) DEFAULT NULL COMMENT '描述',
  `prizeNum` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数量',
  `getPrizeNum` tinyint(4) NOT NULL DEFAULT '0' COMMENT '已中数量',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '奖品状态',
  PRIMARY KEY (`prizeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `gh_prize`
--

INSERT INTO `gh_prize` (`prizeId`, `prizeName`, `prizeImg`, `prizeContent`, `prizeNum`, `getPrizeNum`, `status`) VALUES
(21, '自拍杆一件', 'image/20160511/20160511582.jpg', NULL, 127, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `gh_user`
--

CREATE TABLE IF NOT EXISTS `gh_user` (
  `userId` int(4) NOT NULL AUTO_INCREMENT,
  `userOpenId` varchar(50) NOT NULL,
  `userName` varchar(30) DEFAULT NULL COMMENT '姓名',
  `userCompany` varchar(50) DEFAULT NULL COMMENT '公司',
  `userPhone` varchar(15) DEFAULT NULL COMMENT '电话',
  `prizeId` tinyint(4) NOT NULL DEFAULT '0' COMMENT '已获奖',
  `getAward` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否领奖',
  `isShared` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否分享',
  `addTime` int(10) NOT NULL DEFAULT '0' COMMENT '加入时间',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=454 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
