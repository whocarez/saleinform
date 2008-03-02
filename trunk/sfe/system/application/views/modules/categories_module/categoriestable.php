					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $categories_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_cnt">
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="text-align: center; width: 30%; vertical-align: middle;">
													<?php if($categories_image_picture) { ?>
													<img src="<?php echo $categories_image_picture?>" align="middle" border="0" ><br>
													<?php } ?>
													<a href="<?php echo site_url().'/categories/c/'.$categories_table_random_item['rid']?>">
														<span class="bold_blue"><?php echo $categories_table_random_item['name']?></span>
													</a>
												</td>
												<td style="padding-left: 9px;">
														<?php foreach($categories_table_left_list as $item){?>
															<span class="mmk_bul" style="">
																<?php echo anchor('/categories/c/'.$item['rid'], $item['name'])?>
															</span><br>
														<?php }?>
												</td>
												<td style="padding-left: 9px;">
														<?php foreach($categories_table_right_list as $item){?>
															<span class="mmk_bul" style="">
																<?php echo anchor('/categories/c/'.$item['rid'], $item['name'])?>
															</span><br>
														<?php }?>
												</td>
											</tr>
										</tbody>
									</table>
									<span style="display: block; height: 14px;">
										<?php echo $categories_table_show_all;?>
									</span>						
								</div>
							</div>
						</div>
					</div> 
