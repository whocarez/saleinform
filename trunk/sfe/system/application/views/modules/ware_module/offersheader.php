<div class="n_b" >
<script type="text/javascript">
	function setImage(img_url) 
	{
		var main_img = img_url.replace('_sthumb', '_thumb');
		var big_img  = img_url.replace('details_sthumb', 'original_size');	
   		/*document.getElementById('main_img').src = main_img;*/
		var content = '<a onclick="window.open(\''+big_img+'\', \'_blank\', \'width=400,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0\');" href="javascript:void(0);"><img id="main_img" hspace="2" border="0" alt="" src="'+main_img+'"/></a>';   		
   		document.getElementById('big_img_link').innerHTML = content; 
	}
</script>			 
<table style="font-size: 100%;">
	<tr>
		<?php if(count($ware_offers_header_img_icons)) {?>
		<td width="50" align="center">
			 <?php
			 	$imgCOUNTER = 1;
			 	foreach($ware_offers_header_img_icons as $img) 
			 	{
					echo '<div style="width:50px;height:50px;"><img src="'.$img.'" hspace="2" border="0" alt="'.$ware_offers_header_ware_descr.'" onClick="setImage(\''.$img.'\')">';
					if($imgCOUNTER%2==0) echo "<br>";
					$imgCOUNTER++;
				}
			 ?>
		</td>
		<?php } ?>
		<td width="154" align="center" valign="middle">
			<div style="height: 151px;width: 151px; margin-right: 5px;">
			<?php if($ware_offers_header_ware_image) {
				$atts = array(
              		'width'      => '400',
              		'height'     => '400',
              		'scrollbars' => 'yes',
              		'status'     => 'yes',
              		'resizable'  => 'yes',
              		'screenx'    => '0',
              		'screeny'    => '0',
					'id'		 => 'big_img_link'
            		);
				echo '<div id="big_img_link">'.anchor_popup(str_replace('details_thumb', 'original_size', $ware_offers_header_ware_image), '<img id="main_img" src="'.$ware_offers_header_ware_image.'" hspace="2" border="0" alt="'.$ware_offers_header_ware_descr.'">', $atts).'</div>'; 
			 }
			 else echo '<img src="'.base_url().'/images/no_image.png" hspace="2" border="0" alt="'.$ware_offers_header_ware_descr.'">'; 
			 ?>
			 </div>
		</td>
		<td valign="middle" align="left">
			<table cellpadding="5">
				<tr>
					<td style="font-size: 80%;vertical-align: middle;">	
					<strong><?php echo $ware_compare_prices_title;?></strong>
					</td>
					<td style="font-size: 80%;">
					<?php echo $ware_offers_header_warename;?><br>
					<font style="color: #888888;font-size: 8pt;">
					<?php echo $ware_offers_header_ware_descr?$ware_offers_header_ware_descr:$ware_offers_header_warename; ?>
					</font>
					</td>
				</tr>
				<tr>
					<td style="font-size: 80%;vertical-align: middle;">
					<strong><?php echo $ware_offers_price_type_title;?></strong>
					</td>
					<td style="font-size: 80%;">
					<font style="color: #888888;font-size: 8pt;">
					<?php echo $ware_offers_header_prtype; ?>
					</font>
					</td>
				</tr>
				<tr>
					<td style="font-size: 80%;vertical-align: middle;">
					<strong><?php echo $ware_prices_range_title;?></strong>
					</td>
					<td style="font-size: 80%;">
					<font style="color: #888888;font-size: 8pt;">
					<?php echo $ware_offers_header_minbase_price;?> - <?php echo $ware_offers_header_maxbase_price;?>&nbsp;<?php echo $ware_offers_header_baseendword;?><br>
					<?php echo $ware_offers_header_minadd_price;?> - <?php echo $ware_offers_header_maxadd_price;?>&nbsp;<?php echo $ware_offers_header_addendword;?>
					</font>
					</td>
				</tr>
			<?php if($ware_offers_header_wares_rid){?>
				<tr>
					<td style="font-size: 80%;vertical-align: middle;">
					<strong><?php echo $ware_user_rating_title;?></strong>
					</td>
					<td style="font-size: 80%;">
				<font style="color: #888888;font-size: 8pt;">
				<?php if($ware_offers_header_warerating) { ?>
					<img src="<?php echo base_url().'images/ratings/'.$ware_offers_header_warerating.'.gif'?>" align="absmiddle" border=0 alt="<?php echo $ware_offers_header_warerating?>"/>
					<?php echo '('.$ware_offers_header_wareopinions.' '.$ware_offers_header_rewievs_title.') '.$ware_offers_header_write_opinions; ?>
				<?php } else echo $ware_offers_header_write_opinions;?>
				</font>
					</td>
				</tr>
				<tr>
					<td style="font-size: 80%;vertical-align: middle;">
					<strong><?php echo $ware_reviews_info_title;?></strong>
					</td>
					<td style="font-size: 80%;">
					<font style="color: #888888;font-size: 8pt;">
						<?php echo $ware_offers_header_warereviews.' '.$ware_offers_header_rewievs_quan_title;?>
					</font>
					</td>
				</tr>
			<?php }?>
			</table>
		</td>
	</tr>
</table>
</div>
