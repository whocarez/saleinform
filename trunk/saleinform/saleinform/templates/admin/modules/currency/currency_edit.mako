#-*-coding:utf-8-*-
<%doc>
	редактирование валют
</%doc>
<h3>${_(u'Редактирование валют')}</h3>
<div class="back-link">
	${h.h_tags.link_to(_(u'Назад к списку'), '/admin/currency')}
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

${h.h_tags.form(url='/admin/currency/action/'+str(c.a_currency.rid), method="post", multipart=True, id="currency")}
${h.h_tags.hidden('action','edit')}
<div class="country-processing">
	<table width="50%">
	<tr>
		<td width="40%">
			<label for="code">${_(u'Код валюты')}</label>
		</td>
		<td>
			${h.h_tags.text('code', value=c.a_currency.code, id="code")}
		</td>
	</tr>
	<tr>
		<td>
			<label for="name">${_(u'Название валюты')}</label>
		</td>
		<td>
			${h.h_tags.text('name', value=c.a_currency.name, id="name")}
		</td>
	</tr>
	<tr>
		<td>
			<label for="endword">${_(u'Сокращение')}</label>
		</td>
		<td>
			${h.h_tags.text('endword', value=c.a_currency.endword, id="endword")}
		</td>
	</tr>
	</table>
	${h.h_tags.submit('submit', _(u'Сохранить'))}
</div>
${h.h_tags.end_form()}

