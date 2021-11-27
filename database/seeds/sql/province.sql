-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-11-26 18:28:23
-- 服务器版本： 5.7.34-log
-- PHP 版本： 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `w_biubiubiubiu_top`
--

-- --------------------------------------------------------

--
-- 表的结构 `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增列',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省份代码',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省份名称',
  `pinyin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简称',
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '经度',
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纬度',
  `memo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `province`
--

INSERT INTO `province` (`id`, `code`, `name`, `pinyin`, `initial`, `short_name`, `lng`, `lat`, `memo`, `status`) VALUES
(1, '110000', '北京', 'beijing', 'B', '北京', '116.405289', '39.904987', '', 0),
(2, '120000', '天津', 'tianjin', 'T', '天津', '117.190186', '39.125595', '', 0),
(3, '130000', '河北省', 'hebeisheng', 'H', '河北', '114.502464', '38.045475', '', 0),
(4, '140000', '山西省', 'shanxisheng', 'S', '山西', '112.549248', '37.857014', '', 0),
(5, '150000', '内蒙古自治区', 'neimengguzizhiqu', 'N', '内蒙古', '111.670799', '40.81831', '', 0),
(6, '210000', '辽宁省', 'liaoningsheng', 'L', '辽宁', '123.429092', '41.796768', '', 0),
(7, '220000', '吉林省', 'jilinsheng', 'J', '吉林', '125.324501', '43.886841', '', 0),
(8, '230000', '黑龙江省', 'heilongjiangsheng', 'H', '黑龙江', '126.642464', '45.756966', '', 0),
(9, '310000', '上海', 'shanghai', 'S', '上海', '121.472641', '31.231707', '', 0),
(10, '320000', '江苏省', 'jiangsusheng', 'J', '江苏', '118.76741', '32.041546', '', 0),
(11, '330000', '浙江省', 'zhejiangsheng', 'Z', '浙江', '120.15358', '30.287458', '', 0),
(12, '340000', '安徽省', 'anhuisheng', 'A', '安徽', '117.283043', '31.861191', '', 0),
(13, '350000', '福建省', 'fujiansheng', 'F', '福建', '119.306236', '26.075302', '', 0),
(14, '360000', '江西省', 'jiangxisheng', 'J', '江西', '115.892151', '28.676493', '', 0),
(15, '370000', '山东省', 'shandongsheng', 'S', '山东', '117.000923', '36.675808', '', 0),
(16, '410000', '河南省', 'henansheng', 'H', '河南', '113.665413', '34.757977', '', 0),
(17, '420000', '湖北省', 'hubeisheng', 'H', '湖北', '114.298569', '30.584354', '', 0),
(18, '430000', '湖南省', 'hunansheng', 'H', '湖南', '112.982277', '28.19409', '', 0),
(19, '440000', '广东省', 'guangdongsheng', 'G', '广东', '113.28064', '23.125177', '', 0),
(20, '450000', '广西壮族自治区', 'guangxizhuangzuzizhiqu', 'G', '广西', '108.320007', '22.82402', '', 0),
(21, '460000', '海南省', 'hainansheng', 'H', '海南', '110.331192', '20.031971', '', 0),
(22, '500000', '重庆', 'chongqing', 'Z', '重庆', '106.504959', '29.533155', '', 0),
(23, '510000', '四川省', 'sichuansheng', 'S', '四川', '104.065735', '30.659462', '', 0),
(24, '520000', '贵州省', 'guizhousheng', 'G', '贵州', '106.713478', '26.578342', '', 0),
(25, '530000', '云南省', 'yunnansheng', 'Y', '云南', '102.71225', '25.040609', '', 0),
(26, '540000', '西藏自治区', 'xizangzizhiqu', 'X', '西藏', '91.13221', '29.66036', '', 0),
(27, '610000', '陕西省', 'shanxisheng', 'S', '陕西', '108.948021', '34.263161', '', 0),
(28, '620000', '甘肃省', 'gansusheng', 'G', '甘肃', '103.823555', '36.058041', '', 0),
(29, '630000', '青海省', 'qinghaisheng', 'Q', '青海', '101.778915', '36.623177', '', 0),
(30, '640000', '宁夏回族自治区', 'ningxiahuizuzizhiqu', 'N', '宁夏', '106.278175', '38.46637', '', 0),
(31, '650000', '新疆维吾尔自治区', 'xinjiangweiwuerzizhiqu', 'X', '新疆', '87.617729', '43.792816', '', 0),
(32, '710000', '台湾', 'taiwan', 'T', '台湾', '121.509064', '25.044333', '', 0),
(33, '810000', '香港特别行政区', 'xianggangtebiexingzhengqu', 'X', '香港', '114.173355', '22.320047', '', 0),
(34, '820000', '澳门特别行政区', 'aomentebiexingzhengqu', 'A', '澳门', '113.549088', '22.198952', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
