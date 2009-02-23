			<div class="clients-container">
				<h3>Клиенты</h3>
				% if c.a_operation_status==True:
				<div class="message-save-success">
					${_(u'Изменения успешно сохранены')}
				</div>
				% elif c.a_operation_status==False:
				<div class="message-save-failure">
					${_(u'Изменения не сохранены, скорее всего из-за наличия зависимых записей.')}
				</div>
				% endif
				<div class="clients-toolbar">
					<div class="add-tool">${h.h_tags.link_to(_(u'Добавить'), url='/admin/clients/action')}</div>
					<div class="refresh-tool">${h.h_tags.link_to(_(u'Обновить'), url='/admin/clients/refresh')}</div>
				</div>
				<div class="search-bar">
					<h3>${_(u'Поиск клиентов')}</h3>
					${h.h_tags.form(url='/admin/clients', method="post", id="clients")}
					${h.h_tags.hidden('action','search')}
					<table cellpadding="5" cellspacing="2">
						<tr>
							<td>
								${_(u'Наименование')}
								${h.h_tags.text('s_name', '', id="s_name")}
							</td>
							<td>
								${_(u'Место')}
								${h.h_tags.text('s_place', '', id="s_place")}
							</td>
							<td>${h.h_tags.submit('submit',_(u'Найти'))}</td>
						</tr>
					</table>
					${h.h_tags.end_form()}
				</div>
				${h.h_tags.form(url='/admin/clients', method="post", id="clients")}
				${h.h_tags.hidden('action','save')}
				<table class="admin-clients" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>${h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")}</th>
							<th>${_(u'Лого')}</th>
							<th>${_(u'Наименование')}</th>
							<th></th>
							<th>${_(u'Место')}</th>
							<th>${_(u'Телефон')}</th>
							<th>${_(u'Email')}</th>
							<th>${_(u'Контактное лицо')}</th>
							<th>${_(u'Прайс')}</th>
							<th>${_(u'Активный')}</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					% for row in c.a_clients:
					<tr>
						<td>
							${h.h_tags.checkbox('check_clients', value=row.rid, checked=False, label=None)}
							${h.h_tags.hidden('client_rid', value=row.rid, checked=False, label=None)}
						</td>
						<td>
						% if row.logo==u'':
							${h.h_tags.image('/img/cllogos/nologo2.gif', alt=row.name)}
						% else:
							${h.h_tags.image(row.logo, alt=row.name)}
						% endif
						</td>
						<td>${row.name}</td>
						<td>${h.h_tags.image(row.image_name, alt=row.countryName)}</td>
						<td>${row.cityName}<br>${row.regionName}</td>
						<td>${row.contact_phones}</td>
						<td>${h.h_tools.mail_to(row.contact_email, row.contact_email, encode = "hex")}</td>
						<td>${row.contact_person}</td>
						<td>${h.h_tags.checkbox('isloaded', value=row.rid, checked=row.isloaded, label=None)}</td>
						<td>${h.h_tags.checkbox('active', value=row.rid, checked=row.active, label=None)}</td>
						<td>${h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', _(u'Редактировать запись'), border="0"), '/admin/countries/action/'+str(row.rid), title=_(u'Редактировать запись'))}</td>
						<td>
							<div class="btnR">
								${h.h_tags.link_to(_(u"Перейти >"), row.url, class_='btnL', target="_blank")}
							</div>
						</td>
					</tr>
					% endfor
				</table>
				${h.h_tags.submit('submit',_(u'Сохранить'))}
				${h.h_tags.end_form()}
				<div class="pager">
					${h.h_builder.literal(c.a_pager)}
				</div>
			</div>
			
			<script type="text/javascript">
                $(document).ready(function(){
                        $("#countries > table > thead > tr > th > #check_all").click(function(){
                                var checked_status = this.checked;
                                $("input[name='check_countries']").each(function(){
                                        this.checked = checked_status;
                                });
                        });
                });
			</script>
			
			
