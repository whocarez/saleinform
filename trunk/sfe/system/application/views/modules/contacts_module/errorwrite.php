					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $contacts_module_write_error_title;?>
							</div>
						</div>
						
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div class="n_fb" style="text-align: left;">
									<?php echo $contacts_module_write_error_descr;?>
								</div>
								<div id="market_cnt">
								<?php echo form_open('contacts/er')?>
									<?php echo $contacts_module_write_error_comment;?>
									<font style="color: red;">*</font>
									<?php
										$data = array(
              										'name'        => 'error_content',
              										'id'          => 'error_content',
              										'value'       => ($this->validation->error_content)?$this->validation->error_content:$contacts_module_write_error_uri,
              										'maxlength'   => '100',
              										'size'        => '50',
													'class'		  => 'i',
              										'style'       => 'width:100%',
            										); 
										echo form_textarea($data);
										echo $this->validation->error_content_error;
									?>
								<div class="n_fb" style="padding-bottom: 5px;">
									<div style="text-align: right; padding-top: 5px; padding-bottom: 5px;">
									<span style="float: left;">
									<input name="w_error" style="border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="<?php echo $contacts_module_write_send_btn;?>" type="submit">
									</span>
									</div>
								</div>
								<?php echo form_close();?>
								</div>
								<br>
							</div>
						</div>
					</div> 
