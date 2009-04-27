<div class="catslist">
        <ul>
        <?php foreach($categories_list as $key=>$item) { ?>
                <li>
                	<div class="maincat-img">	
                	<?=anchor("category/{$item->rid}-{$item->slug}", img(array('src'=>$item->icon, 'border'=>'0', 'alt'=>$item->name)), 'title="'.$item->name.'"')?>
                	</div>
                    <div class="maincat-item">
                        <h4>
                                <?=anchor("category/{$item->rid}-{$item->slug}", $item->name, 'title="'.$item->name.'"')?>
                        </h4>
                        <?php foreach($item->subcats as $subcat) { ?>
                        	<?=anchor("category/{$subcat->rid}-{$subcat->slug}", $subcat->name, 'title="'.$subcat->name.'"')?>, 
                        <?php } ?> ...
                    </div>
                </li>
        <?php } ?>
                <li class='last-cat-item'>
                	<div class="maincat-img">	
                	<?=anchor("categories", img(array('src'=>'images/nav_icon_more.gif', 'border'=>'0', 'alt'=>lang('CATEGORIES_MODULE_MAIN_ALL_TITLE'))), 'title="'.lang('CATEGORIES_MODULE_MAIN_ALL_TITLE').'"')?>
                	</div>
                	<div  class="maincat-item">
                        <h4>
                        	<?=anchor("categories", lang('CATEGORIES_MODULE_MAIN_ALL_TITLE'), 'title="'.lang('CATEGORIES_MODULE_MAIN_ALL_TITLE').'"')?>
                        </h4>
                        	&nbsp;
                    </div>
                </li>
        </ul>
</div>
<div class="CategoryBrowserFooter"></div> 
