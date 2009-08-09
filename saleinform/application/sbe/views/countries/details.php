<div class="grid">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">	<?=form_label(lang('CODE'), 'country_code')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_input('country_code', set_value('country_code', $ds->country_code), 'id="country_code" class="text" style="width: 60px;" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('NAME'), 'country_name')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('country_name', set_value('country_name', $ds->country_name), 'id="country_name" class="text" readonly="readonly"')?></div><div class="column span-4">	<?=form_label(lang('NAME_LAT'), 'country_name_lat')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('country_name_lat', set_value('country_name_lat', $ds->country_name_lat), 'id="country_name_lat" class="text" readonly="readonly"')?></div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" readonly="readonly" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" readonly="readonly"')?>
</div>

</div>
<div class="column span-24 last">
	<input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

</div>