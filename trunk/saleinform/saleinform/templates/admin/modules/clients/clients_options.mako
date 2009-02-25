#-*-coding:utf-8-*-

<%doc>
	редактирование настроек клиентов
</%doc>
<h3>${_(u'Опции клиента')} ${c.a_client.name}</h3>
<div class="back-link">
	${h.h_tags.link_to(_(u'Назад к списку клиентов'), '/admin/clients')}
</div>
% if c.a_operation_status==True:
<div class="message-save-success">
	${_(u'Изменения успешно сохранены')}
</div>
% elif c.a_operation_status==False:
<div class="message-save-failure">
	${_(u'Изменения не сохранены из-за ошибок.')}
</div>
% endif

${h.h_tags.form(url='/admin/clients/options/'+str(c.a_client.rid), method="post", multipart=True, id="clients")}
${h.h_tags.hidden('action','options')}
${h.h_tags.hidden('_clients_rid',c.a_client.rid)}
<div class="clients-options">
<script type="text/javascript">
<!--
$(document).ready(function(){
$("ul.delivery-tree").checkTree({
	});
});
//-->
</script>
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<h4>${_(u'Категории клиента')}</h4>
				<span class="subgrey">${_(u'Выберите не более трех категорий, которые наиболее точно отвечают сайту клиента')}</span><br>
				% for category in c.a_categories:
				${h.h_tags.checkbox('_categories_rid', category.rid, label=category.name)}<br>
				% endfor
			</td>
			<td valign="top">
				<h4>${_(u'Регионы доставки')}</h4>
				<ul class="delivery-tree">
					% for country in c.a_countries:
					<li>
						${h.h_tags.checkbox('_countries_rid', country.rid)}
						<label>${country.name}</label>
						<ul style="display: none">
						% for region in c.a_regions:
							% if region._countries_rid==country.rid:
							<li>
							${h.h_tags.checkbox('_regions_rid', region.rid)}
							<label>${region.name}</label>
							<ul>
							% for city in c.a_cities:
								% if city.Cities._regions_rid==region.rid:
								<li>
								${h.h_tags.checkbox('_cities_rid', city.Cities.rid)}
								<label>${city.Cities.name}</label>
								% endif
								</li>
							% endfor
							</ul>
							</li>
							% endif
						% endfor
						</ul>
					</li>							
					% endfor
				</ul>
			</td>
		</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}

