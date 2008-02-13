<?php /* Smarty version 2.6.10, created on 2008-01-03 22:15:01
         compiled from edit.tpl */ ?>
<form id=<?php echo $this->_tpl_vars['name']; ?>
 name=<?php echo $this->_tpl_vars['name']; ?>
 onclick="SetActiveForm('<?php echo $this->_tpl_vars['name']; ?>
')" class='inactive_form'>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_toolbar">
<table width=100% cellspacing=0 cellpadding=0>
<tr>
<td width=0% class=title><?php echo $this->_tpl_vars['title']; ?>
</td>
</tr>
<tr>
<td align=left>
<table cellspacing=0 cellpadding=2 class='tbl_toolbar' width=100%><tr><td> 
<?php $_from = $this->_tpl_vars['toolbar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['btn']):
?>
<?php echo $this->_tpl_vars['btn']; ?>

<?php endforeach; endif; unset($_from); ?>
</td></tr></table>
</td>
</table>
</div>
</td></tr>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_data">
<table width=100% border=0 cellspacing=1 cellpadding=3 class=tbl>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td width=100 class=item align=right valign=top class=cell><?php echo $this->_tpl_vars['item']['label']; ?>

<?php if ($this->_tpl_vars['item']['required'] == 'Y'): ?> <span class='required'>*</span><?php endif; ?></td>
<td valign=top class=cell_edit><?php echo $this->_tpl_vars['item']['control']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
</td></tr>
</table>
</form>