#-*-coding: utf-8 -*-
<div class="zs-narrow">
	<div class="home-slogan">
		<ul id="navigationUs">
				<li>
					<a rel="nofollow" class="navLinkUs" title="latest videos" href="/top_video_reviews.php">latest videos</a>
				</li>
							<li>
					<a rel="nofollow" class="navLinkUs" title="best picks" href="/product_lists_overview.php">best picks</a>
				</li>
							<li>
					<a class="navLinkUs" title="latest reviews" href="/top20_opinion.php">latest reviews</a>
				</li>
							<li class="last">
					<a class="navLinkUs" title="price comparison" href="/">price comparison</a>
				</li>
								
		</ul>
	</div>
	<div class="fq2-narrow">
	<h4>${_(u'Поиск товаров, лучших цен и отзывов')}</h4>
	${h.h_tags.form('/', multipart=False)}
		<input id="searchString" name="searchString" class="mainQ" value="" type="text">
		<input id="categoryRid" name="categoryRid" value="" type="hidden">
		<input type="button" name="searchBtn" class="searchSubmitSmall" value="${_(u'Найти')}"/>
	${h.h_tags.end_form()}
	</div>
</div>

