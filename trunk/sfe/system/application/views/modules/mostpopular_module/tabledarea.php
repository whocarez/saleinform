<div id="mostpopular_tabledarea">
	<script type="text/javascript">
		function showTabContent(tabName)
		{
			var brandsTabObj = document.getElementById('brands_tab');
			var storesTabObj = document.getElementById('stores_tab');
			var storesContentObj = document.getElementById('mostpopular_stores');
			var brandsContentObj = document.getElementById('mostpopular_brands');
			if(tabName=='brands_tab')
			{ 
				brandsTabObj.className = 'rCG';
				storesTabObj.className = 'rC';
				brandsContentObj.style.display = 'none';
				storesContentObj.style.display = 'block';
			} 
			else 
			{
				brandsTabObj.className = 'rC';
				storesTabObj.className = 'rCG';
				storesContentObj.style.display = 'none';
				brandsContentObj.style.display = 'block';
			}
		}
	</script>
	<div class="box">
		<div class="b_h">
			<a id="stores_tab" class="<?php echo ($mostpopular_current_tab=='stores')?'rC':'rCG'?>" onclick="showTabContent('brands_tab')">
				<span id="social_1text"><?php echo $stores_tab_title;?></span>
			</a>
			<a id="brands_tab" class="<?php echo ($mostpopular_current_tab=='brands')?'rC':'rCG'?>" onclick="showTabContent('stores_tab')">
				<span id="social_1text"><?php echo $brands_tab_title;?></span>
			</a>
			<div id="hc_social" class="b_hc" >
				<?php echo $mostpopular_area_title;?>
			</div>
		</div>
		<div class="b_c">
			<div class="o" id="social_c" style="">
				<div id="social_md" class="m_d">
				</div>
				<div id="social_cnt">
					<div id="mostpopular_brands" style="<?php echo ($mostpopular_current_tab=='stores')?'display:none':''?>" >
					<div style="overflow: hidden; width: 220px;">
						<ul class="bul">
							<?php foreach($mostpopular_brands_arr as $row){ ?>
							<li>
								<?php echo $row['brand_link'];?>
								<span style="font-size: 8pt; color: #888888;">
									(<?php echo $row['pritemsQUAN'];?>)<br>
									<?php #echo $row['descr'];?>
								</span>
							</li>
							<?php } ?>
						</ul>
					</div>
					<span style="float:right;"><?php echo $mostpopular_all_brands_link;?>&nbsp;<b class="more"></b></span>
					</div>
					<div id="mostpopular_stores" style="<?php echo ($mostpopular_current_tab=='brands')?'display:none':''?>">
					<div style="overflow: hidden; width: 220px;">
						<ul class="bul">
							<?php foreach($mostpopular_clients_arr as $row){ ?>
							<li>
								<?php echo $row['client_link'];?>
								<span style="font-size: 8pt; color: #888888;">
									(<?php echo $row['pritemsQUAN'];?>)<br>
									<?php echo $row['descr'];?>
								</span>
							</li>
							<?php } ?>
						</ul>
					</div>
					<span style="float:right;"><?php echo $mostpopular_all_clients_link;?>&nbsp;<b class="more"></b></span>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>	
</div>