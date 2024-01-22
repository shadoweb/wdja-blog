SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `wdja_aboutus` (
  `abid` int NOT NULL AUTO_INCREMENT,
  `ab_topic` varchar(50) DEFAULT NULL,
  `ab_titles` varchar(250) DEFAULT NULL,
  `ab_keywords` varchar(252) DEFAULT NULL,
  `ab_description` varchar(252) DEFAULT NULL,
  `ab_image` varchar(255) DEFAULT NULL,
  `ab_content` text,
  `ab_content_atts_list` text,
  `ab_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ab_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ab_ucode` varchar(50) DEFAULT NULL,
  `ab_hidden` int DEFAULT '0',
  `ab_good` int DEFAULT '0',
  `ab_tpl` varchar(50) DEFAULT NULL,
  `ab_gourl` varchar(255) DEFAULT NULL,
  `ab_count` int DEFAULT '0',
  `ab_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`abid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_admin` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(50) DEFAULT NULL,
  `a_pword` varchar(50) DEFAULT NULL,
  `a_popedom` text,
  `a_lock` int DEFAULT '0',
  `a_lasttime` datetime DEFAULT '2021-08-01 08:00:00',
  `a_lastip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_admin_log` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `l_name` varchar(50) DEFAULT NULL,
  `l_time` datetime DEFAULT '2021-08-01 08:00:00',
  `l_ip` varchar(50) DEFAULT NULL,
  `l_islogin` int DEFAULT '0',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_article` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `a_topic` varchar(252) DEFAULT NULL,
  `a_titles` varchar(250) DEFAULT NULL,
  `a_keywords` varchar(252) DEFAULT NULL,
  `a_description` varchar(252) DEFAULT NULL,
  `a_image` varchar(255) DEFAULT NULL,
  `a_content` text,
  `a_content_atts_list` text,
  `a_time` datetime DEFAULT '2021-08-01 08:00:00',
  `a_update` datetime DEFAULT '2021-08-01 08:00:00',
  `a_cls` text,
  `a_class` int DEFAULT '0',
  `a_class_list` varchar(50) DEFAULT '0',
  `a_ucode` varchar(50) DEFAULT NULL,
  `a_utid` varchar(50) DEFAULT '0',
  `a_author` int DEFAULT '0',
  `a_auid` int DEFAULT '0',
  `a_hidden` int DEFAULT '0',
  `a_good` int DEFAULT '0',
  `a_count` int DEFAULT '0',
  `a_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_book` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `b_topic` varchar(252) DEFAULT NULL,
  `b_titles` varchar(250) DEFAULT NULL,
  `b_keywords` varchar(252) DEFAULT NULL,
  `b_description` varchar(252) DEFAULT NULL,
  `b_image` varchar(255) DEFAULT NULL,
  `b_content` text,
  `b_content_atts_list` text,
  `b_time` datetime DEFAULT '2021-08-01 08:00:00',
  `b_update` datetime DEFAULT '2021-08-01 08:00:00',
  `b_cls` text,
  `b_class` int DEFAULT '0',
  `b_class_list` varchar(50) DEFAULT '0',
  `b_ucode` varchar(50) DEFAULT NULL,
  `b_utid` varchar(50) DEFAULT '0',
  `b_author` int DEFAULT '0',
  `b_auid` int DEFAULT '0',
  `b_hidden` int DEFAULT '0',
  `b_good` int DEFAULT '0',
  `b_count` int DEFAULT '0',
  `b_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_book_chapter` (
  `bcid` int NOT NULL AUTO_INCREMENT,
  `bc_topic` varchar(252) DEFAULT NULL,
  `bc_titles` varchar(250) DEFAULT NULL,
  `bc_keywords` varchar(252) DEFAULT NULL,
  `bc_description` varchar(252) DEFAULT NULL,
  `bc_image` varchar(255) DEFAULT NULL,
  `bc_content` text,
  `bc_content_atts_list` text,
  `bc_time` datetime DEFAULT '2021-08-01 08:00:00',
  `bc_update` datetime DEFAULT '2021-08-01 08:00:00',
  `bc_book_id` varchar(50) DEFAULT '0',
  `bc_ucode` varchar(50) DEFAULT NULL,
  `bc_author` int DEFAULT '0',
  `bc_auid` int DEFAULT '0',
  `bc_hidden` int DEFAULT '0',
  `bc_good` int DEFAULT '0',
  `bc_count` int DEFAULT '0',
  `bc_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bcid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_book_section` (
  `bsid` int NOT NULL AUTO_INCREMENT,
  `bs_topic` varchar(252) DEFAULT NULL,
  `bs_titles` varchar(250) DEFAULT NULL,
  `bs_keywords` varchar(252) DEFAULT NULL,
  `bs_description` varchar(252) DEFAULT NULL,
  `bs_image` varchar(255) DEFAULT NULL,
  `bs_video` varchar(255) DEFAULT NULL,
  `bs_content` text,
  `bs_content_atts_list` text,
  `bs_time` datetime DEFAULT '2021-08-01 08:00:00',
  `bs_update` datetime DEFAULT '2021-08-01 08:00:00',
  `bs_book_id` varchar(50) DEFAULT '0',
  `bs_ischapter` int DEFAULT '1',
  `bs_chapter_id` varchar(50) DEFAULT '0',
  `bs_ucode` varchar(50) DEFAULT NULL,
  `bs_author` int DEFAULT '0',
  `bs_auid` int DEFAULT '0',
  `bs_hidden` int DEFAULT '0',
  `bs_good` int DEFAULT '0',
  `bs_tpl` varchar(50) DEFAULT NULL,
  `bs_gourl` varchar(255) DEFAULT NULL,
  `bs_count` int DEFAULT '0',
  `bs_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_pages` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `p_topic` varchar(252) DEFAULT NULL,
  `p_titles` varchar(250) DEFAULT NULL,
  `p_keywords` varchar(252) DEFAULT NULL,
  `p_description` varchar(252) DEFAULT NULL,
  `p_fid` varchar(50) DEFAULT '0',
  `p_fsid` int DEFAULT '0',
  `p_type` int DEFAULT '0',
  `p_image` varchar(255) DEFAULT NULL,
  `p_content` text,
  `p_content_atts_list` text,
  `p_time` datetime DEFAULT '2021-08-01 08:00:00',
  `p_update` datetime DEFAULT '2021-08-01 08:00:00',
  `p_ucode` varchar(50) DEFAULT NULL,
  `p_hidden` int DEFAULT '0',
  `p_good` int DEFAULT '0',
  `p_count` int DEFAULT '0',
  `p_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_check` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `c_url` varchar(255) DEFAULT NULL,
  `c_genre` varchar(50) DEFAULT NULL,
  `c_gid` varchar(50) DEFAULT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `c_ip` varchar(50) DEFAULT NULL,
  `c_sex` int DEFAULT '0',
  `c_mobile` varchar(50) DEFAULT '0',
  `c_email` varchar(50) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `c_title` varchar(252) DEFAULT NULL,
  `c_content` text,
  `c_time` datetime DEFAULT '2021-08-01 08:00:00',
  `c_reply` text,
  `c_replytime` datetime DEFAULT '2021-08-01 08:00:00',
  `c_hidden` int DEFAULT '0',
  `c_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `f_genre` varchar(50) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `f_topic` varchar(50) DEFAULT NULL,
  `f_type` int DEFAULT '0',
  `f_count` varchar(9) DEFAULT '0',
  `f_hidden` int DEFAULT '0',
  `f_hidden_list` int DEFAULT '0',
  `f_hidden_detail` int DEFAULT '0',
  `f_time` date DEFAULT '2021-08-01',
  `f_update` datetime DEFAULT '2021-08-01 08:00:00',
  `f_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields_data` (
  `fdid` int NOT NULL AUTO_INCREMENT,
  `fd_topic` varchar(50) DEFAULT NULL,
  `fd_fid` int DEFAULT '0',
  `fd_oid` int DEFAULT '0',
  `fd_ooid` int DEFAULT '0',
  PRIMARY KEY (`fdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_fields_gid` (
  `fgid` int NOT NULL AUTO_INCREMENT,
  `fg_fid` int DEFAULT '0',
  `fg_gid` varchar(50) DEFAULT NULL,
  `fg_data` text,
  `fg_time` datetime DEFAULT '2021-08-01 08:00:00',
  `fg_update` datetime DEFAULT '2021-08-01 08:00:00',
  PRIMARY KEY (`fgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_iplock` (
  `ipid` int NOT NULL AUTO_INCREMENT,
  `ip_area` varchar(50) DEFAULT NULL,
  `ip_robots` varchar(25) DEFAULT NULL,
  `ip_ip` varchar(152) DEFAULT NULL,
  `ip_come` varchar(255) DEFAULT NULL,
  `ip_content` text,
  `ip_lock` int DEFAULT '0',
  `ip_out` int DEFAULT '0',
  `ip_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ip_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ip_count` int DEFAULT '0',
  `ip_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ipid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_label` (
  `elid` int NOT NULL AUTO_INCREMENT,
  `el_topic` varchar(50) DEFAULT NULL,
  `el_type` int DEFAULT '0',
  `el_images_tpl` varchar(50) DEFAULT NULL,
  `el_content` text,
  `el_content_atts_list` text,
  `el_inputs_type` varchar(50) DEFAULT 'text',
  `el_time` datetime DEFAULT '2021-08-01 08:00:00',
  `el_update` datetime DEFAULT '2021-08-01 08:00:00',
  `el_hidden` int DEFAULT '0',
  `el_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`elid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_expansion_timer` (
  `etid` int NOT NULL AUTO_INCREMENT,
  `et_topic` varchar(50) DEFAULT NULL,
  `et_genre` varchar(50) DEFAULT NULL COMMENT '模块',
  `et_gid` int DEFAULT '0' COMMENT '内容ID',
  `et_event` int DEFAULT '0' COMMENT '定时事件:发布,删除,上下架',
  `et_timer_switch` int DEFAULT '0' COMMENT '定时开关',
  `et_timer` datetime DEFAULT '2021-08-01 08:00:00' COMMENT '任务启动时间',
  `et_state` int DEFAULT '0' COMMENT '任务状态:中止,暂停,进行中,结束',
  `et_time` datetime DEFAULT '2021-08-01 08:00:00',
  `et_update` datetime DEFAULT '2021-08-01 08:00:00',
  `et_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`etid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_author` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `a_topic` varchar(50) DEFAULT NULL,
  `a_titles` varchar(250) DEFAULT NULL,
  `a_keywords` varchar(252) DEFAULT NULL,
  `a_description` varchar(252) DEFAULT NULL,
  `a_image` varchar(255) DEFAULT NULL,
  `a_content` text,
  `a_content_atts_list` text,
  `a_time` datetime DEFAULT '2021-08-01 08:00:00',
  `a_update` datetime DEFAULT '2021-08-01 08:00:00',
  `a_count` int DEFAULT '0',
  `a_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_idea` (
  `iid` int(11) NOT NULL,
  `i_ip` varchar(50) DEFAULT NULL,
  `i_title` varchar(252) DEFAULT NULL,
  `i_content` text,
  `i_time` datetime DEFAULT '2021-08-01 08:00:00',
  `i_hidden` int(11) DEFAULT '0',
  `i_token` varchar(255) NOT NULL,
  `i_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_message` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) DEFAULT NULL,
  `m_ip` varchar(50) DEFAULT NULL,
  `m_sex` int DEFAULT '0',
  `m_mobile` varchar(50) DEFAULT '0',
  `m_email` varchar(50) DEFAULT NULL,
  `m_address` varchar(255) DEFAULT NULL,
  `m_title` varchar(252) DEFAULT NULL,
  `m_content` text,
  `m_time` datetime DEFAULT '2021-08-01 08:00:00',
  `m_reply` text,
  `m_replytime` datetime DEFAULT '2021-08-01 08:00:00',
  `m_hidden` int DEFAULT '0',
  `m_token` varchar(255) NOT NULL,
  `m_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_music` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_topic` varchar(252) DEFAULT NULL,
  `m_titles` varchar(250) DEFAULT NULL,
  `m_keywords` varchar(252) DEFAULT NULL,
  `m_description` varchar(252) DEFAULT NULL,
  `m_image` varchar(255) DEFAULT NULL,
  `m_artist` varchar(50) DEFAULT NULL,
  `m_lrc` varchar(255) DEFAULT NULL,
  `m_file` varchar(255) DEFAULT NULL,
  `m_content` text,
  `m_content_atts_list` text,
  `m_time` datetime DEFAULT '2021-08-01 08:00:00',
  `m_update` datetime DEFAULT '2021-08-01 08:00:00',
  `m_cls` text,
  `m_class` int DEFAULT '0',
  `m_class_list` varchar(50) DEFAULT '0',
  `m_ucode` varchar(50) DEFAULT NULL,
  `m_utid` varchar(50) DEFAULT '0',
  `m_author` int DEFAULT '0',
  `m_auid` int DEFAULT '0',
  `m_hidden` int DEFAULT '0',
  `m_good` int DEFAULT '0',
  `m_count` int DEFAULT '0',
  `m_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_note` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `n_topic` varchar(50) DEFAULT NULL,
  `n_start` varchar(50) DEFAULT NULL,
  `n_end` varchar(50) DEFAULT NULL,
  `n_isallday` int DEFAULT '0',
  `n_isend` int DEFAULT '0',
  `n_titles` varchar(250) DEFAULT NULL,
  `n_keywords` varchar(252) DEFAULT NULL,
  `n_description` varchar(252) DEFAULT NULL,
  `n_image` varchar(255) DEFAULT NULL,
  `n_content` text,
  `n_content_atts_list` text,
  `n_time` datetime DEFAULT '2021-08-01 08:00:00',
  `n_update` datetime DEFAULT '2021-08-01 08:00:00',
  `n_ucode` varchar(50) DEFAULT NULL,
  `n_hidden` int DEFAULT '0',
  `n_good` int DEFAULT '0',
  `n_tpl` varchar(50) DEFAULT NULL,
  `n_gourl` varchar(255) DEFAULT NULL,
  `n_count` int DEFAULT '0',
  `n_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_picture` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `p_snum` varchar(50) DEFAULT NULL,
  `p_topic` varchar(252) DEFAULT NULL,
  `p_titles` varchar(250) DEFAULT NULL,
  `p_keywords` varchar(252) DEFAULT NULL,
  `p_description` varchar(252) DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `p_gallery` text,
  `p_infos` text,
  `p_content` text,
  `p_content_atts_list` text,
  `p_time` datetime DEFAULT '2021-08-01 08:00:00',
  `p_update` datetime DEFAULT '2021-08-01 08:00:00',
  `p_cls` text,
  `p_class` int DEFAULT '0',
  `p_class_list` varchar(50) DEFAULT '0',
  `p_ucode` varchar(50) DEFAULT NULL,
  `p_hidden` int DEFAULT '0',
  `p_good` int DEFAULT '0',
  `p_count` int DEFAULT '0',
  `p_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_search` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `s_topic` varchar(252) DEFAULT NULL,
  `s_ip` varchar(252) DEFAULT NULL,
  `s_content` varchar(252) DEFAULT NULL,
  `s_infos` text,
  `s_hidden` int DEFAULT '1',
  `s_update` datetime DEFAULT '2021-08-01 08:00:00',
  `s_time` datetime DEFAULT '2021-08-01 08:00:00',
  `s_count` int DEFAULT '0',
  `s_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_collect` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `c_url` varchar(255) DEFAULT NULL,
  `c_image` varchar(255) DEFAULT NULL,
  `c_title` varchar(255) DEFAULT NULL,
  `c_author` varchar(255) DEFAULT NULL,
  `c_content` varchar(255) DEFAULT NULL,
  `c_replace` varchar(255) DEFAULT NULL,
  `c_hidden` int DEFAULT '0',
  `c_time` datetime DEFAULT '2021-08-01 08:00:00',
  `c_update` datetime DEFAULT '2021-08-01 08:00:00',
  `c_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_linktext` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `l_topic` varchar(50) DEFAULT NULL,
  `l_url` varchar(255) DEFAULT NULL,
  `l_keyword` varchar(50) DEFAULT NULL,
  `l_intro` varchar(255) DEFAULT NULL,
  `l_hidden` int DEFAULT '0',
  `l_time` datetime DEFAULT '2021-08-01 08:00:00',
  `l_update` datetime DEFAULT '2021-08-01 08:00:00',
  `l_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_menu` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_pid` int DEFAULT '0',
  `m_topic` varchar(50) DEFAULT NULL,
  `m_title` varchar(50) DEFAULT NULL,
  `m_image` varchar(255) DEFAULT NULL,
  `m_alt` varchar(250) DEFAULT NULL,
  `m_fid` varchar(255) DEFAULT NULL,
  `m_fsid` int DEFAULT '0',
  `m_lid` int DEFAULT '0',
  `m_group` varchar(50) DEFAULT NULL,
  `m_hidden` int DEFAULT '0',
  `m_gourl` varchar(255) DEFAULT NULL,
  `m_order` int DEFAULT '0',
  `m_time` datetime DEFAULT '2021-08-01 08:00:00',
  `m_update` datetime DEFAULT '2021-08-01 08:00:00',
  `m_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_slide` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `s_topic` varchar(50) DEFAULT NULL,
  `s_url` varchar(255) DEFAULT NULL,
  `s_image` varchar(255) DEFAULT NULL,
  `s_intro` varchar(255) DEFAULT NULL,
  `s_order` int DEFAULT '0',
  `s_hidden` int DEFAULT '0',
  `s_time` datetime DEFAULT '2021-08-01 08:00:00',
  `s_update` datetime DEFAULT '2021-08-01 08:00:00',
  `s_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_support_sort` (
  `sortid` int NOT NULL AUTO_INCREMENT,
  `sort_pid` int DEFAULT '0',
  `sort_sort` varchar(50) DEFAULT NULL,
  `sort_titles` varchar(250) DEFAULT NULL,
  `sort_keywords` varchar(50) DEFAULT NULL,
  `sort_description` varchar(250) DEFAULT NULL,
  `sort_image` varchar(255) DEFAULT NULL,
  `sort_fid` varchar(255) DEFAULT NULL,
  `sort_fsid` int DEFAULT '0',
  `sort_lid` int DEFAULT '0',
  `sort_genre` varchar(50) DEFAULT NULL,
  `sort_hidden` int DEFAULT '0',
  `sort_gourl` varchar(255) DEFAULT NULL,
  `sort_tpl_list` varchar(50) DEFAULT NULL,
  `sort_tpl_detail` varchar(50) DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `sort_time` datetime DEFAULT '2021-08-01 08:00:00',
  `sort_update` datetime DEFAULT '2021-08-01 08:00:00',
  `sort_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sortid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_note` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `n_topic` varchar(50) DEFAULT NULL,
  `n_image` varchar(255) DEFAULT NULL,
  `n_content` text,
  `n_content_atts_list` text,
  `n_time` datetime DEFAULT '2021-08-01 08:00:00',
  `n_update` datetime DEFAULT '2021-08-01 08:00:00',
  `n_finish` int DEFAULT '0',
  `n_count` int DEFAULT '0',
  `n_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_related` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `r_genre` varchar(50) DEFAULT NULL,
  `r_gid` varchar(50) DEFAULT NULL,
  `r_source` varchar(25) DEFAULT NULL,
  `r_title` varchar(250) DEFAULT NULL,
  `r_sid` varchar(250) DEFAULT NULL,
  `r_time` datetime DEFAULT '2021-08-01 08:00:00',
  `r_update` datetime DEFAULT '2021-08-01 08:00:00',
  `r_lng` varchar(25) DEFAULT 'chinese',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_sys_upload` (
  `upid` int NOT NULL AUTO_INCREMENT,
  `up_genre` varchar(50) DEFAULT NULL,
  `up_upident` varchar(50) DEFAULT NULL,
  `up_filename` varchar(255) DEFAULT NULL,
  `up_field` varchar(50) DEFAULT NULL,
  `up_fid` int DEFAULT '0',
  `up_time` datetime DEFAULT '2021-08-01 08:00:00',
  `up_user` varchar(50) DEFAULT NULL,
  `up_valid` int DEFAULT '0',
  `up_voidreason` int DEFAULT '0',
  `up_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`upid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_tags` (
  `tid` int NOT NULL AUTO_INCREMENT,
  `t_topic` varchar(50) DEFAULT NULL,
  `t_titles` varchar(250) DEFAULT NULL,
  `t_keywords` varchar(152) DEFAULT NULL,
  `t_description` varchar(252) DEFAULT NULL,
  `t_image` varchar(255) DEFAULT NULL,
  `t_content` text,
  `t_content_atts_list` text,
  `t_time` datetime DEFAULT '2021-08-01 08:00:00',
  `t_update` datetime DEFAULT '2021-08-01 08:00:00',
  `t_hidden` int DEFAULT '0',
  `t_good` int DEFAULT '0',
  `t_gourl` varchar(255) DEFAULT NULL,
  `t_count` int DEFAULT '0',
  `t_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_tags_data` (
  `tdid` int NOT NULL AUTO_INCREMENT,
  `td_genre` varchar(50) NOT NULL,
  `td_gid` int DEFAULT '0',
  `td_tid` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`tdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_timetable` (
  `tid` int NOT NULL AUTO_INCREMENT,
  `t_topic` varchar(50) DEFAULT NULL,
  `t_type` varchar(50) DEFAULT NULL,
  `t_week` int DEFAULT '0',
  `t_day` int DEFAULT '0',
  `t_start_time` varchar(50) DEFAULT NULL,
  `t_end_time` varchar(50) DEFAULT NULL,
  `t_titles` varchar(250) DEFAULT NULL,
  `t_keywords` varchar(252) DEFAULT NULL,
  `t_description` varchar(252) DEFAULT NULL,
  `t_image` varchar(255) DEFAULT NULL,
  `t_content` text,
  `t_content_atts_list` text,
  `t_time` datetime NOT NULL DEFAULT '2021-08-01 08:00:00',
  `t_update` datetime NOT NULL DEFAULT '2021-08-01 08:00:00',
  `t_ucode` varchar(50) DEFAULT NULL,
  `t_hidden` int DEFAULT '0',
  `t_good` int DEFAULT '0',
  `t_tpl` varchar(50) DEFAULT NULL,
  `t_gourl` varchar(255) DEFAULT NULL,
  `t_count` int DEFAULT '0',
  `t_lng` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_user` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `u_username` varchar(50) DEFAULT NULL,
  `u_password` varchar(50) DEFAULT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `u_openid` varchar(255) DEFAULT NULL COMMENT '微信用户信息',
  `u_nickname` varchar(50) DEFAULT NULL COMMENT '微信用户信息',
  `u_headimgurl` varchar(255) DEFAULT NULL COMMENT '微信用户信息',
  `u_sex` varchar(50) DEFAULT NULL COMMENT '微信用户信息',
  `u_city` varchar(50) DEFAULT NULL COMMENT '微信用户信息',
  `u_province` varchar(255) DEFAULT NULL COMMENT '微信用户信息',
  `u_country` varchar(255) DEFAULT NULL COMMENT '微信用户信息',
  `u_language` varchar(50) DEFAULT NULL COMMENT '微信用户信息',
  `u_name` varchar(50) DEFAULT NULL,
  `u_qq` varchar(50) DEFAULT NULL,
  `u_phone` varchar(50) DEFAULT NULL,
  `u_address` varchar(255) DEFAULT NULL,
  `u_money` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '余额字段,不能为负数',
  `u_emoney` int DEFAULT '0',
  `u_integral` int DEFAULT '0',
  `u_topic` int DEFAULT '0',
  `u_face` varchar(255) DEFAULT NULL,
  `u_sign` varchar(255) DEFAULT NULL,
  `u_forum_admin` int DEFAULT '0',
  `u_utype` int DEFAULT '0',
  `u_lock` int DEFAULT '0',
  `u_time` datetime DEFAULT '2021-08-01 08:00:00',
  `u_lasttime` datetime DEFAULT '2021-08-01 08:00:00',
  `u_pretime` datetime DEFAULT '2021-08-01 08:00:00',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_user_recharge` (
  `urid` int NOT NULL AUTO_INCREMENT,
  `ur_orderid` varchar(50) DEFAULT NULL,
  `ur_username` varchar(50) DEFAULT NULL,
  `ur_price` float DEFAULT '0',
  `ur_payment` int DEFAULT NULL,
  `ur_prepaid` int DEFAULT '0',
  `ur_trade_no` varchar(50) DEFAULT NULL,
  `ur_seller_id` varchar(50) DEFAULT NULL,
  `ur_timestamp` varchar(50) DEFAULT NULL,
  `ur_state` int DEFAULT '0',
  `ur_lock` int DEFAULT '0',
  `ur_time` datetime DEFAULT '2021-08-01 08:00:00',
  `ur_update` datetime DEFAULT '2021-08-01 08:00:00',
  `ur_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`urid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wdja_user_vip` (
  `uvid` int NOT NULL AUTO_INCREMENT,
  `uv_orderid` varchar(50) DEFAULT NULL,
  `uv_username` varchar(50) DEFAULT NULL,
  `uv_utype` varchar(50) DEFAULT NULL,
  `uv_outype` varchar(10) DEFAULT NULL,
  `uv_nutype` varchar(10) DEFAULT NULL,
  `uv_price` float DEFAULT '0',
  `uv_payment` int DEFAULT NULL,
  `uv_payid` varchar(50) DEFAULT NULL,
  `uv_state` int DEFAULT '0',
  `uv_time` datetime DEFAULT '2021-08-01 08:00:00',
  `uv_update` datetime DEFAULT '2021-08-01 08:00:00',
  `uv_lng` varchar(50) DEFAULT 'chinese',
  PRIMARY KEY (`uvid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `wdja_admin` (`a_name`, `a_pword`, `a_popedom`, `a_lock`, `a_lasttime`, `a_lastip`) VALUES ( 'admin', '21232f297a57a5a743894a0e4a801fc3', '-1', '0', '2021-08-01 08:00:00', '127.0.0.1');

