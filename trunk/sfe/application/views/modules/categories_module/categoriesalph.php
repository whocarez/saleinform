					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $categories_table_show_all_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div style="text-align: right;">
									<?php
										echo anchor('/categories/sa', $categories_table_by_alph_title, array('style'=>"color: rgb(0, 0, 0);")); 
									?>
									| 
									<?php
										echo anchor('/categories/st', $categories_table_by_tree_title, array()); 
									?>
								</div>
								<div id="market_cnt" >
									<table style="font-size: 100%;">
											<tr>
												<td colspan="3">
													<div class="n_fb">
													<?php
														foreach($categories_alphabetical_list as $key=>$row) 
														{
															if($row['L']=='А' || $row['L']=='а') echo br();
															echo anchor('/categories/sa/#LT'.$key, $row['L'], array('style'=>"font-weight: bold;")).'&nbsp;'; 
														}
													?>
													</div>
												</td>
											</tr>
											<?php foreach($categories_alphabetical_list as $key=>$row) { ?>
											<tr>
												<td width="10%" style="text-align: center;">
													<span class="bold_blue">
														<A name="<?php echo 'LT'.$key;?>">
															<?php echo $row['L']; ?>
														</A>
													</span>
												</td>
												<td width="45%">
														<?php
															unset($row['L']); unset($row['I']); 
															$index=1;
															$flag = 0;
															$colquan = count($row)%2?(count($row)+1)/2:count($row)/2;
															foreach ($row as $key=>$dataArr) 
															{
																if($index>$colquan && !$flag) { 
																$flag=1;
														?>
												</td>
												<td width="45%">
														<?php }	$index++;?>
															<span class="bul">
																<?php echo anchor('/categories/c/'.$dataArr['rid'],trim($dataArr['name']));?>
															</span>
															<br>																		
														<?php } ?>
												</td>
														<?php if($index<3) { ?>
												<td width="45%">
													&nbsp;
												</td>
														<?php } ?>
											</tr>
											<tr>
												<td width="100%" colspan="3">
													<div style="border:1px dotted #000;border-left:0;border-right:0;border-top: 0;height: 1px;display: block;"></div>
												</td>
											</tr>	
											<?php } ?>
									</table>
								</div>
							</div>
						</div>
					</div> 
