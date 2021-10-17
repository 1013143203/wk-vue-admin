-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2021-03-28 17:51:44
-- 服务器版本： 5.5.62-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youke58`
--

-- --------------------------------------------------------

--
-- 表的结构 `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(10) unsigned NOT NULL COMMENT '自增列',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省份代码',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省份名称',
  `pinyin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简称',
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '经度',
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纬度',
  `sort` int(10) unsigned DEFAULT '0',
  `memo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `province`
--

INSERT INTO `province` (`id`, `code`, `name`, `pinyin`, `initial`, `short_name`, `lng`, `lat`, `sort`, `memo`, `status`) VALUES
(1, '110000', '北京', 'beijing', 'B', '北京', '116.405289', '39.904987', 1, '', 0),
(2, '120000', '天津', 'tianjin', 'T', '天津', '117.190186', '39.125595', 2, '', 0),
(3, '130000', '河北省', 'hebeisheng', 'H', '河北', '114.502464', '38.045475', 3, '', 0),
(4, '140000', '山西省', 'shanxisheng', 'S', '山西', '112.549248', '37.857014', 4, '', 0),
(5, '150000', '内蒙古自治区', 'neimengguzizhiqu', 'N', '内蒙古', '111.670799', '40.81831', 5, '', 0),
(6, '210000', '辽宁省', 'liaoningsheng', 'L', '辽宁', '123.429092', '41.796768', 6, '', 0),
(7, '220000', '吉林省', 'jilinsheng', 'J', '吉林', '125.324501', '43.886841', 7, '', 0),
(8, '230000', '黑龙江省', 'heilongjiangsheng', 'H', '黑龙江', '126.642464', '45.756966', 8, '', 0),
(9, '310000', '上海', 'shanghai', 'S', '上海', '121.472641', '31.231707', 9, '', 0),
(10, '320000', '江苏省', 'jiangsusheng', 'J', '江苏', '118.76741', '32.041546', 10, '', 0),
(11, '330000', '浙江省', 'zhejiangsheng', 'Z', '浙江', '120.15358', '30.287458', 11, '', 0),
(12, '340000', '安徽省', 'anhuisheng', 'A', '安徽', '117.283043', '31.861191', 12, '', 0),
(13, '350000', '福建省', 'fujiansheng', 'F', '福建', '119.306236', '26.075302', 13, '', 0),
(14, '360000', '江西省', 'jiangxisheng', 'J', '江西', '115.892151', '28.676493', 14, '', 0),
(15, '370000', '山东省', 'shandongsheng', 'S', '山东', '117.000923', '36.675808', 15, '', 0),
(16, '410000', '河南省', 'henansheng', 'H', '河南', '113.665413', '34.757977', 16, '', 0),
(17, '420000', '湖北省', 'hubeisheng', 'H', '湖北', '114.298569', '30.584354', 17, '', 0),
(18, '430000', '湖南省', 'hunansheng', 'H', '湖南', '112.982277', '28.19409', 18, '', 0),
(19, '440000', '广东省', 'guangdongsheng', 'G', '广东', '113.28064', '23.125177', 19, '', 0),
(20, '450000', '广西壮族自治区', 'guangxizhuangzuzizhiqu', 'G', '广西', '108.320007', '22.82402', 20, '', 0),
(21, '460000', '海南省', 'hainansheng', 'H', '海南', '110.331192', '20.031971', 21, '', 0),
(22, '500000', '重庆', 'chongqing', 'Z', '重庆', '106.504959', '29.533155', 22, '', 0),
(23, '510000', '四川省', 'sichuansheng', 'S', '四川', '104.065735', '30.659462', 23, '', 0),
(24, '520000', '贵州省', 'guizhousheng', 'G', '贵州', '106.713478', '26.578342', 24, '', 0),
(25, '530000', '云南省', 'yunnansheng', 'Y', '云南', '102.71225', '25.040609', 25, '', 0),
(26, '540000', '西藏自治区', 'xizangzizhiqu', 'X', '西藏', '91.13221', '29.66036', 26, '', 0),
(27, '610000', '陕西省', 'shanxisheng', 'S', '陕西', '108.948021', '34.263161', 27, '', 0),
(28, '620000', '甘肃省', 'gansusheng', 'G', '甘肃', '103.823555', '36.058041', 28, '', 0),
(29, '630000', '青海省', 'qinghaisheng', 'Q', '青海', '101.778915', '36.623177', 29, '', 0),
(30, '640000', '宁夏回族自治区', 'ningxiahuizuzizhiqu', 'N', '宁夏', '106.278175', '38.46637', 30, '', 0),
(31, '650000', '新疆维吾尔自治区', 'xinjiangweiwuerzizhiqu', 'X', '新疆', '87.617729', '43.792816', 31, '', 0),
(32, '710000', '台湾', 'taiwan', 'T', '台湾', '121.509064', '25.044333', 34, '', 0),
(33, '810000', '香港特别行政区', 'xianggangtebiexingzhengqu', 'X', '香港', '114.173355', '22.320047', 32, '', 0),
(34, '820000', '澳门特别行政区', 'aomentebiexingzhengqu', 'A', '澳门', '113.549088', '22.198952', 33, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增列',AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
