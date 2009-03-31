<div class="lastnews-block">
	<div class="lastnews-header">
		<h3><?=lang('LAST_MODULE_NEWS_AREA_TITLE')?></h3>
		<div class="lastnews-right-corner"></div>
	</div>
	<div class="lastnews-content">
   		<?php foreach($last_module_news_cont_arr as $item) { ?>
   		<div class="lastnews-item" style="background-color: <?=alternator('#FFFFFF', '#F7F7F7')?>;">
   			<h4><?=anchor('new/'.$item['rid'].'-'.$item['slug'], stripslashes($item['title']), 'title="'.stripslashes($item['title']).'"')?></h4>
			<?=($item['img'])?(anchor('news/'.$item['rid'].'-'.$item['slug'], img(array('src'=>$item['img'], 'alt'=>$item['title'], 'border'=>'0', 'align'=>'right')))):''?>
   			<?=character_limiter(stripslashes($item['new']), 512, '');?> <?=anchor('news/'.$item['rid'].'-'.$item['slug'], '...', 'title="'.stripslashes($item['title']).'"')?>
		</div>
		<?php } ?>
		
		<span class="link-more">
			<?=anchor('news', lang('LAST_MODULE_NEWS_ALL'), 'title="'.lang('LAST_MODULE_NEWS_ALL').'"')?>
		</span>
		
		<div style="clear:both"></div>
	</div>	
	<div class="lastnews-bottom-border">
		<div class="lastnews-footer-bar">
			<div class="lastnews-bottom-right-corner"></div>
		</div>
	</div>	
</div>							