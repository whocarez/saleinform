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
					<div class="add-tool">${h.h_tags.link_to(_(u'Добавить'), url='/admin/countries/action')}</div>
				</div>
				${h.h_tags.form(url='/admin/countries', method="post", id="countries")}
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
						<td>${h.h_tags.checkbox('check_clients', value=row.rid, checked=False, label=None)}</td>
						<td></td>
						<td>${row.name}</td>
						<td>${h.h_tags.image(row.image_name, alt=row.countryName)}</td>
						<td>${row.cityName}<br>${row.regionName}</td>
						<td>${row.contact_phones}</td>
						<td>${row.contact_email}</td>
						<td>${row.contact_person}</td>
						<td>${h.h_tags.checkbox('isloaded', value=row.isloaded, checked=row.isloaded, label=None)}</td>
						<td>${h.h_tags.checkbox('active', value=row.active, checked=row.active, label=None)}</td>
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
			
			
