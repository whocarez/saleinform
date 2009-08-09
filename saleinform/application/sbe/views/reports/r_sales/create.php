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

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>
</div>
<? if(isset($ds)) { ?>
<div class="container" style="margin-top: 20px;">
<h5><?=$r_body_title?></h5>
	<table>
		<thead>
			<tr>
				<th>
					<?=lang('FILIAL')?>
				</th>
				<th>
					<?=lang('DOC_NUM')?>
				</th>
				<th>
					<?=lang('DEMANDER')?>
				</th>
				<th>
					<?=lang('COUNTRY')?>
				</th>
				<th>
					<?=lang('TOUROPERATOR')?>
				</th>
				<th>
					<?=lang('SUM_TOUR')?>
				</th>
				<th>
					<?=lang('TOURISTS_QUAN')?>
				</th>
				<th>
					<?=lang('PAYED')?>
				</th>
				<th>
					<?=lang('EMP_NAME')?>
				</th>
			</tr>
		</thead>
		<? $curr_f_rid = null; 
		$total_tourists = $total_sum = 0;  
		$f_tourists = $f_sum = 0;
		foreach($ds as $r) { $total_tourists += $r->tourists_quan; $total_sum += $r->sum;?>
		<? if($r->_filials_rid!=$curr_f_rid && $curr_f_rid) { ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$f_sum?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$f_tourists?>				
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
		</tr>
		<? 
			$f_tourists = 0;
			$f_sum = 0;
		}  else {
			$f_tourists += $r->tourists_quan;
			$f_sum += $r->sum;
		}?>
		<tr>
			<td>
				<? if($r->_filials_rid!=$curr_f_rid){
						$curr_f_rid = $r->_filials_rid;
						$f_tourists = $r->tourists_quan;
						$f_sum = $r->sum;
						echo $r->filial_name;
					} else echo ''?>
			</td>
			<td>
				<?=$r->doc_rid?>
			</td>
			<td>
				<?=$r->demander?>
			</td>
			<td>
				<?=$r->country_name?>
			</td>
			<td>
				<?=$r->stouroperator_name?>
			</td>
			<td>
				<?=$r->sum?>
			</td>
			<td>
				<?=$r->tourists_quan?>
			</td>
			<td>
				<?=ROUND(($r->oborot > 0)?($r->oborot*100/$r->sum):0, 2)?>
			</td>
			<td>
				<?=$r->emp_name?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$f_sum?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$f_tourists?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
		</tr>

		<tr style="background-color: #cccccc;">
			<td>
				<?=lang('RES');?>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$total_sum?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
				<?=$total_tourists?>
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
			<td style="border-top: 1px solid #000000;font-weight: bold;">
			</td>
		</tr>
		
	</table>	
</div>
<? } ?>
