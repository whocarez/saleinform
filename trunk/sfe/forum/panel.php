<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/panel.php,v 1.28 2007/01/01 11:58:39 pc_freak Exp $
	
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
 * Panel doorway
 *
 * Forms the doorway to Panel.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.28 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 * @subpackage	Panel
 */

define('INCLUDED', true);
define('ROOT_PATH', './');

//
// Include usebb engine
//
require(ROOT_PATH.'sources/common.php');

$_GET['act'] = ( !empty($_GET['act']) ) ? $_GET['act'] : 'panel_home';

if ( $_GET['act'] == 'login' ) {
	
	//
	// Log In
	//
	require(ROOT_PATH.'sources/panel_login.php');
	
} elseif ( $_GET['act'] == 'logout' ) {
	
	//
	// Log Out
	//
	require(ROOT_PATH.'sources/panel_logout.php');
	
} elseif ( $_GET['act'] == 'register' ) {
	
	//
	// Register
	//
	require(ROOT_PATH.'sources/panel_register.php');
	
} elseif ( $_GET['act'] == 'activate' && !empty($_GET['id']) && valid_int($_GET['id']) && !empty($_GET['key']) ) {
	
	//
	// Activate
	//
	require(ROOT_PATH.'sources/panel_activate.php');
	
} elseif ( $_GET['act'] == 'sendpwd' ) {
	
	//
	// Send Password
	//
	require(ROOT_PATH.'sources/panel_sendpwd.php');
	
} elseif ( in_array($_GET['act'], array('panel_home', 'editprofile', 'editoptions', 'editpwd', 'subscriptions')) ) {
	
	//
	// Update and get the session information
	//
	$session->update($_GET['act']);
	
	if ( !$session->sess_info['user_id'] ) {
		
		$functions->redir_to_login();
		
	} else {
		
		//
		// Include the page header
		//
		require(ROOT_PATH.'sources/page_head.php');
		
		switch ( $_GET['act'] ) {
			
			case 'subscriptions':
				$location = $lang['Subscriptions'];
				break;
			case 'editprofile':
				$location = $lang['EditProfile'];
				break;
			case 'editoptions':
				$location = $lang['EditOptions'];
				break;
			case 'editpwd':
				$location = $lang['EditPasswd'];
				break;
			
		}
		
		if ( $_GET['act'] == 'panel_home' )
			$template->set_page_title($lang['YourPanel']);
		else
			$template->set_page_title('<a href="'.$functions->make_url('panel.php').'">'.$lang['YourPanel'].'</a>'.$template->get_config('locationbar_item_delimiter').$location);
		
		$template->parse('menu', 'panel', array(
			'panel_home' => '<a href="'.$functions->make_url('panel.php').'">' . ( ( $_GET['act'] != 'panel_home' ) ? $lang['PanelHome'] : '<strong>'.$lang['PanelHome'].'</strong>' ) . '</a>',
			'panel_subscriptions' => '<a href="'.$functions->make_url('panel.php', array('act' => 'subscriptions')).'">' . ( ( $_GET['act'] != 'subscriptions' ) ? $lang['Subscriptions'] : '<strong>'.$lang['Subscriptions'].'</strong>' ) . '</a>',
			'view_profile' => '<a href="'.$functions->make_url('profile.php', array('id' => $session->sess_info['user_info']['id'])).'">'.$lang['ViewProfile'].'</a>',
			'panel_profile' => '<a href="'.$functions->make_url('panel.php', array('act' => 'editprofile')).'">' . ( ( $_GET['act'] != 'editprofile' ) ? $lang['EditProfile'] : '<strong>'.$lang['EditProfile'].'</strong>' ) . '</a>',
			'panel_options' => '<a href="'.$functions->make_url('panel.php', array('act' => 'editoptions')).'">' . ( ( $_GET['act'] != 'editoptions' ) ? $lang['EditOptions'] : '<strong>'.$lang['EditOptions'].'</strong>' ) . '</a>',
			'panel_passwd' => '<a href="'.$functions->make_url('panel.php', array('act' => 'editpwd')).'">' . ( ( $_GET['act'] != 'editpwd' ) ? $lang['EditPasswd'] : '<strong>'.$lang['EditPasswd'].'</strong>' ) .'</a>'
		));
		
		switch ( $_GET['act'] ) {
			
			case 'panel_home':
				require(ROOT_PATH.'sources/panel_home.php');
				break;
			case 'editprofile':
				require(ROOT_PATH.'sources/panel_profile.php');
				break;
			case 'editoptions':
				require(ROOT_PATH.'sources/panel_options.php');
				break;
			case 'editpwd':
				require(ROOT_PATH.'sources/panel_editpwd.php');
				break;
			case 'subscriptions':
				require(ROOT_PATH.'sources/panel_subscriptions.php');
				break;
			
		}
		
		//
		// Include the page footer
		//
		require(ROOT_PATH.'sources/page_foot.php');
		
	}
	
} else {
	
	$functions->redirect('index.php');
	
}

?>
