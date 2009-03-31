<div class="categories-block">
	<div class="categories-header">
		<div class="categories-right-corner"></div>
	</div>
	<div class="categories-content">
		 
		<div class="categories-header-text">
			<h3><?=lang('CATEGORIES_MODULE_CATEGORIES_TITLE');?></h3>
		</div>
		<div class="categories-image">
			<?php if($categories_image_picture) { ?>
				<?=anchor('category/'.$categories_table_random_item->rid.'-'.$categories_table_random_item->slug, img(array('src'=>$categories_image_picture, 'alt'=>$categories_table_random_item->name)), 'title="'.$categories_table_random_item->name.'"')?>
				<br>
			<?php } ?>
			<?=anchor('category/'.$categories_table_random_item->rid.'-'.$categories_table_random_item->slug, $categories_table_random_item->name, 'title="'.$categories_table_random_item->name.'" class="bigcat"')?>
		</div>
		<div class="categories-left-column">
			<?php foreach($categories_table_left_list as $item){?>
				<?=anchor('/category/'.$item->rid.'-'.$item->slug, $item->name, 'title="'.$item->name.'" class="cat"')?><br>
			<?php }?>
		</div>
		<div class="categories-right-column">
			<?php foreach($categories_table_right_list as $item){?>
				<?=anchor('/category/'.$item->rid.'-'.$item->slug, $item->name, 'title="'.$item->name.'" class="cat"')?><br>
			<?php }?>
		</div>
		<div style="clear:both;"></div>
		<br>
		<span class="link-more"><?=anchor('categories', lang('CATEGORIES_MODULE_CATEGORIES_DET'))?></span>
		<br>
	</div>
	<div class="categories-bottom-border">
		<div class="categories-footer-bar">
			<div class="categories-bottom-right-corner"></div>
		</div>
	</div>	
</div>		