						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
								<?php foreach($last_module_news_cont_arr as $item) { ?>
								<div style="margin-top: 5px; margin-bottom: 5px;padding-bottom: 5px;">
									<a class="m" href="<?php echo $item['linkstring'];?>">
										<h1><?php echo $item['title'];?></h1>
									</a>
									<div class="q" style="height:55px;">
										<?php if($item['img']) { ?>
											<img src="<?php echo $item['img']?>" align="right" hspace="5" style="padding:1px;border: 1px solid #677787;">
										<?php } ?>										
										<?php echo $item['new'];?>
									</div>
									<div>
										<div style="float:right;"><?php echo $item['newlink'];?></div>									
										<div class="i"><span><?php echo $item['newDATE'];?></span></div>
									</div>
								</div>
								<?php } ?>
							</div>
							<div style="float:right;margin-bottom: 5px;">
								<?php echo $last_module_news_allnews_link; ?><b class="more">&nbsp;</b>
							</div>
						</div>