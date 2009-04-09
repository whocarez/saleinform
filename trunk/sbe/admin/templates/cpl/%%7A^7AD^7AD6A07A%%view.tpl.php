<?php /* Smarty version 2.6.10, created on 2009-03-29 21:22:09
         compiled from view.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title><?php echo $this->_tpl_vars['view_description']; ?>
</title>
  <?php echo $this->_tpl_vars['style_sheets']; ?>

  <?php echo $this->_tpl_vars['scripts']; ?>

</head>
<body bgcolor="#EDEDED">

<?php echo $this->_tpl_vars['controls'][0]; ?>

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
   <?php if ($this->_sections['i']['index'] != 0): ?>
   <tr><td>
   <?php echo $this->_tpl_vars['controls'][$this->_sections['i']['index']]; ?>

   </td></tr>
   <?php endif; ?>
<?php endfor; else: ?>
   <b>Array $controls has no entries</b>
<?php endif; ?>
</table>

</body>
</html>