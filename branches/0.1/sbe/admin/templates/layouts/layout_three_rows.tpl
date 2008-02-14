<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="Description" content="Information architecture, Web Design, Web Standards" />
	<meta name="Keywords" content="your, keywords" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- --> 
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<!-- -->
	<!--
	<link rel="stylesheet" href="../css/openbiz.css" type="text/css">
	-->
	<link rel="stylesheet" href="../css/menu.css" type="text/css">	
	{$style_sheets}
	<script language="javascript" src="../js/clientUtil.js"></script>
	<script language="javascript" src="../js/jsval.js"></script>
	<script language="javascript" src="../js/richtext.js"></script>
	<!-- dynarch calendar includes -->
	<style type="text/css">@import url(../js/jscalendar/calendar-system.css);</style>
	<script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
	<script type="text/javascript" src="../js/calendar.js"></script>
	<!-- -->
	
	<title>{$view_description}</title>

</head>
<body>
{$scripts}
	<div id="content">
		<div class="header">
		<!-- 
			<div class="searchform">	
				<form method="post" class="search" action="#" />
					<p><input name="search_query" class="text" type="text" />
  					<input name="search" class="searchbutton" value="Search" type="submit" /></p>
  				</form>
			</div>
		 -->
			<h1><a href="#">Saleinform - true prices only</a></h1>
		</div>

		<div class="subheader">
			{$controls[0]}
			{$controls[1]}	
		</div>
	  		<div class="right">	
			<table width="100%">
				<tr>
				   	<td valign="top">	  					
					{$controls[3]}
					</td>
				</tr>
				<tr>
				   	<td valign="top">	  					
					{$controls[4]}
					</td>
				</tr>
				<tr>
				   	<td valign="top">	  					
					{$controls[5]}
					</td>
				</tr>
			</table>
			</div>
		{$controls[2]}
		<div class="footer">
			<p>@Copyright 2007, <a href="#">Saleinform.com</a> | Design: Mazvv - <a href="http://www.saleinform.com" title="">Saleinform.com</a></p>
		</div>
	</div>
</body>
</html>