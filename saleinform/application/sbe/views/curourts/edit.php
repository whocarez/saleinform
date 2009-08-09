<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/edit/{$rid}/mrid/".get_curririd(), array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?=form_hidden('rid', $rid)?>
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?if($success===False){?>
<div class="error">
	<?=lang('SAVE_SYSTEM_ERROR')?>
</div>
<?}?>
<?if($success===True){?>
<div class="success">
	<?=lang('SAVE_SYSTEM_SUCCESS')?>
</div>
<?}?>

<div class="column span-4">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('NAME'), 'curourt_name')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_input('curourt_name', set_value('curourt_name', $ds->curourt_name), 'id="curourt_name" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('NAME_LAT'), 'curourt_name_lat')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_input('curourt_name_lat', set_value('curourt_name_lat', $ds->curourt_name_lat), 'id="curourt_name_lat" class="text" ')?>
</div>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>