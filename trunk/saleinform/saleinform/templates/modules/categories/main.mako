#-*-coding: utf-8 -*-
<div class="catslist">
	<ul>
	% for cat in c.categories:
		<li>
			<div>
			<h4>
				${h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)}
			</h4>
			<%
			rest_length = 25
			subs = []
			for z in c.subcategories: 
				if z._parent_rid == cat.rid:
					if rest_length > 0: 
						link_text = h.h_text.truncate(z.name, length=rest_length, indicator='...', whole_word=False)
						subs.append(h.h_tags.link_to(link_text, url='/categories/'+z.slug, title=z.name))
						rest_length = rest_length - len(z.name)
					else: break
			%>
			${h.h_builder.literal(', '.join(subs))}
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

