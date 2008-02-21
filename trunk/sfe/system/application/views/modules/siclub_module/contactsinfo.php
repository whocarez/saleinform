					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $siclub_contactsinfo_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<div>	
									<?php echo form_open('./siclub/cnt')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_phones_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_phones_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'phones',
													            'id'          => 'phones',
												                'value'       => $this->validation->phones?$this->validation->phones:$siclub_contactsinfo_res['wphones'],
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
													<?php echo $siclub_skype_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_skype_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'skype',
													            'id'          => 'skype',
												                'value'       => $this->validation->skype?$this->validation->skype:$siclub_contactsinfo_res['skype'],
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
													<?php echo $siclub_icq_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_icq_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'icq',
													            'id'          => 'icq',
												                'value'       => $this->validation->icq?$this->validation->icq:$siclub_contactsinfo_res['icq'],
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
													<?php echo $siclub_msn_label?><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_msn_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'msn',
													            'id'          => 'msn',
												                'value'       => $this->validation->msn?$this->validation->msn:$siclub_contactsinfo_res['msn'],
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
													<?php echo $siclub_www_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_www_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'www',
													            'id'          => 'www',
												                'value'       => $this->validation->www?$this->validation->www:$siclub_contactsinfo_res['url'],
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