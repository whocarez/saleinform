<?php /* Smarty version 2.6.10, created on 2009-03-29 23:06:39
         compiled from tabs.tpl */ ?>
<div class="block_tabs block_tabs">
    <ul class="tabs" name="<?php echo $this->_tpl_vars['tabs_Name']; ?>
">
    <?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabloop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabloop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tab']):
        $this->_foreach['tabloop']['iteration']++;
?>
        <?php if ($this->_tpl_vars['tab']['current'] == 1): ?>
        <li name="<?php echo $this->_tpl_vars['tab']['name']; ?>
" onclick="<?php echo $this->_tpl_vars['tab']['event']; ?>
" class="ActiveTab"><a href="<?php echo $this->_tpl_vars['tab']['url']; ?>
"><h2 class="listado"><?php echo $this->_tpl_vars['tab']['caption']; ?>
</h2></a></li>
        <?php else: ?>
        <?php if (($this->_foreach['tabloop']['iteration']-1) == 0): ?>
        <?php else: ?>
        <?php endif; ?>
        <li name="<?php echo $this->_tpl_vars['tab']['name']; ?>
" onclick="<?php echo $this->_tpl_vars['tab']['event']; ?>
" class="InactiveTab"><a href="<?php echo $this->_tpl_vars['tab']['url']; ?>
"><h2 class="listado"><?php echo $this->_tpl_vars['tab']['caption']; ?>
</h2></a></li>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
	</ul>	
    <div class="clear"></div>
</div>