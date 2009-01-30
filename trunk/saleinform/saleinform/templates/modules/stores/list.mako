#-*-coding:utf-8-*-
<%doc>
	список все магазинов
</%doc>
<h1 class="h1 default">${_(u'Все магазины на Saleinform, начинающиеся на ')}</h1>
<table cellspacing="0" class="resultrangetop3bd bg2norm">
	<tbody>
		<tr>
			<td class="letterShopsNavHead">
				% for l in map(chr, range(65, 91)):
				${h.h_tags.link_to(l, url='/stores/letter/'+str(ord(l)))}
				% endfor
			</td>
		</tr>
	</tbody>
</table>

<table cellspacing="1" class="common">
	<thead>
    	<tr>
			<th>${_(u'Логотип')}</th>
			<th>${_(u'Название магазина')}</th>
			<th>${_(u'Рейтинг')}</th>
			<th>${_(u'Товары')}</th>
			<th>${_(u'Сайт магазина')}</th>
		</tr>
	</thead>
	% for store in c.stores:
	<tr>
		<td>
		</td>
		<td class="alignLeft">
			${store.name}
		</td>
        <td class="noWrap">
        	${store.popularity}
        	<img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars40.gif"/><br/>
        	<small><a href="http://www.ciao.com/Adorama_com__15482215">15 Ratings</a>        					</small>
        </td>
        <td class="noWrap">
			<b><a href="http://www.ciao.com/shopping_partners/Adorama_com__5030188">${_(u'Показать товары')}</a></b>
   		</td>
        <td class="maintabCOLnar2">
        	${store.url}
		</td>
	</tr>
	% endfor
</table>

<table cellspacing="0" class="resultrangedownbg3 bg2norm">
	<tr>
		<td class="rangenextpage">
		</td>
	</tr>
</table>

