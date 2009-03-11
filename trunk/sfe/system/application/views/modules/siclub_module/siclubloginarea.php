	<div class="box">
		<div class="b_h">
			<div id="hc_meta" class="b_hc" ><?php echo $siclub_loginarea_title?></div>
		</div>
		<div class="b_c">
			<div class="o" id="info_c" style="">
				<div id="meta_cnt">
								<div style="text-align: right;">
									<?php echo form_open('siclub/login')?>
										<div style="clear: both; white-space: nowrap;">
											<span style="float: left;"><?php echo $siclub_login_label?>:</span>
											<input style="float: right; width: 120px;" name="login_siclub" type="text">
										</div>
										<div style="clear: both; white-space: nowrap;">
											<span style="float: left;"><?php echo $siclub_password_label?>:</span>
											<input name="password_siclub" style="float: right; width: 120px;" type="password">
										</div>
										<div style="clear: both; white-space: nowrap;">
											<input name="subm_siclub" style="border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px;" class="btn" value="Войти" type="submit">
										</div>
										<div style="text-align: left; margin-top: 5px;">
											<?php 
											$data = array('style'=>"position: relative; z-index: 999;");
											echo anchor(base_url().index_page().'/clients/r', $siclub_registration_title, $data);
											?>
										</div>
									<?php echo form_close()?>
								</div>
				</div>
			</div>
		</div> 
	</div>