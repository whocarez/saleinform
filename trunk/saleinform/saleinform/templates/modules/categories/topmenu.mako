#-*- coding: utf-8 -*-
<div id="menuContent">
<div id="mainNavUs">
<ul class="mainMenuUs">
	% for cat in c.categories:
	<li>
		<a target="_parent" href="/categories/${cat.slug}"><span>${cat.name}</span></a>
	</li>
	% endfor
	<li><a target="_parent" href="/categories/${cat.slug}" title="${_(u'Показать все категории')}">
			<span><strong>${_(u'Еще...')}</strong></span>
		</a>
	</li>
</ul>
</div>
</div>
