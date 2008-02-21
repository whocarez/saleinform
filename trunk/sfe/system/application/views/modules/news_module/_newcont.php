						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
								<div style="margin-top: 5px; margin-bottom: 5px;">
									<div class="p">
										<a class="pic_link" href="">
										</a>
									</div>
									<div class="q">
										<?php if($news_module_news_current_new_img) { ?>
											<img src="<?php echo $news_module_news_current_new_img;?>" align="left" hspace="5" >
										<?php } ?>							
										<span class="caption"><?php echo $news_module_news_current_new['title'];?></span>
										<div style="color:#888888;font-size: 90%"><?php echo $news_area_new_author_title.'&nbsp;'.$news_module_news_author;?></div>
										<div style="color:#888888;font-size: 90%"><?php echo $news_area_new_source_title.'&nbsp;'.$news_module_news_link;?></div>									
										<br><br>
										<?php echo $news_module_news_current_new['new'];?>
									</div>
									<div class="i"><span><?php echo $news_module_news_current_new['newDATE'].'&nbsp;|&nbsp;'.$news_module_news_current_new['newCAT'];?></span></div>
								</div>
							</div>
							<div style="float:right;margin-bottom: 5px;">
								<?php echo $last_module_news_allnews_link; ?><b class="more">&nbsp;</b>
							</div>
						</div>