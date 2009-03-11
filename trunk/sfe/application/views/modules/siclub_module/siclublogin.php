	<div class="box">
		<div class="b_h">
			<div id="hc_meta" class="b_hc" ><?php echo $siclub_loginarea_title?></div>
		</div>
		<div class="b_c">
			<div class="o" id="info_c" style="">
				<div id="info_cnt">
					<div style="overflow: hidden; clear: both; width: 220px;">
						<div style="margin-bottom: 5px; width: 100%;">
							<div style="width: 100%; clear: both;">
								<div style="width:200px;float: left;">
									<img src="<?php echo base_url()?>images/icons/vcard_edit.png" align="left" hspace="5">
									<b><?php echo $siclub_login_client_name?></b>
								</div>
							</div>
							<div style="width: 100%; clear: both;">
								<div style="width:200px;float: left;">
									<img src="<?php echo base_url()?>images/icons/user.png" align="left" hspace="5">
									<b><?php echo $siclub_login_user_name?></b>
								</div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/gn', $siclub_login_general_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/cnt', $siclub_login_contacts_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/add', $siclub_login_addinfo_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/pr', $siclub_login_priceinfo_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/per', $siclub_login_personal_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/acc', $siclub_login_account_label);?></b></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w4" style="width:200px;"><b><?php echo anchor(site_url().'/siclub/logout', $siclub_login_logout_label);?></b></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
		</div>