<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/config.php,v 1.191 2007/03/07 17:33:42 pc_freak Exp $
	
	This file is part of UseBB.
	
	UseBB is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	UseBB is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with UseBB; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Configuration
 *
 * Contains configuration settings.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.191 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 */

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

//
// Initialize a new database configuration holder array
//
$dbs = array();

//
// Define database configuration
//
$dbs['type'] = 'mysql';
$dbs['server'] = 'localhost';
$dbs['username'] = 'saleinfo_sfedb';
$dbs['passwd'] = ',hf[vfgenhf';
$dbs['dbname'] = 'saleinfo_sfedb';
$dbs['prefix'] = 'forum_';

//
// Initialize a new configuration holder array
//
$conf = array();

//
// Define configuration
//
$conf['activation_mode'] = 1;
$conf['active_topics_count'] = 25;
$conf['admin_email'] = 'sfe@saleinform.com';
$conf['allow_multi_sess'] = 1;
$conf['allow_duplicate_emails'] = 0;
$conf['avatars_force_width'] = 0;
$conf['avatars_force_height'] = 0;
$conf['board_closed'] = 0;
$conf['board_closed_reason'] = 'Форум закрыт на профилактику...';
$conf['board_descr'] = 'Обсуждение товаров, продавцов, работы сервиса';
$conf['board_keywords'] = 'обсуждение,оценки,сравнение,цен,оценки,продавцов';
$conf['board_name'] = 'Saleinform форум';
$conf['board_url'] = '';
$conf['cookie_domain'] = '';
$conf['cookie_httponly'] = 1;
$conf['cookie_path'] = '';
$conf['cookie_secure'] = 0;
$conf['date_format'] = 'D M d, Y g:i a';
$conf['debug'] = 0;
$conf['disable_registrations'] = 0;
$conf['disable_registrations_reason'] = 'No new users allowed at this time.';
$conf['disable_xhtml_header'] = 1;
$conf['dnsbl_powered_banning_min_hits'] = 2;
$conf['dnsbl_powered_banning_recheck_minutes'] = 0;
$conf['dnsbl_powered_banning_servers'] = array ();
$conf['dnsbl_powered_banning_whitelist'] = array (  0 => '127.0.0.1',  1 => '*.googlebot.com',);
$conf['dst'] = 0;
$conf['edit_post_timeout'] = 300;
$conf['email_view_level'] = 2;
$conf['email_reply-to_header'] = 0;
$conf['enable_acp_modules'] = 0;
$conf['enable_badwords_filter'] = 0;
$conf['enable_contactadmin'] = 1;
$conf['enable_detailed_online_list'] = 1;
$conf['enable_dnsbl_powered_banning'] = 0;
$conf['enable_email_dns_check'] = 0;
$conf['enable_forum_stats_box'] = 1;
$conf['enable_ip_bans'] = 0;
$conf['enable_memberlist'] = 1;
$conf['enable_quickreply'] = 1;
$conf['enable_registration_log'] = 0;
$conf['enable_rss'] = 1;
$conf['enable_stafflist'] = 1;
$conf['enable_stats'] = 1;
$conf['exclude_forums_active_topics'] = array ();
$conf['exclude_forums_rss'] = array ();
$conf['exclude_forums_stats'] = array ();
$conf['flood_interval'] = 30;
$conf['friendly_urls'] = 0;
$conf['force_latin1_db'] = 0;
$conf['guests_can_access_board'] = 1;
$conf['guests_can_see_contact_info'] = 0;
$conf['guests_can_view_profiles'] = 1;
$conf['hide_avatars'] = 0;
$conf['hide_db_config_acp'] = 1;
$conf['hide_signatures'] = 0;
$conf['hide_undefined_template_setting_warnings'] = 0;
$conf['hide_undefined_template_warnings'] = 0;
$conf['hide_userinfo'] = 0;
$conf['language'] = 'Russian';
$conf['mass_email_msg_recipients'] = 100;
$conf['members_per_page'] = 25;
$conf['online_min_updated'] = 30;
$conf['output_compression'] = 2;
$conf['passwd_min_length'] = 6;
$conf['posts_per_page'] = 25;
$conf['registration_log_file'] = '';
$conf['rel_nofollow'] = 0;
$conf['return_to_topic_after_posting'] = 1;
$conf['rss_items_count'] = 25;
$conf['search_limit_results'] = 500;
$conf['search_nonindex_words_min_length'] = 3;
$conf['session_max_lifetime'] = 60;
$conf['session_name'] = 'usebb';
$conf['session_save_path'] = '';
$conf['show_edited_message_timeout'] = 60;
$conf['show_never_activated_members'] = 1;
$conf['show_raw_entities_in_code'] = 1;
$conf['sig_allow_bbcode'] = 1;
$conf['sig_allow_smilies'] = 1;
$conf['sig_max_length'] = 500;
$conf['single_forum_mode'] = 0;
$conf['target_blank'] = 0;
$conf['template'] = 'si';
$conf['timezone'] = 0;
$conf['topicreview_posts'] = 5;
$conf['topics_per_page'] = 25;
$conf['username_min_length'] = 3;
$conf['username_max_length'] = 30;
$conf['view_active_topics_min_level'] = 0;
$conf['view_contactadmin_min_level'] = 0;
$conf['view_detailed_online_list_min_level'] = 1;
$conf['view_forum_stats_box_min_level'] = 1;
$conf['view_hidden_email_addresses_min_level'] = 3;
$conf['view_memberlist_min_level'] = 1;
$conf['view_search_min_level'] = 0;
$conf['view_stafflist_min_level'] = 0;
$conf['view_stats_min_level'] = 1;

?>
