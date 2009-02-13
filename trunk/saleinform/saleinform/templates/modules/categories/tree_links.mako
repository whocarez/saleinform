<%def name="treeBuilder(node, lvl=0)">
<table class="wd750">
<tr>
<%
	index = 0
%>
% for n in node.children:
% if not lvl:
		<%
			index += 1
		%>
%
		% if len(n.children) <= 0:
        	${h.h_tags.link_to(n.category.name, url='/categories/'+n.category.slug, title=n.category.meta_title, class_="tree-link level"+str(lvl))}<br>
        % else: 
			<div class="tree-link-bold level${lvl}">${h.h_tags.link_to(n.category.name, url='/categories/'+n.category.slug, title=n.category.meta_title)}</div>        
        	${treeBuilder(n, lvl+1)}
        % endif
% endfor
</tr>
</table>
</%def>