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
										<img src="<?php echo base_url()?>images/icons/0638_32x32.png" hspace="5" align="left" width="32" height="32">
										<?php echo $clients_module_add_client_descr2;?><br>
									</div>
									<div>	
									<?php echo form_open('./clients/ac2')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<strong><?php echo $clients_module_add_contact_title;?></strong><br>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_phones_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_phones_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'phones',
													            'id'          => 'phones',
												                'value'       => $this->validation->phones,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->phones_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_skype_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_skype_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'skype',
													            'id'          => 'skype',
												                'value'       => $this->validation->skype,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->skype_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_icq_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_icq_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'icq',
													            'id'          => 'icq',
												                'value'       => $this->validation->icq,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->icq_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_msn_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_msn_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'msn',
													            'id'          => 'msn',
												                'value'       => $this->validation->msn,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->msn_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_www_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_www_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'www',
													            'id'          => 'www',
												                'value'       => $this->validation->www,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->www_error;?>
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
													<div style="width: 50%;float:right;text-align: right;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_next_title;?>" type="submit">
													</div>
													<div style="width: 50%;float:left;text-align: left;">
															<input name="back" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_prev_title;?>" type="button" onclick="window.location.href='<?php echo base_url().index_page().'/clients/ac1'?>'">
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