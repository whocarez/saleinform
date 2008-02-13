<?php /* Smarty version 2.6.10, created on 2008-01-03 22:07:53
         compiled from tabs.tpl */ ?>
<div id='Tabs_container' class='title'>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
	   <td style="padding-left:14px;" class="otherTabRight">&nbsp;</td>
		<!--<td style="padding-left:14px; border-bottom: 1px solid #999">&nbsp;</td>-->
   
	<?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tab']):
        $this->_foreach['tabloop']['iteration']++;
?>
     <td>
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
			<?php if ($this->_tpl_vars['tab']['current'] == 1): ?><td class="currentTabLeft"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
   		   <td class="currentTab" nowrap><a class="currentTabLink"  href="<?php echo $this->_tpl_vars['tab']['url']; ?>
"><?php echo $this->_tpl_vars['tab']['caption']; ?>
</A></td>
   			<td class="currentTabRight"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
   	   <?php else: ?>
   	     <?php if (($this->_foreach['tabloop']['iteration']-1) == 0): ?><td class="otherTabFirst"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
   	     <?php else: ?>
   	      <td class="otherTabLeft"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
   	     <?php endif; ?><td class="otherTab" nowrap><a   class="otherTabLink"  href="<?php echo $this->_tpl_vars['tab']['url']; ?>
"><?php echo $this->_tpl_vars['tab']['caption']; ?>
</A></td>
		      <td class="otherTabRight"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
   	   <?php endif; ?>
			</tr>
		</table>
     </td>
   <?php endforeach; endif; unset($_from); ?>
		
		<td width="100%" class="tabRow"><img src="../images/blank.gif" width="1" height="1" border="0" alt=""></td>
		<!--<td width="100%" style="border-bottom: 1px solid #999"><img src="../images/blank.gif" width="1" height="1" border="0" alt=""></td>-->
		
	</tr>

	</table>
</div>