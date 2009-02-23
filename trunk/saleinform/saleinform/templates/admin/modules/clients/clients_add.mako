#-*-coding:utf-8-*-
<%doc>
	добавление клиентов
</%doc>
<h3>Добавление клиента</h3>
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

${h.h_tags.form(url='/admin/clients/action', method="post", multipart=True, id="clients")}
${h.h_tags.hidden('action','add')}
<div class="clients-processing">
	<table width="50%">
	<tr>
		<td width="40%">
			<label for="code">${_(u'Название')}</label>
		</td>
		<td>
			${h.h_tags.text('name', value="", id="name")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Логотип')}</label>
		</td>
		<td>
			${h.h_tags.file('logo', value="", id="logo")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Город')}</label>
		</td>
		<td>
			${h.h_tags.select('_cities_rid', "", [[city.Cities.rid, city.Cities.name+'-'+city.regionName+"-"+city.countryName] for city in c.a_cities], id="_cities_rid")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Адрес')}</label>
		</td>
		<td>
			${h.h_tags.text('address', value="", id="address")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Телефоны')}</label>
		</td>
		<td>
			${h.h_tags.text('phones', value="", id="phones")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Skype')}</label>
		</td>
		<td>
			${h.h_tags.text('skype', value="", id="skype")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'ICQ')}</label>
		</td>
		<td>
			${h.h_tags.text('icq', value="", id="icq")}
		</td>
	</tr>
	
	<tr>
		<td width="40%">
			<label for="code">${_(u'Сайт')}</label>
		</td>
		<td>
			${h.h_tags.text('url', value="", id="url")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Кредит')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('creadits_info', value=True, id="creadits_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Доставка')}</label>
		</td>
		<td>
			${h.h_tags.textarea('delivery_info', value="", id="delivery_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Время работы')}</label>
		</td>
		<td>
			${h.h_tags.textarea('worktime_info', value="", id="worktime_info")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Описание')}</label>
		</td>
		<td>
			${h.h_tags.textarea('descr', value="", id="descr")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Загрузка прайсов')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('isloaded', value=True, id="isloaded")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Актуальность прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('actual_days', value="", id="actual_days")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Email прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('price_email', value="", id="price_email")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Адрес прайса')}</label>
		</td>
		<td>
			${h.h_tags.text('price_url', value="", id="price_url")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактные телефоны')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_phones', value="", id="contact_phones")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактный Email')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_email', value="", id="contact_email")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Контактное лицо')}</label>
		</td>
		<td>
			${h.h_tags.text('contact_person', value="", id="contact_person")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Активный')}</label>
		</td>
		<td>
			${h.h_tags.checkbox('active', value=True, id="active")}
		</td>
	</tr>
	<tr>
		<td width="40%">
			<label for="code">${_(u'Популярность')}</label>
		</td>
		<td>
			${h.h_tags.text('popularity', value="", id="popularity")}
		</td>
	</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}

