				<?php if($linkschange_list) {?>
				<div class="box">
					<div class="b_h">
						<div id="hc_meta" class="b_hc" >Полезные ресурсы</div>
					</div>
					<div class="b_c" style="">
						<div class="o" id="proj_c">
							<div id="proj_cnt">
								<div style="overflow: hidden; width: 130px;">
									<?php foreach($linkschange_list as $row) { ?>
									<div class="proj_bul">
										<a href="<?php echo $row['link'] ?>" title="<?php echo $row['descr'] ?>"><?php echo $row['linktext'] ?></a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				