<div class="grid">
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

<div class="column span-4">
	<?=form_label(lang('POSITION'), '_positions_rid')?> <font color="red">*</font>
</div>
<div class="column span-8">
	<?=form_dropdown('_positions_rid', get_positions_list(), set_value('_positions_rid', $ds->_positions_rid), 'id="_positions_rid" class="text" ')?>
</div>
<div class="column span-4">
	<?=form_label(lang('MENU_ITEM'), '_menu_items_rid')?> <font color="red">*</font>
</div>
<div class="column span-8 last">
	<?=form_dropdown('_menu_items_rid', get_menuitems_list(), set_value('_menu_items_rid', $ds->_menu_items_rid), 'id="_menu_items_rid" class="text" style="width:150px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('PARENT'), 'parent')?>
</div>
<div class="column span-20 last" id="menu_tree">
	<?=build_tree_dropdown(set_value('_positions_rid', $ds->_positions_rid), $ds->parent)?>
</div>
<div class="column span-4">
	<?=form_label(lang('AREA'), 'item_area')?> <font color="red">*</font>
</div>
<div class="column span-20 last">
	<?=form_dropdown('item_area', get_areas(), set_value('item_area', $ds->item_area), 'id="item_area" class="text" ')?>
</div>
<fieldset>
	<legend><?=lang('RIGHTS')?> <font color="red">*</font></legend>
	<?=form_checkbox('item_rights[]', 'N', set_value('item_rights[]', in_array('N', explode('|', $ds->item_rights))?'N':'')=='N', 'id="item_rights"')?> <?=lang('R_N')?><br>
	<?=form_checkbox('item_rights[]', 'E', set_value('item_rights[]', in_array('E', explode('|', $ds->item_rights))?'E':'')=='E', 'id="item_rights"')?> <?=lang('R_E')?><br>
	<?=form_checkbox('item_rights[]', 'D', set_value('item_rights[]', in_array('D', explode('|', $ds->item_rights))?'D':'')=='D', 'id="item_rights"')?> <?=lang('R_D')?><br>
	<?=form_checkbox('item_rights[]', 'R', set_value('item_rights[]', in_array('R', explode('|', $ds->item_rights))?'R':'')=='R', 'id="item_rights"')?> <?=lang('R_R')?><br>
	<?=form_checkbox('item_rights[]', 'M', set_value('item_rights[]', in_array('M', explode('|', $ds->item_rights))?'M':'')=='M', 'id="item_rights"')?> <?=lang('R_M')?><br>
	<?=form_checkbox('item_rights[]', 'A', set_value('item_rights[]', in_array('A', explode('|', $ds->item_rights))?'A':'')=='A', 'id="item_rights"')?> <?=lang('R_A')?><br>	
</fieldset>

<div class="column span-4">
	<?=form_label(lang('ORDER'), 'item_order')?>
</div>
<div class="column span-8">
	<?=form_input('item_order', set_value('item_order', $ds->item_order), 'id="item_order" class="text" style="width: 40px;"')?>
</div>
<div class="column span-4">
	<?=form_label(lang('HIDDEN'), 'hidden')?>
</div>
<div class="column span-8 last">
	<?=form_dropdown('hidden', array('0'=>lang('NO'), '1'=>lang('YES')), set_value('hidden', $ds->hidden), 'id="hidden" class="text" ')?>
</div>


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
	<input type="submit" value="<?=lang('SAVE')?>" class="button" id="submit" name="submit"> <input type="reset" value="<?=lang('CANCEL')?>" class="button" onclick="window.location='<?=site_url(get_currcontroller().'/mrid/'.get_curririd()) ?>';" id="reset" name="reset">
</div>

<?= form_close(); ?>

</div>