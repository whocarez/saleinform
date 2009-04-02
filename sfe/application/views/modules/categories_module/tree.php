<?
function ShowForest($forest, $lvl, $cats_in_cols){
        foreach ($forest as $tree){?>
        	<?if(!$lvl) { if(!isset($index))$index=0; $index++; ?>
            	<?if(!($index%$cats_in_cols)) { ?>
	            </td>
                <td class="websrccat">
				<? } ?>        	
        	<? } ?>
        	<?if(!count($tree->childNodes)) { ?>
        		<?=anchor('/category/'.$tree->rid.'-'.$tree->slug, $tree->name, 'title="'.$tree->name.'" class="tree-link level'.$lvl.'"')?><br>	
        	<? } else { ?> 
                <div class="tree-link-bold level<?=$lvl?>">
                <?=anchor('/category/'.$tree->rid.'-'.$tree->slug, $tree->name, 'title="'.$tree->name.'"')?>
                </div>
                <?ShowForest($tree->childNodes, $lvl+1, $cats_in_cols)?>
        	<? } ?>
<? } } ?>


<table class="wd750">	<tr>
		<td>
				<span class="headline"><?=lang('CATEGORIES_MODULE_SHOW_ALL_TITLE')?></span>    <hr noshade="noshade">
<table class="wd750">
<tr>
<td class="websrccat">	<?ShowForest($tree, 0, $cats_in_cols)?></td>
</tr>
</table>
			
			
			
		</td>
	</tr>
</table>