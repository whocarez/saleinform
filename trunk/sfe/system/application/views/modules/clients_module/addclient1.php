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
										<?php echo $clients_module_add_client_descr1;?><br>
									</div>
									<div>	
									<?php echo form_open('./clients/ac1')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" colspan="2" nowrap="nowrap">
													<strong><?php echo $clients_module_add_general_title?></strong>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_urform_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_urform_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;" >
													<?php 
														$options = $clients_module_add_urform_list;
														echo form_dropdown('urform', $options, $this->validation->urform, 'style="width:150px" class="i"');													
													?>
													<?php echo $this->validation->urform_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_name_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_name_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'name',
													            'id'          => 'name',
												                'value'       => $this->validation->name,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->name_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cltypes_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cltypes_descr;?>
													</span>
													
												</td>
												<td style="padding-left: 0px;">
													<?php 
														$options = $clients_module_add_cltypes_list;
														echo form_dropdown('cltype', $options, $this->validation->cltype, 'style="width:150px" class="i"');													
													?>
													<?php echo $this->validation->cltype_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_countries_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_countries_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="country_container">
													<?php 
														$options = $clients_module_add_countries_list;
														echo form_dropdown('country', $options, $this->validation->country, 'id="country" style="width:150px" class="i" onchange="CountryChange();"');													
													?>
													</div>
													<?php echo $this->validation->country_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_regions_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_regions_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="region_container">
													<?php 
														$options = $clients_module_add_regions_list;
														echo form_dropdown('region', $options, $this->validation->region, 'id="region" style="width:150px" class="i" onchange="RegionChange();"');													
													?>
													</div>
													<?php echo $this->validation->region_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_cities_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_cities_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="city_container">
													<?php 
														$options = $clients_module_add_cities_list;
														echo form_dropdown('city', $options, $this->validation->city, 'id="city" style="width:150px" class="i"');													
													?>
													</div>
													<?php echo $this->validation->city_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_zip_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_zip_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'zip',
													            'id'          => 'zip',
												                'value'       => $this->validation->zip,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->zip_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_street_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_street_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'street',
													            'id'          => 'street',
												                'value'       => $this->validation->street,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->street_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $clients_module_add_build_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $clients_module_add_build_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'build',
													            'id'          => 'build',
												                'value'       => $this->validation->build,
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px',
																'class'		  => 'i'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->build_error;?>
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
												<td style="padding-left: 9px;" nowrap="nowrap" colspan="2">
													<div style="width: 100%;float:right;text-align: right;">
															<input name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px; " class="btn" value="<?php echo $clients_module_add_next_title;?>" type="submit">
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