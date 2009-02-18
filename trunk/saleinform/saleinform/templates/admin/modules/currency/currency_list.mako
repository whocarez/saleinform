			<div class="currency-container">
				<h3>${_(u'Валюты')}</h3>
				% if c.a_operation_status==True:
				<div class="message-save-success">
					${_(u'Изменения успешно сохранены')}
				</div>
				% elif c.a_operation_status==False:
				<div class="message-save-failure">
					${_(u'Изменения не сохранены, скорее всего из-за наличия зависимых записей.')}
				</div>
				% endif
				<div class="currency-toolbar">
					<div class="add-tool">${h.h_tags.link_to(_(u'Добавить'), url='/admin/currency/action')}</div>
				</div>
				${h.h_tags.form(url='/admin/currency', method="post", id="currency")}
				${h.h_tags.hidden('action','save')}
				<table class="admin-currency" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>${h.h_tags.checkbox('check_all', value=0, checked=False, label=None, id="check_all")}</th>
							<th>${_(u'Наименование')}</th>
							<th>${_(u'Код')}</th>
							<th>${_(u'Сокращение')}</th>
							<th></th>
						</tr>
					</thead>
					% for row in c.a_currency:
					<tr>
						<td>${h.h_tags.checkbox('check_currency', value=row.rid, checked=False, label=None)}</td>
						<td>${row.name}</td>
						<td>${row.code}</td>
						<td>${row.endword}</td>
						<td>${h.h_tags.link_to(h.h_tags.image('/img/icons/pencil.png', _(u'Редактировать запись'), border="0"), '/admin/currency/action/'+str(row.rid), title=_(u'Редактировать запись'))}</td>
					</tr>
					% endfor
				</table>
				${h.h_tags.submit('submit',_(u'Сохранить'))}
				${h.h_tags.end_form()}
			</div>
			
			<script type="text/javascript">
                $(document).ready(function(){
                        $("#currency > table > thead > tr > th > #check_all").click(function(){
                                var checked_status = this.checked;
                                $("input[name='check_currency']").each(function(){
                                        this.checked = checked_status;
                                });
                        });
                });
			</script>
			
			
