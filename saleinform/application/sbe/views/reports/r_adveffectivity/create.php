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
	<?=form_label(lang('ADV_COMPANY'), 'company_name')?>
</div>
<div class="column span-21 last">
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', ''))?>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>
</div>
<? if(isset($ds) && $ds) { $num = 1; $total_cost = 0; $total_calls = 0; $total_demands = 0; $total_doxod = 0;?>
<div class="container" style="margin-top: 20px;">
<h5><?=$r_body_title?></h5>
	<table>
		<thead>
			<tr>
				<th>
					#
				</th>
				<th>
					<?=lang('ADV_NAME')?>
				</th>
				<th>
					<?=lang('ADV_TYPE')?>
				</th>
				<th>
					<?=lang('ADV_COST')?>
				</th>
				<th>
					<?=lang('ADV_CALLS_QUAN')?>
				</th>
				<th>
					<?=lang('ADV_DEMANDS_QUAN')?>
				</th>
				<th>
					<?=lang('ADV_DOXOD')?>
				</th>
			</tr>
		</thead>
		<?foreach($ds as $r) { $total_cost += $r['cost']; $total_calls += $r['calls_quan']; $total_demands += $r['demands_quan']; $total_doxod += $r['doxod'];?>
		<tr>
			<td>
				<?=$num?>
			</td>
			<td>
				<?=$r['adv_source_name']?>
			</td>
			<td>
				<?=$r['adv_type_name']?>
			</td>
			<td>
				<?=$r['cost']?>
			</td>
			<td>
				<?=$r['calls_quan']?>
			</td>
			<td>
				<?=$r['demands_quan']?>
			</td>
			<td>
				<?=$r['doxod']?>
			</td>
		</tr>
		<? $num++; } ?>
		<tr>
			<td colspan="3">	
				&nbsp;
			</td>
			<td style="font-weight: bold; background-color: #CCCCCC;">	
				<?=$total_cost?>
			</td>
			<td style="font-weight: bold; background-color: #CCCCCC;">
				<?=$total_calls?>
			</td>
			<td style="font-weight: bold; background-color: #CCCCCC;">
				<?=$total_demands?>
			</td>
			<td style="font-weight: bold; background-color: #CCCCCC;">
				<?=$total_doxod?>
			</td>
		</tr>
	</table>	
</div>
<? } ?>
