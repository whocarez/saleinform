					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $categories_category_compare_title.$categories_current_category_name;?>
							</div>
						</div>
						
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<?php echo form_open('ware/cmp/c/'.$categories_current_category_rid, array('onSubmit'=>'return getCompareChecks();', 'name'=>'cmpForm'));?>
<script type="text/javascript">
<!--
function getCompareChecks()
{
	var checkedQ = 0;
	for (var i=0; i<document.cmpForm.elements.length; i++)
	{	
		if(document.cmpForm.elements[i].name.substring(4,0)=='cmp_') 
		{
			if(document.cmpForm.elements[i].checked) checkedQ++;
		}
	}
	if(checkedQ<2 || checkedQ>5) 
	{
		alert("<?php echo $categories_category_compare_nowares_compare;?>");
		return false;
	}
	return true;
}
//-->
</script>
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div class="n_fb" style="text-align: left;">
									<?php if($categories_image_icon) { ?>
										<img src="<?php echo $categories_image_icon?>" align="left" hspace="2" vspace="2" border="0" >
									<?php } ?>
									<?php echo $categories_current_category_descr;?>
								</div>
								<div>
									<div style="text-align: right; padding-top: 5px; padding-bottom: 5px;">
									<span style="float: left;">
									<?php if($categories_current_category_iscompared) { ?>
									<input name="w_compare" style="border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="<?php echo $categories_category_compare_wares_title;?>" type="submit">
									<?php } ?>
									</span>
									<?php
										echo '<b>'.$categories_category_price_type.'</b>';
										echo form_dropdown('w_prtype', $categories_category_price_types_options, $categories_category_current_prtype, $categories_category_prtype_js);
										echo '&nbsp;&nbsp;&nbsp;';
										echo '<b>'.$categories_category_sort_by.'</b>'; 
										echo form_dropdown('w_sortby', $categories_category_sort_options, $categories_category_current_sort, $categories_category_sort_by_js);
									?>
									</div>
									<div style="padding:3px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
								</div>
								<div id="market_cnt">
									<?php echo $categories_category_offers_table;?>
								</div>
								<br>
								<?php if($categories_current_category_iscompared) { ?>
								<div class="n_fb" style="padding-bottom: 5px;">
									<div style="text-align: right; padding-top: 5px; padding-bottom: 5px;">
									<span style="float: left;">
									<input name="w_compare" style="border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="<?php echo $categories_category_compare_wares_title;?>" type="submit">
									</span>
									</div>
								</div>
								<?php } ?>
								<?php echo $categories_category_offers_pagination; ?>
								<div>
									<?php if($categories_category_guide_link) { ?>
									<div style="font-size: 8pt;padding-top: 5px; padding-bottom: 5px;">
										<img src="<?php echo base_url().'images/icons/0601_16x16.png';?>" align="left" hspace="5" width="16" height="16">
										<?php echo $categories_category_guide_link;?>
									</div>
									<div style="padding:3px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
									<?php } ?>
								</div>
							</div>
							<?php echo form_close();?>
						</div>
					</div> 
