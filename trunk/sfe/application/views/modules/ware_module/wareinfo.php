<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<!-- Path navigator -->
	<?=anchor('', lang('NAVLINE_MODULE_MAIN_LINK_TITLE'), 'title="'.lang('NAVLINE_MODULE_MAIN_LINK_TITLE').'"')?>
	<span class="grey"> > </span><?=anchor('categories', lang('CATEGORIES_MODULE_CATEGORIES_TITLE'), 'title="'.lang('CATEGORIES_MODULE_CATEGORIES_TITLE').'"')?>
	<?foreach($path as $cat) { ?>
	<span class="grey"> > </span><?=anchor('category/'.$cat->rid.'-'.$cat->slug, $cat->name, 'title="'.$cat->name.'"')?>
	<? } ?>
	<span class="grey"> > </span><?=anchor('category/'.$curr_cat->rid.'-'.$curr_cat->slug, $curr_cat->name, 'title="'.$curr_cat->name.'"')?>
	<span class="grey"> > </span><?=$offer_info->name?>
</div>


<table cellspacing="0" border="0" id="proMem">
	<tr>
		<td align="center" class="imgProd">
			<div id="imgOverlayContainer">
				<div style="cursor: pointer; height: 150px;">
				<?if($img) { ?>
					<?$i=random_element($img)?>
					<?=img(array('src'=>$i[0], 'alt'=>$offer_info->name, 'border'=>'0', 'class'=>'imgProd'))?>
				<? } ?>
				</div>
                <br/>
                <?if(count($img)>1) { ?>
				<table border="0" cellpading="0" class="imgProdThumb">
					<tr>
						<?foreach($img as $r) { ?>
						<td style="border: 1px solid rgb(207, 207, 207); cursor: pointer;" class="pImg">
							<?=img(array('src'=>$r[1], 'alt'=>$offer_info->name, 'border'=>'0'))?>
						</td>
						<? } ?>
					</tr>
				</table>              
				<? } ?>  
            </div>
		</td>
		<td class="contentProd">
			<?php if($ware_info) { ?>
				<?=img(array('src'=>'images/ratings/stars_'.($ware_info->popularity?$ware_info->popularity:'0').'.gif', 'alt'=>$ware_info->name, 'border'=>'0', 'align'=>"bottom"))?>
			<?php } ?>
			<h1 class="prodPage"><?=$ware_info?$ware_info->name:$offer_info->name?></h1>
            <p class="descr">
            	<?=$offer_info->short_descr?>
            </p>
            <br><br>
            <?php if($ware_info) { ?>
			<?=anchor('ware/editreview/'.$offer_info->rid.'-'.$ware_info->slug, lang('WARE_WRITE_REVIEW'), 'class="btnR"')?>
			<?php } ?>
			<div class="ProdPagePriceRange">
				<table>
					<tr>
						<td>
							<?if(count($offers_list)>1) { ?>
							<?=anchor('offer/'.$offer_info->rid.'-'.$offer_info->slug.'#comp', ROUND($min_price, 0).' - '.ROUND($max_price, 0).' '.$base_endw)?>
							<?php } else { ?>
							<?=anchor('offer/'.$offer_info->rid.'-'.$offer_info->slug.'#comp', ROUND($min_price, 0).' '.$base_endw)?>
							<?php } ?>
							<br/>
							(<?=count($offers_list)?> <?=lang('WARE_OFFERS')?>)
						</td>
						<td style="padding-left: 10px;">
							<a href="#comp">
								<?=img(array('images/prodpage_arrow_down.gif', 'border'=>'0'))?>
							</a>
						</td>
					</tr>
				</table>
			</div>			
		</td>
		<td style="text-align: right;" class="menuProd">
		</td>
	</tr>
</table>

<div class="ptab4onbd" id="prodNav">
<ul>
	<li id="ptab1on">
		<a name="comp">
			<h4><span><?=sprintf(lang('WARE_MODULE_COMPARE_PRICES_TITLE'), count($offers_list))?></span></h4>
		</a>
	</li>
</ul>
</div>
<table cellspacing="0" class="resultrangetopPriceComp2 bg3boxgdt">
	<tr>
		<td class="rangearticles"> </td>
		<td class="rangepages"> </td>
		<td class="rangenextpage"/>
	</tr>
</table>
<table class="searchResults2 searchResults2offers" cellspacing="0">
	<?foreach($offers_list as $o) { ?>
	<tr>
		<td>
			<?$o_img = ($o->img)?($o->img):'images/no_offer_mini.png'?>
			<?=anchor('clicks/offer/'.$o->offerRID, img(array('src'=>$o_img, 'alt'=>$o->wareNAME, 'border'=>'0'), 'title="'.$o->wareNAME.'" target="_blank"'))?>
		</td>
		<td class="visit-cell offer-name">
			<?=anchor('clicks/offer/'.$o->offerRID, $o->wareNAME, 'title="'.$o->wareNAME.'" target="_blank"')?><br>
			<?=$o->short_descr?>
		</td>
		<td class="nowrap visit-cell price-cell">
			<?=anchor('clicks/offer/'.$o->offerRID, $o->minbasePRICE.' '.$o->baseendWORD, 'title="'.$o->wareNAME.'" target="_blank"')?><br>
			<span class="subgrey" style="font-size: 11px;"><?=$o->minaddPRICE.' '.$o->addendWORD?></span>
		</td>
		<td class="logo-cell">
			<?=img(array('src'=>$o->cllogo, 'alt'=>$o->clientNAME, 'border'=>'0'))?><br>
			<?=img(array('src'=>'images/ratings/stars'.($o->clpopularity?$o->clpopularity:0).'.gif', 'alt'=>$o->clientNAME, 'border'=>'0'))?><br>
			<?=anchor('client/'.$o->clientRID.'-'.$o->clientSLUG, $o->clops_quan.' '.lang('WARE_CLIENT_REVIEWS'))?> 
		</td>
		<td class="shipm">
			<?=lang('WARE_OFFER_DATE')?> <font color="#000000"><?=$o->offerDATE?></font><br>
			<?=lang('WARE_OFFER_AVAILABLE')?> <font color="#000000"><?=$o->avNAME?></font>
		</td>
		<td class="visit-cell">
			<?=form_open('clicks/offer/'.$o->offerRID, array('target'=>"_blank"))?>
			<?=form_submit('submit', lang('WARE_MODULE_BUY').' >', 'class="visit-btn"')?>
			<?=form_close()?>
			<?=$o->clientNAME?>
		</td>
	</tr>
	<? } ?>
</table>
<?if($ware_info) { ?>
<div class="ptab2onbd" id="prodNav">
<ul>
	<li id="ptab2on">
		<a name="review">
			<h4><span><?=lang('CLIENTS_REVIEWS_ON')?> <?=$ware_info?$ware_info->name:$offer_info->name?></span></h4>
		</a>
	</li>
</ul>
</div>
<table cellspacing="0" class="resultrangetopPriceComp2 bg12boxgdt">
	<tr>
		<td class="rangearticles">
			<strong>
			<?=$reviews_offset+1?>-<?=$reviews_offset+count($ware_reviews)?> <?=lang('CLIENTS_FROM')?> <?=$ware_reviews_quan?>
			</strong>
		</td>
		<td class="rangepages"></td>
		<td class="rangenextpage"> </td>
	</tr>
</table>

<table cellspacing="0" class="review2">
	<?if($ware_reviews_quan>$reviews_limit) { ?>
	<tfoot>
		<tr>
			<td colspan="3">
				<?=lang('WARE_MODULE_CATEGORY_PAGES_TITLE')?> <?=$pager?> 
			</td>
		</tr>
	</tfoot>
	<? } ?>
	<tbody>
		<?foreach($ware_reviews as $row) { ?>
		<tr>
			<td class="teaser">
				<?=img(array('src'=>'images/ratings/stars'.ROUND($row->mark, 0).'.gif', 'border'=>'0'))?> <span class="r-title"><?=$row->title?></span>
				<br/>
				<span class="sub"><?=sprintf(lang('CLIENTS_REVIEW_ON'), $ware_info->name, $row->login)?></span><br>
				<span class="sub"><strong><?=lang('CLIENTS_REVIEW_POS')?>:</strong> <?=$row->adv?></span><br>
				<span class="sub"><strong><?=lang('CLIENTS_REVIEW_NEG')?>:</strong> <?=$row->disadv?></span><br> 
				<p class="text">
					<?=$row->opinion?>
				</p>
			</td>
			<td class="usefulness">
				<?=lang('CLIENTS_REVIEWS_RATES');?><br><br>
				<?if($row->r_rate <= 0) { ?>
					<?=img(array('src'=>'images/ratings/helpfulls/bar_0.gif', 'id'=>"i{$row->rid}"))?>
				<? } else if($row->r_rate >= 50) { ?>
					<?=img(array('src'=>'images/ratings/helpfulls/bar_50.gif', 'id'=>"i{$row->rid}"))?>
				<? } else { ?>
					<?=img(array('src'=>'images/ratings/helpfulls/bar_'.$row->r_rate.'.gif', 'id'=>"i{$row->rid}"))?>
				<? } ?>
				<br>
				<?=$row->rdate?>
				<br>
				<?if($user) { ?>
				<div id="r<?=$row->rid?>">
					<?if(!$row->urate) { ?>
						<a href="javascript:void(0);" onClick="rateReview(<?=$row->rid?>, 1)" id="a<?=$row->rid?>_plus" title="+1"><?=img(array('src'=>'images/prodpage_i_like_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?></a>
						<a href="javascript:void(0);" onClick="rateReview(<?=$row->rid?>, -1)" id="a<?=$row->rid?>_minus" title="-1"><?=img(array('src'=>'images/prodpage_i_dislike_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?></a>
					<? } else { ?>
						<?if($row->urate>0) { ?>
							<?=img(array('src'=>'images/prodpage_i_like_it_active.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>
							<?=img(array('src'=>'images/prodpage_i_dislike_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>
						<? } else { ?>
							<?=img(array('src'=>'images/prodpage_i_like_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>
							<?=img(array('src'=>'images/prodpage_i_dislike_it_active.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>
						<? } ?>
					<? } ?>
				</div>
				<? } ?>				
			</td>
		</tr>
		<? } ?>
	</tbody>
</table>
<br>
<?=anchor('ware/editreview/'.$offer_info->rid.'-'.$ware_info->slug, lang('CLIENTS_WRITE_REVIEW'), 'class="btnR"')?>

<script type="text/javascript">
function rateReview(review, rate){
	$.ajax({
		  type: "POST",
		  url: "<?=base_url().index_page()?>/ware/reviewrate",
		  data: {review: review, rate: rate},
		  success: function(currRate){
		    var r = parseInt(currRate);
		    var newImage = '';
		    if(r<=0) newImage = '<?=base_url()?>images/ratings/helpfulls/bar_0.gif';
		    else if(r>=50) newImage = '<?=base_url()?>images/ratings/helpfulls/bar_50.gif';
		    else newImage = '<?=base_url()?>images/ratings/helpfulls/bar_'+r+'.gif';
		    $('#i'+review).attr('src', newImage);
		    $('#a'+review+'_plus').remove();
		    $('#a'+review+'_minus').remove();
		    if(rate>0){
		    	$('#r'+review).append('<?=img(array('src'=>'images/prodpage_i_like_it_active.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>&nbsp;'); 
				$('#r'+review).append('<?=img(array('src'=>'images/prodpage_i_dislike_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>');
		 	} else {
		    	$('#r'+review).append('<?=img(array('src'=>'images/prodpage_i_like_it.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>&nbsp;'); 
				$('#r'+review).append('<?=img(array('src'=>'images/prodpage_i_dislike_it_active.gif', 'width'=>"26", 'height'=>"23", 'border'=>"0"))?>');
		 	}
		  } 	
	});	
}
</script>
<? } ?>