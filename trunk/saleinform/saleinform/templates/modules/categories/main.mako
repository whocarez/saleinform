#-*-coding: utf-8 -*-
<div class="catslist">
	<ul>
	% for cat in c.categories:
		<li>
			<h4>
				${h.link_to(cat.name, url='/categories/'+cat.slug)}
			</h4>
		</li>
	% endfor
		<li class='last-cat-item'>
			<h4>
				${h.link_to(_(u'Все категории'), url='/categories')}
			</h4>
		</li>
	</ul>
</div>
<div class="CategoryBrowserFooter"></div> 
