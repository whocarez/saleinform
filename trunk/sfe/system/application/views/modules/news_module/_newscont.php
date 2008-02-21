						<div style="padding: 5px;" id="themes_cnt">
							<div class="n_fb">
							    <?php echo $news_module_news_categories_cont; ?>
								<?php foreach($news_module_news_cont_arr as $item) { ?>
								<div style="margin-top: 5px; margin-bottom: 5px;">
									<div class="p">
										<a class="pic_link" href="">
										</a>
									</div>
									<a class="m" href="<?php echo $item['linkstring'];?>">
										<h1><?php echo $item['title'];?></h1>
									</a>
									<div style="color:#888888;font-size: 90%"><?php echo $news_area_new_author_title.'&nbsp;'.$item['author'];?></div>
									<div style="color:#888888;font-size: 90%"><?php echo $news_area_new_source_title.'&nbsp;'.$item['source_link'];?></div>									
									<div class="q">
										<?php if($item['img']) { ?>
											<img src="<?php echo $item['img']?>" align="right" hspace="5" style="padding:1px;border: 1px solid #677787;">
										<?php } ?>										
										<?php echo $item['new'];?>
									</div>
									<div style="float:right;"><?php echo $item['newlink'];?></div>
									<div class="i"><span><?php echo $item['newDATE'].'&nbsp;|&nbsp;'.$item['newCAT'];?></span></div>
								</div>
								<?php } ?>
							</div>
							<div style="float: right; margin-bottom: 5px;">
								<?php echo $last_module_news_allnews_link; ?><b class="more">&nbsp;</b>
							</div>
							<div style="float: right; margin-top: 5px;">
								<?php echo $news_module_news_pagination ?>
							</div>
							
						</div>