<div class="logo">
	<a target="_self" title="${_(u'Сравнение цен интернет магазинов, поиск товаров')}" href="/">
		${h.h_tags.image('/img/logo.gif', u'Сравнение цен интернет магазинов, поиск товаров', border="0")}
	</a>
</div>

<div class="glowingtabs" id="glowmenu">
	<ul>
		<li>
			${h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'Домашняя')+'</span>'), url='/admin/geography', title=_(u'Домашняя'))}
		</li>
		<li class="">
			${h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'География')+'</span>'), url='/admin/geography', title=_(u'География'), rel="dropmenu1_d")}
		</li>
		<li class="">
			${h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'География')+'</span>'), url='/admin/geography', title=_(u'География'), rel="dropmenu2_d")}
		</li>
		<li>
			${h.h_tags.link_to(h.h_builder.literal('<span>'+_(u'География')+'</span>'), url='/admin/geography', title=_(u'География'), rel="dropmenu1_d")}
		</li>
	</ul>
</div>

<div class="dropmenudiv_d" id="dropmenu1_d" style="top: 830px; left: 252px; visibility: hidden;">
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C1/" style="border-top-width: 0pt;">Horizontal CSS Menus</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C2/">Vertical CSS Menus</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C4/">Image CSS</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C6/">Form CSS</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C5/">DIVs and containers</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C7/">Links and Buttons</a>
	<a href="http://www.dynamicdrive.com/style/csslibrary/category/C8/">Other</a>
</div>

<div style="width: 150px; top: 830px; left: 351px; visibility: hidden;" class="dropmenudiv_d" id="dropmenu2_d">
	<a href="http://www.cssdrive.com" style="border-top-width: 0pt;">CSS Drive</a>
	<a href="http://www.javascriptkit.com">JavaScript Kit</a>
	<a href="http://www.codingforums.com">Coding Forums</a>
	<a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a>
</div>

<script type="text/javascript">
<!--
	tabdropdown.init("glowmenu", "auto")
//->
</script>