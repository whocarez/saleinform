#-*-coding:utf-8-*-
<%doc>
	редактирование стран
</%doc>
<h3>Редактирование страны</h3>
<div class="back-link">
	${h.h_tags.link_to(_(u'Назад к списку стран'), '/admin/countries')}
</div>

% if c.a_operation_status==True:
<div class="message-save-success">
	${_(u'Изменения успешно сохранены')}
</div>
% elif c.a_operation_status==False:
<div class="message-save-failure">
	${_(u'Во время обработки произошла ошибка.')}
</div>
% endif

${h.h_tags.form(url='/admin/countries/action/'+str(c.a_country.rid), method="post", multipart=True, id="countries")}
${h.h_tags.hidden('action','add')}
<div class="country-processing">
	<table width="50%">
	<tr>
		<td width="40%">
			<label for="code">${_(u'Код страны')}</label>
		</td>
		<td>
			${h.h_tags.text('code', value=c.a_country.code, id="code")}
		</td>
	</tr>
	<tr>
		<td>
			<label for="name">${_(u'Название страны')}</label>
		</td>
		<td>
			${h.h_tags.text('name', value=c.a_country.name, id="name")}
		</td>
	</tr>
	<tr>
		<td>
			<label for="_currency_rid">${_(u'Валюта')}</label>
		</td>
		<td>
			% for currency in c.a_currencies:
				${h.h_tags.radio('_currency_rid', value=currency.rid, id="_currency_rid", label=currency.code, checked=currency.rid==c.a_country._currency_rid)}<br>	
			% endfor
		</td>
		
	</tr>
	<tr>
		<td>
			<label for="image_name">${_(u'Флаг страны')}</label>
		</td>
		<td>
			${h.h_tags.file('image_name', value="", id="image_name")}<br>
			${h.h_tags.image(c.a_country.image_name, alt=_(u'Флаг страны'))}
		</td>	
	</tr>
	<tr>
		<td> 
			<label for="archive">${_(u'Архивный')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('archive', value=c.a_country.archive, id="archive")}
		</td>	
	</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}

