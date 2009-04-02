					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $categories_category_compare_title.$categories_current_category_name;?>
							</div>
						</div>
						
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div class="n_fb" style="text-align: left;">
									<?php if($categories_image_icon) { ?>
										<img src="<?php echo $categories_image_icon?>" align="left" hspace="2" vspace="2" border="0" >
									<?php } ?>
									<?php echo $categories_current_category_descr;?>
								</div>
								<div id="market_cnt">
									<?php echo $categories_category_offers_table;?>
								</div>
								<br>
							</div>
						</div>
					</div> 
