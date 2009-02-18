			<div class="currency-container">
				<h3>${_(u'Оффициальные курсы валюты')}</h3>
				% if c.a_coperation_status==True:
				<div class="message-save-success">
					${_(u'Изменения успешно сохранены')}
				</div>
				% elif c.a_coperation_status==False:
				<div class="message-save-failure">
					${_(u'Изменения не сохранены, скорее всего из-за ошибок заполнения.')}
				</div>
				% endif
				<div class="currency-toolbar">
					<div class="refresh-tool">${h.h_tags.link_to(_(u'Обновить курсы валют'), url='/admin/currency/refresh')}</div>
				</div>
				${h.h_tags.form(url='/admin/currency', method="post", id="currency")}
				${h.h_tags.hidden('caction','save')}
				<table class="admin-cources" cellpadding="0" cellspacing="0" id="one-column-emphasis">
					<colgroup>
						<col class="oce-first"/>
					</colgroup>
					<thead>
						<tr>
							<th scope="col">${_(u'Страна')}</th>
							% for currency in c.a_currencyList:
								<th scope="col">${currency.code}</th>
							% endfor
						</tr>
						% for country in c.a_countriesList:
						<tr>
							<td>${country.name}</td>
							% for currency in c.a_currencyList:
							<%
								flag = False
							%>
							<td>
								% for cource in c.a_cources:
									% if cource._currency_rid == currency.rid and cource._countries_rid == country.rid:
										${h.h_tags.text("cources-%s-%s"%(cource._currency_rid, cource._countries_rid), cource.cource)}
										<%
											flag = True
										%>
									% endif
								% endfor
								% if not flag:
									${h.h_tags.text("cources-%s-%s"%(currency.rid, country.rid), None)}
								% endif
							</td>
							% endfor
						</tr>
						% endfor
					</thead>
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
			
			
