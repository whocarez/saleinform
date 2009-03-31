<div class="adv-block">
	<div class="adv-header">
		<h3><?=lang('MOSTPOPULAR_MODULE_CATEGORIES_TITLE')?></h3>
		<div class="adv-right-corner"></div>
	</div>
	<div class="adv-content">
		<?php foreach($advertise_module_right_links_arr as $item) { ?>
			<?=anchor($item['link'], $item['content'], 'title="'.$item['content'].'"');?><br>
			<?=$item['descr']?>
		<?php } ?>
	</div>	
	<div class="adv-bottom-border">
		<div class="adv-footer-bar">
			<div class="adv-bottom-right-corner"/>
		</div>
	</div>	
</div>	