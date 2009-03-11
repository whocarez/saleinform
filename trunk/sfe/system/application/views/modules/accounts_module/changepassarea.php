					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $accounts_login_change_password_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<?php echo form_open('./accounts/chpass')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<?php echo $accounts_login_change_password_new?>
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;">
													<div style="width: 100%;">
														<div style="margin-left: 40%;">
															<input name="password" style="width:150px" class="i" value="<?php echo $this->validation->password?>" type="password">
															<?php echo $this->validation->password_error;?>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
													<div style="width: 100%;">
														<div style="float: left; width: 60%;">
															<?php echo $accounts_password_confirm_label?>
														</div>
													</div>
												</td>
												<td style="padding-left: 0px;">
													<div style="width: 100%;">
														<div style="margin-left: 40%;">
															<input name="confirm_password" style="width:150px" value="<?php echo $this->validation->confirm_password?>" class="i" type="password">
															<?php echo $this->validation->confirm_password_error;?>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap" >
													<div class="n_fb">
														<span style="font-size: 8pt;color: #888888;">
															<?php echo $accounts_login_change_password_note;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap">
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
