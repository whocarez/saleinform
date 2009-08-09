<script src="<?=base_url()?>public/js/jquery.ezpz_tooltip.min.js" type="text/javascript"></script>
<div class="tasks">
<h3><?=$title?></h3>

<? if(count($tasks)) { ?>
<table style="width:100%;" cellspacing="0" cellpadding="2" id="tasks_table">
<thead>
	<th><?=lang('DATE_TASK')?></th>
	<th><?=lang('DESCR_TASK')?></th>
	<th>&nbsp;</th>
</thead>
<tbody>
<? foreach($tasks as $task) { ?>
<tr style="background-color: <?=get_task_bkg($task->edate)?>;" id="task-<?=$task->rid?>">
	<td><?=date('d.m', strtotime($task->edate))?></td>
	<td>
		<?=character_limiter($task->descr, 32)?>
		<div id="task-tooltip-<?=$task->rid?>" class="tooltip">
			<b><?=lang('DATE_TASK')?>:</b> <?=$task->edate?><br>
			<b><?=lang('DESCR_TASK')?>:</b> <?=$task->descr?><br>
		</div>
		<script type="text/javascript">
			$("#task-<?=$task->rid?>").ezpz_tooltip({contentId:"task-tooltip-<?=$task->rid?>"});
		</script>
	</td>
	<td style="padding-right:10px;">
		<a href="javascript: if(confirm('<?=lang('CONFIRM_CLOSE_TASK')?>')) close_task(<?=$task->rid?>); void(0);" title="<?=lang('CLOSE_TASK')?>"><?=img('public/img/icons/accept_inline.gif')?></a>
	</td>
</tr>
<? } ?>
</tbody>
</table>
<span style="background-color: #FBE3E4;padding:3px;"><?=lang('OUTDATED')?></span>
<span style="background-color: #E6EFC2;padding:3px;"><?=lang('TOODAY')?></span>
<? } else { ?>
<?=lang('TASKS_EMPTY')?>
<? } ?>

<h3><?=lang('NEW_TASK')?></h3>
<?if(validation_errors() && isset($tasks_action)){?>
<div class="error">
	<?=validation_errors('<div>', '</div>');?>
</div>	
<?}?>
<?=form_open("tasks/create/go/mrid/".get_curririd(), array('id'=>'create_'.$orid, 'autocomplete'=>'off'))?>
<?=form_label(lang('DATE_TASK'), 'edate')?> <font color="red">*</font><br>
<?=form_input('edate', set_value('edate', ''), 'id="edate_task" class="text" readonly="readonly" style="width:90px;"')?>
<script type="text/javascript">
	$('#edate_task').datepick({showOn: 'button', yearRange: '-60:+0',
    buttonImageOnly: true, buttonImage: '<?=base_url()?>public/js/jquery.datapick.package-3.6.1/calendar.gif'});
</script>
<br>
<?=form_label(lang('DESCR_TASK'), 'descr')?> <font color="red">*</font><br>
<?=form_textarea('descr', set_value('descr', ''), 'id="descr_task" class="text" style="width:200px;height:30px;"')?>
<br>
<div class="column span-24 last">
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit_tasks" name="submit" onclick="return add_task();">
</div>
<?=form_close()?>
</div>
<script type="text/javascript">
function add_task(){
		var query_string = $('#create_<?=$orid?>').serialize();
		$.ajax({
			type:'POST',
			data:query_string,
			url:'<?=site_url("tasks/create/go/mrid/".get_curririd())?>',
			success: function(html){
				$('#tasks').html(html);
			}
		});
		return false;
}

function close_task(rid){
	$.ajax({
		type:'POST',
		data:{rid:rid},
		url:'<?=site_url("tasks/remove/go/mrid/".get_curririd())?>',
		success: function(html){
			$('#tasks').html(html);
		}
	});
	return false;
}
</script>
<?if(count($tasks)>5) { ?>
<script src="<?=base_url()?>public/js/jquery.scrollabletable.min.js" type="text/javascript"></script>
<script type="text/javascript">
$("#tasks_table").scrollable({tableHeight:200});
</script>
<? } ?>	