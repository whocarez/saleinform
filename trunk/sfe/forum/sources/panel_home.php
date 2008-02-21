<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/sources/panel_home.php,v 1.23 2007/01/01 11:58:49 pc_freak Exp $
	
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
 * Panel index
 *
 * Shows the Panel index with general information.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.23 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 * @subpackage	Panel
 */

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

if ( count($_COOKIE) >= 1 && isset($_GET['al']) && valid_int($_GET['al']) ) {
	
	if ( $_GET['al'] ) {
		
		//
		// Set the AL cookie
		//
		$functions->set_al($session->sess_info['user_id'], $session->sess_info['user_info']['passwd']);
		$msgbox_content = $lang['AutoLoginSet'];
		
	} elseif ( !$_GET['al'] ) {
		
		//
		// Unset the AL cookie
		//
		$functions->unset_al();
		$msgbox_content = $lang['AutoLoginUnset'];
		
	}
	
	$template->parse('msgbox', 'global', array(
		'box_title' => $lang['Note'],
		'content' => $msgbox_content
	));
	
} elseif ( !empty($_GET['do']) && $_GET['do'] == 'markallasread' ) {
	
	$_SESSION['previous_visit'] = time();
	
	$template->parse('msgbox', 'global', array(
		'box_title' => $lang['Note'],
		'content' => $lang['MarkAllAsReadDone']
	));
	
} else {
	
	//
	// Some various session information
	//
	if ( count($_COOKIE) < 1 ) {
		
		$al_status = $lang['Disabled'];
		$al_change = $lang['FeatureDisabledBecauseCookiesDisabled'];
		
	} elseif ( $functions->isset_al() ) {
		
		$al_status = $lang['Enabled'];
		$al_change = '<a href="'.$functions->make_url('panel.php', array('al' => 0)).'">'.$lang['Disable'].'</a>';
		
	} else {
		
		$al_status = $lang['Disabled'];
		$al_change = '<a href="'.$functions->make_url('panel.php', array('al' => 1)).'">'.$lang['Enable'].'</a>';
		
	}
	
	$total_time = $functions->time_past($session->sess_info['started'], $session->sess_info['updated']);
	
	$template->parse('sess_info', 'panel', array(
		'sess_id_v' => $session->sess_info['sess_id'],
		'ip_addr_v' => $session->sess_info['ip_addr'],
		'started_v' => $functions->make_date($session->sess_info['started']),
		'updated_v' => $functions->make_date($session->sess_info['updated']),
		'total_time_v' => $total_time[1],
		'pages_v' => $session->sess_info['pages'],
		'al_status' => $al_status,
		'al_change' => $al_change,
		'mark_all_as_read' => '<a href="'.$functions->make_url('panel.php', array('do' => 'markallasread')).'">'.$lang['MarkAllAsRead'].'</a>'
	));
	
}

?>
