<?php /* Smarty version 2.6.10, created on 2007-04-24 15:18:48
         compiled from chooser/chooser.tpl */ ?>
<center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form id=<?php echo $this->_tpl_vars['name']; ?>
 name=<?php echo $this->_tpl_vars['name']; ?>
>
<table width=350 border=0 cellspacing=0 cellpadding=0 style="border:1 solid gray">
<tr><td>
<div id="<?php echo $this->_tpl_vars['name']; ?>
_toolbar">
<table width=100% cellspacing=0 cellpadding=3>
<tr>
<td align=left><h2><?php echo $this->_tpl_vars['title']; ?>
</h2>
</td>
</table>
</div>
</td></tr>
<tr><td>
<table width=100% border=0 cellspacing=1 cellpadding=5 class=tbl>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td width=100 class=item align=right valign=top nowrap="nowrap"><?php echo $this->_tpl_vars['item']['label']; ?>
</td><td width=250 valign=top class=cell_edit><?php echo $this->_tpl_vars['item']['control']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr><td colspan=2><?php echo $this->_tpl_vars['toolbar']['txt_err']; ?>
</td></tr>
<tr><td></td><td><?php echo $this->_tpl_vars['toolbar']['btn_submit']; ?>
</td></tr>
</table>
</td></tr>
</table>
</form>
</center>