#-*-coding: utf-8 -*-
<%doc>
	Сокращенный список подкатегорий
</%doc>
<%def name="subcatsAnchors(subcatsList, catRid, rest_length=30)">
<%
	subs = []
	for z in subcatsList: 
		if z._parent_rid == catRid:
			if rest_length > 0: 
				subs.append(h.h_tags.link_to(z.name, url='/categories/'+z.slug, title=z.name, title=z.meta_title))
				rest_length = rest_length - len(z.name)
			else: break
%>
${h.h_builder.literal(', '.join(subs))}...
</%def>