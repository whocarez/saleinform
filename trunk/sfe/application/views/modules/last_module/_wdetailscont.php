						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
								<?php foreach($last_module_wdetails_cont_arr as $item) { ?>
								<div style="margin-top: 5px; margin-bottom: 5px;">
									<div class="p">
										<a class="pic_link" href="">
										</a>
									</div>
									<a class="go_link" href="" target="_blank">
									</a> 
									<a class="m" href="<?php echo $item['warelink'];?>">
										<h1><?php echo $item['wareNAME'];?></h1>
									</a>
									<div style="float:right;"><?php echo $item['allwaredet'];?></div>									
									<div class="i"><span><?php echo $item['wdetailsDATE'];?></span></div>
								</div>
								<?php } ?>
							</div>
							<div style="float:right;margin-bottom: 5px;">
								<?php echo $last_module_news_allcats_link; ?><b class="more">&nbsp;</b>
							</div>
						</div>