#-*-coding:utf-8-*-
<%page cached="False"/>
<%doc>
	дерево всех категорий
</%doc>
<%namespace name="tree" file="tree_links.mako"/>
<table class="wd750">
	<tr>
    	<td align="center" class="bcrumbhdl">
    	</td>
  	</tr>
  	<tr>
    	<td class="bcrumbhdl">
    		${h.h_tags.link_to(_(u'Домашняя'), url='/', title=_(u'Поиск товаров, сравнение цен'))} > 
    		<span class="greyb">${_(u'Дерево категорий')}</span><br/><br/>
        	<span class="headline">${_(u'Дерево категорий')}</span>
        	<hr noshade="noshade"/>
    	</td>
	</tr>
	<tr>
		<td>
			${tree.treeBuilder(c.a_categories_tree.Root)}
		</td>
	</tr>
</table>