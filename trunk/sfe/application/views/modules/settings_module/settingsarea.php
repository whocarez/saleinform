<div class="settings-box"><h3><?=lang('SETTINGS_BOXTITLE')?></h3><table class="settings-table">	<tr>		<td width="100%" class="label">			<span><?=lang('SETTINGS_COUNTRIES')?></span>		</td>		<td>			<strong><?=$settings['_COUNTRY_NAME_'];?></strong>		</td>	</tr>	<tr>		<td width="100%"  class="label">			<span><?=lang('SETTINGS_REGIONS')?></span>		</td>		<td>			<strong><?=$settings['_REGION_NAME_'];?></strong>		</td>	</tr>	<tr>		<td width="100%"  class="label">			<span><?=lang('SETTINGS_CITIES')?></span>		</td>		<td>			<strong><?=$settings['_CITY_NAME_'];?></strong>		</td>	</tr></table><br><h3><?=lang('SETTINGS_CURRENCIES')?></h3><table class="settings-table">	<tr>		<td width="100%"  class="label">			<span><?=lang('SETTINGS_MAIN_CURR')?></span>		</td>		<td>			<strong><?=$settings['_MAIN_CURR_COD_'];?></strong>		</td>	</tr>	<tr>		<td width="100%"  class="label">			<span><?=lang('SETTINGS_ADD_CURR')?></span>		</td>		<td>			<strong><?=$settings['_ADD_CURR_COD_'];?></strong>		</td>	</tr></table><br><h3><?=lang('SETTINGS__COURCES')?></h3><table class="settings-table">	<? foreach($officialcources as $item) { ?>	<tr>		<td width="100%"  class="label">			<span><?=$item['currencyCOD']?></span>		</td>		<td>			<b><?=ROUND($item['courceRATE'], 3)?></b>		</td>	</tr>	<? } ?></table><br><?=anchor('settings', lang('SETTINGS_GOSET'))?></div>
