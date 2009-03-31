<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<!-- Path navigator -->
	<?=anchor('', lang('NAVLINE_MODULE_MAIN_LINK_TITLE'), 'title="'.lang('NAVLINE_MODULE_MAIN_LINK_TITLE').'"')?>
	<span class="grey"> > </span><?=anchor('categories', lang('CATEGORIES_MODULE_CATEGORIES_TITLE'), 'title="'.lang('CATEGORIES_MODULE_CATEGORIES_TITLE').'"')?>
	<?foreach($path as $cat) { ?>
	<span class="grey"> > </span><?=anchor('category/'.$cat->rid.'-'.$cat->slug, $cat->name, 'title="'.$cat->name.'"')?>
	<? } ?>
	<span class="grey"> > </span><?=$currcat->name?>
</div>
<table class="layoutshell" width="100%">
	<tr>
		<td class="layoutL">
			<h1><?=$currcat->name?></h1>
			<div class="newIntro">
				<?=$currcat->descr?>
			</div>
			
			<div class="ptab4onbd" id="prodNav">
				<ul>
					<li id="ptab1on">
						<a name="top">
							<h4><span><?=$currcat->name?></span></h4>
						</a>
					</li>
				</ul>
			</div>
			<table cellspacing="0" class="resultrangetopPriceComp2 bg3boxgdt">
				<tr>
					<td class="rangearticles"><?=lang('CATEGORIES_PREVIEW')?></td>
					<td class="rangepages"> </td>
					<td class="rangenextpage"/>
				</tr>
			</table>
			<table class="newCatTable" cellspacing="0" cellpadding="0">
				<tr>
					<td class="subcat">
					<? $index= 0; ?>
					<?foreach($subcats as $cat) { $index++;?>
						<dl class="subcatbox">
							<dt><?=anchor('category/'.$cat->rid.'-'.$cat->slug, $cat->name, 'title="'.$cat->name.'" class="hdl"')?></dt>
							<?foreach($s_subcats as $s_cat) {?>
								<?if($cat->rid == $s_cat->_categories_rid) { ?>
									<dd><?=anchor('category/'.$s_cat->rid.'-'.$s_cat->slug, $s_cat->name, 'title="'.$s_cat->name.'" class="subnr"')?>  <span class="subnr">(<?=$s_cat->oquan?>)</span></dd>
								<? } ?>	
							<? } ?>		
						</dl>
						<?if($index==$middle) { $index = -10000;?>
					</td>
					<td class="subcat">
						<? } ?>	
					<? } ?>
					</td>
				</tr>
			</table>
			
		</td>
	</tr>
</table>




