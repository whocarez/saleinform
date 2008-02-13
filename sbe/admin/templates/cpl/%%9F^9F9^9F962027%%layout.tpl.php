<?php /* Smarty version 2.6.10, created on 2007-04-24 13:36:07
         compiled from wares/catpars/layout.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="Description" content="Information architecture, Web Design, Web Standards" />
	<meta name="Keywords" content="your, keywords" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Distribution" content="Global" />
	<meta name="Author" content="Luka Cvrk (www.solucija.com)" />
	<meta name="Robots" content="index,follow" />
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<?php echo $this->_tpl_vars['style_sheets']; ?>

	<script language="javascript" src="../js/clientUtil.js"></script>
	<script language="javascript" src="../js/jsval.js"></script>
	<!-- dynarch calendar includes -->
	<style type="text/css">@import url(../js/jscalendar/calendar-system.css);</style>
	<script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
	<script type="text/javascript" src="../js/calendar.js"></script>
	<!-- -->
	
	<title><?php echo $this->_tpl_vars['view_description']; ?>
</title>

</head>
<body>
<?php echo $this->_tpl_vars['scripts']; ?>

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
			<?php echo $this->_tpl_vars['controls'][0]; ?>

			<?php echo $this->_tpl_vars['controls'][1]; ?>
	
		</div>
	  		<div class="right">	
			<table width="100%">
				<tr>
				   	<td valign="top" width="30%">	  					
					<?php echo $this->_tpl_vars['controls'][3]; ?>

					</td>
				   	<td valign="top">	  					
					<?php echo $this->_tpl_vars['controls'][4]; ?>

					</td>
				</tr>
			</table>
			</div>
		<?php echo $this->_tpl_vars['controls'][2]; ?>

		
		<div class="footer">
			<p><a href="#">RSS Feed</a> | <a href="#">Contact</a></p>	
			<p>й Copyright 2005, <a href="#">YourSite</a> | Design: Luka Cvrk - <a href="http://www.solucija.com/" title="What's your solution?">Solucija</a> | Valid <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a></p>
		</div>
	</div>
</body>
</html>