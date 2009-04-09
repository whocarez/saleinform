<?php /* Smarty version 2.6.10, created on 2009-03-30 23:56:51
         compiled from /home/mazvv/Projects/PHP/sbe/admin/modules/members/uerrors/templates/layout_simple.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="Description" content="Information architecture, Web Design, Web Standards" />
	<meta name="Keywords" content="your, keywords" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<link rel="stylesheet" href="../css/menu.css" type="text/css">
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
	
	<title><?php echo $this->_tpl_vars['view_description']; ?>
</title>

</head>

<body>
<?php echo $this->_tpl_vars['scripts']; ?>

<img border="0" alt="" src="../images/logo_a.png"/>
<table width=100% border=0 cellspacing=10 cellpadding=0>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['controls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
   <tr><td>
   <?php echo $this->_tpl_vars['controls'][$this->_sections['i']['index']]; ?>

   </td></tr>
<?php endfor; else: ?>
   <b>Array $controls has no entries</b>
<?php endif; ?>
</table>
<center>
	<font style="font-size: 11px; font-weight:bold;">Powered by <a target="_blank" href="http://phpopenbiz.org">OpenBiz</a></font>
</center>
</body>

</html>