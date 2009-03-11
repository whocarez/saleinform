	<div style="width:50%;float:left">
	<h4><?=lang('SETTINGS_REGIONS')?></h4>
	<table class="regions-list">
	<tr>
	<td colspan="2">
		<?=form_radio('_regions_rid', 0, !$settings['_REGION_RID_'], 'id="_regions_rid_0"')?>
		<strong><?=form_label(lang('SETTINGS_ALL'), '_regions_rid_0')?></strong>
	</td>
	</tr>
	<?foreach($regions_list as $key=>$region) { ?>
	<?if(($key+1)%2===0) { ?>
		<td>
		<?=form_radio('_regions_rid', $region->rid, $region->rid==$settings['_REGION_RID_'], 'id="_regions_rid_'.$region->rid.'"')?>
		<?=form_label($region->name, '_regions_rid_'.$region->rid)?>
		</td>
		</tr>	
	<? } else { ?>
		<tr>
		<td>
		<?=form_radio('_regions_rid', $region->rid, $region->rid==$settings['_REGION_RID_'], 'id="_regions_rid_'.$region->rid.'"')?>
		<?=form_label($region->name, '_regions_rid_'.$region->rid)?>
		</td>
	<? } ?>
	
	<? } ?>
	</table>
	<script type="text/javascript">
	$(document).ready(function(){
	$("input[name='_regions_rid']").change(function(){
		$.ajax({
			  type: "POST",
			  url: "settings/changeregion",
			  data: {'_regions_rid':$("input[name='_regions_rid']:checked").val()},
			  dataType:'html',
			  success: function(callback){
			    $('#cities_container').html(callback);
			  }
			});
	});});
	</script>
	</div>
