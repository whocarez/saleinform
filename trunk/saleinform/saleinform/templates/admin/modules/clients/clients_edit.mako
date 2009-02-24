#-*-coding:utf-8-*-
<%doc>
	редактирование клиентов
</%doc>
<h3>Редактирование клиента</h3>
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

${h.h_tags.form(url='/admin/clients/action/'+str(c.a_client.rid), method="post", multipart=True, id="clients")}
${h.h_tags.hidden('action','edit')}
<div class="clients-processing">
	<table width="50%">
	<tr>
		<td width="40%">
			<label for="code">${_(u'Название')}</label>
		</td>
		<td>
			${h.h_tags.text('name', value=c.a_client.name, id="name")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Логотип')}</label>
		</td>
		<td>
			${h.h_tags.file('logo', value="", id="logo")}
			% if c.a_client.logo != u'':
				<br>
				${h.h_tags.image(c.a_client.logo, _(u'Логотип'))}
			% endif
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Город')}</label>
		</td>
		<td>
			${h.h_tags.select('_cities_rid', c.a_client._cities_rid, [[city.Cities.rid, city.Cities.name+'-'+city.regionName+"-"+city.countryName] for city in c.a_cities], id="_cities_rid")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Адрес')}</label>
		</td>
		<td>
			${h.h_tags.text('address', value=c.a_client.address, id="address")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Телефоны')}</label>
		</td>
		<td>
			${h.h_tags.text('phones', value=c.a_client.phones, id="phones")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Skype')}</label>
		</td>
		<td>
			${h.h_tags.text('skype', value=c.a_client.skype, id="skype")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'ICQ')}</label>
		</td>
		<td>
			${h.h_tags.text('icq', value=c.a_client.icq, id="icq")}
		</td>
	</tr>
	
	<tr>
		<td width="40%">
			<label for="code">${_(u'Сайт')}</label>
		</td>
		<td>
			${h.h_tags.text('url', value=c.a_client.url, id="url")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Кредит')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('creadits_info', value=c.a_client.creadits_info, id="creadits_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Доставка')}</label>
		</td>
		<td>
			${h.h_tags.textarea('delivery_info', value=c.a_client.delivery_info, id="delivery_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Время работы')}</label>
		</td>
		<td>
			${h.h_tags.textarea('worktime_info', value=c.a_client.worktime_info, id="worktime_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Описание')}</label>
		</td>
		<td>
			${h.h_tags.textarea('descr', value=c.a_client.descr, id="descr")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Загрузка прайсов')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('isloaded', value=c.a_client.isloaded, id="isloaded")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Актуальность прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('actual_days', value=c.a_client.actual_days, id="actual_days")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Email прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('price_email', value=c.a_client.price_email, id="price_email")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Адрес прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('price_url', value=c.a_client.price_url, id="price_url")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактные телефоны')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_phones', value=c.a_client.contact_phones, id="contact_phones")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактный Email')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_email', value=c.a_client.contact_email, id="contact_email")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактное лицо')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_person', value=c.a_client.contact_person, id="contact_person")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Активный')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('active', value=c.a_client.active, id="active")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Популярность')}</label>
		</td>
		<td>
			${h.h_tags.text('popularity', value=c.a_client.popularity, id="popularity")}
		</td>
	</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}

