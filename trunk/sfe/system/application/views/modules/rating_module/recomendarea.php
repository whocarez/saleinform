	<div class="box">
		<div class="b_h">
			<div id="hc_meta" class="b_hc" ><?php echo $recomend_area_title;?></div>
		</div>
		
		<div class="b_c">
			<div class="o" id="chat_c" style="">
				<div id="chat_cnt">
					<div style="clear: both;">
						<!-- -->
						<img style="float: right;" src="<?php echo $rating_ware_image;?>" border="0">
						<b><?php echo $rating_ware_name ?></b><br>
						<span style="font-size: 8pt;color: #888888;"><?php echo $rating_ware_sdescr ?></span>
						<br><br>
						<?php if($rating_ware_rating) { ?>
							<img src="<?php echo base_url().'images/ratings/'.$rating_ware_rating.'.gif'?>" align="absmiddle" border=0 alt="<?php echo $rating_ware_rating?>"/>
							<span style="font-size: 8pt;color: #888888;">(<?php echo $rating_ware_rating;?>/10)</span>
						<?php }?>
						<br><br>
						<span style="float:right;"><?php echo $rating_ware_details;?>&nbsp;<b class="more"></b></span>
						<br>
						<!--  -->
					</div>
				</div>
			</div>
		</div>
	</div>
