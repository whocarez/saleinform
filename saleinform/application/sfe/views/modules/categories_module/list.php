<?
function subcats($subcats, $cRid){
	$index = 0;
	$subcatsArr = array();
	foreach($subcats as $subcat){
		if($subcat->_categories_rid==$cRid){
        	$subcatsArr[] = anchor('category/'.$subcat->rid.'-'.$subcat->slug, $subcat->name, 'title="'.$subcat->name.'" class="list-subcat"');
        	$index++; 
        }
        if($index>2) break;
	}
	if($subcatsArr) return implode(', ', $subcatsArr).' ...';
	return '';
}
?>
<table class="layoutshell">
	<tr>
		<td class="layoutL">
			<table class="wd510">
          		<tr>
          			<td class="hdlpad1">
          				<span class="headline"><?=lang('CATEGORIES_MODULE_PREVIEW_TITLE')?></span>
          				<hr noshade="noshade">
          			</td>
          		</tr>
        	</table>
        	<table id="categories_list" class="wd510">
        		<?
        			$middle = count($categories_list)/2;
        			if($middle-(int)($middle) > 0) $middle = (int)($middle)+1;
        		?>
        		<? for($i=0;$i<$middle;$i++) { ?>
        		<tr>
        			<td style="vertical-align: top; text-align: left; width: 50%;">
        				<?=anchor('category/'.$categories_list[$i]->rid.'-'.$categories_list[$i]->slug, $categories_list[$i]->name, 'title="'.$categories_list[$i]->name.'"  class="cathdl"')?>
        				<br>
        				<?=subcats($subcats_list, $categories_list[$i]->rid)?>
        				<br><br>
        			</td>
        			<td style="vertical-align: top; text-align: left; width: 50%;">
        				<?=anchor('category/'.$categories_list[$i+$middle]->rid.'-'.$categories_list[$i+$middle]->slug, $categories_list[$i+$middle]->name, 'title="'.$categories_list[$i+$middle]->name.'"  class="cathdl"')?>
        				<br>
        				<?=subcats($subcats_list, $categories_list[$i+$middle]->rid)?>
        				<br><br>
        			</td>
        		</tr>
        		<? } ?>
        		
				<tr>
					<td colspan="2">
						<br>
						<div class="ctr">
							<?=anchor('categoriestree', lang('CATEGORIES_MODULE_BY_TREE_TITLE'), 'title="'.lang('CATEGORIES_MODULE_BY_TREE_TITLE').'" class="hdl"')?>
						</div>
					</td>
				</tr>        		
        	</table>
        </td>	</tr>
</table>

<table class="wd750">
	<tr> 
	    <td>
	    	<br>
			<hr noshade="noshade">
		</td>
	</tr>
</table>