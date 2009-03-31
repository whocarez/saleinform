<div class="categories-block">

	<div class="categories-header">

		<div class="categories-right-corner"></div>

	</div>

	<div class="categories-content">

		<div class="categories-header-text">

			<h3><?=lang('CATEGORIES_MODULE_SEARCH_RES_TITLE');?></h3>

		</div>
		<?= validation_errors(); ?>
		<?if($result){?>
		<div style="padding: 10px;">
		<strong><?=sprintf(lang('CATEGORIES_MODULE_SEARCH_STR_TITLE'), $s)?></strong>
		<br>
		<?foreach($result as $row) { ?>
			<?=anchor('category/'.$row->rid.'-'.$row->slug.'/ss/'.$s, $row->name, 'title="'.$row->name.'"')?>(<?=$row->catoffersQUAN?>)<br>
		<?}?>
		<?}?>
		</div>
		<div style="clear:both;"></div>
	</div>

	<div class="categories-bottom-border">

		<div class="categories-footer-bar">

			<div class="categories-bottom-right-corner"></div>

		</div>

	</div>	

</div>	