#-*-coding:utf-8-*-
<ul>
% for city in c.a_cities:
	<li id='city${city.rid}'><span>${city.name}</span>
	${h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', alt=_(u'Редактировать город'), border="0"), '/admin/regions/cp/%s?_regions_rid=%s'%(city.rid, city._regions_rid), title=_(u'Редактировать город'))}
	${h.h_tags.link_to(h.h_tags.image('/img/icons/delete.png', alt=_(u'Удалить город'), border="0"), '/admin/regions/rc/%s'%city.rid, title=_(u'Удалить город'))}
	</li>
% endfor
</ul>
