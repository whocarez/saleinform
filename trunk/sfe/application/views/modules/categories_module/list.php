<?
function subcats($subcats, $cRid){
	$index = 0;
	$subcatsArr = array();
	foreach($subcats as $subcat){
		if($subcat->_categories_rid==$cRid){
        	$subcatsArr[] = anchor('category/'.$subcat->rid.'-'.$subcat->slug, $subcat->name, 'title="'.$subcat->name.'"');
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
			<div id="Node_BreadCrumb" class="breadCrumb2-US">
				<a href="/"><?=anchor('', lang('CLIENTS_HOME'), 'title="'.lang('CLIENTS_HOME').'"')?></a> 
				<span class="grey">></span> 
				<span class="greyb"><?=lang('CATEGORIES_ALL')?></span>
			</div>
			<br><br>
			<table class="wd510">
          		<tr>
          			<td class="hdlpad1">
          				<span class="headline"><?=lang('CATEGORIES_PREVIEW')?></span>
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
							<?=anchor('categoriestree', lang('CATEGORIES_SHOW_TREE'), 'title="'.lang('CATEGORIES_SHOW_TREE').'" class="hdl"')?>
						</div>
					</td>
				</tr>        		
        	</table>
        </td>
		<td class="layoutM"> 
		</td>
		<td class="layoutR">
			<table class="topprod">
				<tr>
					<td class="topprodhdl bgdark" colspan="3">
						<span class="subhdl">${_(u'Популярные товары')}</span>
					</td>
				</tr>
			</table>
 		</td>
	</tr>
</table>

<table class="wd750">
	<tr> 
	    <td>
	    	<br>
			<hr noshade="noshade">
		</td>
	</tr>
</table>