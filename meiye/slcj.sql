-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2017 at 12:18 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meiye`
--

-- --------------------------------------------------------

--
-- Table structure for table `mr_admin`
--

CREATE TABLE `mr_admin` (
  `admin_id` int(11) NOT NULL COMMENT '管理员ID',
  `admin_username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `admin_pwd` varchar(70) NOT NULL COMMENT '管理员密码',
  `admin_email` varchar(30) NOT NULL COMMENT '邮箱',
  `admin_realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `admin_tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `admin_hits` int(8) NOT NULL DEFAULT '1' COMMENT '登陆次数',
  `admin_ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `admin_addtime` int(11) NOT NULL COMMENT '添加时间',
  `admin_mdemail` varchar(50) NOT NULL DEFAULT '0' COMMENT '传递修改密码参数加密',
  `admin_open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_admin`
--

INSERT INTO `mr_admin` (`admin_id`, `admin_username`, `admin_pwd`, `admin_email`, `admin_realname`, `admin_tel`, `admin_hits`, `admin_ip`, `admin_addtime`, `admin_mdemail`, `admin_open`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1023102176@qq.com', 'Tot ziens', '18819489576', 246, '127.0.0.1', 112222233, '206125c6e7523ba7c0301144ac24eea9', 1),
(2, 'test', 'e10adc3949ba59abbe56e057f20f883e', '1023102176@qq.com', 'test', '18819489689', 25, '127.0.0.1', 1446683501, '206125c6e7523ba7c0301144ac24eea9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_auth_group`
--

CREATE TABLE `mr_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` longtext,
  `addtime` int(11) NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_auth_group`
--

INSERT INTO `mr_auth_group` (`id`, `title`, `status`, `rules`, `addtime`) VALUES
(1, '超级管理员', 1, '1,2,6,105,43,122,180,124,125,123,15,16,119,144,120,146,121,145,17,149,115,116,150,117,118,147,148,151,181,18,108,152,114,113,112,109,110,111,28,31,32,34,', 1212451252),
(2, '管理员', 1, '1,15,16,120,146,7,8,12,139,11,136,154,137,138,135,25,140,141,142,9,13,157,158,159,160,155,14,156,28,31,32,34,', 1212451252);

-- --------------------------------------------------------

--
-- Table structure for table `mr_auth_group_access`
--

CREATE TABLE `mr_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_auth_group_access`
--

INSERT INTO `mr_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_auth_rule`
--

CREATE TABLE `mr_auth_rule` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `authopen` tinyint(2) NOT NULL DEFAULT '1',
  `css` varchar(20) DEFAULT NULL COMMENT '样式',
  `condition` char(100) DEFAULT '',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `zt` int(1) DEFAULT NULL,
  `menustatus` tinyint(1) DEFAULT NULL,
  `level` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_auth_rule`
--

INSERT INTO `mr_auth_rule` (`id`, `name`, `title`, `type`, `status`, `authopen`, `css`, `condition`, `pid`, `sort`, `addtime`, `zt`, `menustatus`, `level`) VALUES
(1, 'Sys', '系统设置', 1, 1, 0, 'fa-cogs', '', 0, 0, 1446535750, 1, 1, 1),
(2, 'Sys/sys', '系统参数设置', 1, 1, 0, '', '', 1, 0, 1446535789, 1, 1, 2),
(6, 'Sys/sys', '站点设置', 1, 1, 0, '', '', 2, 0, 1446535843, 1, 1, 3),
(7, 'News', '文章管理', 1, 1, 0, 'fa-folder', '', 0, 1, 1446535875, 1, 1, 1),
(8, 'News/news_list', '文章操作', 1, 1, 0, '', '', 7, 0, 1446535875, 1, 1, 2),
(9, 'News/news_column', '栏目管理', 1, 1, 0, '', '', 7, 0, 1446535750, 1, 1, 2),
(11, 'News/news_list', '文章列表', 1, 1, 0, '', '', 8, 1, 1446535750, 1, 1, 3),
(12, 'News/news_listadd', '添加文章', 1, 1, 0, '', '', 8, 0, 1446535750, 1, 0, 3),
(13, 'News/news_column', '栏目列表', 1, 1, 0, '', '', 9, 0, 1446535750, 1, 1, 3),
(14, 'News/news_columnadd', '添加栏目', 1, 1, 0, '', '', 9, 0, 1446535750, 1, 1, 3),
(15, 'Sys/admin_list', '管理员管理', 1, 1, 0, '', '', 1, 0, 1446535750, 1, 1, 2),
(16, 'Sys/admin_list', '管理员列表', 1, 1, 0, '', '', 15, 0, 1446535750, 1, 1, 3),
(17, 'Sys/admin_group', '用户组列表', 1, 1, 0, '', '', 15, 0, 1446535750, 1, 1, 3),
(18, 'Sys/admin_rule', '权限管理', 1, 1, 0, '', '', 15, 1, 1446535750, 1, 1, 3),
(25, 'News/news_back', '回收站', 1, 1, 0, '', '', 8, 2, 1447039310, 1, 1, 3),
(28, 'Plug', '插件功能', 1, 1, 0, 'fa-plug', '', 0, 400, 1447231590, 1, 1, 1),
(31, 'Plug/plug_link_list', '友情链接', 1, 1, 0, '', '', 28, 50, 1447232183, 0, 1, 3),
(32, 'Plug/plug_link_list', '链接列表', 1, 1, 0, '', '', 31, 50, 1447639935, 0, 1, 3),
(34, 'Plug/plug_linktype_list', '所属栏目', 1, 1, 0, '', '', 31, 50, 1447640839, 0, 1, 3),
(43, 'Sys/source', '来源管理', 1, 1, 0, '', '', 2, 50, 1448940532, 1, 1, 3),
(105, 'Sys/runsys', '操作-保存', 1, 1, 0, '', '', 6, 50, 1461036331, 1, 0, 4),
(108, 'Sys/admin_rule_add', '操作-添加', 1, 1, 0, '', '', 18, 0, 1461550835, 1, 0, 4),
(109, 'Sys/admin_rule_state', '操作-状态', 1, 1, 0, '', '', 18, 5, 1461550949, 1, 0, 4),
(110, 'Sys/admin_rule_tz', '操作-验证', 1, 1, 0, '', '', 18, 6, 1461551129, 1, 0, 4),
(111, 'Sys/ruleorder', '操作-排序', 1, 1, 0, '', '', 18, 7, 1461551263, 1, 0, 4),
(112, 'Sys/admin_rule_del', '操作-删除', 1, 1, 0, '', '', 18, 4, 1461551536, 1, 0, 4),
(113, 'Sys/admin_rule_runedit', '操作-改存', 1, 1, 0, '', '', 18, 3, 1461551855, 1, 0, 4),
(114, 'Sys/admin_rule_edit', '操作-修改', 1, 1, 0, '', '', 18, 2, 1461551913, 1, 0, 4),
(115, 'Sys/admin_group_runadd', '操作-添存', 1, 1, 0, '', '', 17, 2, 1461552280, 1, 0, 4),
(116, 'Sys/admin_group_edit', '操作-修改', 1, 1, 0, '', '', 17, 3, 1461552326, 1, 0, 4),
(117, 'Sys/admin_group_del', '操作-删除', 1, 1, 0, '', '', 17, 30, 1461552349, 1, 0, 4),
(118, 'Sys/admin_group_access', '操作-权限', 1, 1, 0, '', '', 17, 40, 1461552404, 1, 0, 4),
(119, 'Sys/admin_list_add', '操作-添加', 1, 1, 0, '', '', 16, 0, 1461553162, 1, 0, 4),
(120, 'Sys/admin_list_edit', '操作-修改', 1, 1, 0, '', '', 16, 2, 1461554130, 1, 0, 4),
(121, 'Sys/admin_list_del', '操作-删除', 1, 1, 0, '', '', 16, 4, 1461554152, 1, 0, 4),
(122, 'Sys/source_runadd', '操作-添加', 1, 1, 0, '', '', 43, 10, 1461036331, 1, 0, 4),
(123, 'Sys/source_order', '操作-排序', 1, 1, 0, '', '', 43, 50, 1461037680, 1, 0, 4),
(124, 'Sys/source_runedit', '操作-改存', 1, 1, 0, '', '', 43, 30, 1461039346, 1, 0, 4),
(125, 'Sys/source_del', '操作-删除', 1, 1, 0, '', '', 43, 40, 146103934, 1, 0, 4),
(126, 'Sys/export', '操作-备份', 1, 1, 0, '', '', 5, 1, 1461550835, 1, 0, 4),
(127, 'Sys/optimize', '操作-优化', 1, 1, 0, '', '', 5, 1, 1461550835, 1, 0, 4),
(128, 'Sys/repair', '操作-修复', 1, 1, 0, '', '', 5, 1, 1461550835, 1, 0, 4),
(129, 'Sys/del', '操作-删除', 1, 1, 0, '', '', 4, 1, 1461550835, 1, 0, 4),
(130, 'Sys/bxgs_state', '操作-状态', 1, 1, 0, '', '', 67, 5, 1461550835, 1, 0, 4),
(131, 'Sys/bxgs_edit', '操作-修改', 1, 1, 0, '', '', 67, 1, 1461550835, 1, 0, 4),
(132, 'Sys/bxgs_runedit', '操作-改存', 1, 1, 0, '', '', 67, 2, 1461550835, 1, 0, 4),
(135, 'News/news_list_state', '操作-状态', 1, 1, 0, '', '', 11, 4, 1461550835, 1, 0, 4),
(134, 'Sys/myinfo_runedit', '个人资料修改', 1, 1, 0, '', '', 68, 1, 1461550835, 1, 0, 4),
(136, 'News/news_list_edit', '操作-修改', 1, 1, 0, '', '', 11, 0, 1461550835, 1, 0, 4),
(137, 'News/news_list_del', '操作-删除', 1, 1, 0, '', '', 11, 2, 1461550835, 1, 0, 4),
(138, 'News/news_list_alldel', '操作-批删', 1, 1, 0, '', '', 11, 3, 1461550835, 1, 0, 4),
(139, 'News/news_runadd', '操作-保存', 1, 1, 0, '', '', 12, 1, 1461550835, 1, 0, 4),
(140, 'News/news_back_open', '操作-还原', 1, 1, 0, '', '', 25, 1, 1461550835, 1, 0, 4),
(141, 'News/news_back_del', '操作-彻删', 1, 1, 0, '', '', 25, 1, 1461550835, 1, 0, 4),
(142, 'News/news_back_alldel', '操作-批删', 1, 1, 0, '', '', 25, 1, 1461550835, 1, 0, 4),
(155, 'News/leftnavorder', '操作-排序', 1, 1, 0, '', '', 13, 5, 1461550835, 1, 0, 4),
(147, 'Sys/admin_group_runadd', '操作-添存', 1, 1, 0, '', '', 17, 50, 1461812136, NULL, 0, 4),
(144, 'Sys/admin_list_runadd', '操作-添存', 1, 1, 0, '', '', 16, 1, 1461550835, 1, 0, 4),
(145, 'Sys/admin_list_state', '操作-状态', 1, 1, 0, '', '', 16, 5, 1461550835, 1, 0, 4),
(146, 'Sys/admin_list_runedit', '操作-改存', 1, 1, 0, '', '', 16, 3, 1461550835, 1, 0, 4),
(148, 'Sys/admin_group_add', '操作-添加', 1, 1, 0, '', '', 17, 50, 1461812245, NULL, 0, 4),
(149, 'Sys/admin_group_add', '操作-添加', 1, 1, 0, '', '', 17, 1, 1461550835, 1, 0, 4),
(150, 'Sys/admin_group_runedit', '操作-改存', 1, 1, 0, '', '', 17, 4, 1461550835, 1, 0, 4),
(151, 'Sys/admin_group_runaccess', '操作-权存', 1, 1, 0, '', '', 17, 50, 1461550835, 1, 0, 4),
(152, 'Sys/admin_rule_add', '操作-添存', 1, 1, 0, '', '', 18, 1, 1461550835, 1, 0, 4),
(153, 'Sys/bxgs_runadd', '操作-添存', 1, 1, 0, '', '', 66, 1, 1461550835, 1, 0, 4),
(154, 'News/news_runedit', '操作-改存', 1, 1, 0, '', '', 11, 1, 1461550835, 1, 0, 4),
(156, 'News/runnews_columnadd', '操作-添存', 1, 1, 0, '', '', 14, 1, 1461550835, 1, 0, 4),
(157, 'News/news_columnedit', '操作-修改', 1, 1, 0, '', '', 13, 1, 1461550835, 1, 0, 4),
(158, 'News/runnews_columnedit', '操作-改存', 1, 1, 0, '', '', 13, 2, 1461550835, 1, 0, 4),
(159, 'News/news_columndel', '操作-删除', 1, 1, 0, '', '', 13, 3, 1461550835, 1, 0, 4),
(160, 'News/column_state', '操作-状态', 1, 1, 0, '', '', 13, 4, 1461550835, 1, 0, 4),
(180, 'Sys/source_edit', '操作-修改', 1, 1, 0, '', '', 43, 20, 1461832933, 1, 0, 4),
(181, 'Sys/admin_group_state', '操作-状态', 1, 1, 0, '', '', 17, 50, 1461834340, 1, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mr_column`
--

CREATE TABLE `mr_column` (
  `c_id` int(20) UNSIGNED NOT NULL,
  `column_name` varchar(36) NOT NULL,
  `column_enname` varchar(50) DEFAULT NULL COMMENT '英文标题',
  `column_type` int(8) NOT NULL,
  `column_leftid` tinyint(3) NOT NULL,
  `column_address` varchar(70) NOT NULL,
  `column_open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否开启',
  `column_order` int(7) NOT NULL,
  `column_title` varchar(36) NOT NULL,
  `column_key` varchar(200) NOT NULL,
  `column_des` varchar(200) NOT NULL,
  `column_content` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_column`
--

INSERT INTO `mr_column` (`c_id`, `column_name`, `column_enname`, `column_type`, `column_leftid`, `column_address`, `column_open`, `column_order`, `column_title`, `column_key`, `column_des`, `column_content`) VALUES
(1, '通知公告', '', 1, 0, '', 1, 50, '', '', '', ''),
(2, '其它', NULL, 3, 1, '', 1, 50, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mr_diyflag`
--

CREATE TABLE `mr_diyflag` (
  `diyflag_id` int(2) NOT NULL COMMENT 'ID',
  `diyflag_value` char(2) NOT NULL COMMENT '值',
  `diyflag_name` char(10) NOT NULL COMMENT '名称',
  `diyflag_order` int(11) NOT NULL COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_diyflag`
--

INSERT INTO `mr_diyflag` (`diyflag_id`, `diyflag_value`, `diyflag_name`, `diyflag_order`) VALUES
(1, 'h', '头条', 10),
(2, 'c', '推荐', 20),
(3, 'f', '幻灯', 30),
(4, 'a', '特荐', 40),
(5, 's', '滚动', 50),
(6, 'p', '图片', 60),
(7, 'j', '跳转', 70),
(8, 'd', '原创', 80);

-- --------------------------------------------------------

--
-- Table structure for table `mr_member_list`
--

CREATE TABLE `mr_member_list` (
  `member_list_id` int(11) NOT NULL,
  `member_list_username` varchar(30) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `member_list_pwd` char(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `member_list_petname` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `member_list_province` int(6) NOT NULL DEFAULT '2' COMMENT '城市',
  `member_list_city` int(6) NOT NULL DEFAULT '0' COMMENT '市县',
  `member_list_town` int(6) NOT NULL DEFAULT '0' COMMENT '乡镇',
  `member_list_sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=男  2=女',
  `member_list_headpic` varchar(100) DEFAULT NULL COMMENT '会员头像路径',
  `member_list_tel` varchar(20) DEFAULT NULL COMMENT '手机',
  `member_list_email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `member_list_open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `member_mdemail` varchar(32) DEFAULT NULL,
  `member_list_addtime` int(11) NOT NULL COMMENT '添加时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_member_list`
--

INSERT INTO `mr_member_list` (`member_list_id`, `member_list_username`, `member_list_pwd`, `member_list_petname`, `member_list_province`, `member_list_city`, `member_list_town`, `member_list_sex`, `member_list_headpic`, `member_list_tel`, `member_list_email`, `member_list_open`, `member_mdemail`, `member_list_addtime`) VALUES
(2, 'student', 'e10adc3949ba59abbe56e057f20f883e', 'student67', 6, 76, 693, 1, '', '18819489689', '1023102176@qq.com', 1, 'a23d7644f3711d1560d695882db313f2', 1467995903),
(3, 'student2', 'e10adc3949ba59abbe56e057f20f883e', 'student2', 2, 0, 0, 0, NULL, NULL, '815510586@qq.com', 1, '9354f456611c691db02caf3018b064cc', 1484404110);

-- --------------------------------------------------------

--
-- Table structure for table `mr_news`
--

CREATE TABLE `mr_news` (
  `n_id` int(36) NOT NULL,
  `news_title` varchar(255) NOT NULL COMMENT '文章标题',
  `news_titleshort` varchar(100) DEFAULT NULL COMMENT '简短标题',
  `news_columnid` int(11) NOT NULL,
  `news_columnviceid` int(11) DEFAULT NULL COMMENT '副栏目ID',
  `news_key` varchar(100) NOT NULL COMMENT '文章关键字',
  `news_tag` varchar(50) NOT NULL DEFAULT '' COMMENT '文章标签',
  `news_auto` varchar(20) NOT NULL COMMENT '作者',
  `news_adminid` int(11) NOT NULL COMMENT '所属管理员',
  `news_source` varchar(20) NOT NULL DEFAULT '未知' COMMENT '来源',
  `news_content` longtext NOT NULL COMMENT '新闻内容',
  `news_scontent` varchar(100) NOT NULL DEFAULT '',
  `news_hits` int(11) NOT NULL DEFAULT '200' COMMENT '点击率',
  `news_img` varchar(100) DEFAULT '' COMMENT '大图地址',
  `news_pic_type` tinyint(2) NOT NULL COMMENT '1=普通模式 2=腾讯模式',
  `news_pic_allurl` varchar(255) DEFAULT '' COMMENT '多图路径',
  `news_pic_content` longtext NOT NULL COMMENT '多图对应文字说明',
  `news_time` int(11) NOT NULL,
  `news_flag` set('h','c','f','a','s','p','j','d') NOT NULL DEFAULT '' COMMENT '文章属性',
  `news_zaddress` varchar(100) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `news_back` int(2) NOT NULL DEFAULT '0' COMMENT '是否为回收站',
  `news_open` varchar(2) DEFAULT '0' COMMENT '0代表审核不通过 1代表审核通过',
  `news_lvtype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '旅游类型1=行程 2=攻略'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mr_news_content`
--

CREATE TABLE `mr_news_content` (
  `news_content_id` int(11) NOT NULL,
  `news_content_nid` int(11) NOT NULL COMMENT '对应文章ID',
  `news_content_body` longtext NOT NULL COMMENT '内容主体'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mr_plug_link`
--

CREATE TABLE `mr_plug_link` (
  `plug_link_id` int(5) NOT NULL,
  `plug_link_name` varchar(50) NOT NULL COMMENT '链接名称',
  `plug_link_url` varchar(200) NOT NULL COMMENT '链接URL',
  `plug_link_typeid` tinyint(4) DEFAULT NULL COMMENT '所属栏目ID',
  `plug_link_qq` varchar(20) NOT NULL COMMENT '联系QQ',
  `plug_link_order` varchar(10) NOT NULL DEFAULT '50' COMMENT '排序',
  `plug_link_addtime` int(11) NOT NULL COMMENT '添加时间',
  `plug_link_open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0禁用1启用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_plug_link`
--

INSERT INTO `mr_plug_link` (`plug_link_id`, `plug_link_name`, `plug_link_url`, `plug_link_typeid`, `plug_link_qq`, `plug_link_order`, `plug_link_addtime`, `plug_link_open`) VALUES
(1, '广大华软', 'http://www.sise.com.cn', 1, '', '50', 1484142174, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mr_plug_linktype`
--

CREATE TABLE `mr_plug_linktype` (
  `plug_linktype_id` tinyint(4) NOT NULL,
  `plug_linktype_name` varchar(30) NOT NULL COMMENT '所属栏目名称',
  `plug_linktype_order` varchar(10) NOT NULL COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_plug_linktype`
--

INSERT INTO `mr_plug_linktype` (`plug_linktype_id`, `plug_linktype_name`, `plug_linktype_order`) VALUES
(1, '外链', '50');

-- --------------------------------------------------------

--
-- Table structure for table `mr_source`
--

CREATE TABLE `mr_source` (
  `source_id` tinyint(5) NOT NULL,
  `source_name` varchar(30) NOT NULL,
  `source_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_source`
--

INSERT INTO `mr_source` (`source_id`, `source_name`, `source_order`) VALUES
(1, '本站原创', 50),
(2, '转载', 50),
(3, 'slackck', 50);

-- --------------------------------------------------------

--
-- Table structure for table `mr_sys`
--

CREATE TABLE `mr_sys` (
  `sys_id` int(36) UNSIGNED NOT NULL,
  `sys_name` char(36) NOT NULL DEFAULT '',
  `sys_url` varchar(36) NOT NULL DEFAULT '',
  `sys_title` varchar(200) NOT NULL,
  `sys_key` varchar(200) NOT NULL,
  `sys_des` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mr_sys`
--

INSERT INTO `mr_sys` (`sys_id`, `sys_name`, `sys_url`, `sys_title`, `sys_key`, `sys_des`) VALUES
(1, '数炼成精', 'http://www.maths-video.org.cn/', '数炼成精视频教学网', '数炼成精,大数据,数据分析,视频教学', '数炼成精视频教学网');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mr_admin`
--
ALTER TABLE `mr_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_username` (`admin_username`);

--
-- Indexes for table `mr_auth_group`
--
ALTER TABLE `mr_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mr_auth_group_access`
--
ALTER TABLE `mr_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `mr_auth_rule`
--
ALTER TABLE `mr_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mr_column`
--
ALTER TABLE `mr_column`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `mr_diyflag`
--
ALTER TABLE `mr_diyflag`
  ADD PRIMARY KEY (`diyflag_id`);

--
-- Indexes for table `mr_member_list`
--
ALTER TABLE `mr_member_list`
  ADD PRIMARY KEY (`member_list_id`);

--
-- Indexes for table `mr_news`
--
ALTER TABLE `mr_news`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `news_titleshort` (`news_titleshort`),
  ADD KEY `news_title` (`news_title`),
  ADD KEY `news_columnid` (`news_columnid`);

--
-- Indexes for table `mr_news_content`
--
ALTER TABLE `mr_news_content`
  ADD PRIMARY KEY (`news_content_id`);

--
-- Indexes for table `mr_plug_link`
--
ALTER TABLE `mr_plug_link`
  ADD PRIMARY KEY (`plug_link_id`);

--
-- Indexes for table `mr_plug_linktype`
--
ALTER TABLE `mr_plug_linktype`
  ADD PRIMARY KEY (`plug_linktype_id`);

--
-- Indexes for table `mr_source`
--
ALTER TABLE `mr_source`
  ADD PRIMARY KEY (`source_id`);

--
-- Indexes for table `mr_sys`
--
ALTER TABLE `mr_sys`
  ADD PRIMARY KEY (`sys_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mr_admin`
--
ALTER TABLE `mr_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mr_auth_group`
--
ALTER TABLE `mr_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mr_auth_rule`
--
ALTER TABLE `mr_auth_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `mr_column`
--
ALTER TABLE `mr_column`
  MODIFY `c_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mr_diyflag`
--
ALTER TABLE `mr_diyflag`
  MODIFY `diyflag_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mr_member_list`
--
ALTER TABLE `mr_member_list`
  MODIFY `member_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mr_news`
--
ALTER TABLE `mr_news`
  MODIFY `n_id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mr_news_content`
--
ALTER TABLE `mr_news_content`
  MODIFY `news_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mr_plug_link`
--
ALTER TABLE `mr_plug_link`
  MODIFY `plug_link_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mr_plug_linktype`
--
ALTER TABLE `mr_plug_linktype`
  MODIFY `plug_linktype_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mr_source`
--
ALTER TABLE `mr_source`
  MODIFY `source_id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
