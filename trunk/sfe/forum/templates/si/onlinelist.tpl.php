<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/templates/default/onlinelist.tpl.php,v 1.10 2007/01/01 11:58:50 pc_freak Exp $
	
	This file is part of UseBB.
	
	UseBB is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	UseBB is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with UseBB; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

//
// Online list templates
//

$templates['header'] = '
	<p id="pagelinksothertop">{page_links}</p>
	<table class="maintable">
		<tr>
			<th>{l_Username}</th>
			<th>{l_CurrentPage}</th>
			<th>{l_LatestUpdate}</th>
		</tr>
';

$templates['user'] = '
		<tr>
			<td>{username}</td>
			<td>{current_page}</td>
			<td class="minimal">{latest_update}</td>
		</tr>
';

$templates['footer'] = '
	</table>
	<p id="pagelinksotherbottom">{page_links}</p>
';

?>
