<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/vedit/{$rid}/mrid/".get_curririd(), array('id'=>'edit_'.$orid, 'autocomplete'=>'off'))?>
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

<fieldset>
	<legend><?=lang('DOCUMENT')?></legend>
	<div class="column span-3">
		<?=form_label('Id', 'rid')?>
	</div>
	<div class="column span-9">
		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text" readonly="readonly" style="width:90px;"')?>
	</div>
	<div class="column span-3">
		<?=form_label(lang('DATE_DOC'), 'date_doc')?> <font color="red">*</font>
	</div>
	<div class="column span-9 last">
		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text" readonly="readonly" style="width:90px;"')?>
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
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', $ds->_advertisessources_rid))?>
</div>

<div class="column span-3">
	<?=form_label(lang('L_NAME'), 'l_name')?>
</div>
<div class="column span-5 last">
	<?=form_input('l_name', set_value('l_name', $ds->l_name), 'id="l_name" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('F_NAME'), 'f_name')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_input('f_name', set_value('f_name', $ds->f_name), 'id="f_name" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('S_NAME'), 's_name')?>
</div>
<div class="column span-5 last">
	<?=form_input('s_name', set_value('s_name', $ds->s_name), 'id="s_name" class="text" style="width:150px"')?>
</div>

<div class="column span-3">
	<?=form_label(lang('PHONES'), 'phones')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_input('phones', set_value('phones', $ds->phones), 'id="phones" class="text" style="width:150px"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('EMAIL'), 'email')?>
</div>
<div class="column span-13 last">
	<?=form_input('email', set_value('email', $ds->email), 'id="email" class="text" style="width:150px"')?>
</div>


<fieldset>
<legend><?=lang('TOUR_DETAILS')?></legend>
<div class="column span-3">
	<?=form_label(lang('COUNTRY'), '_countries_rid')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_dropdown('_countries_rid', get_countries_list(), set_value('_countries_rid', $ds->_countries_rid), 'id="_countries_rid" class="text" ')?>
</div>

<div class="column span-3">
	<?=form_label(lang('CUROURT'), 'curourt_name')?>
</div>
<div class="column span-9">
	<?=get_curourts_vp(set_value('_curourts_rid', $ds->_curourts_rid))?>
</div>
<div class="column span-3">
	<?=form_label(lang('DATE_FROM'), 'date_from')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_input('date_from', date_conv(set_value('date_from', $ds->date_from)), 'id="date_from" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_from').datepick({showOn: 'button', yearRange: '-60:+60',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>	
<div class="column span-3">
	<?=form_label(lang('DATE_TO'), 'date_to')?> <font color="red">*</font>
</div>
<div class="column span-9">
	<?=form_input('date_to', date_conv(set_value('date_to', $ds->date_to)), 'id="date_to" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_to').datepick({showOn: 'button', yearRange: '-60:+60',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>

<div class="column span-3">
	<?=form_label(lang('HOTELCAT'), '_hotelscats_rid')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
	<? foreach(get_hotelscats() as $cat) {?>
	<?=form_checkbox('_hotelscats_rid[]', $cat->rid, $this->input->post('_hotelscats_rid')?in_array($cat->rid, $this->input->post('_hotelscats_rid')):in_array($cat->rid, $sub_ds), 'id="_hotelscats_rid[]"')?> <?=$cat->hotelcat_name?><br>
	<? } ?>
</div>	

<div class="column span-3">
	<?=form_label(lang('SUM_FROM'), 'sum_wanted_from')?>
</div>
<div class="column span-5">
	<?=form_input('sum_wanted_from', set_value('sum_wanted_from', $ds->sum_wanted_from), 'id="sum_wanted_from" class="text" style="width:90px;"')?>
</div>	
<div class="column span-3">
	<?=form_label(lang('SUM_TO'), 'sum_wanted_to')?> <font color="red">*</font>
</div>
<div class="column span-5">
	<?=form_input('sum_wanted_to', set_value('sum_wanted_to', $ds->sum_wanted_to), 'id="sum_wanted_to" class="text" style="width:90px;"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> <font color="red">*</font>
</div>
<div class="column span-5 last">
	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" class="text" ')?>
</div>

<div class="column span-3">
	<?=form_label(lang('TOURISTS_QUAN'), 'tourists_quan')?> <font color="red">*</font>
</div>
<div class="column span-21 last">
	<?=form_input('tourists_quan', set_value('tourists_quan', $ds->tourists_quan), 'id="tourists_quan" class="text" style="width: 40px;"')?>
</div>

</fieldset>

<fieldset>
<legend><?=lang('TALK')?></legend>
<div class="column span-5">
	<?=form_label(lang('TOURISTS_WISH'), 'tourists_wish')?> <font color="red">*</font>
</div>
<div class="column span-19 last">
	<?=form_textarea('tourists_wish', set_value('tourists_wish', $ds->tourists_wish), 'id="tourists_wish" class="text" style="width: 400px; height:60px;"')?>
</div>
<div class="column span-5">
	<?=form_label(lang('TOURISTS_OFFERS'), 'tourists_offers')?> <font color="red">*</font>
</div>
<div class="column span-19 last">
	<?=form_textarea('tourists_offers', set_value('tourists_offers', $ds->tourists_offers), 'id="tourists_offers" class="text" style="width: 400px; height:60px;"')?>
</div>
<div class="column span-5">
	<?=form_label(lang('TOURISTS_ANSWERS'), 'tourists_answers')?> <font color="red">*</font>
</div>
<div class="column span-19 last">
	<?=form_textarea('tourists_answers', set_value('tourists_answers', $ds->tourists_answers), 'id="tourists_answers" class="text" style="width: 400px; height:60px;"')?>
</div>

</fieldset>

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
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/vjournal/go/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
	<button onclick="joinToParent('<?=$ds->$jtp['val']?>', '<?=$ds->$jtp['scr']?>')" class="button"><?=lang('SELECT')?></button>
</div>

<?= form_close(); ?>

</div>
<script type="text/javascript">
function joinToParent(val, scr){
	$("input[name='<?=$jtp['val_p']?>']", window.opener.document).val(val);
	$('#<?=$jtp['scr_p']?>', window.opener.document).val(scr);
	this.close();
	return;
}	
</script>