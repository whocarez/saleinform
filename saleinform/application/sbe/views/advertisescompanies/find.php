<div class="container findform"><?= form_open(get_currcontroller()."/find/go/mrid/".get_curririd(), array('id'=>'find_'.$orid, 'autocomplete'=>'off'))?><?=form_hidden('obj_rid', $orid)?><div class="column span-4">	<h6><?=lang('SEARCH_TITLE')?></h6></div><div class="column span-10 last">	<?=form_label(lang('COMPANY'), 'company_name')?>	<br>	<?=form_input('company_name', element('company_name', $search, ''), 'id="company_name" class="text"  style="width: 150px;"')?></div><div class="column span-10">	<?=form_label(lang('COMPANY_TYPE'), 'company_type')?>	<br>	<?=form_input('company_type', element('company_type', $search, ''), 'id="company_type" class="text"')?></div><?= form_close(); ?></div><div class="container" style="padding: 0px 0px 5px 0px; margin: 0px; text-align: right;">	<div class="column span-24 last">		<input type="button" value="<?=lang('GOFIND')?>" onclick="" class="button" id="find_submit" name="find_submit"> <input type="button" value="<?=lang('GOCLEAR')?>" onclick="" class="button"  id="find_reset" name="find_reset">	</div></div><script type="text/javascript">$(document).ready(		function(){			$('#find_submit').click(function(){$('#find_<?=$orid?>').submit();});			$('#find_reset').click(function(){					$('#company_name').val('');					$('#company_type').val('');					$('#find_<?=$orid?>').submit();				});		})	</script>
