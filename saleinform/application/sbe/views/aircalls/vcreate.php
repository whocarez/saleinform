<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vcreate/go/mrid/".get_curririd(), array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
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

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-3">
		<?=form_label(lang('DATE_DOC'), 'date_doc')?> <font color="red">*</font>
	</div>
	<div class="column span-21 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', date('Y-m-d'))), 'id="date_doc" class="text" readonly="readonly" style="width:90px;"')?>
		<script type="text/javascript">
			$('#date_doc').datepick({showOn: 'button', yearRange: '-60:+60',
			buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
		</script>
	</div>	
</fieldset>

<div class="column span-3">
	<?=form_label(lang('ADVERTISE_SHORT'), 'source_name')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', ''))?>
</div>

<div class="column span-3">
	<?=form_label(lang('L_NAME'), 'l_name')?>
</div>
<div class="column span-5 last">
	<?=form_input('l_name', set_value('l_name', ''), 'id="l_name" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('F_NAME'), 'f_name')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_input('f_name', set_value('f_name', ''), 'id="f_name" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-5 last">
	<?=form_input('s_name', set_value('s_name', ''), 'id="s_name" class="text" style="width:150px"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('PHONES'), 'phones')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_input('phones', set_value('phones', ''), 'id="phones" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-13 last">
	<?=form_input('email', set_value('email', ''), 'id="email" class="text" style="width:150px"')?>
</div>


<fieldset>
<legend><?=lang('AIR_DETAILS')?></legend>
<div class="column span-3">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', ''), 'id="_countries_rid" class="text" ')?>
</div>
<div class="column span-3">
	<?=form_label(lang('AIRCLASS'), 'air_class')?> <font color="red">*</font>
</div>
<div class="column span-9 last">
	<?=form_dropdown('air_class', get_airclasses(), set_value('air_class', ''), 'id="air_class" class="text" style="width:150px;"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('DATE_FROM'), 'date_from')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_input('date_from', date_conv(set_value('date_from', '')), 'id="date_from" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_from').datepick({showOn: 'button', yearRange: '-60:+60',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>	
<div class="column span-3">
	<?=form_label(lang('DATE_TO'), 'date_to')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_input('date_to', date_conv(set_value('date_to', '')), 'id="date_to" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_to').datepick({showOn: 'button', yearRange: '-60:+60',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>

<div class="column span-3">
	<?=form_label(lang('SUM_FROM'), 'sum_wanted_from')?>
</div>
<div class="column span-5">
	<?=form_input('sum_wanted_from', set_value('sum_wanted_from', ''), 'id="sum_wanted_from" class="text" style="width:90px;"')?>
</div>	
<div class="column span-3">
	<?=form_label(lang('SUM_TO'), 'sum_wanted_to')?> <font color="red">*</font>
</div>
<div class="column span-5">
	<?=form_input('sum_wanted_to', set_value('sum_wanted_to', ''), 'id="sum_wanted_to" class="text" style="width:90px;"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', ''), 'id="_currencies_rid" class="text" ')?>
</div>

<div class="column span-3">
	<?=form_label(lang('TOURISTS_QUAN'), 'tourists_quan')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
	<?=form_input('tourists_quan', set_value('tourists_quan', ''), 'id="tourists_quan" class="text" style="width: 40px;"')?>
</div>

</fieldset>

<div class="column span-4">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-8">
	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>