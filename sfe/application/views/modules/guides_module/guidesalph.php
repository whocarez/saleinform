					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $guides_table_show_all_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_cnt">
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td colspan="99"">
													<div class="n_fb">
													<?php
														foreach($guides_alphabetical_list as $key=>$row) 
														echo anchor('/guides#LT'.$key, $row['L'], array('style'=>"font-weight: bold;")).'&nbsp;'; 
													?>
													</div>
												</td>
											</tr>
											<?php foreach($guides_alphabetical_list as $key=>$row) { ?>
											<tr>
												<td style="text-align: center; width: 25%; vertical-align: top;">
													<span class="bold_blue">
													<?php 
													echo anchor('#', '#', array('name'=>'LT'.$key, 'class'=>'hide', 'id'=>'LT'.$key)).$row['L'];
													?>
													</span>
												</td>
												<td style="padding-left: 9px;">
													<div style="width: 100%;">
														<div style="float: left; width: 55%;">
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
														</div>
														<div style="margin-left: 55%;">
														<?php }	$index++;?>
															<span class="mmk_bul" style="">
																<?php echo anchor('/guides/c/'.$dataArr['_categories_rid'],trim($dataArr['name']));?>
															</span>
															<br>																		
														<?php } ?> 
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="99">
													<div style="border:1px dotted #000;border-left:0;border-right:0;border-top: 0;height: 1px;"></div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div> 
