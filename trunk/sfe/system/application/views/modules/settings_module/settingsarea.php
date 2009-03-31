	<div class="box">
		<div class="b_c">
			<div class="o" id="info_c" style="">
				<div id="info_cnt">
					<div style="overflow: hidden; clear: both; width: 220px;">
						<div style="margin-bottom: 5px; width: 100%;">
							<span class="caption">
								<?php echo $settings_regions_title;?>
							</span>
							<br>
							<div style="width: 100%; clear: both;">
								<div class="w3"><b><?php echo $settings_country_name;?></b>
								</div>
								<div class="w4"><?php echo $settings_countries_title?></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w3"><b><?php echo $settings_region_name;?></b></div>
								<div class="w4"><?php echo $settings_regions_title?></div>
							</div>
							<div style="width: 100%; clear: both;">
								<div class="w3"><b><?php echo $settings_city_name;?></b></div>
								<div class="w4"><?php echo $settings_cities_title?></div>
							</div>
						</div>
						<div style="clear: both; width: 100%;padding-bottom: 5px;">
								<span class="caption">
									<?php echo $curr_list_title;?>
								</span>
								<br>
								<div style="width: 100%; clear: both;">
									<span class="tv1"><?php echo $settings_main_curr_cod?></span>
									<span class="tv3"><?php echo $settings_main_curr_title?></span>
								</div>
								<div style="width: 100%; clear: both;">
									<span class="tv1"><?php echo $settings_add_curr_cod?></span>
									<span class="tv3"><?php echo $settings_add_curr_title?></span>
								</div>
						</div>

						<div style="padding-bottom: 5px; width: 100%; clear: both;">
							<span class="caption">
								<?php echo $curr_cources_title;?>
							</span>
							<ul class="bul">
								<?php foreach($settings_officialcources as $item) { ?>
								<li> 
									<?php echo $item['currencyCOD']?> <b><?php echo $item['courceRATE']?></b> 
								</li>
								<?php } ?>
							</ul>
						</div>
						
						<span style="display: block; height: 14px;">
							<?php echo $settings_change_settings_title;?>
						</span>						
						</div>
					</div>
				</div>
			</div>
		</div> 