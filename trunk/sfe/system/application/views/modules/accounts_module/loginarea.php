				<div class="box">
					<div class="b_h">
						<div id="hc_meta" class="b_hc" ><?php echo $accounts_login_area_title;?></div>
					</div>
					<div class="b_c">
						<div class="o" id="meta_c" style="">
							<div id="meta_cnt">
								<div style="text-align: right;">
									<?php echo form_open('accounts/login')?>
										<div style="clear: both; white-space: nowrap;">
											<span style="float: left;"><?php echo $accounts_login_label?>:</span>
											<input tabindex="100" style="float: right; width: 80px;" name="login" type="text">
										</div>
										<div style="clear: both; white-space: nowrap;">
											<span style="float: left;"><?php echo $accounts_password_label?>:</span>
											<input name="password" tabindex="101" style="float: right; width: 80px;" type="password">
										</div>
										<input tabindex="102" name="subm" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="Войти" type="submit">
										<div style="text-align: left; margin-top: 5px;">
											<?php 
											$data = array('style'=>"position: relative; z-index: 999;");
											echo anchor(base_url().index_page().'/accounts/restorepass', $accounts_password_forgot_title, $data);
											?>
											<?php 
											$data = array('style'=>"position: relative; z-index: 999;");
											echo anchor(base_url().index_page().'/accounts', $accounts_registration_title, $data);
											?>
										</div>
										<input type="hidden" name="curr_url" value="<?php echo $accounts_login_area_curr_url?>">
									<?php echo form_close()?>
								</div>
							</div>
						</div>
					</div>
				</div> 
