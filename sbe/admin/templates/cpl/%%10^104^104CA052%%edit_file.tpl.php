<?php /* Smarty version 2.6.10, created on 2009-03-30 21:21:51
         compiled from edit_file.tpl */ ?>
<form id=<?php echo $this->_tpl_vars['name']; ?>
 name=<?php echo $this->_tpl_vars['name']; ?>
 Enctype="Multipart/Form-Data" method="post">
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_toolbar">
<table width=100% cellspacing=0 cellpadding=1>
<tr>
<td width=0% class=title><?php echo $this->_tpl_vars['title']; ?>
</td></tr>
<tr  bgcolor=gray>
<td align=left>
<table cellspacing=2 cellpadding=0><tr>
<?php $_from = $this->_tpl_vars['toolbar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['btn']):
?>
  <td><?php echo $this->_tpl_vars['btn']; ?>
</td>
<?php endforeach; endif; unset($_from); ?>
</tr></table>
</td>
</table>
</div>
</td></tr>
<tr><td>
<table width=100% border=0 cellspacing=1 cellpadding=3 class=tbl>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td width=100 class=item align=right valign=top><?php echo $this->_tpl_vars['item']['label']; ?>
</td><td valign=top class=cell_edit><?php echo $this->_tpl_vars['item']['control']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</td></tr>
</table>
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
</form>