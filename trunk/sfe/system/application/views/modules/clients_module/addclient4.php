					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $clients_module_add_client_title;?> - 
								<?php echo $clients_module_add_step_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<div class="n_fb">
										<img src="<?php echo base_url()?>images/icons/0638_32x32.png" align="left" hspace="5" width="32" height="32">
										<?php echo $clients_module_add_client_descr4;?><br>
									</div>
													<div>	
									<?php echo form_open('./clients/ac4')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap">
													<strong><?php echo $clients_module_add_prinfo_title;?></strong>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_isprice_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_isprice_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php
														echo form_radio('isprice', '0', (($this->validation->isprice=='0' || !$this->validation->isprice)?TRUE:FALSE), 'id="isprice" class="i" style="border:0px;"').$clients_module_add_client_no;
														echo form_radio('isprice', '1', (($this->validation->isprice=='1')?TRUE:FALSE), 'id="isprice" class="i" style="border:0px;"').$clients_module_add_client_yes;													
													?>
													<?php echo $this->validation->isprice_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_adays_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_adays_descr;?>
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
													echo form_dropdown('adays', $options, $this->validation->adays, 'style="width:50px" class="i"');
													?>
													<?php echo $this->validation->isprice_error;?>
												</td>
											</tr>
											<!-- 
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_ahours_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_ahours_descr;?>
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
													echo form_dropdown('ahours', $options, $this->validation->ahours, 'style="width:50px" class="i"');
													?>
													
												</td>
											</tr>
											 -->
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_prurl_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_prurl_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'prurl',
													            'id'          => 'prurl',
												                'value'       => $this->validation->prurl,
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
															<?php echo $clients_module_add_requires;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" colspan="2" align="center">
													<div style="float:right;text-align: right;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_next_title;?>" type="submit">
													</div>
													<div style="float:left;text-align: left;">
															<input name="back" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_prev_title;?>" type="button" onclick="window.location.href='<?php echo base_url().index_page().'/clients/ac3'?>'">
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
