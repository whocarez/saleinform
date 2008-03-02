<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/edit.php,v 1.10 2007/01/01 11:58:38 pc_freak Exp $
	
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
 * Edit doorway
 *
 * Forms the doorway to editing topics and posts.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.10 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 */

define('INCLUDED', true);
define('ROOT_PATH', './');

//
// Include usebb engine
//
require(ROOT_PATH.'sources/common.php');

//
// Call the right source file for either topic or post altering
//
if ( !empty($_GET['topic']) && valid_int($_GET['topic']) ) {
	
	require(ROOT_PATH.'sources/edit_topic.php');
	
} elseif ( !empty($_GET['post']) && valid_int($_GET['post']) ) {
	
	require(ROOT_PATH.'sources/edit_post.php');
	
} else {
	
	//
	// There's no ID! Get us back to the index...
	//
	$functions->redirect('index.php');
	
}

?>
