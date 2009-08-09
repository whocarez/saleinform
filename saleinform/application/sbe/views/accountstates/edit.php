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

<div class="column span-4">	<?=form_label(lang('CODE'), 'code')?> <font color="red">*</font></div><div class="column span-8">	<?=form_input('code', set_value('code', $ds->code), 'id="code" class="text"  style="width:60px;"')?></div><div class="column span-4">	<?=form_label(lang('NAME'), 'state_name')?> <font color="red">*</font></div><div class="column span-8 last">	<?=form_input('state_name', set_value('state_name', $ds->state_name), 'id="state_name" class="text" ')?></div><div class="column span-4">	<?=form_label(lang('TYPE'), 'koef')?> <font color="red">*</font></div><div class="column span-20 last">	<?=form_dropdown('koef', get_koef_list(), set_value('koef', $ds->koef), 'id="koef" class="text" ')?></div>
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