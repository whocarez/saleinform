<div class="grid">
<h3><?=$title?></h3>
<div class="container editform">
<div class="column span-4">	<?=form_label(lang('COMPANY'), 'company_name')?></div><div class="column span-8 last">	<?=form_input('company_name', set_value('company_name', $ds->company_name), 'id="company_name" class="text" readonly="readonly"  style="width: 150px;"')?></div><div class="column span-4">	<?=form_label(lang('COMPANY_TYPE'), 'company_type')?></div><div class="column span-8 last">	<?=form_dropdown('company_type', get_advcompaniestypes_list(), set_value('company_type', $ds->company_type), 'id="company_type" class="text"  readonly="readonly"')?></div>
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