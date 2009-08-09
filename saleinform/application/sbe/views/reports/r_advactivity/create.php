<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/run/go/mrid/".get_curririd(), array('id'=>'run_'.$orid, 'autocomplete'=>'off'))?>
<div class="container editform">
<?if(validation_errors()){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<div class="column span-3">
	<?=form_label(lang('DATE_REPORT_FROM'), 'date_report_from')?> <font color="red">*</font>
</div>
<div class="column span-21">
	<?=form_input('date_report_from', set_value('date_report_from', ''), 'id="date_report_from" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_report_from').datepick({showOn: 'button', yearRange: '-60:+0',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>
<div class="column span-3">
	<?=form_label(lang('DATE_REPORT_TO'), 'date_report_to')?> <font color="red">*</font>
</div>
<div class="column span-21">
	<?=form_input('date_report_to', set_value('date_report_to', ''), 'id="date_report_to" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#date_report_to').datepick({showOn: 'button', yearRange: '-60:+0',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>
<div class="column span-3">
	<?=form_label(lang('FILIAL'), 'filial_name')?>
</div>
<div class="column span-21 last">
	<?=get_filials_vp(set_value('_filials_rid', null), '_filials_rid', 'filial_name', False)?>
</div>

<div class="column span-3">
	<?=form_label(lang('ADV_COMPANY'), 'company_name')?>
</div>
<div class="column span-21 last">
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', null), '_advertisescompanies_rid', 'company_name', False)?>
</div>

<div class="column span-24 last">
	<b><?=lang('BY_SLICE')?></b><br>
	<?=form_radio('by_slice', 'type', True)?><?=lang('BY_TYPES')?><br>
	<?=form_radio('by_slice', 'name', false)?><?=lang('BY_NAMES')?><br>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>
</div>
<? if(isset($report) && $report) { $index = 1;?>
<div class="container" style="margin-top: 20px;">
<h5><?=$r_body_title?></h5>
	<table>
		<thead>
			<tr>
				<th>
					#
				</th>
				<?if($by_slice!=='type') { ?>
				<th>
					<?=lang('ADV_SOURCE_NAME')?>
				</th>
				<? } ?>
				<th>
					<?=lang('ADV_SOURCE_TYPE')?>
				</th>
				<th>
					<?=lang('ACTIVITY_QUAN')?>
				</th>
			</tr>
		</thead>
		<?foreach($ds as $r) { ?>
		<tr>
			<td>
				<?=$index?>
			</td>
			<?if($by_slice!=='type') { ?>
			<td>
				<?=$r->adv_source_name?>
			</td>
			<? } ?>
			<td>
				<?=$r->adv_type_name?>
			</td>
			<td>
				<?=$r->quan?>
			</td>
		</tr>
		<? $index++;} ?>
	</table>
</div>
<? } ?>

<? if(isset($report_error)) { ?>
<div class="notice" style="margin-top:20px;">
	<div><?=$report_error?></div>
</div>
<? } ?>
