#-*- coding: utf-8 -*-
<div id="menuContent">
<div id="mainNavUs">
<ul class="mainMenuUs">
<%def name="setId(slug, c_slug)">
	% if slug == c_slug:
		id="current"
	% endif
</%def> 
	% for cat in c.categories:
	<li ${setId(cat.slug, c.currentCategorySlug)}>
		${h.h_tags.link_to(h.h_builder.literal(''.join(['<span>',cat.name,'</span>'])), url=''.join(["/categories/",cat.slug]), title=cat.meta_title, target="_parent")}
	</li>
	% endfor
	<li ${setId(u'', c.currentCategorySlug)}>
		${h.h_tags.link_to(h.h_builder.literal(''.join(['<span><strong>',_(u'Еще...'),'</strong></span>'])), url="/categories/", target="_parent", title=_(u'Показать все категории'))}
	</li>
</ul>
</div>
</div>
