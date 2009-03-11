					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $categories_category_title.$categories_current_category_name;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div class="n_fb" style="text-align: left;">
									<?php if($categories_image_icon) { ?>
										<img src="<?php echo $categories_image_icon?>" align="left" hspace="2" vspace="2" border="0" >
									<?php } ?>
									<?php echo $categories_current_category_descr;?>
								</div>
								<div id="market_cnt">
									<table style="font-size: 100%;">
										<tbody>
											<?php foreach($categories_category_node_array as $key=>$node) { ?>
											<tr>
												<td style="text-align: left; width: 30%; vertical-align: middle;">
													<span style="color: #000; font-weight: bold;"><?php echo $node['mainLEVEL']['name']; ?></span>
												</td>
												<td style="width: 35%;">
														<?php 
															foreach($node['1c'] as $row) 
															{ 
																echo anchor('/categories/c/'.$row['rid'],$row['name']).br();
															} 
														?>
												</td>
												<td style="width: 35%;">
														<?php 
															foreach($node['2c'] as $row) 
															{
																echo anchor('/categories/c/'.$row['rid'],$row['name']).br();
															} 
														?>
												</td>
											</tr>
											<tr>
												<td colspan="99" width = "100%">
													<div style="height:1px; padding:3px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div> 
