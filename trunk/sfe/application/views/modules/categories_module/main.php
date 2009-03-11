<div class="catslist">
	<ul>
	<? foreach($categories_list as $cat) { ?>
		<li>
			<?if($cat->imgPath) { ?>
			<?=img(array('src'=>$cat->imgPath, 'alt'=>$cat->name))?>
			<? } ?>
			<div>
			<h4>
				<?=anchor('category/'.$cat->rid.'-'.$cat->slug, $cat->name)?>
			</h4>
			<!-- Subcats -->
			</div>
		</li>
	<? } ?>
		<li class='last-cat-item'>
			<div>
			<h4>
				<?=anchor('categories', lang('CATEGORIES_ALL'))?>
			</h4>
			</div>
		</li>
	</ul>
</div>
<div class="CategoryBrowserFooter"></div> 