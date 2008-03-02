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
										<?php echo $clients_module_add_client_descr5;?><br>
									</div>
													<div>	
									<?php echo form_open('./clients/ac5')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<strong><?php echo $clients_module_add_personal_title;?></strong>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cphones_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cphones_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'cphones',
													            'id'          => 'cphones',
												                'value'       => $this->validation->cphones,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->cphones_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cmail_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cmail_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'cmail',
													            'id'          => 'cmail',
												                'value'       => $this->validation->cmail,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->cmail_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cperson_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cperson_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'cperson',
													            'id'          => 'cperson',
												                'value'       => $this->validation->cperson,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->cperson_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<strong><?php echo $clients_module_add_account_title;?></strong>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_login_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_login_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'login',
													            'id'          => 'login',
												                'value'       => $this->validation->login,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->login_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_passwd_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_passwd_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'passwd',
													            'id'          => 'passwd',
												                'value'       => $this->validation->passwd,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_password($data);													
													?>
													<?php echo $this->validation->passwd_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cpasswd_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cpasswd_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'cpasswd',
													            'id'          => 'cpasswd',
												                'value'       => $this->validation->cpasswd,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_password($data);													
													?>
													<?php echo $this->validation->cpasswd_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_uemail_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_uemail_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'uemail',
													            'id'          => 'uemail',
												                'value'       => $this->validation->uemail,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->uemail_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_dname_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_dname_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'dname',
													            'id'          => 'dname',
												                'value'       => $this->validation->dname,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->dname_error;?>
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
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_send_title;?>" type="submit">
													</div>
													<div style="float:left;text-align: left;">
															<input name="back" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_prev_title;?>" type="button" onclick="window.location.href='<?php echo base_url().index_page().'/clients/ac4'?>'">
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
