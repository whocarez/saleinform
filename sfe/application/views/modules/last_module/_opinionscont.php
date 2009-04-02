						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
								<?php foreach($last_module_opinions_cont_arr as $item) { ?>
								<div style="margin-top: 5px; margin-bottom: 15px;">
									<div class="p">
										<a class="pic_link" href="">
										</a>
									</div>
									<a class="go_link" href="" target="_blank">
									</a> 
									<a class="m" href="<?php echo $item['warelink'];?>">
										<h1><?php echo $item['wareNAME'];?></h1>
									</a> 
									<div class="i">
										<img src="<?php echo base_url().'images/ratings/'.$item['mark'].'.gif'?>" align="absmiddle" border=0 alt=""/>&nbsp;(<?php echo $item['mark']?>/10)
									</div>
									<div class="q"><?php echo $item['opinion'];?></div>
									<div style="float:right;"><?php echo $item['allwareops'];?></div>									
									<div class="i"><span><?php echo $item['display_name'];?>&nbsp;:<?php echo $item['opinionDATE'];?></span></div>
								</div>
								<?php } ?>
							</div>
							<div style="float:right;margin-bottom: 5px;">
								<?php echo $last_module_news_allcats_link; ?><b class="more">&nbsp;</b>
							</div>
						</div>