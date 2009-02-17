			<div class="countries-container">
				<h3>Страны</h3>
				% if c.a_operation_status==True:
				<div class="message-save-success">
					${_(u'Изменения успешно сохранены')}
				</div>
				% elif c.a_operation_status==False:
				<div class="message-save-failure">
					${_(u'Изменения не сохранены, скорее всего из-за наличия зависимых записей.')}
				</div>
				% endif
				<div class="countries-toolbar">
					<div class="add-tool">${h.h_tags.link_to(_(u'Добавить'), url='/admin/geography/action')}</div>
				</div>
				${h.h_tags.form(url='/admin/geography', method="post", id="countries")}
				${h.h_tags.hidden('action','save')}
				<table class="admin-countries" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>${h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")}</th>
							<th></th>
							<th>${_(u'Наименование')}</th>
							<th>${_(u'Код')}</th>
							<th>${_(u'Валюта')}</th>
							<th>${_(u'Архив')}</th>
							<th></th>
						</tr>
					</thead>
					% for row in c.a_countries:
					<tr>
						<td>${h.h_tags.checkbox('check_countries', value=row.rid, checked=False, label=None)}</td>
						<td>${h.h_tags.image(row.image_name, alt=row.name)}</td>
						<td>${row.name}</td>
						<td>${row.code}</td>
						<td>${row.currency_code}</td>
						<td>${h.h_tags.checkbox('archive', value=row.rid, checked=row.archive, label=None)}</td>
						<td>${h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', _(u'Редактировать запись'), border="0"), '/admin/geography/action/'+str(row.rid), title=_(u'Редактировать запись'))}</td>
					</tr>
					% endfor
				</table>
				${h.h_tags.submit('submit',_(u'Сохранить'))}
				${h.h_tags.end_form()}
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
			
			
