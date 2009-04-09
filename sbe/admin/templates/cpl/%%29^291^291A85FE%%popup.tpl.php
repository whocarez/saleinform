<?php /* Smarty version 2.6.10, created on 2009-04-08 23:52:52
         compiled from popup.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title><?php echo $this->_tpl_vars['view_description']; ?>
</title>
  <link rel="stylesheet" href="../css/openbiz.css" type="text/css">
  <?php echo $this->_tpl_vars['style_sheets']; ?>

  <script language="javascript" src="../js/clientUtil.js"></script>
</head>
<body bgcolor="#EDEDED" style="margin-top: 0; margin-left: 0; margin-right: 0; margin-bottom: 0">
<?php echo $this->_tpl_vars['scripts']; ?>

<table width=100% border=0 cellspacing=5 cellpadding=0>
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
   <b>Array $columns has no entries</b>
<?php endif; ?>
</table>

</body>
</html>