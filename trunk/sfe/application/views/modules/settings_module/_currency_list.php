	<div class="setsettings-currency">
		<?=form_label('<b>'.lang('SETTINGS_MAIN_CURR').'</b>', 'main_currency_rid')?>:
		<?=$settings['_MAIN_CURR_NAME_']?><br>
		<?=form_label('<b>'.lang('SETTINGS_ADD_CURR').'</b>', 'add_currency_rid')?>:
		<ul class="setsettings-countries">		<?foreach($currencies_list as $key=>$currency) { if($currency->rid==$settings['_MAIN_CURR_RID_']) continue;?>
		<li>
		<?=form_radio('_currency_rid', $currency->rid, (!$key)?True:($currency->rid==$settings['_ADD_CURR_RID_']), 'id="_currency_rid_'.$currency->rid.'"')?>
		<?=form_label($currency->name, '_currency_rid_'.$currency->rid)?>
		</li>
		<? } ?>
		</ul>
	</div>