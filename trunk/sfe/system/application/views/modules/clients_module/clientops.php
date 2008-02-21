	<div class="box">
		<div class="b_h">
			<a href="<?php echo $clients_module_client_products_tab_link ?>" id="news_2" class="rCG">
				<span id="news_2text"><?php echo $clients_module_client_products_tab?></span>
			</a>
			<a href="<?php echo $clients_module_client_opinions_tab_link?>" id="news_1" class="rC">
				<span id="news_1text"><?php echo $clients_module_client_opinions_tab?></span>
			</a>
			<a href="<?php echo $clients_module_client_info_tab_link?>" id="news_0" class="rCG" >
				<span id="news_0text"><?php echo $clients_module_client_info_tab;?></span>
			</a>
			<div id="hc_news" class="b_hc" >
				<a href=""><?php echo $clients_module_client_name_title;?></a>
			</div>			
		</div>
			<a class="hide" href="#" id="news_r" >#</a>
			<div class="b_c">
				<div class="o" id="news_c" style="">
					<div id="news_md" class="m_d">
					</div>
					<div id="news_cnt">
						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
								<div>
									<strong>
									<?php echo $clients_module_client_offquan_title;?>
									</strong>
									<font style="font-size: 8pt;color: #888888;">
									<?php echo $clients_module_client_result_arr['cloffers'];?>
									<?php echo $clients_module_clients_offers_title;?>
									</font>
								</div>
								<div>
									<strong>
									<?php echo $clients_module_client_rating_title;?>
									</strong>
									<?php if($clients_module_client_result_arr['rating']) { ?>
										<img src="<?php echo base_url().'images/ratings/'.$clients_module_client_result_arr['rating'].'.gif'?>" border=0 alt="<?php echo $clients_module_client_result_arr['rating']?>"/>
									<?php } ?>
									<font style="font-size: 8pt;color: #888888;">
									(<?php echo $clients_module_client_result_arr['opsquan'];?>
									<?php echo $clients_module_client_opins_link;?>)
									<?php echo $clients_module_client_wopin_link;?>
									</font>
								</div>
								<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
								<?php echo $clients_module_client_opinions_content;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>