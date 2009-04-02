					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $siclub_generalinfo_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
									<div>	
									<?php echo form_open('./siclub/gn')?>
									<table style="font-size: 100%;">
										<tbody>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_urform_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_urform_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;" >
													<?php 
														$options = $siclub_urform_list;
														echo form_dropdown('urform', $options, ($this->validation->urform)?$this->validation->urform:$siclub_generalinfo_res['_urforms_rid'], 'style="width:150px" class="i"');													
													?>
													<?php echo $this->validation->urform_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_name_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_name_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'name',
													            'id'          => 'name',
												                'value'       => ($this->validation->name)?$this->validation->name:$siclub_generalinfo_res['name'],
																'maxlength'   => '100',
																'size'        => '50',
																'style'       => 'width:150px; color:grey;',
																'class'		  => 'i',
																'readonly'		  => '1'
																);
													echo form_input($data);													
													?>
													<?php echo $this->validation->name_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_cltypes_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_cltypes_descr;?>
													</span>
													
												</td>
												<td style="padding-left: 0px;">
													<?php 
														$options = $siclub_cltypes_list;
														echo form_dropdown('cltype', $options, $this->validation->cltype?$this->validation->cltype:$siclub_generalinfo_res['_cltypes_rid'], 'style="width:150px" class="i"');													
													?>
													<?php echo $this->validation->cltype_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_countries_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_countries_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="country_container">
													<?php 
														$options = $siclub_countries_list;
														echo form_dropdown('country', $options, $this->validation->country?$this->validation->country:$siclub_generalinfo_res['countryRID'], 'id="country" style="width:150px" class="i" onchange="CountryChange();"');													
													?>
													</div>
													<?php echo $this->validation->country_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_regions_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_regions_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="region_container">
													<?php 
														$options = $siclub_regions_list;
														echo form_dropdown('region', $options, $this->validation->region?$this->validation->region:$siclub_generalinfo_res['regionRID'], 'id="region" style="width:150px" class="i" onchange="RegionChange();"');													
													?>
													</div>
													<?php echo $this->validation->region_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_cities_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_cities_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<div id="city_container">
													<?php 
														$options = $siclub_cities_list;
														echo form_dropdown('city', $options, $this->validation->city?$this->validation->city:$siclub_generalinfo_res['cityRID'], 'id="city" style="width:150px" class="i"');													
													?>
													</div>
													<?php echo $this->validation->city_error;?>
												</td>
											</tr>
											<tr>
												<td style="padding-left: 0px;" nowrap="nowrap" width="100%">
													<?php echo $siclub_zip_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_zip_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'zip',
													            'id'          => 'zip',
												                'value'       => $this->validation->zip?$this->validation->zip:$siclub_generalinfo_res['zip'],
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
													<?php echo $siclub_street_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_street_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'street',
													            'id'          => 'street',
												                'value'       => $this->validation->street?$this->validation->street:$siclub_generalinfo_res['street'],
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
													<?php echo $siclub_build_label?><font color="red">*</font><br>
													<span style="font-size: 8pt;color: #888888;">
														<?php echo $siclub_build_descr;?>
													</span>
												</td>
												<td style="padding-left: 0px;">
													<?php 
													$data = array('name'        => 'build',
													            'id'          => 'build',
												                'value'       => $this->validation->build?$this->validation->build:$siclub_generalinfo_res['build'],
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
															<?php echo $siclub_requires;?>
														</span>
													</div>															
												</td>
											</tr>
											<tr>
												<td style="padding-left: 9px;" nowrap="nowrap" colspan="2">
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