<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/mail.php,v 1.46 2007/03/07 18:05:15 pc_freak Exp $
	
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
 * Mail form
 *
 * Gives a form that can be used to e-mail members.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.46 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 */

define('INCLUDED', true);
define('ROOT_PATH', './');

//
// Include usebb engine
//
require(ROOT_PATH.'sources/common.php');
	
if ( intval($functions->get_config('email_view_level')) === 1 && !empty($_GET['id']) && valid_int($_GET['id']) ) {
	
	//
	// Update and get the session information
	//
	$session->update('sendemail:'.$_GET['id']);
	
	//
	// Include the page header
	//
	require(ROOT_PATH.'sources/page_head.php');
	
	if ( $session->sess_info['user_id'] == LEVEL_GUEST ) {
		
		$functions->redir_to_login();
		
	} else {
		
		//
		// Get the user information
		//
		if ( $_GET['id'] == $session->sess_info['user_id'] ) {
			
			//
			// This user wants to send an email to himself, so we don't need a new query
			//
			$own_mailpage = true;
			$user_to_mail = $session->sess_info['user_info'];
			
		} else {
			
			//
			// This user is not emailing himself, so we need a new query
			//
			$own_mailpage = false;
			
			$result = $db->query("SELECT id, displayed_name, email, email_show FROM ".TABLE_PREFIX."members WHERE id = ".$_GET['id']);
			$user_to_mail = $db->fetch_result($result);
			
		}
		
		if ( $own_mailpage || $user_to_mail['id'] ) {
			
			if ( !$user_to_mail['email_show'] && $functions->get_user_level() < $functions->get_config('view_hidden_email_addresses_min_level') && !$own_mailpage ) {
				
				//
				// You can't e-mail this user if he/she chose not to receive e-mails
				// unless you are an admin or your are trying to e-mail yourself :p
				//
				$template->set_page_title($lang['Error']);
				$template->parse('msgbox', 'global', array(
					'box_title' => $lang['Error'],
					'content' => $lang['NoMails']
				));
				
			} else {
				
				$template->set_page_title(sprintf($lang['SendEmail'], unhtml(stripslashes($user_to_mail['displayed_name']))));
				
				$_POST['subject'] = ( !empty($_POST['subject']) ) ? stripslashes($_POST['subject']) : '';
				$_POST['body'] = ( !empty($_POST['body']) ) ? stripslashes($_POST['body']) : '';
				if ( !empty($_POST['subject']) && !empty($_POST['body']) ) {
					
					//
					// All information is passed, now send the mail
					//
					$bcc_email = ( !empty($_POST['bcc']) && !$own_mailpage ) ? $session->sess_info['user_info']['email'] : '';
					$functions->usebb_mail($_POST['subject'], $lang['UserEmailBody'], array(
						'username' => stripslashes($session->sess_info['user_info']['displayed_name']),
						'body' => $_POST['body']
					), stripslashes($session->sess_info['user_info']['displayed_name']), $session->sess_info['user_info']['email'], $user_to_mail['email'], $bcc_email);
					
					$template->parse('msgbox', 'global', array(
						'box_title' => $lang['Note'],
						'content' => sprintf($lang['EmailSent'], '<em>'.unhtml(stripslashes($user_to_mail['displayed_name'])).'</em>')
					));
					
				} else {
					
					if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
						
						//
						// Some fields have not been filled in,
						//
						$errors = array();
						if ( empty($_POST['subject']) )
							$errors[] = $lang['Subject'];
						if ( empty($_POST['body']) )
							$errors[] = $lang['Body'];
						
						//
						// Show an error message
						//
						if ( count($errors) ) {
							
							$template->parse('msgbox', 'global', array(
								'box_title' => $lang['Error'],
								'content' => sprintf($lang['MissingFields'], join(', ', $errors))
							));
							
						}
						
					}
					
					//
					// Show the mail form
					//
					$to_v = '<a href="'.$functions->make_url('profile.php', array('id' => $_GET['id'])).'">'.unhtml(stripslashes($user_to_mail['displayed_name'])).'</a>';
					if ( $functions->get_user_level() >= $functions->get_config('view_hidden_email_addresses_min_level') )
						$to_v .= ' &lt;<a href="mailto:'.$user_to_mail['email'].'">'.$user_to_mail['email'].'</a>&gt;';
					$_POST['subject'] = ( !empty($_POST['subject']) ) ? unhtml($_POST['subject']) : '';
					$_POST['body'] = ( !empty($_POST['body']) ) ? unhtml($_POST['body']) : '';
					$bcc_checked = ( !empty($_POST['bcc']) && !$own_mailpage ) ? ' checked="checked"' : '';
					$bcc_disabled = ( $own_mailpage ) ? ' disabled="disabled"' : '';
					
					$template->parse('mail_form', 'various', array(
						'form_begin' => '<form action="'.$functions->make_url('mail.php', array('id' => $_GET['id'])).'" method="post">',
						'sendemail' => sprintf($lang['SendEmail'], unhtml(stripslashes($user_to_mail['displayed_name']))),
						'to_v' => $to_v,
						'from_v' => '<a href="'.$functions->make_url('profile.php', array('id' => $session->sess_info['user_info']['id'])).'">'.unhtml(stripslashes($session->sess_info['user_info']['displayed_name'])).'</a> &lt;<a href="mailto:'.$session->sess_info['user_info']['email'].'">'.$session->sess_info['user_info']['email'].'</a>&gt;',
						'subject_input' => '<input type="text" name="subject" id="subject" size="50" value="'.$_POST['subject'].'" />',
						'body_input' => '<textarea rows="'.$template->get_config('textarea_rows').'" cols="'.$template->get_config('textarea_cols').'" name="body">'.$_POST['body'].'</textarea>',
						'bcc_input' => '<label><input type="checkbox" name="bcc" value="1"'.$bcc_checked.$bcc_disabled.' /> '.$lang['BCCMyself'].'</label>',
						'submit_button' => '<input type="submit" name="submit" value="'.$lang['Send'].'" />',
						'reset_button' => '<input type="reset" value="'.$lang['Reset'].'" />',
						'form_end' => '</form>'
					));
					$template->set_js_onload("set_focus('subject')");
					
				}
				
			}
			
		} else {
			
			//
			// This user does not exist, show an error
			//
			header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
			$template->set_page_title($lang['Error']);
			$template->parse('msgbox', 'global', array(
				'box_title' => $lang['Error'],
				'content' => sprintf($lang['NoSuchMember'], 'ID '.$_GET['id'])
			));
			
		}
		
	}
	
	//
	// Include the page footer
	//
	require(ROOT_PATH.'sources/page_foot.php');
	
} else {
	
	//
	// There's no user ID or the mail form has not been enabled!
	// Get us back to the index...
	//
	$functions->redirect('index.php');
	
}

?>
