<div class="newscats-block">
	<div class="newscats-header">
		<div class="newscats-right-corner"></div>
	</div>
	<div class="newscats-content">
		<h3><?=lang('NEWS_MODULE_NEWS_CATEGORIES_TITLE');?></h3>
		<table class="cats-table">
			<tr>
				<td width="50%">
				<?$i=1; foreach($cats as $cat) { ?>
					<div class="newcat-item <?=($active==$cat->rid)?'newcat-active':''?>">
					<?=anchor('newscat/'.$cat->rid.'-'.$cat->slug, $cat->name, 'title="'.$cat->name.'"')?><br>
					<span class="subgrey"><?=$cat->descr?></span>
					</div>
					<?if($i==$middle){?>
						</td>
						<td>
					<?}?>		
				<? $i++;} ?>
				</td>
			</tr>
		</table>
		<br>
	</div>
	<div class="newscats-bottom-border">
		<div class="newscats-footer-bar">
			<div class="newscats-bottom-right-corner"></div>
		</div>
	</div>	
</div>					