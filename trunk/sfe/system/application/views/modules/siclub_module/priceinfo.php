					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $siclub_priceinfo_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<div>	
									<?php echo form_open('./siclub/pr')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_isprice_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_isprice_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php
														$options = array('0'=>$siclub_no,
																	'1'=>$siclub_yes,
																	);
														echo form_dropdown('isprice', $options, $this->validation->isprice?$this->validation->isprice:$siclub_priceinfo_res['pr_load'], 'style="width:50px" class="i"');
													?>
													<?php echo $this->validation->isprice_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_adays_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_adays_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;" >
													<?php 
													$options = array('1'=>'1',
																'2'=>'2',
																'3'=>'3',
																'4'=>'4',
																'5'=>'5',
																'6'=>'6',
																'7'=>'7',
																'8'=>'8',
																'9'=>'9',
																'10'=>'10',
																'11'=>'11',
																'12'=>'12',
																'13'=>'13',
																'14'=>'14'
																);
													echo form_dropdown('adays', $options, $this->validation->adays?$this->validation->adays:$siclub_priceinfo_res['pr_actual_days'], 'style="width:50px" class="i"');
													?>
													<?php echo $this->validation->isprice_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_ahours_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_ahours_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;" >
													<?php
													$options = array('0'=>'0',
																'4'=>'4',
																'8'=>'8',
																'12'=>'12',
																'16'=>'16',
																'20'=>'20',
																);
													echo form_dropdown('ahours', $options, $this->validation->ahours?$this->validation->ahours:$siclub_priceinfo_res['pr_actual_hours'], 'style="width:50px" class="i"');
													?>
													
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_prurl_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_prurl_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'prurl',
													            'id'          => 'prurl',
												                'value'       => $this->validation->prurl?$this->validation->prurl:$siclub_priceinfo_res['pr_url'],
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->prurl_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<div class="n_fb">
														<span style="font-size: 8pt;color: #888888;">
															<?php echo $siclub_requires;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" colspan="2" align="center">
													<div style="float:right;text-align: right;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $siclub_save_changes;?>" type="submit">
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<?php echo form_close()?>
													</div>
								</div>
							</div>
						</div>
					</div> 
