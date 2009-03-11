	<div class="box" >
		<div class="b_h">
			<div id="hc_meta" class="b_hc" ><?php echo $mostpopular_categories_carousel_title;?></div>
		</div>
		<div class="b_c">
			<div class="o" id="chat_c" style="">
				<div id="chat_cnt">
					<div style="clear: both;width: 100%;">
					
					
<div id="catcarousel" class="carousel-component">
    <div class="carousel-prev">
        <img id="prev-arrow" class="left-button-image" 
            src="images/left-enabled.gif"/>
    </div>
    <center>
    <div class="carousel-clip-region" style="margin-left: 40px;margin-right: 40px;">
        <ul class="carousel-list">
        	<?php foreach($mostpopular_categories_carousel as $key=>$row) { ?>
            <li id="catcarousel-item-<?php echo $key+1; ?>">
            	<center>
				<a href="<?php echo site_url().'/categories/c/'.$row['rid']?>"><img width="100" height="100" src="<?php echo $row['iimage']?>"/></a><br>
				<font style="font-size: 1em; font-weight: bold;"><?php echo $row['name']; $index=0;?></font>
				</center>
					<?php foreach ($row['childNodes'] as $cat) { ?>
							<div nowrap>
							<?php 
								$index++;
								if($index>5) break; 
								echo $index.'.'.anchor(base_url().index_page().'/categories/c/'.$cat['rid'], $cat['name']);
							?>
							</div>
					<?php } ?>
			</li>
			<?php } ?>
		</ul>
    </div>
    </center>
    <div class="carousel-next">
        <img id="next-arrow" class="right-button-image" 
            src="images/right-enabled.gif"/>
    </div>
</div>
					</div>
				</div>
			</div>
		</div>
	</div>
