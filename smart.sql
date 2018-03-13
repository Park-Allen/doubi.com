-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2017-06-23 10:34:09
-- 服务器版本: 5.5.36-log
-- PHP 版本: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `smart`
--

-- --------------------------------------------------------

--
-- 表的结构 `yz_member`
--

CREATE TABLE IF NOT EXISTS `yz_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT',
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `yz_member`
--

INSERT INTO `yz_member` (`id`, `user`, `pwd`, `state`, `img`, `mail`) VALUES
(1, 'park', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/5_copy.jpg', '625446161@qq.com'),
(2, 'MiroBadev', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/1_copy.jpg', 'mirobadev@gmail.com'),
(3, 'Martin Joseph', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/2_copy.jpg', 'marjoseph@gmail.com'),
(4, 'Tomas Kennedy', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/3_copy.jpg', 'tomaskennedy@gmail.com'),
(5, 'Enrique	Sutton', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/4_copy.jpg', 'enriquesutton@gmail.com'),
(6, 'Darnell	Strickland', 'e10adc3949ba59abbe56e057f20f883e', 1, 'img/5_copy.jpg', 'darnellstrickland@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
