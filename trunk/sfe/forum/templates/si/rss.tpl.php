<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/templates/default/rss.tpl.php,v 1.8 2007/01/01 11:58:50 pc_freak Exp $
	
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
// RSS templates
//

$templates['header'] = '<?xml version="1.0" encoding="{character_encoding}"?>
<rss version="2.0" xml:lang="{language_code}">
	<channel>
		<title>{board_name}</title>
		<link>{board_url}</link>
		<description>{board_descr}</description>
		<language>{language_code}</language>
		<pubDate>{pubDate}</pubDate>
		<docs>http://blogs.law.harvard.edu/tech/rss</docs>
		<generator>UseBB</generator>
';

$templates['topic'] = '
		<item>
			<title><![CDATA[{title}]]></title>
			<description><![CDATA[{description}]]></description>
			<author><![CDATA[{author}]]></author>
			<link>{link}</link>
			<comments>{comments}</comments>
			<category><![CDATA[{category}]]></category>
			<pubDate>{pubDate}</pubDate>
			<guid isPermaLink="true">{guid}</guid>
		</item>
';

$templates['footer'] = '
	</channel>
</rss>
';

?>
