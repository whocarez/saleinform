#-*-coding:utf-8-*-
<%doc>
	редактирование города
</%doc>
<div class="regions-container">
<h3>${_(u'Редактирование городов')}</h3>
<div class="back-link">
	${h.h_tags.link_to(_(u'Назад к дереву регионов'), '/admin/regions')}
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

${h.h_tags.form(url='/admin/regions/cp/%s?_regions_rid=%s'%(c.a_city.rid, c.a_region.rid), method="post", multipart=True, id="cities")}
${h.h_tags.hidden('action','add')}
<div class="regions-processing">
	<table width="50%">
	<tr>
		<td width="40%">
			<label for="code">${_(u'Страна')}</label>
		</td>
		<td>
			${c.a_country.name}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Регион')}</label>
		</td>
		<td>
			${c.a_region.name}
		</td>
	</tr>
	<tr>
		<td>
			<label for="name">${_(u'Название города')}</label>
		</td>
		<td>
			${h.h_tags.text('name', value=c.a_city.name, id="name")}
		</td>
	</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}
</div>
