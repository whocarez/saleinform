			<div class="countries-container">
				<h3>Страны</h3>
				${h.h_tags.form(url='/admin/geography', method="post", id="countries")}
				<div class="countries-toolbar">
					${h.h_tags.link_to(h.h_tags.image(url='/img/icons/add.png', alt=_(u'Добавить страну'), border="0"), url='/admin/geography/add', title=_(u"Добавить страну"))}
				</div>
				${h.h_tags.hidden('action','save')}
				<table class="admin-countries" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>${_(u'Наименование')}</th>
							<th>${_(u'Код')}</th>
							<th>${_(u'Валюта')}</th>
							<th>${_(u'Архив')}</th>
						</tr>
					</thead>
					% for row in c.a_countries:
					<tr>
						<td>${row.name}</td>
						<td>${row.code}</td>
						<td>${row.currency_code}</td>
						<td>${h.h_tags.checkbox('archive_'+str(row.rid), value=row.rid, checked=row.archive, label=None)}</td>
					</tr>
					% endfor
				</table>
				${h.h_tags.submit('submit',_(u'Сохранить'))}
				${h.h_tags.end_form()}
			</div>
<script type="text/javascript">
<!--
$(document).ready(function(){
	  $('#countries').FormObserve();
});
//-->
</script>
			
