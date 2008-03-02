	<div class="box">
		<div class="b_h">
			<div id="hc_meta" class="b_hc" ><?php echo $searches_title;?></div>
		</div>
		<div class="b_c">
			<div class="o" id="chat_c" style="">
				<div id="chat_cnt">
					<div style="clear: both;">
						<!-- -->
						<?php foreach($mostpopular_searches_arr as $key=>$row) {?>
							<?php if(($key%2)==1) { ?>
							<div style="margin-bottom:6px;float:left;width:45%;overflow: hidden;">
							<?php } else { ?>
							<div style="margin-bottom:6px;float:left;width:45%;overflow: hidden;">
							<?php } ?>
							<span style="font:bold 77%/150% verdana;"><font color="#DF7E4F"><?php echo $key+1;?>.</font>&nbsp;&nbsp;<?php echo $row['query'];?></span>
							</div>
						<?php } ?>
						<!--  -->
					</div>
				</div>
			</div>
		</div>
	</div>
