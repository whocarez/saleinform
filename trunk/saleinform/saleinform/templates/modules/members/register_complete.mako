#-*-coding:utf-8-*-
<%doc>
	регистрация завершена
</%doc>
<div id="logPageUs"></div>

<div class="registerContainer">
	<div class="headerBar">
		<div class="RightCorner"></div>
		<div class="RightControlArea"></div>
		<h3 class="ModuleTitle">${_(u'Спасибо за регистрацию')}</h3>
	</div>


	<div class="registerComplete">
		<div class="ThankYouIcon">
			${h.h_tags.image('/img/register_mailicon_big.gif', _(u'Сообщение'))}
		</div>
		<div class="ThankYouIconText"><div>${_(u'Вам отправлено сообщение.Пожалуйста, проверьте Ваш электронный ящик, который Вы указали при регистрации')}</div></div>
		<div style="clear: both;"></div>

		<div class="registerIntro">
			<p>${_(u'Письмо содержит ссылку (URL). Пожалуйста, перейдите по этой ссылке для завершения регистрации на Saleinform.')}</p>
			<p>
			<strong>${_(u'Важно:')}</strong> ${_(u'Пожалуйста, проверьте ваши спам фильтры и убедитесь, что письма из указанных ниже адресов приходят на Ваш электронный адрес:')}<br/>
			<br/>
			${h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))}
			<strong>${h.h_tools.mail_to('info@saleinform.com', u'info@saleinform.com', encode='hex')}</strong><br/>
			${_(u'Для активации учетной записи и получения важных сообщений таких как изменение пароля, сотояния заказов и запросов и др.')}
			<br/>
			<br/>
			${h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))}
			<strong>${h.h_tools.mail_to('newsletters@saleinform.com', u'newsletters@saleinform.com', encode='hex')}</strong><br/>
			${_(u'Для получения важных рассылок нашего портала.')}</p>
		</div>
	</div>
	<div class="LowerModuleBorder">
		<div class="FooterBar">
			<div class="RightCorner"></div>
		</div>
	</div>	
	
</div>

