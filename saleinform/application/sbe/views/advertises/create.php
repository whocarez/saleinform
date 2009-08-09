<div class="grid">
<h3><?=$title?></h3>
<?= form_open(get_currcontroller()."/create/go/mrid/".get_curririd(), array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
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
<fieldset>	<legend><?=lang('DOCUMENT')?></legend>	<div class="column span-3">		<?=form_label(lang('DATE_DOC'), 'date_doc')?> <font color="red">*</font>	</div>	<div class="column span-21 last">		<?=form_input('date_doc', date_conv(set_value('date_doc', date('Y-m-d'))), 'id="date_doc" class="text" readonly="readonly" style="width:90px;"')?>		<script type="text/javascript">			$('#date_doc').datepick({showOn: 'button', yearRange: '-60:+60',			buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});		</script>	</div>	</fieldset><div class="column span-3">	<?=form_label(lang('BDATE'), 'bdate')?> <font color="red">*</font></div><div class="column span-9">	<?=form_input('bdate', date_conv(set_value('bdate', date('Y-m-d'))), 'id="bdate" class="text" readonly="readonly" style="width:90px;"')?>	<script type="text/javascript">		$('#bdate').datepick({showOn: 'button', yearRange: '-60:+60',		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});	</script></div><div class="column span-3">	<?=form_label(lang('EDATE'), 'edate')?> <font color="red">*</font></div><div class="column span-9 last">	<?=form_input('edate', date_conv(set_value('edate', date('Y-m-d'))), 'id="edate" class="text" readonly="readonly" style="width:90px;"')?>	<script type="text/javascript">		$('#edate').datepick({showOn: 'button', yearRange: '-60:+60',		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});	</script></div><div class="column span-3">	<?=form_label(lang('COMPANY'), 'company_name')?> <font color="red">*</font></div><div class="column span-9">
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', ''))?></div><div class="column span-3">	<?=form_label(lang('SOURCE'), 'source_name')?> <font color="red">*</font></div><div class="column span-9 last">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', ''))?></div>
<div class="column span-3">	<?=form_label(lang('SUM'), 'sum')?> <font color="red">*</font></div><div class="column span-9">	<?=form_input('sum', set_value('sum', '0.00'), 'id="sum" class="text" style="width:50px;"')?>
	<?=form_button('recalc', lang('RECALC'), 'id="recalc" class="button"')?></div><div class="column span-3">	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> <font color="red">*</font></div><div class="column span-9 last">	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', null), 'id="_currencies_rid" class="text"')?></div><div class="column span-24 last" id="rows_body"><?=$rows_body?>
</div><div class="column span-4">	<?=form_label(lang('DESCR'), 'descr')?></div>
<div class="column span-8">	<?=form_textarea('descr', set_value('descr', ''), 'id="descr" class="text" style="width:200px; height: 50px;"')?></div>
<div class="column span-4">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', ''), 'id="archive" class="text" ')?>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div><script type="text/javascript">$(document).ready(		function(){			$('#all_filials').click(function(){				if($('#all_filials').attr('checked')){					$('#rows_body').hide('slow');				} else $('#rows_body').show('slow');			});
			$('#recalc').click(function(){
				var dataStr = 'rows_action=recalc&'+$('#sum').val()+'&'+$("input[name='f_sum']").serialize()+'&'+$("input[name='_filials_rid']").serialize()+'&'+$("input[name='f_rid[]']").serialize()+'&'+$("input[name='row_sum[]']").serialize();
				if(confirm('<?=lang('CONFIRM_RECALC')?>')){
					$.ajax({
						type: "POST",
						url: "<?=site_url(get_currcontroller()."/recalc/go/mrid/".get_curririd())?>",
						data: dataStr,
						success: function(msg){
							$('#sum').val(msg);
						}
					});
					return true;
				}
				return false;
			});
		})	</script>