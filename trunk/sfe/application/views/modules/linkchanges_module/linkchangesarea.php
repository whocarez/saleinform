<?php if($linkschange_list) {?>				
<div class="linkschanges-block">
	<div class="linkschanges-content">
		<h3><?=lang('QUICKMENU_MODULE_ITEM_ADVERTIZE')?></h3>
		<?php foreach($linkschange_list as $item) { ?>
			<?=anchor($item['link'], $item['linktext'], 'title="'.$item['linktext'].'"');?><br>
			<?=$item['descr']?>
		<?php } ?>
	</div>	
</div>			
<?php } ?>		