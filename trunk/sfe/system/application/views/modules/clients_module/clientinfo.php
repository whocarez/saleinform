	<div class="box">
		<div class="b_h">
			<a href="<?php echo $clients_module_client_products_tab_link ?>" id="news_2" class="rCG">
				<span id="news_2text"><?php echo $clients_module_client_products_tab?></span>
			</a>
			<a href="<?php echo $clients_module_client_opinions_tab_link?>" id="news_1" class="rCG">
				<span id="news_1text"><?php echo $clients_module_client_opinions_tab?></span>
			</a>
			<a href="<?php echo $clients_module_client_info_tab_link?>" id="news_0" class="rC" >
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
								<div style="font-size: 8pt; color: #888888;">
								<?php echo $clients_module_client_result_arr['descr'];?>
								</div>
								<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
								<table id="t_clinfo" style="font-size: 100%;">
									<tr>
										<td colspan="99">
											<strong>
												<?php echo $clients_module_client_global_title;?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_country_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['_countries_name']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_region_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;" >
											<?php echo $clients_module_client_result_arr['_regions_name']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_city_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['_cities_name']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_nm_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['name']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_adress_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['street']?>,
											<?php echo $clients_module_client_result_arr['build']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_website_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo auto_link($clients_module_client_result_arr['url'], 'both', TRUE)?>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="99">
											<strong>
												<?php echo $clients_module_client_continfo_title;?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_phones_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['wphones']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_icq_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['icq']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_msn_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['msn']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_skype_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['skype']?>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="99">
											<strong>
												<?php echo $clients_module_client_other_title;?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_credit_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['creadits_info']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_delvr_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['delivery_info']?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clients_module_client_wtime_title;?>
										</td>
										<td>
											<div style="font-size: 8pt; color: #888888;padding-left: 15px;">
											<?php echo $clients_module_client_result_arr['worktime_info']?>
											</div>
										</td>
									</tr>
								</table>
								<div style="float:right;">
								<b class="more"></b>&nbsp;<?php echo $clients_module_clients_allclients_link?><br>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>