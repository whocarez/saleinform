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


<table class="wd750">
	<tr>
    	<td align="center" class="bcrumbhdl">
    	</td>
  	</tr>
  	<tr>
    	<td class="bcrumbhdl">
    		<?=anchor('', lang('CLIENTS_HOME'), 'title="'.lang('CLIENTS_HOME').'"')?> > 
    		<span class="greyb"><?=lang('CATEGORIES_TREE_TITLE')?></span><br/><br/>
        	<span class="headline"><?=lang('CATEGORIES_TREE_TITLE')?></span>
        	<hr noshade="noshade"/>
    	</td>
	</tr>
	<tr>
		<td>
			
<table class="wd750">
<tr>
<td class="websrccat">
	<?ShowForest($tree, 0, $cats_in_cols)?>
</td>
</tr>
</table>
			
			
			
		</td>
	</tr>
</table>