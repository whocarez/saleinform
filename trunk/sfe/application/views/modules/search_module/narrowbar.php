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
	<h4><?=lang('SEARCH_TITLE')?></h4>
    <?=form_open('', array('id'=>"searchForm", 'name'=>"searchForm"))?>
	   	<?=form_input(array('id'=>"searchString", 'name'=>"searchString", 'class'=>"mainQ", 'value'=>""))?>
       	<?=form_hidden(array("categoryRid"=>""))?>
       	<?=form_button(array('name'=>"searchBtn", 'class'=>"searchSubmitSmall", 'value'=>lang('SEARCH_GO_1'), 'content'=>lang('SEARCH_GO_1')))?>
    <?=form_close();?>
	</div>
</div>

