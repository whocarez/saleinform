					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<a href=""><?php echo $cluops_module_client_options_title;?></a>
							</div>
						</div>
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
								<?php echo form_open($cluops_module_client_current_uri_string)?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td colspan="99" >
													<div class="n_fb">
														<img src="<?php echo base_url()?>images/information.png" align="left">
														<?php echo $cluops_module_client_opinfo_content;?>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td nowrap>
													<strong><?php echo $cluops_module_client_message_title;?></strong><font color="red">*</font>
												</td>
												<td>
													<?php
														$data = array(
              															'name'        => 'cluopmess',
              															'id'          => 'cluopmess',
              															'rows'  	  => '10',
              															'cols'        => '40',
																		'type'		  => 'textarea',
																		'value'       => $this->validation->cluopmess, 
																		'style'		  => 'border: 1px solid #888888;'
            														);
														echo form_textarea($data);													 
													?>
													<div style="font-size: 8pt;color: #888888; float: left;">
													<?php echo $cluops_module_client_message_length_title;?>
													</div>
													<br>
													<?php echo $this->validation->cluopmess_error;?>
												</td>
											</tr>
											<tr>
												<td colspan="99">
													<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>												
												</td>
											</tr>
											<tr>
												<td nowrap>
													<strong><?php echo $cluops_module_client_mark_title;?></strong><font color="red">*</font>
												</td>
												<td>
													<table style="font-size: 8pt;color:#888888;">
													<tr>
													<td align="center">1<br>
													<?php
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '1',
              														'checked'     => TRUE,
              														'style'       => '',
            														 );
            											 echo form_radio($data);
            										?>
            										</td><td align="center">2<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '2',
              														'checked'     => ($this->validation->cluopmrk == '2')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);		
            										?>
            										</td><td align="center">3<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '3',
              														'checked'     => ($this->validation->cluopmrk == '3')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">4<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '4',
              														'checked'     => ($this->validation->cluopmrk == '4')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">5<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '5',
              														'checked'     => ($this->validation->cluopmrk == '5')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">6<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '6',
              														'checked'     => ($this->validation->cluopmrk == '6')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">7<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '7',
              														'checked'     => ($this->validation->cluopmrk == '7')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">8<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '8',
              														'checked'     => ($this->validation->cluopmrk == '8')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">9<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '9',
              														'checked'     => ($this->validation->cluopmrk == '9')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);
            										?>
            										</td><td align="center">10<br>
            										<?php													 
														$data = array(
              														'name'        => 'cluopmrk',
              														'id'          => 'cluopmrk',
              														'value'       => '10',
              														'checked'     => ($this->validation->cluopmrk == '10')?TRUE:FALSE,
              														'style'       => '',
            														 );
														echo form_radio($data);													 
	            									?>
	            									</td>
            									</tr>
            									</table>
            									<?php echo $this->validation->cluopmrk_error; ?> 
												</td>
											</tr>
											<tr>
												<td colspan="99">
													<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>												
												</td>
											</tr>
											<tr>
												<td nowrap>
													<strong><?php echo $cluops_module_client_security_code_title;?></strong><font color="red">*</font>
												</td>
												<td>
													<?php
														echo $cluops_module_client_captcha['image'];
													?>
													<input type="hidden" name="cluopscw" id="cluopscw" value="<?php echo $cluops_module_client_captcha['word']?>">
												</td>
											</tr>
											<tr>
												<td colspan="99">
													<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>												
												</td>
											</tr>
											<tr>
												<td nowrap>
													<strong><?php echo $cluops_module_client_security_code_confirm_title;?></strong><font color="red">*</font>
												</td>
												<td>
													<?php
														$data = array(
              															'name'        => 'cluopsc',
              															'id'          => 'cluopsc',
              															'maxlength'   => '100',
              															'size'        => '25',
																		'style'		  => 'border: 1px solid #888888;'
            														);
														echo form_input($data);													 
													?>
													<?php echo $this->validation->cluopsc_error; ?> 
												</td>
											</tr>
											<tr>
												<td colspan="99">
													<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>												
												</td>
											</tr>
											<tr>
												<td colspan="99"  align="right">
													<div style="width: 100%;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="ОК" type="submit">
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								<?php echo form_close();?>
								</div>
							</div>
						</div>
	  				</div> 