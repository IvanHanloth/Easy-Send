SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL,
  `gkey` varchar(4) NOT NULL COMMENT '提取码',
  `type` int(11) NOT NULL COMMENT '1-文件,2-文本',
  `method` text NOT NULL COMMENT '文本存储方式1-数据库存储,2-文件存储',
  `cloud_way` text NOT NULL,
  `preview` text NOT NULL,
  `data` text NOT NULL,
  `origin` text NOT NULL COMMENT '文件原名',
  `path` text NOT NULL,
  `tillday` text NOT NULL COMMENT '到期时间戳',
  `times` int(11) NOT NULL COMMENT '剩余次数',
  `uid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `room` (
  `rid` int(11) NOT NULL,
  `roomid` text NOT NULL,
  `password` text NOT NULL,
  `roomtoken` text NOT NULL,
  `state` text NOT NULL,
  `starttime` text NOT NULL,
  `endtime` text NOT NULL,
  `size` int(11) NOT NULL,
  `origin` text NOT NULL,
  `total` int(11) NOT NULL,
  `send` text NOT NULL,
  `receive` text NOT NULL,
  `senduid` int(11) NOT NULL DEFAULT '0',
  `receiveuid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `roomdata` (
  `rdid` int(11) NOT NULL,
  `roomid` text NOT NULL,
  `num` int(11) NOT NULL,
  `url` text NOT NULL,
  `path` text NOT NULL,
  `size` int(11) NOT NULL,
  `origin` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

INSERT INTO `setting` (`id`, `name`, `content`, `description`) VALUES
(1, 'account', 'admin', '管理员账户'),
(2, 'password', 'ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ=', '管理员密码'),
(3, 'webname', '易传 - 跨平台文件文本传输平台', '网站名称'),
(4, 'header', '', '网站header'),
(5, 'footer', '', '网站footer'),
(6, 'theme', 'blue', '网站模板'),
(7, 'times', '10', ''),
(8, 'settime', '10', ''),
(9, 'uploadsize', '104857600', ''),
(10, 'textsize', '5000', ''),
(11, 'textmethod', 'on', ''),
(12, 'install', '1', '1：已经安装\r\n0：未安装'),
(13, 'update', '0', '1:需要升级\r\n0:不需要升级'),
(14, 'version_num', '331', ''),
(15, 'head', '', ''),
(16, 'keywords', '', ''),
(17, 'description', '', ''),
(18, 'logo', '/favicon.ico', ''),
(19, 'version', 'v3.3.1', ''),
(20, 'qrcode', 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=', ''),
(21, 'announcement', '', ''),
(22, 'mobile_version', '', ''),
(23, 'mobile_version_num', '', ''),
(24, 'mobile_update_description', '', ''),
(25, 'mobile_description', '', ''),
(26, 'PC_version', '', ''),
(27, 'PC_version_num', '', ''),
(28, 'PC_update_description', '', ''),
(29, 'PC_description', '', ''),
(30, 'mobile_android_url', '', ''),
(31, 'PC_windows_url', '', ''),
(32, 'mobile_apple_url', '', ''),
(33, 'PC_mac_url', '', ''),
(34, 'verify_type', 'mix', '验证码类型'),
(35, 'verify_num', '4', ''),
(38, 'if_scan', 'off', '是否开启扫码功能'),
(49, 'if_gray', 'off', ''),
(50, 'cloud_way', 'server', ''),
(51, 'qiniu_Access_Key', '', ''),
(52, 'qiniu_Secret_Key', '', ''),
(53, 'qiniu_bucket', '', ''),
(54, 'qiniu_domain', '', ''),
(55, 'limit_way_times', '1', '限制times的方式，1为固定值，2为最大值'),
(56, 'limit_way_tillday', '1', '限制tillday的方式，1为固定值，2为最大值'),
(57, 'limit_num_times', '10', ''),
(58, 'limit_num_tillday', '10', '');

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL,
  `usertoken` text NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gkey_3` (`gkey`),
  ADD KEY `gkey` (`gkey`),
  ADD KEY `gkey_2` (`gkey`);

ALTER TABLE `room`
  ADD PRIMARY KEY (`rid`);

ALTER TABLE `roomdata`
  ADD PRIMARY KEY (`rdid`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);


ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
ALTER TABLE `room`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
ALTER TABLE `roomdata`
  MODIFY `rdid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=975;
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
