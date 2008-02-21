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
										<?php echo $clients_module_add_client_descr3;?><br>
									</div>
													<div>	
									<?php echo form_open('./clients/ac3')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" width="100%">
													<strong><?php echo $clients_module_add_addinfo_title;?></strong>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_descr_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_descr_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'descr',
													            'id'          => 'descr',
												                'value'       => $this->validation->descr,
																'maxlength'   => '100',
																'size'        => '50',
																'rows'		  => '5',	
																'style'       => 'width:100%',
																'class'		  => 'i'
																);
													echo form_textarea($data);													
													?>
													<?php echo $this->validation->descr_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
													<?php echo $clients_module_add_credit_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_credit_descr;?>
													</span>
												</td>
											<tr>
											</tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'credit',
													            'id'          => 'credit',
												                'value'       => $this->validation->credit,
																'maxlength'   => '100',
																'size'        => '50',
																'rows'		  => '5',
																'style'       => 'width:100%',
																'class'		  => 'i'
																);
													echo form_textarea($data);													
													?>
													<?php echo $this->validation->credit_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
													<?php echo $clients_module_add_delivery_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_delivery_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'delivery',
													            'id'          => 'delivery',
												                'value'       => $this->validation->delivery,
																'maxlength'   => '100',
																'size'        => '50',
																'rows'		  => '5',
																'style'       => 'width:100%',
																'class'		  => 'i'
																);
													echo form_textarea($data);													
													?>
													<?php echo $this->validation->delivery_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
													<?php echo $clients_module_add_wtime_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_wtime_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'wtime',
													            'id'          => 'wtime',
												                'value'       => $this->validation->wtime,
																'maxlength'   => '100',
																'size'        => '50',
																'rows'		  => '5',
																'style'       => 'width:100%',
																'class'		  => 'i'
																);
													echo form_textarea($data);													
													?>
													<?php echo $this->validation->wtime_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" colspan="3" nowrap="nowrap" >
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
															<input name="back" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_prev_title;?>" type="button" onclick="window.location.href='<?php echo base_url().index_page().'/clients/ac2'?>'">
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