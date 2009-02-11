#-*-coding: utf-8 -*-
<%namespace name="subcats" file="subcats_links.mako"/>
<div class="catslist">
	<ul>
	% for cat in c.categories:
		<li>
			${h.h_tags.link_to(h.h_tags.image('/img/categories/icons/empty.png', cat.name, border="0"), url='/categories/'+cat.slug)}
			<div>
			<h4>
				${h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)}
			</h4>
			${subcats.subcatsAnchors(c.subcategories, cat.rid, rest_length=30)}
			</div>
		</li>
	% endfor
		<li class='last-cat-item'>
			<div>
			<h4>
				${h.h_tags.link_to(_(u'Все категории'), url='/categories')}
			</h4>
			</div>
		</li>
	</ul>
</div>
<div class="CategoryBrowserFooter"></div> 

