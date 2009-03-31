<div class="top_nav">
	<div class="navigator_container">
		<ul class="navigator_items">
			<li><?=anchor('help', '<span>'.lang('NAVLINE_HELP').'</span>')?></li>
			<?if(!$is_logged) { ?>
			<li class="navimember"><?=anchor('accounts/register', '<span>'.lang('NAVLINE_SIGNUP').'</span>')?></li>
			<li class="navimember"><?=anchor('accounts', '<span>'.lang('NAVLINE_LOGIN').'</span>')?></li>
			<? } else { ?>
			<li class="navimember"><?=anchor('accounts/logout', '<span>'.lang('NAVLINE_LOGOUT').'</span>')?></li>
			<? } ?>
			<li><?=anchor('settings', '<span>'.lang('NAVLINE_SETTINGS').'</span>')?></li>
			<li><?=anchor('clients', '<span>'.lang('NAVLINE_STORES').'</span>')?></li>
			<li class="navifirst"><?=anchor(index_page(), '<span>'.lang('NAVLINE_COMPARE').'</span>')?></li>
		</ul>
	</div>	
	<div class="logo">
		<?=anchor(index_page(), img(array('src'=>'images/logo.gif', 'alt'=>lang('NAVLINE_ALT'), 'border'=>'0')))?>
	</div>
</div>