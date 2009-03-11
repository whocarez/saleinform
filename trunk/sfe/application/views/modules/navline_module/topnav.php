<div class="top_nav">
	<div class="navigator_container">
		<ul class="simple_items">
			<li>
				<?=anchor('help', '<span>'.lang('NAVLINE_HELP').'</span>')?>
			</li>
			<li>
				<?if(!$is_logged) { ?>
				<?=anchor('accounts', '<span>'.lang('NAVLINE_LOGIN').'</span>')?>
				<? } else { ?>
				<?=anchor('accounts/logout', '<span>'.lang('NAVLINE_LOGOUT').'</span>')?>
				<? } ?>
			</li>
			<li>
				<?=anchor('settings', '<span>'.lang('NAVLINE_SETTINGS').'</span>')?>
			</li>
		</ul>
	</div>	
	<div class="logo">
		<a target="_self" title="${_(u'Сравнение цен интернет магазинов, поиск товаров')}" href="/">
			<?=anchor(index_page(), img(array('src'=>'images/logo.gif', 'alt'=>lang('NAVLINE_ALT'), 'border'=>'0')))?>
		</a>
	</div>
</div>