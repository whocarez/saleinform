#-*-coding:utf-8-*-
<ul>
% for region in c.a_regions:
	<li id='region${region.rid}'><span>${region.name}</span>
	${h.h_tags.link_to(h.h_tags.image('/img/icons/add.png', alt=_(u'Добавить город'), border="0"), '/admin/regions/cp?_regions_rid=%s'%(region.rid), title=_(u'Добавить город'))}
	${h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', alt=_(u'Редактировать регион'), border="0"), '/admin/regions/rp/%s?_countries_rid=%s'%(region.rid, region._countries_rid), title=_(u'Редактировать регион'))}
	${h.h_tags.link_to(h.h_tags.image('/img/icons/delete.png', alt=_(u'Удалить регион'), border="0"), '/admin/regions/rr/%s'%region.rid, title=_(u'Удалить регион'))}
		<ul class="ajax">
			<li>{url:/admin/regions/get?region=${region.rid}}</li>
		</ul>
	</li>
% endfor
</ul>
