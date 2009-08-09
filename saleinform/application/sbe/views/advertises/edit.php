<div class="grid">
<script src="<?=base_url()?>public/js/ajaxupload.3.5.js" type="text/javascript"></script>
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
<fieldset>	<legend><?=lang('DOCUMENT')?></legend>	<div class="column span-3">		<?=form_label('Id', 'rid')?>	</div>	<div class="column span-9">		<?=form_input('rid', set_value('rid', $ds->rid), 'id="rid" class="text" readonly="readonly" style="width:90px;"')?>	</div>	<div class="column span-3">		<?=form_label(lang('DATE_DOC'), 'date_doc')?> <font color="red">*</font>	</div>	<div class="column span-9 last">		<?=form_input('date_doc', date_conv(set_value('date_doc', $ds->date_doc)), 'id="date_doc" class="text" readonly="readonly" style="width:90px;"')?>		<script type="text/javascript">			$('#date_doc').datepick({showOn: 'button', yearRange: '-60:+60',			buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});		</script>	</div>	</fieldset>
<div class="column span-3">	<?=form_label(lang('BDATE'), 'bdate')?> <font color="red">*</font></div><div class="column span-9">	<?=form_input('bdate', date_conv(set_value('bdate', $ds->bdate)), 'id="bdate" class="text" readonly="readonly" style="width:90px;"')?>	<script type="text/javascript">		$('#bdate').datepick({showOn: 'button', yearRange: '-60:+60',		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});	</script></div><div class="column span-3">	<?=form_label(lang('EDATE'), 'edate')?> <font color="red">*</font></div><div class="column span-9 last">	<?=form_input('edate', date_conv(set_value('edate', $ds->edate)), 'id="edate" class="text" readonly="readonly" style="width:90px;"')?>	<script type="text/javascript">		$('#edate').datepick({showOn: 'button', yearRange: '-60:+60',		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});	</script></div><div class="column span-3">	<?=form_label(lang('COMPANY'), 'company_name')?> <font color="red">*</font></div><div class="column span-9">
	<?=get_advertisescompanies_vp(set_value('_advertisescompanies_rid', $ds->_advertisescompanies_rid))?></div><div class="column span-3">	<?=form_label(lang('SOURCE'), 'source_name')?> <font color="red">*</font></div><div class="column span-9 last">
	<?=get_advertisessources_vp(set_value('_advertisessources_rid', $ds->_advertisessources_rid))?></div><div class="column span-3">	<?=form_label(lang('SUM'), 'sum')?> <font color="red">*</font></div><div class="column span-9">	<?=form_input('sum', set_value('sum', $ds->sum), 'id="sum" class="text" style="width:50px;"')?>
	<?=form_button('recalc', lang('RECALC'), 'id="recalc" class="button"')?></div><div class="column span-3">	<?=form_label(lang('CURRENCY'), '_currencies_rid')?> <font color="red">*</font></div><div class="column span-9 last">	<?=form_dropdown('_currencies_rid', get_currencies(), set_value('_currencies_rid', $ds->_currencies_rid), 'id="_currencies_rid" class="text"')?></div><div class="column span-24 last"  id="rows_body">
<?=$rows_body?>
</div>

<fieldset>
<legend><?=lang('FINANCIAL_INFO')?></legend>
<div class="column span-3">
	<?=form_label(lang('ORDER_SUM'), 'order_sum')?>
</div>
<div class="column span-9">
	<?=form_input('order_sum', set_value('order_sum', $ds->order_sum), 'id="order_sum" class="text" style="width:90px;"')?>
</div>	

<div class="column span-3">
	<?=form_label(lang('ORDER_NUM'), 'order_num')?>
</div>
<div class="column span-9 last">
	<?=form_input('order_num', set_value('order_num', $ds->order_num), 'id="order_num" class="text" style="width:90px;"')?>
</div>	

<div class="column span-3">
	<?=form_label(lang('ORDER_DATE'), 'order_date')?>
</div>
<div class="column span-21 last">
	<?=form_input('order_date', date_conv(set_value('order_date', $ds->order_date)), 'id="order_date" class="text" readonly="readonly" style="width:90px;"')?>
	<script type="text/javascript">
		$('#order_date').datepick({showOn: 'button', yearRange: '-60:+60',
		buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
	</script>
</div>	
	<?=get_doc_balance($ds->rid)?>
	<?=anchor_popup(site_url('finjournal/journal/'.$ds->rid.'/mrid/'.get_irid_bycname('finjournal')), lang('SHOW_FIN_OPERS'), array('title'=>lang('SHOW_FIN_OPERS'), 'id'=>"sbtn_cities_rid",  'name'=>"sbtn_clients_rid",  'width'=>'950', 'height'=>'600'))?>
</fieldset>

<fieldset>
<legend><?=lang('ATTACHES')?></legend>
<div class="column span-12">
	<?=lang('UPLOAD_DESCR')?><br>
	<?=form_input('upload_descr', '', 'id="upload_descr" class="text" style="width:300px;"')?><br>
	<?=form_button('upload_btn', lang('UPLOAD'), 'class="button" id="upload_btn" style=""')?>
</div>
<div class="column span-12  last" id="attaches">
	<?=$attaches?>
</div>
</fieldset>

<div class="column span-3">
	<?=form_label(lang('DESCR'), 'descr')?>
</div>
<div class="column span-9">
	<?=form_textarea('descr', set_value('descr', $ds->descr), 'id="descr" class="text" style="width:300px; height: 50px;"')?>
</div>
<div class="column span-3">
	<?=form_label(lang('ARCHIVE'), 'archive')?>
</div>
<div class="column span-9 last">
	<?=form_dropdown('archive', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('archive', $ds->archive), 'id="archive" class="text"')?>
</div>

</div>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>
<script type="text/javascript">
function attach_remove(rid){
	$.ajax({
		type:'POST',
		url: '<?=site_url(get_currcontroller()."/removeattach/go/mrid/".get_curririd())?>',
		data:{rid:rid, doc_rid:"<?=$ds->rid?>"},
		success: function(html){
			$('#attaches').html(html);
			return;
		}
	});
}
$(document).ready(
		function(){
			$('#all_filials').click(function(){
				if($('#all_filials').attr('checked')){
					$('#rows_body').hide('slow');
				} else $('#rows_body').show('slow');
			});
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
			new AjaxUpload('upload_btn', {
				action: '<?=site_url(get_currcontroller()."/addattach/go/mrid/".get_curririd())?>',
				onSubmit: function() {
					this.setData({_documents_rid : "<?=$ds->rid?>", upload_descr:$('#upload_descr').val()});
				},
				onComplete: function(file, response) {
					$('#attaches').html(response);
					return;
				}
			});
		}
)	
</script>
