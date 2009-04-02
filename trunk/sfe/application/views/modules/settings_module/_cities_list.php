	<h4><?=lang('SETTINGS_CITIES')?></h4>
	<table class="regions-list">
	<tr>
	<td colspan="2">
		<?=form_radio('_cities_rid', 0, !$settings['_CITY_RID_'], 'id="_cities_rid_0"')?>
		<strong><?=form_label(lang('SETTINGS_ALL'), '_cities_rid_0')?></strong>
	</td>
	</tr>
	<?foreach($cities_list as $key=>$city) { ?>
	<?if(($key+1)%2===0) { ?>
		<td>
		<?=form_radio('_cities_rid', $city->rid, $city->rid==$settings['_CITY_RID_'], 'id="_cities_rid_'.$city->rid.'"')?>
		<?=form_label($city->name, '_cities_rid_'.$city->rid)?>
		</td>
		</tr>	
	<? } else { ?>
		<tr>
		<td>
		<?=form_radio('_cities_rid', $city->rid, $city->rid==$settings['_CITY_RID_'], 'id="_cities_rid_'.$city->rid.'"')?>
		<?=form_label($city->name, '_cities_rid_'.$city->rid)?>
		</td>
	<? } ?>
	
	<? } ?>
	</table>

