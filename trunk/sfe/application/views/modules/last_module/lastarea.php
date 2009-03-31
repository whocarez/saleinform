	<div class="box">
	<script type="text/javascript">
		function showLastTabContent(tabName)
		{
			var newsTabObj = document.getElementById('news_tab');
			var opinionsTabObj = document.getElementById('opinions_tab');
			var reviewsTabObj = document.getElementById('reviews_tab');
			var wdetailsTabObj = document.getElementById('wdetails_tab');

			var newsContentObj = document.getElementById('last_news');
			var opinionsContentObj = document.getElementById('last_opinions');
			var reviewsContentObj = document.getElementById('last_reviews');
			var wdetailsContentObj = document.getElementById('last_wdetails');

			if(tabName=='news_tab')
			{ 
				newsTabObj.className = 'rC';
				opinionsTabObj.className = 'rCG';
				reviewsTabObj.className = 'rCG';
				wdetailsTabObj.className = 'rCG';
				newsContentObj.style.display = 'block';
				opinionsContentObj.style.display = 'none';
				reviewsContentObj.style.display = 'none';
				wdetailsContentObj.style.display = 'none';
			} 
			else if(tabName=='opinions_tab')
			{
				newsTabObj.className = 'rCG';
				opinionsTabObj.className = 'rC';
				reviewsTabObj.className = 'rCG';
				wdetailsTabObj.className = 'rCG';
				newsContentObj.style.display = 'none';
				opinionsContentObj.style.display = 'block';
				reviewsContentObj.style.display = 'none';
				wdetailsContentObj.style.display = 'none';
			}
			else if(tabName=='reviews_tab')
			{
				newsTabObj.className = 'rCG';
				opinionsTabObj.className = 'rCG';
				reviewsTabObj.className = 'rC';
				wdetailsTabObj.className = 'rCG';
				newsContentObj.style.display = 'none';
				opinionsContentObj.style.display = 'none';
				reviewsContentObj.style.display = 'block';
				wdetailsContentObj.style.display = 'none';
			}
			else
			{
				newsTabObj.className = 'rCG';
				opinionsTabObj.className = 'rCG';
				reviewsTabObj.className = 'rCG';
				wdetailsTabObj.className = 'rC';
				newsContentObj.style.display = 'none';
				opinionsContentObj.style.display = 'none';
				reviewsContentObj.style.display = 'none';
				wdetailsContentObj.style.display = 'block';
			}
		}
	</script>
		<div class="b_h">
			<div class="rbs" id="news_3pic">
			</div>
			<a id="wdetails_tab" class="rCG" onclick="showLastTabContent('wdetails_tab')">
				<span id="news_3text"><?php echo $last_module_wdetails_area_tab?></span>
			</a>
			<a id="reviews_tab" class="rCG" onclick="showLastTabContent('reviews_tab')">
				<span id="news_2text"><?php echo $last_module_reviews_area_tab?></span>
			</a>
			<a id="opinions_tab" class="rCG" onclick="showLastTabContent('opinions_tab')">
				<span><?php echo $last_module_opinions_area_tab?></span>
			</a>
			<a id="news_tab" class="rC" onclick="showLastTabContent('news_tab')">
				<span><?php echo $last_module_news_area_tab?></span>
			</a>
			<div id="hc_news" class="b_hc" >
				<?php echo $last_module_area_title?>
			</div>
		</div>
			<a class="hide" href="#" id="news_r" >#</a>
			<div class="b_c">
				<div class="o" id="news_c" style="">
					<div id="news_md" class="m_d">
					</div>
					<div id="news_cnt">
						<div id="last_news" style="display: block;">
							<?php echo $last_module_news_area_content;?>
						</div>
						<div id="last_opinions" style="display: none;">
							<?php echo $last_module_opinions_area_content;?>
						</div>
						<div id="last_reviews" style="display: none;">
							<?php echo $last_module_reviews_area_content;?>
						</div>
						<div id="last_wdetails" style="display: none;">
							<?php echo $last_module_wdetails_area_content;?>
						</div>
					</div>
				</div>
			</div>
		</div>
