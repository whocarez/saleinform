<div class="lastnews-block">
	<div class="lastnews-header">
		<div class="lastnews-right-corner"></div>
		<h3><?=lang('LAST_NEWS_TITLE')?></h3>		
	</div>
	<div class="lastnews-content">
		<? foreach($news as $item) { ?>
		<div class="lastnews-item">
			<h4><?=anchor('/news/n/'.$item->rid, stripslashes($item->title), 'title="'.$item->title.'"');?></h4>		
			<?if($item->image) { ?>
			<div class="newimage">
				<?=anchor('/news/n/'.$item->rid, img(array('src'=>$item->img, 'alt'=>$item->title, 'border'=>'0')), 'title="'.$item->title.'"');?>
			</div>
			<? } ?>
			<div class="newpreview">
				<?=stripslashes($item->preview)?>
				<?=anchor('/news/n/'.$item->rid, '...', 'title="'.$item->title.'"');?>
			</div>
		</div>
		<div style="clear: both;"></div>
		<? } ?> 
		<br>
		<span class="link-more"><?=anchor('info', lang('LAST_NEWS_ALL'))?></span>
		<br>
	</div>	
	<div class="lastnews-bottom-border">
		<div class="lastnews-footer-bar">
			<div class="lastnews-bottom-right-corner"></div>
		</div>
	</div>	
</div>
					