<?php /* Smarty version 2.6.10, created on 2007-04-24 13:36:07
         compiled from tree.tpl */ ?>
<form id=<?php echo $this->_tpl_vars['name']; ?>
 name=<?php echo $this->_tpl_vars['name']; ?>
 style="margin:0" onclick="SetActiveForm('<?php echo $this->_tpl_vars['name']; ?>
')" class='inactive_form'>
<table width=200 border=0 cellspacing=0 cellpadding=0>
<tr><td width=0% class=title><?php echo $this->_tpl_vars['title']; ?>
</td></tr>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_toolbar">
<table width=100% cellspacing=0 cellpadding=1 class=tbl_title>
<tr>
<td width=50% align=left>
<table cellspacing=2 cellpadding=0><tr>
<?php $_from = $this->_tpl_vars['toolbar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['btn']):
?>
  <td><?php echo $this->_tpl_vars['btn']; ?>
</td>
<?php endforeach; endif; unset($_from); ?>
</tr></table>
</td>
<td width=50% align=right>
<table cellspacing=2 cellpadding=1><tr>
<td></td><td class="nav_w"></td><td></td>
</tr></table>
</td>
</table>
</div>
</td></tr>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_data">
<?php echo $this->_tpl_vars['block']; ?>

</div>
</td></tr>
</table>
</form>