﻿<div id="menuContent">
<div id="mainNavUs">
<ul class="mainMenuUs">
	<? foreach($categories_list as $cat) { ?>
	<li>
		<?=anchor('category/'.$cat->rid.'-'.$cat->slug, '<span>'.$cat->name.'</span>', 'title="'.$cat->meta_title.'" target="_parent"')?>
	</li>
	<? } ?>
	<li>
		<?=anchor('categories', '<span><strong>'.lang('CATEGORIES_MORE').'</strong></span>', 'title="'.lang('CATEGORIES_MODULE_SHOW_ALL_TITLE').'" target="_parent"')?>
	</li>
</ul>
</div>
</div>
