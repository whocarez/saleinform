<div class="top_nav">
	<div class="navigator_container">
		<ul  class="navigator_items">
			<li><?=anchor('help', '<span>'.lang('SEARCH_MODULE_HEAD_HELP_TAB').'</span>')?></li>
			<?if(!$is_logged) { ?>
			<li class="navimember"><?=anchor('accounts/register', '<span>'.lang('SEARCH_MODULE_HEAD_SUGNUP_TAB').'</span>')?></li>
			<li class="navimember"><?=anchor('accounts', '<span>'.lang('SEARCH_MODULE_HEAD_LOGIN_TAB').'</span>')?></li>
			<? } else { ?>
			<li class="navimember"><?=anchor('accounts/logout', '<span>'.lang('SEARCH_MODULE_HEAD_LOGOUT_TAB').'</span>')?></li>
			<? } ?>
			<li><?=anchor('settings', '<span>'.lang('SEARCH_MODULE_HEAD_SETTINGS_TAB').'</span>')?></li>
			<li><?=anchor('clients', '<span>'.lang('SEARCH_MODULE_HEAD_SHOPS_TAB').'</span>')?></li>
			<li class="navifirst"><?=anchor(index_page(), '<span>'.lang('SEARCH_MODULE_HEAD_MAIN_TAB').'</span>')?></li>
		</ul>
	</div>	
	<div class="logo">
		<?=anchor(base_url(), img(array('src'=>'images/logo.gif', 'title'=>lang('SEARCH_MODULE_LOGO_TITLE'), 'border'=>'0')))?>
	</div>
</div>

<div class="zs">
        <div class="home-top-left"></div>
        <div class="home-top-right"></div>
		<div class="home-slogan">  </div>
	<div class="fq2">
	<h4><?=lang('SEARCH_MODULE_BAR_TITLE')?></h4>
	<?php echo form_open('search', array('id'=>"searchForm", 'name'=>"searchForm", 'onSubmit'=>"buildAction()"))?>
		<input id="searchString" name="searchString" class="mainQ" value="" type="text" maxlength="32" >
		<input id="sb" class="searchSubmit" value="<?=lang('SEARCH_MODULE_BTN_VALUE')?>" type="submit" >
		<br>
	<?php echo form_close();?>		
	</div>
</div>

