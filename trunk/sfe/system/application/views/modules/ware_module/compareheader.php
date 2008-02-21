<div class="n_b" >
<table style="font-size: 100%;">
	<tr>
		<td width="100%" valign="middle">
			<?php if($ware_offers_header_ware_image) { ?>
				<img src="<?php echo $ware_offers_header_ware_image;?>" hspace="5" alt="<?php $ware_offers_header_ware_descr?>">
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td width="100%" valign="middle">	
			<strong><?php echo $ware_offers_header_warename;?></strong><br>
			<strong><?php echo $ware_offers_price_type_title;?></strong>
			<font style="color: #888888;font-size: 8pt;">
				<?php echo $ware_offers_header_prtype; ?>
			</font>
			<br>
			<strong><?php echo $ware_prices_range_title;?></strong>
			<font style="color: #888888;font-size: 8pt;">
				<?php echo $ware_offers_header_minbase_price;?> - <?php echo $ware_offers_header_maxbase_price;?>&nbsp;<?php echo $ware_offers_header_baseendword;?><br>
				<?php echo $ware_offers_header_minadd_price;?> - <?php echo $ware_offers_header_maxadd_price;?>&nbsp;<?php echo $ware_offers_header_addendword;?>
			</font>
			<br>
			<?php if($ware_offers_header_wares_rid){?>
				<strong><?php echo $ware_user_rating_title;?></strong>
				<font style="color: #888888;font-size: 8pt;">
				<?php if($ware_offers_header_warerating) { ?>
					<img src="<?php echo base_url().'images/ratings/'.$ware_offers_header_warerating.'.gif'?>" align="absmiddle" border=0 alt="<?php echo $ware_offers_header_warerating?>"/>
					<?php echo '('.$ware_offers_header_wareopinions.' '.$ware_offers_header_rewievs_title.') '.$ware_offers_header_write_opinions; ?>
				<?php } else echo $ware_offers_header_write_opinions;?>
				</font>
				<br>
				<strong><?php echo $ware_reviews_info_title;?></strong>
				<font style="color: #888888;font-size: 8pt;">
					<?php echo $ware_offers_header_warereviews.' '.$ware_offers_header_rewievs_quan_title;?>
				</font>
				<br>
			<?php }?>
		</td>
	</tr>
</table>
</div>
