<div class="newslist-block">
	<div class="newslist-header">
		<h3><?=lang('NEWS_MODULE_AREA_TITLE')?></h3>
		<div class="newslist-right-corner"></div>
	</div>
	<div class="newslist-content">
   		<?php foreach($news as $item) { ?>
   		<div class="newslist-item" style="background-color: <?=alternator('#FFFFFF', '#F7F7F7')?>;">
   			<h4><?=anchor('new/'.$item->rid.'-'.$item->slug, stripslashes($item->title), 'title="'.stripslashes($item->title).'"')?></h4>
   			<span class="subgrey"><?=$item->newDATE?></span><br>
			<?=($item->img)?(anchor('new/'.$item->rid, img(array('src'=>$item->img, 'alt'=>$item->title, 'border'=>'0', 'align'=>'right')))):''?>
   			<?=character_limiter(stripslashes($item->new), 512, '');?> <?=anchor('new/'.$item->rid, '...', 'title="'.stripslashes($item->title).'"')?>
		</div>
		<?php } ?>
		
		<div style="clear:both"></div>
		<?if($pager){ ?>
			<div class="pager">
			<?=$pager?>	
			</div>
		<? } ?>
	</div>	
	<div class="newslist-bottom-border">
		<div class="newslist-footer-bar">
			<div class="newslist-bottom-right-corner"></div>
		</div>
	</div>	
</div>							