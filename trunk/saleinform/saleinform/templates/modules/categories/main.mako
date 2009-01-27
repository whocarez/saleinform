#-*-coding: utf-8 -*-
<div class="catslist">
	<ul>
	% for cat in c.categories:
		<li>
			<h4>
				${h.h_tags.link_to(cat.name, url='/categories/'+cat.slug)}
				${h.h_text.truncate(', '.join([h.h_tags.link_to(z.name, url='/categories/'+z.slug) for z in c.subcategories]), length=50, indicator='...', whole_word=False)}				
			</h4>
		</li>
	% endfor
		<li class='last-cat-item'>
			<h4>
				${h.h_tags.link_to(_(u'Все категории'), url='/categories')}
			</h4>
		</li>
	</ul>
</div>
<div class="CategoryBrowserFooter"></div> 

