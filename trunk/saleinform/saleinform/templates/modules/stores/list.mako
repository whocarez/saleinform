#-*-coding:utf-8-*-
<%doc>
	список все магазинов
</%doc>
<h1 class="h1 default">${_(u'Все магазины на Saleinform, начинающиеся на ')}"${c.letter}"</h1>
<table cellspacing="0" class="resultrangetop3bd bg2norm">
	<tbody>
		<tr>
			<td class="letterShopsNavHead">
				${h.h_tags.link_to_unless(c.letter==u'A', u'A', url='/stores/letter/%s'%u'A')}
				${h.h_tags.link_to_unless(c.letter==u'B', u'B', url='/stores/letter/%s'%u'B')}
				${h.h_tags.link_to_unless(c.letter==u'C', u'C', url='/stores/letter/%s'%u'C')}
				${h.h_tags.link_to_unless(c.letter==u'D', u'D', url='/stores/letter/%s'%u'D')}
				${h.h_tags.link_to_unless(c.letter==u'E', u'E', url='/stores/letter/%s'%u'E')}
				${h.h_tags.link_to_unless(c.letter==u'F', u'F', url='/stores/letter/%s'%u'F')}
				${h.h_tags.link_to_unless(c.letter==u'G', u'G', url='/stores/letter/%s'%u'G')}
				${h.h_tags.link_to_unless(c.letter==u'H', u'H', url='/stores/letter/%s'%u'H')}
				${h.h_tags.link_to_unless(c.letter==u'I', u'I', url='/stores/letter/%s'%u'I')}
				${h.h_tags.link_to_unless(c.letter==u'J', u'J', url='/stores/letter/%s'%u'J')}
				${h.h_tags.link_to_unless(c.letter==u'K', u'K', url='/stores/letter/%s'%u'K')}
				${h.h_tags.link_to_unless(c.letter==u'L', u'L', url='/stores/letter/%s'%u'L')}
				${h.h_tags.link_to_unless(c.letter==u'M', u'M', url='/stores/letter/%s'%u'M')}
				${h.h_tags.link_to_unless(c.letter==u'N', u'N', url='/stores/letter/%s'%u'N')}
				${h.h_tags.link_to_unless(c.letter==u'O', u'O', url='/stores/letter/%s'%u'O')}
				${h.h_tags.link_to_unless(c.letter==u'P', u'P', url='/stores/letter/%s'%u'P')}
				${h.h_tags.link_to_unless(c.letter==u'Q', u'Q', url='/stores/letter/%s'%u'Q')}
				${h.h_tags.link_to_unless(c.letter==u'R', u'R', url='/stores/letter/%s'%u'R')}
				${h.h_tags.link_to_unless(c.letter==u'S', u'S', url='/stores/letter/%s'%u'S')}
				${h.h_tags.link_to_unless(c.letter==u'T', u'T', url='/stores/letter/%s'%u'T')}
				${h.h_tags.link_to_unless(c.letter==u'U', u'U', url='/stores/letter/%s'%u'U')}
				${h.h_tags.link_to_unless(c.letter==u'V', u'V', url='/stores/letter/%s'%u'V')}
				${h.h_tags.link_to_unless(c.letter==u'W', u'W', url='/stores/letter/%s'%u'W')}
				${h.h_tags.link_to_unless(c.letter==u'X', u'X', url='/stores/letter/%s'%u'X')}
				${h.h_tags.link_to_unless(c.letter==u'Y', u'Y', url='/stores/letter/%s'%u'Y')}
				${h.h_tags.link_to_unless(c.letter==u'Z', u'Z', url='/stores/letter/%s'%u'Z')}
				&nbsp;&nbsp;|&nbsp;&nbsp;
				${h.h_tags.link_to_unless(c.letter==u'А', u'А', url='/stores/letter/%s'%u'А')}
				${h.h_tags.link_to_unless(c.letter==u'Б', u'Б', url='/stores/letter/%s'%u'Б')}
				${h.h_tags.link_to_unless(c.letter==u'В', u'В', url='/stores/letter/%s'%u'В')}
				${h.h_tags.link_to_unless(c.letter==u'Г', u'Г', url='/stores/letter/%s'%u'Г')}
				${h.h_tags.link_to_unless(c.letter==u'Д', u'Д', url='/stores/letter/%s'%u'Д')}
				${h.h_tags.link_to_unless(c.letter==u'Э', u'Э', url='/stores/letter/%s'%u'Э')}
				${h.h_tags.link_to_unless(c.letter==u'Е', u'Е', url='/stores/letter/%s'%u'Е')}
				${h.h_tags.link_to_unless(c.letter==u'Ж', u'Ж', url='/stores/letter/%s'%u'Ж')}
				${h.h_tags.link_to_unless(c.letter==u'З', u'З', url='/stores/letter/%s'%u'З')}
				${h.h_tags.link_to_unless(c.letter==u'И', u'И', url='/stores/letter/%s'%u'И')}
				${h.h_tags.link_to_unless(c.letter==u'Й', u'Й', url='/stores/letter/%s'%u'Й')}
				${h.h_tags.link_to_unless(c.letter==u'К', u'К', url='/stores/letter/%s'%u'К')}
				${h.h_tags.link_to_unless(c.letter==u'Л', u'Л', url='/stores/letter/%s'%u'Л')}
				${h.h_tags.link_to_unless(c.letter==u'М', u'М', url='/stores/letter/%s'%u'М')}
				${h.h_tags.link_to_unless(c.letter==u'Н', u'Н', url='/stores/letter/%s'%u'Н')}
				${h.h_tags.link_to_unless(c.letter==u'О', u'О', url='/stores/letter/%s'%u'О')}
				${h.h_tags.link_to_unless(c.letter==u'П', u'П', url='/stores/letter/%s'%u'П')}
				${h.h_tags.link_to_unless(c.letter==u'Р', u'Р', url='/stores/letter/%s'%u'Р')}
				${h.h_tags.link_to_unless(c.letter==u'С', u'С', url='/stores/letter/%s'%u'С')}
				${h.h_tags.link_to_unless(c.letter==u'Т', u'Т', url='/stores/letter/%s'%u'Т')}
				${h.h_tags.link_to_unless(c.letter==u'У', u'У', url='/stores/letter/%s'%u'У')}
				${h.h_tags.link_to_unless(c.letter==u'Ф', u'Ф', url='/stores/letter/%s'%u'Ф')}
				${h.h_tags.link_to_unless(c.letter==u'Х', u'Х', url='/stores/letter/%s'%u'Х')}
				${h.h_tags.link_to_unless(c.letter==u'Ц', u'Ц', url='/stores/letter/%s'%u'Ц')}
				${h.h_tags.link_to_unless(c.letter==u'Ч', u'Ч', url='/stores/letter/%s'%u'Ч')}
				${h.h_tags.link_to_unless(c.letter==u'Ш', u'Ш', url='/stores/letter/%s'%u'Ш')}
				${h.h_tags.link_to_unless(c.letter==u'Щ', u'Щ', url='/stores/letter/%s'%u'Щ')}
				${h.h_tags.link_to_unless(c.letter==u'Ю', u'Ю', url='/stores/letter/%s'%u'Ю')}
				${h.h_tags.link_to_unless(c.letter==u'Я', u'Я', url='/stores/letter/%s'%u'Я')}
				${h.h_tags.link_to_unless(c.letter==u'0-9', u'0-9', url='/stores/letter/%s'%u'0-9')}
			</td>
		</tr>
	</tbody>
</table>

<table cellspacing="1" class="common">
	<thead>
    	<tr>
			<th>${_(u'Логотип')}</th>
			<th>${_(u'Название магазина')}</th>
			<th>${_(u'Место размещения')}</th>
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
			${store.Clients.name}
		</td>
		<td class="alignLeft">
			${h.h_tags.image('/img/flags/'+store.Countries.code+'.png', store.Countries.name, align='left', class_='country-flag')}
			<div class="store-location">
				<strong>${store.Cities.name}</strong><br>
				${store.Regions.name}
			</div>
		</td>
        <td class="noWrap">
        	${store.Clients.popularity}
        	<img alt="" src="http://images.us.ciao.com/ius/images/stars/2003/stars40.gif"/><br/>
        	<small><a href="http://www.ciao.com/Adorama_com__15482215">15 Ratings</a>        					</small>
        </td>
        <td class="noWrap">
			<b><a href="http://www.ciao.com/shopping_partners/Adorama_com__5030188">${_(u'Показать товары')}</a></b>
   		</td>
        <td class="maintabCOLnar2">
        	${h.h_tools.button_to(_(u'Перейти >'), url(controller='statistic', action='store', id=store.Clients.rid), class_='to-store-btn')}
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

