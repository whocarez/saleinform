<div id="settings_box_container">
					<div class="box" id="settings_box">
						<div class="b_h">
							<div id="hc_market" class="b_hc" >
								<?php echo $settings_area_title;?>
							</div>
						</div>
						<div class="b_c">
							<div class="o" id="market_c" style="">
								<div id="market_md" class="m_d">
								</div>
								<div id="market_cnt">
					
<?php echo form_open('/settings', array('name'=>'settings_form', 'id'=>'settings_form'))?>
	<table style="font-size: 100%;">
		<tr>
			<td colspan="2" valign="top" style="width: 100%">
			<div class="sb"><span class="bold_blue"><?php echo $settings_countries_title?></span><br>			
				<?php
					foreach($settings_countries_list as $item) {
					$data = array('type'=>"radio",
									'name'=>"settings_country_rid",
									'id'=>"settings_country_rid",
									'value'=>$item['rid'],
									'checked'=>($item['rid']==$settings_current_country_rid)?TRUE:FALSE,
									'value'=>$item['rid'],
									'onClick'=>"CountryChange();"); 
				?>
				<nobr><?php echo form_radio($data).$item['name'];?>&nbsp;</nobr><wbr>
				<?php } ?>
			</div>
			</td>
		</tr>
		<tr>
			<td valign="top" width="50%">
			<div class="sb"><span class="bold_blue"><?php echo $curr_list_title;?></span><br>
			<table style="font-size: 100%;">
			<tr>
				<td class="valign"><?php echo $settings_main_curr_title;?>:&nbsp;</td>
				<td class="valign" style="width: 100%; padding-right: 20px;">
				<?php
				$data = array('type'=>"text", 
								'name'=>"settings_main_currency", 
								'id'=>"settings_main_currency",
								'readonly'=>TRUE, 
								'value'=>$settings_current_main_currency['name'], 
								'class'=>"i", 
								'style'=>"width: 130px; font-size: 12px;");
				echo form_input($data);
				?>
				</td>
			</tr>
			<tr>
				<td class="valign"><?php echo $settings_add_curr_title;?>:&nbsp;</td>
				<td class="valign" style="padding-right: 20px;">
				<?php
				$data = array();
				$options = 'id="settings_add_currency_rid" class="i" style="width: 100%; font-size: 12px;"';
				foreach($settings_currencies_list as $item) $data[$item['rid']] = $item['name'];
				echo form_dropdown('settings_add_currency_rid', $data, $settings_current_add_currency_rid, $options);
				?>
				</td>
			</tr>
			</table>
			</div>
			</td>
			<td valign="top" width="50%">
			<div class="sb"><span class="bold_blue"><?php echo $settings_regions_title;?></span><br>
				<table style="font-size: 100%;">
					<tr>
						<td><?php echo $settings_regions_title;?>:&nbsp;</td>
						<td width="100%">
						<?php
						$data = array();
						$data[0] = $settings_all_value;
						$options = 'name="settings_regions" id="settings_regions" class="i" onChange="RegionChange();" style="width: 100%; font-size: 12px;"';
						foreach($settings_regions_list as $item) $data[$item['rid']] = $item['name'];
						echo form_dropdown('settings_region_rid', $data, $settings_current_region_rid, $options);
						?>
						</td>
					</tr>
					<tr>
						<td><?php echo $settings_cities_title;?>:&nbsp;</td>
						<td width="100%">
						<div id="settings_citieslist">
						<?php
						$data = array();
						$data[0] = $settings_all_value;
						$options = 'name="settings_cities" id="settings_cities"  class="i" style="width: 100%; font-size: 12px;"';
						foreach($settings_cities_list as $item) $data[$item['rid']] = $item['name'];
						echo form_dropdown('settings_city_rid', $data, $settings_current_city_rid, $options);
						?>
						</div>
						</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
		<?php if($settings_inform_status) {?>
		<tr>
			<td colspan="2" valign="bottom" style="text-align: left;">
			<img src="<?php echo base_url()?>images/icons/0368.png" align="left" width="32" height="32">
			<span style="color: #888888;vertical-align: bottom;">
			<?php echo $settings_inform_status;?>
			</span>	
			</td>		
		</tr>
		<?php }?>
		<tr>
			<td colspan="2" style="text-align: right; vertical-align: middle;">
				<input type="submit" value="<?php echo $settings_save_button_title;?>" class="btn">
			</td>
		</tr>
	</table>
<?php echo form_close();?>
								</div>
							</div>
						</div>
					</div>
</div>
