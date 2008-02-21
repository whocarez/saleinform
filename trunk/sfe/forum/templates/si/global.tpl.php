<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/templates/default/global.tpl.php,v 1.127 2007/01/01 11:58:50 pc_freak Exp $
	
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

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

//
// Initialize a new template holder array
//
$templates = array();

//
// Define configuration variables of this template set
//
$templates['config'] = array(
	'content_type'						=> 'application/xhtml+xml',
	'item_delimiter'					=> ' &middot; ',
	'locationbar_item_delimiter'		=> ' &raquo; ',
	'postlinks_item_delimiter'			=> ' | ',
	'open_nonewposts_icon'				=> 'open_nonewposts.gif',
	'open_newposts_icon'				=> 'open_newposts.gif',
	'closed_nonewposts_icon'			=> 'closed_nonewposts.gif',
	'closed_newposts_icon'				=> 'closed_newposts.gif',
	'newpost_link_format'				=> '<a href="%s"><img src="%s" alt="%s" /></a> ',
	'newpost_link_icon'					=> 'new.gif',
	'sig_format'						=> '<div class="signature">_______________<div>%s</div></div>',
	'quote_format'						=> '<blockquote class="quote"><div class="title">%s</div><div class="content">%s</div></blockquote>',
	'code_format'						=> '<pre class="code">%s</pre>',
	'post_editinfo_format'				=> '<div class="editinfo">&laquo; %s &raquo;</div>',
	'poster_ip_addr_format' 			=> '<div class="poster-ip-addr">%s</div>',
	'textarea_rows'						=> 10,
	'textarea_cols'						=> 60,
	'quick_reply_textarea_rows'			=> 5,
	'quick_reply_textarea_cols'			=> 60,
	'post_form_bbcode_seperator'		=> '</li><li>',
	'post_form_smiley_seperator'		=> '</li> <li>',
	'debug_info_small'					=> '<div id="debug-info-small">%s</div>',
	'debug_info_large'					=> '<div id="debug-info-large">%s</div>',
	'forumlist_topic_rtrim_length'		=> 20,
	'rss_feed_icon'						=> 'rss.png',
	'smilies' => array(
		':)' => 'smile.gif',
		';)' => 'wink.gif',
		':D' => 'biggrin.gif',
		'8)' => 'cool.gif',
		':P' => 'razz.gif',
		':o' => 'surprised.gif',
		':?' => 'confused.gif',
		':(' => 'sad.gif',
		':x' => 'mad.gif',
		':|' => 'neutral.gif',
		':\'(' => 'cry.gif',
		':lol:' => 'lol.gif',
		':mrgreen:' => 'mrgreen.gif',
		':oops:' => 'redface.gif',
		':shock:' => 'eek.gif',
		':roll:' => 'rolleyes.gif',
		':evil:' => 'evil.gif',
		':twisted:' => 'twisted.gif',
	)
);

//
// Globally needed templates
//

$templates['normal_header'] ='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{language_code}" lang="{language_code}" dir="{text_direction}">
<head>
	<title>{board_name}: {page_title}</title>
	<meta name="description" content="{board_descr}">
	<meta name="keywords" content="{board_keywords}">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="{css_url}" />{acp_css_head_link}
	<link rel="shortcut icon" href="{img_dir}si.png" />
	{rss_head_link}
	<script type="text/javascript" src="sources/javascript.js"></script>
</head>
<body id="mainBody" style="text-align: center;">
<center>
	<div class="md" id="" style="">
		<!-- { Top header area  -->
		<div class="topMN">
			<div style="float: left;">
				<span id="aset">
				</span>
			</div>
			<div style="margin-left: 60%; text-align: right;">
			</div>
		</div>
		<!-- } Top header area  -->
		<div id="main_cnt">
			<table style="margin: 0pt; padding: 0pt; width: 100%; font-size: 100%;" border="0">
				<tbody>
					<tr>
						<td>
							<!-- ************************************** -->


<div style="position: relative; z-index: 99999;">
	<span style="width: 70px; position: absolute; top: 70px; left: 300px;" id="rZ_md"> 
	</span>
</div>
<script type="text/javascript">
<!--
	function buildAction()
	{
		var searchStringObj = document.getElementById(\'searchString\');
		var searchActionObj = document.getElementById(\'formAction\');
		var searchFormObj = document.getElementById(\'searchForm\');
		var categoryRidObj = document.getElementById(\'categoryRid\');
		var searchThisCatObj = document.getElementById(\'search_thiscat\');
		if(trim(searchStringObj.value) == \'\')
		{ 
			alert(\'Строка поиска не должна быть пустой!\');
			return; 
		}
		else
		{
			if(trim(categoryRidObj.value) != \'\' && searchThisCatObj.checked == true)
			{  
				searchFormObj.action = searchActionObj.value + \'c/\' + trim(categoryRidObj.value) + \'/\';
			}
			else searchFormObj.action = searchActionObj.value;
			searchFormObj.action = searchFormObj.action + \'ss/\' + trim(searchStringObj.value);
		}
	}

	function trim(s)
	{
		return rtrim(ltrim(s));
	}

	function ltrim(s)
	{
		var l=0;
		while(l < s.length && s[l] == \' \')
		{	
			l++; 
		}
		return s.substring(l, s.length);
	}

	function rtrim(s)
	{
		var r=s.length -1;
		while(r > 0 && s[r] == \' \')
		{	
			r-=1;	
		}
		return s.substring(0, r+1);
	}		
//-->
</script>

<div class="zs">
<div id="z" style="margin: 15px 0px 0px;">
<div class="left" style="float: left; text-align: center; width: 260px;">
	<a href="#"> <img style="position: relative; top: 17px;" src="http://www.saleinform.com/images/logo.png" alt="Saleinform.com - сравнение цен" border="0" height="36" width="250"></a>

</div>
<div style="margin-left: 260px;">
<div style="float: left; padding-right: 25px;" id="zz">
<div><span style="float: right; width: 170px;"> </span>
<div class="rp1">
<a class="mCG" href="http://www.saleinform.com/">
	<div class="mL">
		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-">Главная</span>
		</div>

	</div>
</a> 
<a class="mCG" href="http://www.saleinform.com/index.php/categories">
	<div class="mL">
		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-">Категории</span>
		</div>
	</div>

</a> 
<a class="mCG" href="http://www.saleinform.com/index.php/guides">
	<div class="mL">
		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-">Покупателю</span>
		</div>
	</div>
</a> 
<a class="mC" href="http://www.saleinform.com/forum">
	<div class="mL">
		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-">Форум</span>
		</div>
	</div>
</a> 
<a class="mCG" href="http://www.saleinform.com/index.php/clients">
	<div class="mL">

		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-">Магазины</span>
		</div>
	</div>
</a> 
<a class="mCG" href="http://www.saleinform.com/index.php/help">
	<div class="mL">
		<div class="mR">

			<div class="p_100s"></div>
			<span id="s-">Помощь</span>
		</div>
	</div>
</a> 
</div>
<div class="fq1">
<form action="http://www.saleinform.com/index.php" method="post" id="searchForm" name="searchForm" onSubmit="buildAction()" style="padding: 0px; margin-top: 0px;">	<div class="fq2">
		<div class="fq3">
			<input id="sb" style="height: 25px; width: 120px;" class="y_button" value="Найти" type="submit" >

		</div>
		<div class="MQ">
			<input id="searchString" name="searchString" class="mainQ" value="" type="text">
			<input id="categoryRid" name="categoryRid" value="" type="hidden">
			<input id="formAction" name="formAction" value="http://www.saleinform.com/index.php/categories/" type="hidden">
		</div>
		<span id="rgn_s" class="a" style="z-index: 9999; margin-left: -4px;">
				</span>
	</div>

</form>
</div>
</div>
</div>
</div>
<iframe style="display: none;"></iframe></div>
</div>

							<!-- ************************************** -->
						</td>
					</tr>
				</tbody>
			</table>

<div class="box">
	<div class="b_h">
		<div id="hc_market" class="b_hc" >
			{board_name}
		</div>
	</div>
	<div class="b_c">
		<div class="o" id="market_c" style="">
			<div id="market_md" class="m_d">
			</div>
			<div id="market_cnt">
				<div class="sb">
					<a href="{link_home}">{l_Home}</a>&nbsp;&nbsp;&nbsp;
					<a href="{link_reg_panel}">{reg_panel}</a>&nbsp;&nbsp;&nbsp;
					<a href="{link_faq}">{l_FAQ}</a>&nbsp;&nbsp;&nbsp;
					<a href="{link_search}">{l_Search}</a>&nbsp;&nbsp;&nbsp;
					<a href="{link_active}">{l_ActiveTopics}</a>&nbsp;&nbsp;&nbsp;
					<a href="{link_log_inout}">{log_inout}</a>
				</div>
				<div class="n_fb">
					{location_bar}
				</div>				
';
$templates['normal_footer'] = '
	<div class="n_fb">
		{location_bar}
	</div>				
	<br>
	<center>
	{link_bar}
	</center>
	<!--	
	{debug_info_small}
	{debug_info_large}
	-->		
			</div>
		</div>
	</div>
</div> 
</div>
<div style="width: 100%; clear: both; text-align: center;">
<div class="topMenu" style="text-align: right; padding-right: 10px;">
<!-- { Footer menu -->
	<span style="float: left; line-height: 20px;">
	<a href="http://www.saleinform.com/index.php/clients/r" title="добавить магазин">добавить магазин</a>&nbsp;|&nbsp;
	<a href="http://www.saleinform.com/index.php/categories" title="реклама на портале">реклама на портале</a>&nbsp;|&nbsp;
	<a href="http://www.saleinform.com/index.php/brands" title="контекстная реклама">контекстная реклама</a>&nbsp;|&nbsp;
	<a href="http://www.saleinform.com/index.php/contacts" title="контакты">контакты</a></span>	
<!-- { Footer menu -->
<span id="footer_end" style="white-space: nowrap; height: 20px; line-height: 20px; font-size: 90%;">
Copyright © 2006-2007 <a href="" class="c69">Saleinform</a>&nbsp;&nbsp;All rights reserved
</span>
</div>
</div>
</div>
</center>
</body></html>
<br>
<br>
<br>
<br>
';

$templates['msgbox'] = '
	<div class="msgbox">
		<h3>{box_title}</h3>
		<p>{content}</p>
	</div>
';

$templates['confirm_form'] = '
	{form_begin}
	<table class="confirmform">
		<tr>
			<th>{title}</th>
		</tr>
		<tr>
			<td class="msg">{content}</td>
		</tr>
		<tr>
			<td class="formcontrols">{submit_button}&nbsp;{cancel_button}</td>
		</tr>
	</table>
	{form_end}
';

?>