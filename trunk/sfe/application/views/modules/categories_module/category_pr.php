<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<!-- Path navigator -->
	<?=anchor('', lang('NAVLINE_HOME'), 'title="'.lang('NAVLINE_HOME').'"')?>  
	<?foreach($path as $cat) { ?>
	<span class="grey"> > </span><?=anchor('category/'.$cat->rid.'-'.$cat->slug, $cat->name, 'title="'.$cat->name.'"')?>
	<? } ?>
	<span class="grey"> > </span><?=$currcat->name?>
</div>
<table class="layoutshell">
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
			
		</td>
		<td class="layoutM"> </td>
		<td class="layoutR">
		</td>
	</tr>
</table>




