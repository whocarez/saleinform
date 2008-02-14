<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title>{$view_description}</title>
  <link rel="stylesheet" href="../css/openbiz.css" type="text/css">
  <link href="../css/calendar.css" rel="stylesheet" type="text/css">
  {$style_sheets}
  <script language="javascript" src="../js/clientUtil.js"></script>
  <script language="javascript" src="../js/jsval.js"></script>
  <!-- dynarch calendar includes -->
  <style type="text/css">@import url(../js/jscalendar/calendar-win2k-1.css);</style>
	<script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
	<script type="text/javascript" src="../js/calendar.js"></script>
  <!-- -->
</head>
<body bgcolor="#EDEDED">
{$scripts}
<!--{if $viewtopic != ""}<div class="view_topic">{$viewtopic}</div>{/if}-->
<table width=100% border=0 cellspacing=0 cellpadding=10>
{section name=i loop=$controls}
   <tr><td>
   {$controls[i]}
   </td></tr>
{sectionelse}
   <b>Array $controls has no entries</b>
{/section}
</table>
</body>
</html>
