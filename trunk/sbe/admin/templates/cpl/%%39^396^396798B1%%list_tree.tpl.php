<?php /* Smarty version 2.6.10, created on 2009-03-31 00:17:43
         compiled from list_tree.tpl */ ?>
<form id='<?php echo $this->_tpl_vars['name']; ?>
' name='<?php echo $this->_tpl_vars['name']; ?>
' onclick="SetActiveForm('<?php echo $this->_tpl_vars['name']; ?>
')" class='inactive_form'>
<table width=100% border=0 cellspacing=0 cellpadding=0 >
<tr><td width=0% class=title style="height:25px; padding-left:5px"><?php echo $this->_tpl_vars['title']; ?>
</td></tr>
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_toolbar">
<table width=100% cellspacing=0 cellpadding=1 class=tbl_toolbar>
<tr>
<td style="font-size: 12px; font-family:Arial; border-bottom:1px solid silver" colspan=2>
<?php echo $this->_tpl_vars['parents_links']; ?>

</td>
</tr>
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
<?php if ($this->_tpl_vars['navbar']): ?>
<table cellspacing=2 cellpadding=1><tr>
<td><?php echo $this->_tpl_vars['navbar']['btn_first']; ?>
</td><td><?php echo $this->_tpl_vars['navbar']['btn_prev']; ?>
</td><td class="nav_b">
<input type='text' class='nav' value='<?php echo $this->_tpl_vars['navbar']['curPage']; ?>
 of <?php echo $this->_tpl_vars['navbar']['totalPage']; ?>
' onkeypress="return navKeyPress(this, event);">
</td><td><?php echo $this->_tpl_vars['navbar']['btn_next']; ?>
</td><td><?php echo $this->_tpl_vars['navbar']['btn_last']; ?>
</td>
</tr></table>
<?php endif; ?>
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