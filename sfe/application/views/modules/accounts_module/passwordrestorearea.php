					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $accounts_restore_password_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<?php echo form_open('./accounts/restorepass')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td colspan="99" style="padding-left: 0px;" >
													<div class="n_fb">
														<img src="<?php echo base_url()?>images/icons/0638_32x32.png" align="left" hspace="5" height="32" width="32">
														<?php echo $accounts_restore_password_note;?>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="60%">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<?php echo $accounts_login_label?>
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;">
													<input name="login" style="width:150px" value="<?php echo $this->validation->login?>" class="i" type="text">
													<?php echo $this->validation->login_error;?>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="padding-left: 0px;" nowrap="nowrap" width="60%">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<b><?php echo $accounts_security_code_title?></b>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="60%">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<?php echo $accounts_security_code_label?>
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;" >
													<?php echo $accounts_registration_area_captcha['image'];?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="60%">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<?php echo $accounts_security_code_confirm_label?>
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;">
													<input name="security_code" style="width:150px" class="i" value="<?php echo $this->validation->security_code?>" type="text">
													<?php echo $this->validation->security_code_error;?>
													<input name="sc" class="i" type="hidden" value="<?php echo $accounts_registration_area_captcha['word'];?>">
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<div class="n_fb">
														<span style="font-size: 8pt;color: #888888;">
															<?php echo $accounts_registration_required_note;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="60%">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
														&nbsp;
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;" nowrap="nowrap" >
													<div style="width: 100%;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="OK" type="submit">
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
