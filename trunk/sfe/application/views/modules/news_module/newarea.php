<div class="newslist-block">
	<div class="newslist-header">
		<h3><?=stripslashes($newdata->title)?></h3>
		<div class="newslist-right-corner"></div>
	</div>
	<div class="newslist-content">
		<div style="padding: 10px;text-align: justify;">
		<?=img(array('src'=>$img, 'align'=>'left', 'border'=>'0'))?> 
		<span class="subgrey">
		<?=lang('NEWS_MODULE_NEW_AUTHOR_TITLE')?> <?=$newdata->author?><br>
		<?if(isset($source)) { ?>
		<?=lang('NEWS_MODULE_NEW_SOURCE_TITLE')?> <?=$source?><br>
		<? } ?>
		</span><br>
		<?=auto_typography(stripslashes($newdata->new));?>
		<br>
		<span class="subgrey">
		<?=$newdata->newDATE?>
		</span>
		</div>
	</div>	
	<div class="newslist-bottom-border">
		<div class="newslist-footer-bar">
			<div class="newslist-bottom-right-corner"></div>
		</div>
	</div>	
</div>						