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
					<td class="rangearticles">
						<?if(!$offset) { ?>
							<?=sprintf(lang('CATEGORIES_SOFFERS'), 1, ($offers_quan < 15)?$offers_quan:15, $offers_quan)?>
						<? } else { ?>
							<?=sprintf(lang('CATEGORIES_SOFFERS'), ($offset<0)?1:($offset), $offset+15, $offers_quan)?>
						<? } ?>
					</td>
					<td class="rangepages"> </td>
					<td class="rangenextpage"/>
				</tr>
			</table>
			
			<table class="searchResults2 searchResults2offers" cellspacing="0">
				<?foreach($offers as $offer) { ?>
					<tr>
						<td class="compare">
							
						</td>
						<td width="180">
							<?=anchor('', ($offer->img)?img(array('src'=>$offer->img, 'alt'=>$offer->wareNAME, 'border'=>'0')):img(array('src'=>'images/no_image.png', 'alt'=>$offer->wareNAME, 'border'=>'0')), 'title="'.$offer->wareNAME.'"')?>
						</td>
						<td class="alignLeft">
							<?=anchor('', $offer->wareNAME, 'title="'.$offer->wareNAME.'"')?>
							<p>
								<?=$offer->wareDESCR?>
							</p>
						</td>
						<td class="noWrap" width="120">
						</td>
					</tr>
				<? } ?>
			</table>
			<table class="resultrangedownbg32 bg3light navigationNumbers">
				<tr>
					<td class="rangearticles">
						<?if(!$offset) { ?>
							<?=sprintf(lang('CATEGORIES_SOFFERS'), 1, ($offers_quan < 15)?$offers_quan:15, $offers_quan)?>
						<? } else { ?>
							<?=sprintf(lang('CATEGORIES_SOFFERS'), ($offset<0)?1:($offset), $offset+15, $offers_quan)?>
						<? } ?>
					</td>
					<td align="center" id="pagination">
						<?=$pager?>
					</td>
				</tr>
			</table>						
		</td>
		<td class="layoutM"> </td>
		<td class="layoutR">
		</td>
	</tr>
</table>




