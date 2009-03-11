					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $contacts_module_contacts_title;?>
							</div>
						</div>
						
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div class="n_fb" style="text-align: left;">
									<img src="<?php echo base_url().'images/icons/0566_32x32.png'?>" align="left" width="32" height="32">
									<?php echo $contacts_module_contacts_descr;?>
								</div>
								<?php echo form_open('contacts')?>
									<div>
									<table style="font-size: 100%;">
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_contacts_icq_title;?>
									</td>
									<td style="padding-left: 0px;vertical-align: middle;" >
										<img alt="*" align="left" hspace="5" src="<?php echo base_url().'images/icq_icon.gif'?>" >298864875
									</td>
									</tr>
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_contacts_skype_title;?>
									</td>
									<td style="padding-left: 0px;" >
										<img alt="*" align="left" hspace="5" src="<?php echo base_url().'images/skype.png'?>" >dorianyats
									</td>
									</tr>
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_contacts_email_title;?>
										<font style="color: red;">*</font>
									</td>
									<td style="padding-left: 0px;" >
										<?php
											$data = array(
              											'name'        => 'cmail',
              											'id'          => 'cmail',
              											'value'       => $this->validation->cmail,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
              											'style'       => 'width:150px',
            											); 
											echo form_input($data);
											echo $this->validation->cmail_error;
										?>
									</td>
									</tr>
									<tr>
									<td colspan="2" style="padding-left: 0px;" >
										<?php echo $contacts_module_contacts_mess_title;?>
										<font style="color: red;">*</font>
										<?php
											$data = array(
              											'name'        => 'message',
              											'id'          => 'message',
              											'value'       => $this->validation->message,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
    	          										'style'       => 'width:100%',
        	    										); 
											echo form_textarea($data);
											echo $this->validation->message_error;
										?>
									</td>
									</tr>
									</table>
									</div>
								<div class="n_fb" style="padding-bottom: 5px;">
									<div style="text-align: right; padding-top: 5px; padding-bottom: 5px;">
									<span style="float: left;">
									<input name="w_error" style="border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="<?php echo $contacts_module_write_send_btn;?>" type="submit">
									</span>
									</div>
								</div>
								<?php echo form_close();?>
								</div>
							</div>
						</div>
					</div> 
