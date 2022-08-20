
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL,
  `gkey` varchar(4) NOT NULL COMMENT '提取码',
  `type` int(11) NOT NULL COMMENT '1-文件,2-文本',
  `method` int(1) NOT NULL DEFAULT '1' COMMENT '文本存储方式1-数据库存储,2-文件存储',
  `data` text NOT NULL,
  `origin` text NOT NULL COMMENT '文件原名',
  `path` text NOT NULL,
  `tillday` int(11) NOT NULL COMMENT '到期时间戳',
  `times` int(11) NOT NULL COMMENT '剩余次数'
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL,
  `webname` text NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `template` text NOT NULL,
  `times` text NOT NULL,
  `settime` text NOT NULL,
  `uploadsize` text NOT NULL,
  `textsize` text NOT NULL,
  `textmethod` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `account`, `password`, `webname`, `header`, `footer`, `template`, `times`, `settime`, `uploadsize`, `textsize`, `textmethod`) VALUES
(1, 'admin', 'ODdkOWJiNDAwYzA2MzQ2OTFmMGUzYmFhZjFlMmZkMGQ=', '易传', '', '', 'default', '10', '864000', '104857600', '5000', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gkey_3` (`gkey`),
  ADD KEY `gkey` (`gkey`),
  ADD KEY `gkey_2` (`gkey`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
