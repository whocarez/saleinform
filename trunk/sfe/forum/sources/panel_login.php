<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/sources/panel_login.php,v 1.68 2007/01/01 11:58:49 pc_freak Exp $
	
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
 * Panel login
 *
 * Gives an interface to login into user accounts.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.68 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 * @subpackage	Panel
 */

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

//
// User wants to login
//
$session->update('login');

//
// Include the page header
//
require(ROOT_PATH.'sources/page_head.php');

$template->set_page_title($lang['LogIn']);

$_POST['user'] = ( !empty($_POST['user']) ) ? preg_replace('#\s+#', ' ', $_POST['user']) : '';

if ( !empty($_POST['user']) && !empty($_POST['passwd']) && preg_match(USER_PREG, $_POST['user']) && preg_match(PWD_PREG, $_POST['passwd']) ) {
	
	//
	// The user already passed a username and password
	//
	
	//
	// Get information about this username
	//
	$result = $db->query("SELECT id, passwd, active, banned, banned_reason, level, last_pageview FROM ".TABLE_PREFIX."members WHERE name = '".$_POST['user']."'");
	$userdata = $db->fetch_result($result);
	
	//
	// If this user does not exist...
	//
	if ( !$userdata['id'] ) {
		
		//
		// ...show a warning
		//
		$template->parse('msgbox', 'global', array(
			'box_title' => $lang['Error'],
			'content' => sprintf($lang['NoSuchMember'], '<em>'.unhtml(stripslashes($_POST['user'])).'</em>').' '.$lang['RegisterIt']
		));
		
	} elseif ( $userdata['banned'] ) {
		
		//
		// It does exist, but it is banned
		// thus, show another warning...
		//
		$template->parse('msgbox', 'global', array(
			'box_title' => $lang['BannedUser'],
			'content' => sprintf($lang['BannedUserExplain'], '<em>'.unhtml(stripslashes($_POST['user'])).'</em>') . '<br /><br />' . $userdata['banned_reason']
		));
		
	} elseif ( !$userdata['active'] ) {
		
		//
		// It does exist, but it hasn't been activated yet
		// thus, show another warning...
		//
		$template->parse('msgbox', 'global', array(
			'box_title' => $lang['Error'],
			'content' => sprintf($lang['NotActivated'], '<em>'.unhtml(stripslashes($_POST['user'])).'</em>')
		));
		
	} elseif ( $functions->get_config('board_closed') && $userdata['level'] != LEVEL_ADMIN ) {
		
		//
		// Only admins can log in when the forum is closed.
		// Show a warning to users...
		//
		$template->parse('msgbox', 'global', array(
			'box_title' => $lang['Error'],
			'content' => $lang['BoardClosedOnlyAdmins']
		));
		
	} elseif ( md5($_POST['passwd']) == $userdata['passwd'] ) {
		
		//
		// The password is correct,
		// we will now log in the user
		//
		$session->update(NULL, $userdata['id']);
		
		//
		// Set a remember cookie if the user chose to
		//
		if ( !empty($_POST['remember']) )
			$functions->set_al($userdata['id'], $userdata['passwd']);
		
		$_SESSION['previous_visit'] = $userdata['last_pageview'];
		
		//
		// Get us back to the previous page
		//
		$refere_to = ( !empty($_SESSION['refere_to']) ) ? $functions->attach_sid($_SESSION['refere_to']) : $functions->get_config('board_url').$functions->make_url('index.php', array(), false);
		unset($_SESSION['refere_to']);
		$functions->raw_redirect($refere_to);
		
	} else {
		
		//
		// The password was not correct
		// another warning
		//
		$template->parse('msgbox', 'global', array(
			'box_title' => $lang['Error'],
			'content' => $lang['WrongPassword']
		));
		
	}
	
} else {
	
	//
	// Show the login form, if the user is not logged in
	//
	if ( !$session->sess_info['user_id'] ) {
		
		$_SERVER['HTTP_REFERER'] = ( !empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $functions->get_config('board_url')) === 0 && !preg_match('#(?:login|logout|register|activate|sendpwd|install)#', $_SERVER['HTTP_REFERER']) ) ? $_SERVER['HTTP_REFERER'] : '';
		$_SESSION['refere_to'] = ( !empty($_SESSION['referer']) ) ? $_SESSION['referer'] : $_SERVER['HTTP_REFERER'];
		unset($_SESSION['referer']);
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			
			$errors = array();
			if ( empty($_POST['user']) || !preg_match(USER_PREG, $_POST['user']) )
				$errors[] = $lang['Username'];
			if ( empty($_POST['passwd']) || !preg_match(PWD_PREG, $_POST['passwd']) || strlen($_POST['passwd']) < $functions->get_config('passwd_min_length') )
				$errors[] = $lang['Password'];
			
			if ( count($errors) ) {
				
				$template->parse('msgbox', 'global', array(
					'box_title' => $lang['Error'],
					'content' => sprintf($lang['MissingFields'], join(', ', $errors))
				));
				
			}
			
		}
		
		$_POST['user'] = ( !empty($_POST['user']) && preg_match(USER_PREG, $_POST['user']) ) ? $_POST['user'] : '';
		if ( count($_COOKIE) < 1 ) {
			
			$remember_input = $lang['FeatureDisabledBecauseCookiesDisabled'];
			
		} else {
			
			$remember_input = '<label><input type="checkbox" name="remember" value="1" checked="checked" tabindex="3" /> '.$lang['Yes'].'</label>';
			
		}
		
		$template->parse('login_form', 'various', array(
			'form_begin'     => '<form action="'.$functions->make_url('panel.php', array('act' => 'login')).'" method="post">',
			'user_input'     => '<input type="text" name="user" id="user" size="25" maxlength="255" value="'.unhtml(stripslashes($_POST['user'])).'" tabindex="1" />',
			'password_input' => '<input type="password" name="passwd" size="25" maxlength="255" tabindex="2" />',
			'remember_input' => $remember_input,
			'submit_button'  => '<input type="submit" value="'.$lang['LogIn'].'" tabindex="4" />',
			'reset_button'   => '<input type="reset" value="'.$lang['Reset'].'" />',
			'link_reg'       => '<a href="'.$functions->make_url('panel.php', array('act' => 'register')).'">'.$lang['RegisterNewAccount'].'</a>',
			'link_sendpwd'   => '<a href="'.$functions->make_url('panel.php', array('act' => 'sendpwd')).'">'.$lang['SendPassword'].'</a>',
			'form_end'       => '</form>'
		));
		$template->set_js_onload("set_focus('user')");
		
	} else {
		
		//
		// If he/she is logged in, return to index
		//
		$functions->redirect('index.php');
		
	}
	
}

//
// Include the page footer
//
require(ROOT_PATH.'sources/page_foot.php');

?>
