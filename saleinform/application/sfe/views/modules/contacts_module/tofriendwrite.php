					<div class="box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $contacts_module_write_tofriend_title;?>
							</div>
						</div>
						
						<a class="hide" href="#" id="market_r" >#</a>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div class="n_fb" style="text-align: left;">
									<?php echo $contacts_module_write_tofriend_descr;?>
								</div>
								<div id="market_cnt">
								<?php echo form_open('contacts/sf')?>
									<div>
									<table style="font-size: 100%;">
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_write_tofriend_name_sender;?>
										<font style="color: red;">*</font>
									</td>
									<td style="padding-left: 0px;" >
										<?php
											$data = array(
              											'name'        => 'sender_name',
              											'id'          => 'sender_name',
              											'value'       => $this->validation->sender_name,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
              											'style'       => 'width:150px',
            											); 
											echo form_input($data);
											echo $this->validation->sender_name_error;
										?>
									</td>
									</tr>
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_write_tofriend_sender;?>
										<font style="color: red;">*</font>
									</td>
									<td style="padding-left: 0px;" >
										<?php
											$data = array(
              											'name'        => 'sender_email',
              											'id'          => 'sender_email',
              											'value'       => $this->validation->sender_email,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
              											'style'       => 'width:150px',
            											); 
											echo form_input($data);
											echo $this->validation->sender_email_error;
										?>
									</td>
									</tr>
									<tr>
									<td style="padding-left: 0px;" >
										<?php echo $contacts_module_write_tofriend_reciever;?>
										<font style="color: red;">*</font>
									</td>
									<td style="padding-left: 0px;" >
										<?php
											$data = array(
              											'name'        => 'reciever_email',
              											'id'          => 'reciever_email',
              											'value'       => $this->validation->reciever_email,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
	              										'style'       => 'width:150px',
    	        										); 
											echo form_input($data);
											echo $this->validation->reciever_email_error;
										?>
									</td>
									</tr>
									<tr>
									<td colspan="2" style="padding-left: 0px;" >
										<?php echo $contacts_module_write_tofriend_comment;?>
										<font style="color: red;">*</font>
										<?php
											$data = array(
              											'name'        => 'tofriend_content',
              											'id'          => 'tofriend_content',
              											'value'       => ($this->validation->tofriend_content)?$this->validation->tofriend_content:$contacts_module_write_tofriend_uri,
              											'maxlength'   => '100',
              											'size'        => '50',
														'class'		  => 'i',
    	          										'style'       => 'width:100%',
        	    										); 
											echo form_textarea($data);
											echo $this->validation->tofriend_content_error;
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
								<br>
							</div>
						</div>
					</div> 
