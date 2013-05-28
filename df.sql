/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50135
Source Host           : localhost:3306
Source Database       : df

Target Server Type    : MYSQL
Target Server Version : 50135
File Encoding         : 65001

Date: 2013-05-28 11:01:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `exam_options`
-- ----------------------------
DROP TABLE IF EXISTS `exam_options`;
CREATE TABLE `exam_options` (
  `id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) DEFAULT NULL,
  `options_item` char(250) DEFAULT NULL,
  `options_choose` int(11) DEFAULT NULL,
  `options_order` int(11) DEFAULT NULL,
  `options_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_options
-- ----------------------------

-- ----------------------------
-- Table structure for `exam_paper`
-- ----------------------------
DROP TABLE IF EXISTS `exam_paper`;
CREATE TABLE `exam_paper` (
  `id` int(11) NOT NULL DEFAULT '0',
  `node_id` int(11) NOT NULL,
  `paper_title` varchar(100) DEFAULT NULL,
  `paper_description` varchar(250) DEFAULT NULL,
  `paper_clicks` int(11) DEFAULT NULL,
  `paper_show` int(11) DEFAULT NULL,
  `paper_mode` int(11) DEFAULT NULL,
  `paper_type` int(11) DEFAULT NULL,
  `paper_user` char(21) DEFAULT NULL,
  `paper_order` int(11) DEFAULT NULL,
  `paper_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_paper
-- ----------------------------

-- ----------------------------
-- Table structure for `exam_paper_topic`
-- ----------------------------
DROP TABLE IF EXISTS `exam_paper_topic`;
CREATE TABLE `exam_paper_topic` (
  `paper_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `topic_score` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  KEY `fk_exam_paper_topic_exam_topic_1` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_paper_topic
-- ----------------------------

-- ----------------------------
-- Table structure for `exam_sort`
-- ----------------------------
DROP TABLE IF EXISTS `exam_sort`;
CREATE TABLE `exam_sort` (
  `id` int(11) DEFAULT NULL,
  `sort_title` varchar(50) DEFAULT NULL,
  `sort_description` varchar(250) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `sort_time` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_sort
-- ----------------------------

-- ----------------------------
-- Table structure for `exam_topic`
-- ----------------------------
DROP TABLE IF EXISTS `exam_topic`;
CREATE TABLE `exam_topic` (
  `id` int(11) NOT NULL DEFAULT '0',
  `topic_type` int(11) DEFAULT NULL,
  `topic_title` varchar(250) DEFAULT NULL,
  `topic_resolve` varchar(250) DEFAULT NULL,
  `topic_answer` varchar(100) DEFAULT NULL,
  `topic_score` int(11) DEFAULT NULL,
  `topic_clicks` int(11) DEFAULT NULL,
  `topic_xueduan` int(11) DEFAULT NULL,
  `topic_grade` int(11) DEFAULT NULL,
  `topic_subject` int(11) DEFAULT NULL,
  `topic_edition` int(11) DEFAULT NULL,
  `topic_special` int(11) DEFAULT NULL,
  `topic_label` varchar(100) DEFAULT NULL,
  `topic_user` char(21) DEFAULT NULL,
  `topic_show` int(1) DEFAULT NULL,
  `topic_order` int(11) DEFAULT NULL,
  `topic_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exam_topic_exam_sort_1` (`topic_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_topic
-- ----------------------------

-- ----------------------------
-- Table structure for `exam_video`
-- ----------------------------
DROP TABLE IF EXISTS `exam_video`;
CREATE TABLE `exam_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `video_title` varchar(100) DEFAULT NULL,
  `video_description` varchar(250) DEFAULT NULL,
  `video_playtime` char(20) DEFAULT NULL,
  `video_key` varchar(50) DEFAULT NULL,
  `video_ori_size` bigint(20) DEFAULT NULL,
  `video_url` char(100) DEFAULT NULL,
  `video_size` varchar(20) DEFAULT NULL,
  `video_plays` int(11) DEFAULT NULL,
  `video_user` char(21) DEFAULT NULL,
  `video_time` int(10) DEFAULT NULL,
  `video_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_video
-- ----------------------------

-- ----------------------------
-- Table structure for `knowledge_node`
-- ----------------------------
DROP TABLE IF EXISTS `knowledge_node`;
CREATE TABLE `knowledge_node` (
  `id` int(11) NOT NULL DEFAULT '0',
  `node_fid` int(11) DEFAULT NULL,
  `node_title` varchar(250) DEFAULT NULL,
  `node_xueduan` int(11) DEFAULT NULL,
  `node_grade` int(11) DEFAULT NULL,
  `node_subject` int(11) DEFAULT NULL,
  `node_edition` int(11) DEFAULT NULL,
  `node_special` int(11) DEFAULT NULL,
  `node_label` varchar(100) DEFAULT NULL,
  `node_user` char(21) DEFAULT NULL,
  `node_show` int(1) DEFAULT NULL,
  `node_order` int(11) DEFAULT NULL,
  `node_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_knowledge_node_node_base_1` (`node_grade`),
  KEY `fk_knowledge_node_node_base_2` (`node_subject`),
  KEY `fk_knowledge_node_node_base_3` (`node_edition`),
  KEY `fk_knowledge_node_node_base_4` (`node_special`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of knowledge_node
-- ----------------------------

-- ----------------------------
-- Table structure for `menu_info`
-- ----------------------------
DROP TABLE IF EXISTS `menu_info`;
CREATE TABLE `menu_info` (
  `menu_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '目录期号',
  `menu_name` varchar(50) NOT NULL DEFAULT '目录名',
  `menu_is_available` int(2) DEFAULT '1',
  `order_start_time` int(10) DEFAULT NULL COMMENT '开始征订时间点',
  `order_end_time` int(10) unsigned DEFAULT NULL COMMENT '学校征订结束时间结点',
  `modify_end_time` int(10) unsigned DEFAULT NULL COMMENT '学校开始补丁的时间',
  `check_end_time` int(10) unsigned DEFAULT NULL COMMENT '该期订单总的结束时间',
  `suppler_end_time` int(10) unsigned NOT NULL COMMENT '出版单位结束上传时间点',
  `menu_year` int(6) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu_info
-- ----------------------------
INSERT INTO `menu_info` VALUES ('1', '2012年秋季第一学期同步练习册', '1', '1346428800', '1377964800', '1380643200', '1380729600', '1346882400', '201202');
INSERT INTO `menu_info` VALUES ('24', '2012年第2期征订——寒暑假作业', '1', '1345996800', '1346601600', '1346688000', '1349280000', '1353196800', null);
INSERT INTO `menu_info` VALUES ('25', '第三期征订', '0', '1345996800', '1346428800', '1346515200', '1349280000', '0', null);

-- ----------------------------
-- Table structure for `node_base`
-- ----------------------------
DROP TABLE IF EXISTS `node_base`;
CREATE TABLE `node_base` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `base_fid` int(11) DEFAULT '0',
  `base_title` varchar(100) DEFAULT NULL,
  `base_order` int(11) DEFAULT NULL,
  `base_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node_base
-- ----------------------------
INSERT INTO `node_base` VALUES ('1', '0', '学段', '1', null);
INSERT INTO `node_base` VALUES ('2', '0', '科目', '2', null);
INSERT INTO `node_base` VALUES ('3', '0', '年级', '3', null);
INSERT INTO `node_base` VALUES ('4', '0', '教材版本', '4', null);
INSERT INTO `node_base` VALUES ('5', '0', '专题 ', '5', null);
INSERT INTO `node_base` VALUES ('6', '1', '小学', '1', null);
INSERT INTO `node_base` VALUES ('7', '1', '初中', '2', null);
INSERT INTO `node_base` VALUES ('8', '1', '高中', '3', null);
INSERT INTO `node_base` VALUES ('9', '2', '语文', '3', null);
INSERT INTO `node_base` VALUES ('10', '2', '数学', '1', null);
INSERT INTO `node_base` VALUES ('11', '2', '外语', '2', null);
INSERT INTO `node_base` VALUES ('12', '2', '历史', '3', null);
INSERT INTO `node_base` VALUES ('13', '2', '地理', '4', null);
INSERT INTO `node_base` VALUES ('14', '2', '科学', '5', null);
INSERT INTO `node_base` VALUES ('15', '2', '政治', '6', null);
INSERT INTO `node_base` VALUES ('19', '3', '一年级', '0', null);
INSERT INTO `node_base` VALUES ('18', '2', '生物', '7', null);
INSERT INTO `node_base` VALUES ('17', '2', '化学', '8', null);
INSERT INTO `node_base` VALUES ('16', '2', '物理', '9', null);
INSERT INTO `node_base` VALUES ('20', '3', '二年级', '0', null);
INSERT INTO `node_base` VALUES ('21', '3', '三年级', '0', null);
INSERT INTO `node_base` VALUES ('22', '3', '四年级', '0', null);
INSERT INTO `node_base` VALUES ('23', '3', '五年级', '0', null);
INSERT INTO `node_base` VALUES ('32', '5', '23', '23', null);
INSERT INTO `node_base` VALUES ('25', '4', '人教版', '0', null);
INSERT INTO `node_base` VALUES ('26', '5', '小学奥数', '0', null);
INSERT INTO `node_base` VALUES ('27', '5', '初中新概念', '2', null);
INSERT INTO `node_base` VALUES ('30', '5', '中国梦', '1', null);

-- ----------------------------
-- Table structure for `node_exam`
-- ----------------------------
DROP TABLE IF EXISTS `node_exam`;
CREATE TABLE `node_exam` (
  `id` int(11) DEFAULT NULL,
  `node_id` int(11) DEFAULT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `exam_score` double DEFAULT NULL,
  `exam_ranking` int(11) DEFAULT NULL,
  `exam_user` varchar(255) DEFAULT NULL,
  `exam_time` char(20) DEFAULT NULL,
  KEY `fk_node_exam_node_exam_answer_1` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node_exam
-- ----------------------------

-- ----------------------------
-- Table structure for `node_exam_answer`
-- ----------------------------
DROP TABLE IF EXISTS `node_exam_answer`;
CREATE TABLE `node_exam_answer` (
  `exam_id` int(11) DEFAULT NULL,
  `node_id` int(11) DEFAULT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `exam_answer` double DEFAULT NULL,
  `exam_correct` int(11) DEFAULT NULL,
  `exam_score` int(11) DEFAULT NULL,
  `exam_user` varchar(255) DEFAULT NULL,
  `exam_time` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node_exam_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_group`
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_fid` int(5) DEFAULT NULL,
  `group_name` char(50) DEFAULT NULL,
  `group_description` varchar(150) DEFAULT NULL,
  `module_list` varchar(250) DEFAULT NULL,
  `group_isok` int(1) DEFAULT NULL,
  `group_order` int(5) DEFAULT NULL,
  `group_time` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_group
-- ----------------------------
INSERT INTO `sys_group` VALUES ('1', null, '系统管理员', null, null, '1', null, null);
INSERT INTO `sys_group` VALUES ('2', null, '课程老师', null, null, '1', null, null);

-- ----------------------------
-- Table structure for `sys_log`
-- ----------------------------
DROP TABLE IF EXISTS `sys_log`;
CREATE TABLE `sys_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_msg` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `module_controller` char(50) DEFAULT NULL,
  `module_action` char(50) DEFAULT NULL,
  `user_name` char(20) DEFAULT NULL,
  `uid` char(21) DEFAULT NULL,
  `log_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_log
-- ----------------------------
INSERT INTO `sys_log` VALUES ('8', '系统日志管理/清空日志/', null, 'Admin_Log', 'batDel', '张老师', '123', '1369119455');
INSERT INTO `sys_log` VALUES ('9', '教程管理/添加课程节点/中国梦', null, 'Admin_Node', 'add', '张老师', '123', '1369120475');
INSERT INTO `sys_log` VALUES ('13', '系统日志管理/删除日志/', null, 'Admin_Log', 'del', '张老师', '123', '1369709766');
INSERT INTO `sys_log` VALUES ('14', '教程管理/添加课程节点/23', null, 'Admin_Node', 'add', '张老师', '123', '1369709783');

-- ----------------------------
-- Table structure for `sys_module`
-- ----------------------------
DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE `sys_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_fid` int(11) DEFAULT NULL,
  `module_type` int(11) DEFAULT NULL,
  `module_title` char(50) DEFAULT NULL,
  `module_url` char(50) DEFAULT NULL,
  `module_controller` char(50) DEFAULT NULL,
  `module_action` char(50) DEFAULT NULL,
  `module_show` int(11) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  `module_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_module
-- ----------------------------
INSERT INTO `sys_module` VALUES ('1', '0', null, '课程管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('2', '0', null, '内容管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('3', '0', null, '用户管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('4', '0', null, '管理日志', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('5', '1', null, '基本设置', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('6', '5', null, '教程设置', null, 'Admin_Node', 'index', '1', null, null);
INSERT INTO `sys_module` VALUES ('7', '5', null, '知识点设置', null, 'Admin_Knowldge', 'index', '1', null, null);
INSERT INTO `sys_module` VALUES ('8', '4', null, '日志信息', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('9', '8', null, '台后日志', null, 'Admin_Log', 'index', '1', null, null);
INSERT INTO `sys_module` VALUES ('10', '3', null, '用户设置', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('11', '10', null, '用户管理', null, 'Admin_User', 'index', '1', null, null);
INSERT INTO `sys_module` VALUES ('12', '10', null, '角色管理', null, 'Admon_Role', 'index', '1', null, null);
INSERT INTO `sys_module` VALUES ('13', '2', null, '题库管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('14', '13', null, '内容设置', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('15', '13', null, '视频管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('16', '13', null, '测试管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('17', '13', null, '题目管理', null, null, null, '1', null, null);
INSERT INTO `sys_module` VALUES ('18', '13', null, 'pisa管理', null, null, null, '1', null, null);

-- ----------------------------
-- Table structure for `sys_purview`
-- ----------------------------
DROP TABLE IF EXISTS `sys_purview`;
CREATE TABLE `sys_purview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT '0',
  `module_id` int(11) DEFAULT NULL,
  `c` varchar(50) DEFAULT NULL,
  `a` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_purview
-- ----------------------------
INSERT INTO `sys_purview` VALUES ('1', '1', null, 'Admin_Index', 'Index');

-- ----------------------------
-- Table structure for `sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `group_id` int(11) DEFAULT NULL,
  `uid` char(21) DEFAULT NULL,
  `user_name` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_pass` char(30) CHARACTER SET utf8 DEFAULT NULL,
  `user_realname` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_school` char(21) CHARACTER SET utf8 DEFAULT NULL,
  `user_isok` int(1) DEFAULT NULL,
  `user_time` char(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', '1', null, null, null, null, null, '1', null);
