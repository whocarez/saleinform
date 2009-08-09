					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $siclub_accountinfo_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
													<div>	
									<?php echo form_open('./siclub/acc')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_login_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_login_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'login_siclub',
													            'id'          => 'login',
												                'value'       => $this->validation->login?$this->validation->login:$siclub_accountinfo_res['login'],
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i',
																'readonly'=>'1'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->login_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_uemail_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_uemail_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'uemail',
													            'id'          => 'uemail',
												                'value'       => $this->validation->uemail?$this->validation->uemail:$siclub_accountinfo_res['email'],
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
													<?php echo $siclub_dname_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_dname_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'dname',
													            'id'          => 'dname',
												                'value'       => $this->validation->dname?$this->validation->dname:$siclub_accountinfo_res['displayname'],
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
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_passwd_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_passwd_descr;?>
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
													<?php echo $siclub_cpasswd_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_cpasswd_descr;?>
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
												<td style="padding-left: 0px;" colspan="3" nowrap="nowrap" >
													<div class="n_fb">
														<span style="font-size: 8pt;color: #888888;">
															<?php echo $siclub_requires;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" colspan="2" align="center">
													<div style="width: 100%;float:right;text-align: right;">
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
