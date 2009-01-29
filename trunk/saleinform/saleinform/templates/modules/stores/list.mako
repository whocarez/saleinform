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
	<tr>
		<td>
		</td>
		<td class="alignLeft">
			Adorama.com
		</td>
        <td class="noWrap">
        	<img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars40.gif"/><br/>
        	<small><a href="http://www.ciao.com/Adorama_com__15482215">15 Ratings</a>        					</small>
        </td>
        <td class="noWrap">
			<b><a href="http://www.ciao.com/shopping_partners/Adorama_com__5030188">Show Products</a></b>
   		</td>
        <td class="maintabCOLnar2">
		</td>
	</tr>
	<tr>
    	<td>
		</td>
		<td class="alignLeft">Amazon.com</td>
    	<td class="noWrap">
        <img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars45.gif"/><br/>
        	<small><a href="http://www.ciao.com/Amazon_com__15446580">281 Ratings</a>        					</small>
        </td>
        <td class="noWrap">
			<b><a href="http://www.ciao.com/shopping_partners/Amazon_com__5030062">Show Products</a></b>
        </td>
        <td class="maintabCOLnar2">
		</td>
	</tr>
</table>

<table cellspacing="0" class="resultrangedownbg3 bg2norm">
	<tr>
		<td class="rangenextpage">
		</td>
	</tr>
</table>

