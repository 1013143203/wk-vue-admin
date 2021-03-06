-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-11-26 18:28:03
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
-- 表的结构 `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增列',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '市代码',
  `province_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省代码',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '市名称',
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简称',
  `pinyin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '拼音',
  `initial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '经度',
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纬度',
  `memo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `city`
--

INSERT INTO `city` (`id`, `code`, `province_code`, `name`, `short_name`, `pinyin`, `initial`, `lng`, `lat`, `memo`, `status`) VALUES
(1, '110100', '110000', '北京市', '北京', 'beijingshi', 'B', '116.405289', '39.904987', '', 1),
(2, '120100', '120000', '天津市', '天津', 'tianjinshi', 'T', '117.190186', '39.125595', '', 1),
(3, '130100', '130000', '石家庄市', '石家庄', 'shijiazhuangshi', 'S', '114.502464', '38.045475', '', 1),
(4, '130200', '130000', '唐山市', '唐山', 'tangshanshi', 'T', '118.175392', '39.635113', '', 1),
(5, '130300', '130000', '秦皇岛市', '秦皇岛', 'qinhuangdaoshi', 'Q', '119.586578', '39.942532', '', 1),
(6, '130400', '130000', '邯郸市', '邯郸', 'handanshi', 'H', '114.490685', '36.612274', '', 1),
(7, '130500', '130000', '邢台市', '邢台', 'xingtaishi', 'X', '114.50885', '37.068199', '', 1),
(8, '130600', '130000', '保定市', '保定', 'baodingshi', 'B', '115.48233', '38.867657', '', 1),
(9, '130700', '130000', '张家口市', '张家口', 'zhangjiakoushi', 'Z', '114.884094', '40.811901', '', 1),
(10, '130800', '130000', '承德市', '承德', 'chengdeshi', 'C', '117.939156', '40.976204', '', 1),
(11, '130900', '130000', '沧州市', '沧州', 'cangzhoushi', 'C', '116.85746', '38.310581', '', 1),
(12, '131000', '130000', '廊坊市', '廊坊', 'langfangshi', 'L', '116.704437', '39.523926', '', 1),
(13, '131100', '130000', '衡水市', '衡水', 'hengshuishi', 'H', '115.665993', '37.735096', '', 1),
(14, '140100', '140000', '太原市', '太原', 'taiyuanshi', 'T', '112.549248', '37.857014', '', 1),
(15, '140200', '140000', '大同市', '大同', 'datongshi', 'D', '113.295258', '40.090309', '', 1),
(16, '140300', '140000', '阳泉市', '阳泉', 'yangquanshi', 'Y', '113.583282', '37.861187', '', 1),
(17, '140400', '140000', '长治市', '长治', 'changzhishi', 'Z', '113.113556', '36.191113', '', 1),
(18, '140500', '140000', '晋城市', '晋城', 'jinchengshi', 'J', '112.851273', '35.497555', '', 1),
(19, '140600', '140000', '朔州市', '朔州', 'shuozhoushi', 'S', '112.433388', '39.331261', '', 1),
(20, '140700', '140000', '晋中市', '晋中', 'jinzhongshi', 'J', '112.736465', '37.696495', '', 1),
(21, '140800', '140000', '运城市', '运城', 'yunchengshi', 'Y', '111.00396', '35.022778', '', 1),
(22, '140900', '140000', '忻州市', '忻州', 'xinzhoushi', 'X', '112.733536', '38.41769', '', 1),
(23, '141000', '140000', '临汾市', '临汾', 'linfenshi', 'L', '111.517975', '36.084148', '', 1),
(24, '141100', '140000', '吕梁市', '吕梁', 'lvliangshi', 'L', '111.134338', '37.524364', '', 1),
(25, '150100', '150000', '呼和浩特市', '呼和浩特', 'huhehaoteshi', 'H', '111.670799', '40.81831', '', 1),
(26, '150200', '150000', '包头市', '包头', 'baotoushi', 'B', '109.840408', '40.658169', '', 1),
(27, '150300', '150000', '乌海市', '乌海', 'wuhaishi', 'W', '106.825562', '39.673733', '', 1),
(28, '150400', '150000', '赤峰市', '赤峰', 'chifengshi', 'C', '118.956802', '42.275318', '', 1),
(29, '150500', '150000', '通辽市', '通辽', 'tongliaoshi', 'T', '122.263123', '43.617428', '', 1),
(30, '150600', '150000', '鄂尔多斯市', '鄂尔多斯', 'eerduosishi', 'E', '109.990288', '39.817181', '', 1),
(31, '150700', '150000', '呼伦贝尔市', '呼伦贝尔', 'hulunbeiershi', 'H', '119.758171', '49.215332', '', 1),
(32, '150800', '150000', '巴彦淖尔市', '巴彦淖尔', 'bayannaoershi', 'B', '107.416962', '40.757401', '', 1),
(33, '150900', '150000', '乌兰察布市', '乌兰察布', 'wulanchabushi', 'W', '113.11454', '41.034126', '', 1),
(34, '152200', '150000', '兴安盟', '兴安', 'xinganmeng', 'X', '122.07032', '46.076267', '', 1),
(35, '152500', '150000', '锡林郭勒盟', '锡林郭勒', 'xilinguolemeng', 'X', '116.090996', '43.944019', '', 1),
(36, '152900', '150000', '阿拉善盟', '阿拉善', 'alashanmeng', 'A', '105.706421', '38.844814', '', 1),
(37, '210100', '210000', '沈阳市', '沈阳', 'shenyangshi', 'S', '123.429092', '41.796768', '', 1),
(38, '210200', '210000', '大连市', '大连', 'dalianshi', 'D', '121.618622', '38.914589', '', 1),
(39, '210300', '210000', '鞍山市', '鞍山', 'anshanshi', 'A', '122.995628', '41.110626', '', 1),
(40, '210400', '210000', '抚顺市', '抚顺', 'fushunshi', 'F', '123.921112', '41.875957', '', 1),
(41, '210500', '210000', '本溪市', '本溪', 'benxishi', 'B', '123.770515', '41.297909', '', 1),
(42, '210600', '210000', '丹东市', '丹东', 'dandongshi', 'D', '124.383041', '40.124294', '', 1),
(43, '210700', '210000', '锦州市', '锦州', 'jinzhoushi', 'J', '121.135742', '41.11927', '', 1),
(44, '210800', '210000', '营口市', '营口', 'yingkoushi', 'Y', '122.235153', '40.667431', '', 1),
(45, '210900', '210000', '阜新市', '阜新', 'fuxinshi', 'F', '121.648964', '42.011795', '', 1),
(46, '211000', '210000', '辽阳市', '辽阳', 'liaoyangshi', 'L', '123.181519', '41.269402', '', 1),
(47, '211100', '210000', '盘锦市', '盘锦', 'panjinshi', 'P', '122.069572', '41.124485', '', 1),
(48, '211200', '210000', '铁岭市', '铁岭', 'tielingshi', 'T', '123.844276', '42.290585', '', 1),
(49, '211300', '210000', '朝阳市', '朝阳', 'zhaoyangshi', 'C', '120.45118', '41.576759', '', 1),
(50, '211400', '210000', '葫芦岛市', '葫芦岛', 'huludaoshi', 'H', '120.856392', '40.755573', '', 1),
(51, '220100', '220000', '长春市', '长春', 'changchunshi', 'Z', '125.324501', '43.886841', '', 1),
(52, '220200', '220000', '吉林市', '吉林', 'jilinshi', 'J', '126.553017', '43.843578', '', 1),
(53, '220300', '220000', '四平市', '四平', 'sipingshi', 'S', '124.370789', '43.170345', '', 1),
(54, '220400', '220000', '辽源市', '辽源', 'liaoyuanshi', 'L', '125.145348', '42.902691', '', 1),
(55, '220500', '220000', '通化市', '通化', 'tonghuashi', 'T', '125.936501', '41.721176', '', 1),
(56, '220600', '220000', '白山市', '白山', 'baishanshi', 'B', '126.427841', '41.942505', '', 1),
(57, '220700', '220000', '松原市', '松原', 'songyuanshi', 'S', '124.823608', '45.118244', '', 1),
(58, '220800', '220000', '白城市', '白城', 'baichengshi', 'B', '122.84111', '45.619026', '', 1),
(59, '222400', '220000', '延边朝鲜族自治州', '延边朝鲜族', 'yanbianchaoxianzuzizhizhou', 'Y', '129.513229', '42.904823', '', 1),
(60, '230100', '230000', '哈尔滨市', '哈尔滨', 'haerbinshi', 'H', '126.642464', '45.756966', '', 1),
(61, '230200', '230000', '齐齐哈尔市', '齐齐哈尔', 'qiqihaershi', 'Q', '123.957916', '47.342079', '', 1),
(62, '230300', '230000', '鸡西市', '鸡西', 'jixishi', 'J', '130.975967', '45.300045', '', 1),
(63, '230400', '230000', '鹤岗市', '鹤岗', 'hegangshi', 'H', '130.277481', '47.332085', '', 1),
(64, '230500', '230000', '双鸭山市', '双鸭山', 'shuangyashanshi', 'S', '131.157303', '46.64344', '', 1),
(65, '230600', '230000', '大庆市', '大庆', 'daqingshi', 'D', '125.112717', '46.590733', '', 1),
(66, '230700', '230000', '伊春市', '伊春', 'yichunshi', 'Y', '128.899399', '47.724773', '', 1),
(67, '230800', '230000', '佳木斯市', '佳木斯', 'jiamusishi', 'J', '130.361633', '46.809605', '', 1),
(68, '230900', '230000', '七台河市', '七台河', 'qitaiheshi', 'Q', '131.015579', '45.771267', '', 1),
(69, '231000', '230000', '牡丹江市', '牡丹江', 'mudanjiangshi', 'M', '129.618607', '44.582962', '', 1),
(70, '231100', '230000', '黑河市', '黑河', 'heiheshi', 'H', '127.499023', '50.249584', '', 1),
(71, '231200', '230000', '绥化市', '绥化', 'suihuashi', 'S', '126.992928', '46.637394', '', 1),
(72, '232700', '230000', '大兴安岭地区', '大兴安岭', 'daxinganlingdiqu', 'D', '124.711525', '52.335262', '', 1),
(73, '310100', '310000', '上海市', '上海', 'shanghaishi', 'S', '121.472641', '31.231707', '', 1),
(74, '320100', '320000', '南京市', '南京', 'nanjingshi', 'N', '118.76741', '32.041546', '', 1),
(75, '320200', '320000', '无锡市', '无锡', 'wuxishi', 'W', '120.301666', '31.57473', '', 1),
(76, '320300', '320000', '徐州市', '徐州', 'xuzhoushi', 'X', '117.184814', '34.261791', '', 1),
(77, '320400', '320000', '常州市', '常州', 'changzhoushi', 'C', '119.946976', '31.772753', '', 1),
(78, '320500', '320000', '苏州市', '苏州', 'suzhoushi', 'S', '120.619583', '31.299379', '', 1),
(79, '320600', '320000', '南通市', '南通', 'nantongshi', 'N', '120.864609', '32.016212', '', 1),
(80, '320700', '320000', '连云港市', '连云港', 'lianyungangshi', 'L', '119.178818', '34.600018', '', 1),
(81, '320800', '320000', '淮安市', '淮安', 'huaianshi', 'H', '119.021263', '33.597507', '', 1),
(82, '320900', '320000', '盐城市', '盐城', 'yanchengshi', 'Y', '120.139999', '33.377632', '', 1),
(83, '321000', '320000', '扬州市', '扬州', 'yangzhoushi', 'Y', '119.421005', '32.393158', '', 1),
(84, '321100', '320000', '镇江市', '镇江', 'zhenjiangshi', 'Z', '119.452751', '32.204403', '', 1),
(85, '321200', '320000', '泰州市', '泰州', 'taizhoushi', 'T', '119.915176', '32.484882', '', 1),
(86, '321300', '320000', '宿迁市', '宿迁', 'suqianshi', 'S', '118.275162', '33.963009', '', 1),
(87, '330100', '330000', '杭州市', '杭州', 'hangzhoushi', 'H', '120.15358', '30.287458', '', 1),
(88, '330200', '330000', '宁波市', '宁波', 'ningboshi', 'N', '121.549789', '29.868387', '', 1),
(89, '330300', '330000', '温州市', '温州', 'wenzhoushi', 'W', '120.672112', '28.000574', '', 1),
(90, '330400', '330000', '嘉兴市', '嘉兴', 'jiaxingshi', 'J', '120.750862', '30.762653', '', 1),
(91, '330500', '330000', '湖州市', '湖州', 'huzhoushi', 'H', '120.102402', '30.867199', '', 1),
(92, '330600', '330000', '绍兴市', '绍兴', 'shaoxingshi', 'S', '120.582115', '29.997116', '', 1),
(93, '330700', '330000', '金华市', '金华', 'jinhuashi', 'J', '119.649506', '29.089523', '', 1),
(94, '330800', '330000', '衢州市', '衢州', 'quzhoushi', 'Q', '118.872627', '28.941708', '', 1),
(95, '330900', '330000', '舟山市', '舟山', 'zhoushanshi', 'Z', '122.106865', '30.016027', '', 1),
(96, '331000', '330000', '台州市', '台州', 'taizhoushi', 'T', '121.428596', '28.661379', '', 1),
(97, '331100', '330000', '丽水市', '丽水', 'lishuishi', 'L', '119.921783', '28.451994', '', 1),
(98, '340100', '340000', '合肥市', '合肥', 'hefeishi', 'H', '117.283043', '31.861191', '', 1),
(99, '340200', '340000', '芜湖市', '芜湖', 'wuhushi', 'W', '118.37645', '31.326319', '', 1),
(100, '340300', '340000', '蚌埠市', '蚌埠', 'bengbushi', 'B', '117.363228', '32.939667', '', 1),
(101, '340400', '340000', '淮南市', '淮南', 'huainanshi', 'H', '117.018326', '32.647575', '', 1),
(102, '340500', '340000', '马鞍山市', '马鞍山', 'maanshanshi', 'M', '118.507904', '31.689362', '', 1),
(103, '340600', '340000', '淮北市', '淮北', 'huaibeishi', 'H', '116.794662', '33.971706', '', 1),
(104, '340700', '340000', '铜陵市', '铜陵', 'tonglingshi', 'T', '117.816574', '30.929935', '', 1),
(105, '340800', '340000', '安庆市', '安庆', 'anqingshi', 'A', '117.043549', '30.508829', '', 1),
(106, '341000', '340000', '黄山市', '黄山', 'huangshanshi', 'H', '118.317322', '29.709238', '', 1),
(107, '341100', '340000', '滁州市', '滁州', 'chuzhoushi', 'C', '118.316261', '32.303627', '', 1),
(108, '341200', '340000', '阜阳市', '阜阳', 'fuyangshi', 'F', '115.819733', '32.896969', '', 1),
(109, '341300', '340000', '宿州市', '宿州', 'suzhoushi', 'S', '116.984085', '33.633892', '', 1),
(110, '341500', '340000', '六安市', '六安', 'luanshi', 'L', '116.507675', '31.75289', '', 1),
(111, '341600', '340000', '亳州市', '亳州', 'bozhoushi', 'B', '115.782936', '33.869339', '', 1),
(112, '341700', '340000', '池州市', '池州', 'chizhoushi', 'C', '117.489159', '30.656036', '', 1),
(113, '341800', '340000', '宣城市', '宣城', 'xuanchengshi', 'X', '118.757996', '30.945667', '', 1),
(114, '350100', '350000', '福州市', '福州', 'fuzhoushi', 'F', '119.306236', '26.075302', '', 1),
(115, '350200', '350000', '厦门市', '厦门', 'xiamenshi', 'S', '118.110222', '24.490475', '', 1),
(116, '350300', '350000', '莆田市', '莆田', 'putianshi', 'P', '119.007561', '25.431011', '', 1),
(117, '350400', '350000', '三明市', '三明', 'sanmingshi', 'S', '117.635002', '26.265444', '', 1),
(118, '350500', '350000', '泉州市', '泉州', 'quanzhoushi', 'Q', '118.589424', '24.908854', '', 1),
(119, '350600', '350000', '漳州市', '漳州', 'zhangzhoushi', 'Z', '117.661804', '24.510897', '', 1),
(120, '350700', '350000', '南平市', '南平', 'nanpingshi', 'N', '118.178459', '26.635628', '', 1),
(121, '350800', '350000', '龙岩市', '龙岩', 'longyanshi', 'L', '117.029778', '25.091602', '', 1),
(122, '350900', '350000', '宁德市', '宁德', 'ningdeshi', 'N', '119.527084', '26.659241', '', 1),
(123, '360100', '360000', '南昌市', '南昌', 'nanchangshi', 'N', '115.892151', '28.676493', '', 1),
(124, '360200', '360000', '景德镇市', '景德镇', 'jingdezhenshi', 'J', '117.214661', '29.292561', '', 1),
(125, '360300', '360000', '萍乡市', '萍乡', 'pingxiangshi', 'P', '113.852188', '27.622946', '', 1),
(126, '360400', '360000', '九江市', '九江', 'jiujiangshi', 'J', '115.992813', '29.712034', '', 1),
(127, '360500', '360000', '新余市', '新余', 'xinyushi', 'X', '114.930832', '27.810835', '', 1),
(128, '360600', '360000', '鹰潭市', '鹰潭', 'yingtanshi', 'Y', '117.033836', '28.238638', '', 1),
(129, '360700', '360000', '赣州市', '赣州', 'ganzhoushi', 'G', '114.940277', '25.850969', '', 1),
(130, '360800', '360000', '吉安市', '吉安', 'jianshi', 'J', '114.986374', '27.111698', '', 1),
(131, '360900', '360000', '宜春市', '宜春', 'yichunshi', 'Y', '114.391136', '27.8043', '', 1),
(132, '361000', '360000', '抚州市', '抚州', 'fuzhoushi', 'F', '116.358353', '27.98385', '', 1),
(133, '361100', '360000', '上饶市', '上饶', 'shangraoshi', 'S', '117.971184', '28.44442', '', 1),
(134, '370100', '370000', '济南市', '济南', 'jinanshi', 'J', '117.000923', '36.675808', '', 1),
(135, '370200', '370000', '青岛市', '青岛', 'qingdaoshi', 'Q', '120.355171', '36.082981', '', 1),
(136, '370300', '370000', '淄博市', '淄博', 'ziboshi', 'Z', '118.047646', '36.814938', '', 1),
(137, '370400', '370000', '枣庄市', '枣庄', 'zaozhuangshi', 'Z', '117.557961', '34.856422', '', 1),
(138, '370500', '370000', '东营市', '东营', 'dongyingshi', 'D', '118.664711', '37.434563', '', 1),
(139, '370600', '370000', '烟台市', '烟台', 'yantaishi', 'Y', '121.39138', '37.539295', '', 1),
(140, '370700', '370000', '潍坊市', '潍坊', 'weifangshi', 'W', '119.107079', '36.709251', '', 1),
(141, '370800', '370000', '济宁市', '济宁', 'jiningshi', 'J', '116.587242', '35.415394', '', 1),
(142, '370900', '370000', '泰安市', '泰安', 'taianshi', 'T', '117.129066', '36.194969', '', 1),
(143, '371000', '370000', '威海市', '威海', 'weihaishi', 'W', '122.116394', '37.509689', '', 1),
(144, '371100', '370000', '日照市', '日照', 'rizhaoshi', 'R', '119.461205', '35.428589', '', 1),
(145, '371200', '370000', '莱芜市', '莱芜', 'laiwushi', 'L', '117.677734', '36.214397', '', 1),
(146, '371300', '370000', '临沂市', '临沂', 'linyishi', 'L', '118.326447', '35.065281', '', 1),
(147, '371400', '370000', '德州市', '德州', 'dezhoushi', 'D', '116.307426', '37.453968', '', 1),
(148, '371500', '370000', '聊城市', '聊城', 'liaochengshi', 'L', '115.98037', '36.456013', '', 1),
(149, '371600', '370000', '滨州市', '滨州', 'binzhoushi', 'B', '118.016975', '37.383541', '', 1),
(150, '371700', '370000', '菏泽市', '菏泽', 'hezeshi', 'H', '115.469383', '35.246532', '', 1),
(151, '410100', '410000', '郑州市', '郑州', 'zhengzhoushi', 'Z', '113.665413', '34.757977', '', 1),
(152, '410200', '410000', '开封市', '开封', 'kaifengshi', 'K', '114.341446', '34.79705', '', 1),
(153, '410300', '410000', '洛阳市', '洛阳', 'luoyangshi', 'L', '112.434471', '34.66304', '', 1),
(154, '410400', '410000', '平顶山市', '平顶山', 'pingdingshanshi', 'P', '113.307716', '33.735241', '', 1),
(155, '410500', '410000', '安阳市', '安阳', 'anyangshi', 'A', '114.352486', '36.103443', '', 1),
(156, '410600', '410000', '鹤壁市', '鹤壁', 'hebishi', 'H', '114.295441', '35.748238', '', 1),
(157, '410700', '410000', '新乡市', '新乡', 'xinxiangshi', 'X', '113.883987', '35.302616', '', 1),
(158, '410800', '410000', '焦作市', '焦作', 'jiaozuoshi', 'J', '113.238266', '35.23904', '', 1),
(159, '410881', '410000', '济源市', '济源', 'jiyuanshi', 'J', '112.59005', '35.090378', '', 1),
(160, '410900', '410000', '濮阳市', '濮阳', 'puyangshi', 'P', '115.041298', '35.768234', '', 1),
(161, '411000', '410000', '许昌市', '许昌', 'xuchangshi', 'X', '113.826065', '34.022957', '', 1),
(162, '411100', '410000', '漯河市', '漯河', 'taheshi', 'L', '114.026405', '33.575855', '', 1),
(163, '411200', '410000', '三门峡市', '三门峡', 'sanmenxiashi', 'S', '111.194099', '34.777336', '', 1),
(164, '411300', '410000', '南阳市', '南阳', 'nanyangshi', 'N', '112.540916', '32.999081', '', 1),
(165, '411400', '410000', '商丘市', '商丘', 'shangqiushi', 'S', '115.650497', '34.437054', '', 1),
(166, '411500', '410000', '信阳市', '信阳', 'xinyangshi', 'X', '114.075027', '32.123276', '', 1),
(167, '411600', '410000', '周口市', '周口', 'zhoukoushi', 'Z', '114.649651', '33.620358', '', 1),
(168, '411700', '410000', '驻马店市', '驻马店', 'zhumadianshi', 'Z', '114.024734', '32.980167', '', 1),
(169, '420100', '420000', '武汉市', '武汉', 'wuhanshi', 'W', '114.298569', '30.584354', '', 1),
(170, '420200', '420000', '黄石市', '黄石', 'huangshishi', 'H', '115.077049', '30.220074', '', 1),
(171, '420300', '420000', '十堰市', '十堰', 'shiyanshi', 'S', '110.787918', '32.646908', '', 1),
(172, '420500', '420000', '宜昌市', '宜昌', 'yichangshi', 'Y', '111.29084', '30.702637', '', 1),
(173, '420600', '420000', '襄阳市', '襄阳', 'xiangyangshi', 'X', '112.14415', '32.042427', '', 1),
(174, '420700', '420000', '鄂州市', '鄂州', 'ezhoushi', 'E', '114.890594', '30.396536', '', 1),
(175, '420800', '420000', '荆门市', '荆门', 'jingmenshi', 'J', '112.204254', '31.035419', '', 1),
(176, '420900', '420000', '孝感市', '孝感', 'xiaoganshi', 'X', '113.926659', '30.926422', '', 1),
(177, '421000', '420000', '荆州市', '荆州', 'jingzhoushi', 'J', '112.238129', '30.326857', '', 1),
(178, '421100', '420000', '黄冈市', '黄冈', 'huanggangshi', 'H', '114.879364', '30.447712', '', 1),
(179, '421200', '420000', '咸宁市', '咸宁', 'xianningshi', 'X', '114.328964', '29.832798', '', 1),
(180, '421300', '420000', '随州市', '随州', 'suizhoushi', 'S', '113.373772', '31.717497', '', 1),
(181, '422800', '420000', '恩施土家族苗族自治州', '恩施', 'enshitujiazumiaozuzizhizhou', 'E', '109.486992', '30.283113', '', 1),
(182, '429004', '420000', '仙桃市', '仙桃', 'xiantaoshi', 'X', '113.453972', '30.364952', '', 1),
(183, '429005', '420000', '潜江市', '潜江', 'qianjiangshi', 'Q', '112.896866', '30.421215', '', 1),
(184, '429006', '420000', '天门市', '天门', 'tianmenshi', 'T', '113.165863', '30.653061', '', 1),
(185, '429021', '420000', '神农架林区', '神农架', 'shennongjialinqu', 'S', '114.298569', '30.584354', '', 1),
(186, '430100', '430000', '长沙市', '长沙', 'changshashi', 'Z', '112.982277', '28.19409', '', 1),
(187, '430200', '430000', '株洲市', '株洲', 'zhuzhoushi', 'Z', '113.151733', '27.835806', '', 1),
(188, '430300', '430000', '湘潭市', '湘潭', 'xiangtanshi', 'X', '112.944054', '27.829729', '', 1),
(189, '430400', '430000', '衡阳市', '衡阳', 'hengyangshi', 'H', '112.607697', '26.900358', '', 1),
(190, '430500', '430000', '邵阳市', '邵阳', 'shaoyangshi', 'S', '111.469231', '27.237843', '', 1),
(191, '430600', '430000', '岳阳市', '岳阳', 'yueyangshi', 'Y', '113.132858', '29.370291', '', 1),
(192, '430700', '430000', '常德市', '常德', 'changdeshi', 'C', '111.691345', '29.040224', '', 1),
(193, '430800', '430000', '张家界市', '张家界', 'zhangjiajieshi', 'Z', '110.479919', '29.127401', '', 1),
(194, '430900', '430000', '益阳市', '益阳', 'yiyangshi', 'Y', '112.355042', '28.570066', '', 1),
(195, '431000', '430000', '郴州市', '郴州', 'chenzhoushi', 'C', '113.032066', '25.793589', '', 1),
(196, '431100', '430000', '永州市', '永州', 'yongzhoushi', 'Y', '111.608017', '26.434517', '', 1),
(197, '431200', '430000', '怀化市', '怀化', 'huaihuashi', 'H', '109.978241', '27.550081', '', 1),
(198, '431300', '430000', '娄底市', '娄底', 'loudishi', 'L', '112.008499', '27.728136', '', 1),
(199, '433100', '430000', '湘西土家族苗族自治州', '湘西', 'xiangxitujiazumiaozuzizhizhou', 'X', '109.739738', '28.314297', '', 1),
(200, '440100', '440000', '广州市', '广州', 'guangzhoushi', 'G', '113.28064', '23.125177', '', 1),
(201, '440200', '440000', '韶关市', '韶关', 'shaoguanshi', 'S', '113.591545', '24.801323', '', 1),
(202, '440300', '440000', '深圳市', '深圳', 'shenzhenshi', 'S', '114.085945', '22.547001', '', 1),
(203, '440400', '440000', '珠海市', '珠海', 'zhuhaishi', 'Z', '113.553986', '22.224979', '', 1),
(204, '440500', '440000', '汕头市', '汕头', 'shantoushi', 'S', '116.708466', '23.371019', '', 1),
(205, '440600', '440000', '佛山市', '佛山', 'foshanshi', 'F', '113.122719', '23.028763', '', 1),
(206, '440700', '440000', '江门市', '江门', 'jiangmenshi', 'J', '113.09494', '22.590431', '', 1),
(207, '440800', '440000', '湛江市', '湛江', 'zhanjiangshi', 'Z', '110.364975', '21.274899', '', 1),
(208, '440900', '440000', '茂名市', '茂名', 'maomingshi', 'M', '110.919228', '21.659752', '', 1),
(209, '441200', '440000', '肇庆市', '肇庆', 'zhaoqingshi', 'Z', '112.472527', '23.051546', '', 1),
(210, '441300', '440000', '惠州市', '惠州', 'huizhoushi', 'H', '114.412598', '23.079405', '', 1),
(211, '441400', '440000', '梅州市', '梅州', 'meizhoushi', 'M', '116.117584', '24.299112', '', 1),
(212, '441500', '440000', '汕尾市', '汕尾', 'shanweishi', 'S', '115.364235', '22.774485', '', 1),
(213, '441600', '440000', '河源市', '河源', 'heyuanshi', 'H', '114.6978', '23.746265', '', 1),
(214, '441700', '440000', '阳江市', '阳江', 'yangjiangshi', 'Y', '111.975105', '21.859222', '', 1),
(215, '441800', '440000', '清远市', '清远', 'qingyuanshi', 'Q', '113.051224', '23.685022', '', 1),
(216, '441900', '440000', '东莞市', '东莞', 'dongguanshi', 'D', '113.746262', '23.046238', '', 1),
(217, '442000', '440000', '中山市', '中山', 'zhongshanshi', 'Z', '113.382393', '22.521112', '', 1),
(218, '442101', '440000', '东沙群岛', '东沙', 'dongshaqundao', 'D', '112.552948', '21.810463', '', 1),
(219, '445100', '440000', '潮州市', '潮州', 'chaozhoushi', 'C', '116.632301', '23.661701', '', 1),
(220, '445200', '440000', '揭阳市', '揭阳', 'jieyangshi', 'J', '116.355736', '23.543777', '', 1),
(221, '445300', '440000', '云浮市', '云浮', 'yunfushi', 'Y', '112.044441', '22.929802', '', 1),
(222, '450100', '450000', '南宁市', '南宁', 'nanningshi', 'N', '108.320007', '22.82402', '', 1),
(223, '450200', '450000', '柳州市', '柳州', 'liuzhoushi', 'L', '109.411705', '24.314617', '', 1),
(224, '450300', '450000', '桂林市', '桂林', 'guilinshi', 'G', '110.299118', '25.274216', '', 1),
(225, '450400', '450000', '梧州市', '梧州', 'wuzhoushi', 'W', '111.297607', '23.474804', '', 1),
(226, '450500', '450000', '北海市', '北海', 'beihaishi', 'B', '109.119255', '21.473343', '', 1),
(227, '450600', '450000', '防城港市', '防城港', 'fangchenggangshi', 'F', '108.345474', '21.614632', '', 1),
(228, '450700', '450000', '钦州市', '钦州', 'qinzhoushi', 'Q', '108.624176', '21.967127', '', 1),
(229, '450800', '450000', '贵港市', '贵港', 'guigangshi', 'G', '109.602142', '23.093599', '', 1),
(230, '450900', '450000', '玉林市', '玉林', 'yulinshi', 'Y', '110.154396', '22.631359', '', 1),
(231, '451000', '450000', '百色市', '百色', 'boseshi', 'B', '106.616287', '23.897741', '', 1),
(232, '451100', '450000', '贺州市', '贺州', 'hezhoushi', 'H', '111.552055', '24.414141', '', 1),
(233, '451200', '450000', '河池市', '河池', 'hechishi', 'H', '108.062103', '24.695898', '', 1),
(234, '451300', '450000', '来宾市', '来宾', 'laibinshi', 'L', '109.229774', '23.733767', '', 1),
(235, '451400', '450000', '崇左市', '崇左', 'chongzuoshi', 'C', '107.353928', '22.404108', '', 1),
(236, '460100', '460000', '海口市', '海口', 'haikoushi', 'H', '110.331192', '20.031971', '', 1),
(237, '460200', '460000', '三亚市', '三亚', 'sanyashi', 'S', '109.50827', '18.247871', '', 1),
(238, '460300', '460000', '三沙市', '三沙', 'sanshashi', 'S', '112.348824', '16.831039', '', 1),
(239, '469001', '460000', '五指山市', '五指山', 'wuzhishanshi', 'W', '109.516663', '18.77692', '', 1),
(240, '469002', '460000', '琼海市', '琼海', 'qionghaishi', 'Q', '110.466782', '19.246012', '', 1),
(241, '469003', '460000', '儋州市', '儋州', 'danzhoushi', 'D', '109.576782', '19.517487', '', 1),
(242, '469005', '460000', '文昌市', '文昌', 'wenchangshi', 'W', '110.753975', '19.612986', '', 1),
(243, '469006', '460000', '万宁市', '万宁', 'wanningshi', 'W', '110.388794', '18.796215', '', 1),
(244, '469007', '460000', '东方市', '东方', 'dongfangshi', 'D', '108.653786', '19.10198', '', 1),
(245, '469025', '460000', '定安县', '定安', 'dinganxian', 'D', '110.349236', '19.684965', '', 1),
(246, '469026', '460000', '屯昌县', '屯昌', 'tunchangxian', 'T', '110.102776', '19.362917', '', 1),
(247, '469027', '460000', '澄迈县', '澄迈', 'chengmaixian', 'C', '110.007149', '19.737095', '', 1),
(248, '469028', '460000', '临高县', '临高', 'lingaoxian', 'L', '109.687698', '19.908293', '', 1),
(249, '469030', '460000', '白沙黎族自治县', '白沙', 'baishalizuzizhixian', 'B', '109.452606', '19.224585', '', 1),
(250, '469031', '460000', '昌江黎族自治县', '昌江', 'changjianglizuzizhixian', 'C', '109.053352', '19.260967', '', 1),
(251, '469033', '460000', '乐东黎族自治县', '乐东', 'ledonglizuzizhixian', 'L', '109.175446', '18.74758', '', 1),
(252, '469034', '460000', '陵水黎族自治县', '陵水', 'lingshuilizuzizhixian', 'L', '110.037216', '18.505007', '', 1),
(253, '469035', '460000', '保亭黎族苗族自治县', '保亭', 'baotinglizumiaozuzizhixian', 'B', '109.702454', '18.636372', '', 1),
(254, '469036', '460000', '琼中黎族苗族自治县', '琼中', 'qiongzhonglizumiaozuzizhixian', 'Q', '109.839996', '19.03557', '', 1),
(255, '500100', '500000', '重庆市', '重庆', 'chongqingshi', 'Z', '106.504959', '29.533155', '', 1),
(256, '510100', '510000', '成都市', '成都', 'chengdushi', 'C', '104.065735', '30.659462', '', 1),
(257, '510300', '510000', '自贡市', '自贡', 'zigongshi', 'Z', '104.773445', '29.352764', '', 1),
(258, '510400', '510000', '攀枝花市', '攀枝花', 'panzhihuashi', 'P', '101.716003', '26.580446', '', 1),
(259, '510500', '510000', '泸州市', '泸州', 'luzhoushi', 'L', '105.443352', '28.889137', '', 1),
(260, '510600', '510000', '德阳市', '德阳', 'deyangshi', 'D', '104.398651', '31.127991', '', 1),
(261, '510700', '510000', '绵阳市', '绵阳', 'mianyangshi', 'M', '104.741722', '31.46402', '', 1),
(262, '510800', '510000', '广元市', '广元', 'guangyuanshi', 'G', '105.829758', '32.433666', '', 1),
(263, '510900', '510000', '遂宁市', '遂宁', 'suiningshi', 'S', '105.571327', '30.513311', '', 1),
(264, '511000', '510000', '内江市', '内江', 'neijiangshi', 'N', '105.066139', '29.58708', '', 1),
(265, '511100', '510000', '乐山市', '乐山', 'leshanshi', 'L', '103.761261', '29.582024', '', 1),
(266, '511300', '510000', '南充市', '南充', 'nanchongshi', 'N', '106.082977', '30.79528', '', 1),
(267, '511400', '510000', '眉山市', '眉山', 'meishanshi', 'M', '103.831787', '30.048319', '', 1),
(268, '511500', '510000', '宜宾市', '宜宾', 'yibinshi', 'Y', '104.630821', '28.760189', '', 1),
(269, '511600', '510000', '广安市', '广安', 'guanganshi', 'G', '106.633369', '30.456398', '', 1),
(270, '511700', '510000', '达州市', '达州', 'dazhoushi', 'D', '107.502258', '31.209484', '', 1),
(271, '511800', '510000', '雅安市', '雅安', 'yaanshi', 'Y', '103.00103', '29.987722', '', 1),
(272, '511900', '510000', '巴中市', '巴中', 'bazhongshi', 'B', '106.75367', '31.858809', '', 1),
(273, '512000', '510000', '资阳市', '资阳', 'ziyangshi', 'Z', '104.641914', '30.122211', '', 1),
(274, '513200', '510000', '阿坝藏族羌族自治州', '阿坝', 'abazangzuqiangzuzizhizhou', 'A', '102.221375', '31.899792', '', 1),
(275, '513300', '510000', '甘孜藏族自治州', '甘孜', 'ganzizangzuzizhizhou', 'G', '101.963814', '30.050663', '', 1),
(276, '513400', '510000', '凉山彝族自治州', '凉山', 'liangshanyizuzizhizhou', 'L', '102.258743', '27.886763', '', 1),
(277, '520100', '520000', '贵阳市', '贵阳', 'guiyangshi', 'G', '106.713478', '26.578342', '', 1),
(278, '520200', '520000', '六盘水市', '六盘水', 'liupanshuishi', 'L', '104.846741', '26.584642', '', 1),
(279, '520300', '520000', '遵义市', '遵义', 'zunyishi', 'Z', '106.937263', '27.706627', '', 1),
(280, '520400', '520000', '安顺市', '安顺', 'anshunshi', 'A', '105.93219', '26.245544', '', 1),
(281, '522200', '520000', '铜仁市', '铜仁', 'tongrenshi', 'T', '109.191551', '27.718346', '', 1),
(282, '522300', '520000', '黔西南布依族苗族自治州', '黔西南', 'qianxinanbuyizumiaozuzizhizhou', 'Q', '104.897972', '25.08812', '', 1),
(283, '522400', '520000', '毕节市', '毕节', 'bijieshi', 'B', '105.285011', '27.301693', '', 1),
(284, '522600', '520000', '黔东南苗族侗族自治州', '黔东南', 'qiandongnanmiaozudongzuzizhizhou', 'Q', '107.977486', '26.583351', '', 1),
(285, '522700', '520000', '黔南布依族苗族自治州', '黔南', 'qiannanbuyizumiaozuzizhizhou', 'Q', '107.517159', '26.258219', '', 1),
(286, '530100', '530000', '昆明市', '昆明', 'kunmingshi', 'K', '102.71225', '25.040609', '', 1),
(287, '530300', '530000', '曲靖市', '曲靖', 'qujingshi', 'Q', '103.797852', '25.501556', '', 1),
(288, '530400', '530000', '玉溪市', '玉溪', 'yuxishi', 'Y', '102.543907', '24.35046', '', 1),
(289, '530500', '530000', '保山市', '保山', 'baoshanshi', 'B', '99.16713', '25.111801', '', 1),
(290, '530600', '530000', '昭通市', '昭通', 'zhaotongshi', 'Z', '103.717216', '27.337', '', 1),
(291, '530700', '530000', '丽江市', '丽江', 'lijiangshi', 'L', '100.233025', '26.872108', '', 1),
(292, '530800', '530000', '普洱市', '普洱', 'puershi', 'P', '100.972343', '22.777321', '', 1),
(293, '530900', '530000', '临沧市', '临沧', 'lincangshi', 'L', '100.086967', '23.886566', '', 1),
(294, '532300', '530000', '楚雄彝族自治州', '楚雄', 'chuxiongyizuzizhizhou', 'C', '101.546043', '25.041988', '', 1),
(295, '532500', '530000', '红河哈尼族彝族自治州', '红河', 'honghehanizuyizuzizhizhou', 'H', '103.384186', '23.366776', '', 1),
(296, '532600', '530000', '文山壮族苗族自治州', '文山', 'wenshanzhuangzumiaozuzizhizhou', 'W', '104.244011', '23.369511', '', 1),
(297, '532800', '530000', '西双版纳傣族自治州', '西双版纳', 'xishuangbannadaizuzizhizhou', 'X', '100.797943', '22.001724', '', 1),
(298, '532900', '530000', '大理白族自治州', '大理', 'dalibaizuzizhizhou', 'D', '100.22567', '25.589449', '', 1),
(299, '533100', '530000', '德宏傣族景颇族自治州', '德宏', 'dehongdaizujingpozuzizhizhou', 'D', '98.578362', '24.436693', '', 1),
(300, '533300', '530000', '怒江傈僳族自治州', '怒江', 'nujianglisuzuzizhizhou', 'N', '98.854301', '25.850948', '', 1),
(301, '533400', '530000', '迪庆藏族自治州', '迪庆', 'diqingzangzuzizhizhou', 'D', '99.706467', '27.826853', '', 1),
(302, '540100', '540000', '拉萨市', '拉萨', 'lasashi', 'L', '91.13221', '29.66036', '', 1),
(303, '542100', '540000', '昌都地区', '昌都', 'changdudiqu', 'C', '97.178452', '31.136875', '', 1),
(304, '542200', '540000', '山南地区', '山南', 'shannandiqu', 'S', '91.766525', '29.236023', '', 1),
(305, '542300', '540000', '日喀则地区', '日喀则', 'rikazediqu', 'R', '88.885147', '29.267519', '', 1),
(306, '542400', '540000', '那曲地区', '那曲', 'naqudiqu', 'N', '92.060211', '31.476004', '', 1),
(307, '542500', '540000', '阿里地区', '阿里', 'alidiqu', 'A', '80.105499', '32.503185', '', 1),
(308, '542600', '540000', '林芝地区', '林芝', 'linzhidiqu', 'L', '94.36235', '29.654694', '', 1),
(309, '610100', '610000', '西安市', '西安', 'xianshi', 'X', '108.948021', '34.263161', '', 1),
(310, '610200', '610000', '铜川市', '铜川', 'tongchuanshi', 'T', '108.979607', '34.91658', '', 1),
(311, '610300', '610000', '宝鸡市', '宝鸡', 'baojishi', 'B', '107.144867', '34.369316', '', 1),
(312, '610400', '610000', '咸阳市', '咸阳', 'xianyangshi', 'X', '108.705116', '34.333439', '', 1),
(313, '610500', '610000', '渭南市', '渭南', 'weinanshi', 'W', '109.502884', '34.499382', '', 1),
(314, '610600', '610000', '延安市', '延安', 'yananshi', 'Y', '109.490807', '36.596539', '', 1),
(315, '610700', '610000', '汉中市', '汉中', 'hanzhongshi', 'H', '107.028618', '33.077667', '', 1),
(316, '610800', '610000', '榆林市', '榆林', 'yulinshi', 'Y', '109.741196', '38.290161', '', 1),
(317, '610900', '610000', '安康市', '安康', 'ankangshi', 'A', '109.029274', '32.6903', '', 1),
(318, '611000', '610000', '商洛市', '商洛', 'shangluoshi', 'S', '109.939774', '33.86832', '', 1),
(319, '620100', '620000', '兰州市', '兰州', 'lanzhoushi', 'L', '103.823555', '36.058041', '', 1),
(320, '620200', '620000', '嘉峪关市', '嘉峪关', 'jiayuguanshi', 'J', '98.277306', '39.78653', '', 1),
(321, '620300', '620000', '金昌市', '金昌', 'jinchangshi', 'J', '102.187889', '38.514236', '', 1),
(322, '620400', '620000', '白银市', '白银', 'baiyinshi', 'B', '104.173607', '36.545681', '', 1),
(323, '620500', '620000', '天水市', '天水', 'tianshuishi', 'T', '105.724998', '34.578529', '', 1),
(324, '620600', '620000', '武威市', '武威', 'wuweishi', 'W', '102.634697', '37.929996', '', 1),
(325, '620700', '620000', '张掖市', '张掖', 'zhangyeshi', 'Z', '100.455475', '38.932896', '', 1),
(326, '620800', '620000', '平凉市', '平凉', 'pingliangshi', 'P', '106.684692', '35.542789', '', 1),
(327, '620900', '620000', '酒泉市', '酒泉', 'jiuquanshi', 'J', '98.510796', '39.744022', '', 1),
(328, '621000', '620000', '庆阳市', '庆阳', 'qingyangshi', 'Q', '107.638374', '35.734219', '', 1),
(329, '621100', '620000', '定西市', '定西', 'dingxishi', 'D', '104.626297', '35.579578', '', 1),
(330, '621200', '620000', '陇南市', '陇南', 'longnanshi', 'L', '104.929382', '33.388599', '', 1),
(331, '622900', '620000', '临夏回族自治州', '临夏', 'linxiahuizuzizhizhou', 'L', '103.212006', '35.599445', '', 1),
(332, '623000', '620000', '甘南藏族自治州', '甘南', 'gannanzangzuzizhizhou', 'G', '102.911011', '34.986355', '', 1),
(333, '630100', '630000', '西宁市', '西宁', 'xiningshi', 'X', '101.778915', '36.623177', '', 1),
(334, '632100', '630000', '海东市', '海东', 'haidongshi', 'H', '102.103271', '36.502914', '', 1),
(335, '632200', '630000', '海北藏族自治州', '海北', 'haibeizangzuzizhizhou', 'H', '100.901062', '36.959435', '', 1),
(336, '632300', '630000', '黄南藏族自治州', '黄南', 'huangnanzangzuzizhizhou', 'H', '102.019989', '35.517742', '', 1),
(337, '632500', '630000', '海南藏族自治州', '海南藏族', 'hainanzangzuzizhizhou', 'H', '100.619545', '36.280354', '', 1),
(338, '632600', '630000', '果洛藏族自治州', '果洛', 'guoluozangzuzizhizhou', 'G', '100.242142', '34.473598', '', 1),
(339, '632700', '630000', '玉树藏族自治州', '玉树', 'yushuzangzuzizhizhou', 'Y', '97.008522', '33.004047', '', 1),
(340, '632800', '630000', '海西蒙古族藏族自治州', '海西', 'haiximengguzuzangzuzizhizhou', 'H', '97.370789', '37.374664', '', 1),
(341, '640100', '640000', '银川市', '银川', 'yinchuanshi', 'Y', '106.278175', '38.46637', '', 1),
(342, '640200', '640000', '石嘴山市', '石嘴山', 'shizuishanshi', 'S', '106.376175', '39.013329', '', 1),
(343, '640300', '640000', '吴忠市', '吴忠', 'wuzhongshi', 'W', '106.199409', '37.986164', '', 1),
(344, '640400', '640000', '固原市', '固原', 'guyuanshi', 'G', '106.28524', '36.004562', '', 1),
(345, '640500', '640000', '中卫市', '中卫', 'zhongweishi', 'Z', '105.189568', '37.51495', '', 1),
(346, '650100', '650000', '乌鲁木齐市', '乌鲁木齐', 'wulumuqishi', 'W', '87.617729', '43.792816', '', 1),
(347, '650200', '650000', '克拉玛依市', '克拉玛依', 'kelamayishi', 'K', '84.873947', '45.595886', '', 1),
(348, '652100', '650000', '吐鲁番地区', '吐鲁番', 'tulufandiqu', 'T', '89.184074', '42.947613', '', 1),
(349, '652200', '650000', '哈密地区', '哈密', 'hamidiqu', 'H', '93.513161', '42.833248', '', 1),
(350, '652300', '650000', '昌吉回族自治州', '昌吉', 'changjihuizuzizhizhou', 'C', '87.304008', '44.014576', '', 1),
(351, '652700', '650000', '博尔塔拉蒙古自治州', '博尔塔拉', 'boertalamengguzizhizhou', 'B', '82.074776', '44.903259', '', 1),
(352, '652800', '650000', '巴音郭楞蒙古自治州', '巴音郭楞', 'bayinguolengmengguzizhizhou', 'B', '86.15097', '41.768551', '', 1),
(353, '652900', '650000', '阿克苏地区', '阿克苏', 'akesudiqu', 'A', '80.265068', '41.170712', '', 1),
(354, '653000', '650000', '克孜勒苏柯尔克孜自治州', '克孜勒苏柯尔克孜', 'kezilesukeerkezizizhizhou', 'K', '76.172829', '39.713432', '', 1),
(355, '653100', '650000', '喀什地区', '喀什', 'kashidiqu', 'K', '75.989136', '39.467663', '', 1),
(356, '653200', '650000', '和田地区', '和田', 'hetiandiqu', 'H', '79.925331', '37.110687', '', 1),
(357, '654000', '650000', '伊犁哈萨克自治州', '伊犁', 'yilihasakezizhizhou', 'Y', '81.317947', '43.92186', '', 1),
(358, '654200', '650000', '塔城地区', '塔城', 'tachengdiqu', 'T', '82.985733', '46.7463', '', 1),
(359, '654300', '650000', '阿勒泰地区', '阿勒泰', 'aletaidiqu', 'A', '88.139633', '47.848392', '', 1),
(360, '659001', '650000', '石河子市', '石河子', 'shihezishi', 'S', '86.041077', '44.305885', '', 1),
(361, '659002', '650000', '阿拉尔市', '阿拉尔', 'alaershi', 'A', '81.285881', '40.541916', '', 1),
(362, '659003', '650000', '图木舒克市', '图木舒克', 'tumushukeshi', 'T', '79.07798', '39.867317', '', 1),
(363, '659004', '650000', '五家渠市', '五家渠', 'wujiaqushi', 'W', '87.526886', '44.1674', '', 1),
(364, '710100', '710000', '台北市', '台北', 'taibeishi', 'T', '121.509064', '25.044333', '', 1),
(365, '710200', '710000', '高雄市', '高雄', 'gaoxiongshi', 'G', '121.509064', '25.044333', '', 1),
(366, '710300', '710000', '台南市', '台南', 'tainanshi', 'T', '121.509064', '25.044333', '', 1),
(367, '710400', '710000', '台中市', '台中', 'taizhongshi', 'T', '121.509064', '25.044333', '', 1),
(368, '710500', '710000', '金门县', '金门', 'jinmenxian', 'J', '121.509064', '25.044333', '', 1),
(369, '710600', '710000', '南投县', '南投', 'nantouxian', 'N', '121.509064', '25.044333', '', 1),
(370, '710700', '710000', '基隆市', '基隆', 'jilongshi', 'J', '121.509064', '25.044333', '', 1),
(371, '710800', '710000', '新竹市', '新竹', 'xinzhushi', 'X', '121.509064', '25.044333', '', 1),
(372, '710900', '710000', '嘉义市', '嘉义', 'jiayishi', 'J', '121.509064', '25.044333', '', 1),
(373, '711100', '710000', '新北市', '新北', 'xinbeishi', 'X', '121.509064', '25.044333', '', 1),
(374, '711200', '710000', '宜兰县', '宜兰', 'yilanxian', 'Y', '121.509064', '25.044333', '', 1),
(375, '711300', '710000', '新竹县', '新竹', 'xinzhuxian', 'X', '121.509064', '25.044333', '', 1),
(376, '711400', '710000', '桃园县', '桃园', 'taoyuanxian', 'T', '121.509064', '25.044333', '', 1),
(377, '711500', '710000', '苗栗县', '苗栗', 'miaolixian', 'M', '121.509064', '25.044333', '', 1),
(378, '711700', '710000', '彰化县', '彰化', 'zhanghuaxian', 'Z', '121.509064', '25.044333', '', 1),
(379, '711900', '710000', '嘉义县', '嘉义', 'jiayixian', 'J', '121.509064', '25.044333', '', 1),
(380, '712100', '710000', '云林县', '云林', 'yunlinxian', 'Y', '121.509064', '25.044333', '', 1),
(381, '712400', '710000', '屏东县', '屏东', 'pingdongxian', 'P', '121.509064', '25.044333', '', 1),
(382, '712500', '710000', '台东县', '台东', 'taidongxian', 'T', '121.509064', '25.044333', '', 1),
(383, '712600', '710000', '花莲县', '花莲', 'hualianxian', 'H', '121.509064', '25.044333', '', 1),
(384, '712700', '710000', '澎湖县', '澎湖', 'penghuxian', 'P', '121.509064', '25.044333', '', 1),
(385, '712800', '710000', '连江县', '连江', 'lianjiangxian', 'L', '121.509064', '25.044333', '', 1),
(386, '810100', '810000', '香港岛', '香港岛', 'xianggangdao', 'X', '114.173355', '22.320047', '', 1),
(387, '810200', '810000', '九龙', '九龙', 'jiulong', 'J', '114.173355', '22.320047', '', 1),
(388, '810300', '810000', '新界', '新界', 'xinjie', 'X', '114.173355', '22.320047', '', 1),
(389, '820100', '820000', '澳门半岛', '澳门半岛', 'aomenbandao', 'A', '113.549133', '22.198751', '', 1),
(390, '820200', '820000', '离岛', '离岛', 'lidao', 'L', '113.549088', '22.198952', '', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
