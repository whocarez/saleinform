<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<!-- Path navigator -->
	<?=anchor('', lang('NAVLINE_MODULE_MAIN_LINK_TITLE'), 'title="'.lang('NAVLINE_MODULE_MAIN_LINK_TITLE').'"')?>
	<span class="grey"> > </span><?=anchor('categories', lang('CATEGORIES_MODULE_CATEGORIES_TITLE'), 'title="'.lang('CATEGORIES_MODULE_CATEGORIES_TITLE').'"')?>
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
			<?if($offers_quan) { ?>
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
					<td class="rangenextpage">
						<?=lang('CATEGORIES_MODULE_CATEGORY_SORT_BY')?>
						<?if($sort!=='name') { ?>  
							<?=anchor('category/'.$c->rid.'-'.$c->slug.'/sort/name'.(($pars_string)?('/'.$pars_string):''), lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_NAME'))?>
						<? } else { ?>
							<strong><?=lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_NAME')?></strong>
							<?=img(array('src'=>"images/arrow-sort-down.gif"))?>
						 <? } ?> | 
						 <?if($sort!=='rating') { ?>
							<?=anchor('category/'.$c->rid.'-'.$c->slug.'/sort/rating'.(($pars_string)?('/'.$pars_string):''), lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_RATING'))?>
						<? } else { ?>
							<strong><?=lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_RATING')?></strong>
							<?=img(array('src'=>"images/arrow-sort-down.gif"))?>
						 <? } ?> | 
						 <?if($sort!=='price') { ?>
							<?=anchor('category/'.$c->rid.'-'.$c->slug.'/sort/price'.(($pars_string)?('/'.$pars_string):''), lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_PRICE'))?>
						<? } else { ?>
							<strong><?=lang('CATEGORIES_MODULE_CATEGORY_SORT_BY_PRICE')?></strong>
							<?=img(array('src'=>"images/arrow-sort-down.gif"))?>
						 <? } ?>
					</td>
				</tr>
			</table>
			
			<table class="searchResults2 searchResults2offers" cellspacing="0">
				<?foreach($offers1 as $offer) { ?>
					<tr>
						<td class="compare">
							<?=form_checkbox('ids[]', '', false)?>
						</td>
						<td width="180">
							<?=anchor('offer/'.$offer->offerRID.'-'.$offer->offerSLUG, ($offer->img)?img(array('src'=>$offer->img, 'alt'=>$offer->wareNAME, 'border'=>'0')):img(array('src'=>'images/no_image.png', 'alt'=>$offer->wareNAME, 'border'=>'0')), 'title="'.$offer->wareNAME.'"')?>
						</td>
						<td class="alignLeft">
							<?=anchor('offer/'.$offer->offerRID.'-'.$offer->offerSLUG, '<span class="productName">'.$offer->wareNAME.'</span>', 'title="'.$offer->wareNAME.'"')?>
							<?if($offer->_wares_rid) { ?>
							<p style="padding: 3px 0px;">	
								<? $r = !$offer->wareRATING?0:$offer->wareRATING;?>
								<?=img("images/ratings/stars{$r}.gif", $offer->wareOPINIONS.' '.lang('CATEGORIES_MODULE_CLIENT_REWIEVES_TITLE'))?>
								&nbsp;&nbsp;
								<?if(!$offer->wareOPINIONS) { ?>
									<?=anchor('', lang('CATEGORIES_MODULE_FIRST_OPN'), 'title="'.$offer->wareNAME.'" class="opinions-link"')?>
								<? } else { ?>
									<?=anchor('', $offer->wareOPINIONS.' '.lang('CATEGORIES_MODULE_CLIENT_REWIEVES_TITLE'), 'title="'.$offer->wareNAME.'" class="opinions-link"')?>
								<? } ?>	
							</p>
							<? } ?>
							<p style="font-size: 90%;">
								<?=$offer->short_descr?>
							</p>
							
							<p>
								<?=anchor('offer/'.$offer->offerRID.'-'.$offer->offerSLUG, sprintf(lang('CATEGORIES_MODULE_BUY_NOW'), $offer->minbasePRICE.' '.$offer->baseendWORD), 'title="'.sprintf(lang('CATEGORIES_MODULE_BUY_TAG'), $offer->wareNAME, $offer->minbasePRICE.' '.$offer->baseendWORD).'" class="opinions-link" target="_blank"')?>
							</p>
						</td>
						<td class="noWrap" width="120">
							<?if($offer->offersQUAN>1) { ?>
							<?=anchor('offer/'.$offer->offerRID.'-'.$offer->offerSLUG, $offer->minbasePRICE.' '.$offer->baseendWORD.' - '.$offer->maxbasePRICE.' '.$offer->baseendWORD, 'title="'.$offer->wareNAME.'"')?>
							<?php } else { ?>
							<?=anchor('offer/'.$offer->offerRID.'-'.$offer->offerSLUG, $offer->minbasePRICE.' '.$offer->baseendWORD, 'title="'.$offer->wareNAME.'"')?>
							<?php } ?>
							<br>
							<span class="subgrey add-price">
							(<?if($offer->offersQUAN>1) { ?>
							<?=$offer->minaddPRICE.' '.$offer->addendWORD.' - '.$offer->maxaddPRICE.' '.$offer->addendWORD?>
							<?php } else { ?>
							<?=$offer->minaddPRICE.' '.$offer->addendWORD?>
							<?php } ?>)
							</span>
							<br>
							<?=form_open('offer/'.$offer->offerRID.'-'.$offer->offerSLUG)?>	
							<?=form_submit('compare', lang('CATEGORIES_MODULE_COMPARE'), 'class="compare-btn"')?>
							<?=form_close()?>
							<span class="subgrey">
								<?=$offer->offersQUAN?> <?=lang('CATEGORIES_MODULE_WARE_OFFERS_QUAN_TITLE') ?>
							</span>
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
					<td align="center" valign="middle" id="pagination">
						<?if($pager) { ?>
						<?=lang('CATEGORIES_MODULE_CATEGORY_PAGES_TITLE')?> <?=$pager?>
						<?}?>
					</td>
				</tr>
			</table>	
			<? } else {?>
			<?=lang('CATEGORIES_MODULE_CATEGORY_NO_OFFERS')?>
			<? } ?>					
		</td>
	</tr>
</table>




