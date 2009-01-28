#-*-coding: utf-8 -*-
<div class="zs-narrow">
	<div class="home-slogan">
	</div>
	<div class="fq2">
	<h4>${_(u'Поиск товаров, лучших цен и отзывов')}</h4>
	${h.h_tags.form('/', multipart=False)}
		<input id="searchString" name="searchString" class="mainQ" value="" type="text">
		<input id="categoryRid" name="categoryRid" value="" type="hidden">
		<input type="button" name="searchBtn" class="searchSubmit" value="${_(u'Найти')}"/>
	${h.h_tags.end_form()}
	</div>
</div>

