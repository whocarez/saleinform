<div style="width: 100%; padding-bottom: 10px;">
	<?php foreach($advertise_module_center_links_arr as $item) { ?>
		<div style="width:33%; padding: 5px; text-align: center;float:left; display: inline;">
			<?=anchor($item['link'], $item['content'], 'target="_blank"');?>
		</div>
	<?php } ?>
	<div style="clear: both;">
</div>