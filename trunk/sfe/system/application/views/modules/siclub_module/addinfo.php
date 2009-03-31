					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $siclub_addinfo_title;?>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
													<div>	
									<?php echo form_open('./siclub/add')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_descr_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_descr_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'descr',
													            'id'          => 'descr',
												                'value'       => $this->validation->descr?$this->validation->descr:$siclub_addinfo_res['descr'],
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
													<?php echo $siclub_credit_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_credit_descr;?>
													</span>
												</td>
											<tr>
											</tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'credit',
													            'id'          => 'credit',
												                'value'       => $this->validation->credit?$this->validation->credit:$siclub_addinfo_res['creadits_info'],
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
													<?php echo $siclub_delivery_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_delivery_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'delivery',
													            'id'          => 'delivery',
												                'value'       => $this->validation->delivery?$this->validation->delivery:$siclub_addinfo_res['delivery_info'],
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
													<?php echo $siclub_wtime_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_wtime_descr;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'wtime',
													            'id'          => 'wtime',
												                'value'       => $this->validation->wtime?$this->validation->wtime:$siclub_addinfo_res['worktime_info'],
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