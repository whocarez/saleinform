#-*-coding:utf-8-*-
<%doc>
	форма логирования
</%doc>
<div id="logPageUs"></div>
<div id="Node_BreadCrumb" class="breadCrumb2-US">
<a href="/">${_(u'Домашняя')}</a>
>
<span class="grey">${_(u'Войти на сайт')}</span>
</div>
<div style="clear: both;"></div>

<table class="wd750">
	<tr>
		<td class="hdlpad1">
			<span class="headline">${_(u'Войти на сайт')}</span>
		</td>
	</tr>
</table>

<table cellspacing="1" cellpadding="0" class="wd750nopad bg12dark">
	<tr> 
		<td class="loginHD1"><span class="subhdl">${_(u'Новый пользователь?')}</span></td>
		<td class="loginHD1"><span class="subhdl">${_(u'Уже зарегистрированы на сайте?')}</span></td>
	</tr>
	<tr>
		<td class="loginCOL1 bg12light">
			${_(u'Если у Вас еще нет учетной записи на нашем сайте, пожалуйста, сперва зарегистрируйтесь.')}<br/><br/>
			${_(u'Регистрация займет всего несколько секунд')}<br/>
			<strong>${_(u'и ни к чему Вас не обязывает')}</strong>.<br/><br/>
			<b>${_(u'Имея учетную запись на нашем сайте, Вы можете:')}</b> 
			<ul class="loginLIST">
  				<li>${_(u'Оставлять отзывы на товары')}</li>
  				<li>${_(u'Оценивать товары и магазины')}</li>
  				<li>${_(u'Формировать заказы')}</li>
  				<li>${_(u'и многое другое...')}</li>
			</ul>
			<div class="padT5">
				${h.h_tags.form('/members/register', target='_self', method="post")}
				${h.h_tags.submit('Submit', value=_(u'Регистрация >'), tabindex="3", maxlength="255", size="40", class_='w150')}
				${h.h_tags.end_form()}
			</div>
		</td>
		<td class="loginCOL2 bgwhite">
			${h.h_tags.form('/members/login', target='_self', method="get")}
			${_(u'Пожалуйста, введите Ваши логин')} <br/>${_(u'и пароль.')}<br/><br/>
			${h.h_tags.hidden('loginAction', value="todo")}<br/>
			<span class="subhdl">${_(u'Логин')}</span><br/>
			${h.h_tags.text('login', value="", tabindex="1", maxlength="255", size="40")}<br/>
			<span class="subgrey">${_(u'Забыли Ваш')}</span> 
			<a class="small" href="send_password.php">${_(u'логин')}</a>
			<span class="subgrey">?</span><br/><br/>
			<span class="subhdl">${_(u'Пароль')}</span><br/>
			${h.h_tags.password('password', value="", tabindex="2", maxlength="255", size="40")}<br/>
			<span class="subgrey">Важно: Ваши логин и пароль регистрозависимы</span><br/>
			<span class="subgrey">${_(u'Забыли Ваш')}</span> 
			<a class="small" href="send_password.php">${_(u'пароль')}</a><span class="subgrey">?</span><br/>
			<br/>
			${h.h_tags.submit('Submit', value=_(u'Войти >'), tabindex="3", maxlength="255", size="40", class_='w150')}<br/>
			<br/>
			<br/>
			<div class="floatchkbx1">
				${h.h_tags.checkbox('autologin', value='1', tabindex="4")}
			</div>
			<span class="subgrey">${_(u'Запомнить меня на этом компьютере')}</span>
			${h.h_tags.end_form()}
			
		</td>
	</tr>
</table>